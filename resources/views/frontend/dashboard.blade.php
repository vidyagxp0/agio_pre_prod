@extends('frontend.layout.main')
@section('container')
<style>
    #create-record-button {
        display: block;
    }
</style>
    {{-- ======================================
                    DASHBOARD
    ======================================= --}}
    <div id="dashboard">
        <div class="container-fluid">
            <div class="dashboard-container">

                <div class="row">
                    <div class="col-lg-9">
                    </div>
                </div>



                <div>

                        <div class="inner-block calendar-block">
                            <div id='calendar'></div>
                        </div>

            </div>
        </div>
    </div>

    {{-- ======================================
                SUBSCRIBE MODAL
    ======================================= --}}
    <div class="modal fade modal-lg" id="subscribe-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Subscription</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('subscribe') }}" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="top-slogan">
                            Schedule dashboard refreshes and subscribes to receive results.
                        </div>
                        <div class="main-head">
                            Settings
                        </div>
                        <div class="schedule-block">
                            <div class="title">Frequency</div>
                            <div class="schedule-grid">
                                <div>
                                    <input type="radio" name="type" value="Daily" id="daily">
                                    <label for="daily">Daily</label>
                                </div>
                                <div class="active">
                                    <input type="radio" name="type" value="Weekly" id="weekly" checked>
                                    <label for="weekly">Weekly</label>
                                </div>
                                <div>
                                    <input type="radio" name="type" value="Monthly" id="monthly">
                                    <label for="monthly">Monthly</label>
                                </div>
                            </div>
                        </div>
                        <div class="subscribe-block daily-block">

                        </div>
                        <div class="subscribe-block weekly-block">
                            <div class="day-block">
                                <div class="title">
                                    Days
                                </div>
                                <div class="day-grid">
                                    <div class="active">
                                        <input type="radio" name="day" value="0" id="sun">
                                        <label for="sun">Sun</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="1" id="mon" checked>
                                        <label for="mon">Mon</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="2" id="tue">
                                        <label for="tue">Tue</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="3" id="wed">
                                        <label for="wed">Wed</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="4" id="thu">
                                        <label for="thu">Thu</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="5" id="fri">
                                        <label for="fri">Fri</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="day" value="6" id="sat">
                                        <label for="sat">Sat</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="subscribe-block monthly-block">
                            <div class="group-input">
                                <label for="when">When</label>
                                <select name="when" id="when">
                                    <option value="relative">Relative</option>
                                    <option value="specific">Specific</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="week">Week</label>
                                <select name="week" id="week">
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                    <option value="4">Fourth</option>
                                    <option value="5">Last</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="day">Day</label>
                                <select name="days" id="day">
                                    <option value="sunday">Sunday</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                    <option value="saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="group-input">
                            <label for="time">Time</label>
                            <select name="time" id="time">
                                <option value="13:00">1:00 PM</option>
                                <option value="14:00">2:00 PM</option>
                                <option value="15:00">3:00 PM</option>
                                <option value="16:00">4:00 PM</option>
                                <option value="17:00">5:00 PM</option>
                                <option value="18:00">6:00 PM</option>
                                <option value="19:00">7:00 PM</option>
                                <option value="20:00">8:00 PM</option>
                                <option value="21:00">9:00 PM</option>
                                <option value="22:00">10:00 PM</option>
                                <option value="23:00">11:00 PM</option>
                                <option value="00:00">12:00 PM</option>
                                <option value="1:00">1:00 AM</option>
                                <option value="2:00">2:00 AM</option>
                                <option value="3:00">3:00 AM</option>
                                <option value="4:00">4:00 AM</option>
                                <option value="5:00">5:00 AM</option>
                                <option value="6:00">6:00 AM</option>
                                <option value="7:00">7:00 AM</option>
                                <option value="8:00">8:00 AM</option>
                                <option value="9:00">9:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:00">12:00 AM</option>
                            </select>
                        </div>
                        <div class="main-head">
                            Recipents
                        </div>
                        <div class="check-input">
                            <label for="receive">
                                <input type="checkbox" name="status" value="1" id="receive">
                                Receive new results by email when dashboard is refreshed.
                            </label>
                        </div>
                        <div class="notify">
                            <div><small>Send email to</small></div>
                            <div class="persons">
                                <div>Me</div>
                            </div>
                            <div id="edit-recipent-btn">Edit Recipents</div>
                            <div>
                                @php
                                    $user = DB::table('users')
                                        ->where('id', '!=', Auth::user()->id)
                                        ->get();
                                @endphp
                                <select multiple name="recipents[]" placeholder="Select Recipents" data-search="false"
                                    data-silent-initial-value-set="true" id="edit_recipents">
                                    @foreach ($user as $users)
                                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- ======================================
                NEW DOCUMENT MODAL
    ======================================= --}}
    <div class="modal fade" id="new-document">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">New Change Control</h4>
                </div>
                <form action="{{ route('change-control.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-block">
                            <div class="head">
                                General Information
                            </div>
                            <div class="form-inputs">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="title">
                                                Title<span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="default-name">Owner</label>
                                            <div class="default-name">{{ Auth::user()->name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="default-name">Date Opened</label>
                                            <div class="default-name">
                                                @php
                                                    $date = \Carbon\Carbon::now()->format('d-M-Y');
                                                @endphp
                                                {{ $date }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="short-desc">Version</label>
                                            <input type="text" name="version">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="short-desc">Short Description</label>
                                            <input type="text" name="short_description">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="type">Type</label>
                                            <input list="type" name="type">
                                            <datalist id="type">
                                                <option value="SOP">Standard Operating Procedure</option>
                                                <option value="WI">Work Instruction</option>
                                                <option value="Specifications">Specifications</option>
                                                <option value="Protocols">Protocols</option>
                                                <option value="Engineering">Engineering</option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="due-date">Due Date</label>
                                            <!-- <input type="date" name="due_date"> -->
                                            <div class="calenderauditee">                                     
                                                <input type="text"  id="due_date"  readonly placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="due_date" value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">Batch</label>
                                            <input list="batches" name="batch">
                                            <datalist id="batches">
                                                <option value="Document Identification">Document Identification</option>
                                                <option value="Change Request">Change Request</option>
                                                <option value="Review">Review</option>
                                                <option value="Approval">Approval</option>
                                                <option value="Implementation">Implementation</option>
                                                <option value="Testing">Testing</option>
                                                <option value="Verification">Verification</option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                                HOD<span class="text-danger">*</span>
                                            </label>
                                            @php
                                                $user = DB::table('users')
                                                    ->where('role', 4)
                                                    ->get();
                                            @endphp
                                            <select name="assign_to">
                                                @foreach ($user as $temp)
                                                    <option value="{{ $temp->id }}">
                                                        {{ $temp->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="cft">
                                                CFT Reviewers<span class="text-danger">*</span>
                                            </label>
                                            @php
                                                $user = DB::table('users')
                                                    ->where('role', 5)
                                                    ->get();
                                            @endphp

                                            <select multiple name="cft[]" placeholder="Select CFT Reviewers"
                                                data-search="false" data-silent-initial-value-set="true" id="cft">
                                                @foreach ($user as $temp)
                                                    <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Applicability
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="owning-facility">Owning Facility</label>
                                            <input type="text" name="owning_facility">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="impacted-facilities">Impacted Facilities</label>
                                            <input type="text" name="impacted_facilities">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="owning-department">Owning Department</label>
                                            <input type="text" name="owning_department">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="impacted-department">Impacted Department</label>
                                            <input type="text" name="impacted_department">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Change Information
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-lg-">
                                        <div class="group-input">
                                            <label for="document-change-action">Document Change Action</label>
                                            <input type="text" name="doc_change_action">
                                        </div>
                                    </div>
                                    <div class="col-lg-">
                                        <div class="group-input">
                                            <label for="document-change-type">Document Change Type</label>
                                            <input type="text" name="doc_change_type">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="change-summary">Change Summary</label>
                                            <input type="text" name="doc_change_summary">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="reason">Summary/Reason</label>
                                            <input type="text" name="doc_change_summary_reason">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="periodic">
                                                Part of Periodic Review<span class="text-danger">*</span>
                                            </label>
                                            <div class="radio-list">
                                                <label for="yes">
                                                    <input type="radio" value="Yes" name="periodic_review"
                                                        id="yes"> Yes
                                                </label>
                                                <label for="no">
                                                    <input type="radio" value="No" name="periodic_review"
                                                        id="no"> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Details
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="current-state">Current State</label>
                                            <textarea name="current_state"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="proposed-state">Proposed State</label>
                                            <textarea name="proposed_state"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="justification">Justification</label>
                                            <textarea name="justification"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Change Scope - Equipment
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="equip-affect">Equipment Affected?</label>
                                            <select name="equipment_affected">
                                                <option value="" selected>--None--</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="equip-id">Equipment ID</label>
                                            <input type="text" name="equipment_id">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="equip-comment">Equipment Comment</label>
                                            <textarea name="equipment_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Change Scope - Documents
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="doc-affect">Documents Affected?</label>
                                            <select name="document_affected">
                                                <option value="" selected>--None--</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="document_comment">Document Comment</label>
                                            <textarea name="doc-comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="head">
                                Supporting Documents
                            </div>
                            <div class="form-inputs">
                                <div class="group-input" id="supporting_documents">
                                    <label>
                                        <div onclick="addDocumentField()">Add File</div>
                                    </label>
                                    <input type="file" name="supported" id="support-input">
                                </div>
                            </div>
                            <div class="head">
                                Evaluation
                            </div>
                            <div class="form-inputs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="group-input check-input">
                                            <input type="checkbox" name="implemented_as_planed">
                                            <label for="implement" class="mb-0">Implemented as Planned</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="change-eval">Change Evaluation</label>
                                            <textarea name="change-evaluation"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="justify-reject">Justification for Reject</label>
                                            <textarea name="justification_for_reject"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" >Save & New</button> --}}
                        <button type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- ======================================
                DIVISION MODAL
    ======================================= --}}
    <div id="ccdivision-modal">
        <div class="division-container">
            <div class="content-container">
                <form action="#" method="post">
                    <div class="division-tabs">
                        <div class="tab">
                            <div class="divisionlinks active" onclick="openDivision(event, 'qms-apac')">QMS - APAC</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'qms-emea')">QMS - EMEA</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'qms-north')">QMS - North America</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'qms-india')">QMS - India</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'qms-japan')">QMS - Japan</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'dms-south')">DMS - South Korea</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'dms-north')">DMS - North America</div>
                            <div class="divisionlinks" onclick="openDivision(event, 'dms-emea')">DMS - EMEA</div>
                        </div>
                        <div id="qms-apac" class="divisioncontent">
                            <label for="ccd1">
                                <input type="radio" name="process" id="ccd1">
                                Change Control
                            </label>
                        </div>
                        <div id="qms-emea" class="divisioncontent">
                            <label for="ccd2">
                                <input type="radio" name="process" id="ccd2">
                                Change Control
                            </label>
                        </div>
                        <div id="qms-north" class="divisioncontent">
                            <label for="ccd3">
                                <input type="radio" name="process" id="ccd3">
                                Change Control
                            </label>
                        </div>
                        <div id="qms-india" class="divisioncontent">
                            <label for="ccd4">
                                <input type="radio" name="process" id="ccd4">
                                Change Control
                            </label>
                        </div>
                        <div id="qms-japan" class="divisioncontent">
                            <label for="ccd5">
                                <input type="radio" name="process" id="ccd5">
                                Change Control
                            </label>
                        </div>
                        <div id="dms-south" class="divisioncontent">
                            <label for="ccd6">
                                <input type="radio" name="process" id="ccd6">
                                Change Control
                            </label>
                        </div>
                        <div id="dms-north" class="divisioncontent">
                            <label for="ccd7">
                                <input type="radio" name="process" id="ccd7">
                                Change Control
                            </label>
                        </div>
                        <div id="dms-emea" class="divisioncontent">
                            <label for="ccd8">
                                <input type="radio" name="process" id="ccd8">
                                Change Control
                            </label>
                        </div>
                    </div>
                    <div class="btn-container">
                        <a href="#" class="close-ccdivision">Close</a>
                        <button type="Submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

      {{-- --------------open dcr division -------------- --}}
      <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('dcrDivision_submit') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('q_m_s_divisions')->where('status', 1)->get();
                            @endphp
                            @foreach ($division as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button type="button" class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button>
                            @endforeach

                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="">
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data.min.js"></script>
    <script>
        setInterval(updateTime, 1000);
    </script>

    <script>
        VirtualSelect.init({
            ele: '#cft, #edit_recipents'
        });

        $("#edit_recipents").hide();
        $("#edit-recipent-btn").click(function() {
            $("#edit_recipents").show();
            $("#edit-recipent-btn").hide();
        });



        $("#ccdivision-modal").hide();
        $("#ccdivision-modal .close-ccdivision").click(function(){
            $("#ccdivision-modal").hide();
        });
        $("#dashboard .open-ccdivision").click(function(){
            $("#ccdivision-modal").show();
        });


        function addDocumentField() {
            var currentInput = document.getElementById('support-input');

            var newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'supported';
            newInput.id = 'support-input';

            currentInput.parentNode.appendChild(newInput);
        }


        const dayRadios = document.querySelectorAll('.day-grid input[type="radio"]');
        dayRadios.forEach(radio => {
            radio.addEventListener('click', () => {
                dayRadios.forEach(radio => {
                    radio.parentNode.classList.remove('active');
                });
                const selectedDayRadio = document.querySelector('.day-grid input[type="radio"]:checked');
                selectedDayRadio.parentNode.classList.add('active');
            });
        });
        const scheduleRadios = document.querySelectorAll('.schedule-grid input[type="radio"]');
        scheduleRadios.forEach(radio => {
            radio.addEventListener('click', () => {
                scheduleRadios.forEach(radio => {
                    radio.parentNode.classList.remove('active');
                });
                const selectedRadio = document.querySelector('.schedule-grid input[type="radio"]:checked');
                selectedRadio.parentNode.classList.add('active');
            });
        });
        const dailyBlock = document.querySelector('.daily-block');
        const weeklyBlock = document.querySelector('.weekly-block');
        const monthlyBlock = document.querySelector('.monthly-block');
        scheduleRadios.forEach(radio => {
            radio.addEventListener('click', () => {
                dailyBlock.style.display = 'none';
                weeklyBlock.style.display = 'none';
                monthlyBlock.style.display = 'none';
                if (radio.id === 'daily') {
                    dailyBlock.style.display = 'block';
                } else if (radio.id === 'weekly') {
                    weeklyBlock.style.display = 'block';
                } else if (radio.id === 'monthly') {
                    monthlyBlock.style.display = 'block';
                }
            });
        });
        const initiallySelectedRadio = document.querySelector('.schedule-grid input[type="radio"]:checked');
        if (initiallySelectedRadio) {
            if (initiallySelectedRadio.id === 'daily') {
                dailyBlock.style.display = 'block';
            } else if (initiallySelectedRadio.id === 'weekly') {
                weeklyBlock.style.display = 'block';
            } else if (initiallySelectedRadio.id === 'monthly') {
                monthlyBlock.style.display = 'block';
            }
        }


// ========================new chart added I==============================================
var options = {
          series: [44, 41, 41, 17, 15],
          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 250
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-21"), options);
        chart.render();
      // ========================new chart added II==============================================
var options = {
          series: [54, 55, 41, 17, 20],
          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 460,
          options: {
            chart: {
              width: 250
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-22"), options);
        chart.render();

         //   ==================================================chard added new 3
    var options = {
          series: [44, 55, 41, 17, 15],
          chart: {
          width: 350,
          type: 'donut',
          dropShadow: {
            enabled: true,
            color: '#111',
            top: -1,
            left: 3,
            blur: 3,
            opacity: 0.2
          }
        },
        stroke: {
          width: 0,
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                total: {
                  showAlways: true,
                  show: true
                }
              }
            }
          }
        },
        labels: ["Approved", "Canceled", "Effective", "In Review", "Other"],
        dataLabels: {
          dropShadow: {
            blur: 3,
            opacity: 0.8
          }
        },
        fill: {
        type: 'pattern',
          opacity: 1,
          pattern: {
            enabled: true,
            style: ['verticalLines', 'squares', 'horizontalLines', 'circles','slantedLines'],
          },
        },
        states: {
          hover: {
            filter: 'none'
          }
        },
        theme: {
          palette: 'palette2'
        },
        title: {
          text: ""
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-23"), options);
        chart.render();
    //   ==============================================chart added 4 new
    var options = {
          series: [{
          data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
        }],
          chart: {
          type: 'bar',
          height: 200
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Assigned', 'Completed', 'Unassigned', 'Not Completed', 'In Process', 'Document Obsoleted', 'Course Obsoleted',
            
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-24"), options);
        chart.render();
    //   =========================================================new chard added 5

    
    var options = {
          series: [
          {
            name: 'Actual',
            data: [
              {
                x: '2011',
                y: 12,
                goals: [
                  {
                    name: 'Expected',
                    value: 14,
                    strokeWidth: 2,
                    strokeDashArray: 2,
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: '2012',
                y: 44,
                goals: [
                  {
                    name: 'Expected',
                    value: 54,
                    strokeWidth: 5,
                    strokeHeight: 10,
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: '2013',
                y: 54,
                goals: [
                  {
                    name: 'Expected',
                    value: 52,
                    strokeWidth: 10,
                    strokeHeight: 0,
                    strokeLineCap: 'round',
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: '2014',
                y: 66,
                goals: [
                  {
                    name: 'Expected',
                    value: 61,
                    strokeWidth: 10,
                    strokeHeight: 0,
                    strokeLineCap: 'round',
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: '2015',
                y: 81,
                goals: [
                  {
                    name: 'Expected',
                    value: 66,
                    strokeWidth: 10,
                    strokeHeight: 0,
                    strokeLineCap: 'round',
                    strokeColor: '#00E396'
                  }
                ]
              },
              {
                x: '2016',
                y: 67,
                goals: [
                  {
                    name: 'Expected',
                    value: 70,
                    strokeWidth: 5,
                    strokeHeight: 10,
                    strokeColor: '#000'
                  }
                ]
              }
            ]
          }
        ],
          chart: {
          height: 200,
          type: 'bar'
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        colors: ['#775DD0'],
        dataLabels: {
          formatter: function(val, opt) {
            const goals =
              opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
                .goals
        
            if (goals && goals.length) {
              return `${val} / ${goals[0].value}`
            }
            return val
          }
        },
        legend: {
          show: true,
          showForSingleSeries: true,
          customLegendItems: ['Actual', 'Expected'],
          markers: {
            fillColors: ['#00E396', '#775DD0']
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-25"), options);
        chart.render();
    //   ===============================================chart new added 6 ==
    var options = {
          series: [44, 55, 41, 17, 15],
          chart: {
          width: 340,
          type: 'donut',
          dropShadow: {
            enabled: true,
            color: '#111',
            top: -1,
            left: 3,
            blur: 3,
            opacity: 0.2
          }
        },
        stroke: {
          width: 0,
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                total: {
                  showAlways: true,
                  show: true
                }
              }
            }
          }
        },
        labels: ["Approved", "Canceled", "Effective", "In Review", "Other"],
        dataLabels: {
          dropShadow: {
            blur: 3,
            opacity: 0.8
          }
        },
        fill: {
        type: 'pattern',
          opacity: 1,
          pattern: {
            enabled: true,
            style: ['verticalLines', 'squares', 'horizontalLines', 'circles','slantedLines'],
          },
        },
        states: {
          hover: {
            filter: 'none'
          }
        },
        theme: {
          palette: 'palette2'
        },
        title: {
          text: ""
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-26"), options);
        chart.render();

        // ================================================= DASHBOARD CALENDAR
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                navLinks: true,
                initialView: 'dayGridMonth',
                events: [
                    @if (Auth::user()->role != 4 && Auth::user()->role != 5 && Auth::user()->role != 6)
                        @foreach ($data as $temp)
                            {
                                title: '{{ $temp->document_name }}',
                                start: '{{ $temp->created_at }}',
                                url: '{{ url('doc-details', $temp->id) }}',
                                color: 'yellow',
                                textColor: 'black'
                            },
                        @endforeach
                    @else
                        {
                            title: 'example',
                            start: '12-04-2023',
                            url: '#',
                            color: 'yellow',
                            textColor: 'black'
                        },
                    @endif
                ],


            });
            calendar.render();
        });

        var randomColorGenerator = function() {
            return '#' + (Math.random().toString(16) + '0000000').slice(2, 8) + "36";
        };
        var data = {
            labels: ["Draft", "In Review", "Reviewed", "Under Approval", "Approved", "Under Training", "Effective"],
            datasets: [{
                label: "Status",
                backgroundColor: ["blue", "yellow", "green", "purple", "violet", "pink", "grey"],
                borderColor: "#4274da",
                borderWidth: 2,
                hoverBackgroundColor: "#4274da87",
                hoverBorderColor: "#4274da",
                @if (Helpers::checkRoles(3))
                    data: [{{ $count }}],
                @else
                    data: [10, 20, 30, 40, 50, 60, 70],
                @endif
            }]
        };


        // ========================= DASHBOARD CHART 2
        var data2 = {
            labels: ["SOP", "WI", "STP", "Specifications", "Protocols", "Engineering"],
            datasets: [{
                label: "Document Type",
                backgroundColor: ["blue", "yellow", "green", "purple", "pink", "grey"],
                borderColor: "#4274da",
                borderWidth: 2,
                hoverBackgroundColor: "#4274da87",
                hoverBorderColor: "#4274da",
                data: [80, 23, 30, 70, 50, 120],
            }]
        };


        // ========================= DASHBOARD CHART 2
        var data3 = {
            labels: ["SOP", "WI", "STP", "Specifications", "Protocols", "Engineering"],
            datasets: [{
                label: "Departments",
                backgroundColor: ["blue", "yellow", "green", "purple", "pink", "grey"],
                borderColor: "#4274da",
                borderWidth: 2,
                hoverBackgroundColor: "#4274da87",
                hoverBorderColor: "#4274da",
                data: [80, 23, 30, 70, 50, 120],
            }]
        };


        // ========================= DASHBOARD CHART 2
        var data4 = {
            labels: ["QA", "QC", "RA", "Microbiology", "Warehouse", "Production"],
            datasets: [{
                label: "Status",
                backgroundColor: ["blue", "yellow", "green", "purple", "pink", "grey"],
                borderColor: "#4274da",
                borderWidth: 2,
                hoverBackgroundColor: "#4274da87",
                hoverBorderColor: "#4274da",
                data: [80, 23, 30, 70, 50, 120],
            }]
        };



        var options5 = {
            series: [{
                name: 'Number of Batch Failure',
                type: 'column',
                data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
            }, {
                name: 'Number of Batch Success',
                type: 'column',
                data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
            }, {
                name: 'Batch Failure Rate',
                type: 'line',
                data: [20, 29, 37, 36, 44, 45, 50, 58]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [1, 1, 4]
            },
            title: {
                align: 'left',
                offsetX: 110
            },
            xaxis: {
                categories: [2022.03, 2022.04, 2022.05, 2022.06, 2022.07, 2022.08, 2022.09, 2022.10],
            },
            yaxis: [{
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        style: {
                            color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                {
                    seriesName: 'Income',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "Number of Batch Success",
                        style: {
                            color: '#00E396',
                        }
                    },
                },
                {
                    seriesName: 'Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        text: "Batch Failure Rate",
                        style: {
                            color: '#FEB019',
                        }
                    }
                },
            ],
            tooltip: {
                fixed: {
                    enabled: true,
                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                    offsetY: 30,
                    offsetX: 60
                },
            },
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            }
        };
        var chart5 = new ApexCharts(document.querySelector("#chart-5"), options5);
        chart5.render();



        var options6 = {
            series: [{
                    type: 'rangeArea',
                    name: 'Class',
                    data: [{
                            x: 'Jan',
                            y: [1100, 1900]
                        },
                        {
                            x: 'Feb',
                            y: [1200, 1800]
                        },
                        {
                            x: 'Mar',
                            y: [900, 2900]
                        },
                        {
                            x: 'Apr',
                            y: [1400, 2700]
                        },
                        {
                            x: 'May',
                            y: [2600, 3900]
                        },
                        {
                            x: 'Jun',
                            y: [500, 1700]
                        },
                        {
                            x: 'Jul',
                            y: [1900, 2300]
                        },
                        {
                            x: 'Aug',
                            y: [1000, 1500]
                        }
                    ]
                },
                {
                    type: 'rangeArea',
                    name: "Number of Deviation PR's",
                    data: [{
                            x: 'Jan',
                            y: [3100, 3400]
                        },
                        {
                            x: 'Feb',
                            y: [4200, 5200]
                        },
                        {
                            x: 'Mar',
                            y: [3900, 4900]
                        },
                        {
                            x: 'Apr',
                            y: [3400, 3900]
                        },
                        {
                            x: 'May',
                            y: [5100, 5900]
                        },
                        {
                            x: 'Jun',
                            y: [5400, 6700]
                        },
                        {
                            x: 'Jul',
                            y: [4300, 4600]
                        },
                        {
                            x: 'Aug',
                            y: [2100, 2900]
                        }
                    ]
                },
                {
                    type: 'line',
                    name: 'Number of Batch',
                    data: [{
                            x: 'Jan',
                            y: 1500
                        },
                        {
                            x: 'Feb',
                            y: 1700
                        },
                        {
                            x: 'Mar',
                            y: 1900
                        },
                        {
                            x: 'Apr',
                            y: 2200
                        },
                        {
                            x: 'May',
                            y: 3000
                        },
                        {
                            x: 'Jun',
                            y: 1000
                        },
                        {
                            x: 'Jul',
                            y: 2100
                        },
                        {
                            x: 'Aug',
                            y: 1200
                        },
                        {
                            x: 'Sep',
                            y: 1800
                        },
                        {
                            x: 'Oct',
                            y: 2000
                        }
                    ]
                },
                {
                    type: 'line',
                    name: 'Deviation Rate',
                    data: [{
                            x: 'Jan',
                            y: 3300
                        },
                        {
                            x: 'Feb',
                            y: 4900
                        },
                        {
                            x: 'Mar',
                            y: 4300
                        },
                        {
                            x: 'Apr',
                            y: 3700
                        },
                        {
                            x: 'May',
                            y: 5500
                        },
                        {
                            x: 'Jun',
                            y: 5900
                        },
                        {
                            x: 'Jul',
                            y: 4500
                        },
                        {
                            x: 'Aug',
                            y: 2400
                        },
                        {
                            x: 'Sep',
                            y: 2100
                        },
                        {
                            x: 'Oct',
                            y: 1500
                        }
                    ]
                }
            ],
            chart: {
                height: 350,
                type: 'rangeArea',
                animations: {
                    speed: 500
                }
            },
            colors: ['#d4526e', '#33b2df', '#d4526e', '#33b2df'],
            dataLabels: {
                enabled: false
            },
            fill: {
                opacity: [0.24, 0.24, 1, 1]
            },
            forecastDataPoints: {
                count: 2
            },
            stroke: {
                curve: 'straight',
                width: [0, 0, 2, 2]
            },
            legend: {
                show: true,
                customLegendItems: ["Number of EC Failure", "Number of RC PR's"],
                inverseOrder: true
            },
            markers: {
                hover: {
                    sizeOffset: 5
                }
            }
        };
        var chart6 = new ApexCharts(document.querySelector("#chart-6"), options6);
        chart6.render();



        var options7 = {
            series: [{
                name: "Number of Extension PR's",
                type: 'line',
                data: [{
                    x: new Date(1538778600000),
                    y: 6604
                }, {
                    x: new Date(1538782200000),
                    y: 6602
                }, {
                    x: new Date(1538814600000),
                    y: 6607
                }, {
                    x: new Date(1538884800000),
                    y: 6620
                }]
            }, {
                name: "Number of Deviation PR's",
                type: 'candlestick',
                data: [{
                        x: new Date(1538778600000),
                        y: [6629.81, 6650.5, 6623.04, 6633.33]
                    },
                    {
                        x: new Date(1538780400000),
                        y: [6632.01, 6643.59, 6620, 6630.11]
                    },
                    {
                        x: new Date(1538782200000),
                        y: [6630.71, 6648.95, 6623.34, 6635.65]
                    },
                    {
                        x: new Date(1538784000000),
                        y: [6635.65, 6651, 6629.67, 6638.24]
                    },
                    {
                        x: new Date(1538785800000),
                        y: [6638.24, 6640, 6620, 6624.47]
                    },
                    {
                        x: new Date(1538787600000),
                        y: [6624.53, 6636.03, 6621.68, 6624.31]
                    },
                    {
                        x: new Date(1538789400000),
                        y: [6624.61, 6632.2, 6617, 6626.02]
                    },
                    {
                        x: new Date(1538791200000),
                        y: [6627, 6627.62, 6584.22, 6603.02]
                    },
                    {
                        x: new Date(1538793000000),
                        y: [6605, 6608.03, 6598.95, 6604.01]
                    },
                    {
                        x: new Date(1538794800000),
                        y: [6604.5, 6614.4, 6602.26, 6608.02]
                    },
                    {
                        x: new Date(1538796600000),
                        y: [6608.02, 6610.68, 6601.99, 6608.91]
                    },
                    {
                        x: new Date(1538798400000),
                        y: [6608.91, 6618.99, 6608.01, 6612]
                    },
                    {
                        x: new Date(1538800200000),
                        y: [6612, 6615.13, 6605.09, 6612]
                    },
                    {
                        x: new Date(1538802000000),
                        y: [6612, 6624.12, 6608.43, 6622.95]
                    },
                    {
                        x: new Date(1538803800000),
                        y: [6623.91, 6623.91, 6615, 6615.67]
                    },
                    {
                        x: new Date(1538805600000),
                        y: [6618.69, 6618.74, 6610, 6610.4]
                    },
                    {
                        x: new Date(1538807400000),
                        y: [6611, 6622.78, 6610.4, 6614.9]
                    },
                    {
                        x: new Date(1538809200000),
                        y: [6614.9, 6626.2, 6613.33, 6623.45]
                    },
                    {
                        x: new Date(1538811000000),
                        y: [6623.48, 6627, 6618.38, 6620.35]
                    },
                    {
                        x: new Date(1538812800000),
                        y: [6619.43, 6620.35, 6610.05, 6615.53]
                    },
                    {
                        x: new Date(1538814600000),
                        y: [6615.53, 6617.93, 6610, 6615.19]
                    },
                    {
                        x: new Date(1538816400000),
                        y: [6615.19, 6621.6, 6608.2, 6620]
                    },
                    {
                        x: new Date(1538818200000),
                        y: [6619.54, 6625.17, 6614.15, 6620]
                    },
                    {
                        x: new Date(1538820000000),
                        y: [6620.33, 6634.15, 6617.24, 6624.61]
                    },
                    {
                        x: new Date(1538821800000),
                        y: [6625.95, 6626, 6611.66, 6617.58]
                    },
                    {
                        x: new Date(1538823600000),
                        y: [6619, 6625.97, 6595.27, 6598.86]
                    },
                    {
                        x: new Date(1538825400000),
                        y: [6598.86, 6598.88, 6570, 6587.16]
                    },
                    {
                        x: new Date(1538827200000),
                        y: [6588.86, 6600, 6580, 6593.4]
                    },
                    {
                        x: new Date(1538829000000),
                        y: [6593.99, 6598.89, 6585, 6587.81]
                    },
                    {
                        x: new Date(1538830800000),
                        y: [6587.81, 6592.73, 6567.14, 6578]
                    },
                    {
                        x: new Date(1538832600000),
                        y: [6578.35, 6581.72, 6567.39, 6579]
                    },
                    {
                        x: new Date(1538834400000),
                        y: [6579.38, 6580.92, 6566.77, 6575.96]
                    },
                    {
                        x: new Date(1538836200000),
                        y: [6575.96, 6589, 6571.77, 6588.92]
                    },
                    {
                        x: new Date(1538838000000),
                        y: [6588.92, 6594, 6577.55, 6589.22]
                    },
                    {
                        x: new Date(1538839800000),
                        y: [6589.3, 6598.89, 6589.1, 6596.08]
                    },
                    {
                        x: new Date(1538841600000),
                        y: [6597.5, 6600, 6588.39, 6596.25]
                    },
                    {
                        x: new Date(1538843400000),
                        y: [6598.03, 6600, 6588.73, 6595.97]
                    },
                    {
                        x: new Date(1538845200000),
                        y: [6595.97, 6602.01, 6588.17, 6602]
                    },
                    {
                        x: new Date(1538847000000),
                        y: [6602, 6607, 6596.51, 6599.95]
                    },
                    {
                        x: new Date(1538848800000),
                        y: [6600.63, 6601.21, 6590.39, 6591.02]
                    },
                    {
                        x: new Date(1538850600000),
                        y: [6591.02, 6603.08, 6591, 6591]
                    },
                    {
                        x: new Date(1538852400000),
                        y: [6591, 6601.32, 6585, 6592]
                    },
                    {
                        x: new Date(1538854200000),
                        y: [6593.13, 6596.01, 6590, 6593.34]
                    },
                    {
                        x: new Date(1538856000000),
                        y: [6593.34, 6604.76, 6582.63, 6593.86]
                    },
                    {
                        x: new Date(1538857800000),
                        y: [6593.86, 6604.28, 6586.57, 6600.01]
                    },
                    {
                        x: new Date(1538859600000),
                        y: [6601.81, 6603.21, 6592.78, 6596.25]
                    },
                    {
                        x: new Date(1538861400000),
                        y: [6596.25, 6604.2, 6590, 6602.99]
                    },
                    {
                        x: new Date(1538863200000),
                        y: [6602.99, 6606, 6584.99, 6587.81]
                    },
                    {
                        x: new Date(1538865000000),
                        y: [6587.81, 6595, 6583.27, 6591.96]
                    },
                    {
                        x: new Date(1538866800000),
                        y: [6591.97, 6596.07, 6585, 6588.39]
                    },
                    {
                        x: new Date(1538868600000),
                        y: [6587.6, 6598.21, 6587.6, 6594.27]
                    },
                    {
                        x: new Date(1538870400000),
                        y: [6596.44, 6601, 6590, 6596.55]
                    },
                    {
                        x: new Date(1538872200000),
                        y: [6598.91, 6605, 6596.61, 6600.02]
                    },
                    {
                        x: new Date(1538874000000),
                        y: [6600.55, 6605, 6589.14, 6593.01]
                    },
                    {
                        x: new Date(1538875800000),
                        y: [6593.15, 6605, 6592, 6603.06]
                    },
                    {
                        x: new Date(1538877600000),
                        y: [6603.07, 6604.5, 6599.09, 6603.89]
                    },
                    {
                        x: new Date(1538879400000),
                        y: [6604.44, 6604.44, 6600, 6603.5]
                    },
                    {
                        x: new Date(1538881200000),
                        y: [6603.5, 6603.99, 6597.5, 6603.86]
                    },
                    {
                        x: new Date(1538883000000),
                        y: [6603.85, 6605, 6600, 6604.07]
                    },
                    {
                        x: new Date(1538884800000),
                        y: [6604.98, 6606, 6604.07, 6606]
                    },
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            title: {
                align: 'left'
            },
            stroke: {
                width: [3, 1]
            },
            tooltip: {
                shared: true,
                custom: [function({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    return w.globals.series[seriesIndex][dataPointIndex]
                }, function({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    var o = w.globals.seriesCandleO[seriesIndex][dataPointIndex]
                    var h = w.globals.seriesCandleH[seriesIndex][dataPointIndex]
                    var l = w.globals.seriesCandleL[seriesIndex][dataPointIndex]
                    var c = w.globals.seriesCandleC[seriesIndex][dataPointIndex]
                    return (
                        ''
                    )
                }]
            },
            xaxis: {
                type: 'datetime'
            }
        };
        var chart7 = new ApexCharts(document.querySelector("#chart-7"), options7);
        chart7.render();



        var options8 = {
            series: [76, 67, 61, 90],
            chart: {
                height: 390,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '30%',
                        background: 'transparent',
                        image: undefined,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: false,
                        }
                    }
                }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: ['SOP', 'WI', 'Engineering', 'Production'],
            legend: {
                show: true,
                floating: true,
                fontSize: '16px',
                position: 'left',
                offsetX: 160,
                offsetY: 15,
                labels: {
                    useSeriesColors: true,
                },
                markers: {
                    size: 0
                },
                formatter: function(seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                },
                itemMargin: {
                    vertical: 3
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };
        var chart8 = new ApexCharts(document.querySelector("#chart-8"), options8);
        chart8.render();



        var options9 = {
            series: [{
                name: "Number of CAPA PR's",
                data: [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07,
                    5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, -27.03, -54.4, -47.2, -43.3, -18.6, -
                    48.6, -41.1, -39.6, -37.6, -29.4, -21.4, -2.4
                ]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    colors: {
                        ranges: [{
                            from: -100,
                            to: -46,
                            color: '#F15B46'
                        }, {
                            from: -45,
                            to: 0,
                            color: '#FEB019'
                        }]
                    },
                    columnWidth: '80%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            yaxis: {
                title: {
                    text: 'Change Control',
                },
                labels: {
                    formatter: function(y) {
                        return y.toFixed(0) + "%";
                    }
                }
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
                    '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
                    '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
                    '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
                    '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
                    '2013-07-01', '2013-08-01', '2013-09-01'
                ],
                labels: {
                    rotate: -90
                }
            }
        };
        var chart9 = new ApexCharts(document.querySelector("#chart-9"), options9);
        chart9.render();



        var options10 = {
            series: [{
                name: 'Class',
                data: [4, 6, 2, 8, 9, 10]
            }, {
                name: "Number of Deviation PR's ",
                data: [53, 32, 33, 52, 13, 43]
            }, {
                name: 'Number of Batch',
                data: [12, 17, 11, 9, 15, 11]
            }, {
                name: 'Deviation Rate',
                data: [33.33, 45, 20, 60, 90, 75]
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        total: {
                            enabled: true,
                            offsetX: 0,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
                labels: {
                    formatter: function(val) {
                        return val
                    }
                }
            },
            yaxis: {
                title: {
                    text: undefined
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
            }
        };
        var chart10 = new ApexCharts(document.querySelector("#chart-10"), options10);
        chart10.render();



        var options11 = {
            series: [{
                name: "Number of IOOSR Occurance",
                data: [
                    [2022.01, 5],
                    [2022.02, 2],
                    [2022.03, 8],
                    [2022.04, 6],
                    [2022.05, 1],
                    [2022.06, 3],
                    [2022.07, 7]
                ]
            }, {
                name: "Number of OOS PR's",
                data: [
                    [2022.01, 2],
                    [2022.02, 8],
                    [2022.03, 1],
                    [2022.04, 9],
                    [2022.05, 4],
                    [2022.06, 5],
                    [2022.07, 3]
                ]
            }, {
                name: "IOOSR Occurance",
                data: [
                    [2022.01, 50],
                    [2022.02, 25],
                    [2022.03, 85.5],
                    [2022.04, 62.9],
                    [2022.05, 19.75],
                    [2022.06, 32.45],
                    [2022.07, 72.65]
                ]
            }],
            chart: {
                height: 350,
                type: 'scatter',
                zoom: {
                    enabled: true,
                    type: 'xy'
                }
            },
            xaxis: {
                tickAmount: 10,
                labels: {
                    formatter: function(val) {
                        return parseFloat(val).toFixed(1)
                    }
                }
            },
            yaxis: {
                tickAmount: 7
            }
        };
        var chart11 = new ApexCharts(document.querySelector("#chart-11"), options11);
        chart11.render();



        var options12 = {
            series: [{
                name: 'Number of EC Failure',
                type: 'column',
                data: [3, 7, 10, 12, 6, 8, 15]
            }, {
                name: "Number of RC PR's",
                type: 'area',
                data: [12, 20, 24, 15, 17, 9, 10]
            }, {
                name: 'EC Failure Rate',
                type: 'line',
                data: [30, 25, 33.33, 50, 45, 25.56, 54.56]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
            },
            stroke: {
                width: [0, 2, 5],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },

            fill: {
                opacity: [0.85, 0.25, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: [
                2022.01, 2022.02, 2022.03, 2022.04, 2022.05, 2022.06, 2022.07
            ],
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                min: 0
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;

                    }
                }
            }
        };
        var chart12 = new ApexCharts(document.querySelector("#chart-12"), options12);
        chart12.render();



        var options13 = {
            series: [{
                name: "Number of Extension PR's",
                type: 'column',
                data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
            }, {
                name: "Number of Change Control PR's",
                type: 'column',
                data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
            }, {
                name: 'Batch Extension Rate',
                type: 'line',
                data: [20, 29, 37, 36, 44, 45, 50, 58]
            }, {
                name: 'On Time Rate',
                type: 'line',
                data: [50, 79, 27, 87, 10, 80, 20, 28]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [1, 1, 4, 4]
            },
            title: {
                align: 'left',
                offsetX: 110
            },
            xaxis: {
                categories: [2022.03, 2022.04, 2022.05, 2022.06, 2022.07, 2022.08, 2022.09, 2022.10],
            },
            yaxis: [{
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        style: {
                            color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                {
                    seriesName: 'Income',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "Number of Change Control PR's",
                        style: {
                            color: '#00E396',
                        }
                    },
                },
                {
                    seriesName: 'Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        text: "Extension Rate",
                        style: {
                            color: '#FEB019',
                        }
                    }
                },
            ],
            tooltip: {
                fixed: {
                    enabled: true,
                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                    offsetY: 30,
                    offsetX: 60
                },
            },
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            }
        };
        var chart13 = new ApexCharts(document.querySelector("#chart-13"), options13);
        chart13.render();


        var options14 = {
            series: [{
                name: 'Number of EC Failure',
                data: [80, 50, 30, 40, 100, 20],
            }, {
                name: "Number of RC PR's",
                data: [20, 30, 40, 80, 20, 80],
            }, {
                name: 'EC Failure Rate',
                data: [44, 76, 78, 13, 43, 10],
            }],
            chart: {
                height: 350,
                type: 'radar',
                dropShadow: {
                    enabled: true,
                    blur: 1,
                    left: 1,
                    top: 1
                }
            },
            stroke: {
                width: 2
            },
            fill: {
                opacity: 0.1
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: ['2011', '2012', '2013', '2014', '2015', '2016']
            }
        };
        var chart14 = new ApexCharts(document.querySelector("#chart-14"), options14);
        chart14.render();


        var options15 = {
            series: [{
                name: 'Documents',
                data: [{
                        x: '2011',
                        y: 12,
                        goals: [{
                            name: 'SOP',
                            value: 14,
                            strokeWidth: 2,
                            strokeDashArray: 2,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: '2012',
                        y: 44,
                        goals: [{
                            name: 'WI',
                            value: 54,
                            strokeWidth: 5,
                            strokeHeight: 10,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: '2013',
                        y: 54,
                        goals: [{
                            name: 'Expected',
                            value: 52,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: '2014',
                        y: 66,
                        goals: [{
                            name: 'Engineering',
                            value: 61,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: '2015',
                        y: 81,
                        goals: [{
                            name: 'Production',
                            value: 66,
                            strokeWidth: 10,
                            strokeHeight: 0,
                            strokeLineCap: 'round',
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: '2016',
                        y: 67,
                        goals: [{
                            name: 'Protocol',
                            value: 70,
                            strokeWidth: 5,
                            strokeHeight: 10,
                            strokeColor: '#775DD0'
                        }]
                    }
                ]
            }],
            chart: {
                height: 350,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            colors: ['#00E396'],
            dataLabels: {
                formatter: function(val, opt) {
                    const goals =
                        opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
                        .goals

                    if (goals && goals.length) {
                        return `${val} / ${goals[0].value}`
                    }
                    return val
                }
            },
            legend: {
                show: true,
                showForSingleSeries: true,
                customLegendItems: ['Documents', 'Type'],
                markers: {
                    fillColors: ['#00E396', '#775DD0']
                }
            }
        };
        var chart15 = new ApexCharts(document.querySelector("#chart-15"), options15);
        chart15.render();



        var options16 = {
            series: [{
                data: [{
                        x: 'SOP',
                        y: [2800, 4500]
                    },
                    {
                        x: 'WI',
                        y: [3200, 4100]
                    },
                    {
                        x: 'Engineering',
                        y: [2950, 7800]
                    },
                    {
                        x: 'Marketing',
                        y: [3000, 4600]
                    },
                    {
                        x: 'Production',
                        y: [3500, 4100]
                    },
                    {
                        x: 'STP',
                        y: [4500, 6500]
                    },
                    {
                        x: 'Specifications',
                        y: [4100, 5600]
                    }
                ]
            }],
            chart: {
                height: 390,
                type: 'rangeBar',
                zoom: {
                    enabled: false
                }
            },
            colors: ['#EC7D31', '#36BDCB'],
            plotOptions: {
                bar: {
                    horizontal: true,
                    isDumbbell: true,
                    dumbbellColors: [
                        ['#EC7D31', '#36BDCB']
                    ]
                }
            },
            legend: {
                show: true,
                showForSingleSeries: true,
                position: 'top',
                horizontalAlign: 'left',
                customLegendItems: ['Overdue', 'Timely']
            },
            fill: {
                type: 'gradient',
                gradient: {
                    gradientToColors: ['#36BDCB'],
                    inverseColors: false,
                    stops: [0, 100]
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            }
        };

        var chart16 = new ApexCharts(document.querySelector("#chart-16"), options16);
        chart16.render();


        var options17 = {
            series: [{
                name: 'Number of EC Failure',
                type: 'column',
                data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
            }, {
                name: "Number of RC PR's",
                type: 'line',
                data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 4]
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1]
            },
            labels: ['01 Jan 2022', '02 Jan 2022', '03 Jan 2022', '04 Jan 2022', '05 Jan 2022', '06 Jan 2022',
                '07 Jan 2022', '08 Jan 2022', '09 Jan 2022', '10 Jan 2022', '11 Jan 2022', '12 Jan 2022'
            ],
            xaxis: {
                type: 'datetime'
            },
            yaxis: [{
                title: {
                    text: 'Website Blog',
                },

            }, {
                opposite: true,
                title: {
                    text: 'Social Media'
                }
            }]
        };

        var chart17 = new ApexCharts(document.querySelector("#chart-17"), options17);
        chart17.render();




        var options18 = {
            series: [44, 55, 67],
            chart: {
                height: 250,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '1.1rem',
                        },
                        value: {
                            fontSize: '0.85rem',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                return 249
                            }
                        }
                    }
                }
            },
            labels: ['SOP', 'WI', 'Production'],
        };

        var chart18 = new ApexCharts(document.querySelector("#chart-18"), options18);
        chart18.render();



        var options19 = {
            series: [{
                name: 'Series 1',
                data: [80, 50, 30, 40, 100, 20],
            }, {
                name: 'Series 2',
                data: [20, 30, 40, 80, 20, 80],
            }, {
                name: 'Series 3',
                data: [44, 76, 78, 13, 43, 10],
            }],
            chart: {
                height: 250,
                type: 'radar',
                dropShadow: {
                    enabled: true,
                    blur: 1,
                    left: 1,
                    top: 1
                }
            },
            stroke: {
                width: 2
            },
            fill: {
                opacity: 0.1
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: ['2011', '2012', '2013', '2014', '2015', '2016']
            }
        };


        var chart19 = new ApexCharts(document.querySelector("#chart-19"), options19);
        chart19.render();


        var options20 = {
            series: [{
                data: [34, 44, 54, 21, 12, 43, 33, 23, 66, 66, 58]
            }],
            chart: {
                type: 'line',
                height: 250
            },
            stroke: {
                curve: 'stepline',
            },
            dataLabels: {
                enabled: false
            },
            title: {
                align: 'left'
            },
            markers: {
                hover: {
                    sizeOffset: 4
                }
            }
        };

        var chart20 = new ApexCharts(document.querySelector("#chart-20"), options20);
        chart20.render();
    </script>

    <style>
        #chart-8 .apexcharts-legend.apx-legend-position-left {
            left: 0 !important;
            top: 0 !important;
        }
    </style>
    <script>

    </script>
@endsection
