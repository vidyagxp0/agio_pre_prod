    @extends('frontend.layout.main')
    @section('container')
        <script>
            function addFishBone(top, bottom) {
                let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
                let topBlock = mainBlock.querySelector(top)
                let bottomBlock = mainBlock.querySelector(bottom)

                let topField = document.createElement('div')
                topField.className = 'grid-field fields top-field'

                let measurement = document.createElement('div')
                let measurementInput = document.createElement('input')
                measurementInput.setAttribute('type', 'text')
                measurementInput.setAttribute('name', 'measurement[]')
                measurement.append(measurementInput)
                topField.append(measurement)

                let materials = document.createElement('div')
                let materialsInput = document.createElement('input')
                materialsInput.setAttribute('type', 'text')
                materialsInput.setAttribute('name', 'materials[]')
                materials.append(materialsInput)
                topField.append(materials)

                let methods = document.createElement('div')
                let methodsInput = document.createElement('input')
                methodsInput.setAttribute('type', 'text')
                methodsInput.setAttribute('name', 'methods[]')
                methods.append(methodsInput)
                topField.append(methods)

                topBlock.prepend(topField)

                let bottomField = document.createElement('div')
                bottomField.className = 'grid-field fields bottom-field'

                let environment = document.createElement('div')
                let environmentInput = document.createElement('input')
                environmentInput.setAttribute('type', 'text')
                environmentInput.setAttribute('name', 'environment[]')
                environment.append(environmentInput)
                bottomField.append(environment)

                let manpower = document.createElement('div')
                let manpowerInput = document.createElement('input')
                manpowerInput.setAttribute('type', 'text')
                manpowerInput.setAttribute('name', 'manpower[]')
                manpower.append(manpowerInput)
                bottomField.append(manpower)

                let machine = document.createElement('div')
                let machineInput = document.createElement('input')
                machineInput.setAttribute('type', 'text')
                machineInput.setAttribute('name', 'machine[]')
                machine.append(machineInput)
                bottomField.append(machine)

                bottomBlock.append(bottomField)
            }

            function deleteFishBone(top, bottom) {
                let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
                let topBlock = mainBlock.querySelector(top)
                let bottomBlock = mainBlock.querySelector(bottom)
                if (topBlock.firstChild) {
                    topBlock.removeChild(topBlock.firstChild);
                }
                if (bottomBlock.lastChild) {
                    bottomBlock.removeChild(bottomBlock.lastChild);
                }
            }
        </script>
    <style>
        #fr-logo {
            display: none;
        }
    </style>

    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
        
        <script>
            function addWhyField(con_class, name) {
                let mainBlock = document.querySelector('.why-why-chart')
                let container = mainBlock.querySelector(`.${con_class}`)
                let textarea = document.createElement('textarea')
                textarea.setAttribute('name', name);
                container.append(textarea)
            }
        </script>
        <script>
            function calculateInitialResult(selectElement) {
                let row = selectElement.closest('tr');
                let R = parseFloat(row.querySelector('.fieldR').value) || 0;
                let P = parseFloat(row.querySelector('.fieldP').value) || 0;
                let N = parseFloat(row.querySelector('.fieldN').value) || 0;
                let result = R * P * N;

                // Update the result field within the row
                row.querySelector('.initial-rpn').value = result;
            }
        </script>
        {{--  <script>
            function calculateResidualResult(selectElement) {
                let row = selectElement.closest('tr');
                let R = parseFloat(row.querySelector('.residual-fieldR').value) || 0;
                let P = parseFloat(row.querySelector('.residual-fieldP').value) || 0;
                let N = parseFloat(row.querySelector('.residual-fieldN').value) || 0;
                let result = R * P * N;
                row.querySelector('.residual-rpn').value = result;
            }
        </script>  --}}
        {{--  <script>
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
        </script>  --}}



        <script>
            function calculateRiskAnalysis(selectElement) {
                // Get values from select elements
                let R = parseFloat(document.getElementById('analysisR').value) || 0;
                let P = parseFloat(document.getElementById('analysisP').value) || 0;
                let N = parseFloat(document.getElementById('analysisN').value) || 0;

                // Perform the calculation
                let result = R * P * N;

                // Update the RPN field
                document.getElementById('analysisRPN').value = result;

                // Determine the risk level
                let riskLevelInput = document.getElementById('riskLevel');
                if (result >= 1 && result <= 24) {
                    riskLevelInput.value = 'Low';
                } else if (result >= 25 && result <= 74) {
                    riskLevelInput.value = 'Medium';
                } else if (result >= 75 && result <= 125) {
                    riskLevelInput.value = 'High';
                } else {
                    riskLevelInput.value = ''; // Default value if no condition is met
                }
            }
        </script>


        <script>
            function calculateRiskAnalysis2(selectElement) {
                // Get the row containing the changed select element
                let row = selectElement.closest('tr');

                // Get values from select elements within the row
                let R = parseFloat(document.getElementById('analysisR2').value) || 0;
                let P = parseFloat(document.getElementById('analysisP2').value) || 0;
                let N = parseFloat(document.getElementById('analysisN2').value) || 0;

                // Perform the calculation
                let result = R * P * N;


                document.getElementById('analysisRPN2').value = result;

                // Determine the risk level
                let riskLevelInput = document.getElementById('riskLevel_2');
                if (result >= 1 && result <= 24) {
                    riskLevelInput.value = 'Low';
                } else if (result >= 25 && result <= 74) {
                    riskLevelInput.value = 'Medium';
                } else if (result >= 75 && result <= 125) {
                    riskLevelInput.value = 'High';
                } else {
                    riskLevelInput.value = ''; // Default value if no condition is met
                }
            }
        </script>
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
                {{ Helpers::getDivisionName(session()->get('division')) }} / Risk Assessment
            </div>
        </div>
        @php
            $users = DB::table('users')->get();
        @endphp


        <div id="change-control-fields">
            <div class="container-fluid">

                <!-- Tab links -->
                <div class="cctab">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Informantion</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk/Opportunity details </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk Assessment </button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm12')">HOD/Designee</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">CFT Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm9')">QA/CQA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm11')">QA/CQA Head Approval</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Work Group Assignment</button> --}}
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Risk/Opportunity Analysis</button> --}}
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Residual Risk</button> --}}
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Risk Mitigation</button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
                </div>

                <form action="{{ route('risk_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="step-form">

                        <!-- General Form Tab content -->
                        <div id="CCForm1" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    General Information
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RLS Record Number"><b>Record Number</b></label>
                                            <input readonly type="text" name="record_number"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/RA/{{ date('Y') }}/{{ $record_number }}">
                                            {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Division Code"><b>Site/Location Code</b></label>
                                            <input readonly type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id"
                                                value="{{ session()->get('division') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator"><b>Initiator</b></label>
                                            {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                            <input disabled type="text" name="initiator_id"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" value="{{ date('d-M-Y') }}"
                                                name="intiation_date">
                                            <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">

                                            {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator Department</b></label>
                                        <input readonly type="text" name="Initiator_Group" id="initiator_group" 
                                            value="{{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}">
                                    </div>
                                </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            // Define department name to code mapping
                                            const departmentMapping = {
                                                "Corporate Quality Assurance": "CQA",
                                                "Quality Control (Microbiology department)": "QM",
                                                "Engineering": "EN",
                                                "Store": "ST",
                                                "Production Injectable": "PI",
                                                "Production External": "PE",
                                                "Production Tablet,Powder and Capsule": "PT",
                                                "Quality Assurance": "QA",
                                                "Quality Control": "QC",
                                                "Regulatory Affairs": "RA",
                                                "Packaging Development /Artwork": "PD",
                                                "Artwork": "AW",
                                                "Research & Development": "R&D",
                                                "Human Resource": "HR",
                                                "Marketing": "MK",
                                                "Analytical research and Development Laboratory": "AL",
                                                "Information Technology": "IT",
                                                "Safety": "SA",
                                                "Purchase Department": "PU",
                                            };

                                            // Get the Initiator Department input
                                            let initiatorGroupInput = document.getElementById("initiator_group");
                                            let initiatorGroupCodeInput = document.getElementById("initiator_group_code");

                                            // Get the department name from the input field
                                            let departmentName = initiatorGroupInput.value.trim();

                                            // Auto-generate the department code based on the mapping
                                            if (departmentName in departmentMapping) {
                                                initiatorGroupCodeInput.value = departmentMapping[departmentName];
                                            } else {
                                                initiatorGroupCodeInput.value = "N/A"; // Default if not found
                                            }
                                        });
                                    </script>



                                    <!-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group"><b>Initiator Department</b></label>
                                            <select name="Initiator_Group" id="initiator_group">
                                                <option value="">-- Select --</option>
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
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group Code">Initiator Department Code</label>
                                            <input type="text" name="initiator_group_code" id="initiator_group_code"
                                                value="" readonly>
                                        </div>
                                    </div>


                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Short Description">Short Description<span
                                                    class="text-danger">*</span></label><span id="rchars">255</span>
                                            characters remaining
                                            <input name="short_description" id="short_description"></input>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Short Description">Short Description<span
                                                    class="text-danger">*</span></label><span id="rchars">255</span>
                                            Characters remaining
                                            <input id="docname" type="text" name="short_description" maxlength="255"
                                                required>
                                        </div>
                                        @error('short_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="severity-level">Severity Level</label>
                                            <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                            <select name="severity2_level">
                                                <option value="0">-- Select --</option>
                                                <option value="minor">Minor</option>
                                                <option value="major">Major</option>
                                                <option value="critical">Critical</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Department(s)">Department(s)</label>
                                           <select name="departments[]" placeholder="Select Departments" data-search="false"
                                                    data-silent-initial-value-set="true" id="departments_2" multiple>
                                                <option value="">Select Department</option>
                                                <option value="QA">QA</option>
                                                <option value="QC">QC</option>
                                                <option value="R&D">R&D</option>
                                                <option value="Wet Chemistry Area">Wet Chemistry Area</option>
                                                <option value="Warehouse">Warehouse</option>
                                                <option value="Molecular Area">Molecular Area</option>
                                                <option value="Microbiology Area">Microbiology Area</option>
                                                <option value="Instrumental Area">Instrumental Area</option>
                                                <option value="Administration">Administration</option>
                                                <option value="Financial Department">Financial Department</option>
                                            </select>
                                        </div>
                                    </div> --}}



                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="search">Source of Risk/Opportunity<span
                                                    class="text-danger"></span></label>
                                            <select name="source_of_risk" id="source_of_risk">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Audit">Audit</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Employee">Employee</option>
                                                <option value="Customer">Customer</option>
                                                <option value="Regulation">Regulation</option>
                                                <option value="Competition">Competition</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="typeOfErrorBlock" class="group-input col-6" style="display: none;">
                                        <label for="otherFieldsUser">Other(Source of Risk/Opportunity)</label>
                                        
                                        <textarea name="other_source_of_risk"  class="form-control"></textarea>
                                        
                                    </div>

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            // Initially hide the field
                                            $('#typeOfErrorBlock').hide();

                                            $('select[name=source_of_risk]').change(function() {
                                                const selectedVal = $(this).val();
                                                if (selectedVal === 'Other') {
                                                    $('#typeOfErrorBlock').show();
                                                } else {
                                                    $('#typeOfErrorBlock').hide();
                                                }
                                            });

                                            // Optionally, check the current value when the page loads in case of form errors
                                            if ($('select[name=source_of_risk]').val() === 'Other') {
                                                $('#typeOfErrorBlock').show();
                                            }
                                        });
                                    </script>


