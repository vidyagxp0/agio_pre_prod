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

        .remove-file{
            cursor: pointer;
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

    <script>
        $(document).ready(function() {
            let docIndex = 1;
            $('#documentAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        ' <td><input type="text" name="documentDetails[' + docIndex + '][currentDocNumber]"></td>' +
                        ' <td><input type="text"name="documentDetails[' + docIndex +'][currentVersionNumber]"></td>' +
                        '<td><input type="text" name="documentDetails[' + docIndex + '][newDocNumber]"></td>' +
                        '<td><input type="text" name="documentDetails[' + docIndex + '][newVersionNumber\]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';

                    docIndex++;
                    return html;
                }
                var tableBody = $('#documentTableDetails tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let affectedDocIndex = 1;
            $('#affectedDocAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        ' <td><input type="text" name="affectedDocuments[' + affectedDocIndex + '][afftectedDoc]"></td>' +
                        ' <td><input type="text"name="affectedDocuments[' + affectedDocIndex +'][documentName]"></td>' +
                        '<td><input type="number" name="affectedDocuments[' + affectedDocIndex + '][documentNumber]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocIndex + '][versionNumber]"></td>' +
                        ' <td><input type="date"name="affectedDocuments[' + affectedDocIndex +'][implimentationDate]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocIndex + '][newDocumentNumber]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocIndex + '][newVersionNumber]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';

                    docIndex++;
                    return html;
                }
                var tableBody = $('#affectedDocAddTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
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
    @php
        $users = DB::table('users')->get();
    @endphp
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')" style="display: none" id="riskAssessmentButton">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Initial HOD Review</button>
               
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Impact Assessment</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm12')">CFT</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA Final Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm15')">RA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm16')">QA/CQA Designee Approval</button>
    
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Evaluation</button> -->
            
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')"> Initiator Update</button>
              
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">HOD Final Review</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm16')">HOD </button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Implementation Verification by QA/CQA</button>
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
                                        <input disabled type="text" placeholder="Record Number" readonly>
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

                                <!-- <div class="col-md-6">
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
                                            <option value="" selected>-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div> -->

                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Person</label>
                                        <select multiple name="Microbiology_Person[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            {{-- <option value="">-- Select --</option>  --}}
                                            @foreach ($cft as $data)
                                                @if (Helpers::checkUserRolesMicrobiology_Person($data))
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->

                                <!-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small></div>
                                        <div class="calenderauditee">
                                            <input disabled type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                       

                                    </div>
                                </div> -->

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date</label>
                                        <div>
                                            <small class="text-primary">If revising Due Date, kindly mention the revision reason in the "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <!-- Display formatted date (Initial placeholder) -->
                                            <input disabled type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" />
                                
                                            <!-- Hidden input field to allow the user to pick a date -->
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="hide-input" oninput="handleDateInput(this, 'due_date_display')" />
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
                                
                                    // Ensure the correct format is shown on page load (if you want to pre-fill with today's date)
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        if (!dateInput.value) {
                                            dateInput.value = "{{ \Carbon\Carbon::now()->format('Y-m-d') }}";
                                            handleDateInput(dateInput, 'due_date_display');
                                        }
                                    });
                                </script>
                                
                                <style>
                                    .hide-input {
                                        display: none;
                                    }
                                </style>
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiation Department 
                                          </label>
                                                <select name="Initiator_Group" id="initiator_group">
                                                        <option value="">Select Initiation Department</option>
                                                        <option value="CQA" >Corporate Quality Assurance</option>
                                                        <option value="QA" >Quality Assurance</option>
                                                        <option value="QC" >Quality Control</option>
                                                        <option value="QM" >Quality Control (Microbiology department)</option>
                                                        <option value="PG" >Production General</option>
                                                        <option value="PL" >Production Liquid Orals</option>
                                                        <option value="PT" >Production Tablet and Powder</option>
                                                        <option value="PE" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC" >Production Capsules</option>
                                                        <option value="PI" >Production Injectable</option>
                                                        <option value="EN" >Engineering</option>
                                                        <option value="HR" >Human Resource</option>
                                                        <option value="ST" >Store</option>
                                                        <option value="IT" >Electronic Data Processing</option>
                                                        <option value="FD" >Formulation  Development</option>
                                                        <option value="AL" >Analytical research and Development Laboratory</option>
                                                        <option value="PD">Packaging Development</option>
                                                        <option value="PU">Purchase Department</option>
                                                        <option value="DC">Document Cell</option>
                                                        <option value="RA">Regulatory Affairs</option>
                                                        <option value="PV">Pharmacovigilance</option>
                                                    </select>
                                        {{-- @error('Initiator_Group')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiation Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code" placeholder="Initiator Group Code"
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

                                <script>
                                    $(document).ready(function() {
                                        function toggleRiskAssessmentAndJustification() {
                                            var riskAssessmentRequired = $('#risk_assessment_required').val();
                                            
                                            // Toggle Risk Assessment Button
                                            if (riskAssessmentRequired === 'yes') {
                                                $('#riskAssessmentButton').show();
                                                $('#justification_div').hide(); // Hide justification when "Yes" is selected
                                            } else if (riskAssessmentRequired === 'no') {
                                                $('#riskAssessmentButton').hide();
                                                $('#justification_div').show(); // Show justification when "No" is selected
                                            } else {
                                                $('#riskAssessmentButton').hide();
                                                $('#justification_div').hide(); // Hide everything if nothing is selected
                                            }
                                        }
                                        
                                        toggleRiskAssessmentAndJustification(); // Initial call to set the correct state
                                        
                                        // Call the function on dropdown change
                                        $('#risk_assessment_required').change(function() {
                                            toggleRiskAssessmentAndJustification();
                                        });
                                    });
                                </script>

                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Risk Assessment Required">Risk Assessment Required? </label>
                                        <select name="risk_assessment_required" id="risk_assessment_required">
                                            <option value="">-- Select --</option>
                                            <option @if ($data->risk_assessment_required == 'yes') selected @endif value='yes'>Yes</option>
                                            <option @if ($data->risk_assessment_required == 'no') selected @endif value='no'>No</option>
                                        </select>
                                       
                                    </div>
                                </div> -->
                                


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Risk Assessment Required">Risk Assessment Required? </label>
                                        <select name="risk_assessment_required" id="risk_assessment_required">
                                            <option value="">-- Select --</option>
                                            <option @if (property_exists($data, 'risk_assessment_required') && $data?->risk_assessment_required == 'yes') selected @endif value='yes'>Yes</option>
                                            <option @if (property_exists($data, 'risk_assessment_required') && $data?->risk_assessment_required == 'no') selected @endif value='no'>No</option>
                                        </select>
                                       
                                    </div>
                                </div>



                                <div class="col-lg-6" id="justification_div" style="display:none;">
                                    <div class="group-input">
                                        <label for="Justification">Justification</label>
                                        <textarea name="risk_identification" id="justification" rows="4" placeholder="Provide justification if risk assessment is not required."></textarea>
                                        <!-- @error('justification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror -->
                                    </div>
                                </div>

                                            @php
                                            $division = DB::table('q_m_s_divisions')
                                                ->where('name', Helpers::getDivisionName(session()->get('division')))
                                                ->first();
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 4,
                                                        'q_m_s_divisions_id' => $division->id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $hodRoles = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                            @endphp

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="hod_person">HOD Person</label>
                                                    <select name="hod_person" id="hod_person" >
                                                        <option value="">Select HOD Person</option>
                                                        @if($hodRoles)
                                                            @foreach($hodRoles as $user)
                                                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


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



                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="change_related_to">Change Related To</label>
                                        <!-- <select name="severity" id="change_related_to">
                                            <option value="">-- Select --</option>
                                            <option value="process" {{ old('severity', $data->severity ?? '') == 'process' ? 'selected' : '' }}>Process</option>
                                            <option value="facility" {{ old('severity', $data->severity ?? '') == 'facility' ? 'selected' : '' }}>Facility</option>
                                            <option value="utility" {{ old('severity', $data->severity ?? '') == 'utility' ? 'selected' : '' }}>Utility</option>
                                            <option value="equipment" {{ old('severity', $data->severity ?? '') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                            <option value="document" {{ old('severity', $data->severity ?? '') == 'document' ? 'selected' : '' }}>Document</option>
                                            <option value="other" {{ old('severity', $data->severity ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select> -->
                                       

                                        <select name="severity" id="change_related_to">
                                            <option value="">-- Select --</option>
                                            <option value="process" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'process' ? 'selected' : '' }}>Process</option>
                                            <option value="facility" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'facility' ? 'selected' : '' }}>Facility</option>
                                            <option value="utility" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'utility' ? 'selected' : '' }}>Utility</option>
                                            <option value="equipment" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                            <option value="document" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'document' ? 'selected' : '' }}>Document</option>
                                            <option value="other" {{ old('severity', property_exists($data ?? (object)[], 'severity') ? $data->severity : '') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Textbox for 'Other' option -->
                                <!-- <div class="col-lg-6" id="other_specify_div" style="display:none;">
                                    <div class="group-input">
                                        <label for="other_specify">Please specify</label>
                                        <input type="text" name="Occurance" id="other_specify" value="{{ $data->Occurance ?? '' }}" placeholder="Specify if Other is selected">
                                      
                                    </div>
                                </div> -->
                                

                                <div class="col-lg-6" id="other_specify_div" style="display:none;">
                                    <div class="group-input">
                                        <label for="other_specify">Please specify</label>
                                        <input type="text" name="Occurance" id="other_specify" value="{{ property_exists($data ?? (object)[], 'Occurance') }}" placeholder="Specify if Other is selected">
                                      
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        function toggleOtherSpecifyField() {
                                            var changeRelatedTo = $('#change_related_to').val();
                                            if (changeRelatedTo === 'other') {
                                                $('#other_specify_div').show();
                                            } else {
                                                $('#other_specify_div').hide();
                                            }
                                        }
                                
                                        toggleOtherSpecifyField(); // Initial check
                                
                                        // Update field visibility on dropdown change
                                        $('#change_related_to').change(function() {
                                            toggleOtherSpecifyField();
                                        });
                                    });
                                </script>


                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness,
                                            guiding priority for corrective actions. Ranging from low to high, they ensure
                                            quality standards and mitigate critical risks.</span>
                                        <select name="severity_level1">
                                            <option value="">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div> -->

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
                                            <option value="">-- Select --</option>
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
                                        <select name="doc_change">
                                            <option value="">-- Select --</option>
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
                                <!-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="div_code">Division Code</label>
                                        <select name="div_code">
                                            <option value="">-- Select --</option>
                                            <option value="Instrumental Lab">Instrumental Lab</option>
                                            <option value="Microbiology Lab">Microbiology Lab</option>
                                            <option value="Molecular lab">Molecular lab</option>
                                            <option value="Physical Lab">Physical Lab</option>
                                            <option value="Stability Lab">Stability Lab</option>
                                            <option value="Wet Chemistry">Wet Chemistry</option>
                                            <option value="Quality Department">Quality Department</option>
                                            <option value="Administration Department">Administration Department</option>
                                        </select>
                                    </div>
                                </div> -->
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

                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Risk Assessment
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="risk_assessment_related_record">Related Records</label>
                                    <select multiple id="risk_assessment_related_record" name="risk_assessment_related_record[]"
                                        placeholder="Select Reference Records" data-search="false" data-silent-initial-value-set="true">

                                        @foreach ($preRiskAssessment as $prix)
                                            <option value="{{ $prix->id }}">
                                                {{ Helpers::getDivisionName($prix->division_id) }}/Risk-Assessment/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="migration-action">comments</label>
                                        <textarea name="migration_action" disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="others">Risk Assessment Attachment</label>
                                            <div><small class="text-primary" disabled>Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="risk_assessment_atch"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="risk_assessment_atch[]"
                                                        oninput="addMultipleFiles(this, 'risk_assessment_atch')" multiple>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            <!-- </div> -->
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
                            <div class="sub-head">
                                HOD Assessment
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">HOD Assessment Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">HOD Assessment Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="sub-head">
                            Training Information
                        </div>
                        <div class="group-input">
                            <label for="nature-change">Training Required</label>
                            <select name="training_required">
                                <option value="">-- Select --</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="train-comments">Training Comments</label>
                            <textarea name="train_comments"></textarea>
                        </div> -->
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
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

                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="doc-detail">
                                            Document Details<button type="button" name="ann"
                                                id="documentAdd">+</button>
                                        </label>
                                        <table class="table-bordered table" id="documentTableDetails">
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
                                                    <td><input type="text" value="1" name="documentDetails[]" readonly></td>
                                                    <td><input type="text" name="documentDetails[0][currentDocNumber]"></td>
                                                    <td><input type="text" name="documentDetails[0][currentVersionNumber]"></td>
                                                    <td><input type="text" name="documentDetails[0][newDocNumber]"></td>
                                                    <td><input type="text" name="documentDetails[0][newVersionNumber]"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="current-practice">
                                            Current Practice
                                        </label>
                                        <textarea name="current_practice" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="proposed_change">
                                            Proposed Change
                                        </label>
                                        <textarea name="proposed_change" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="reason_change">
                                            Reason for Change
                                        </label>
                                        <textarea name="reason_change" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="other_comment">
                                            Any Other Comments
                                        </label>
                                        <textarea name="other_comment" disabled></textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="supervisor_comment">
                                            Supervisor Comments
                                        </label>
                                        <textarea name="supervisor_comment"></textarea>
                                    </div>
                                </div> -->
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
                            <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Microbiology-Person">CFT Reviewer Person</label>
                                    <select multiple name="cft_reviewer[]" placeholder="Select CFT Reviewers" data-search="false"
                                        data-silent-initial-value-set="true" id="cft_reviewer" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($cft as $data1)
                                            @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                <option value="{{ $data1->id }}"> {{ $data1->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="due_days"> Due Days </label>
                                    <input type="number" name="due_days" id="due_days" disabled>
                                </div>
                            </div> -->

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="severity-level">Classifiaction of Changes</label>
                                    <!-- <span class="text-primary">Severity levels in a QMS record gauge issue
                                        seriousness, guiding priority for corrective actions. Ranging from
                                        low to high, they ensure quality standards and mitigate critical
                                        risks.</span> -->
                                    <select name="severity_level1" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="minor">Minor</option>
                                        <option value="major">Major</option>
                                        <option value="critical">Critical</option>
                                    </select>
                                </div>
                            </div>


                                <!-- <div class="col-lg-12">
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
                                </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA Review Comments</label>
                                        <textarea name="qa_comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records" disabled
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
                                            <div class="file-attachment-list" id="qa_head" disabled></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head[]" disabled
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

                    <div id="CCForm12" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <!-- <div class="sub-head">
                                    RA Review
                                </div> -->
                                <script>
                                    $(document).ready(function() {
                                        $('.ra_review').hide();

                                        $('[name="RA_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.ra_review').show();
                                                $('.ra_review span').show();
                                            } else {
                                                $('.ra_review').hide();
                                                $('.ra_review span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RA Review"> RA Review</label>
                                        <select name="RA_Review" id="RA_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>Yes</option>
                                            <option value='no'>No</option>
                                            <option value='na'>NA</option>
                                        </select>
                                    </div>
                                </div> -->
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
                                <div class="col-lg-6 ra_review">
                                    <div class="group-input">
                                        <label for="RA notification">RA Person</label>
                                        <select disabled name="RA_person" id="RA_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 ra_review">
                                    <div class="group-input">
                                        <label for="RA assessment">Impact Assessment (By RA) </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote RA_assessment" name="RA_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 ra_review">
                                    <div class="group-input">
                                        <label for="RA feedback">RA Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote RA_feedback" name="RA_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 ra_review">
                                    <div class="group-input">
                                        <label for="RA attachment"> RA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="RA_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="RA_attachment[]" oninput="addMultipleFiles(this, 'RA_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 ra_review">
                                    <div class="group-input">
                                        <label for="RA Review Completed By">RA Review Completed By</label>
                                        <input readonly type="text" name="RA_by" id="RA_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 ra_review">
                                    <div class="group-input ">
                                        <label for="RA Review Completed On">RA Review Completed On</label>
                                        <input type="text" id="RA_on" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="RA_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'RA_on')" />
                                    </div>
                                </div>



                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.QualityAssurance').hide();

                                        $('[name="Quality_Assurance_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.QualityAssurance').show();
                                                $('.QualityAssurance span').show();
                                            } else {
                                                $('.QualityAssurance').hide();
                                                $('.QualityAssurance span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance"> Quality Assurance</label>
                                        <select name="Quality_Assurance_Review" id="Quality_Assurance_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>Yes</option>
                                            <option value='no'>No</option>
                                            <option value='na'>NA</option>
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
                                <div class="col-lg-6 QualityAssurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance notification">Quality Assurance Person</label>
                                        <select name="QualityAssurance_Person" class="QualityAssurance_Person" id="QualityAssurance_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 QualityAssurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance)</label>
                                        <textarea class="summernote QualityAssurance_assessment" name="QualityAssurance_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 QualityAssurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance feedback">Quality Assurance Feedback</label>
                                        <textarea class="summernote QualityAssurance_feedback" name="QualityAssurance_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 QualityAssurance">
                                    <div class="group-input">
                                        <label for="RA attachment"> Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Assurance_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 QualityAssurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Completed By">Quality Assurance Completed By</label>
                                        <input readonly type="text" name="QualityAssurance_by" id="QualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 QualityAssurance">
                                    <div class="group-input ">
                                        <label for="Quality Assurance Completed On">Quality Assurance Completed On</label>
                                        <input type="date" id="QualityAssurance_on" name="QualityAssurance_on">
                                    </div>
                                </div>




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
                                        <select name="Production_Table_Person" class="Production_Table_Person" id="Production_Table_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet assessment">Impact Assessment (By Production Tablet)</label>
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
                                                    oninput="addMultipleFiles(this, 'Production_Table_Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed By">Production Tablet Completed By</label>
                                        <input readonly type="text" name="Production_Table_By" id="Production_Table_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input ">
                                        <label for="Production Tablet Completed On">Production Tablet Completed On</label>
                                        <input type="date" id="Production_Table_On" name="Production_Table_On">
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
                                        <select name="ProductionLiquid_Person" class="ProductionLiquid_Person" id="ProductionLiquid_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid assessment">Impact Assessment (By Production Liquid)</label>
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
                                                    oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed By">Production Liquid Completed By</label>
                                        <input readonly type="text" name="ProductionLiquid_by" id="ProductionLiquid_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input ">
                                        <label for="Production Liquid Completed On">Production Liquid Completed On</label>
                                        <input type="date" id="ProductionLiquid_on" name="ProductionLiquid_on">
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
                                        <select name="Production_Injection_Review" id="Production_Injection_Review" disabled>
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
                                        <label for="Production Injection assessment">Impact Assessment (By Production Injection)</label>
                                        <textarea class="summernote Production_Injection_Assessment" name="Production_Injection_Assessment" id="summernote-17"></textarea>
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
                                        <label for="Production Injection attachment">Production Injection Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Production_Injection_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Production_Injection_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Injection_Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection Completed By">Production Injection Completed By</label>
                                        <input readonly type="text" name="Production_Injection_By" id="Production_Injection_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input ">
                                        <label for="Production Injection Completed On">Production Injection Completed On</label>
                                        <input type="date"id="Production_Injection_On" name="Production_Injection_On">
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


                                <div class="sub-head">
                                    Quality Control
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
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required
                                            ?</label>
                                        <select name="Quality_review" id="Quality_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select name="Quality_Control_Person" id="Quality_Control_Person" disabled>
                                            <option value="">-- Select --</option>
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
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
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
                                            <input type="text" id="Quality_Control_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Quality_Control_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Quality_Control_on')" />
                                        </div>
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
                                        <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review" disabled>
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
                                        <select name="ResearchDevelopmentStore_Person" class="ResearchDevelopment_Person" id="ResearchDevelopment_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development assessment">Impact Assessment (By Research Development)</label>
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
                                        <label for="Research Development attachment">Research Development Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                                <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ResearchDevelopment_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="ResearchDevelopment_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed By">Research Development Completed By</label>
                                        <input readonly type="text" name="ResearchDevelopment_by" id="ResearchDevelopment_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input ">
                                        <label for="Research Development Completed On">Research Development Complete On</label>
                                        <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Engineering
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Required">Engineering Review Required ?</label>
                                        <select name="Engineering_review" id="Engineering_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Person">Engineering Person</label>
                                        <select name="Engineering_person" id="Engineering_person">
                                            <option value="">-- Select --</option>
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
                                            <input type="text" id="Engineering_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Engineering_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Engineering_on')" />
                                        </div>
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
                                            <option value="">-- Select --</option>
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
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
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
                                        <label for="Administration Review Completed By"> Human Resource Review Completed By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field human_resources">
                                    <div class="group-input input-date">
                                        <label for="Administration Review Completed On">Human Resource Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Human_Resource_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Human_Resource_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Human_Resource_on')" />
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
                                        <select name="Microbiology_Person" class="Microbiology_Person" id="Microbiology_Person">
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
                                        <select name="RegulatoryAffair_Person" class="RegulatoryAffair_Person" id="RegulatoryAffair_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair)</label>
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
                                                    oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed By">Regulatory Affair Completed By</label>
                                        <input readonly type="text" name="RegulatoryAffair_by" id="RegulatoryAffair_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input ">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Completed On</label>
                                        <input type="date"id="RegulatoryAffair_on" name="RegulatoryAffair_on">
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
                                        <label for="Corporate Quality Assurance"> Corporate Quality Assurance Required ?</label>
                                        <select name="CorporateQualityAssurance_Review" id="CorporateQualityAssurance_Review" disabled>
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
                                        <label for="Corporate Quality Assurance notification">Corporate Quality Assurance Person</label>
                                        <select name="CorporateQualityAssurance_Person" class="CorporateQualityAssurance_Person"
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
                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance)</label>
                                        <textarea class="summernote CorporateQualityAssurance_assessment" readonly name="CorporateQualityAssurance_assessment"
                                            id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback</label>
                                        <textarea class="summernote CorporateQualityAssurance_feedback" name="CorporateQualityAssurance_feedback"
                                            id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="CorporateQualityAssurance_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="CorporateQualityAssurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Completed By</label>
                                        <input readonly type="text" name="CorporateQualityAssurance_by" id="CorporateQualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 CQA">
                                    <div class="group-input ">
                                        <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance Completed On</label>
                                        <input type="date"id="CorporateQualityAssurance_on" name="CorporateQualityAssurance_on">
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
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Person"> Safety Person</label>
                                        <select name="Environment_Health_Safety_person" id="Environment_Health_Safety_person">
                                            <option value="">-- Select --</option>
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
                                                <input type="file" id="myfile" name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Safety Review Completed
                                            By</label>
                                        <input type="text" name="Environment_Health_Safety_by" id="Environment_Health_Safety_by"
                                            disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field environmental_health">
                                    <div class="group-input input-date">
                                        <label for="Safety Review Completed On">Safety Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Environment_Health_Safety_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Environment_Health_Safety_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Information Technology
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ?</label>
                                        <select name=" Information_Technology_review" id=" Information_Technology_review" disabled>
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
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person</label>
                                        <select name=" Information_Technology_person" id=" Information_Technology_person">
                                            <option value="">-- Select --</option>
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
                                                <input type="file" id="myfile" name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')" multiple>
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
                                            <input type="text" id="Information_Technology_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Information_Technology_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Information_Technology_on')" />
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
                                        <select name="ContractGiver_Person" class="ContractGiver_Person" id="ContractGiver_Person">
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
                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)</label>
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


                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <input type="text" id="Other1_on" name="Other1_on" readonly placeholder="DD-MMM-YYYY" />
                                        </div>
                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <input type="text" id="Other2_on" name="Other2_on" readonly placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'Other2_on')" /> --}}
                                        </div>
                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <input type="text" id="Other3_on" name="Other3_on" readonly placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'Other3_on')" /> --}}
                                        </div>
                                    </div>
                                </div>




                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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


                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                    style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>

                        </div>
                    </div>
                    <div id="CCForm14" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                        <div class="sub-head">
                                            QA Final Review
                                        </div>

                                        <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA notification">RA Approval required
                                                        <!-- <span class="text-danger">*</span> -->
                                                    </label>
                                                    <select name="RA_data_person" class="RA_data_person"
                                                        id="RA_data_person" disabled>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA notification">QA/CQA Head Approval Person
                                                    <select name="QA_CQA_person" class="RA_person"
                                                        id="RA_person" disabled>
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        <div class="group-input">
                                            <label for="qa-eval-comments">QA Final Review Comments</label>
                                            <textarea name="qa_final_comments" readonly></textarea>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="qa-eval-attach">QA Final Review Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="qa_final_attach"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="qa_final_attach[]" disabled
                                                            oninput="addMultipleFiles(this, 'qa_final_attach')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                                <!-- </div>  -->

                                <div id="CCForm15" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            RA
                                        </div>
                                        <div class="col-md-12">
                                                    <div class="group-input">
                                                        <label for="RA feedback">RA approval comment</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RA_feedback" id="summernote-18" readonly></textarea>
                                                    </div>
                                                </div>

                                      
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="qa-eval-attach">RA Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="RA_attachment"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="RA_attachment[]" disabled
                                                            oninput="addMultipleFiles(this, 'RA_attachment')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- </div> -->
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>    

                    <!-- <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Evaluation Detail
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">QA Evaluation Comments</label>
                                <textarea name="qa_eval_comments" readonly></textarea>
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
                                            <input type="file" id="myfile" name="qa_eval_attach[]" disabled
                                                oninput="addMultipleFiles(this, 'qa_eval_attach')" multiple>
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
                    </div> -->

                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="group-input">
                                <label for="qa-appro-comments">Implementation Verification by QA/CQA Comments</label>
                                <textarea name="qa_appro_comments" disabled></textarea>
                            </div>
                            <div class="group-input">
                                <label for="feedback">Training Feedback</label>
                                <textarea name="feedback" disabled></textarea>
                            </div>
                            <div class="group-input">
                                <label for="tran-attach">Training Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                                </div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="tran_attach"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="tran_attach[]" disabled
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
                                <label for="qa-closure-comments">QA Closure Comments</label>
                                <textarea name="qa_closure_comments" disabled></textarea>
                            </div>
                            <div class="group-input">
                                <label for="attach-list">List Of Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                                </div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="attach_list"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="attach_list[]" disabled
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
                                                <option value="">-- Select --</option>
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
                        <!-- </div> -->
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

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                HOD Assessment
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">HOD Assessment Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">HOD Assessment Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="sub-head">
                            Training Information
                        </div>
                        <div class="group-input">
                            <label for="nature-change">Training Required</label>
                            <select name="training_required">
                                <option value="">-- Select --</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="train-comments">Training Comments</label>
                            <textarea name="train_comments"></textarea>
                        </div> -->
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>




                </div>

                <div id="CCForm16" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                            QA/CQA Head/Manager Designee Approval
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">QA/CQA Head/Manager Designee Approval Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">QA/CQA Head/Manager Designee Approval Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="sub-head">
                            Training Information
                        </div>
                        <div class="group-input">
                            <label for="nature-change">Training Required</label>
                            <select name="training_required">
                                <option value="">-- Select --</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="train-comments">Training Comments</label>
                            <textarea name="train_comments"></textarea>
                        </div> -->
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
                            <div class="sub-head">
                                HOD Final Review
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">HOD Final Review Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">HOD Final Review Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="sub-head">
                            Training Information
                        </div>
                        <div class="group-input">
                            <label for="nature-change">Training Required</label>
                            <select name="training_required">
                                <option value="">-- Select --</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="train-comments">Training Comments</label>
                            <textarea name="train_comments"></textarea>
                        </div> -->
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>

                        </div>
                    </div>
                    </div>

                    <!-- <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                CFT Information
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">CFT Reviewer</label>
                                        <select name="Microbiology">
                                            <option value="" selected>-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production">Production</label>
                                        <select name="Production">
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production-Person">Production Person</label>
                                        <select name="Production_Person">
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality-Approver-Person">Quality Approver Person</label>
                                        <select name="Quality_Approver_Person">
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="bd_domestic-Person">Others Person</label>
                                        <select name="Bd_Person">
                                            <option value="">-- Select --</option>
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
                    </div> -->

                <!-- <div id="" class="inner-block cctabcontent">
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
                </div> -->

                <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                Initiator Update
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">Initiator Update Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">Initiator Update Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

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
                                Initial Update
                            </div>
                            <div class="group-input">
                                <label for="qa-eval-comments">Initial Update Comments</label>
                                <textarea name="hod_assessment_comments" readonly></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="qa-eval-attach">Initial Update Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="hod_assessment_comments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="hod_assessment_comments[]" disabled
                                                oninput="addMultipleFiles(this, 'hod_assessment_comments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

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



    </div
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
            ele: '#related_records, #cft_reviewer, #risk_assessment_related_record'
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
                                        <script>
                                        $(document).ready(function() {
                                            // Event listener for the remove file button
                                            $(document).on('click', '.remove-file', function() {
                                                $(this).closest('.file-container').remove();
                                            });
                                        });
                                    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-file');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileName = this.getAttribute('data-file-name');
                const fileContainer = this.parentElement;

                // Hide the file container
                if (fileContainer) {
                    fileContainer.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
