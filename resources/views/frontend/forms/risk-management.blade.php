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
                {{ Helpers::getDivisionName(session()->get('division')) }} / Risk Assesment
            </div>
        </div>
        @php
            $users = DB::table('users')->get();
        @endphp


        <div id="change-control-fields">
            <div class="container-fluid">

                <!-- Tab links -->
                <div class="cctab">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Risk/Opportunity Assesment</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk/Opportunity details </button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Work Group Assignment</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Risk/Opportunity Analysis</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Residual Risk</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Risk Mitigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
                </div>

                <form action="{{ route('risk_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="step-form">

                        <!-- Risk Management Tab content -->
                        <div id="CCForm1" class="inner-block cctabcontent">

                            <div class="inner-block-content">
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
                                        <div class="group-input">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                            <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">

                                            {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        </div>
                                    </div>


                                    
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                                Assigned To <span class="text-danger"></span>
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
                                    {{--  <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Date Due">Date Due</label>
                                            <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                            </div>
                                            <div class="calenderauditee">
                                                <input type="text" id="due_date" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'due_date')" />
                                            </div>
                                        </div>
                                    </div>  --}}

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Date Due">Date Due</label>
                                            <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                            <div class="calenderauditee">
                                                <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getDueDatemonthly(null, false, 'd-M-Y') }}" />
                                                <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" value="{{ Helpers::getDueDatemonthly(null, false, 'Y-m-d') ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group"><b>Initiator Group</b></label>
                                            <select name="Initiator_Group" id="initiator_group">
                                                <option value="">-- Select --</option>
                                                <option value="CQA" @if(old('Initiator_Group') =="CQA") selected @endif>Corporate Quality Assurance</option>
                                                <option value="QAB" @if(old('Initiator_Group') =="QAB") selected @endif>Quality Assurance Biopharma</option>
                                                <option value="CQC" @if(old('Initiator_Group') =="CQA") selected @endif>Central Quality Control</option>
                                                <option value="MANU" @if(old('Initiator_Group') =="MANU") selected @endif>Manufacturing</option>
                                                <option value="PSG" @if(old('Initiator_Group') =="PSG") selected @endif>Plasma Sourcing Group</option>
                                                <option value="CS"  @if(old('Initiator_Group') == "CS") selected @endif>Central Stores</option>
                                                <option value="ITG" @if(old('Initiator_Group') =="ITG") selected @endif>Information Technology Group</option>
                                                <option value="MM"  @if(old('Initiator_Group') == "MM") selected @endif>Molecular Medicine</option>
                                                <option value="CL"  @if(old('Initiator_Group') == "CL") selected @endif>Central Laboratory</option>

                                                <option value="TT"  @if(old('Initiator_Group') == "TT") selected @endif>Tech team</option>
                                                <option value="QA"  @if(old('Initiator_Group') == "QA") selected @endif> Quality Assurance</option>
                                                <option value="QM"  @if(old('Initiator_Group') == "QM") selected @endif>Quality Management</option>
                                                <option value="IA"  @if(old('Initiator_Group') == "IA") selected @endif>IT Administration</option>
                                                <option value="ACC"  @if(old('Initiator_Group') == "ACC") selected @endif>Accounting</option>
                                                <option value="LOG"  @if(old('Initiator_Group') == "LOG") selected @endif>Logistics</option>
                                                <option value="SM"  @if(old('Initiator_Group') == "SM") selected @endif>Senior Management</option>
                                                <option value="BA"  @if(old('Initiator_Group') == "BA") selected @endif>Business Administration</option>
                                            </select>
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
                                            <label for="Short Description">Short Description <span
                                                    class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                            <textarea name="short_description" id="short_desc"></textarea>
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
                                    <div class="col-12">
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
                                    </div>
                                    <div class="col-12">
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
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Team Members">Team Members</label>
                                            <select multiple name="team_members[]" placeholder="Select Team Members"
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
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Sourcd of Risk">Source of Risk/Opportunity</label>
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
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Type..">Type</label>
                                            <select name="type" id="type">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="Other">Other</option>
                                                <option value="Business_Risk">Business Risk</option>
                                                <option value="custumer_Related">Customer-Related Risk(Complaint)</option>
                                                <option value="Opportunity">Opportunity</option>
                                                <option value="Market">Market</option>
                                                <option value="Operational_Risk">Operational Risk</option>
                                                <option value="Strategic_Risk">Strategic Risk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Priority Level">Priority Level</label>
                                            <select name="priority_level" id="priority_level">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="High">High</option>
                                                <option value="medium">Medium</option>
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
                                    </div>--}}
                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="Description">Risk/Opportunity Description</label>
                                            <textarea name="description" id="description"></textarea>
                                        </div>
                                    </div> 
                                    
                                    {{-- <div class="col-6">
                                        <div class="group-input">
                                            <label for="Description"> Opportunity Description</label>
                                            <textarea name=" Opportunity_description" id="Opportunitydescription"></textarea>
                                        </div>
                                    </div> --}}


                                    <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Impact Assessment">Purpose</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="summernote" name="purpose" id="summernote-1">
                                                    </textarea>
                                            </div>
                                    </div>

                                     <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Impact Assessment">Scope</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="summernote" name="scope" id="summernote-1">
                                                    </textarea>
                                            </div>
                                    </div>


                                     <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Impact Assessment">Reason for Revision</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="summernote" name="reason_for_revision" id="summernote-1">
                                                    </textarea>
                                            </div>
                                    </div>


                                     <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Impact Assessment">Brief Description / Procedure </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="summernote" name="Brief_description" id="summernote-1">
                                                    </textarea>
                                            </div>
                                    </div>

                                     <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Impact Assessment">Documents Used for Risk Management</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="summernote" name="document_used_risk" id="summernote-1">
                                                    </textarea>
                                            </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Risk/Opportunity Comments</label>
                                            <textarea name="comments" id="comments"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="CAPA Attachments">Initial Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            {{-- <input multiple type="file" id="myfile" name="capa_attachment[]"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="capa_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="risk_attachment[]"
                                                        oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="button-block">
                                    <button type="submit" id="ChangeSaveButton" class="saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                                </div>
                            </div>

                        </div>

                        <!-- Risk Details content -->
                        <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Department(s)">Department(s)</label>
                                          <select multiple name="departments2[]" placeholder="Select Departments"
                                                data-search="false" data-silent-initial-value-set="true" id="departments">
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
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Related Record">Related Record</label>
                                            <div class="static">Ref.Record</div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Reference Recores">Related Record</label>
                                            <select multiple id="related_record" name="related_record[]" id="">
                                                <option value="">--Select---</option>
                                                @foreach ($old_record as $new)
                                                    <option value="{{ $new->id }}">
                                                        {{ Helpers::getDivisionName($new->division_id) }}/RA/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

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
                                                <option value="Computer / Automated Systems">Computer / Automated Systems</option>
                                                <option value="Despensing Donor Suitability">Despensing Donor Suitability</option>
                                                <option value="Filling">Filling</option>
                                                <option value="Filtration">Filtration</option>
                                                <option value="Formulation">Formulation</option>
                                                <option value="Incoming QA">Incoming QA</option>
                                                <option value="Hazard">Hazard</option>
                                                <option value="Laboratory">Laboratory</option>
                                                <option value="Laboratory Support Facility">Laboratory Support Facility</option>
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
                                                <option value="QA Laboratory Quality Control">QA Laboratory Quality Control</option>
                                                <option value="Quality Control / Assurance">Quality Control / Assurance</option>
                                                <option value="Sanitization">Sanitization</option>
                                                <option value="Shipping/Distribution Storage/Distribution">Shipping/Distribution Storage/Distribution</option>
                                                <option value="Storage and Distribution">Storage and Distribution</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Regulatory Climate">Regulatory Climate</label>
                                            <select name="regulatory_climate" id="regulatory_climate">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="0. No significant regulatory issues affecting operation">0. No significant regulatory issues affecting operation</option>
                                                <option value="1. Some regulatory or enforcement changes potentially affecting operation are anticipated">1. Some regulatory or enforcement changes potentially affecting operation are anticipated</option>
                                                <option value="2. A few regulatory or enforcement changes affect operations">2. A few regulatory or enforcement changes affect operations</option>
                                                <option value="3. Regulatory and enforcement changes affect operation">3. Regulatory and enforcement changes affect operation</option>
                                                <option value="4. Significant programatic regulatory and enforcement changes affect operation">4. Significant programatic regulatory and enforcement changes affect operation</option>
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
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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
                                                <input type="date" id="schedule_start_date_checkdate" name="schedule_start_date1" class="hide-input"
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
                                                <input type="date" id="schedule_end_date_checkdate" name="schedule_end_date1" class="hide-input"
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
                                                    Action Plan<button type="button" name="ann" id="action_plan">+</button>
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
                                                            <td><input type="text" name="serial_number[]" value="1" disabled></td>
                                                            <td><input type="text" name="action[]"></td>
                                                            <td>
                                                                <select id="select-state" placeholder="Select..." name="responsible[]">
                                                                    <option value="">Select a value</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date">
                                                                        <div class="calenderauditee">
                                                                            <input type="text" id="deadline1" readonly placeholder="DD-MMM-YYYY" />
                                                                            <input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, 'deadline1')" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><input type="text" name="item_static[]"></td>
                                                            <td><button type="button" class="removeRowBtn">Remove</button></td>
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
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
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
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-- General information content -->
                        <div id="CCForm4" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    RCA Results
                                </div>
                                <div class="row">


                                 <div class="col-12">
                                    <div class="group-input">
                                        <label for="root-cause-methodology">Root Cause Methodology</label>
                                        <select name="root_cause_methodology[]" multiple data-search="false" data-silent-initial-value-set="true" id="root-cause-methodology">
                                            <option value="Why-Why Chart">Why-Why Chart</option>
                                            <option value="Failure Mode and Effect Analysis">Failure Mode and Effect Analysis</option>
                                            <option value="Fishbone or Ishikawa Diagram">Fishbone or Ishikawa Diagram</option>
                                            <option value="Is/Is Not Analysis">Is/Is Not Analysis</option>
                                        </select>
                                    </div>
                                </div>
                                   
                                
                                     <div class="col-12 mb-4 "id="fmea-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="agenda">
                                                Failure Mode and Effect Analysis<button type="button" name="agenda"
                                                    onclick="addRiskAssessmentdata('risk-assessment-risk-management')">+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" style="width: 200%"
                                                    id="risk-assessment-risk-management">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
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
                                    <div class="col-12 sub-head"></div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="root_cause_description">Root Cause Description</label>
                                            <textarea name="root_cause_description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Investigation Summary</label>
                                            <textarea name="investigation_summary"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head">
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
</div>

<div class="col-lg-12">
    <div class="group-input">
        <label for="">Risk Level</label>
        <input type="text" name="risk_level" id="riskLevel" readonly>
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
                                            <select name="residual_risk_probability" id="analysisP2" onchange='calculateRiskAnalysis2(this)'>
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
                                            <select name="detection2" id="analysisN2" onchange='calculateRiskAnalysis2(this)'>
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
                                            <input type="text" name="rpn2" id="analysisRPN2" value="" readonly>
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
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm6" class="inner-block cctabcontent">
                            <div class="inner-block-content">
<div class="container-fluid">
        <div class="col-12">
            <div class="group-input">
                <label for="mitigation_plan_details">
                    Mitigation Plan Details <button type="button" name="ann" id="action_plan2" onclick="addMitigationPlan('action_plan_details02')">+</button>
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
                                <td><input type="text" name="serial_number[]" value="1" disabled></td>
                                <td><input type="text" name="mitigation_steps[]"></td>
                                <td>
                                    <div class="group-input new-date-data-field mb-0">
                                        <div class="input-date">
                                            <div class="calenderauditee">
                                                <input type="text" id="deadline2_1" readonly placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="deadline2[]" class="hide-input" oninput="handleDateInput(this, 'deadline2_1')" />
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
                                            <select name="mitigation_required"   onchange="otherController(this.value, 'yes', 'initiated_through_req')" >
                                                <option value="">Select Mitigation </option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input" id="initiated_through_req">
                                            <label for="mitigation-plan">Mitigation Plan<span class="text-danger d-none">*</span></label>
                                            <textarea  name="mitigation_plan"></textarea>
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
                                            <select multiple id="reference_record" name="refrence_record[]" >
                                                <option value="">--Select---</option>
                                                @foreach ($old_record as $new)
                                                    <option value="{{ $new->id }}">
                                                        {{ Helpers::getDivisionName($new->division_id) }}/RA/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
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
                                            <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                            <textarea name="due_date_extension"></textarea>
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

                        <!-- Signatures content -->
                        <div id="CCForm7" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Submitted By..">Submitted By..</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Submitted On">Submitted On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Evaluated By">Evaluated By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Evaluated On">Evaluated On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Plan Approved By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Plan Approved On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Risk Analysis Completed By">Risk Analysis Completed By</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Risk Analysis Completed On">Risk Analysis Completed On</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit">Submit</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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
                ele: '#Facility, #Group, #Audit, #Auditee, #root-cause-methodology,#training_require, #reference_record, #related_record, #Initial_attachment'
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
            $('#rchars').text(textlen);});
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
        cell3.innerHTML = '<select id="select-state" placeholder="Select..." name="responsible[]"><option value="">Select a value</option>@foreach ($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>@endforeach</select>';
        cell4.innerHTML = '<div class="group-input new-date-data-field mb-0"><div class="input-date"><div class="calenderauditee"><input type="text" id="deadline' + serialNumber + '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, \'deadline' + serialNumber + '\')" /></div></div></div>';
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
            removeButtons[i].onclick = function () {
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
        var options = { year: 'numeric', month: 'short', day: 'numeric' };
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

@endsection