<div class="col-lg-6">
    <div class="group-input">
        <label for="Type..">Type</label>
        <select name="type" id="type">
            <option value="">Enter Your Selection Here</option>
            <option value="Business Risk">Business Risk</option>
            <option value="Customer Related">Customer-Related Risk (Complaint)</option>
            <option value="Opportunity">Opportunity</option>
            <option value="Market">Market</option>
            <option value="Operational Risk">Operational Risk</option>
            <option value="Strategic Risk">Strategic Risk</option>
            <option value="Other">Other</option> <!-- Ensure the value matches here -->
        </select>
    </div>
</div>

<div id="typeOfError" class="group-input col-6" style="display: none;">
    <label for="otherFieldsUser">Other (Type)</label>
   
    <textarea name="other_type" class="form-control"></textarea>
                                        
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Initially hide the field
        $('#typeOfError').hide();

        $('select[name=type]').change(function() {
            const selectedVal = $(this).val();
            if (selectedVal === 'Other') { // Match this value with the option value
                $('#typeOfError').show();
            } else {
                $('#typeOfError').hide();
            }
        });

        // Optionally, check the current value when the page loads in case of form errors
        if ($('select[name=type]').val() === 'Other') { // Correct the value check
            $('#typeOfError').show();
        }
    });
</script>


                                    {{-- <script>
                                        $(document).ready(function() {
                                            $('select[name=type]').change(function() {
                                                const selectedVal = $(this).val();
                                                if (selectedVal === 'Other_data') {
                                                    $('#typeOfError').show();
                                                    $('#other_type').attr('name', 'type');
                                                    $(this).attr('name', '');
                                                } else {
                                                    $('#typeOfError').hide();
                                                    $('#other_type').attr('name', '');
                                                    $(this).attr('name', 'type');
                                                }
                                            });

                                            // Optionally, check the current value when the page loads in case of form errors
                                            if ($('select[name=type]').val() === 'Other_data') {
                                                $('#typeOfError').show();
                                                $('#other_type').attr('name', 'type');
                                                $('select[name=type]').attr('name', '');
                                            }
                                        });
                                    </script> --}}


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Priority Level">Priority Level</label>
                                            <select name="priority_level" id="priority_level">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Zone">Zone</label>
                                            <select name="zone" id="zone">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Asia">Asia</option>
                                                <option value="Europe">Europe</option>
                                                <option value="Africa">Africa</option>
                                                <option value="Central_America">Central America</option>
                                                <option value="South_America">South America</option>
                                                <option value="Oceania">Oceania</option>
                                                <option value="North_America">North America</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Country">Country</label>
                                            <select name="country" class="countries" id="country">
                                                <option value="">Select Country</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="State/District">State/District</label>
                                            <select name="state" class="states" id="state">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="City">City</label>
                                            <select name="city" class="cities" id="city">
                                                <option value="">Select City</option>

                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-6">
                                        <div class="group-input">
                                            <label for="Description">Risk/Opportunity Description</label>
                                            <textarea name="description" id="description"></textarea>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-6">
                                        <div class="group-input">
                                            <label for="Description">Other</label>
                                            <textarea name="others_comment" id="others_comment"></textarea>
                                        </div>
                                    </div> --}}


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Purpose</label>
                                            <textarea name="purpose" id="comments"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Scope</label>
                                            <textarea name="scope" id="comments"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Reason for Revision</label>
                                            <textarea name="reason_for_revision" id="comments"></textarea>
                                        </div>
                                    </div>


                                    <!-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Brief Description / Procedure </label>
                                            <textarea name="Brief_description" id="comments"></textarea>
                                        </div>
                                    </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Brief Description / Procedure</label>
                                        <div class="relative-container">
                                           <textarea name="Brief_description" class="summernote-1"></textarea>
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Documents Used for Risk Management</label>
                                            <textarea name="document_used_risk" id="comments"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Risk/Opportunity Comments</label>
                                            <textarea name="comments" id="comments"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="CAPA Attachments">Initial Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            {{-- <input multiple type="file" id="myfile" name="capa_attachment[]"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="risk_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="risk_attachment[]"
                                                        oninput="addMultipleFiles(this, 'risk_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" id="ChangeSaveButton" class="saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>

                        </div>

                        <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    Risk Assessment
                                </div>
                                <div class="row">


                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="root-cause-methodology">Root Cause Methodology</label>
                                            <select name="root_cause_methodology[]" multiple data-search="false"
                                                data-silent-initial-value-set="true" id="root-cause-methodology">
                                                <option value="Why-Why Chart">Why-Why Chart</option>
                                                <option value="Failure Mode and Effect Analysis">Failure Mode and Effect
                                                    Analysis</option>
                                                <option value="Other">Other</option> <!-- Ensure the value matches -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div id="rootCause" class="group-input" style="display: none;">
                                            <label for="otherFieldsUser">Other (Root Cause Methodology)</label>
                                            {{-- <input type="text" id="summernote" name="other_root_cause_methodology" class="form-control"/> --}}
                                            <textarea name="other_root_cause_methodology" id="summernote"></textarea>
                                        </div>
                                    </div>

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            // Function to check the current value of the select and toggle the input field
                                            function toggleOtherField() {
                                                const selectedVals = $('#root-cause-methodology').val();
                                                if (selectedVals && selectedVals.includes('Other')) { // Correct value check here
                                                    $('#rootCause').show();
                                                } else {
                                                    $('#rootCause').hide();
                                                }
                                            }

                                            // Bind the change event to the select field
                                            $('#root-cause-methodology').change(function() {
                                                toggleOtherField();
                                            });

                                            // Check the current value when the page loads
                                            toggleOtherField();
                                        });
                                    </script>



                                    <div class="col-12 mb-4 "id="fmea-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="agenda">
                                                Failure Mode and Effect Analysis<button type="button" name="agenda"
                                                    onclick="addRiskAssessmentdata2('risk-assessment-risk-management')">+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" style="width: 200%"
                                                    id="risk-assessment-risk-management">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="1"style="text-align:center;"> </th>
                                                            <th colspan="2"style="text-align:center;">Risk
                                                                Identification</th>
                                                            <th colspan="1"style="text-align:center;">Risk Analysis</th>
                                                            <th colspan="4"style="text-align:center;">Risk Evaluation
                                                            </th>
                                                            <th colspan="1"style="text-align:center;">Risk Control</th>
                                                            <th colspan="6"style="text-align:center;">Risk Evaluation
                                                            </th>
                                                            <th colspan="2"style="text-align:center;"></th>
                                                        </tr>
                                                        <tr>

                                                            <th>Sr. No. </th>
                                                            <th>Activity</th>
                                                            {{--  <th>Activity</th>  --}}
                                                            <th>Possible Risk/Failure (Identified Risk)</th>
                                                            <th>Consequences of Risk/Potential Causes</th>
                                                            <th>Severity (S)</th>
                                                            <th>Probability (P)</th>
                                                            <th>Detection (D)</th>
                                                            <th>Risk Level (RPN)</th>

                                                            {{--  <th>Risk Acceptance (Y/N)</th>  --}}

                                                            <th>Control Measures recommended/ Risk mitigation proposed</th>
                                                            <th>Severity (S)</th>
                                                            <th>Probability (P)</th>
                                                            <th>Detection (D)</th>
                                                            <th>RPN</th>
                                                            <th>Category of Risk Level (Low, Medium and High)</th>
                                                            <th>Risk Acceptance (Y/N)</th>
                                                            <th>Traceability document</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="fishbone-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="fishbone">
                                                Fishbone or Ishikawa Diagram
                                                <button type="button" name="agenda"
                                                    onclick="addFishBone('.top-field-group', '.bottom-field-group')">+</button>
                                                <button type="button" name="agenda" class="fishbone-del-btn"
                                                    onclick="deleteFishBone('.top-field-group', '.bottom-field-group')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <span class="text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#fishbone-instruction-modal"
                                                    style="font-size: 0.8rem; font-weight: 400;">
                                                    (Launch Instruction)
                                                </span>
                                            </label>
                                            <div class="fishbone-ishikawa-diagram">
                                                <div class="left-group">
                                                    <div class="grid-field field-name">
                                                        <div>Measurement</div>
                                                        <div>Materials</div>
                                                        <div>Methods</div>
                                                    </div>
                                                    <div class="top-field-group">
                                                        <div class="grid-field fields top-field">
                                                            <div><input type="text" name="measurement[]"></div>
                                                            <div><input type="text" name="materials[]"></div>
                                                            <div><input type="text" name="methods[]"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mid"></div>
                                                    <div class="bottom-field-group">
                                                        <div class="grid-field fields bottom-field">
                                                            <div><input type="text" name="environment[]"></div>
                                                            <div><input type="text" name="manpower[]"></div>
                                                            <div><input type="text" name="machine[]"></div>
                                                        </div>
                                                    </div>
                                                    <div class="grid-field field-name">
                                                        <div>Environment</div>
                                                        <div>Manpower</div>
                                                        <div>Machine</div>
                                                    </div>
                                                </div>
                                                <div class="right-group">
                                                    <div class="field-name">
                                                        Problem Statement
                                                    </div>
                                                    <div class="field">
                                                        <textarea name="problem_statement"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--
                                    <div class="col-12" id="why-why-chart-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="why-why-chart">
                                                Why-Why Chart
                                                <span class="text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#why_chart-instruction-modal"
                                                    style="font-size: 0.8rem; font-weight: 400;">
                                                    (Launch Instruction)
                                                </span>
                                            </label>
                                            <div class="why-why-chart">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr style="background: #f4bb22">
                                                            <th style="width:150px;">Problem Statement :</th>
                                                            <td>
                                                                <textarea name="why_problem_statement"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr class="why-row">
                                                            <th style="width:150px; color: #393cd4;">
                                                                Why 1 <span
                                                                    onclick="addWhyField('why_1_block', 'why_1[]')">+</span>
                                                            </th>
                                                            <td>
                                                                <div class="why_1_block">
                                                                    <textarea name="why_1[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="why_1_block">
                                                                    @if (!empty($whyChart->why_1))
                                                                        @foreach (unserialize($whyChart->why_1) as $key => $measure)
                                                                            <div class="why-field-wrapper" style="">
                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_1[]">{{ $measure }}</textarea>
                                                                                <span class="remove-field"
                                                                                    onclick="removeWhyField(this)"
                                                                                    style="cursor: pointer; color: red;">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <tr class="why-row">
                                                            <th style="width:150px; color: #393cd4;">
                                                                Why 2 <span
                                                                    onclick="addWhyField('why_2_block', 'why_2[]')">+</span>
                                                            </th>

                                                            <td>
                                                                <div class="why_2_block">
                                                                    <textarea name="why_2[]"></textarea>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="why_2_block">

                                                                    @if (!empty($whyChart->why_2))
                                                                        @foreach (unserialize($whyChart->why_2) as $key => $measure)
                                                                            <div class="why-field-wrapper" style="">
                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_2[]">{{ $measure }}</textarea>
                                                                                <span class="remove-field"
                                                                                    onclick="removeWhyField(this)"
                                                                                    style="cursor: pointer; color: red;">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>

                                                        </tr>

                                                        <tr class="why-row">
                                                            <th style="width:150px; color: #393cd4;">
                                                                Why 3 <span
                                                                    onclick="addWhyField('why_3_block', 'why_3[]')">+</span>
                                                            </th>

                                                            <td>
                                                                <div class="why_3_block">
                                                                    <textarea name="why_3[]"></textarea>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="why_3_block">
                                                                    

                                                                    @if (!empty($whyChart->why_3))
                                                                        @foreach (unserialize($whyChart->why_3) as $key => $measure)
                                                                            <div class="why-field-wrapper" style="">
                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_3[]">{{ $measure }}</textarea>
                                                                                <span class="remove-field"
                                                                                    onclick="removeWhyField(this)"
                                                                                    style="cursor: pointer; color: red;">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <tr class="why-row">
                                                            <th style="width:150px; color: #393cd4;">
                                                                Why 4 <span
                                                                    onclick="addWhyField('why_4_block', 'why_4[]')">+</span>
                                                            </th>


                                                            <td>
                                                                <div class="why_4_block">
                                                                    <textarea name="why_4[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="why_4_block">
                                                                    

                                                                    @if (!empty($whyChart->why_4))
                                                                        @foreach (unserialize($whyChart->why_4) as $key => $measure)
                                                                            <div class="why-field-wrapper" style="">
                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_4[]">{{ $measure }}</textarea>
                                                                                <span class="remove-field"
                                                                                    onclick="removeWhyField(this)"
                                                                                    style="cursor: pointer; color: red;">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="why-row">
                                                            <th style="width:150px; color: #393cd4;">
                                                                Why 5 <span
                                                                    onclick="addWhyField('why_5_block', 'why_5[]')">+</span>
                                                            </th>

                                                            <td>
                                                                <div class="why_5_block">
                                                                    <textarea name="why_5[]"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="why_5_block">
                                                                  

                                                                    @if (!empty($whyChart->why_5))
                                                                        @foreach (unserialize($whyChart->why_5) as $key => $measure)
                                                                            <div class="why-field-wrapper" style="">
                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_5[]">{{ $measure }}</textarea>
                                                                                <span class="remove-field"
                                                                                    onclick="removeWhyField(this)"
                                                                                    style="cursor: pointer; color: red;">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr style="background: #0080006b;">
                                                            <th style="width:150px;">Root Cause :</th>
                                                            <td>
                                                                <textarea name="why_root_cause"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                --}}


                                    <div class="col-12" id="why-why-chart-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="why-why-chart">
                                                Why-Why Chart
                                                <span class="text-primary add-why-question" style="font-size: 1rem; font-weight: 600; cursor: pointer; margin-left: 10px;">+</span>
                                            </label>

                                            <div class="why-why-chart">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr style="background: #f4bb22">
                                                            <th style="width:150px;">Problem Statement :</th>
                                                            <td>
                                                                <textarea name="why_problem_statement"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div id="why-questions-container"></div>

                                                <div id="root-cause-container" style="display: none;">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr style="background: #0080006b;">
                                                                <th style="width:150px;">Root Cause :</th>
                                                                <td>
                                                                    <textarea name="why_root_cause"></textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        let whyCount = 0;

                                        document.querySelector('.add-why-question').addEventListener('click', function () {
                                            whyCount++;

                                            const container = document.getElementById('why-questions-container');
                                            const rootCauseContainer = document.getElementById('root-cause-container');

                                            const whySet = document.createElement('div');
                                            whySet.className = 'why-field-wrapper';
                                            whySet.innerHTML = `
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:150px; color: #393cd4;">Why ${whyCount}</th>
                                                            <td>
                                                                <textarea name="why_questions[]" placeholder="Enter Why ${whyCount} Question"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:150px; color: #393cd4;">Answer ${whyCount}</th>
                                                            <td>
                                                                <textarea name="why_answers[]" placeholder="Enter Answer for Why ${whyCount}"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <span class="remove-field" onclick="removeWhyField(this)" style="cursor: pointer; color: red; font-weight: 600;">Remove</span>
                                            `;

                                            container.appendChild(whySet);
                                            rootCauseContainer.style.display = 'block';
                                            container.after(rootCauseContainer);
                                        });

                                        function removeWhyField(element) {
                                            element.closest('.why-field-wrapper').remove();
                                            whyCount--;

                                            if (document.getElementById('why-questions-container').children.length === 0) {
                                                document.getElementById('root-cause-container').style.display = 'none';
                                            }
                                        }
                                    </script>

                                    <div class="col-12" id="is-is-not-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="why-why-chart">
                                                Is/Is Not Analysis
                                                <span class="text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#is_is_not-instruction-modal"
                                                    style="font-size: 0.8rem; font-weight: 400;">
                                                    (Launch Instruction)
                                                </span>
                                            </label>
                                            <div class="why-why-chart">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>&nbsp;</th>
                                                            <th>Will Be</th>
                                                            <th>Will Not Be</th>
                                                            <th>Rationale</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th style="background: #0039bd85">What</th>
                                                            <td>
                                                                <textarea name="what_will_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="what_will_not_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="what_rationable"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Where</th>
                                                            <td>
                                                                <textarea name="where_will_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="where_will_not_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="where_rationable"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">When</th>
                                                            <td>
                                                                <textarea name="when_will_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="when_will_not_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="when_rationable"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Coverage</th>
                                                            <td>
                                                                <textarea name="coverage_will_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="coverage_will_not_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="coverage_rationable"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Who</th>
                                                            <td>
                                                                <textarea name="who_will_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="who_will_not_be"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="who_rationable"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="root_cause_description">Root Cause Description</label>
                                            <textarea name="root_cause_description"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Risk Assessment Summary</label>
                                            <textarea name="investigation_summary"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Risk Assessment Conclusion</label>
                                            <textarea name="r_a_conclussion"></textarea>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="sub-head">
                                    Risk Analysis
                                </div>
                                <div class="row">
                                   <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Severity Rate">Severity Rate</label>
                                        <select name="severity_rate" class="severity_rate" id="analysisR" onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value='1'>1-Insignificant</option>
                                            <option value='2'>2-Minor</option>
                                            <option value='3'>3-Major</option>
                                            <option value='4'>4-Critical</option>
                                            <option value='5'>5-Catastrophic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurrence">Occurrence</label>
                                        <select name="occurrence" class="occurrence" id="analysisP" onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value='1'>1-Very rare</option>
                                            <option value='2'>2-Unlikely</option>
                                            <option value='3'>3-Possibly</option>
                                            <option value='4'>4-Likely</option>
                                            <option value='5'>5-Almost certain (every time)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <select name="detection" class="detection" id="analysisN" onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value='1'>1-Always detected</option>
                                            <option value='2'>2-Likely to detect</option>
                                            <option value='3'>3-Possible to detect</option>
                                            <option value='4'>4-Unlikely to detect</option>
                                            <option value='5'>5-Not detectable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <div><small class="text-primary">Auto - Calculated</small></div>
                                        <input type="text" name="rpn" id="analysisRPN" value="" readonly>
                                    </div>
                                </div> --}}


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input multiple type="file" id="myfile" name="capa_attachment[]"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="risk_ana_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="risk_ana_attach[]"
                                                    oninput="addMultipleFiles(this, 'risk_ana_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>



                        <!-------------------------------------------- Hod/ Designee------------------------------------------------->

                        <div id="CCForm12" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    HOD/Designee
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Selection</label>
                                        <select multiple name="cft_reviewer[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            <option value="">-- Select --</option>
                                            @foreach ($cft as $data1)
                                                @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                    <option value="{{ $data1->id }}"> {{ $data1->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="Closure Comment">HOD/Designee Review Comment</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not
                                                    require completion</small></div>
                                            <textarea readonly class="summernote" name="hod_des_rev_comm" id="hod_des_rev_comm"> </textarea>
                                        </div>
                                    </div>


                                    {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Hod / Designee Attachment</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="hod_design_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="hod_design_attach" name="hod_design_attach[]" oninput="addMultipleFiles(this,'qa_cqa_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="CAPA Attachments"> HOD/Designee Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            {{-- <input multiple type="file" id="myfile" name="capa_attachment[]"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="hod_design_attach"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled type="file" id="myfile" name="hod_design_attach[]"
                                                        oninput="addMultipleFiles(this, 'hod_design_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-- CFT -->
                        <div id="CCForm8" class="inner-block cctabcontent">
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
                                            <label for="Production Tablet">Production Tablet/Capsule/Powder Review
                                                Required?</label>
                                            <select name="Production_Table_Review" id="Production_Table_Review" disabled>
                                                <option value="">-- Select --</option>
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                            <label for="Production Tablet notification">Production Tablet/Capsule/Powder
                                                Person</label>
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
                                                Tablet/Capsule/Powder)</label>
                                            <textarea class="summernote Production_Table_Assessment" name="Production_Table_Assessment" id="summernote-17"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet feedback">Production Tablet Feedback</label>
                                            <textarea class="summernote Production_Table_Feedback" name="Production_Table_Feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet attachment">Production Tablet/Capsule/Powder
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Production_Table_Attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="Production_Table_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder
                                                Completed By</label>
                                            <input readonly type="text" name="Production_Table_By"
                                                id="Production_Table_By">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionTable">
                                        <div class="group-input ">
                                            <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder
                                                Completed On</label>
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
                                            <label for="Production Injection"> Production Injection Review Required ?
                                            </label>
                                            <select name="Production_Injection_Review" id="Production_Injection_Review"
                                                disabled>
                                                <option value="">-- Select --</option>
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                            <label for="Production Injection notification">Production Injection
                                                Person</label>
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
                                    {{-- <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection feedback">Production Injection Feedback (By
                                                Production
                                                Injection) </label>
                                            <textarea class="summernote Production_Injection_Feedback" name="Production_Injection_Feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection attachment">Production Injection
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Production_Injection_Attachment">
                                                </div>
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
                                            <input type="date"id="Production_Injection_On"
                                                name="Production_Injection_On">
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
                                            <label for="Research Development"> Research & Development Required ?</label>
                                            <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review"
                                                disabled>
                                                <option value="">-- Select --</option>
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                            <label for="Research Development notification">Research & Development
                                                Person</label>
                                            <select name="ResearchDevelopmentStore_Person"
                                                class="ResearchDevelopment_Person" id="ResearchDevelopment_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development assessment">Impact Assessment (By Research &
                                                Development)</label>
                                            <textarea class="summernote ResearchDevelopment_assessment" name="ResearchDevelopment_assessment" id="summernote-17"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development feedback">Research & Development
                                                Feedback</label>
                                            <textarea class="summernote ResearchDevelopment_feedback" name="ResearchDevelopment_feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development attachment">Research & Development
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="ResearchDevelopment_attachment">
                                                </div>
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
                                            <label for="Research Development Completed By">Research & Development Completed
                                                By</label>
                                            <input readonly type="text" name="ResearchDevelopment_by"
                                                id="ResearchDevelopment_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 researchDevelopment">
                                        <div class="group-input ">
                                            <label for="Research Development Completed On">Research & Development Complete
                                                On</label>
                                            <input type="date" id="ResearchDevelopment_on"
                                                name="ResearchDevelopment_on">
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                    {{-- <div class="col-md-12 mb-3 human_resources">
                                        <div class="group-input">
                                            <label for="productionfeedback">Human Resource Feedback</label>
                                            <textarea class="" name="Human_Resource_feedback" id="summernote-36"></textarea>
                                        </div>
                                    </div> --}}
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
                                            <label for="Administration Review Completed By"> Human Resource Review
                                                Completed
                                                By</label>
                                            <input type="text" name="Human_Resource_by" id="Human_Resource_by"
                                                disabled>

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
                                                if ($(this).val() === 'Yes') {

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
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                            <label for="Corporate Quality Assurance notification">Corporate Quality
                                                Assurance
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
                                            <label for="Corporate Quality Assurance assessment">Impact Assessment (By
                                                Corporate
                                                Quality Assurance)</label>
                                            <textarea class="summernote CorporateQualityAssurance_assessment" readonly name="CorporateQualityAssurance_assessment"
                                                id="summernote-17"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance
                                                Feedback</label>
                                            <textarea class="summernote CorporateQualityAssurance_feedback" name="CorporateQualityAssurance_feedback"
                                                id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list"
                                                    id="CorporateQualityAssurance_attachment">
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
                                            <label for="Corporate Quality Assurance Completed By">Corporate Quality
                                                Assurance Review
                                                Completed By</label>
                                            <input readonly type="text" name="CorporateQualityAssurance_by"
                                                id="CorporateQualityAssurance_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 CQA">
                                        <div class="group-input ">
                                            <label for="Corporate Quality Assurance Completed On">Corporate Quality
                                                Assurance Review
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
                                            <label for="Store"> Store Required ?</label>
                                            <select name="Store_Review" id="Store_Review" disabled>
                                                <option value="">-- Select --</option>
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                    {{-- <div class="col-md-12 mb-3 store">
                                        <div class="group-input">
                                            <label for="Store feedback">Store Feedback</label>
                                            <textarea class="summernote Store_feedback" name="Store_feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>
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
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does
                                                    not require completion</small></div>
                                            <textarea class="" name="Engineering_assessment" id="summernote-25">
                                    </textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 engineering">
                                        <div class="group-input">
                                            <label for="productionfeedback">Engineering Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does
                                                    not require completion</small></div>
                                            <textarea class="" name="Engineering_feedback" id="summernote-26">
                                    </textarea>
                                        </div>
                                    </div> --}}
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
                                                        oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                        multiple>
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
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                    {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                            <textarea class="summernote RegulatoryAffair_feedback" name="RegulatoryAffair_feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="RegulatoryAffair_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="RegulatoryAffair_attachment[]"
                                                        oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair Completed By">Regulatory Affair Completed
                                                By</label>
                                            <input readonly type="text" name="RegulatoryAffair_by"
                                                id="RegulatoryAffair_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 RegulatoryAffair">
                                        <div class="group-input ">
                                            <label for="Regulatory Affair Completed On">Regulatory Affair Completed
                                                On</label>
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                            <label for="Impact Assessment3">Impact Assessment (By Quality
                                                Assurance)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does
                                                    not require completion</small></div>
                                            <textarea class="" name="QualityAssurance_assessment" id="summernote-23">
                                    </textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does
                                                    not require completion</small></div>
                                            <textarea class="" name="QualityAssurance_feedback" id="summernote-24">
                                    </textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Attachments">Quality Assurance
                                                Attachments</label>
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
                                        Production (Liquid/External Preparation)
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
                                            <label for="Production Liquid"> Production Liquid/External Preparation Required
                                                ? </label>
                                            <select name="ProductionLiquid_Review" id="ProductionLiquid_Review" disabled>
                                                <option value="">-- Select --</option>
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                                Liquid/External Preparation)</label>
                                            <textarea class="summernote ProductionLiquid_assessment" name="ProductionLiquid_assessment" id="summernote-17"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid feedback">Production Liquid/External Preparation
                                                Feedback</label>
                                            <textarea class="summernote ProductionLiquid_feedback" name="ProductionLiquid_feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid attachment">Production Liquid/External
                                                Preparation Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div> ProductionLiquid_attachment
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="ProductionLiquid_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="ProductionLiquid_attachment[]"
                                                        oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid Completed By">Production Liquid/External
                                                preparation Completed By</label>
                                            <input readonly type="text" name="ProductionLiquid_by"
                                                id="ProductionLiquid_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionLiquid">
                                        <div class="group-input ">
                                            <label for="Production Liquid Completed On">Production Liquid/External
                                                Preparation Completed On</label>
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                    <input type="file" id="myfile"
                                                        name="Quality_Control_attachment[]"
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
                                            <label for="Quality Control Review Completed On">Quality Control Review
                                                Completed
                                                On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Quality_Control_on" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Quality_Control_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
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
                                                <option value='Yes'>
                                                    Yes</option>
                                                <option value='No'>
                                                    No</option>
                                                <option value='NA'>
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
                                            <label for="Microbiology assessment">Impact Assessment (By
                                                Microbiology)</label>
                                            <textarea class="summernote Microbiology_assessment" name="Microbiology_assessment" id="summernote-17"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology feedback">Microbiology Feedback</label>
                                            <textarea class="summernote Microbiology_feedback" name="Microbiology_feedback" id="summernote-18"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology attachment">Microbiology Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Microbiology_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="Microbiology_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology Completed By">Microbiology Completed By</label>
                                            <input readonly type="text" name="Microbiology_by"
                                                id="Microbiology_by">
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
                                            <label for="Safety Review Required">Safety Required
                                                ?</label>
                                            <select name="Environment_Health_review" id="Environment_Health_review"
                                                disabled>
                                                <option value="0">-- Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                    {{-- <div class="col-md-12 mb-3 environmental_health">
                                        <div class="group-input">
                                            <label for="productionfeedback">Safety Feedback</label>
                                            <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                                        </textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12 environmental_health">
                                        <div class="group-input">
                                            <label for="Audit Attachments"> Safety Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list"
                                                    id="Environment_Health_Safety_attachment">
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
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="sub-head">
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
                                </div> --}}

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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                <option value="Process_Development_Lab">Process Development Laboratory /
                                                    Kilo
                                                    Lab</option>
                                                <option value="Technology transfer/Design">Technology Transfer/Design
                                                </option>
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
                                    {{-- <div class="col-md-12 mb-3 other1_reviews">
                                        <div class="group-input">
                                            <label for="productionfeedback"> Other's 1 Feedback</label>
                                            <textarea class="" name="Other1_feedback" id="summernote-42">
                                        </textarea>
                                        </div>
                                    </div> --}}
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                <option value="Process_Development_Lab">Process Development Laboratory /
                                                    Kilo
                                                    Lab</option>
                                                <option value="Technology transfer/Design">Technology Transfer/Design
                                                </option>
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
                                    {{-- <div class="col-md-12 mb-3 Other2_reviews">
                                        <div class="group-input">
                                            <label for="Feedback2"> Other's 2 Feedback</label>
                                            <textarea class="" name="Other2_feedback" id="summernote-44">
                                        </textarea>
                                        </div>
                                    </div> --}}
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                <option value="Process_Development_Lab">Process Development Laboratory /
                                                    Kilo
                                                    Lab</option>
                                                <option value="Technology transfer/Design">Technology Transfer/Design
                                                </option>
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
                                    {{-- <div class="col-md-12 mb-3 Other3_reviews">
                                        <div class="group-input">
                                            <label for="productionfeedback"> Other's 3 Feedback</label>
                                            <textarea class="" name="Other3_feedback" id="summernote-46">
                                        </textarea>
                                        </div>
                                    </div> --}}
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                <option value="Process_Development_Lab">Process Development Laboratory /
                                                    Kilo
                                                    Lab</option>
                                                <option value="Technology transfer/Design">Technology Transfer/Design
                                                </option>
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
                                    {{-- <div class="col-md-12 mb-3 Other4_reviews">
                                        <div class="group-input">
                                            <label for="feedback4"> Other's 4 Feedback</label>
                                            <textarea class="" name="Other4_feedback" id="summernote-48">
                                        </textarea>
                                        </div>
                                    </div> --}}
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="NA">NA</option>

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
                                                <option value="Process_Development_Lab">Process Development Laboratory /
                                                    Kilo
                                                    Lab</option>
                                                <option value="Technology transfer/Design">Technology Transfer/Design
                                                </option>
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
                                    {{-- <div class="col-md-12 mb-3 Other5_reviews">
                                        <div class="group-input">
                                            <label for="productionfeedback"> Other's 5 Feedback</label>
                                            <textarea class="" name="Other5_feedback" id="summernote-50">
                                        </textarea>
                                        </div>
                                    </div> --}}
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
                                    <button type="button"
                                        style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                        id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"
                                        style=" justify-content: center; width: 4rem; margin-left: 1px;">
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


                        <!--------- CQA /QA review---- --->
                        <div id="CCForm9" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    QA/CQA Review
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Review Comment</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not
                                                    require completion</small></div>
                                            <textarea readonly class="summernote" name="qa_cqa_comments" id="qa_cqa_comments"> </textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Review Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_attachments"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled type="file" id="qa_cqa_attachments"
                                                        name="qa_cqa_attachments[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_attachments')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-------------------------------------------QA/CQA Head Approval------------------------------------------>

                        <div id="CCForm11" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    QA/CQA Head Approval
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Head Approval Comment</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not
                                                    require completion</small></div>
                                            <textarea readonly class="summernote" name="qa_cqa_head_comm" id="qa_cqa_head_comm">
                                                </textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Head Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_head_attach"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled type="file" id="qa_cqa_head_attach"
                                                        name="qa_cqa_head_attach[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_head_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>


                        <div id="CCForm7" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Submit
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted By..">Submit By:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted On">Submit On:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Submit Comment:</label>
                                            <div class="static"> Not Applicable</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        HOD Review Complete
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Evaluated By">HOD Review Complete By:</label>
                                            <div class="static"> Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Evaluated On">HOD Review Complete On:</label>
                                            <div class="static">Not applicable </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">HOD Review Comment:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        CFT Review Complete
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">CFT Review Complete By:</label>
                                            <div class="static">Not applicable </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">CFT Review Complete On:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">CFT Review Complete Comment:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        QA/CQA Review
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">QA/CQA Review Complete By:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">QA/CQA Review Complete On:</label>
                                            <div class="static"> Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">QA/CQA Review Complete Comment:</label>
                                            <div class="static"> Not Applicable</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Approved
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Approved By:</label>
                                            <div class="static">Not Applicable </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Approved On:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Approved Comment:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12 sub-head" style="font-size: 16px">
                                    Closed-Done
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved By">Close Done By:-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved On">Close Done On:-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comments">Comments:-</label>
                                        <div class="static"></div>
                                    </div>
                                </div> --}}

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Cancel
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Cancel By:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Cancel On:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Cancel Comment:</label>
                                            <div class="static">Not Applicable</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit">Submit</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>




                        <!-- Risk Details content -->
                        <div id="CCForm4" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Department(s)">Department(s)</label>
                                            <select multiple name="departments2[]" placeholder="Select Departments"
                                                data-search="false" data-silent-initial-value-set="true"
                                                id="departments">
                                                <option value="">Select Department</option>
                                                <option value="QA">QA</option>
                                                <option value="QC">QC</option>
                                                <option value="R&D">R&D</option>
                                                <option value="Wet Chemistry Area">Wet Chemistry Area</option>
                                                <option value="Warehouse">Warehouse</option>
                                                <option value="Molecular Area">Molecular Area</option>
                                                <option value="Microbiology Area">Microbiology Area</option>
                                                <option value="Instrumental Area">Instrumental Area</option>
                                                <option value="Administration">Administration</option>
                                                <option value="Financial Department">Financial Department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Sourcd of Risk">Source of Risk</label>
                                            <select name="source_of_risk2" id="sourcd_of_risk">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Audit">Audit</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Employee">Employee</option>
                                                <option value="Customer">Customer</option>
                                                <option value="Regulation">Regulation</option>
                                                <option value="Competition">Competition</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Site Name">Site Name</label>
                                            <select name="site_name" id="site_name">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="City MFR A">City MFR A</option>
                                                <option value="City MFR B">City MFR B</option>
                                                <option value="City MFR C">City MFR C</option>
                                                <option value="Complex A">Complex A</option>
                                                <option value="Complex B">Complex B</option>
                                                <option value="Marketing A">Marketing A</option>
                                                <option value="Marketing B">Marketing B</option>
                                                <option value="Marketing C">Marketing C</option>
                                                <option value="Oceanside">Oceanside</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Building.">Building.</label>
                                            <select name="building" id="building">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Floor...">Floor</label>
                                            <select name="floor" id="floor">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="First">First</option>
                                                <option value="Second">Second</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Room">Room</label>
                                            <select name="room" id="room">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="C-101">C-101</option>
                                                <option value="C-202">C-202</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Duration">Duration</label>
                                            <select name="duration" id="duration">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="2 hours">2 hours</option>
                                                <option value="4 hours">4 hours</option>
                                                <option value="8 hours">8 hours</option>
                                                <option value="16 hours">16 hours</option>
                                                <option value="24 hours">24 hours</option>
                                                <option value="36 hours">36 hours</option>
                                                <option value="72 hours">72 hours</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Hazard">Hazard</label>
                                            <select name="hazard" id="hazard">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Confined Space">Confined Space</option>
                                                <option value="Electrical">Electrical</option>
                                                <option value="Energy use">Energy use</option>
                                                <option value="Ergonomics">Ergonomics</option>
                                                <option value="Machine Guarding">Machine Guarding</option>
                                                <option value="Material Storage">Material Storage</option>
                                                <option value="Material use">Material use</option>
                                                <option value="Pressure">Pressure</option>
                                                <option value="Thermal">Thermal</option>
                                                <option value="Water use">Water use</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Room">Room</label>
                                            <select name="room2" id="room2">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Automation">Automation</option>
                                                <option value="Biochemistry">Biochemistry</option>
                                                <option value="Blood Collection">Blood Collection</option>
                                                <option value="Enter Yo">Enter Yo</option>
                                                <option value="Buffer Preparation">Buffer Preparation</option>
                                                <option value="Bulk Fill">Bulk Fill</option>
                                                <option value="Calibration">Calibration</option>
                                                <option value="Component Manufacturing">Component Manufacturing</option>
                                                <option value="Computer">Computer</option>
                                                <option value="Computer / Automated Systems">Computer / Automated Systems
                                                </option>
                                                <option value="Despensing Donor Suitability">Despensing Donor Suitability
                                                </option>
                                                <option value="Filling">Filling</option>
                                                <option value="Filtration">Filtration</option>
                                                <option value="Formulation">Formulation</option>
                                                <option value="Incoming QA">Incoming QA</option>
                                                <option value="Hazard">Hazard</option>
                                                <option value="Laboratory">Laboratory</option>
                                                <option value="Laboratory Support Facility">Laboratory Support Facility
                                                </option>
                                                <option value="Enter Your">Enter Your</option>
                                                <option value="Lot Release">Lot Release</option>
                                                <option value="Manufacturing">Manufacturing</option>
                                                <option value="Materials Management">Materials Management</option>
                                                <option value="Room">Room</option>
                                                <option value="Operations">Operations</option>
                                                <option value="Packaging">Packaging</option>
                                                <option value="Plant Engineering">Plant Engineering</option>
                                                <option value="Enter Your Sele">Enter Your Sele</option>
                                                <option value="Njown">Njown</option>
                                                <option value="Powder Filling">Powder Filling</option>
                                                <option value="Process Development">Process Development</option>
                                                <option value="Product Distribution">Product Distribution</option>
                                                <option value="Product Testing">Product Testing</option>
                                                <option value="Production Purification">Production Purification</option>
                                                <option value="QA">QA</option>
                                                <option value="QA Laboratory Quality Control">QA Laboratory Quality
                                                    Control</option>
                                                <option value="Quality Control / Assurance">Quality Control / Assurance
                                                </option>
                                                <option value="Sanitization">Sanitization</option>
                                                <option value="Shipping/Distribution Storage/Distribution">
                                                    Shipping/Distribution Storage/Distribution</option>
                                                <option value="Storage and Distribution">Storage and Distribution</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Regulatory Climate">Regulatory Climate</label>
                                            <select name="regulatory_climate" id="regulatory_climate">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="0. No significant regulatory issues affecting operation">0.
                                                    No significant regulatory issues affecting operation</option>
                                                <option
                                                    value="1. Some regulatory or enforcement changes potentially affecting operation are anticipated">
                                                    1. Some regulatory or enforcement changes potentially affecting
                                                    operation are anticipated</option>
                                                <option
                                                    value="2. A few regulatory or enforcement changes affect operations">
                                                    2. A few regulatory or enforcement changes affect operations</option>
                                                <option value="3. Regulatory and enforcement changes affect operation">3.
                                                    Regulatory and enforcement changes affect operation</option>
                                                <option
                                                    value="4. Significant programatic regulatory and enforcement changes affect operation">
                                                    4. Significant programatic regulatory and enforcement changes affect
                                                    operation</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Number of Employees">Number of Employees</label>
                                            <select name="Number_of_employees" id="Number_of_employees">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="0-50">0-50</option>
                                                <option value="50-100">50-100</option>
                                                <option value="100-200">100-200</option>
                                                <option value="200-300">200-300</option>
                                                <option value="300-500">300-500</option>
                                                <option value="500-1000">500-1000</option>
                                                <option value="1000+">1000+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Risk Management Strategy">Risk Management Strategy</label>
                                            <select name="risk_management_strategy" id="risk_management_strategy">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Accept">Accept</option>
                                                <option value="Avoid the Risk">Avoid the Risk</option>
                                                <option value="Mitigate">Mitigate</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>









                        <!-- Work Group Assignment content -->
                        <div id="CCForm3" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    Assignment Details
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Date Due">Scheduled Start Date</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="schedule_start_date" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" id="schedule_start_date_checkdate"
                                                    name="schedule_start_date1" class="hide-input"
                                                    oninput="handleDateInput(this, 'schedule_start_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Date Due">Scheduled End Date</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="schedule_end_date" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" id="schedule_end_date_checkdate"
                                                    name="schedule_end_date1" class="hide-input"
                                                    oninput="handleDateInput(this, 'schedule_end_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Estimated Man-Hours">Estimated Man-Hours</label>
                                            <input type="text" name="estimated_man_hours" id="estimated_man_hours">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Estimated Cost">Estimated Cost</label>
                                            <input type="text" name="estimated_cost" id="estimated_cost">
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Supervisor">Supervisor</label>

                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Currency">Currency</label>
                                            <select name="currency" id="currency">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="ARS-Argentine Peso">ARS-Argentine Peso</option>
                                                <option value="AUD-Australian Dollar">AUD-Australian Dollar</option>
                                                <option value="BRL-Brazilian Real">BRL-Brazilian Real</option>
                                                <option value="CAD-Canadian Dollar">CAD-Canadian Dollar</option>
                                                <option value="CHF-Swiss Franc">CHF-Swiss Franc</option>
                                                <option value="CNY-Chinese Yuan">CNY-Chinese Yuan</option>
                                                <option value="EUR-Euro">EUR-Euro</option>
                                                <option value="HKD-Hong Kong Dollar">HKD-Hong Kong Dollar</option>
                                                <option value="ILS-Israeli New Sheqel">ILS-Israeli New Sheqel</option>
                                                <option value="INR-Indian Rupee">INR-Indian Rupee</option>
                                                <option value="JPY-Japanese Yen">JPY-Japanese Yen</option>
                                                <option value="KRW-South Korean Won">KRW-South Korean Won</option>
                                                <option value="MXN-Mexican Peso">MXN-Mexican Peso</option>
                                                <option value="RUB-Russian Rouble">RUB-Russian Rouble</option>
                                                <option value="SAR-Saudi Riyal">SAR-Saudi Riyal</option>
                                                <option value="TRY-Turkish Lira">TRY-Turkish Lira</option>
                                                <option value="USD-US Dollar">USD-US Dollar</option>
                                                <option value="XAG-Silver">XAG-Silver</option>
                                                <option value="XAU-Gold">XAU-Gold</option>
                                                <option value="XPD-Palladium">XPD-Palladium</option>
                                                <option value="XPT-Platinum">XPT-Platinum</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Team Members">Team Members</label>
                                            <select multiple name="team_members2[]" placeholder="Select Team Members"
                                                data-search="false" data-silent-initial-value-set="true" id="team_members">
                                                <option value="">select team member</option>
                                                <option value="1">Amit Guru</option>
                                                <option value="2">Anshul Patel</option>
                                                <option value="3">Vikash Prajapati</option>
                                                <option value="4">Amit Patel</option>
                                                <option value="5">Shaleen Mishra</option>
                                                <option value="6">Madhulika Mishra</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Training Requirement">Training Requirement</label>
                                            <select multiple name="training_require" placeholder="Select Training Requirement"
                                                data-search="false" data-silent-initial-value-set="true"
                                                id="training_require">
                                                <option value="">ABC</option>
                                                <option value="1">ABC</option>
                                                <option value="1">ABC</option>
                                                <option value="1">ABC</option>

                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="Justification / Rationale">Justification / Rationale</label>
                                            <textarea name="justification" id="justification"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Action Plan
                                </div>
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Product/Material">
                                                    Action Plan<button type="button" name="ann"
                                                        id="action_plan">+</button>
                                                </label>
                                                <table class="table table-bordered" id="action_plan_details">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:78px;">Row #</th>
                                                            <th>Action</th>
                                                            <th>Responsible Person</th>
                                                            <th>Deadline</th>
                                                            <th>Item static</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"
                                                                    value="1" disabled></td>
                                                            <td><input type="text" name="action[]"></td>
                                                            <td>
                                                                <select id="select-state" placeholder="Select..."
                                                                    name="responsible[]">
                                                                    <option value="">Select a value</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date">
                                                                        <div class="calenderauditee">
                                                                            <input type="text" id="deadline1"
                                                                                readonly placeholder="DD-MMM-YYYY" />
                                                                            <input type="date" name="deadline[]"
                                                                                class="hide-input"
                                                                                oninput="handleDateInput(this, 'deadline1')" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><input type="text" name="item_static[]"></td>
                                                            <td><button type="button"
                                                                    class="removeRowBtn">Remove</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="References">References</label>
                                            <input type="text" name="reference" id="reference">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Report Attachments">Work Group Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="reference"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="reference[]"
                                                        oninput="addMultipleFiles(this, 'reference')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>




                        <!-- Residual Risk content -->
                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Residual Risk">Residual Risk</label>
                                            <input type="text" name="residual_risk" id="residual_risk">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Residual Risk Impact">Residual Risk Impact</label>
                                            <select name="residual_risk_impact" id="analysisR2"
                                                onchange='calculateRiskAnalysis2(this)'>
                                                {{--  <option value="">Enter Your Selection Here</option>
                                                <option value="1">High</option>
                                                <option value="2">Low</option>
                                                <option value="3">Medium</option>
                                                <option value="4">None</option>  --}}


                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1'>1-Insignificant</option>
                                                <option value='2'>2-Minor</option>
                                                <option value='3'>3-Major</option>
                                                <option value='4'>4-Critical</option>
                                                <option value='5'>5-Catastrophic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Residual Risk Probability">Residual Risk Probability</label>
                                            <select name="residual_risk_probability" id="analysisP2"
                                                onchange='calculateRiskAnalysis2(this)'>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1'>1-Very rare</option>
                                                <option value='2'>2-Unlikely</option>
                                                <option value='3'>3-Possibly</option>
                                                <option value='4'>4-Likely</option>
                                                <option value='5'>5-Almost certain (every time)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Detection">Residual Detection</label>
                                            <select name="detection2" id="analysisN2"
                                                onchange='calculateRiskAnalysis2(this)'>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1'>1-Always detected</option>
                                                <option value='2'>2-Likely to detect</option>
                                                <option value='3'>3-Possible to detect</option>
                                                <option value='4'>4-Unlikely to detect</option>
                                                <option value='5'>5-Not detectable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RPN">Residual RPN</label>
                                            <div><small class="text-primary">Auto - Calculated</small></div>
                                            <input type="text" name="rpn2" id="analysisRPN2" value=""
                                                readonly>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="">Residual Risk Level</label>
                                            <input type="text" name="risk_level_2" id="riskLevel_2" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <textarea name="comments2" id="comments2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm6" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="container-fluid">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="mitigation_plan_details">
                                                Mitigation Plan Details <button type="button" name="ann"
                                                    id="action_plan2"
                                                    onclick="addMitigationPlan('action_plan_details02')">+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="action_plan_details02">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Mitigation Steps</th>
                                                            <th>Deadline</th>
                                                            <th>Responsible Person</th>
                                                            <th>Status</th>
                                                            <th>Remarks</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="text" name="serial_number[]"
                                                                    value="1" disabled></td>
                                                            <td><input type="text" name="mitigation_steps[]"></td>
                                                            <td>
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date">
                                                                        <div class="calenderauditee">
                                                                            <input type="text" id="deadline2_1"
                                                                                readonly placeholder="DD-MMM-YYYY" />
                                                                            <input type="date" name="deadline2[]"
                                                                                class="hide-input"
                                                                                oninput="handleDateInput(this, 'deadline2_1')" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <select id="select-state" placeholder="Select..."
                                                                    name="responsible_person[]">
                                                                    <option value="">Select a value</option>
                                                                    @foreach ($users as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="status[]"></td>
                                                            <td><input type="text" name="remark[]"></td>
                                                            <td><button type="button"
                                                                    class="removeRowBtn">Remove</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Risk Mitigation</div>
                                </div>
                                {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="mitigation-required">Mitigation Required</label>
                                            <div class="check-input">

                                                <select name="mitigation_required">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="yes">yes</option>
                                                    <option value="no">No</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Department(s)">Mitigation Required</label>
                                        <select name="mitigation_required"
                                            onchange="otherController(this.value, 'yes', 'initiated_through_req')">
                                            <option value="">Select Mitigation </option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="mitigation-plan">Mitigation Plan<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="mitigation_plan"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Scheduled End Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="mitigation_due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="mitigation_due_date" class="hide-input"
                                                oninput="handleDateInput(this, 'mitigation_due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="mitigation-status">Status of Mitigation</label>
                                        <select name="mitigation_status">
                                            <option value="0">-- Select --</option>
                                            <option value="Green Status ">Green Status</option>
                                            <option value="Amber Status">Amber Status</option>
                                            <option value="Red Staus">Red Staus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="mitigation-status-comments">Mitigation Status Comments</label>
                                        <textarea name="mitigation_status_comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Overall Assessment</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="impact">Impact</label>
                                        <select name="impact">
                                            <option value="">-- Select --</option>
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                            <option value="none">None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="criticality">Criticality</label>
                                        <select name="criticality">
                                            <option value="">-- Select --</option>
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="impact-analysis">Impact Analysis</label>
                                        <textarea name="impact_analysis"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="risk-analysis">Risk Analysis</label>
                                        <textarea name="risk_analysis"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="severity">Severity</label>
                                            <select name="severity">
                                                <option value="">-- Select --</option>
                                                <option value="Negligible">Negligible</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Major">Major</option>
                                                <option value="Fatal">Fatal</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="occurance">Occurance</label>
                                            <select name="occurance">
                                                <option value="">-- Select --</option>
                                                <option value="Extremely_Unlikely">Extremely Unlikely</option>
                                                <option value="Rare">Rare</option>
                                                <option value="Unlikely">Unlikely</option>
                                                <option value="Likely">Likely</option>
                                                <option value="Very_Likely">Very Likely</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Reference Recores">Reference Record</label>
                                        <select multiple id="reference_record" name="refrence_record[]">
                                            <option value="">--Select---</option>
                                            @foreach ($old_record as $new)
                                                <option value="{{ $new->id }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/RA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
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
            VirtualSelect.init({
                ele: '#Facility, #Group, #Audit, #Auditee, #cft_reviewer, #root-cause-methodology,#training_require, #reference_record, #related_record, #Initial_attachment'
            });


            $(document).on('click', '.removeBtn', function() {
                console.log('click ');
                $(this).closest('tr').remove();
            })

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
            VirtualSelect.init({
                ele: '#departments,#departments_2, #team_members, #training-require, #impacted_objects'
            });
        </script>
        <script>
            // JavaScript
            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('initiator_group_code').value = selectedValue;
            });
        </script>

        <script>
            $(document).ready(function() {


            });
        </script>

        {{--  <script>
            $(document).on('click', '.removeRowBtn', function() {
                $(this).closest('tr').remove();
            })
            </script>  --}}

        <script>
            var maxLength = 255;
            $('#docname').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#rchars').text(textlen);
            });
        </script>

        <script>
            document.getElementById('action_plan').addEventListener('click', function() {
                var table = document.getElementById('action_plan_details').getElementsByTagName('tbody')[0];
                var rowCount = table.rows.length;
                var newRow = table.insertRow(rowCount);
                var serialNumber = rowCount + 1;

                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);
                var cell5 = newRow.insertCell(4);
                var cell6 = newRow.insertCell(5);

                cell1.innerHTML = '<input type="text" name="serial_number[]" value="' + serialNumber + '" disabled>';
                cell2.innerHTML = '<input type="text" name="action[]">';
                cell3.innerHTML =
                    '<select id="select-state" placeholder="Select..." name="responsible[]"><option value="">Select a value</option>@foreach ($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>@endforeach</select>';
                cell4.innerHTML =
                    '<div class="group-input new-date-data-field mb-0"><div class="input-date"><div class="calenderauditee"><input type="text" id="deadline' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, \'deadline' +
                    serialNumber + '\')" /></div></div></div>';
                cell5.innerHTML = '<input type="text" name="item_static[]">';
                cell6.innerHTML = '<button type="button" class="removeRowBtn">Remove</button>';
            });

            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('removeRowBtn')) {
                    var row = e.target.closest('tr');
                    row.parentNode.removeChild(row);
                }
            });

            function handleDateInput(input, targetId) {
                var target = document.getElementById(targetId);
                if (target) {
                    target.value = new Date(input.value).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }).replace(/ /g, '-');
                }
            }
        </script>

        <script>
            function addMitigationPlan() {
                var table = document.getElementById('action_plan_details02').getElementsByTagName('tbody')[0];
                var rowCount = table.rows.length;
                var serialNumber = rowCount + 1;
                var newRow = table.insertRow(rowCount);

                newRow.innerHTML = `
            <td><input type="text" name="serial_number[]" value="${serialNumber}" disabled></td>
            <td><input type="text" name="mitigation_steps[]"></td>
            <td>
                <div class="group-input new-date-data-field mb-0">
                    <div class="input-date">
                        <div class="calenderauditee">
                            <input type="text" id="deadline2_${serialNumber}" readonly placeholder="DD-MMM-YYYY" />
                            <input type="date" name="deadline2[]" class="hide-input" oninput="handleDateInput(this, 'deadline2_${serialNumber}')" />
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <select id="select-state" placeholder="Select..." name="responsible_person[]">
                    <option value="">Select a value</option>
                    @foreach ($users as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="status[]"></td>
            <td><input type="text" name="remark[]"></td>
            <td><button type="button" class="removeRowBtn">Remove</button></td>
        `;

                // Reinitialize event listener for the new row's remove button
                initializeRemoveButtons();
            }

            function initializeRemoveButtons() {
                var removeButtons = document.getElementsByClassName('removeRowBtn');
                for (var i = 0; i < removeButtons.length; i++) {
                    removeButtons[i].onclick = function() {
                        var row = this.closest('tr');
                        row.parentNode.removeChild(row);
                        updateSerialNumbers();
                    };
                }
            }

            function updateSerialNumbers() {
                var table = document.getElementById('action_plan_details02').getElementsByTagName('tbody')[0];
                var rows = table.getElementsByTagName('tr');
                for (var i = 0; i < rows.length; i++) {
                    var serialNumberCell = rows[i].getElementsByTagName('td')[0];
                    serialNumberCell.getElementsByTagName('input')[0].value = i + 1;
                }
            }

            function handleDateInput(input, targetId) {
                var target = document.getElementById(targetId);
                var date = new Date(input.value);
                var options = {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                };
                target.value = date.toLocaleDateString(undefined, options);
            }

            // Initialize remove buttons for the first row
            initializeRemoveButtons();
        </script>





        <script>
            $(document).ready(function() {
                $('#root-cause-methodology').on('change', function() {
                    var selectedValues = $(this).val();
                    $('#why-why-chart-section').hide();
                    $('#fmea-section').hide();
                    $('#fishbone-section').hide();
                    $('#is-is-not-section').hide();

                    if (selectedValues.includes('Why-Why Chart')) {
                        $('#why-why-chart-section').show();
                    }
                    if (selectedValues.includes('Failure Mode and Effect Analysis')) {
                        $('#fmea-section').show();
                    }
                    if (selectedValues.includes('Fishbone or Ishikawa Diagram')) {
                        $('#fishbone-section').show();
                    }
                    if (selectedValues.includes('Is/Is Not Analysis')) {
                        $('#is-is-not-section').show();
                    }
                });
            });
        </script>

        <script>
            VirtualSelect.init({
                ele: '#reference_record, #notify_to'
            });

            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            let referenceCount = 1;

            function addReference() {
                referenceCount++;
                let newReference = document.createElement('div');
                newReference.classList.add('row', 'reference-data-' + referenceCount);
                newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
                let referenceContainer = document.querySelector('.reference-data');
                referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
            }
        </script>

       <script>
         var editor = new FroalaEditor('.summernote-1', {
            key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
            imageUploadParam: 'image_param',
            imageUploadMethod: 'POST',
            imageMaxSize: 20 * 1024 * 1024,
            imageUploadURL: "{{ secure_url('api/upload-files') }}",
            fileUploadParam: 'image_param',
            fileUploadURL: "{{ secure_url('api/upload-files')}}",
            videoUploadParam: 'image_param',
            videoUploadURL: "{{ secure_url('api/upload-files') }}",
            videoMaxSize: 500 * 1024 * 1024,
         });
         
          $(".summernote-1-disabled").FroalaEditor("edit.off");
       </script>

        <script>
            function addRiskAssessmentdata2(tableId) {
                var table = document.getElementById(tableId);
                var currentRowCount = table.children[1].rows.length;
                var newRow = table.children[1].insertRow(currentRowCount);
                newRow.setAttribute("id", "row" + currentRowCount);
                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = currentRowCount + 1;

                var cell2 = newRow.insertCell(1);
                cell2.innerHTML = "<textarea name='risk_factor[]' type='text'></textarea>";


                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = "<textarea name='risk_element[]' type='text'>";

                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "<textarea name='problem_cause[]' type='text'>";

                // var cell5 = newRow.insertCell(4);
                // cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

                var cell5 = newRow.insertCell(4);
                cell5.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";
                // "<input name='initial_severity[]' type='text'>";


                var cell6 = newRow.insertCell(5);
                cell6.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

                var cell7 = newRow.insertCell(6);
                cell7.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

                var cell8 = newRow.insertCell(7);
                cell8.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn' readonly>";

                // var cell10 = newRow.insertCell(9);
                // cell10.innerHTML =
                //     "<select name='risk_acceptance[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

                var cell19 = newRow.insertCell(8);
                cell19.innerHTML = "<textarea name='risk_control_measure[]' type='text'>";

                var cell10 = newRow.insertCell(9);
                cell10.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";

                var cell11 = newRow.insertCell(10);
                cell11.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

                var cell12 = newRow.insertCell(11);
                cell12.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

                var cell13 = newRow.insertCell(12);
                cell13.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' readonly>";
                var cell14 = newRow.insertCell(13);
                cell14.innerHTML =
                    "<select name='risk_acceptance[]' class='risk-acceptance' readonly>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='Low'>Low</option>" +
                    "<option value='Medium'>Medium</option>" +
                    "<option value='High'>High</option>" +
                    "</select>";

                var cell15 = newRow.insertCell(14);
                cell15.innerHTML =
                    "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

                var cell16 = newRow.insertCell(15);
                cell16.innerHTML = "<textarea name='mitigation_proposal[]' type='text'>";

                var cell17 = newRow.insertCell(16);
                cell17.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

                for (var i = 0; i < currentRowCount - 1; i++) {
                    var row = table.children[1].rows[i];
                    row.cells[0].innerHTML = i + 1;
                }
                //  initializeRiskAcceptance();

            }
        </script>

        <script>
            function removeWhyField(element) {
            element.closest('.why-field-wrapper').remove();
        }

        function addWhyField(blockClass, fieldName) {
            const block = document.querySelector(`.${blockClass}`);

            const fieldWrapper = document.createElement('div');
            fieldWrapper.className = 'why-field-wrapper';
            // fieldWrapper.style.display = 'flex';
            // fieldWrapper.style.gap = '10px';
            // fieldWrapper.style.marginBottom = '5px';

            const textarea = document.createElement('textarea');
            textarea.name = fieldName;

            const removeButton = document.createElement('span');
            removeButton.innerText = 'Remove';
            removeButton.style.cursor = 'pointer';
            removeButton.style.color = 'red';
            removeButton.onclick = function() {
                fieldWrapper.remove();
            };

            fieldWrapper.appendChild(textarea);
            fieldWrapper.appendChild(removeButton);
            block.appendChild(fieldWrapper);
        }

        </script>
    @endsection
