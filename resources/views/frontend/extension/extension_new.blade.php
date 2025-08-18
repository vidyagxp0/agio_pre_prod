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
            Extension

            @else
            {{ Helpers::getDivisionName(session()->get('division')) }} /
            {{-- {{ Helpers::getDivisionName($data->division_id) }} / --}}
            Extension

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
        <form action="{{ route('extension_new.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab content -->
            <div id="step-form">
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            @if (!empty($parent_id))
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                            <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                            {{-- <input type="hidden" name="parent_record" id="parent_record" value="{{ $parent_record }}"> --}}
                            @endif
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    @if (!empty($parent_division_id))
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/Ext/{{ date('Y') }}/{{ $record_number }}">                                        
                                    @else  
                                    <input type="hidden" name="record" value="{{ $record_number }}">
                                    <input disabled type="text" name="record_number"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}/Ext/{{ date('y') }}/{{ $record_number }}">
                                    @endif
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
                            <input id="docname" type="text" name="short_description" maxlength="255"
                                required>
                        </div>
                        {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}
                    </div>
                    @enderror --}}
                </div>
                <script>
                    var maxLength = 255;
                    $('#docname').keyup(function() {
                        var textlen = maxLength - $(this).val().length;
                        $('#rchars').text(textlen);
                    });
                </script>

                <div class="col-md-6">
                    <div class="group-input">
                        <label for="Extension Number">
                            Extension Number
                        </label>
                        @if(!empty($countData))
                        <input id="docname" type="text" value="{{ $countData }}" readonly>
                        @else
                        <select name="data_number" id="countSelect">
                            <option value="">--Select Extension Number--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        @endif
                    </div>
                </div>
                <style>
                    .hide-input {
                        display: none;
                    }
                </style>
                @if (!empty($parent_type))
                <input type="text" class="hide-input" name="parent_type" value="{{ $parent_type }}">
                @else
                <input type="text" class="hide-input" name="parent_type" id="parentTypeInput" value="">
                @endif
                <script>
                    document.getElementById('countSelect').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var parentTypeInput = document.getElementById('parentTypeInput');

                        // Check if the selected value is '3'
                        if (selectedValue == "3") {
                            parentTypeInput.value = "number"; // Set value if 3 is selected
                        } else {
                            parentTypeInput.value = ""; // Clear value if any other option is selected
                        }
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
                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Parent Records Number</label>
                                        <select multiple name="related_records[]" placeholder="Select Parent Record Number"
                                            data-silent-initial-value-set="true" id="related_records">

                                            @foreach ($relatedRecords as $records)
                                                <option
                                                    value="{{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}">
                {{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}
                </option>
                @endforeach
                </select>
                @error('related_records')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
    </div> --}}

    <div class="col-lg-6">
        <div class="group-input">
            <label for="RLS Record Number"><b>Parent Records Number</b></label>
            @if (!empty($extension_record))
            <input readonly type="text" name="related_records"
                value="{{ $extension_record }}">
            @else
            <input type="text" name="related_records_edits"  disabled>
            @endif
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
    {{-- <div class="col-lg-6 group-input input-date">
        <label for="Actual Start Date">Current Due Date (Parent)</label>
        <div class="calenderauditee">
            <input type="date"
                id="start_date"
                name="current_due_date"
                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                value="{{ $parent_due_date }}"
                oninput="formatDateDisplay(this)" />
        </div>
    </div> --}}


    <!-- <div class="col-lg-6 group-input input-date">
        <label for="Actual Start Date">Current Due Date (Parent)</label>
        <div class="calenderauditee">
            <input type="date"
                id="start_date"
                name="current_due_date"
                min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                value="{{ $parent_due_date }}"
                oninput="formatDateDisplay(this)" />
        </div>
    </div>


    <div class="col-lg-6 new-date-data-field">
        <div class="group-input input-date">
            <label for="Actual Start Date">Current Due Date (Parent)</label>
            <div class="calenderauditee">
                <input type="text" id="test_date" readonly placeholder="DD-MMM-YYYY" />
                <input type="date" name="current_due_date"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $parent_due_date }}"
                    class="hide-input" oninput="handleDateInput(this, 'test_date')" />
            </div>
        </div>
    </div> -->
    
    <div class="col-lg-6 new-date-data-field">
    <div class="group-input input-date">
        <label for="Actual Start Date">Current Due Date (Parent)</label>
        <div class="calenderauditee">
            <input type="text" 
                   id="start_date" 
                   readonly 
                   placeholder="DD-MMM-YYYY" 
                   value="{{ \Carbon\Carbon::parse($parent_due_date)->format('d-M-Y') }}" />
            
            <input type="date" 
                   name="current_due_date"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                   value="{{ \Carbon\Carbon::parse($parent_due_date)->format('Y-m-d') }}"
                   class="hide-input" 
                   oninput="handleDateInput(this, 'start_date')" />
        </div>
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

    <div class="col-lg-6 new-date-data-field">
        <div class="group-input input-date">
            <label for="Actual Start Date">Proposed Due Date</label>
            <div class="calenderauditee">
                <input type="text" id="test_date" readonly placeholder="DD-MMM-YYYY" />
                <input type="date" name="proposed_due_date"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                    class="hide-input" oninput="handleDateInput(this, 'test_date')" />
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="group-input">
            <label for="Short Description"> Description</label>

            <textarea name="description" id="description" cols="30"></textarea>
        </div>
        {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}
    </div>
    @enderror --}}
</div>
<div class="col-12">
    <div class="group-input">
        <label for="Short Description">Justification / Reason </label>

        <textarea name="justification_reason" id="justification_reason" cols="30"></textarea>
    </div>
    {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}
</div>
@enderror --}}
</div>
<div class="col-12">
    <div class="group-input">
        <label for="Attachment Extension">Attachment Extension</label>
        <div><small class="text-primary">Please Attach all relevant or supporting
                documents</small></div>
        <div class="file-attachment-field">
            <div class="file-attachment-list" id="file_attachment_extension"></div>
            <div class="add-btn">
                <div>Add</div>
                <input type="file" id="myfile" name="file_attachment_extension[]"
                    oninput="addMultipleFiles(this, 'file_attachment_extension')" multiple>
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