@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        header .header_rcms_bottom {
            display: none;
        }

        .calenderauditee {
            position: relative;
        }

        .new-date-data-field .input-date input.hide-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .new-date-data-field input {
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px 15px;
            display: block;
            width: 100%;
            background: white;
        }

        .calenderauditee input::-webkit-calendar-picker-indicator {
            width: 100%;
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

    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">


                <div class="slogan">
                    <strong>Site Division / Project </strong>:
                    {{ Helpers::getDivisionName(session()->get('division')) }} / Change Control
                </div>
            </div>
        </div>
    </div>
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    @php
        $users = DB::table('users')->get();
    @endphp
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Impact Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm12')">CFT</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Evaluation</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Additional Information</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">QA Approval Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Change Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Activity Log</button>
            </div>
            <form action="{{ route('CC.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tab content -->
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/CC/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Division Code</b></label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($hod as $data)
                                                @if (Helpers::checkUserRolesassign_to($data))
                                                    <option @if (old('assign_to') == $data->id) selected @endif
                                                        value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">CFT Reviewer</label>
                                        <select name="Microbiology">
                                            <option value="0" selected>-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Person</label>
                                        <select multiple name="Microbiology_Person[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            {{-- <option value="0">-- Select --</option>  --}}
                                            @foreach ($cft as $data)
                                                @if (Helpers::checkUserRolesMicrobiology_Person($data))
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="due-date">Due Date<span class="text-danger"></span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" name="due_date" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiator Group <span
                                                class="text-danger">*</span></label>
                                        <select name="Initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>
                                                Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('Initiator_Group') == 'CQA') selected @endif>
                                                Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('Initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('Initiator_Group') == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if (old('Initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('Initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('Initiator_Group') == 'CL') selected @endif>
                                                Central Laboratory</option>
                                            <option value="TT" @if (old('Initiator_Group') == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA" @if (old('Initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('Initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('Initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('Initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('Initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('Initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('Initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                        {{-- @error('Initiator_Group')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description <span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description" id="short_description">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>  --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars"
                                            class="text-primary">255 </span><span class="text-primary"> characters
                                            remaining</span>

                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness,
                                            guiding priority for corrective actions. Ranging from low to high, they ensure
                                            quality standards and mitigate critical risks.</span>
                                        <select name="severity_level1">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="initiated_through">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_through_req"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="repeat">Repeat</label>
                                        <div><small class="text-primary">Please select yes if it is has recurred in past
                                                six months</small></div>
                                        <select name="repeat"
                                            onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Repeat Nature<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="repeat_nature"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="risk_level">Risk Level</label>
                                        <select name="risk_level" id="risk_level" class="mb-0">
                                            <option value="0">-- Select --</option>
                                            <option value="critical">Critical</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                        </select>
                                        <div class="ai_text">AI Suggested option</div>
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="nature-change">Nature Of Change</label>
                                        <select name="natureChange">
                                            <option value="0">-- Select --</option>
                                            <option value="Temporary">Temporary</option>
                                            <option value="Permanent">Permanent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="others">If Others</label>
                                        <textarea name="others"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="div_code">Division Code</label>
                                        <select name="div_code">
                                            <option value="0">-- Select --</option>
                                            <option value="Instrumental Lab">Instrumental Lab</option>
                                            <option value="Microbiology Lab">Microbiology Lab</option>
                                            <option value="Molecular lab">Molecular lab</option>
                                            <option value="Physical Lab">Physical Lab</option>
                                            <option value="Stability Lab">Stability Lab</option>
                                            <option value="Wet Chemistry">Wet Chemistry</option>
                                            {{-- <option value="IPQA Lab">IPQA Lab</option> --}}
                                            <option value="Quality Department">Quality Department</option>
                                            <option value="Administration Department">Administration Department</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="others">Initial attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="in_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="in_attachment[]"
                                                    oninput="addMultipleFiles(this, 'in_attachment')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}">Exit</a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Change Details
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="doc-detail">
                                            Document Details<button type="button" name="ann"
                                                id="DocDetailbtn">+</button>
                                        </label>
                                        <table class="table-bordered table" id="doc-detail">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Current Document No.</th>
                                                    <th>Current Version No.</th>
                                                    <th>New Document No.</th>
                                                    <th>New Version No.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" value="1" name="serial_number[]"
                                                            readonly></td>
                                                    <td><input type="text" name="current_doc_number[]"></td>
                                                    <td><input type="text" name="current_version[]"></td>
                                                    <td><input type="text" name="new_doc_number[]"></td>
                                                    <td><input type="text" name="new_version[]"></td>
                                                </tr>
                                                <div id="docdetaildiv"></div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Current Practice
                                        </label>
                                        <textarea name="current_practice"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="proposed_change">
                                            Proposed Change
                                        </label>
                                        <textarea name="proposed_change"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="reason_change">
                                            Reason for Change
                                        </label>
                                        <textarea name="reason_change"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="other_comment">
                                            Any Other Comments
                                        </label>
                                        <textarea name="other_comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="supervisor_comment">
                                            Supervisor Comments
                                        </label>
                                        <textarea name="supervisor_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="col-12">
                            <div class="group-input">
                                <div class="why-why-chart">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Sr.No.</th>
                                                <th style="width: 40%;">Question</th>
                                                <th style="width: 20%;">Response</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                                <td class="flex text-center">1</td>
                                                <td>Availability of Product Permission </td>
                                                <td>

                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_1" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                               <td>
                                                    {{--<textarea name="where_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_1" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>


                                            </tr>
                                             <tr>
                                                <td class="flex text-center">2</td>
                                                <td>Availability of Manufacturing License</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_2" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="where_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_2" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">3</td>
                                                <td>Availability of Marketing Authorization</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_3" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="when_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_3" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">4</td>
                                                <td>Technical Agreement</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_4" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="coverage_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_4" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">5</td>
                                                <td>Site Variation Filing (for New Site)</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_5" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_5" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">6</td>
                                                <td>New Product Code</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_6" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_6" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">7</td>
                                                <td>Facility Qualification / Modification</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_7" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_7" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">8</td>
                                                <td>Utility Requirements / Qualification</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_8" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_8" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">9</td>
                                                <td>Additional studies</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_9" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_9" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">10</td>
                                                <td>Reagents/ Chemicals/ Solvents or any other Resources</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_10" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_10" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">11</td>
                                                <td>Equipment/ Instrument Accessories/ Parts / Change Parts & Layout</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_11" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_11" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">12</td>
                                                <td>Analytical Method Validation</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_12" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_12" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">13</td>
                                                <td>Storage Requirement</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_13" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_13" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">14</td>
                                                <td>BMR</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_14" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_14" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">15</td>
                                                <td>BPR</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_15" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_15" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">16</td>
                                                <td>Hold Time Study</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_16" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_16" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">17</td>
                                                <td>Testing Feasibility</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_17" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_17" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">18</td>
                                                <td>Annual Product Review</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_18" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_18" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">19</td>
                                                <td>New Source/ Vendor Requirement</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_19" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_19" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">20</td>
                                                <td>Vendor Qualification</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_20" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_20" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">21</td>
                                                <td>Approved Vendor List Updation</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_21" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_21" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">21</td>
                                                <td>New Code Generation/ Item Codification</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_21" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_21" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">22</td>
                                                <td>List of Item Codes</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_22" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_22" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">23</td>
                                                <td>Approved Specimen/ Shade Card</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_23" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_23" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">24</td>
                                                <td>MOC Requirements</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_24" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_24" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">25</td>
                                                <td>List of Equipment / instruments</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_25" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_25" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">26</td>
                                                <td>New Utility Connections / Modifications</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_26" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_26" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">27</td>
                                                <td>Drawings / layouts</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_27" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_27" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">28</td>
                                                <td>Equipment P & I Diagram</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_28" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_28" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">29</td>
                                                <td>Regulatory Submissions</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_29" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_29" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">30</td>
                                                <td>Validation Activity (Other)</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_30" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_30" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">31</td>
                                                <td>Equipment Location Layout</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_31" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_31" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">32</td>
                                                <td>New Equipment Req. or Modifications</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_32" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_32" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">33</td>
                                                <td>Process Validation</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_33" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_33" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">34</td>
                                                <td>Cleaning Validation / Stability studies</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_34" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_34" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">35</td>
                                                <td>Master Formula Record</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_35" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_35" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">36</td>
                                                <td>Master Packing Record</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_36" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_36" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">37</td>
                                                <td>Raw Material Specifications</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_37" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_37" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">38</td>
                                                <td>Packing Material Specification</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_38" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_38" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">39</td>
                                                <td>In process Specification</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_39" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_39" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">40</td>
                                                <td>Finished Product Specification</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_40" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_40" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">41</td>
                                                <td>Approved Art works/ Proofs</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_41" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_41" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">42</td>
                                                <td>Packaging Specification / configuration</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_42" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_42" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">43</td>
                                                <td>Site Master File</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_43" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_43" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">44</td>
                                                <td>Validation Master Plan</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_44" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_44" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">45</td>
                                                <td>Requirement of outside test</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_45" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_45" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">46</td>
                                                <td>Additional Equipment / Instruments</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_46" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_46" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">47</td>
                                                <td>Environmental Condition</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_47" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_47" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">48</td>
                                                <td>Stability Protocol / Report</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_48" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_48" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">49</td>
                                                <td>Stability Specification</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_49" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_49" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">50</td>
                                                <td>Updating of Product Lists</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_50" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_50" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">51</td>
                                                <td>HPLC Column</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_51" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_51" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">52</td>
                                                <td>Placebo</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_52" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_52" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">53</td>
                                                <td>Impurity standards</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_53 id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_53" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">54</td>
                                                <td>Status of Old Stocks (for Usage I Destruction)</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_54" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_54" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">55</td>
                                                <td>Customer/ Contract Giver Approval</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_55" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_55" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">56</td>
                                                <td>Process Parameters</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_56" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_56" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">57</td>
                                                <td>Training</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_57" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_57" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">58</td>
                                                <td>GMP / GLP Requirements</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_58" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_58" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">59</td>
                                                <td>Safety</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_59" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_59" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">60</td>
                                                <td>Annual Maintenance Contract</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_60" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_60" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">61</td>
                                                <td>Service agreement</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_61" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_61" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">62</td>
                                                <td>Qualification / Re-qualification</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_62" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_62" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">63</td>
                                                <td>SOP</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_63" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_63" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">64</td>
                                                <td>STPs</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_64" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_64" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">65</td>
                                                <td>Responsibilities</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_65" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_65" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">66</td>
                                                <td>Intimation/ Notification to Regulatory Bodies</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_66" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_66" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">67</td>
                                                <td>Quality Management System</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_67" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_67" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">68</td>
                                                <td>Facility and Other Layouts</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_68" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_68" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">69</td>
                                                <td>Pharmacopeia Requirements</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_69" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_69" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">70</td>
                                                <td>Regulatory Requirements</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_70" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_70" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">71</td>
                                                <td>Tech Transfer</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_71" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_71" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">72</td>
                                                <td>Man & Material Movement</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_72" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_72" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">73</td>
                                                <td>Temperature / RH/ Differential Pressures</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_73" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_73" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">74</td>
                                                <td>Temperature Mapping</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_74" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_74" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">75</td>
                                                <td>HVAC Validation</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_75" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_75" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">76</td>
                                                <td>Status of Existing stock in case of Artwork/ packing material related
                                                    changes</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_76" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_76" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">77</td>
                                                <td>Primary standards</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_77" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}}
                                                     <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_77" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">78</td>
                                                <td>Logbooks</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_78" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_78" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">79</td>
                                                <td>Water System Validation</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_79" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_79" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">80</td>
                                                <td>Quality Agreements with vendors</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_80" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_80" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">81</td>
                                                <td>Mfg. Feasibility</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_81" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_81" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">82</td>
                                                <td>Preventive Maintenance</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_82" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_82" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">83</td>
                                                <td>Area Nomenclature</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_83" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_83" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">84</td>
                                                <td>Calibration</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_84" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_84" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">85</td>
                                                <td>Qualification document (URS/DQ/IQ/OQ/PQ)</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_85" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_85" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">86</td>
                                                <td>Planner for PM</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_86" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_86" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">87</td>
                                                <td>Qualified Personnel</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_87" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_87" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">88</td>
                                                <td>Master Calibration Planner</td>
                                                <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_88" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_88" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                             <tr>
                                                <td class="flex text-center">89</td>
                                                <td>Any other</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response_89" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                     {{-- <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div> --}}
                                                </td>
                                                <td>
                                                    {{--<textarea name="who_will_not_be"></textarea>--}} <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="remark_89" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>

                                        </tbody>
                                     
                                    </table>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                                Exit </a> </button>
        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="type_change">
                                            Type of Change
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#change-control-type-of-change-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor:pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <select name="type_chnage">
                                            <option value="">-- Select --</option>
                                            <option value="major">Major</option>
                                            <option value="minor">Minor</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA Review Comments</label>
                                        <textarea name="qa_comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-search="false" data-silent-initial-value-set="true"
                                            id="related_records">
                                            @foreach ($pre as $prix)
                                                <option value="{{ $prix->id }}">
                                                    {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="qa head">QA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_head"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head[]"
                                                    oninput="addMultipleFiles(this, 'qa_head')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Evaluation Detail
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">QA Evaluation Comments</label>
                                <textarea name="qa_eval_comments"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_eval_attach"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="qa_eval_attach[]"
                                                oninput="addMultipleFiles(this, 'qa_eval_attach')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sub-head">
                            Training Information
                        </div>
                        <div class="group-input">
                            <label for="nature-change">Training Required</label>
                            <select name="training_required">
                                <option value="0">-- Select --</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="train-comments">Training Comments</label>
                            <textarea name="train_comments"></textarea>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>

                {{-- <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                CFT Information
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">CFT Reviewer</label>
                                        <select name="Microbiology">
                                            <option value="0" selected>-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Person</label>
                                        <select multiple name="Microbiology_Person[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            <option value="0">-- Select --</option>
                                            @foreach ($cft as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="sub-head">
                                Concerned Information
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group_review">Is Concerned Group Review Required?</label>
                                        <select name="goup_review">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production">Production</label>
                                        <select name="Production">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production-Person">Production Person</label>
                                        <select name="Production_Person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Approver">Quality Approver</label>
                                        <select name="Quality_Approver">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Approver-Person">Quality Approver Person</label>
                                        <select name="Quality_Approver_Person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Others</label>
                                        <select name="bd_domestic">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Others Person</label>
                                        <select name="Bd_Person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="additional attachments">Additional Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="additional_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="additional_attachments[]"
                                                    oninput="addMultipleFiles(this, 'additional_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div> --}}

                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            Feedback
                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="comments">Comments</label>
                                    <textarea name="cft_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="comments">Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="cft_attchament"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="cft_attchament[]"
                                                oninput="addMultipleFiles(this, 'cft_attchament')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sub-head">
                                Concerned Feedback
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">QA Comments</label>
                                    <textarea name="qa_commentss"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">QA Head Designee Comments</label>
                                    <textarea name="designee_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Warehouse Comments</label>
                                    <textarea name="Warehouse_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Engineering Comments</label>
                                    <textarea name="Engineering_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Instrumentation Comments</label>
                                    <textarea name="Instrumentation_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Validation Comments</label>
                                    <textarea name="Validation_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Others Comments</label>
                                    <textarea name="Others_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="comments">Comments</label>
                                    <textarea name="Group_comments"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="group-attachments">Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="group_attachments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="group_attachments[]"
                                                oninput="addMultipleFiles(this, 'group_attachments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>

                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            Risk Assessment
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="risk-identification">Risk Identification</label>
                                    <textarea name="risk_identification"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Severity Rate">Severity Rate</label>
                                    <select name="severity" id="analysisR" onchange='calculateRiskAnalysis(this)'>
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="1">Negligible</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Major</option>
                                        <option value="4">Fatal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Occurrence">Occurrence</label>
                                    <select name="Occurance" id="analysisP" onchange='calculateRiskAnalysis(this)'>
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="5">Extremely Unlikely</option>
                                        <option value="4">Rare</option>
                                        <option value="3">Unlikely</option>
                                        <option value="2">Likely</option>
                                        <option value="1">Very Likely</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Detection">Detection</label>
                                    <select name="Detection" id="analysisN" onchange='calculateRiskAnalysis(this)'>
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="5">Impossible</option>
                                        <option value="4">Rare</option>
                                        <option value="3">Unlikely</option>
                                        <option value="2">Likely</option>
                                        <option value="1">Very Likely</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RPN">RPN</label>
                                    <div><small class="text-primary">Auto - Calculated</small></div>
                                    <input type="text" name="RPN" id="analysisRPN" readonly>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="risk-evaluation">Risk Evaluation</label>
                                    <textarea name="risk_evaluation"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="migration-action">Migration Action</label>
                                    <textarea name="migration_action"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>

                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="group-input">
                            <label for="qa-appro-comments">QA Approval Comments</label>
                            <textarea name="qa_appro_comments"></textarea>
                        </div>
                        <div class="group-input">
                            <label for="feedback">Training Feedback</label>
                            <textarea name="feedback"></textarea>
                        </div>
                        <div class="group-input">
                            <label for="tran-attach">Training Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                            </div>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="tran_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="tran_attach[]"
                                        oninput="addMultipleFiles(this, 'tran_attach')" multiple>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                </div>

                <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="group-input">
                            <label for="risk-assessment">
                                Affected Documents<button type="button" name="ann"
                                    id="addAffectedDocumentsbtn">+</button>
                            </label>
                            <table class="table table-bordered" id="affected-documents">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Affected Documents</th>
                                        <th>Document Name</th>
                                        <th>Document No.</th>
                                        <th>Version No.</th>
                                        <th>Implementation Date</th>
                                        <th>New Document No.</th>
                                        <th>New Version No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" Value="1" name="serial_number[]" readonly>
                                        </td>

                                        <td><input type="text" name="affected_documents[]">
                                        </td>
                                        <td><input type="text" name="document_name[]">
                                        </td>
                                        <td><input type="number" name="document_no[]">
                                        </td>
                                        <td><input type="text" name="version_no[]">
                                        </td>
                                        {{-- <td><input type="date" name="implementation_date[]">
                                            </td> --}}
                                        <td>
                                            <div class="group-input new-date-data-field mb-0">
                                                <div class="input-date ">
                                                    <div class="calenderauditee">
                                                        <input type="text"
                                                            id="implementation_date' + serialNumber +'" readonly
                                                            placeholder="DD-MMM-YYYY" />
                                                        <input type="date" name="implementation_date[]"
                                                            class="hide-input"
                                                            oninput="handleDateInput(this, `implementation_date' + serialNumber +'`)" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><input type="text" name="new_document_no[]">
                                        </td>
                                        <td><input type="text" name="new_version_no[]">
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="group-input">
                            <label for="qa-closure-comments">QA Closure Comments</label>
                            <textarea name="qa_closure_comments"></textarea>
                        </div>
                        <div class="group-input">
                            <label for="attach-list">List Of Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                            </div>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attach_list"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attach_list[]"
                                        oninput="addMultipleFiles(this, 'attach_list')" multiple>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12 sub-head">
                                Effectiveness Check Details
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="effective-check">Effectivess Check Required?</label>
                                        <select name="effective_check">
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="effective-check-date">Effectiveness Check Creation Date</label>
                                        <div class="calenderauditee">
                                        <input type="text"  id="effective_check_date"  readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="effective_check_date" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'effective_check_date')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness_checker">Effectiveness Checker</label>
                                        <select name="Effectiveness_checker">
                                            <option value="">Enter Your Selection Here</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="effective_check_plan">Effectiveness Check Plan</label>
                                        <textarea name="effective_check_plan"></textarea>
                                    </div>
                                </div> --}}
                        <div class="col-12 sub-head">
                            Extension Justification
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="due_date_extension">Due Date Extension Justification</label>
                                <div><small class="text-primary">Please Mention justification if due date is
                                        crossed</small></div>
                                <textarea name="due_date_extension"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                Exit </a> </button>

                    </div>
                </div>
        </div>
        @php
            $product = DB::table('products')->get();
            $material = DB::table('materials')->get();
        @endphp

        <div id="CCForm11" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Electronic Signatures
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Submit By</label>
                            {{--  <div class="static">Piyush Sahu</div>  --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Submit On</label>
                            {{--  <div class="static">12-12-2032</div>  --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled By</label>
                                         <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled On</label>
                                     <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required By</label>
                                          <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required On</label>
                                          <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">HOD Review Complete By</label>
                            {{-- <div class="static">Piyush Sahu</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">HOD Review Complete On</label>
                            {{-- <div class="static">12-12-2032</div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Req. By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Req. On</label>
                                         <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA Review Completed By</label>
                                         <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA Review Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Info Req. By</label>
                                         <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Info Req. On</label>
                                         <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Send to CFT/SME/QA Review By</label>
                            {{-- <div class="static">Piyush Sahu</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Send to CFT/SME/QA Review On</label>
                            {{-- <div class="static">12-12-2032</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">CFT/SME/QA Review Not required By</label>
                            {{-- <div class="static">Piyush Sahu</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">CFT/SME/QA Review Not required On</label>
                            {{-- <div class="static">12-12-2032</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Review Completed By</label>
                            {{-- <div class="static">Piyush Sahu</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Review Completed On</label>
                            {{-- <div class="static">12-12-2032</div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Implemented By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Implemented On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Information Required By</label>
                                         <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Information Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div> --}}
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Implemented By</label>
                            {{-- <div class="static">Piyush Sahu</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted">Implemented On</label>
                            {{-- <div class="static">12-12-2032</div> --}}
                        </div>
                    </div>
                </div>
                <div class="button-block">
                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                            Exit </a> </button>
                    <button type="submit">Submit</button>
                </div>
            </div>
        </div>

        <div id="CCForm12" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Production
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.p_erson').hide();

                                        $('[name="Production_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.p_erson').show();
                                                $('.p_erson span').show();
                                            } else {
                                                $('.p_erson').hide();
                                                $('.p_erson span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Review">Production Review Required ?</label>
                                        <select name="Production_Review" id="Production_Review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 p_erson">
                                    <div class="group-input">
                                        <label for="Production person">Production Person</label>
                                        <select name="Production_person" id="Production_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 p_erson" >
                                    <div class="group-input">
                                        <label for="Production assessment">Impact Assessment (By Production)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Production_assessment" id="summernote-17">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 p_erson">
                                    <div class="group-input">
                                        <label for="Production feedback">Production Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Production_feedback" id="summernote-18">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 p_erson">
                                    <div class="group-input">
                                        <label for="production attachment"> Production Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="production_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="production_attachment[]"
                                                    oninput="addMultipleFiles(this, 'production_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 p_erson">
                                    <div class="group-input">
                                        <label for="Production Review Completed By">Production Review Completed By</label>
                                        <input disabled type="text" name="production_by" id="production_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field p_erson">
                                    <div class="group-input input-date">
                                        <label for="Production Review Completed On">Production Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="production_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="production_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'production_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.warehouse').hide();

                                        $('[name="Warehouse_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.warehouse').show();
                                                $('.warehouse span').show();
                                            } else {
                                                $('.warehouse').hide();
                                                $('.warehouse span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Warehouse
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Warehouse Review Required">Warehouse Review Required ?</label>
                                        <select name="Warehouse_review" id="Warehouse_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 23, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 warehouse">
                                    <div class="group-input">
                                        <label for="Customer notification">Warehouse Person</label>
                                        <select name="Warehouse_notification" id="Warehouse_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Warehouse_assessment" id="summernote-19">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="productionfeedback">Warehouse Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Warehouse_feedback" id="summernote-20">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 warehouse">
                                    <div class="group-input">
                                        <label for="Warehouse attachment"> Warehouse Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Warehouse_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Warehouse_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="Warehousefeedback">Warehouse Review Completed By</label>
                                        <input disabled type="text" name="Warehouse_by" id="Warehouse_by">

                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field warehouse">
                                    <div class="group-input input-date">
                                        <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Warehouse_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Warehouse_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Warehouse_on')" />
                                        </div>
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
                                        $('.analytical_development').hide();

                                        $('[name="Analytical_Development_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.analytical_development').show();
                                                $('.analytical_development span').show();
                                            } else {
                                                $('.analytical_development').hide();
                                                $('.analytical_development span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ?</label>
                                        <select name="Analytical_Development_review" id="Analytical_Development_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person">Analytical Development
                                            Laboratory Person</label>
                                        <select name="Analytical_Development_person" id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory)</label>
                                        <textarea class="" name="Analytical_Development_assessment" id="summernote-27">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback</label>
                                        <textarea class="" name="Analytical_Development_feedback" id="summernote-28">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 analytical_development">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Analytical_Development_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical
                                            Development Laboratory Review Completed By</label>
                                        <input type="text" name="Analytical_Development_by"
                                            id="Analytical_Development_by" disabled>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical Development Laboratory Review Completed On</label>
                                        <input type="date" name="Analytical_Development_on" disabled>

                                    </div>
                                </div> --}}
                                <div class="col-lg-6 new-date-data-field analytical_development">
                                    <div class="group-input input-date">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Analytical_Development_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Analytical_Development_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Analytical_Development_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.kilo_lab').hide();

                                        $('[name="Kilo_Lab_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.kilo_lab').show();
                                                $('.kilo_lab span').show();
                                            } else {
                                                $('.kilo_lab').hide();
                                                $('.kilo_lab span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ?</label>
                                        <select name="Kilo_Lab_review" id="Kilo_Lab_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 kilo_lab">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person</label>
                                        <select name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab)</label>
                                        <textarea class="" name="Kilo_Lab_assessment" id="summernote-29">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab
                                            Feedback</label>
                                        <textarea class="" name="Kilo_Lab_feedback" id="summernote-30">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 kilo_lab">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Kilo_Lab_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input type="text" name="Kilo_Lab_attachment_by"
                                            id="Kilo_Lab_attachment_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field kilo_lab">
                                    <div class="group-input input-date">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Kilo_Lab_attachment_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Kilo_Lab_attachment_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Kilo_Lab_attachment_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.technology_transfer').hide();

                                        $('[name="Technology_transfer_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.technology_transfer').show();
                                                $('.technology_transfer span').show();
                                            } else {
                                                $('.technology_transfer').hide();
                                                $('.technology_transfer span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required
                                            ?</label>
                                        <select name="Technology_transfer_review" id="Technology_transfer_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person</label>
                                        <select name="Technology_transfer_person" id="Technology_transfer_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design)</label>
                                        <textarea class="" name="Technology_transfer_assessment" id="summernote-31">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback</label>
                                        <textarea class="" name="Technology_transfer_feedback" id="summernote-32">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 technology_transfer">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Technology_transfer_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Review Completed By">Technology Transfer / Design Review
                                            Completed By</label>
                                        <input type="text" name="Technology_transfer_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field technology_transfer">
                                    <div class="group-input input-date">
                                        <label for="Design Review Completed On">Technology Transfer / Design Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Technology_transfer_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Technology_transfer_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Technology_transfer_on')" />
                                        </div>
                                    </div>
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
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required
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
                                        <label for="Safety Person"> Environment, Health & Safety Person</label>
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
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety)</label>
                                        <textarea class="" name="Health_Safety_assessment" id="summernote-33">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety Feedback</label>
                                        <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
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
                                        <label for="productionfeedback">Environment, Health & Safety Review Completed
                                            By</label>
                                        <input type="text" name="Environment_Health_Safety_by"
                                            id="Environment_Health_Safety_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field environmental_health">
                                    <div class="group-input input-date">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
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
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Administration Review Required">Human Resource & Administration Review
                                            Required ?</label>
                                        <select name="Human_Resource_review" id="Human_Resource_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 human_resources" >
                                    <div class="group-input">
                                        <label for="Administration Person"> Human Resource & Administration Person</label>
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
                                        <label for="Impact Assessment9">Impact Assessment (By Human Resource &
                                            Administration )</label>
                                        <textarea class="" name="Human_Resource_assessment" id="summernote-35">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback</label>
                                        <textarea class="" name="Human_Resource_feedback" id="summernote-36">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Human Resource & Administration
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration
                                            Review Completed By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by"
                                            disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field human_resources">
                                    <div class="group-input input-date">
                                        <label for="Administration Review Completed On">Human Resource & Administration
                                            Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Human_Resource_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Human_Resource_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Human_Resource_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.information_technology').hide();

                                        $('[name="Information_Technology_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.information_technology').show();
                                                $('.information_technology span').show();
                                            } else {
                                                $('.information_technology').hide();
                                                $('.information_technology span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ?</label>
                                        <select name=" Information_Technology_review"
                                            id=" Information_Technology_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person</label>
                                        <select name=" Information_Technology_person"
                                            id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="" name="Information_Technology_assessment" id="summernote-37">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback"> Information Technology
                                            Feedback</label>
                                        <textarea class="" name="Information_Technology_feedback" id="summernote-38">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 information_technology">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Information_Technology_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology
                                            Review Completed By</label>
                                        <input type="text" name="Information_Technology_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field information_technology">
                                    <div class="group-input input-date">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Information_Technology_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Information_Technology_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Information_Technology_on')" />
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
                                    Project Management
                                </div>
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ?</label>
                                        <select name="Project_management_review" id="Project_management_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person</label>
                                        <select name="Project_management_person" id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management
                                            )</label>
                                        <textarea class="" name="Project_management_assessment" id="summernote-39">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback</label>
                                        <textarea class="" name="Project_management_feedback" id="summernote-40">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 project_management">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Project_management_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review
                                            Completed By</label>
                                        <input type="text" name="Project_management_by"id="Project_management_by"
                                            disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field project_management">
                                    <div class="group-input input-date">
                                        <label for="Project management Review Completed On">Information Technology Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Project_management_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Project_management_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Project_management_on')" />
                                        </div>
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
                                            <option value="Project management">Project management</option>



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
                                <button type="submit" id="ChangesaveButton" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button"  class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" id="ChangeNextButton" class="nextButton"
                                    onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>

                        </div>
                    </div>
    </div>
    </form>

    </div>
    </div>

    <div class="modal fade" id="change-control-type-of-change-instruction-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Instructions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <h4>1. Major Change:</h4>
                    <ul>
                        <li>A major change is usually a significant alteration that may have a substantial impact on the
                            product.</li>

                        <li>It might involve modifications to the manufacturing process, formulation, equipment, or other
                            critical aspects of production.</li>

                        <li>Major changes often require thorough assessment, validation, and regulatory approval before
                            implementation.</li>
                    </ul>


                    <h4>2. Minor Change:</h4>
                    <ul>

                        <li>A minor change is typically a less significant alteration, one that is unlikely to have a
                            substantial impact on product quality, safety, or efficacy.</li>

                        <li>Minor changes may include adjustments to documentation, labeling, or other non-critical aspects
                            that don't significantly affect the product's characteristics.</li>

                        <li>These changes may still require some level of evaluation and documentation but may not
                            necessitate the same level of scrutiny as major changes.</li>
                    </ul>


                    <h4>3. Critical Change:</h4>
                    <ul>

                        <li>A critical change is one that has the potential to significantly impact product quality, safety,
                            or efficacy and may require immediate attention.</li>

                        <li>These changes are often associated with unexpected events or deviations that need prompt
                            resolution to maintain product integrity.</li>

                        <li>Critical changes may require urgent assessment, corrective actions, and regulatory reporting.
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <style>
        #step-form>div {
            display: none;
        }

        #step-form>div:nth-child(1) {
            display: block;
        }

        #productTable,
        #materialTable {
            display: none;
        }
    </style>

    <script>
        const productSelect = document.getElementById('productSelect');
        const productTable = document.getElementById('productTable');
        const materialSelect = document.getElementById('materialSelect');
        const materialTable = document.getElementById('materialTable');

        materialSelect.addEventListener('change', function() {
            if (materialSelect.value === 'yes') {
                materialTable.style.display = 'block';
            } else {
                materialTable.style.display = 'none';
            }
        });

        productSelect.addEventListener('change', function() {
            if (productSelect.value === 'yes') {
                productTable.style.display = 'block';
            } else {
                productTable.style.display = 'none';
            }
        });
    </script>

    <script>
        VirtualSelect.init({
            ele: '#related_records, #cft_reviewer'
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
        function calculateRiskAnalysis(selectElement) {
            // Get the row containing the changed select element
            let row = selectElement.closest('tr');

            // Get values from select elements within the row
            let R = parseFloat(document.getElementById('analysisR').value) || 0;
            let P = parseFloat(document.getElementById('analysisP').value) || 0;
            let N = parseFloat(document.getElementById('analysisN').value) || 0;

            // Perform the calculation
            let result = R * P * N;

            // Update the result field within the row
            document.getElementById('analysisRPN').value = result;
        }
    </script>
    {{-- var riskData = @json($riskData); --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() { //DISABLED PAST DATES IN APPOINTMENT DATE
            var dateToday = new Date();
            var month = dateToday.getMonth() + 1;
            var day = dateToday.getDate();
            var year = dateToday.getFullYear();

            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;

            $('#dueDate').attr('min', maxDate);
        });
    </script>

    <script>
        $(document).ready(function() {
            var aiText = $('.ai_text');


            console.log(riskData);
            $('#short_description').on('input', function() {
                var description = $(this).val().toLowerCase();
                var riskLevelSelectize = $('#risk_level')[0].selectize;
                // var aiText = $('#ai_text');

                var foundRiskLevel = false;
                for (var i = 0; i < riskData.length; i++) {
                    if (description.includes(riskData[i].keyword.toLowerCase())) {
                        riskLevelSelectize.setValue(riskData[i].risk_level, true);
                        aiText.show();
                        foundRiskLevel = true;
                        console.log(riskData[i].keyword);
                        break;
                    }
                }
                if (!foundRiskLevel) {
                    riskLevelSelectize.setValue('0', true);
                    aiText.hide();
                }
            });

            $('#risk_level').on('change', function() {
                if ($(this).val() !== '0') {
                    aiText.hide();
                }
            });
        });
    </script>
    <script>
        // JavaScript
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>

    <style>
        .swal2-container.swal2-center.swal2-backdrop-show .swal2-icon.swal2-error.swal2-icon-show,
        .swal2-container.swal2-center.swal2-backdrop-show .selectize-control.swal2-select.single {
            display: none !important;
        }

        .swal2-container.swal2-center.swal2-backdrop-show #swal2-title {
            text-align: center;
            font-size: 1.5rem !important;
        }

        .swal2-container.swal2-center.swal2-backdrop-show .swal2-html-container.my-html-class {
            text-transform: capitalize !important;
        }
    </style>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
