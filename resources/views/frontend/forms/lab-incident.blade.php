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

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Lab Incident
        </div>
    </div>



    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Immediate Actions</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Extension</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Incident Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QA Head/Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">System Suitability Failure Inicidence</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
                
            </div>

            <form action="{{ route('labIncidentCreate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('Y') }}/{{ $record_number }}">
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
                                        <!-- {{-- <div class="static">{{ date('d-M-Y') }}</div> --}} -->
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
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due"> Due Date</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY"/>
                                            <input type="date" name="due_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')"  />
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
                                            <option value="CQC" @if(old('Initiator_Group') =="MANU") selected @endif>Manufacturing</option>
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
                                        <input type="text" name="initiator_group_code" id="initiator_group_code" value="" readonly>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_desc" maxlength="255" required>
                                    </div>
                                </div>  

                             
                            

                      
                            <!----------------------------------------------------------new table-------------------------------------------------------------------------->
                            
                        
                        <div class="col-12">
                            <div class="group-input" id="IncidentRow">
                                <label for="audit-incident-grid">
                                    Incident Investigation Report 
                                    <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                
                                <table class="table table-bordered" id="onservation-incident-table">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name of Product</th>
                                            <th>B No./A.R. No.</th>
                                            <th>Remarks</th>
                                            {{-- <th>Action</th> --}}
    
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $serialNumber = 1;
                                    @endphp
                                              {{-- @foreach ($report->data as  $item) --}}
                                                    <tr>
                                              <td> {{ $serialNumber++ }} </td>

                                            {{-- <td style="width: 6%"><input type="text" name="investrecord[0][s_no]" value="">
                                              </td>
                                            --}}
                                              <td><input type="text" name="investrecord[0][name_of_product]" value="">
                                               </td>                                           
                                            <td><input type="text" name="investrecord[0][batch_no]" value=""></td>
                                             <td><input type="text" name="investrecord[0][remarks]" value="" ></td>
                                             
    
                                        </tr>
                                       {{-- @endforeach --}}
                                     </tbody>
                                </table>
                            </div>
                            </div>
    
    
    
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectField = document.getElementById('Facility_Equipment');
                        var inputsToToggle = [];
    
                        // Add elements with class 'facility-name' to inputsToToggle
                        var facilityNameInputs = document.getElementsByClassName('facility-name');
                        for (var i = 0; i < facilityNameInputs.length; i++) {
                            inputsToToggle.push(facilityNameInputs[i]);
                        }
    
                        // Add elements with class 'id-number' to inputsToToggle
                        var idNumberInputs = document.getElementsByClassName('id-number');
                        for (var j = 0; j < idNumberInputs.length; j++) {
                            inputsToToggle.push(idNumberInputs[j]);
                        }
    
                        // Add elements with class 'remarks' to inputsToToggle
                        var remarksInputs = document.getElementsByClassName('remarks');
                        for (var k = 0; k < remarksInputs.length; k++) {
                            inputsToToggle.push(remarksInputs[k]);
                        }
    
    
                        selectField.addEventListener('change', function() {
                            var isRequired = this.value === 'yes';
                            console.log(this.value, isRequired, 'value');
    
                            inputsToToggle.forEach(function(input) {
                                input.required = isRequired;
                                console.log(input.required, isRequired, 'input req');
                            });
    
                            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                            // Show or hide the asterisk icon based on the selected value
                            var asteriskIcon = document.getElementById('asteriskInvi');
                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                        });
                    });
                </script>
    
    
    <script>
        $(document).ready(function() {
            let investdetails = 1;
            $('#IncidentAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
    
                    var html =
                        '<tr>' +
                        '<td><input  type="text" name="investrecord[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][name_of_product]" value=""></td/>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][batch_no]" value=""></td>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][remarks]" value=""></td>' +
                        // '<td><button class="removeRowBtn">Remove</button></td>' +
    
    
                        '</tr>';
    
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
    
                    html += '</select></td>' +
    
                        '</tr>';
                        investdetails++;
    
                    return html;
                }
    
                var tableBody = $('#onservation-incident-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
        </script>
    
    
    
    
    

                            <!-------------------------------incident grid----------------->
                                 
                                {{-- New Added --}}
                                <div class="col-lg-12">
                                    <div class="group-input" id="incident_involved_others_gi">
                                        <label for="incident_involved_others_gi">Instrument Involved<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="incident_involved_others_gi"></textarea>
                                    </div>

                                </div>

                                
                                <div class="col-lg-4">
                                    <div class="group-input" id="stage_stage_gi">
                                        <label for="stage_stage_gi">Stage<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="stage_stage_gi">
                                    </div>

                                </div><br>
                                <div class="col-lg-4">
                                    <div class="group-input" id="incident_stability_cond_gi">
                                        <label for="incident_stability_cond_gi">Stability Condition (If Applicable)<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_stability_cond_gi">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" id="incident_interval_others_gi">
                                        <label for="incident_interval_others_gi">Interval (If Applicable)<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_interval_others_gi">
                                    </div>

                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input" id="test_gi">
                                        <label for="test_gi">Test<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="test_gi">
                                    </div>

                                </div>

                                 
                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_date_analysis_gi">
                                        <label for="Incident_date_analysis">Date Of Analysis<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="incident_date_analysis_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_specification_no_gi">
                                        <label for="Incident_specification_no">Specification Number<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_specification_no_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_stp_no_gi">
                                        <label for="incident_stp_no_gi">STP Number<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_stp_no_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="Incident_name_analyst_no_gi">
                                        <label for="Incident_name_analyst_no">Name Of Analyst<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="Incident_name_analyst_no_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_date_incidence_gi">
                                        <label for="Incident_date_incidence">Date Of Incidence<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="incident_date_incidence_gi">
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" id="description_incidence_gi">
                                        <label for="Description_incidence"> Description Of Incidence<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="description_incidence_gi"></textarea>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="analyst_sign_date_gi">
                                        <label for="analyst_sign_date">Analyst Sign Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="analyst_sign_date_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="section_sign_date_gi">
                                        <label for="section_sign_date">Section Head Sign Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="section_sign_date_gi">
                                    </div>

                                </div>
                                {{-- New Added --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level2">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="If Other">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                {{-- <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="initiated_if_other">{{$data->initiated_if_other}}</textarea> --}}
                                            </div>
                                        </div> -->
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date of Occurance">Date of Occurance</label>
                                        <input type="date" name="occurance_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="
                                        ">Due Date</label>
                                        <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <div class="static"> {{ $due_date }}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned to</label>
                                        <select name="assigend">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Incident Category">Incident Category</label>
                                        <select name="Incident_Category">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Biological">Biological</option>
                                            <option value="Chemical">Chemical</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="Incident_Category_others">
                                        <label for="Incident_Category">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="Incident_Category_others"></textarea>
                                    </div>
                                </div>
                                 <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Invocation Type">Invocation Type</label>
                                        <select name="Invocation_Type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Incident Investigation Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_gi"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_gi" name="attachments_gi[]"
                                                    oninput="addMultipleFiles(this, 'attachments_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Immediate Action -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Immediate_action">Immediate Action</label>
                                        <textarea name="immediate_action_ia"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input" id="immediate_date_ia">
                                        <label for="immediate_date_ia">Analyst Sign/Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="immediate_date_ia">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="section_date_ia">
                                        <label for="section_date_ia">Section Head Sign/Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="section_date_ia">
                                    </div>
                                </div>
                               <div class="col-12">
                                <div class="group-input">
                                    <label for="detail investigation ">Detail Investigation / Probable Root Cause</label>
                                <textarea name="details_investigation_ia"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="proposed corrective action ">Proposed Corrective Action/Corrective Action Taken</label>
                            <textarea name="proposed_correctivei_ia"></textarea>
                        </div>
                     </div>
                
                    
                     <div class="col-12">
                        <div class="group-input">
                            <label for="Repeat Analysis Plan ">Repeat Analysis Plan</label>
                        <textarea name="repeat_analysis_plan_ia"></textarea>
                      </div>
                         </div>


                          
                <div class="col-12">
                    <div class="group-input">
                        <label for="Result Of Repeat Analysis ">Result Of Repeat Analysis</label>
                    <textarea name="result_of_repeat_analysis_ia"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Corrective and Preventive Action">Corrective and Preventive Action</label>
                <textarea name="corrective_and_preventive_action_ia"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="group-input">
                <label for="CAPA Number">CAPA Number</label>
            <input type="text" name="capa_number_im">
        </div>
         </div>

         <div class="col-12">
            <div class="group-input">
                <label for="Investigation Summary">Investigation Summary</label>
            <textarea name="investigation_summary_ia"></textarea>
        </div>
    </div>



    {{-- type of incidence --}}

    <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type Of Incidence</b></label>
            <select name="type_incidence_ia" id="initiator_group">
                <option value="0">-- Select --</option>
                <option value="Analyst Error">Analyst Error</option>
                <option value="Instrument Error">Instrument Error</option>
                <option value="Atypical Error">Atypical Error</option>
              
            </select>
        </div>
    </div>
    {{-- type of incidence --}}

    
                {{-- selection field --}}
                
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            Investigator (QC) <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="investigator_qc_im">
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
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Review <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="investigator_qcr_im">
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
                {{-- <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            QC Approved By <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="investigator_approve_im">
                            <option value="">Select a value</option>
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}
                {{-- selection field --}}
                

                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_ia"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_ia" name="attachments_ia[]"
                                                    oninput="addMultipleFiles(this, 'attachments_ia')" multiple>
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
                    

                  
                    {{-- extension --}}
                    <div id="CCForm3" class="inner-block cctabcontent">
                       <div class="inner-block-content">
                        <div class="row">
                            <div class="group-input">
                                <div class="col-12 sub-head">
                                    First Extension
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Incident Details">Reason For Extension</label>
                                    <textarea name="reasoon_for_extension_e"></textarea>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                <label for="extension date">Extension Date (if required)</label>
                                <input type="date" name="extension_date_esc" id="extension_date">
                                </div>
                            </div>
                               
                            <div class="col-6">
                                <div class="group-input">
                                <label for="extension date">Extension Initiator Date</label>
                                <input type="date" name="extension_date_initiator" id="extension_date">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="search">
                                    Extension HOD <span class="text-danger"></span>
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
                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                    Extension Approved By<span class="text-danger"></span>
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
                            </div> --}}

                            


                          </div>
                          <div class="row">
                               <div class="group-input">
                                     <div class="col-12 sub-head">
                                   Second Extension
                                   </div>
                               </div>
                             <div class="col-12">
                                 <div class="group-input">
                                <label for="reason for extension sc">Reason For Extension</label>
                                <textarea name="reasoon_for_extension_esc"></textarea>
                                </div>
                             </div>

                          
                             <div class="col-6">
                                <div class="group-input">
                                 <label for="extension date">Extension Date (if required)</label>
                                  <input type="date" name="extension_date_e" id="extension_date__sc">
                                </div>
                             </div>
                           
                                <div class="col-6">
                                    <div class="group-input">
                                    <label for="extension date">Extension Initiator Date</label>
                                    <input type="date" name="extension_date_idsc" id="extension_date_idsc">
                                    </div>
                                </div>


                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="search">
                                            Extension HOD <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to">
                                                <option value="0">Select a value</option>
                                                @foreach ($users as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('assign_to')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                    </div>
                                     </div>
                                    {{-- <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                            Extension Approved By<span class="text-danger"></span>
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
                                    </div> --}}
                          </div>

                          {{-- third section --}}

                          <div class="row">
                            <div class="group-input">
                                  <div class="col-12 sub-head">
                                Third Extension
                                </div>
                            </div>
                          <div class="col-12">
                              <div class="group-input">
                             <label for="reason for extension tc">Reason For Extension</label>
                             <textarea name="reasoon_for_extension_tc"></textarea>
                             </div>
                          </div>

                       
                          <div class="col-6">
                             <div class="group-input">
                              <label for="extension date">Extension Date (if required)</label>
                               <input type="date" name="extension_date__tc" id="extension_date__tc">
                             </div>
                          </div>
                        
                             <div class="col-6">
                                 <div class="group-input">
                                 <label for="extension date">Extension Initiator Date</label>
                                 <input type="date" name="extension_date_idtc" id="extension_date_idtc">
                                 </div>
                             </div>


                                 <div class="col-md-6">
                                     <div class="group-input">
                                         <label for="search">
                                        Extension Approved By QA <span class="text-danger"></span>
                                         </label>
                                         <select id="select-state" placeholder="Select..." name="assign_to">
                                             <option value="0">Select a value</option>
                                             @foreach ($users as $data)
                                                 <option value="{{ $data->id }}">{{ $data->name }}</option>
                                             @endforeach
                                         </select>
                                         @error('assign_to')
                                             <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                 </div>
                                  </div>
                                 <div class="col-md-6">
                                     <div class="group-input">
                                         <label for="search">
                                         Extension Approved By CQA<span class="text-danger"></span>
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
                       </div>
                       <div class="col-12">
                        <div class="group-input">
                            <label for="Attachments">Extension Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="extension_attachments_e"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="extension_attachments_e[]"
                                        oninput="addMultipleFiles(this, 'extension_attachments_e')" multiple>
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
                    
                    
                    
                      <!-- Incident Details content -->
                      <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Details">Incident Details</label>
                                        <textarea name="Incident_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Document Details ">Document Details</label>
                                        <textarea name="Document_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Instrument Details">Instrument Details</label>
                                        <textarea name="Instrument_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Involved Personnel">Involved Personnel</label>
                                        <textarea name="Involved_Personnel"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Product Details,If Any">Product Details,If Any</label>
                                        <textarea name="Product_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supervisor Review Comments">Supervisor Review Comments</label>
                                        <textarea name="Supervisor_Review_Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ccf_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="ccf_attachments[]"
                                                    oninput="addMultipleFiles(this, 'ccf_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 sub-head">
                                    Cancelation
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Cancelation Remarks">Cancelation Remarks</label>
                                        <textarea name="Cancelation_Remarks"></textarea>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <!-- Investigation Details content -->
                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12 sub-head">
                                    Questionnaire
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="INV Questionnaire">INV Questionnaire</label>
                                        <div class="static">Question datafield</div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Inv Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Inv_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Inv_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Inv_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Inv_Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigation Details ">Investigation Details</label>
                                        <textarea name="Investigation_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Action Taken">Action Taken</label>
                                        <textarea name="Action_Taken"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <textarea name="Root_Cause"></textarea>
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
                    

                    <!-- CAPA content -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Currective Action">Corrective Action</label>
                                        <textarea name="Currective_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <textarea name="Preventive_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                        <textarea name="Corrective_Preventive_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="CAPA_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="CAPA_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="CAPA_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'CAPA_Attachment')" multiple>
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

                    <!-- QA Review content -->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review Comments">QA Review Comments</label>
                                        <textarea name="QA_Review_Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QA Head Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Head_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_Head_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_Head_Attachment')" multiple>
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

                    <!-- QA Head/Designee Approval content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12 sub-head">
                                    Closure
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head/Designee Comments">QA Head/Designee Comments</label>
                                        <textarea name="QA_Head"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effectiveness Check required?">Effectiveness Check required?</label>
                                        <select name="Effectiveness_Check">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effect.Chesk Creation Date">Effect.Chesk Creation Date</label>
                                        <input type="date" name="effect_check_date">
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Effectiveness Check Creation Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="effectivess_check_creation_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="effectivess_check_creation_date" class="hide-input"
                                                oninput="handleDateInput(this, 'effectivess_check_creation_date')" />
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Type">Incident Type</label>
                                        <select name="Incident_Type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Type A</option>
                                            <option value="2">Type B</option>
                                            <option value="3">Type C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Conclusion">Conclusion</label>
                                        <textarea name="Conclusion"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                        <span id="rchar">240</span> characters remaining
                                        <textarea id="duedoc" name="due_date_extension" type="text" maxlength="240"></textarea>
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

                  <!-- Closure -->
                  
                  <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                            <div class="row">
                                        
                            <!----------------------------------------------------------new table-------------------------------------------------------------------------->
                            
                        {{-- new added table --}}
                        <div class="col-12">
                            <div class="group-input" id="suitabilityRow">
                                <label for="audit-suitability-grid">
                                    System Suitability Failure Incidence
                                    <button type="button" name="audit-suitability-grid" id="ObservationAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                
                                <table class="table table-bordered" id="onservation-field-table">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name of Product</th>
                                            <th>B No./A.R. No.</th>
                                            <th>Remarks</th>
                                            {{-- <th>Action</th> --}}
    
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $suitabilityNumber = 1;
                                        @endphp
                                              {{-- @foreach ($report->data as  $item) --}}
                                                    <tr>
                                            {{-- <td style="width: 6%"><input type="text" name="investigation[0][s_no]" value="">
                                               </td>
                                            --}}
                                            <td>{{ $suitabilityNumber++ }}</td>
                                              <td><input type="text" name="investigation[0][name_of_product_ssfi]" value="">
                                               </td>                                           
                                            <td><input type="text" name="investigation[0][batch_no_ssfi]" value=""></td>
                                             <td><input type="text" name="investigation[0][remarks_ssfi]" value="" ></td>
                                             
    
                                        </tr>
                                       {{-- @endforeach --}}
                                     </tbody>
                                </table>
    
    
                                
                </div>
                            </div>
    
    
    
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectField = document.getElementById('Facility_Equipment');
                        var inputsToToggle = [];
    
                        // Add elements with class 'facility-name' to inputsToToggle
                        var facilityNameInputs = document.getElementsByClassName('facility-name');
                        for (var i = 0; i < facilityNameInputs.length; i++) {
                            inputsToToggle.push(facilityNameInputs[i]);
                        }
    
                        // Add elements with class 'id-number' to inputsToToggle
                        var idNumberInputs = document.getElementsByClassName('id-number');
                        for (var j = 0; j < idNumberInputs.length; j++) {
                            inputsToToggle.push(idNumberInputs[j]);
                        }
    
                        // Add elements with class 'remarks' to inputsToToggle
                        var remarksInputs = document.getElementsByClassName('remarks');
                        for (var k = 0; k < remarksInputs.length; k++) {
                            inputsToToggle.push(remarksInputs[k]);
                        }
    
    
                        selectField.addEventListener('change', function() {
                            var isRequired = this.value === 'yes';
                            console.log(this.value, isRequired, 'value');
    
                            inputsToToggle.forEach(function(input) {
                                input.required = isRequired;
                                console.log(input.required, isRequired, 'input req');
                            });
    
                            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                            // Show or hide the asterisk icon based on the selected value
                            var asteriskIcon = document.getElementById('asteriskInvi');
                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                        });
                    });
    </script>
    
    
    <script>
        $(document).ready(function() {
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
    
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="investigation[0][name_of_product]" value=""></td/>' +
                        '<td><input type="text" name="investigation[0][batch_no]" value=""></td>' +
                        '<td><input type="text" name="investigation[0][remarks]" value=""></td>' +
                        // '<td><button class="removeRowBtn">Remove</button></td>' +
    
    
                        '</tr>';
    
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
    
                    html += '</select></td>' +
    
                        '</tr>';
    
                    return html;
                }
    
                var tableBody = $('#onservation-field-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
        </script>
    
    
    
    
    
                            {{-- new added table --}}
                                <!----------------------------------------------------------new table-------------------------------------------------------------------------->

                      

                                                        {{-- New Added --}}
                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="Incident_invlvolved_others">
                                                                <label for="Incident_Involved">Instrument Involved<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="involved_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>
                        
                                                        
                                                        <div class="col-lg-4">
                                                            <div class="group-input" id="Incident_stage">
                                                                <label for="Incident_stage">Stage<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="stage_stage_ssfi">
                                                            </div>
                        
                                                        </div><br>
                                                        <div class="col-lg-4">
                                                            <div class="group-input" id="Incident_stability_cond">
                                                                <label for="Incident_stability_cond">Stability Condition (If Applicable)<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="Incident_stability_cond_ssfi">
                                                            </div>
                        
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="group-input" id="Incident_interval_others">
                                                                <label for="Incident_interval_others">Interval (If Applicable)<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="Incident_interval_ssfi">
                                                            </div>
                        
                                                        </div>
                                                        
                                                        <div class="col-lg-6">
                                                            <div class="group-input" id="Incident_test_others">
                                                                <label for="Incident_test_others">Test<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="test_ssfi">
                                                            </div>
                        
                                                        </div>
                        
                                                         
                                                        <div class="col-lg-6">
                                                            <div class="group-input" id="Incident_date_analysis">
                                                                <label for="Incident_date_analysis">Date Of Analysis<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="date" name="Incident_date_analysis_ssfi">
                                                            </div>
                        
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="group-input" id="Incident_specification_no">
                                                                <label for="Incident_specification_no">Specification Number<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="Incident_specification_ssfi">
                                                            </div>
                        
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="group-input" id="Incident_stp_no">
                                                                <label for="Incident_stp_no">STP Number<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="text" name="Incident_stp_ssfi">
                                                            </div>
                        
                                                        </div>
                                                        
                                                        <div class="col-lg-4">
                                                            <div class="group-input" id="Incident_date_incidence">
                                                                <label for="Incident_date_incidence">Date Of Incidence<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <input type="date" name="Incident_date_incidence_ssfi">
                                                            </div>
                        
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="group-input">
                                                                <label for="search">
                                                                    QC Reviewer <span class="text-danger"></span>
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
                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="Description_incidence">
                                                                <label for="Description_incidence"> Description Of Incidence<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="Description_incidence_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="Detail_investigation">
                                                                <label for="Detail_investigation"> Detail Investigation<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="Detail_investigation_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="proposed corrective">
                                                                <label for="Detail_investigation"> Proposed Corrective Action<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="proposed_corrective_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="root cause">
                                                                <label for="root_cause"> Root Cause<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="root_cause_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="group-input" id="incident summary ssfi">
                                                                <label for="incident summary ssfi"> Incident Summary<span
                                                                        class="text-danger d-none">*</span></label>
                                                                <textarea name="incident_summary_ssfi"></textarea>
                                                            </div>
                        
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="group-input">
                                                                  <label for="search">
                                                              Investigator(QC) <span class="text-danger"></span>
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

                                                    <div class="col-md-6">
                                                        <div class="group-input">
                                                              <label for="search">
                                                          Reviewed By(QC) <span class="text-danger"></span>
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
                                                <div class="col-lg-12">
                                                    <div class="group-input">
                                                        <label for="system_suitable_attachments">File Attachment</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                                        <div class="file-attachment-field">
                                                            <div class="file-attachment-list" id="system_suitable_attachments"></div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input type="file" id="system_suitable_attachments" name="system_suitable_attachments[]"
                                                                    oninput="addMultipleFiles(this, 'system_suitable_attachments')" multiple>
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

     
                                                        
                                                        
                                                        {{-- New Added --}}
                        </div>
                    </div>
                </div>

                <!-- Closure Tab -->
                <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure_incident">Closure Of Incident</label>
                                        <input type="text" name="closure_incident_c">
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="affected documents closed"><b>Affected Documents Closed</b></label>
                                        <select name="affected_document_closure" id="affected_document_closure">
                                            <option value="0">-- Select --</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="NA">NA</option>
                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="head remark"><b>QC Head Remark</b></label>
                                       <textarea name="qc_hear_remark_c"></textarea>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                          <label for="search">
                                      QC Head <span class="text-danger"></span>
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


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for=" qa head remark"><b>QA Head Remark</b></label>
                                   <textarea name="qa_hear_remark_c"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure_attachments">File Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="closure_attachment_c"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="closure_attachment_c[]"
                                                oninput="addMultipleFiles(this, 'closure_attachment_c')" multiple>
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
                </div>
                    <!-- Activity Log content -->
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted By">Submitted By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted On">Submitted On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Incident Review Completed By">Incident Review Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">Incident Review Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Investigation Completed By">Investigation Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Investigation Completed On">Investigation Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                               <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Review Completed By">QA Review Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Review Completed By">QA Review Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Head Approval Completed By">QA Head Approval Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Head Approval Completed On">QA Head Approval Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div> 
                               
                              
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="All Activities Completed By">All Activities Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="All Activities Completed On">All Activities Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Review Completed By">Review Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Review Completed On">Review Completed On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>  
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Coment">Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancelled By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancelled On</label>
                                        <div class="Date"></div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Comment">Comment</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>                   
                                <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit">Submit</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" href="#"> Exit </a></button>
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
            ele: '#Facility, #Group, #Audit, #Auditee'
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
    document.getElementById('initiator_group').addEventListener('change', function() {
        var selectedValue = this.value;
        document.getElementById('initiator_group_code').value = selectedValue;
    });
</script>
<script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>
    <script>
        var maxLength = 240;
        $('#duedoc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchar').text(textlen);});
    </script>




    
@endsection
