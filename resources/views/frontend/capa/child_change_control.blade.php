@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        header .header_rcms_bottom {
            display: none;
        }
    </style>
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">


                <div class="slogan">
                    <strong>Division / Project :</strong>
                    QMS-EMEA /Capa Child / Change Control
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Additional Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Approval Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Change Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Materials and Product</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Activity Log</button>
            </div>
            <form action="{{ route('CC.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tab content -->
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="rls">Record Number</label>
                                        <div class="static">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        <div class="static">{{ Auth::user()->name }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="date_initiation">Date of Initiation</label>
                                        <div class="static">{{ date('d-M-Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                        <!-- <input type="date" name="due_date"> -->
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="due_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')"/>
                                        </div>
                                        @error('due_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Inititator Group <span
                                                class="text-danger">*</span></label>
                                        <select name="initiatorGroup" id="initiator-group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA">Corporate Quality Assurance</option>
                                            <option value="QAB">Quality Assurance Biopharma</option>
                                            <option value="CQC">Central Quality Control</option>
                                            <option value="CQC">Manufacturing</option>
                                            <option value="PSG">Plasma Sourcing Group</option>
                                            <option value="CS">Central Stores</option>
                                            <option value="ITG">Information Technology Group</option>
                                            <option value="MM">Molecular Medicine</option>
                                            <option value="CL">Central Laboratory</option>
                                        </select>
                                        @error('initiatorGroup')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-code">Initiator Group Code</label>
                                        <div class="default-name"> <span id="initiator-code">Not selected</span></div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" id="short_description"></textarea>
                                        @error('short_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="div_code">Division Code</label>
                                        <select name="div_code">
                                            <option value="0">-- Select --</option>
                                            <option value="P1">P1</option>
                                            <option value="P2">P2</option>
                                            <option value="P3">P3</option>
                                            <option value="P4A">P4A</option>
                                            <option value="P4B">P4B</option>
                                            <option value="P5">P5</option>
                                            <option value="P6">P6</option>
                                            <option value="P7">P7</option>
                                            <option value="RLS">RLS</option>
                                            <option value="CRS">CRS</option>
                                        </select>
                                    </div>
                                </div>
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
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="support-doc">Supporting Documents</label>
                                        <input type="file" name="support-doc">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

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
                                                    <td><input type="text" name="serial_number[]"></td>
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_change">Type of Change</label>
                                        <select name="type_chnage">
                                            <option value="0">-- Select --</option>
                                            <option value="major">Major</option>
                                            <option value="minor">Minor</option>
                                            <option value="critical">Critical</option>
                                            <option value="like">Like for like</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="qa_head">QA Attachments</label>
                                        <input type="file" name="qa_head">
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
                                            <option value="31">QMS-EMEA/PROD/2023/31</option>
                                            <option value="32">QMS-EMEA/PROD/2023/32</option>
                                            <option value="33">QMS-EMEA/PROD/2023/33</option>
                                            <option value="34">QMS-EMEA/PROD/2023/34</option>
                                            <option value="35">QMS-EMEA/PROD/2023/35</option>
                                            <option value="36">QMS-EMEA/PROD/2023/36</option>
                                            <option value="37">QMS-EMEA/PROD/2023/37</option>
                                            <option value="38">QMS-EMEA/PROD/2023/38</option>
                                        </select>
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
                            <div class="group-input">
                                <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                <input type="file" name="qa_eval_attach">
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

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Concerned Information
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group_review">Is Group Review Required?</label>
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
                                        <label for="Microbiology">CFT Reviewer</label>
                                        <select name="Microbiology">
                                            <option value="0">-- Select --</option>
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
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <select multiple name="cft_reviewer[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            <option value="1">Amit Guru</option>
                                            <option value="2">Shaleen Mishra</option>
                                            <option value="3">Anshul Patel</option>
                                            <option value="4">Amit Patel</option>
                                            <option value="5">Piyush Sahu</option>
                                            <option value="6">Vikas Prajapati</option>
                                            <option value="7">Gopal Sen</option>
                                            <option value="8">Anshul Jain</option>
                                        </select> --}}
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
                                        <label for="additional_attachments">Additional Attachments</label>
                                        <input type="file" name="additional_attachments">
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

                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">QA Comments</label>
                                        <textarea name="qa_comments"></textarea>
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
                                        <label for="comments">Group Comments</label>
                                        <textarea name="Group_comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group-attachments">Group Attachments</label>
                                        <input type="file" name="group_attachments">
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
                                        <label for="severity">Severity</label>
                                        <select name="severity">
                                            <option value="0">-- Select --</option>
                                            <option value="Negligible">Negligible</option>
                                            <option value="Minor">Minor</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="Major">Major</option>
                                            <option value="Fatel">Fatel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurance">Occurance</label>
                                        <select name="Occurance">
                                            <option value="0">-- Select --</option>
                                            <option value="Extremely-Unlikely">Extremely Unlikely</option>
                                            <option value="Rare">Rare</option>
                                            <option value="Unlikely">Unlikely</option>
                                            <option value="Likely">Likely</option>
                                            <option value="Very-Likely">Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <select name="Detection">
                                            <option value="0">-- Select --</option>
                                            <option value="Impossible">Impossible</option>
                                            <option value="Rare">Rare</option>
                                            <option value="Unlikely">Unlikely</option>
                                            <option value="Likely">Likely</option>
                                            <option value="Very-Likely">Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <select name="RPN">
                                            <option value="0">-- Select --</option>
                                            <option value="10%">10%</option>
                                            <option value="20%">20%</option>
                                            <option value="30%">30%</option>
                                            <option value="40%">40%</option>
                                            <option value="50%">50%</option>
                                            <option value="60%">60%</option>
                                            <option value="70%">70%</option>
                                            <option value="80%">80%</option>
                                            <option value="90%">90%</option>
                                            <option value="100%">100%</option>
                                        </select>
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
                                <input type="file" name="tran_attach">
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
                                            <td><input type="text" name="serial_number[]"></td>

                                            <td><input type="text" name="affected_documents[]">
                                            </td>
                                            <td><input type="text" name="document_name[]">
                                            </td>
                                            <td><input type="number" name="document_no[]">
                                            </td>
                                            <td><input type="text" name="version_no[]">
                                            </td>
                                            <td><input type="date" name="implementation_date[]">
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
                                <input type="file" name="attach_list">
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
                                        <!-- <input type="date" name="effective_check_date"> -->
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="effective_check_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="effective_check_date" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'effective_check_date')"/>
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
                            @php
                            $product = DB::table('products')->get();
                            $material = DB::table('materials')->get();
                            @endphp
                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input" id="productSelectContain">
                                <label for="product">Product Details Required?</label>
                                <select name="product" id="productSelect">
                                    <option value="0">-- Select --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="group-input" id="productTable">
                                <label for="risk-assessment">
                                    Product Information<button type="button" name="ann"
                                        id="addProductDetail">+</button>
                                </label>
                                <table class="table table-bordered" id="product-detail">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Plant</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Market</th>
                                            <th>Customer</th>
                                            <th>Product For</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" value"1" name="serial_number[]">1.</td>
                                             <td><input type="text" name="plant[]"></td>
                                            <td><select name="product_code[]" class="product-info">
                                                <option value="-">--</option>
                                                @foreach($product as $materials)
                                                <option value="{{$materials->market}}" data-id="{{$materials->product_name}}" data-value="{{$materials->customer}}" data-price="{{$materials->product_for}}" >{{$materials->product_code}}</option>
                                                @endforeach
                                            </select></td>
                                              <td><span class="product-name">Not selected</span></td>
                                            <td><span class="product-market">Not selected</span></td>
                                            <td><span class="product-customer">Not selected</span></td>
                                             <td><span class="product-for">Not selected</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="product">Material Details Required?</label>
                                <select name="product" id="materialSelect">
                                    <option value="0">-- Select --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="group-input" id="materialTable">
                                <label for="risk-assessment">
                                    Material Information<button type="button" name="ann"
                                        id="addMaterialDetail">+</button>
                                </label>
                                <table class="table table-bordered" id="material-detail">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Plant</th>
                                            <th>Material Code</th>
                                            <th>Material Name</th>
                                            <th>Market</th>
                                            <th>Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" value"1" name="serial_number[]">1</td>
                                            <td><input type="text" name="plant[]"></td>
                                            <td><select name="material_code[]" class="material-info">
                                                <option value="-">--</option>
                                                @foreach($material as $materials)
                                                <option value="{{$materials->market}}" data-id="{{$materials->material_name}}" data-value="{{$materials->customer}}" >{{$materials->material_code}}</option>
                                                @endforeach
                                            </select></td>
                                            <td><span class="material-name">Not selected</span></td>
                                            <td><span class="material-market">Not selected</span></td>
                                            <td><span class="material-customer">Not selected</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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

                    <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Electronic Signatures
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Cancelled On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required By</label>
                                        {{--  <div class="static">Piyush Sahu</div>  --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">More Information Required On</label>
                                        {{--  <div class="static">12-12-2032</div>  --}}
                                    </div>
                                </div>
                                {{--  <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Supervisor Reviewed By (QA)</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Supervisor Reviewed On (QA)</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CFT Reviewed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CFT Reviewed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CFT Review Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CFT Review Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Training Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Training Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA Final Review Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA Final Review Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>  --}}
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


    <style>
        #step-form>div {
            display: none;
        }

        #step-form>div:nth-child(1) {
            display: block;
        }

        #productTable, #materialTable{
            display: none;
        }
    </style>

    <script>
        const productSelect = document.getElementById('productSelect');
        const productTable = document.getElementById('productTable');
        const materialSelect = document.getElementById('materialSelect');
        const materialTable = document.getElementById('materialTable');

        materialSelect.addEventListener('change', function () {
            if (materialSelect.value === 'yes') {
                materialTable.style.display = 'block';
            } else {
                materialTable.style.display = 'none';
            }
        });

        productSelect.addEventListener('change', function () {
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
    <!-- Add this in your HTML layout or view -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- Example Blade View -->
    @if ($errors->any())
        <script>
            var errorMessages = [];
            @foreach ($errors->all() as $error)
                errorMessages.push("{{ $error }}");
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: errorMessages.join('<br>'),
                showCloseButton: true,
                customClass: {
                    title: 'my-title-class',
                    htmlContainer: 'my-html-class text-danger',
                },
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    {{-- var riskData = @json($riskData); --}}


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

    <style>
        .swal2-container.swal2-center.swal2-backdrop-show .swal2-icon.swal2-error.swal2-icon-show,
        .swal2-container.swal2-center.swal2-backdrop-show .selectize-control.swal2-select.single {
            display:none !important;
        }

        .swal2-container.swal2-center.swal2-backdrop-show #swal2-title {
            text-align:center;
            font-size: 1.5rem !important;
        }

        .swal2-container.swal2-center.swal2-backdrop-show .swal2-html-container.my-html-class {
            text-transform:capitalize !important;
        }
    </style>
@endsection
