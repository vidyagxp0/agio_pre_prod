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


    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :{{ Helpers::getDivisionName(session()->get('division')) }}/Change Proposal Justification
           
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
                <button class="cctablinks " onclick="openCity(event, 'CCForm3')">QA/CQA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Head Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>

            </div>
            <form action="{{ route('cpjstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tab content -->
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                              

                               <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Record Number">Record Number</label>
                                            <input type="hidden" name="record" id="record" >
                                     {{--   <input disabled type="text" name="record"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/ERRATA/{{ date('Y') }}/{{ $record_number }}">--}}
                                               <input disabled type="text" name="record" id="record" placeholder="Record Number">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Site/Location Code</label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        <input disabled type="text" value="{{ Auth::user()->name }}">
                                        {{-- <input disabled type="text" name="" value="{{ Helpers::getInitiatorName($data->initiator_id)  }}"> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date">Due Date <span class="text-danger">*</span>
                                        </label>

                                        <div class="calenderauditee">
                                            <!-- Display formatted date (Initial placeholder) -->
                                            <input disabled type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" required />

                                            <!-- Hidden input field to allow the user to pick a date -->
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="hide-input" oninput="handleDateInput(this, 'due_date_display')" required/>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        if (dateInput.value) {
                                            const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                            document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                        } else {
                                            document.getElementById(displayId).value = '';
                                        }
                                    }
                                </script>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        Characters remaining
                                        <input id="docname" type="text" name="cpdescription" maxlength="255" required>
                                    </div>
                                </div>
                                <script>
                                    var maxLength = 255;
                                    $('#docname').keyup(function() {
                                        var textlen = maxLength - $(this).val().length;
                                        $('#rchars').text(textlen);
                                    });
                                </script>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Impact Assesment">Impact Assesment</label>
                                        <textarea name="impassesment" id="impassesment" cols="30"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Change Proposal Justificatin Grid
                                            <button type="button" id="traceblity_add">+</button>
                                           
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
                                                                name="change_proposal_grid[0][serial]" value="1">
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

                                                    '<td><input disabled type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber + 1) + '"></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][existing_system]"></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][proposed_change]"></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][justification]"></td>' +

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


                                <div class="sub-head">
                                    Change Proposal And Justification Checklist
                                </div>

                                    @php
                                        $questions = [
                                        'q3_1' => 'Availability of Product Permission.',
                                        'q3_2' => 'Availability of Manufacturing License.',
                                        'q3_3' => 'Availability of Marketing Authorization.',
                                        'q3_4' => 'Technical Agreement.',
                                        'q3_5' => 'Site Variation Filing (for New Site).',
                                        'q3_6' => 'New Product Code.',
                                        'q3_7' => 'Facility Qualification / Modification.',
                                        'q3_8' => 'Utility Requirements / Qualification',
                                        'q3_9' => 'New Equipment Req. or Modifications.',
                                        'q3_10' => 'Process Validation.',
                                        'q3_11' => 'Cleaning Validation .',
                                        'q3_12' => 'Master Formula Record.',
                                        'q3_13' => 'Master Packing Record.',
                                        'q3_14' => 'Additional studies.',
                                        'q3_15' => 'Reagents/ Chemicals/ Solvents or any other Resources.',
                                        'q3_16' => 'Equipment/ Instrument Accessories/ Parts / Change Parts & Layout.',
                                        'q3_17' => 'Analytical Method Validation.',
                                        'q3_18' => 'PM BOM.',
                                        'q3_19' => 'BMR.',
                                        'q3_20' => 'Hold Time Study.',
                                        'q3_21' => 'Site Master File.',
                                        'q3_22' => 'Validation Master Plan.',
                                        'q3_23' => 'Requirement of outside test.',
                                        'q3_24' => 'Additional Equipment / Instruments.',
                                        'q3_25' => 'Environmental Condition.',
                                        'q3_26' => 'Testing Feasibility.',
                                        'q3_27' => 'Annual Product Review.',
                                        'q3_28' => 'New Source/ Vendor Requirement.',
                                        'q3_29' => 'Vendor Qualification.',
                                        'q3_30' => 'Approved Vendor List Updation.',
                                        'q3_31' => 'New Code Generation/ Item Codification.',
                                        'q3_32' => 'List of Item Codes.',
                                        'q3_33' => 'Approved Specimen/ Shade Card.',
                                        'q3_34' => 'Status of Old Stocks (for Usage / Destruction).',
                                        'q3_35' => 'Customer/ Contract Giver Approval.',
                                        'q3_36' => 'Process Parameters.',
                                        'q3_37' => 'Training.',
                                        'q3_38' => 'GMP   / GLP Requirements.',
                                        'q3_39' => 'MOC Requirements.',
                                        'q3_40' => 'List of Equipment / instruments.',
                                        'q3_41' => 'New Utility Connections / Modifications.',
                                        'q3_42' => 'Drawings / layouts.',
                                        'q3_43' => 'Equipment P & I Diagram.',
                                        'q3_44' => 'Regulatory Submissions.',
                                        'q3_45' => 'Equipment Location Layout.',
                                        'q3_46' => 'Responsibilities.',
                                        'q3_47' => 'Intimation/ Notification to Regulatory Bodies.',
                                        'q3_48' => 'Quality Management System.',
                                        'q3_49' => 'Facility and Other Layouts.',
                                        'q3_50' => 'Pharmacopeia Requirements.',
                                        'q3_51' => 'Raw Material Specifications.',
                                        'q3_52' => 'Packing Material Specification.',
                                        'q3_53' => 'In process Specification.',
                                        'q3_54' => 'Finished Product Specification.',
                                        'q3_55' => 'Approved Art works/ Proofs.',
                                        'q3_56' => 'Packaging Specification / configuration.',
                                        'q3_57' => 'Status of Existing stock in case of Artwork/ packing material related changes.',
                                        'q3_58' => 'Quality Agreements with vendors.',
                                        'q3_59' => 'Calibration.',
                                        'q3_60' => 'Calibration Planner / Addendum to Calibration Planner.',
                                        'q3_61' => 'Stability Protocol / Report / Stability studies.',
                                        'q3_62' => 'Stability Specification.',
                                        'q3_63' => 'Updating of Product Lists.',
                                        'q3_64' => 'HPLC Column.',
                                        'q3_65' => 'Placebo.',
                                        'q3_66' => 'Primary standards.',
                                        'q3_67' => 'Mfg. Feasibility.',
                                        'q3_68' => 'Qualification document (URS/DQ/IQ/OQ/PQ).',
                                        'q3_69' => 'Manual COA (Raw Material / Finish Product).',
                                        'q3_70' => 'Safety.',
                                        'q3_71' => 'Annual Maintenance Contract.',
                                        'q3_72' => 'Service agreement.',
                                        'q3_73' => 'Qualification / Re-qualification.',
                                        'q3_74' => 'SOP.',
                                        'q3_75' => 'STPs.',
                                        'q3_76' => 'Logbooks.',
                                        'q3_77' => 'Preventive Maintenance.',
                                        'q3_78' => 'Planner for PM / Addendum to PM Planner.',
                                        'q3_79' => 'Regulatory Requirements.',
                                        'q3_80' => 'Tech Transfer.',
                                        'q3_81' => 'Man & Material Movement.',
                                        'q3_82' => 'Temperature / RH/ Differential Pressures.',
                                        'q3_83' => 'Temperature Mapping.',
                                        'q3_84' => 'HVAC Validation.',
                                        'q3_85' => 'Water System Validation.',
                                        'q3_86' => 'Area Nomenclature.',
                                        'q3_87' => 'Qualified Personnel.',
                                        'q3_88' => 'Any other.',
                                        'q3_89' => 'Shelf life.',
                                        'q3_90' => 'Text matter.',
                                        'q3_91' => 'GTIN 1D.',
                                        'q3_92' => 'QR code.',
                                        'q3_93' => 'Pack size.',
                                        'q3_94' => 'Pack style.',
                                        'q3_95' => 'Design.',
                                        'q3_96' => 'Formula.',
                                        'q3_97' => 'API vendor.',
                                        'q3_98' => 'Registration Certificate number.',
                                        'q3_99' => 'Mfg. License number.',

                                    ];

                                        $savedChecklist = isset($checklistData->data) ? $checklistData->data : [];
                                    @endphp

                                    <div class="col-12">
                                        <div class="group-input">
                                            <div class="why-why-chart">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Sr. No.</th>
                                                            <th style="width: 40%;">Question</th>
                                                            <th style="width: 20%;">Response</th>
                                                            {{-- <th>Remarks</th> --}}
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($questions as $key => $question)
                                                        <tr>
                                                            <td class="text-center">
                                                                1.{{ $loop->iteration }}
                                                            </td>

                                                            {{-- <td>
                                                                {{ $question }}
                                                                <input type="hidden" name="checklist[{{ $key }}][question]" value="{{ $question }}">
                                                            </td> --}}

                                                            <td>
                                                                {{ $question }}
                                                            </td>

                                                            <td>
                                                                <select name="checklist[{{ $key }}][response]"
                                                                    style="width:100%; border:1px solid #000; background:#f0f0f0;">

                                                                    <option value="">Select</option>

                                                                    <option value="Yes"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response']=='Yes' ? 'selected' : '' }}>
                                                                        Yes
                                                                    </option>

                                                                    <option value="No"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response']=='No' ? 'selected' : '' }}>
                                                                        No
                                                                    </option>

                                                                    <option value="N/A"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response']=='N/A' ? 'selected' : '' }}>
                                                                        N/A
                                                                    </option>

                                                                </select>
                                                            </td>

                                                            {{-- <td>
                                                                <textarea name="checklist[{{ $key }}][remark]"
                                                                    style="width:100%; border-radius:5px;">
                                                                    {{ $savedChecklist[$key]['remark'] ?? '' }}
                                                                </textarea>
                                                            </td> --}}
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachment Extension">Initiator Attachment</label>
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
                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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
                                        oninput="addMultipleFiles(this, 'file_attachment_reviewer')" multiple disabled>
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
                                        oninput="addMultipleFiles(this, 'file_attachment_approver')" multiple disabled>
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

        {{-- Qa CQA Head Approval --}}
        <div id="CCForm4" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Assigned To">QA/CQA Head Approve Comments</label>
                            <textarea name="qa_cqa_head_comment" id="qa_cqa_head_comment" cols="30" disabled></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Guideline Attachment">QA/CQA Head Approval Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting
                                    documents</small></div>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="qa_cqa_head_Attachment"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="qa_cqa_head_Attachment[]"
                                        oninput="addMultipleFiles(this, 'qa_cqa_head_Attachment')" multiple disabled>
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
        <div id="CCForm5" class="inner-block cctabcontent">
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
   
@endsection




                    