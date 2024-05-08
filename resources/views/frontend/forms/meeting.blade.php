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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Operational Planning & Control</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Meetings & Summary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Signatures</button>
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
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date" >
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                               
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Due</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b></label>
                                        <select name="initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('initiator_Group') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('initiator_Group') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="CQC" @if (old('initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('initiator_Group') == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG" @if (old('initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('initiator_Group') == 'CL') selected @endif>Central
                                                Laboratory</option>

                                            <option value="TT" @if (old('initiator_Group') == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA" @if (old('initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code"><b>Initiator Group Code</b></label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" disabled>
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
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Priority Level">Priority Level</label>
                                        <select name="priority_level">
                                            <option value="">Select Priority Level</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                </div>
                             
                                
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled Start Date">Scheduled Start Date</label>                                        
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="start_date_checkdate"  name="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')"/>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled end date">Scheduled End Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="end_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="end_date_checkdate" name="end_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
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
                                                    <th>Row #</th>
                                                    <th>Date</th>
                                                    <th>Topic</th>
                                                    <th>Responsible</th>
                                                    <th>Time Start</th>
                                                    <th>Time End</th>
                                                    <th>Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]" value="1"></td>
                                               
                                           <td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee">
                                                        <input type="text" id="agenda_date0" readonly placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="date[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                        oninput="handleDateInput(this, `agenda_date0`);" /></div></div></div></td>                                       
                                                    <td><input type="text" name="topic[]"></td>
                                                    <td><input type="text" name="responsible[]"></td>
                                                    <td><input type="time" name="start_time[]"></td>
                                                    <td><input type="time" name="end_time[]"></td>
                                                    <td><input type="text" name="comment[]"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Description">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
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
                                                <th>Row #</th>
                                                <th>Invited Person</th>
                                                <th>Designee</th>
                                                <th>Department</th>
                                                <th>Meeting Attended</th>
                                                <th>Designee Name</th>
                                                <th>Designee Department/Designation</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><input type="text" name="serial_number[]" value="1"></td>
                                            <td><input type="text" name="invited_Person[]"></td>
                                            <td><input type="text" name="designee[]"></td>
                                            <td><input type="text" name="department[]"></td>
                                            <td><input type="text" name="meeting_Attended[]"></td>
                                            <td><input type="text" name="designee_Name[]"></td>
                                            <td><input type="text" name="designee_Department[]"></td>
                                            <td><input type="text" name="remarks[]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">File Attachment</label>
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
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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
                                    Operations
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-operations-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <textarea name="Operations"></textarea>
                            </div>
                            <div class="group-input">
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
                            </div>
                            <div class="group-input">
                                <label for="performance_evaluation">
                                    Performance Evaluation
                                    <button type="button" onclick="addPerformanceEvoluation('performance_evaluation')">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#management-review-performance_evaluation-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <table class="table table-bordered" id="performance_evaluation">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Monitoring</th>
                                            <th>Measurement</th>
                                            <th>Analysis</th>
                                            <th>Evalutaion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="serial_number[]" value="1" ></td>
                                            {{-- ignore   --}} <td><input type="text" name="monitoring[]"></td>
                                            <td><input type="text" name="measurement[]"></td>
                                            <td><input type="text" name="analysis[]"></td>
                                            <td><input type="text" name="evaluation[]"></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
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
                            </div>
                            <div class="group-input">
                                <label for="file_attchment_if_any">File Attachment, if any</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attchment_if_any"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile"
                                            name="file_attchment_if_any[]"{{-- ignore --}}
                                            oninput="addMultipleFiles(this, 'file_attchment_if_any')" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="action_item_details">
                                    Action Item Details<button type="button" name="action_item_details"
                                        id="action_item" onclick="addActionItemDetails('action_item_details')" >+</button>
                                </label><table class="table table-bordered" id="action_item_details">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Short Description</th>
                                            <th>Due Date</th>
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            <th>Current Status</th>
                                            <th>Date Closed</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="serial_number[]" value="1">
                                        </td>
                                        <td><input type="text" name="short_desc[]"></td>
                                        <td><div class="group-input new-date-data-field mb-0">
                                            <div class="input-date "><div
                                             class="calenderauditee">
                                            <input type="text" id="date_due0" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_due[]" id="date_due0_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                            oninput="handleDateInput(this, `date_due0`);checkDate('date_due0_checkdate','date_closed0_checkdate')" /></div></div></div></td>
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
                                        <td><div class="group-input new-date-data-field mb-0">
                                            <div class="input-date "><div
                                             class="calenderauditee">
                                            <input type="text" id="date_closed0" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_closed[]" id="date_closed0_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                            oninput="handleDateInput(this, `date_closed0`);checkDate('date_due0_checkdate','date_closed0_checkdate')" /></div>
                                        </div>
                                    </div>
                                </td>


                                        <td><input type="text" name="remark[]"></td>
                                         <!-- <td><input type="text" name="capa_type[]"></td> 
                                        {{-- <td><input type="date" name="date_opened[]"></td> --}}
                                        <td><div class="group-input new-date-data-field mb-0">
                                            <div class="input-date "><div
                                             class="calenderauditee">
                                            <input type="text" id="date_due00' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_opened[]" class="hide-input" 
                                            oninput="handleDateInput(this, `date_due00' + serialNumber +'`)" /></div></div></div></td> -->

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
                                            <th>Row #</th>
                                            <th>CAPA Details</th>
                                            <th>CAPA Type</th>
                                            <th>Site / Division</th>
                                            <th>Person Responsible</th>
                                            <th>Current Status</th>
                                            <th>Date Closed</th>
                                            <th>Remark</th>
                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="serial_number[]" value="1">
                                        </td>
                                        <td><input type="text" name="Details[]"></td>
                                        <td>
                                            <select id="select-state" placeholder="Select..."
                                                name="capa_type[]">
                                                <option value="">Select a value</option>
                                                <option value="corrective">Corrective Action</option>
                                                <option value="preventive">Preventive Action</option>
                                                <option value="corrective_preventive">Corrective & Preventive Action</option>
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
                                        <td><div class="group-input new-date-data-field mb-0"><div class="input-date ">
                                            <div class="calenderauditee">
                                            <input type="text" id="date_closed_capa1" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_closed2[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                        oninput="handleDateInput(this, `date_closed_capa1`);" /></div></div>
                                                    </div>
                                                </td>  
                                         

                                        <td><input type="text" name="remark2[]"></td>
                                    </tbody>
                                </table>
                            </div>
                           
                            <div class="new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="next_managment_review_date">Next Management Review Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="next_managment_review_date" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="next_managment_review_date"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input {{ (isset($data->stage) and $data->stage == 0 )|| (isset($data->stage) and $data->stage == 3 )? 'disabled' : '' }}
                                         min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            oninput="handleDateInput(this, 'next_managment_review_date')" />
                                    </div>
                                </div>
                            </div>
                            <div class="group-input">
                                <label for="summary_recommendation">Summary & Recommendation</label>
                                <textarea name="summary_recommendation"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="conclusion">Conclusion</label>
                                <textarea name="conclusion_new"></textarea>
                            </div>
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
                            <div class="sub-head">
                                Extension Justification
                            </div>
                            <div class="group-input">
                                <label for="due_date_extension">Due Date Extension Justification</label>
                                <div><small class="text-primary">Please Mention justification if due date is
                                        crossed</small></div>
                                <textarea name="due_date_extension"></textarea>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                {{-- <button type="submit">Submit1</button> --}}
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" href="{{ url('dashboard') }}"> Exit </a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed By">Completed By</label>
                                        {{-- <div class="static">Person datafield</div>/ --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed On">Completed On</label>
                                        {{-- <div class="static">17-04-2023 11:12PM</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a class="text-white" href="{{ url('dashboard') }}"> Exit </a>
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
            cell3.innerHTML = '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_due' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_due[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="date_due' + currentRowCount +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `date_due' + currentRowCount +'`);checkDate(`date_due' + currentRowCount +'_checkdate`,`date_closed' + currentRowCount +'_checkdate`)" /></div></div></div></td>';

            var cell4 = newRow.insertCell(3);
            cell4.innerHTML = "<input type='text' name='site[]'>";

            var cell5 = newRow.insertCell(4);
            var userHtml = '<select name="responsible_person[]"><option value="">-- Select --</option>';
                    for (var i = 0; i < users.length; i++) {
                        userHtml += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    userHtml +='</select>';
            
            cell5.innerHTML = userHtml;

            var cell6 = newRow.insertCell(5);
            cell6.innerHTML = "<input type='text' name='current_status[]'>"; 

            var cell7 = newRow.insertCell(6);
            cell7.innerHTML = '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="date_closed' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date_closed'+ currentRowCount +'_checkdate" class="hide-input" oninput="handleDateInput(this, `date_closed' + currentRowCount +'`);checkDate(`date_due' + currentRowCount +'_checkdate`,`date_closed' + currentRowCount +'_checkdate`)" /></div></div></div></td>';
              
            var cell8 = newRow.insertCell(7);
            cell8.innerHTML = "<input type='text' name='remark[]'>";
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><select id="select-state" placeholder="Select..." name="capa_type[]">'+
                        '<option value="">Select a value</option>'+
                        '<option value="corrective">Corrective Action</option>'+
                        '<option value="preventive">Preventive Action</option>'+
                        '<option value="corrective_preventive">Corrective & Preventive Action</option>'+
                        '</select></td>'+

                        '<td><input type="text" name="site2[]">' +
                        '<td><select name="responsible_person2[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        
                        '<td><input type="text" name="current_status2[]">' +
                       
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="date_closed_capa' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date_closed2[]"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `date_closed_capa' + serialNumber +'`)" /></div></div></div></td>' +

                        '<td><input type="text" name="remark2[]"></td>' +

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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    // '<td><input type="date" name="date[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="agenda_date'+ serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, `agenda_date' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><input type="text" name="topic[]"></td>' +
                    '<td><input type="text" name="responsible[]"></td>' +
                    '<td><input type="time" name="start_time[]"></td>' +
                    '<td><input type="time" name="end_time[]"></td>' +
                    '<td><input type="text" name="comment[]"></td>' +
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
                        '<td><input  disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
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
                    $('#rchars').text(textlen);});
            </script>
@endsection
