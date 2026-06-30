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
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD/Designee Review</button>
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
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiation Department</label>
                                        <input disabled type="text" value="{{ Helpers::getUserDepartmentFromDB(Auth::user()->departmentid) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 new-date-data-field">
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
                                </div> --}}

                                {{-- <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        if (dateInput.value) {
                                            const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                            document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                        } else {
                                            document.getElementById(displayId).value = '';
                                        }
                                    }
                                </script> --}}

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
                                        <label for="Impact Assesment">Description of Change</label>
                                        <textarea name="impassesment" id="impassesment" cols="30"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Change Proposal And Justification Details Grid
                                            <button type="button" id="traceblity_add">+</button>
                                           
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Sr. No.</th>
                                                        <th>Current Practice</th>
                                                        <th>Proposed Change</th>
                                                        <th>Justification / reason for change</th>
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
                                    Impact Assessment
                                </div>

                                   @php
                                        $questions = [
                                            'q1_1' => 'Availability of Product Permission.',
                                            'q1_2' => 'Availability of Manufacturing License.',
                                            'q1_3' => 'Availability of Marketing Authorization.',
                                            'q1_4' => 'Technical Agreement.',
                                            'q1_5' => 'Site Variation Filing (for New Site).',
                                            'q1_6' => 'New Product Code.',
                                            'q1_7' => 'Facility Qualification / Modification.',
                                            'q1_8' => 'Utility Requirements / Qualification',
                                            'q1_9' => 'New Equipment Req. or Modifications.',
                                            'q1_10' => 'Process Validation.',
                                            'q1_11' => 'Cleaning Validation .',
                                            'q1_12' => 'Master Formula Record.',
                                            'q1_13' => 'Master Packing Record.',
                                            'q1_14' => 'Additional studies.',
                                            'q1_15' => 'Reagents/ Chemicals/ Solvents or any other Resources.',
                                            'q1_16' => 'Equipment/ Instrument Accessories/ Parts / Change Parts & Layout.',
                                            'q1_17' => 'Analytical Method Validation.',
                                            'q1_18' => 'PM BOM.',
                                            'q1_19' => 'BMR.',
                                            'q1_20' => 'BPR.',
                                            'q1_21' => 'Hold Time Study.',
                                            'q1_22' => 'Site Master File.',
                                            'q1_23' => 'Validation Master Plan.',
                                            'q1_24' => 'Requirement of outside test.',
                                            'q1_25' => 'Additional Equipment / Instruments.',
                                            'q1_26' => 'Environmental Condition.',
                                            'q1_27' => 'Testing Feasibility.',
                                            'q1_28' => 'Annual Product Review.',
                                            'q1_29' => 'New Source/ Vendor Requirement.',
                                            'q1_30' => 'Vendor Qualification.',
                                            'q1_31' => 'Approved Vendor List Updation.',
                                            'q1_32' => 'New Code Generation/ Item Codification.',
                                            'q1_33' => 'List of Item Codes.',
                                            'q1_34' => 'Approved Specimen/ Shade Card.',
                                            'q1_35' => 'Status of Old Stocks (for Usage / Destruction).',
                                            'q1_36' => 'Customer/ Contract Giver Approval.',
                                            'q1_37' => 'Process Parameters.',
                                            'q1_38' => 'Training.',
                                            'q1_39' => 'GMP   / GLP Requirements.',
                                            'q1_40' => 'MOC Requirements.',
                                            'q1_41' => 'List of Equipment / instruments.',
                                            'q1_42' => 'New Utility Connections / Modifications.',
                                            'q1_43' => 'Drawings / layouts.',
                                            'q1_44' => 'Equipment P & I Diagram.',
                                            'q1_45' => 'Regulatory Submissions.',
                                            'q1_46' => 'Validation Activity (Other).',
                                            'q1_47' => 'Equipment Location Layout.',
                                            'q1_48' => 'Responsibilities.',
                                            'q1_49' => 'Intimation/ Notification to Regulatory Bodies.',
                                            'q1_50' => 'Quality Management System.',
                                            'q1_51' => 'Facility and Other Layouts.',
                                            'q1_52' => 'Pharmacopeia Requirements.',
                                            'q1_53' => 'Raw Material Specifications.',
                                            'q1_54' => 'Packing Material Specification.',
                                            'q1_55' => 'In process Specification.',
                                            'q1_56' => 'Finished Product Specification.',
                                            'q1_57' => 'Approved Art works/ Proofs.',
                                            'q1_58' => 'Packaging Specification / configuration.',
                                            'q1_59' => 'Status of Existing stock in case of Artwork/ packing material related changes.',
                                            'q1_60' => 'Quality Agreements with vendors.',
                                            'q1_61' => 'Calibration.',
                                            'q1_62' => 'Calibration Planner / Addendum to Calibration Planner.',
                                            'q1_63' => 'Stability Protocol / Report / Stability studies.',
                                            'q1_64' => 'Stability Specification.',
                                            'q1_65' => 'Updating of Product Lists.',
                                            'q1_66' => 'HPLC Column.',
                                            'q1_67' => 'Placebo.',
                                            'q1_68' => 'Impurity standards.',
                                            'q1_69' => 'Primary standards.',
                                            'q1_70' => 'Mfg. Feasibility.',
                                            'q1_71' => 'Qualification document (URS/DQ/IQ/OQ/PQ).',
                                            'q1_72' => 'Manual COA (Raw Material / Finish Product).',
                                            'q1_73' => 'Safety.',
                                            'q1_74' => 'Annual Maintenance Contract.',
                                            'q1_75' => 'Service agreement.',
                                            'q1_76' => 'Qualification / Re-qualification.',
                                            'q1_77' => 'SOP.',
                                            'q1_78' => 'STPs.',
                                            'q1_79' => 'Logbooks.',
                                            'q1_80' => 'Preventive Maintenance.',
                                            'q1_81' => 'Planner for PM / Addendum to PM Planner.',
                                            'q1_82' => 'Regulatory Requirements.',
                                            'q1_83' => 'Tech Transfer.',
                                            'q1_84' => 'Man & Material Movement.',
                                            'q1_85' => 'Temperature / RH/ Differential Pressures.',
                                            'q1_86' => 'Temperature Mapping.',
                                            'q1_87' => 'HVAC Validation.',
                                            'q1_88' => 'Water System Validation.',
                                            'q1_89' => 'Area Nomenclature.',
                                            'q1_90' => 'Qualified Personnel.',
                                            'q1_92' => 'Shelf life.',
                                            'q1_93' => 'Text matter.',
                                            'q1_94' => 'GTIN 1D.',
                                            'q1_95' => 'QR code.',
                                            'q1_96' => 'Pack size.',
                                            'q1_97' => 'Pack style.',
                                            'q1_98' => 'Design.',
                                            'q1_99' => 'Formula.',
                                            'q1_100' => 'API vendor.',
                                            'q1_101' => 'Registration Certificate number.',
                                            'q1_102' => 'Mfg. License number.',
                                            'q1_103' => 'Final COA (Raw Material/ Finish Product).',
                                            'q1_104' => 'Any Other', // Last question with manual input
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
                                                        <th style="width: 50%;">Particular</th>
                                                        <th style="width: 40%;">Yes/No</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($questions as $key => $question)
                                                        @php
                                                            $isLastQuestion = $loop->last;
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}
                                                            </td>

                                                            <td>
                                                                {{ $question }}
                                                                <input type="hidden" name="checklist[{{ $key }}][question]" value="{{ $question }}">
                                                            </td>

                                                            <td>
                                                                @if(!$isLastQuestion)
                                                                    {{-- Yes/No Dropdown for all except last question --}}
                                                                    <select name="checklist[{{ $key }}][response]"
                                                                        style="width:100%; border:1px solid #000; background:#f0f0f0;">
                                                                        <option value="No" 
                                                                            {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response'] == 'Yes' ? '' : 'selected' }}>
                                                                            No
                                                                        </option>
                                                                        <option value="Yes"
                                                                            {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response'] == 'Yes' ? 'selected' : '' }}>
                                                                            Yes
                                                                        </option>
                                                                    </select>
                                                                @else
                                                                    {{-- Manual text input for last question --}}
                                                                    <textarea name="checklist[{{ $key }}][manual_response]" 
                                                                        rows="3"
                                                                        style="width:100%; border:1px solid #ccc; padding:5px;"
                                                                        placeholder="Enter your comments or remarks here...">{{ isset($savedChecklist[$key]['manual_response']) ? $savedChecklist[$key]['manual_response'] : '' }}</textarea>
                                                                @endif
                                                            </td>
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
                            <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
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
                            <label for="Assigned To">HOD/Designee Review Comment</label>
                            <textarea name="reviewer_remarks" id="reviewer_remarks" cols="30" disabled></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="HOD Attachments">HOD/Designee Attachments</label>
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
                            <label for="Assigned To">QA/CQA Head / Designee Approval Comments</label>
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
                            <label for=" Rejected By">HOD/Designee Review By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">HOD/Designee Review On</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">HOD/Designee Review Comment</label>
                            <div class="static"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for=" Rejected By"> QA/CQA Review Complete By By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">QA/CQA Review Complete By On</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">QA/CQA Review Complete By Comment</label>
                            <div class="static"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for=" Rejected By">QA/CQA Head/Designee Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">QA/CQA Head/Designee Complete On</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Rejected On">QA/CQA Head/Designee Complete Comment</label>
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




                    