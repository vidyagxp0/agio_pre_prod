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
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Evaluation</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Additional Information</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Approval Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Change Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
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
                                            @if(Helpers::checkUserRolesassign_to($data))
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
                                            @if(Helpers::checkUserRolesMicrobiology_Person($data))
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endif    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="due-date">Due Date<span class="text-danger"></span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" name="due_date" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
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
                                            <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('Initiator_Group') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('Initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('Initiator_Group') == 'CS') selected @endif>Central
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
                                                class="text-danger">*</span></label><span id="rchars" class="text-primary">255 </span><span class="text-primary"> characters remaining</span>
                                      
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
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
                                        <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
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
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit</a> </button>
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
                                            <option value="0">-- Select --</option>
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

                    <div id="CCForm4" class="inner-block cctabcontent">
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
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
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

                    {{-- <div id="CCForm5" class="inner-block cctabcontent">
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

                    <div id="CCForm6" class="inner-block cctabcontent">
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

                    <div id="CCForm7" class="inner-block cctabcontent">
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

                    <div id="CCForm8" class="inner-block cctabcontent">
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

                    <div id="CCForm9" class="inner-block cctabcontent">
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
                                            <td><div class="group-input new-date-data-field mb-0">
                                                <div class="input-date "><div
                                                 class="calenderauditee">
                                                <input type="text" id="implementation_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="implementation_date[]" class="hide-input" 
                                                oninput="handleDateInput(this, `implementation_date' + serialNumber +'`)" /></div></div></div></td>
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

                    <div id="CCForm10" class="inner-block cctabcontent">
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
            $('#rchars').text(textlen);});
    </script>
@endsection
