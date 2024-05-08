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
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        / OOC_Out Of Calibration
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#Monitor_Information').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="date" name="date[]"></td>' +
                    ' <td><input type="text" name="Responsible[]"></td>' +
                    '<td><input type="text" name="ItemDescription[]"></td>' +
                    '<td><input type="date" name="SentDate[]"></td>' +
                    '<td><input type="date" name="ReturnDate[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' + 

                //     '</tr>';

                return html;
            }

            var tableBody = $('#Monitor_Information_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Product_Material').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="ProductName[]"></td>' +
                    '<td><input type="number" name="ReBatchNumber[]"></td>' +
                    '<td><input type="date" name="ExpiryDate[]"></td>' +
                    '<td><input type="date" name="ManufacturedDate[]"></td>' +
                    '<td><input type="text" name="Disposition[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' + 

                //     '</tr>';

                return html;
            }

            var tableBody = $('#Product_Material_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#Equipment').click(function(e) {
            function generateTableRow(serialNumber) {


                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="ProductName[]"></td>' +
                    '<td><input type="number" name="BatchNumber[]"></td>' +
                    '<td><input type="date" name="ExpiryDate[]"></td>' +
                    '<td><input type="date" name="ManufacturedDate[]"></td>' +
                    '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                    '<td><input type="text" name="Exist[]"></td>' +
                    '<td><input type="text" name="Comment[]"></td>' +


                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' + 

                //     '</tr>';

                return html;
            }

            var tableBody = $('#Equipment_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>




{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD/Supervisor Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">OOC Evaluation Form</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Stage I</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Stage II</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CAPA</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Closure</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Signature</button>

        </div>

        <form action="{{ route('actionItem.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    <input disabled type="text" name="record_number" value="">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code"><b>Division Code </b></label>
                                    <input disabled type="text" name="division_code" value="">
                                    <input type="hidden" name="division_id" value="">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="originator">Initiator</label>
                                    <input disabled type="text" name="originator_id" value="" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input ">
                                    <label for="Date Due"><b>Date of Initiation</b></label>
                                    <input disabled type="text" value="" name="intiation_date">
                                    <input type="hidden" value="" name="intiation_date">
                                </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <p class="text-primary"> last date this record should be closed by</p>

                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group"><b>Initiator Group</b></label>
                                    <select name="initiator_Group" id="initiator_group">
                                        <option value="">-- Select --</option>
                                        <option value="CQA">
                                            Corporate Quality Assurance</option>
                                        <option value="QAB">Quality
                                            Assurance Biopharma</option>
                                        <option value="CQC">Central
                                            Quality Control</option>
                                        <option value="MANU">
                                            Manufacturing</option>
                                        <option value="PSG">Plasma
                                            Sourcing Group</option>
                                        <option value="CS">Central
                                            Stores</option>
                                        <option value="ITG">
                                            Information Technology Group</option>
                                        <option value="MM">
                                            Molecular Medicine</option>
                                        <option value="CL">
                                            Central Laboratory</option>

                                        <option value="TT">Tech
                                            team</option>
                                        <option value="QA">
                                            Quality Assurance</option>
                                        <option value="QM">
                                            Quality Management</option>
                                        <option value="IA">IT
                                            Administration</option>
                                        <option value="ACC">
                                            Accounting</option>
                                        <option value="LOG">
                                            Logistics</option>
                                        <option value="SM">
                                            Senior Management</option>
                                        <option value="BA">
                                            Business Administration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group Code">Initiator Group Code</label>
                                    <input type="text" name="initiator_group_code" id="initiator_group_code" value="">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Initiated Through</label>
                                    <div><small class="text-primary">Please select related information</small></div>
                                    <select name="initiated_through" onchange="">
                                        <option value="">-- select --</option>
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

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="If Other">If Other</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="initiated_if_other" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Is Repeat</label>
                                    <select name="is_repeat" onchange="">
                                        <option value="">-- select --</option>
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeat Nature">Repeat Nature</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Repeat_Nature" id="summernote-1">

                                    </textarea>
                                </div>
                            </div>



                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Description">Description</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Description" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Initial Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id=""></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="" oninput="" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">OOC Logged by</label>
                                    <select name="is_repeat" onchange="">
                                        <option value="">-- select --</option>
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On"> OOC Logged On </label>

                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="" />
                                    </div>


                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Instrument Details
                                        <button type="button" onclick="add4Input('root-cause-first-table')">+</button>
                                        <span class="text-primary" data-bs-toggle="modal" data-bs-target="#document-details-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="root-cause-first-table">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Instrument Name</th>
                                                    <th>Instrument ID</th>
                                                    <th>Remarks</th>
                                                    <th>Calibration Parameter</th>
                                                    <th>Acceptance Criteria</th>
                                                    <th>Results</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="Instrument_Name[]"></td>
                                                <td><input type="text" name="Instrument_ID[]"></td>
                                                <td><input type="text" name="Remarks[]"></td>
                                                <td><input type="text" name="Calibration_Parameter[]"></td>
                                                <td><input type="text" name="Acceptance_Criteria[]"></td>
                                                <td><input type="text" name="Results[]"></td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-head"> Delay Justfication for Reporting</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Delay Justification for Reporting">Delay Justification for Reporting</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Delay_Justification_for_Reporting" id="summernote-1">
                                    </textarea>
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
                </div>
                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12">HOD/Supervisor Review</div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="HOD Remarks">HOD Remarks</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="HOD_Remarks" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">HOD Attachement</label>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id=""></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="" oninput="" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Immediate Action">Immediate Action</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Immediate_Action" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preliminary Investigation">Preliminary Investigation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea class="summernote" name="Preliminary_Investigation" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>






                            {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
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
            </div>
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">


                        <div class="sub-head">OOC Evaluation Form</div>

                        <div class="col-12">
                            <div class="group-input">
                                <div class="why-why-chart">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Sr.No.</th>
                                                <th style="width: 30%;">Question</th>
                                                <th>Response</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Status of calibration for other instrument(s) used for performing calibration of the referred instrument</td>
                                                <td>
                                                    <textarea name="what_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="what_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of calibration standards used Primary Standard: Physical apperance, validity, certificate. Secondary standard: Physical appearance, validity</td>
                                                <td>
                                                    <textarea name="where_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="where_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of dilution, calculation, weighing, Titer values and readings</td>
                                                <td>
                                                    <textarea name="when_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="when_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of glassware used</td>
                                                <td>
                                                    <textarea name="coverage_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="coverage_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Verification of chromatograms/spectrums/other instrument</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Adequacy of system suitability checks</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Instrument Malfunction</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Check for adherence to the calibration method</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Previous History of instrument</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="background: #DCD8D8">Others</td>
                                                <td>
                                                    <textarea name="who_will_be"></textarea>
                                                </td>
                                                <td>
                                                    <textarea name="who_will_not_be"></textarea>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="qa_comments">Evaluation Remarks</label>
                                <textarea name="qa_comments"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="qa_comments">Description of Cause for OOC Results (If Identified)</label>
                                <textarea name="qa_comments"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Assignable root cause found?</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 sub-head">
                            Hypothesis Study
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Protocol Based Study/Hypothesis Study">Protocol Based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Protocol_Based_Study/Hypothesis_Study" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Justification for Protocol study/ Hypothesis Study">Justification for Protocol study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Justification_for_Protocol_study/Hypothesis_Study" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Plan of Protocol Study/ Hypothesis Study">Plan of Protocol Study/ Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Plan_of_Protocol_Study/Hypothesis_Study" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Conclusion of Protocol based Study/Hypothesis Study">Conclusion of Protocol based Study/Hypothesis Study</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Conclusion_of_Protocol_based_Study/Hypothesis_Study" id="summernote-1">
                                    </textarea>
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
                    <div class="row">
                        <div class="sub-head">Stage I</div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Analyst Remarks">Analyst Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Analyst_Remarks" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Calibration Results">Calibration Results</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Calibration_Results" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Results Naturey</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>




                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Review of Calibration Results of Analyst">Review of Calibration Results of Analyst</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Review_of_Calibration_Results_of_Analyst" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">Stage I Attachement</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Results Criteria">Results Criteria</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Results_Criteria" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initial OOC is Invalidated/Validated</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="group-input">
                                <label for="qa_comments">Additinal Remarks (if any)</label>
                                <textarea name="qa_comments"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Additinal Remarks (if any)">Additinal Remarks (if any)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="Additinal_Remarks" id="summernote-1">
                                    </textarea>
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

            <div id="CCForm5" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Stage II
                    </div>
                    <div class="row">


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Rectification by Service Engineer required</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Instrument is Out of Order</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Proposed By</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">Details of Equipment Rectification</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Compiled by:</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Release of Instrument for usage</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment at Stage II">Impact Assessment at Stage II</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Details of Impact Evaluation">Details of Impact Evaluation</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Result of Reanalysis:</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Cause for failure">Cause for failure</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CAPA Type?</label>
                                <select name="is_repeat" onchange="">
                                    <option value="">-- select --</option>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective Action">Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">Details of Equipment Rectification</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sub-head">
                            Post Implementation of CAPA
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="CAPA Post Implementation Comments">CAPA Post Implementation Comments</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">CAPA Post Implementation Attachement</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>

            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CAPA
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Closure Comments
                                    <input id="docname" type="text" name="short_description">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Inv Attachments">Details of Equipment Rectification</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Document Code
                                    <input id="docname" type="text" name="Document_Code">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Remarks
                                    <input id="docname" type="text" name="Remarks">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Immediate Corrective Action">Immediate Corrective Action</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>
            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        HOD Review
                    </div>
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="HOD Remarks">HOD Remarks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inv Attachments">HOD Attachement</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id=""></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="" oninput="" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Root Cause Analysis">Root Cause Analysis</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Impact Assessment">Impact Assessment</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea class="summernote" name="initiated_through" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>




                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>
            <div id="CCForm9" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="row">



                        <div class="sub-head">
                            Activity Log
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Submit By : </label>

                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Submit On : </label>




                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Review Completed By : </label>

                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">HOD Review Completed On :</label>




                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">QA Initial Review Completed By :</label>

                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">QA Initial Review Completed On : </label>




                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">QA Final Review Completed By : </label>

                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">QA Final Review Completed On : </label>




                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Closure Done By : </label>

                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Closure Done On : </label>




                            </div>
                        </div>





                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
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
        ele: '#related_records, #hod'
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
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection