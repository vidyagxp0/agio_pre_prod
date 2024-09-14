@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Management Review
        </div>
    </div>

    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Head review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Meetings & Summary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CFT</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CFT HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA verification</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity log</button>
            </div>

            <form action="{{ route('managestore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/MR/{{ date('Y') }}/{{ $record_number }}">
                                        <!-- {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}} -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="assign_to">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Due</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date </label>
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY"
                                            value="{{ \Carbon\Carbon::parse($due_date)->format('d-M-Y') }}" />
                                        <input type="hidden" name="due_date" id="due_date_input"
                                            value="{{ $due_date }}" />

                                        {{-- <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <input disabled type="text" value="{{ Helpers::getdateFormat($due_date) }}"> --}}
                                {{-- <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="" name="due_date"> 
                                    </div>

                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group"><b>Initiator Department</b></label>
                                            <select name="initiator_Group" id="initiator_group">
                                                <optio value="">Select Initiation Department</option>
                                                    <option value="CQA">Corporate Quality Assurance</option>
                                                    <option value="QA">Quality Assurance</option>
                                                    <option value="QC">Quality Control</option>
                                                    <option value="QM">Quality Control (Microbiology department)
                                                    </option>
                                                    <option value="PG">Production General</option>
                                                    <option value="PL">Production Liquid Orals</option>
                                                    <option value="PT">Production Tablet and Powder</option>
                                                    <option value="PE">Production External (Ointment, Gels, Creams and
                                                        Liquid)</option>
                                                    <option value="PC">Production Capsules</option>
                                                    <option value="PI">Production Injectable</option>
                                                    <option value="EN">Engineering</option>
                                                    <option value="HR">Human Resource</option>
                                                    <option value="ST">Store</option>
                                                    <option value="IT">Electronic Data Processing</option>
                                                    <option value="FD">Formulation Development</option>
                                                    <option value="AL">Analytical research and Development Laboratory
                                                    </option>
                                                    <option value="PD">Packaging Development</option>
                                                    <option value="PU">Purchase Department</option>
                                                    <option value="DC">Document Cell</option>
                                                    <option value="RA">Regulatory Affairs</option>
                                                    <option value="PV">Pharmacovigilance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group Code"><b>Initiator Department Code</b></label>
                                            <input type="text" name="initiator_group_code" id="initiator_group_code"
                                                value="" disabled>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="short_description">Short Description<span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type">Type</label>
                                        <select name="type">
                                            <option value="0">Select Type</option>
                                            <option value="Other">Other</option>
                                            <option value="Training">Training</option>
                                            <option value="Finance">Finance</option>
                                            <option value="follow Up">Follow Up</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Account Service">Account Service</option>
                                            <option value="Recent Product Launch">Recent Product Launch</option>
                                            <option value="IT">IT</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Priority Level">Priority Level</label>
                                        <select name="priority_level">
                                            <option value="">Select Priority Level</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                </div> --}}


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled Start Date">Proposed Scheduled Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="start_date_checkdate" name="start_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Invite Person NotifyTo <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="assign_to">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type">Type</label>
                                        <select name="summary_recommendation" id="summary_recommendation"
                                            onchange="toggleReviewPeriod()">
                                            <option value="">Select Type</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Six Monthly">Six Monthly</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Review Period for Monthly (initially hidden) -->
                                <div class="col-lg-6" id="review_period_monthly" style="display: none;">
                                    <div class="group-input">
                                        <label for="review_period">Review Period (Monthly)</label>
                                        <select name="review_period_monthly" id="review_period_monthly_select">
                                            <option value="">Select Month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                        <span id="monthly_error" style="color: red; display: none;">Please select a
                                            month</span>
                                    </div>
                                </div>

                                <!-- Review Period for Six Monthly (initially hidden) -->
                                <div class="col-lg-6" id="review_period_six_monthly" style="display: none;">
                                    <div class="group-input">
                                        <label for="review_period">Review Period (Six Monthly)</label>
                                        <select name="review_period_six_monthly" id="review_period_six_monthly_select">
                                            <option value="">Select Period</option>
                                            <option value="January to June">January to June</option>
                                            <option value="July to December">July to December</option>
                                        </select>
                                        <span id="six_monthly_error" style="color: red; display: none;">Please select a
                                            six-month period</span>
                                    </div>
                                </div>

                                <script>
                                    function toggleReviewPeriod() {
                                        // Get the selected value of the "Type" dropdown
                                        let type = document.getElementById('summary_recommendation').value;

                                        // Get both the "Review Period" fields
                                        let reviewPeriodMonthlyField = document.getElementById('review_period_monthly');
                                        let reviewPeriodSixMonthlyField = document.getElementById('review_period_six_monthly');

                                        // Reset both fields and hide initially
                                        reviewPeriodMonthlyField.style.display = 'none';
                                        reviewPeriodSixMonthlyField.style.display = 'none';
                                        document.getElementById('review_period_monthly_select').removeAttribute('required');
                                        document.getElementById('review_period_six_monthly_select').removeAttribute('required');

                                        // Show appropriate field based on the selection
                                        if (type === 'Monthly') {
                                            reviewPeriodMonthlyField.style.display = 'block';
                                            document.getElementById('review_period_monthly_select').setAttribute('required', 'required');
                                        } else if (type === 'Six Monthly') {
                                            reviewPeriodSixMonthlyField.style.display = 'block';
                                            document.getElementById('review_period_six_monthly_select').setAttribute('required', 'required');
                                        }
                                    }

                                    // Form submission validation
                                    function validateForm() {
                                        let type = document.getElementById('summary_recommendation').value;
                                        let monthlySelect = document.getElementById('review_period_monthly_select').value;
                                        let sixMonthlySelect = document.getElementById('review_period_six_monthly_select').value;
                                        let valid = true;

                                        // Hide error messages initially
                                        document.getElementById('monthly_error').style.display = 'none';
                                        document.getElementById('six_monthly_error').style.display = 'none';

                                        // If "Monthly" is selected but no month is chosen
                                        if (type === 'Monthly' && !monthlySelect) {
                                            document.getElementById('monthly_error').style.display = 'block';
                                            valid = false;
                                        }

                                        // If "Six Monthly" is selected but no period is chosen
                                        if (type === 'Six Monthly' && !sixMonthlySelect) {
                                            document.getElementById('six_monthly_error').style.display = 'block';
                                            valid = false;
                                        }

                                        return valid;
                                    }

                                    // Add form submission handler
                                    document.querySelector('form').addEventListener('submit', function(e) {
                                        if (!validateForm()) {
                                            e.preventDefault(); // Prevent form submission if validation fails
                                        }
                                    });
                                </script>


                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled end date">Scheduled End Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="end_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="end_date_checkdate" name="end_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attendees">Attendess</label>
                                        <textarea name="attendees"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="agenda">
                                            Agenda<button type="button" name="agenda" id="meetingagenda">+</button>
                                        </label>
                                        <table class="table table-bordered" id="meeting_agenda_body">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%">Row #</th>
                                                    <th>Date</th>
                                                    <th>Topic</th>
                                                    <th>Responsible</th>
                                                    <th>Time Start</th>
                                                    <th>Time End</th>
                                                    <th>Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1"></td>

                                                    <td>
                                                        <div class="group-input new-date-data-field mb-0">
                                                            <div class="input-date ">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="agenda_date0" readonly
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="date[]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        class="hide-input"
                                                                        oninput="handleDateInput(this, `agenda_date0`);" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="topic[]"></td>
                                                    <td><input type="text" name="responsible[]"></td>
                                                    <td><input type="time" name="start_time[]"></td>
                                                    <td><input type="time" name="end_time[]"></td>
                                                    <td><input type="text" name="comment[]"></td>
                                                    <td> <button type="button" class="removeRow">remove
                                                        </button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Description">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">GI Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="inv_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="inv_attachment[]"
                                                    oninput="addMultipleFiles(this, 'inv_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            {{-- <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Actual Start Date">Actual Start Date</label>
                                        <input type="date" name="actual_start_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Actual End Date">Actual End Date</label>
                                        <input type="date" name="actual_end_date">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Meeting minutes">Meeting minutes</label>
                                        <textarea name="meeting_minute"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Decisions">Decisions</label>
                                        <textarea name="decision"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Geographic Information
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Zone">Zone</label>
                                        <input type="text" name="zone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Country">Country</label>
                                        <input type="text" name="country">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="City">City</label>
                                        <input type="text" name="city">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="State/District">State/District</label>
                                        <input type="text" name="state/district">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Site Name">Site Name</label>
                                        <input type="text" name="site_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Building">Building</label>
                                        <input type="text" name="building">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Floor">Floor</label>
                                        <input type="text" name="floor">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Room">Room</label>
                                        <input type="text" name="room">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action-item-details">
                                            Action Item Details<button type="button" name="action-item-details"
                                                id="action_item">+</button>
                                        </label>
                                        <table class="table table-bordered" id="action_item_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>CAPA Type (Corrective Action / Preventive Action)</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="text" name="capa_type[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="policies-procedure">Suitability of Policies and Procedure</label>
                                        <textarea name="policies-procedure"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="prevent-management-reviews">
                                            Status of Actions from Previous Management Reviews
                                            <button type="button" name="prevent-management-reviews"
                                                id="management_plan3">+</button>
                                        </label>
                                        <table class="table table-bordered" id="management_plan_details3">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Action Item Details</th>
                                                    <th>Owner</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="action_item_details[]"></td>
                                                <td> <select id="select-state" placeholder="Select..." name="owner[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="due_date[]"></td>
                                                <td><input type="text" name="status[]"></td>
                                                <td><input type="text" name="remarks[]"></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="recent-internal-audits">
                                            Outcome of Recent Internal Audits
                                            <button type="button" name="recent-internal-audits"
                                                id="external_plan4">+</button>
                                        </label>
                                        <table class="table table-bordered" id="external_plan_details4">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Month</th>
                                                    <th>Sites Audited</th>
                                                    <th>Critical</th>
                                                    <th>Major</th>
                                                    <th>Minor</th>
                                                    <th>Recommendation</th>
                                                    <th>CAPA Details if any</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="recent-external-audits">
                                            Outcome of Recent External Audits
                                            <button type="button" name="recent-external-audits"
                                                onclick="add7Input('recent-external-audits')">+</button>
                                        </label>
                                        <table class="table table-bordered" id="recent-external-audits">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Month</th>
                                                    <th>Sites Audited</th>
                                                    <th>Critical</th>
                                                    <th>Major</th>
                                                    <th>Minor</th>
                                                    <th>Recommendation</th>
                                                    <th>CAPA Details if any</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa-details">
                                            CAPA Details<button type="button" name="capa-details"
                                                id="capa_detail"">+</button>
                                        </label>
                                        <table class="table table-bordered" id="capa_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>CAPA Type (Corrective Action / Preventive Action)</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="text" name="capa_type[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root-cause-analysis-details">
                                            Root Cause Analysis Details<button type="button"
                                                name="root-cause-analysis-details" id="analysis_detail">+</button>
                                        </label>
                                        <table class="table table-bordered" id="analysis_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="lab-incident-details">
                                            Lab Incident Details<button type="button" name="lab-incident-details"
                                                id="incident_detail">+</button>
                                        </label>
                                        <table class="table table-bordered" id="incident_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-assessment-details">
                                            Risk Assessment Details<button type="button" name="risk-assessment-details"
                                                id="assessment_detail">+</button>
                                        </label>
                                        <table class="table table-bordered" id="assessment_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>Risk Category</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="text" name="risk_category[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="change-control-details">
                                            Change Control Details<button type="button" name="change-control-details"
                                                id="control_detail">+</button>
                                        </label>
                                        <table class="table table-bordered" id="control_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>Change Type</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="text" name="change_type[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="issue-other-than-audits">
                                            Issues other than Audits
                                            <button type="button" name="issue-other-than-audits"
                                                id="than_audit">+</button>
                                        </label>
                                        <table class="table table-bordered" id="than_audit_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Short Description</th>
                                                    <th>Severity (Critical / Major / Minor)</th>
                                                    <th>Site / Division</th>
                                                    <th>Issue Reporting Date</th>
                                                    <th>CAPA Details if any</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                    <th>Related Documents</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="short_desc[]"></td>
                                                <td><input type="text" name="severity[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="issue_reporting_date[]"></td>
                                                <td><input type="text" name="capa_details[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>
                                                <td><input type="text" name="related_documents[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="customer-personnel-feedback">
                                            Customer/Personnel Feedback
                                            <button type="button" name="customer-personnel-feedback"
                                                id="personnel_feedback">+</button>
                                        </label>
                                        <table class="table table-bordered" id="personnel_feedback_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Feedback From (Customer / Personnel)</th>
                                                    <th>Feedback Reporting Date</th>
                                                    <th>Site / Division</th>
                                                    <th>Short Description</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                    <th>Related Documents</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="feedback_from[]"></td>
                                                <td><input type="text" name="feedback_reporting_date[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="text" name="short_description[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>
                                                <td><input type="text" name="related_documents[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="effectiveness-check-details">
                                            Effectiveness Check Details
                                            <button type="button" name="effectiveness-check-details"
                                                id="check_detail">+</button>
                                        </label>
                                        <table class="table table-bordered" id="check_detail_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Record Number</th>
                                                    <th>Short Description</th>
                                                    <th>Date Opened</th>
                                                    <th>Site / Division</th>
                                                    <th>Date Due</th>
                                                    <th>Current Status</th>
                                                    <th>Person Responsible</th>
                                                    <th>Date Closed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="record[]"></td>
                                                <td><input type="text" name="short_description[]"></td>
                                                <td><input type="date" name="date_opened[]"></td>
                                                <td><input type="text" name="site[]"></td>
                                                <td><input type="date" name="date_due[]"></td>
                                                <td><input type="text" name="current_status[]"></td>
                                                <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible_person[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><input type="date" name="date_closed[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="psummary-recommendations">Summary & Recommendations</label>
                                        <textarea name="psummary-recommendations"></textarea>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="group-input">
                                <label for="Operations">
                                    QA review comment
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-operations-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="Operations"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA Head review Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_file_attach"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="qa_file_attach[]"
                                                oninput="addMultipleFiles(this, 'qa_file_attach')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="group-input">
                                <label for="requirement_products_services">
                                    Requirements for Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-requirement_products_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="requirement_products_services"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="design_development_product_services">
                                    Design and Development of Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-design_development_product_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="design_development_product_services"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="control_externally_provide_services">
                                    Control of Externally Provided Processes, Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-control_externally_provide_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="control_externally_provide_services"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="production_service_provision">
                                    Production and Service Provision
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-production_service_provision-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="production_service_provision"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="release_product_services">
                                    Release of Products and Services
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-release_product_services-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="release_product_services"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="control_nonconforming_outputs">
                                    Control of Non-conforming Outputs
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-control_nonconforming_outputs-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="control_nonconforming_outputs"></textarea>
                            </div> --}}
                            {{-- <div class="group-input">
                                <label for="performance_evaluation">
                                    Performance Evaluation
                                    <button type="button"
                                        onclick="addPerformanceEvoluation('performance_evaluation')">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-performance_evaluation-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <table class="table table-bordered" id="performance_evaluation">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Row #</th>
                                            <th>Monitoring</th>
                                            <th>Measurement</th>
                                            <th>Analysis</th>
                                            <th>Evalutaion</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="serial_number[]" value="1">
                                            </td>
                                            <td><input type="text" name="monitoring[]"></td>
                                            <td><input type="text" name="measurement[]"></td>
                                            <td><input type="text" name="analysis[]"></td>
                                            <td><input type="text" name="evaluation[]"></td>
                                            <td> <button type="button" class="removeRowBtnat">remove
                                                </button></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div> --}}
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled Start Date">Meeting Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="external_supplier_performance" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="external_supplier_performance_checkdate"
                                                name="external_supplier_performance"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'external_supplier_performance');checkDate('external_supplier_performance_checkdate','customer_satisfaction_level_checkdate')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled end date">Meeting End Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="customer_satisfaction_level" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="customer_satisfaction_level_checkdate"
                                                name="customer_satisfaction_level"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'customer_satisfaction_level');checkDate('external_supplier_performance_checkdate','customer_satisfaction_level_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Meeting Start Time</label>
                                        <input id="start-time" type="time" name="budget_estimates">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Meeting End Time</label>
                                        <input id="end-time" type="time" name="completion_of_previous_tasks">
                                    </div>
                                </div>


                                <script>
                                    document.getElementById('start-time').addEventListener('input', function() {
                                        let startTime = this.value;
                                        if (startTime) {
                                            // Set the minimum selectable time for the end time
                                            document.getElementById('end-time').min = startTime;
                                        }
                                    });
                                </script>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="management_review_participants">
                                            Management Review Participants
                                            <button type="button"
                                                onclick="addManagementReviewParticipants('management_review_participants')">+</button>
                                        </label>
                                        <div class="instruction">
                                            <small class="text-primary">
                                                Refer Attached Performance Evaluation Grid
                                            </small>
                                        </div>
                                        <table class="table table-bordered" id="management_review_participants">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%">Row #</th>
                                                    <th>Invited Person</th>
                                                    <th>Designation</th>
                                                    <th>Department</th>
                                                    <th>Meeting Attended</th>
                                                    <th>Designee Name</th>
                                                    <th>Designee Department/Designation</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1"></td>
                                                    <td><input type="text" name="invited_Person[]"></td>
                                                    <td><input type="text" name="designee[]"></td>
                                                    <td><input type="text" name="department[]"></td>
                                                    <td><input type="text" name="meeting_Attended[]"></td>
                                                    <td><input type="text" name="designee_Name[]"></td>
                                                    <td><input type="text" name="designee_Department[]"></td>
                                                    <td><input type="text" name="remarks[]"></td>
                                                    <td> <button type="button" class="removeRowBtn">remove
                                                        </button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            {{-- <div class="group-input">
                                <label for="risk_opportunities">Risk & Opportunities</label>
                                <textarea name="risk_opportunities"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="external_supplier_performance">External Supplier Performance</label>
                                <textarea name="external_supplier_performance"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="customer_satisfaction_level">Customer Satisfaction Level</label>
                                <textarea name="customer_satisfaction_level"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="budget_estimates">Budget Estimates</label>
                                <textarea name="budget_estimates"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="completion_of_previous_tasks">Completion of Previous Tasks</label>
                                <textarea name="completion_of_previous_tasks"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="production">Production</label>
                                <textarea name="production_new"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="plans">Plans</label>
                                <textarea name="plans_new"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="forecast">Forecast</label>
                                <textarea name="forecast_new"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="additional_suport_required">Any Additional Support Required</label>
                                <textarea name="additional_suport_required"></textarea>
                            </div> --}}
                            {{-- <div class="group-input">
                                <label for="file_attchment_if_any">File Attachment, if any</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attchment_if_any"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile"
                                            name="file_attchment_if_any[]"
                                            oninput="addMultipleFiles(this, 'file_attchment_if_any')" multiple>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Production (Tablet/Capsule/Powder)
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

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Tablet"> Production Tablet</label>
                                        <select name="Production_Table_Review" id="Production_Table_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet notification">Production Tablet Person</label>
                                        <select name="Production_Table_Person" class="Production_Table_Person"
                                            id="Production_Table_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet assessment">Impact Assessment (By Production
                                            Tablet)</label>
                                        <textarea class="summernote Production_Table_Assessment" name="Production_Table_Assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet feedback">Production Tablet Feedback</label>
                                        <textarea class="summernote Production_Table_Feedback" name="Production_Table_Feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet attachment">Production Tablet Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Production_Table_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Production_Table_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed By">Production Tablet Completed By</label>
                                        <input readonly type="text" name="Production_Table_By"
                                            id="Production_Table_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input ">
                                        <label for="Production Tablet Completed On">Production Tablet Completed On</label>
                                        <input type="date" id="Production_Table_On" name="Production_Table_On">
                                    </div>
                                </div>

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

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Injection"> Production Injection </label>
                                        <select name="Production_Injection_Review" id="Production_Injection_Review"
                                            disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection notification">Production Injection Person</label>
                                        <select class="Production_Injection_Person" id="Production_Injection_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection assessment">Impact Assessment (By Production
                                            Injection)</label>
                                        <textarea class="summernote Production_Injection_Assessment" name="Production_Injection_Assessment"
                                            id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection feedback">Production Injection Feedback </label>
                                        <textarea class="summernote Production_Injection_Feedback" name="Production_Injection_Feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection attachment">Production Injection
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Production_Injection_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Production_Injection_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection Completed By">Production Injection Completed
                                            By</label>
                                        <input readonly type="text" name="Production_Injection_By"
                                            id="Production_Injection_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input ">
                                        <label for="Production Injection Completed On">Production Injection Completed
                                            On</label>
                                        <input type="date"id="Production_Injection_On" name="Production_Injection_On">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Research & Development
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research Development"> Research Development Required ?</label>
                                        <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review"
                                            disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development notification">Research Development Person</label>
                                        <select name="ResearchDevelopmentStore_Person" class="ResearchDevelopment_Person"
                                            id="ResearchDevelopment_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development assessment">Impact Assessment (By Research
                                            Development)</label>
                                        <textarea class="summernote ResearchDevelopment_assessment" name="ResearchDevelopment_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development feedback">Research Development Feedback</label>
                                        <textarea class="summernote ResearchDevelopment_feedback" name="ResearchDevelopment_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development attachment">Research Development
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ResearchDevelopment_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="ResearchDevelopment_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed By">Research Development Completed
                                            By</label>
                                        <input readonly type="text" name="ResearchDevelopment_by"
                                            id="ResearchDevelopment_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input ">
                                        <label for="Research Development Completed On">Research Development Complete
                                            On</label>
                                        <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Human Resource
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Administration Review Required">Human Resource
                                            Required ?</label>
                                        <select name="Human_Resource_review" id="Human_Resource_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Person"> Human Resource Person</label>
                                        <select name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Impact Assessment9">Impact Assessment (By Human Resource )</label>
                                        <textarea class="" name="Human_Resource_assessment" id="summernote-35"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource Feedback</label>
                                        <textarea class="" name="Human_Resource_feedback" id="summernote-36"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Human Resource
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource Review Completed
                                            By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field human_resources">
                                    <div class="group-input input-date">
                                        <label for="Administration Review Completed On">Human Resource Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Human_Resource_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Human_Resource_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Human_Resource_on')" />
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Corporate Quality Assurance
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance"> Corporate Quality Assurance Required
                                            ?</label>
                                        <select name="CorporateQualityAssurance_Review"
                                            id="CorporateQualityAssurance_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance notification">Corporate Quality Assurance
                                            Person</label>
                                        <select name="CorporateQualityAssurance_Person"
                                            class="CorporateQualityAssurance_Person"
                                            id="CorporateQualityAssurance_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate
                                            Quality Assurance)</label>
                                        <textarea class="summernote CorporateQualityAssurance_assessment" readonly name="CorporateQualityAssurance_assessment"
                                            id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance
                                            Feedback</label>
                                        <textarea class="summernote CorporateQualityAssurance_feedback" name="CorporateQualityAssurance_feedback"
                                            id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="CorporateQualityAssurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance
                                            Completed By</label>
                                        <input readonly type="text" name="CorporateQualityAssurance_by"
                                            id="CorporateQualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 CQA">
                                    <div class="group-input ">
                                        <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance
                                            Completed On</label>
                                        <input type="date"id="CorporateQualityAssurance_on"
                                            name="CorporateQualityAssurance_on">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Stores
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Store"> Store</label>
                                        <select name="Store_Review" id="Store_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 23, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store notification">Store Person</label>
                                        <select name="Store_Person" class="Store_Person" id="Store_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                        <textarea class="summernote Store_assessment" name="Store_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store feedback">Store Feedback</label>
                                        <textarea class="summernote Store_feedback" name="Store_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Store attachment">Store Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Store_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Store_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store Completed By">Store Completed By</label>
                                        <input readonly type="text" name="Store_by" id="Store_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 store">
                                    <div class="group-input ">
                                        <label for="Store Completed On">Store Completed On</label>
                                        <input type="date"id="Store_on" name="Store_on">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="sub-head">
                                    Engineering
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Required">Engineering Review Required ?</label>
                                        <select name="Engineering_review" id="Engineering_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Person">Engineering Person</label>
                                        <select name="Engineering_person" id="Engineering_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Engineering_assessment" id="summernote-25">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="productionfeedback">Engineering Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Engineering_feedback" id="summernote-26">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 engineering">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Engineering_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input type="text" name="Engineering_by" id="Engineering_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field engineering">
                                    <div class="group-input input-date">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Engineering_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Engineering_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Engineering_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>
                                <div class="sub-head">
                                    Regulatory Affair
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RegulatoryAffair"> Regulatory Affair Required ?</label>
                                        <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair notification">Regulatory Affair Person</label>
                                        <select name="RegulatoryAffair_Person" class="RegulatoryAffair_Person"
                                            id="RegulatoryAffair_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                            Affair)</label>
                                        <textarea class="summernote RegulatoryAffair_assessment" name="RegulatoryAffair_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                        <textarea class="summernote RegulatoryAffair_feedback" name="RegulatoryAffair_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="RegulatoryAffair_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="RegulatoryAffair_attachment[]"
                                                    oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed By">Regulatory Affair Completed By</label>
                                        <input readonly type="text" name="RegulatoryAffair_by"
                                            id="RegulatoryAffair_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input ">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Completed On</label>
                                        <input type="date"id="RegulatoryAffair_on" name="RegulatoryAffair_on">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Assurance Review Required ?</label>
                                        <select name="Quality_Assurance" id="QualityAssurance_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person</label>
                                        <select name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="QualityAssurance_assessment" id="summernote-23">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="QualityAssurance_feedback" id="summernote-24">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Assurance_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
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
                                        <input type="text" name="QualityAssurance_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field quality_assurance">
                                    <div class="group-input input-date">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="QualityAssurance_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="QualityAssurance_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                        </div>
                                    </div>
                                </div>



                                <div class="sub-head">
                                    Production (Liquid/Ointment)
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Liquid"> Production Liquid </label>
                                        <select name="ProductionLiquid_Review" id="ProductionLiquid_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid notification">Production Liquid Person</label>
                                        <select name="ProductionLiquid_Person" class="ProductionLiquid_Person"
                                            id="ProductionLiquid_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid assessment">Impact Assessment (By Production
                                            Liquid)</label>
                                        <textarea class="summernote ProductionLiquid_assessment" name="ProductionLiquid_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                        <textarea class="summernote ProductionLiquid_feedback" name="ProductionLiquid_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid attachment">Production Liquid Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div> ProductionLiquid_attachment
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ProductionLiquid_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="ProductionLiquid_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed By">Production Liquid Completed By</label>
                                        <input readonly type="text" name="ProductionLiquid_by"
                                            id="ProductionLiquid_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input ">
                                        <label for="Production Liquid Completed On">Production Liquid Completed On</label>
                                        <input type="date" id="ProductionLiquid_on" name="ProductionLiquid_on">
                                    </div>
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
                                <div class="sub-head">
                                    Quality Control
                                </div>
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required
                                            ?</label>
                                        <select name="Quality_review" id="Quality_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select name="Quality_Control_Person" id="Quality_Control_Person" disabled>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                        <textarea class="" name="Quality_Control_assessment" id="summernote-21">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback</label>
                                        <textarea class="" name="Quality_Control_feedback" id="summernote-22">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Control_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Control Review Completed By</label>
                                        <input type="text" name="QualityAssurance__by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field quality_control">
                                    <div class="group-input input-date">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Quality_Control_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Quality_Control_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Quality_Control_on')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Microbiology
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology"> Microbiology Required ?</label>
                                        <select name="Microbiology_Review" id="Microbiology_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology notification">Microbiology Person</label>
                                        <select name="Microbiology_Person" class="Microbiology_Person"
                                            id="Microbiology_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                        <textarea class="summernote Microbiology_assessment" name="Microbiology_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                        <textarea class="summernote Microbiology_feedback" name="Microbiology_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology attachment">Microbiology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Microbiology_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Microbiology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology Completed By">Microbiology Completed By</label>
                                        <input readonly type="text" name="Microbiology_by" id="Microbiology_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input ">
                                        <label for="Microbiology Completed On">Microbiology Completed On</label>
                                        <input type="date" id="Microbiology_on" name="Microbiology_on">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Safety
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Safety Review Required
                                            ?</label>
                                        <select name="Environment_Health_review" id="Environment_Health_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Person"> Safety Person</label>
                                        <select name="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Safety)</label>
                                        <textarea class="" name="Health_Safety_assessment" id="summernote-33">
                                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Safety Feedback</label>
                                        <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Safety Review Completed
                                            By</label>
                                        <input type="text" name="Environment_Health_Safety_by"
                                            id="Environment_Health_Safety_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field environmental_health">
                                    <div class="group-input input-date">
                                        <label for="Safety Review Completed On">Safety Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Environment_Health_Safety_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Environment_Health_Safety_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Contract Giver
                                </div>
                                <script>
                                    $(document).ready(function() {
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
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Contract Giver"> Contract Giver Required ? </label>
                                        <select name="ContractGiver_Review" id="ContractGiver_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Contract Giver notification">Contract Giver Person</label>
                                        <select name="ContractGiver_Person" class="ContractGiver_Person"
                                            id="ContractGiver_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver assessment">Impact Assessment (By Contract
                                            Giver)</label>
                                        <textarea class="summernote ContractGiver_assessment" name="ContractGiver_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                        <textarea class="summernote ContractGiver_feedback" name="ContractGiver_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ContractGiver_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="ContractGiver_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed By">Contract Giver Completed
                                            By</label>
                                        <input readonly type="text" name="ContractGiver_by" id="ContractGiver_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 store">
                                    <div class="group-input ">
                                        <label for="Contract Giver Completed On">Contract Giver Completed On</label>
                                        <input type="date"id="ContractGiver_on" name="ContractGiver_on">
                                    </div>
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
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Review Required ?</label>
                                        <select name="Other1_review" id="Other1_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 34, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 other1_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Person</label>
                                        <select name="Other1_person" id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Department</label>
                                        <select name="Other1_Department_person" id="Other1_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Regulatory Affairs">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 1)</label>
                                        <textarea class="" name="Other1_assessment" id="summernote-41">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Feedback</label>
                                        <textarea class="" name="Other1_feedback" id="summernote-42">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other1_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" id="Other1_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field other1_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other1_on" name="Other1_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                        </div>
                                    </div>
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
                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Review Required ?</label>
                                        <select name="Other2_review" id="Other2_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 35, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Person</label>
                                        <select name="Other2_person" id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Department</label>
                                        <select name="Other2_Department_person" id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                        <textarea class="" name="Other2_Assessment" id="summernote-43">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea class="" name="Other2_feedback" id="summernote-44">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other2_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other2_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other2_on" name="Other2_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other2_on')" /> --}}
                                        </div>
                                    </div>
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
                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Review Required ?</label>
                                        <select name="Other3_review" id="Other3_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 36, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Person</label>
                                        <select name="Other3_person" id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews ">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Department</label>
                                        <select name="Other3_Department_person" id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 3)</label>
                                        <textarea class="" name="Other3_Assessment" id="summernote-45">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Feedback</label>
                                        <textarea class="" name="Other3_feedback" id="summernote-46">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other3_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other3_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On3">Other's 3 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other3_on" name="Other3_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other3_on')" /> --}}
                                        </div>
                                    </div>
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
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4"> Other's 4 Review Required ?</label>
                                        <select name="Other4_review" id="Other4_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 37, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person</label>
                                        <select name="Other4_person" id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department</label>
                                        <select name="Other4_Department_person" id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4)</label>
                                        <textarea class="" name="Other4_Assessment" id="summernote-47">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback</label>
                                        <textarea class="" name="Other4_feedback" id="summernote-48">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other4_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other4_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other4_on" name="Other4_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other4_on')" /> --}}
                                        </div>
                                    </div>
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
                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5"> Other's 5 Review Required ?</label>
                                        <select name="Other5_review" id="Other5_review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 38, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person</label>
                                        <select name="Other5_person" id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department</label>
                                        <select name="Other5_Department_person" id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 5)</label>
                                        <textarea class="" name="Other5_Assessment" id="summernote-49">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea class="" name="Other5_feedback" id="summernote-50">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other5_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other5_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other5_on" name="Other5_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other5_on')" /> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton"
                                    style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton">Save</button>
                                {{-- <a href="/rcms/qms-dashboard"
                                    style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" class="backButton">Back</button>
                                </a> --}}
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                                                                                                class="button  launch_extension" data-bs-toggle="modal"
                                                                                                                data-bs-target="#launch_extension">
                                                                                                                Launch Extension
                                                                                                            </a> -->
                                {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>

                        </div>
                    </div>
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">

                            <div class="group-input">
                                <label for="forecast_new">
                                    CFT HOD review Comment
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-forecast_new-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="forecast_new"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">CFT HOD review Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="cft_hod_attach"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="cft_hod_attach[]"
                                                oninput="addMultipleFiles(this, 'cft_hod_attach')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">

                            <div class="group-input">
                                <label for="additional_suport_required">
                                    QA verification Comment
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-additional_suport_required-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="additional_suport_required"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA Verification Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_verification_file"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="qa_verification_file[]"
                                                oninput="addMultipleFiles(this, 'qa_verification_file')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            {{-- <div class="group-input">
                                <label for="action_item_details">
                                    Action Item Details<button type="button" name="action_item_details" id="action_item"
                                        onclick="addActionItemDetails('action_item_details')">+</button>
                                </label>
                                <table class="table table-bordered" id="action_item_details">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Row #</th>
                                            <th>Short Description</th>
                                            <th>Due Date</th>
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            <th>Current Status</th>
                                            <th>Date Closed</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="serial_number[]" value="1">
                                        </td>
                                        <td><input type="text" name="short_desc[]"></td>
                                        <td>
                                            <div class="group-input new-date-data-field mb-0">
                                                <div class="input-date ">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="date_due0" readonly
                                                            placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="date_due[]" id="date_due0_checkdate"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            class="hide-input"
                                                            oninput="handleDateInput(this, `date_due0`);checkDate('date_due0_checkdate','date_closed0_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><input type="text" name="site[]"></td>
                                        <td>
                                            <select id="select-state" placeholder="Select..."
                                                name="responsible_person[]">
                                                <option value="">Select a value</option>
                                                @foreach ($users as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="current_status[]"></td>
                                        <td>
                                            <div class="group-input new-date-data-field mb-0">
                                                <div class="input-date ">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="date_closed0" readonly
                                                            placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="date_closed[]"
                                                            id="date_closed0_checkdate"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            class="hide-input"
                                                            oninput="handleDateInput(this, `date_closed0`);checkDate('date_due0_checkdate','date_closed0_checkdate')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>


                                        <td><input type="text" name="remark[]"></td>
                                        <td> <button type="button" class="removeBtnaid">remove
                                            </button></td>


                                    </tbody>
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="capa-details">
                                    CAPA Details<button type="button" name="capa-details" id="capa_detail">+</button>
                                </label>
                                <table class="table table-bordered" id="capa_detail_details">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Row #</th>
                                            <th>CAPA Details</th>
                                            <th>CAPA Type</th>
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            <th>Current Status</th>
                                            <th>Date Closed</th>
                                            <th>Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="serial_number[]" value="1">
                                        </td>
                                        <td><input type="text" name="Details[]"></td>
                                        <td>
                                            <select id="select-state" placeholder="Select..." name="capa_type[]">
                                                <option value="">Select a value</option>
                                                <option value="corrective">Corrective Action</option>
                                                <option value="preventive">Preventive Action</option>
                                                <option value="corrective_preventive">Corrective & Preventive Action
                                                </option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="site2[]"></td>
                                        <td>
                                            <select id="select-state" placeholder="Select..."
                                                name="responsible_person2[]">
                                                <option value="">Select a value</option>
                                                @foreach ($users as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="current_status2[]"></td>
                                        <td>
                                            <div class="group-input new-date-data-field mb-0">
                                                <div class="input-date ">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="date_closed_capa1" readonly
                                                            placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="date_closed2[]"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            class="hide-input"
                                                            oninput="handleDateInput(this, `date_closed_capa1`);" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>


                                        <td><input type="text" name="remark2[]"></td>
                                        <td> <button type="button" class="removeBtn">remove
                                            </button></td>
                                    </tbody>
                                </table>
                            </div> --}}

                            <div class="new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="next_managment_review_date">Next Management Review Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="next_managment_review_date" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="next_managment_review_date"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            class="hide-input {{ (isset($data->stage) and $data->stage == 0) || (isset($data->stage) and $data->stage == 3) ? 'disabled' : '' }}
                                         min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            oninput="handleDateInput(this, 'next_managment_review_date')" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="group-input">
                                <label for="summary_recommendation">Summary & Recommendation</label>
                                <textarea name="summary_recommendation"></textarea>
                            </div> --}}
                            {{-- <div class="group-input">
                                <label for="conclusion">Conclusion</label>
                                <textarea name="conclusion_new"></textarea>
                            </div> --}}
                            <div class="group-input">
                                <label for="closure-attachments">Closure Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="closure_attachments"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="closure_attachments[]"
                                            oninput="addMultipleFiles(this, 'closure_attachments')" multiple>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="sub-head">
                                Extension Justification
                            </div>
                            <div class="group-input">
                                <label for="due_date_extension">Due Date Extension Justification</label>
                                <div><small class="text-primary">Please Mention justification if due date is
                                        crossed</small></div>
                                <textarea name="due_date_extension"></textarea>
                            </div> --}}
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                {{-- <button type="submit">Submit1</button> --}}
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"
                                        href="{{ url('dashboard') }}"> Exit </a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Submited By</label>
                                        <div class="static">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Submited On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed On">Completed On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">QA Head Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">QA Head Review Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Meeting and Summary Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Meeting and Summary Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">All AI Completed by Respective Department By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">All AI Completed by Respective Department On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">HOD Final Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">HOD Final Review Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">QA Verification Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">QA Verification Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Approved By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Approved On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Completed By">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>


                            </div>

                            <div class="button-block">
                                {{-- <button type="submit" class="saveButton">Save</button> --}}
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                {{-- <button type="submit">Submit</button> --}}
                                <button type="button"> <a class="text-white" href="{{ url('dashboard') }}"> Exit
                                    </a>
                                </button>
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
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>

    <script>
        $(document).on('click', '.removeBtnaid', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).on('click', '.removeRowBtnat', function() {
            $(this).closest('tr').remove();
        })
    </script>

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee'
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
        // JavaScript
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>

    {{--  <script>
        // Pass the users data to JavaScript using json_encode
        var users = @json($users);
        console.log(users);

        function add9Input(tableId, users) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='text'>";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text'>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='date'>";

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='text'>";

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML = "<input type='date'>";

            var cell8 = newRow.insertCell(7);
            if (users && users.length > 0) {
                cell8.innerHTML = generateUserDropdown(users);
            } else {
                cell8.innerHTML = "No users available";
            }

            var cell9 = newRow.insertCell(8);
            cell9.innerHTML = "<input type='text'>";

            var cell10 = newRow.insertCell(9);
            cell10.innerHTML = "<input type='date'>";

            for (var i = 0; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i + 1;
            }
        }

        function generateUserDropdown(users) {
            var html = "<select name='user[]'>" +
                       "<option value=''>Select a value</option>";

            for (var i = 0; i < users.length; i++) {
                html += "<option value='" + users[i].id + "'>" + users[i].name + "</option>";
            }

            html += "</select>";

            return html;
        }
    </script>  --}}


    <script>
        function addActionItemDetails(tableId) {
            var users = @json($users);
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='short_desc[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_due' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_due[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="date_due' +
                currentRowCount + '_checkdate"  class="hide-input" oninput="handleDateInput(this, `date_due' +
            currentRowCount + '`);checkDate(`date_due' + currentRowCount + '_checkdate`,`date_closed' +
            currentRowCount + '_checkdate`)" /></div></div></div></td>';

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='site[]'>";

            var cell5 = newRow.insertCell(4);
            var userHtml = '<select name="responsible_person[]"><option value="">-- Select --</option>';
            for (var i = 0; i < users.length; i++) {
                userHtml += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
            }
            userHtml += '</select>';

            cell5.innerHTML = userHtml;

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='text' name='current_status[]'>";

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML =
                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_closed' +
                currentRowCount +
                '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date_closed' +
                currentRowCount + '_checkdate" class="hide-input" oninput="handleDateInput(this, `date_closed' +
            currentRowCount + '`);checkDate(`date_due' + currentRowCount + '_checkdate`,`date_closed' +
            currentRowCount + '_checkdate`)" /></div></div></div></td>';

            var cell8 = newRow.insertCell(7);
            cell8.innerHTML = "<input type='text' name='remark[]'>";

            var cell9 = newRow.insertCell(8);
            cell9.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }

        $(document).ready(function() {

            $('#action_plan2').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#action_plan_details2 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#management_review').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="action_item_details[]">' +
                        '<td><input type="text" name="owner[]">' +
                        '<td><input type="date" name="due_date[]">' +
                        '<td><input type="text" name="status[]">' +
                        '<td><input type="text" name="remarks[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#management_review_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#management_plan3').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +

                        '<td><select name="owner[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#management_plan_details3 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#capa_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +

                        '<td><input type="text" name="Details[]">' +
                        '<td><select id="select-state" placeholder="Select..." name="capa_type[]">' +
                        '<option value="">Select a value</option>' +
                        '<option value="corrective">Corrective Action</option>' +
                        '<option value="preventive">Preventive Action</option>' +
                        '<option value="corrective_preventive">Corrective & Preventive Action</option>' +
                        '</select></td>' +

                        '<td><input type="text" name="site2[]">' +
                        '<td><select name="responsible_person2[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '<td><input type="text" name="current_status2[]">' +

                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="date_closed_capa' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed2[]"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `date_closed_capa' +
                    serialNumber + '`)" /></div></div></div></td>' +

                        '<td><input type="text" name="remark2[]"></td>' +

                        '<td><button type="text" class="removeRowBtn" name="Action[]" readonly>Remove</button></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#capa_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#capa_plan4').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#capa_plan_details4 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#analysis_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="record[]"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="date" name="date_opened[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#analysis_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#analysis_plan5').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#analysis_plan_details5 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#incident_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="record[]"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="date" name="date_opened[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#incident_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#incident_plan6').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#incident_plan_details6 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#assessment_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="record[]"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="text" name="risk_category[]">' +
                        '<td><input type="date" name="date_opened[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#assessment_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#assessment_plan7').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#assessment_plan_details7 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#control_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="record[]"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="text" name="change_type[]">' +
                        '<td><input type="date" name="date_opened[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#control_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#control_plan8').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#control_plan_details8 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#external_bodie').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="external_body[]"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="text" name="type[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="assessment_date[]">' +
                        '<td><input type="text" name="assessment_details[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +
                        '<td><input type="text" name="related_documents[]"></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#external_bodie_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#external_plan9').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#external_plan_details9 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#than_audit').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="short_desc[]">' +
                        '<td><input type="text" name="severity[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="issue_reporting_date[]">' +
                        '<td><input type="text" name="capa_details[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +
                        '<td><input type="text" name="related_documents[]"></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#than_audit_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#than_plan10').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#than_plan_details10 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        function addPerformanceEvoluation(tableId) {
            var table = document.getElementById(tableId);
            var currentRowCount = table.rows.length;
            var newRow = table.insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = currentRowCount;

            var cell2 = newRow.insertCell(1);
            cell2.innerHTML = "<input type='text' name='monitoring[]'>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<input type='text' name='measurement[]'>";

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='analysis[]'>";

            var cell5 = newRow.insertCell(4);
            cell5.innerHTML = "<input type='text' name='evaluation[]'>";

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

            for (var i = 1; i < currentRowCount; i++) {
                var row = table.rows[i];
                row.cells[0].innerHTML = i;
            }
        }


        $(document).ready(function() {

            $('#meetingagenda').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        // '<td><input type="date" name="date[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="agenda_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, `agenda_date' +
                    serialNumber + '`)" /></div></div></div></td>' +
                        '<td><input type="text" name="topic[]"></td>' +
                        '<td><input type="text" name="responsible[]"></td>' +
                        '<td><input type="time" name="start_time[]"></td>' +
                        '<td><input type="time" name="end_time[]"></td>' +
                        '<td><input type="text" name="comment[]"></td>' +
                        '<td><button type="text" class="removeRowBtn" name="Action[]" readonly>Remove</button></td>' +
                        '</tr>';
                    return html;
                }
                var tableBody = $('#meeting_agenda_body tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });

            $('#personnel_feedback').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="feedback_from[]">' +
                        '<td><input type="text" name="feedback_reporting_date[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="text" name="short_description[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +
                        '<td><input type="text" name="related_documents[]"></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#personnel_feedback_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#personnel_plan11').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input  disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#personnel_plan_details11 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#check_detail ').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="record[]">' +
                        '<td><input type="text" name="short_description[]">' +
                        '<td><input type="date" name="date_opened[]">' +
                        '<td><input type="text" name="site[]">' +
                        '<td><input type="date" name="date_due[]">' +
                        '<td><input type="text" name="current_status[]">' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="date" name="date_closed[]"></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#check_detail_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $('#check_plan12').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="mitigation_steps[]"></td>' +
                        '<td><input type="date" name="deadline2[]"></td>' +
                        '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        '<td><input type="text" name="status[]"></td>' +
                        '<td><input type="text" name="remark[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#check_plan_details12 tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
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
