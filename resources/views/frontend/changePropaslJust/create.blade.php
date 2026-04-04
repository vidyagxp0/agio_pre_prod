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
<style>
    textarea.note-codable {
        display: none !important;
    }

    header {
        display: none;
    }
</style>
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

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            @if (!empty($parent_id))
            {{ Helpers::getDivisionName($parent_division_id) }} /
            Change Propasal And Justification
            @else
            {{ Helpers::getDivisionName(session()->get('division')) }} /
            {{-- {{ Helpers::getDivisionName($data->division_id) }} / --}}
            Change Propasal And Justification
            @endif
        </div>
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
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD Review</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm3')">QA/CQA Approval</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Activity Log</button>

        </div>
        <form action="{{ route('cpjstore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab content -->
            <div id="step-form">
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                           
                            @php
                                $record_number = DB::table('record_numbers')->value('counter') + 1;
                            @endphp

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label><b>Record Number</b></label>

                                    <!-- Show formatted -->
                                    <input disabled type="text"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}/CPJ/{{ date('Y') }}/{{ str_pad($record_number, 4, '0', STR_PAD_LEFT) }}">

                                    <!-- Send actual -->
                                    <input type="hidden" name="record" value="{{ $record_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Division Code"><b>Site/Location Code</b></label>
                                @if (!empty($parent_division_id))

                                    <input disabled type="text" name="site_location_code"
                                        value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                    <input type="hidden" name="site_location_code"
                                        value="{{ $parent_division_id }}">
                                    <input type="hidden" name="division_id"
                                        value="{{ $parent_division_id }}">
                                @else 
                                    <input disabled type="text" name="site_location_code"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                    <input type="hidden" name="site_location_code"
                                        value="{{ session()->get('division') }}">
                                    <input type="hidden" name="division_id"
                                        value="{{ session()->get('division') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"><b>Initiator</b></label>
                                <input disabled type="text" value="{{ Auth::user()->name }}">

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
                            <input readonly type="text" value="{{ date('d-M-Y') }}"
                                name="initiation_date_new" id="initiation_date"
                                style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                            <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Short Description">Short Description<span
                                    class="text-danger">*</span></label><span id="rchars">255</span>
                            Characters remaining
                            <input id="docname" type="text" name="cpdescription" maxlength="255"
                                required>
                        </div>
                </div>
                <script>
                    var maxLength = 255;
                    $('#docname').keyup(function() {
                        var textlen = maxLength - $(this).val().length;
                        $('#rchars').text(textlen);
                    });
                </script>

                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Change Proposal Justificatin Grid
                                            <button type="button" id="traceblity_add">+</button>
                                            <!-- <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal-Market_Complaint_Traceability"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span> -->
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Sr. No.</th>
                                                        <th>Existing System</th>
                                                        <th>Proposed Change</th>
                                                        <th>Justification</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input disabled type="text"
                                                                name="change_proposal_grid[0][serial]"
                                                                value="1">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[0][existing_system]">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[0][proposed_change]">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[0][justification]">
                                                        </td>

                                                        <td>
                                                            <button type="button" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    })
                                </script>


                                <script>
                                    $(document).ready(function() {
                                        $('#traceblity_add').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                    var html =
                                                        '<tr>' +

                                                        '<td><input disabled type="text" name="change_proposal_grid[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +

                                                        '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][existing_system]"></td>' +

                                                        '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][proposed_change]"></td>' +

                                                        '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][justification]"></td>' +

                                                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                                                        '</tr>';

                                                    return html;
                                                }

                                            var tableBody = $('#traceblity tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Assigned To">HOD Review </label>
                        <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                            name="reviewers" placeholder="Select Reviewers">
                            <option value="">-- Select --</option>


                            @if (!empty(Helpers::getHODDropdown()))
                            @foreach (Helpers::getHODDropdown() as $lan)
                            <option value="{{ $lan['id'] }}">
                                {{ $lan['name'] }}
                            </option>
                            @endforeach
                            @endif

                        </select>
                    </div>
                </div>
               

    


    <div class="col-lg-6">
        <div class="group-input">
            <label for="Assigned To">QA/CQA Approval </label>
            <select id="choices-multiple-remove-but" class="choices-multiple-reviewer"
                name="approvers" placeholder="Select Approvers">
                <option value="">-- Select --</option>

                @if (!empty($users))
                @foreach ($users as $lan)
                @if (Helpers::checkUserRolesApprovers($lan))
                <option value="{{ $lan->id }}">
                    {{ $lan->name }}
                </option>
                @endif
                @endforeach
                @endif
            </select>
        </div>
    </div>
    
    


    

    <script>
        function formatDateDisplay(dateInput) {
            const displayFormat = new Date(dateInput.value).toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).replace(/ /g, '-');

            dateInput.setAttribute('data-display', displayFormat);
            dateInput.value = dateInput.value; // Retain actual date format for saving
        }
    </script>


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
        <label for="Attachment Extension">Attachment Extension</label>
        <div><small class="text-primary">Please Attach all relevant or supporting
                documents</small></div>
        <div class="file-attachment-field">
            <div class="file-attachment-list" id="cpAttachment"></div>
            <div class="add-btn">
                <div>Add</div>
                <input type="file" id="myfile" name="cpAttachment[]"
                    oninput="addMultipleFiles(this, 'cpAttachment')" multiple>
            </div>
        </div>
    </div>
</div>
</div>

<div class="button-block">
    <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
    <button type="button" class="backButton" onclick="previousStep()">Back</button>
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
                    <label for="Assigned To">HOD Remarks</label>
                    <textarea name="reviewer_remarks" id="reviewer_remarks" cols="30" disabled></textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="HOD Attachments">HOD Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachment_reviewer"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attachment_reviewer[]"
                                oninput="addMultipleFiles(this, 'file_attachment_reviewer')" multiple
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-block">
            <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>


            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
                    <label for="Assigned To">QA/CQA Approval Comments</label>
                    <textarea name="approver_remarks" id="approver_remarks" cols="30" disabled></textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Guideline Attachment">QA/CQA Approval Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachment_approver"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attachment_approver[]"
                                oninput="addMultipleFiles(this, 'file_attachment_approver')" multiple
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-block">
            <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                    Exit </a> </button>
        </div>
    </div>
</div>
<!-- Activity Log content -->
<div id="CCForm4" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Activated By">Submit By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Activated On">Submit On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Activated On">Submit Comment</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By">Cancel By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Cancel On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Cancel Comment</label>
                    <div class="static"></div>
                </div>
            </div>

            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">More Information Required By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">More Information Required On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">More Information Required Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}


            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By">Review By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Review On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Review Comment</label>
                    <div class="static"></div>
                </div>
            </div>


            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">System By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">System On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">System Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}


            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By">Reject By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Reject On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Reject Comment</label>
                    <div class="static"></div>
                </div>
            </div>

            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">More Information Required By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">More Information Required On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">More Information Required Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}

            <!-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Send for CQA By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div> -->

            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By"> Approved By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Approved On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Approved Comment</label>
                    <div class="static"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By"> CQA Approval Complete By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On"> CQA Approval Complete On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">CQA Approval Complete Comment</label>
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


    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
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

{{-- <script>
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
    </script>  --}}
<script>
    VirtualSelect.init({
        ele: '#Facility, #Group, #Audit, #Auditee ,#relatedRecords, #designee, #hod,#related_records'
    });
</script>
@endsection