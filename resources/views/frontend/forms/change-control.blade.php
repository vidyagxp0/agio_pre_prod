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
        <div class="pr-id">
            New Document
        </div>
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            QMS-North America / CAPA
        </div>
        <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div>
    </div>


    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active">General Information1</button>
                <button class="cctablinks">Change Details</button>
                <button class="cctablinks">Risk Assessment</button>
                <button class="cctablinks">QA Review</button>
                <button class="cctablinks">Group Assessment</button>
                <button class="cctablinks">Group Comments</button>
                <button class="cctablinks">QA Evaluation</button>
                <button class="cctablinks">QA Approval Comments</button>
                <button class="cctablinks">Change Closure</button>
                <button class="cctablinks">Activity Log</button>
            </div>
            <form action="#" method="POST">
                <!-- Tab content -->
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="rls">RLS Record Number</label>
                                        <div class="static">QMS-EMEA/PROD/2023/38</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="date_initiation">Date of Initiation</label>
                                        <div class="static">23-12-2999</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To
                                        </label>
                                        <select name="assign_to" id="assign_to">
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                            <option value="1">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span>If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</span></label>
                                        {{--  <input type="date" name="due_date">  --}}
                                        <!-- <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" name="due_date"> -->

                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="due_date"  readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                            class="hide-input"
                                            oninput="handleDateInput(this, 'due_date')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiator Group</label>
                                        <select name="initiatorGroup" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if(old('initiatorGroup') =="CQA") selected @endif>Corporate Quality Assurance</option>
                                            <option value="QAB" @if(old('initiatorGroup') =="QAB") selected @endif>Quality Assurance Biopharma</option>
                                            <option value="CQC" @if(old('initiatorGroup') =="CQA") selected @endif>Central Quality Control</option>
                                            <option value="CQC" @if(old('initiatorGroup') =="CQC") selected @endif>Manufacturing</option>
                                            <option value="PSG" @if(old('initiatorGroup') =="PSG") selected @endif>Plasma Sourcing Group</option>
                                            <option value="CS"  @if(old('initiatorGroup') == "CS") selected @endif>Central Stores</option>
                                            <option value="ITG" @if(old('initiatorGroup') =="ITG") selected @endif>Information Technology Group</option>
                                            <option value="MM"  @if(old('initiatorGroup') == "MM") selected @endif>Molecular Medicine</option>
                                            <option value="CL"  @if(old('initiatorGroup') == "CL") selected @endif>Central Laboratory</option>

                                            <option value="TT"  @if(old('initiatorGroup') == "TT") selected @endif>Tech team</option>
                                            <option value="QA"  @if(old('initiatorGroup') == "QA") selected @endif> Quality Assurance</option>
                                            <option value="QM"  @if(old('initiatorGroup') == "QM") selected @endif>Quality Management</option>
                                            <option value="IA"  @if(old('initiatorGroup') == "IA") selected @endif>IT Administration</option>
                                            <option value="ACC"  @if(old('initiatorGroup') == "ACC") selected @endif>Accounting</option>
                                            <option value="LOG"  @if(old('initiatorGroup') == "LOG") selected @endif>Logistics</option>
                                            <option value="SM"  @if(old('initiatorGroup') == "SM") selected @endif>Senior Management</option>
                                            <option value="BA"  @if(old('initiatorGroup') == "BA") selected @endif>Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-code">Initiator Group Code</label>
                                        <select name="initiator-code">
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description</label>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="nature-change">Nature Of Change</label>
                                        <select name="nature-change">
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
                                        <input type="text" name="div_code">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="support-doc">Supporting Documents</label>
                                        <input type="file" name="support-doc">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
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
                                            {{-- Documents Details <button type="button" name="ann" id="DocDetailbtn">+</button> --}}
                                            Document Details<button type="button" name="ann"
                                                onclick="addDocDetail('doc-detail')">+</button>
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
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Risk Assessment
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-identification">Risk Identification</label>
                                        <textarea name="risk-identification"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="severity">Severity</label>
                                        <select name="severity">
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurance">Occurance</label>
                                        <select name="Occurance">
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <select name="Detection">
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <select name="RPN">
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                            <option value="1">Demo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-evaluation">Risk Evaluation</label>
                                        <textarea name="risk-evaluation"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="migration-action">Migration Action</label>
                                        <textarea name="migration-action"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_change">Type of Change</label>
                                        <select name="type_chnage">
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
                                        <input type="text" name="related_records">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Concerned Groups
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group_review">Is Group Review Required?</label>
                                        <select name="goup_review">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production">Production</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production-Person">Production Person</label>
                                        <select name="Production-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Control">Quality Control</label>
                                        <select name="Quality-Control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Control-Person">Quality Control Person</label>
                                        <select name="Quality-Control-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">Microbiology</label>
                                        <select name="Microbiology">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">Microbiology Person</label>
                                        <select name="Microbiology-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse">Warehouse1</label>
                                        <select name="Warehouse">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Warehouse-Person">Warehouse Person</label>
                                        <select name="Warehouse-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering">Engineering</label>
                                        <select name="Engineering">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering-Person">Engineering Person</label>
                                        <select name="Engineering-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Instrumentation">Instrumentation</label>
                                        <select name="Instrumentation">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Instrumentation-Person">Instrumentation Person</label>
                                        <select name="Instrumentation-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Validation">Validation</label>
                                        <select name="Validation">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Validation-Person">Validation Person</label>
                                        <select name="Validation-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research-Development">Research & Development</label>
                                        <select name="Research-Development">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research-Development-Person">Research & Development Person</label>
                                        <select name="Research-Development-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="packaging_Development">Packaging Development</label>
                                        <select name="packaging_Development">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="packaging_Development-Person">Packaging Development Person</label>
                                        <select name="packaging_Development-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_international">Business Development (Interntional)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_international-Person">Business Development (Interntional)
                                            Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Business Development (Domestic)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Business Development (Domestic) Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Safety)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Safety) Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Environment)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Environment)
                                            Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Health Safety Environment (Health)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Health Safety Environment (Health) Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Customer Group</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Customer Group Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Regulatory Affairs (International)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Regulatory Affairs (International) Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Regulatory Affairs (Domestic)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Regulatory Affairs (Domestic) Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Qualified (QP)</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Qualified Person (QP)</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Information Technology</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Information Technology Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Procurement</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Procurement Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Clinical Pharmacology Unit</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Clinical Pharmacology Unit Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Project Management</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Project Management Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Clinical Operations</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Clinical Operations Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Bioanalytical Laboratory</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Bioanalytical Laboratory Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Pharmacovigilance</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Pharmacovigilance Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Medical Writing</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Medical Writing Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Statistics</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Statistics Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Data Management</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Data Management Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Logistics</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Logistics Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic">Others</label>
                                        <select name="Production">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Others Person</label>
                                        <select name="B-Person">
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                            <option value="name">Piyush Sahu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Production Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Quality Control Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Microbiology Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Warehouse Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Engineering Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Instrumentation Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Validation Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">R & D Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Packaging Development Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">BD (International) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">BD (Domestic) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">HSE (Safety) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">HSE (Environment) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">HSE (Health) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Customer Group</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">RA (International) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">RA (Domestic) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Qualified Person (QP) Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">IT Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Procurement Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">CP Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Project Management Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Clinical Operations Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">BL Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Pharmacovigilance Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Medical Writing Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Statistics Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Data Management Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Logistics Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Others Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group-attachments">Group Attachments</label>
                                        <input type="file" name="group-attachments">
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                QA Detail
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">QA Evaluation Comments</label>
                                <textarea name="qa-eval-comments"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                <input type="file" name="qa-eval-attach">
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="qa-appro-comments">QA Approval Comments</label>
                                <textarea name="qa-appro-comments"></textarea>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="risk-assessment">
                                    Affected Documents<button type="button" name="ann"
                                        onclick="addAffectedDocuments('affected-documents')">+</button>
                                </label>
                                <table class="table table-bordered" id="affected-documents">
                                    <thead>
                                        <th>Sr. No.</th>
                                        <th>Affected Documents</th>
                                        <th>Document Name</th>
                                        <th>Document No.</th>
                                        <th>Version No.</th>
                                        <th>Implementation Date</th>
                                        <th>New Document No.</th>
                                        <th>New Version No.</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="qa-closure-comments">QA Closure Comments</label>
                                <textarea name="qa-closure-comments"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="attach-list">List Of Attachments</label>
                                <input type="file" name="attach-list">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="effective-check">Effectivess Check Required?</label>
                                        <select name="effective-check">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="effective-check-date">Effectiveness Check Creation Date</label>
                                        <!-- <input type="date" name="effective-check-date"> -->

                                        <div class="calenderauditee">                                     
                                        <input type="text"  id="effective-check-date"  readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="effective-check-date" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'effective-check-date')"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Electronic Signatures
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Submitted On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Review Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Review Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Reviewed By (QA)</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Reviewed On (QA)</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Plan Requested By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Plan Requested On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Evaluated By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Evaluated On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Requested By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Requested On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Selected By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Additional Groups Selected On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Approved By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Change Approved On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QAH?Desig More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QAH?Desig More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Action Items Completed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Action Items Completed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Closed By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CC Closed On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">QA More Info Required On</label>
                                        <div class="static">12-12-2032</div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-head">
                                Electronic Signatures - Group Assessment
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Production Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Production Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Quality Control Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Quality Control Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Microbiology Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Microbiology Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Warehouse Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Warehouse Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Engineering Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Engineering Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Instrumentation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Instrumentation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Validation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Validation Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">R & D Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">R & D Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Packaging Dev Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Packaging Dev Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BD (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Safety) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Safety) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Environment) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Environment) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Health) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">HSE (Health) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Customer Group Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Customer Group Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (International) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">RA (Domestic) Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Qualified Person Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Qualified Person Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">IT Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">IT Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Procurement Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Procurement Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CP Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">CP Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Project Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Project Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Clinical Operations Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Clinical Operations Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BL Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">BL Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Pharmacovigiance Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Pharmacovigiance Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Medical Writing Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Medical Writing Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Statistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Statistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Data Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Data Management Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Logistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Logistics Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Others Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted">Others Feedback By</label>
                                        <div class="static">Piyush Sahu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
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
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>

    <script>
        VirtualSelect.init({
            ele: '#cft_reviewer'
        });



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
@endsection
