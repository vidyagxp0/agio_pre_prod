@extends('frontend.layout.main')
@section('container')
@php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
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
      <!-- <script>
        $(document).ready(function() {
            $('#material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="material_name[]"></td>' +
                        '<td><input type="text" name="material_batch_no[]"></td>' +
                       
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_mfg_date[]" id="material_mfg_date' + serialNumber +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `material_mfg_date' + serialNumber +'`);checkDate(`material_mfg_date1' + serialNumber +'_checkdate`,`material_expiry_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                        
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_expiry_date[]" id="material_expiry_date'+ serialNumber +'_checkdate" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' + serialNumber +'`);checkDate(`material_mfg_date' + serialNumber +'_checkdate`,`material_expiry_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +
                        
                        '<td><input type="text" name="material_batch_desposition[]"></td>' +
                        '<td><input type="text" name="material_remark[]"></td>' +
                        '<td><select name="material_batch_status[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                      
                     
                        '</tr>';

                    return html;
                }

                var tableBody = $('#material tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script> -->

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / CAPA
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Project/Study</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Additional Information</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Comments</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CAPA Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Activity Log</button>
            </div>

            <form action="{{ route('capastore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Record Number</label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/CAPA/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Site/Location Code</label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="due-date">Due Date<span class="text-danger">*</span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due"> Due Date</label>
                                         <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiator Group</label>
                                        <select name="initiator_Group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('initiator_Group') == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('initiator_Group') == 'CQA') selected @endif>Central
                                                Quality Control</option>
                                            <option value="CQC" @if (old('initiator_Group') == 'CQC') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('initiator_Group') == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if (old('initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('initiator_Group') == 'CL') selected @endif>
                                                Central
                                                Laboratory</option>
                                            <option value="TT" @if (old('initiator_Group') == 'TT') selected @endif>Tech
                                                Team</option>
                                            <option value="QA" @if (old('initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" >
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description"></textarea>
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
                                    <p id="docnameError" style="color:red">**Short Description is required</p>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level_form">
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
                                            <option value="internal_audit">Internal Audit</option>
                                            <option value="external_audit">External Audit</option>
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
                                            onchange="otherController(this.value, 'Yes', 'repeat_nature')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="NA">NA</option>
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
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Problem Description">Problem Description</label>
                                        <textarea name="problem_description"></textarea>
                                    </div>
                                </div>
                                                      {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Team">CAPA Team</label>
                                        <select multiple id="select-state" placeholder="Select..." name="capa_team[]">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Team">CAPA Team</label>
                                        <select multiple name="capa_team[]" placeholder="Select CAPA Team"
                                            data-search="false" data-silent-initial-value-set="true" id="Audit">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CAPA Related Records">CAPA Related Records</label>
                                        <div class="related-record-block">
                                            <select  multiple id="capa_related_record" name="capa_related_record[]" id="">

                                                @foreach ($old_record as $new)
                                                    <option value="{{ $new->id }}"  >
                                                        {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Reference Records">Reference Records</label>
                               <select multiple id="capa_related_record" name="capa_related_record[]" id="">
                             <option value="">--Select---</option>
                                            @foreach ($old_record as $new)
                                                <option value="{{ $new->id }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <div class="related-record-block">
                                            <input type="text" name="capa_related_record">
                                            <div data-bs-toggle="modal" data-bs-target="#related-records-modal">
                                                Add
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Initial Observation">Initial Observation</label>
                                        <textarea name="initial_observation"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Interim Containnment">Interim Containnment</label>
                                        <select name="interim_containnment"
                                            onchange="otherController(this.value, 'required', 'containment_comments')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="required">Required</option>
                                            <option value="not-required">Not Required</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="containment_comments">
                                        <label for="Containment Comments">
                                            Containment Comments <span class="text-danger d-none">*</span>
                                        </label>
                                        <textarea name="containment_comments" id="containment_comments"></textarea>
                                    </div>
                                </div>
                              
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input multiple type="file" id="myfile" name="capa_attachment[]"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="capa_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="capa_attachment[]"
                                                    oninput="addMultipleFiles(this, 'capa_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments"> CAPA QA Comments </label>
                                        <textarea name="capa_qa_comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <!-- Product Information content -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12 sub-head">
                                    Product Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Product Details">
                                            Product Details<button type="button" name="ann"
                                                id="product">+</button>
                                        </label>
                                        <table class="table table-bordered" id="product_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No./Lot No./AR No.</th>
                                                    <th>Manufacturing Date</th>
                                                    <th>Date Of Expiry</th>
                                                    <th>Batch Disposition Decision</th>
                                                    <th>Remark</th>
                                                    <th>Batch Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            {{-- <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td> <select name="product_name[]" id="product_name">
                                                        <option value="">-- Select value --</option>
                                                        <option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">
                                                            PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/
                                                        </option>
                                                        <option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">
                                                            BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION
                                                        </option>
                                                        <option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">
                                                            CAFFEINECITRATEORALSOLUTION USP 60MG/3ML
                                                        </option>
                                                        <option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE
                                                            TART. OPH SOL 0.1%W/V (CB)
                                                        </option>
                                                        <option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">
                                                            DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO
                                                        </option>
                                                    </select></td>
                                                <td>
                                                    <select name="product_batch_no[]" id="batch_no">
                                                        <option value="">select value</option>
                                                        <option value="DCAU0030">DCAU0030</option>
                                                        <option value="BDZH0007">BDZH0007</option>
                                                        <option value="BDZH0006">BDZH0006</option>
                                                        <option value="BJJH0004A">BJJH0004A</option>
                                                        <option value="DCAU0036">DCAU0036</option>
                                                    </select>
                                                </td>
                                                <!-- <td><input type="date" name="product_mfg_date[]"></td>
                                                <td><input type="date" name="product_expiry_date[]"></td> -->
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"  class="test" id="material_mfg_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date"   id="material_mfg_date_checkdate" name="material_mfg_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"class="hide-input" 
                                                                oninput="handleDateInput(this, `material_mfg_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> 
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div  class="calenderauditee">
                                                                <input type="text"  class="test" id="material_expiry_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date" id="material_expiry_date_checkdate"name="material_expiry_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                                 oninput="handleDateInput(this, `material_expiry_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="product_batch_desposition[]"></td>
                                                <td><input type="text" name="product_remark[]"></td>
                                                <td>
                                                    <select name="product_batch_status[]" id="">
                                                        <option value="">-- Select value --</option>
                                                        <option value="Hold">Hold</option>
                                                        <option value="Release">Release</option>
                                                        <option value="Quarantine">Quarantine</option>
                                                    </select>
                                                </td>
                                            </tbody> --}}
                                        </table>
                                    </div>
                                {{-- </div> --}}
                                <div class="col-12 sub-head">
                                    Material Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Material Details">
                                            Material Details<button type="button" name="ann"
                                                id="material">+</button>
                                        </label>
                                        <table class="table table-bordered" id="material_details" >
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Material Name</th>
                                                    <th>Batch No./Lot No./AR No.</th>
                                                    <th>Manufacturing Date</th>
                                                    <th>Date Of Expiry</th>
                                                    <th>Batch Disposition Decision</th>
                                                    <th>Remark</th>
                                                    <th>Batch Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            {{-- <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td> <select name="material_name[]" id="material_name">
                                                        <option value="">-- Select value --</option>
                                                        <option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">
                                                            PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/
                                                        </option>
                                                        <option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">
                                                            BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION
                                                        </option>
                                                        <option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">
                                                            CAFFEINECITRATEORALSOLUTION USP 60MG/3ML
                                                        </option>
                                                        <option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE
                                                            TART. OPH SOL 0.1%W/V (CB)
                                                        </option>
                                                        <option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">
                                                            DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO
                                                        </option>
                                                    </select></td>
                                                <td>
                                                    <select name="material_batch_no[]" id="batch_no">
                                                        <option value="">select value</option>
                                                        <option value="DCAU0030">DCAU0030</option>
                                                        <option value="BDZH0007">BDZH0007</option>
                                                        <option value="BDZH0006">BDZH0006</option>
                                                        <option value="BJJH0004A">BJJH0004A</option>
                                                        <option value="DCAU0036">DCAU0036</option>
                                                    </select>
                                                </td>
                                                <!-- <td><input type="date" name="material_mfg_date[]"></td>
                                                <td><input type="date" name="material_expiry_date[]"></td> -->
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"  class="test" id="material_mfg_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date"   id="material_mfg_date_checkdate" name="material_mfg_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"class="hide-input" 
                                                                oninput="handleDateInput(this, `material_mfg_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> 
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div  class="calenderauditee">
                                                                <input type="text"  class="test" id="material_expiry_date" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date" id="material_expiry_date_checkdate"name="material_expiry_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                                 oninput="handleDateInput(this, `material_expiry_date`);checkDate('material_mfg_date_checkdate','material_expiry_date_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td><input type="text" name="material_batch_desposition[]"></td>
                                                <td><input type="text" name="material_remark[]"></td>
                                                <td>
                                                    <select name="material_batch_status[]" id="batch_status">
                                                        <option value="">-- Select value --</option>
                                                        <option value="Hold">Hold</option>
                                                        <option value="Release">Release</option>
                                                        <option value="quarantine">Quarantine</option>
                                                    </select>
                                                </td>
                                            </tbody> --}}
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Equipment/Instruments Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Material Details">
                                            Equipment/Instruments Details<button type="button" name="ann"
                                                id="equipment">+</button>
                                        </label>
                                        <table class="table table-bordered" id="equipment_details">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Equipment/Instruments Name</th>
                                                    <th>Equipment/Instruments ID</th>
                                                    <th>Equipment/Instruments Comments</th>
                                                </tr>
                                            </thead>
                                            

                                            
                                         <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="equipment[]"></td>
                                                <td><input type="text" name="equipment_instruments[]"></td>
                                                <td><input type="text" name="equipment_comments[]"></td>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Other type CAPA Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Details">Details</label>
                                        <input type="text" name="details_new">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments"> CAPA QA Comments </label>
                                        <textarea name="capa_qa_comments2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Project Study content****************************** -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project Datails Application">Project Datails Application</label>
                                        <select name="project_details_application">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Protocol/Study Number">Initiator Group</label>
                                        <select name="project_initiator_group">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Site Number">Site Number</label>
                                        <input type="text" name="site_number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Subject Number">Subject Number</label>
                                        <input type="text" name="subject_number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Subject Initials">Subject Initials</label>
                                        <input type="text" name="subject_initials">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Sponsor">Sponsor</label>
                                        <input type="text" name="sponsor">
                                    </div>
                                </div>
                                 <div class="col-12">
                                    <div class="group-input">
                                        <label for="General Deviation">General Deviation</label>
                                        <textarea name="general_deviation"></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- CAPA Details content ****************************-->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="search">
                                            CAPA Type<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="capa_type">
                                            <option value="">Select a value</option>
                                            <option value="Corrective Action">Corrective Action</option>
                                            <option value="Preventive Action">Preventive Action</option>
                                            <option value="Corrective & Preventive Action">Corrective & Preventive Action
                                            </option>
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective Action</label>
                                        <textarea name="corrective_action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <textarea name="preventive_action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supervisor Review Comments">Supervisor Review Comments</label>
                                        <textarea name="supervisor_review_comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
                      <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                CFT Information
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">CFT Reviewer</label>
                                        <select name="Microbiology_new">
                                            <option value="0">-- Select --</option>
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Person</label>
                                        <select  name="Microbiology_Person[]" placeholder="Select CFT Reviewers"
                                            data-search="false" data-silent-initial-value-set="true" id="cft_reviewer">
                                            <option value="0">-- Select --</option>
                                            @foreach ($cft as $data)
                                                <option value="{{ $data->id}}" selected>{{ $data->name}}</option>
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
                                        <select name="Production_new">
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
                                        <label for="Additional Attachments">Additional Attachments</label>
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
                                {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div> 
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                CFT Feedback
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">CFT Comments</label>
                                        <textarea name="cft_comments_form"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">CFT Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="cft_attchament_new"> </div>
                                                                                        
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="cft_attchament_new[]"
                                                    oninput="addMultipleFiles(this, 'cft_attchament_new')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="sub-head">
                                    Concerned Group Feedback
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">QA Comments</label>
                                        <textarea name="qa_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">QA Head Designee Comments</label>
                                        <textarea name="designee_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Warehouse Comments</label>
                                        <textarea name="Warehouse_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Engineering Comments</label>
                                        <textarea name="Engineering_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Instrumentation Comments</label>
                                        <textarea name="Instrumentation_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Validation Comments</label>
                                        <textarea name="Validation_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Others Comments</label>
                                        <textarea name="Others_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="comments">Group Comments</label>
                                        <textarea name="Group_comments_new"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="group-attachments">Group Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="group_attachments_new"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="group_attachments_new[]"
                                                    oninput="addMultipleFiles(this, 'group_attachments_new')" multiple>
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
                    <!-- CAPA Closure content -->
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review & Closure">QA Review & Closure</label>
                                        <textarea name="qa_review"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Closure Attachments">Closure Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closure_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="closure_attachment[]"
                                                    oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12 sub-head">
                                    Effectiveness Check Details
                                </div> -->
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness Check Required">Effectiveness Check
                                            Required?</label>
                                        <select name="effect_check" onChange="setCurrentDate(this.value)">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                                        {{-- <input type="date" name="effect_check_date"> --}}
                                        <div class="calenderauditee">
                                            <input type="text" name="effect_check_date" id="effect_check_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="effect_check_date" class="hide-input"
                                                oninput="handleDateInput(this, 'effect_check_date')" />
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Effectiveness_checker">Effectiveness Checker</label>
                                        <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                                            <option value="">Select a person</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="effective_check_plan">Effectiveness Check Plan</label>
                                        <textarea name="effective_check_plan"></textarea>
                                    </div>
                                </div> -->
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
                                <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button> -->
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log content -->
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Plan Proposed By">Plan Proposed By</label>
                                        <input type="hidden" name="plan_proposed_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Plan Proposed On">Plan Proposed On</label>
                                        <input type="hidden" name="plan_proposed_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Plan Approved By">Plan Approved By</label>
                                        <input type="hidden" name="Plan_approved_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Plan Approved On">Plan Approved On</label>
                                        <input type="hidden" name="Plan_approved_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA More Info Required By">QA More Info Required By</label>
                                        <input type="hidden" name="qa_more_info_required_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA More Info Required On">QA More Info Required On</label>
                                        <input type="hidden" name="qa_more_info_required_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancelled By</label>
                                        <input type="hidden" name="cancelled_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancelled On</label>
                                        <input type="hidden" name="cancelled_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed By">Completed By</label>
                                        <input type="hidden" name="completed_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed On">Completed On</label>
                                        <input type="hidden" name="completed_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved By">Approved By</label>
                                        <input type="hidden" name="approved_by">

                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved On">Approved On</label>
                                        <input type="hidden" name="approved_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Rejected By">Rejected By</label>
                                        <input type="hidden" name="rejected_by">
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Rejected On">Rejected On</label>
                                        <input type="hidden" name="rejected_on">
                                        <div class="static"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <!-- <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                                <button type="submit">Submit</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" href="#"> Exit </a> </button>
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
            ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
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
        
        function setCurrentDate(item){
            if(item == 'yes'){
                $('#effect_check_date').val('{{ date('d-M-Y')}}');
            }
            else{
                $('#effect_check_date').val('');
            }
        }
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>
@endsection
