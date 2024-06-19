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


    <!-- --------------------------------------button--------------------- -->

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

<!-- -----------------------------grid-1----------------------------script -->
    <script>
        $(document).ready(function() {
            $('#Product_Material').click(function(e) {
                let loopIndex= 0 ;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="info_of_product_material['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][item_product_code]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][batch_no]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][mfg_date]"></td>' +
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][expiry_date]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][label_claim]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][pack_size]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][analyst_name]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][others_specify]"></td>'+
                        '<td><input type="text" name="info_of_product_material['+ loopIndex +'][in_process_sample_stage]"></td>'+
                        '<td><select name="info_of_product_material[' + loopIndex + '][packingMaterialType]"><option value="">--Select--</option><option value="Primary">Primary</option><option value="Secondary">Secondary</option><option value="Tertiary">Tertiary</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><select name="info_of_product_material[' + loopIndex + '][stabilityfor]"><option value="">--Select--</option><option vlaue="Submission">Submission</option><option vlaue="Commercial">Commercial</option><option vlaue="Pack Evaluation">Pack Evaluation</option><option vlaue="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                       '</tr>';
                    return html;
                }

                var tableBody = $('#Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

 <!-- --------------------------------grid-2--------------------------script -->

    <script>
        $(document).ready(function() {
            $('#Details_Stability').click(function(e) {
                let loopIndex = 0 ;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +    
                        '<td><input disabled type="text" name="stability_study['+ loopIndex +'][serial_no]" value="'+  serialNumber +'"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][ar_number]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][condition_temperature_rh]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][interval]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][orientation]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][pack_details]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][specification_no]"></td>'+
                        '<td><input type="text" name="stability_study['+ loopIndex +'][sample_description]"></td>'+
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#Details_Stability_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- ------------------------------grid-3-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#OOS_Details').click(function(e) {
                let loopIndex = 0;
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="oos_details['+ loopIndex +'][serial]" value="' + serialNumber +
                            '"></td>'+
                            '<td><input type="text" name="oos_details['+ loopIndex +'][ar_number]"></td>'+
                            '<td><input type="text" name="oos_details['+ loopIndex +'][test_name_of_oos]"></td>'+
                            '<td><input type="text" name="oos_details['+ loopIndex +'][results_obtained]"></td>'+
                            '<td><input type="text" name="oos_details['+ loopIndex +'][specification_limit]"></td>'+
                            '<td><input type="text" name="oos_details['+ loopIndex +'][details_of_obvious_error]"></td>'+
                            '<td><input type="file" name="oos_details['+ loopIndex +'][file_attachment_oos_details]"></td>'+
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#OOS_Details_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->

    <script>
        $(document).ready(function() {
            $('#oos_capa').click(function(e) {
                let loopIndex = 0

                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="info_product_oos_capa['+loopIndex+'][serial]" value="' + serialNumber +
                        '"></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][oos_number]"></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][oos_reported_date]"></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][description_of_oos]"></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][previous_oos_root_cause]"></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][capa]"></td>'+
                        '<td><input type="text" name="info_product_oos_capa['+loopIndex+'][closure_date_of_capa]"></td>'+
                        '<td><select name="info_product_oos_capa['+loopIndex+'][capa_Requirement]"><option  value="yes">Yes</option><option value="no">No</option></select></td>'+
                        ' <td><input type="text" name="info_product_oos_capa['+loopIndex+'][reference_capa_number]"></td>'+
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    return html;
                }

                var tableBody = $('#oos_capa_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


<!-- -----------------------------grid-1----------OOS Conclusion ---------------- -->

    <script>
        $(document).ready(function() {
            $('#oos_conclusion').click(function(e) {
                let loopIndex = 0
                function generateTableRow(serialNumber) {
                    loopIndex++;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oos_conclusion['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'
                        '<td><input type="text" name="oos_conclusion['+ loopIndex +'][analysis_details]"></td>'
                        '<td><input type="text" name="oos_conclusion['+ loopIndex +'][hypo_exp_add_test_pr_no]"></td>'
                        '<td><input type="text" name="oos_conclusion['+ loopIndex +'][results]"></td>'
                        '<td><input type="text" name="oos_conclusion['+ loopIndex +'][analyst_name]"></td>'
                        '<td><input type="text" name="oos_conclusion['+ loopIndex +'][Remarks]"></td>'
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    return html;
                }
                var tableBody = $('#oos_conclusion_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

 <!-- -----------------------------grid-1----------OOSConclusion_Review ---------------- -->

    <script>
        $(document).ready(function() {
            $('#oosconclusion_review').click(function(e) {
                let loopIndex = 0;
                function generateTableRow(serialNumber) {
                    loopIndex++ ;

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oosConclusion_review['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'+
                        '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][material_product_no]"></td>'+
                        '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][batch_no_ar_no]"></td>'+
                        '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][any_other_information]"></td>'+
                        '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][action_taken_on_affecBatch]"></td>'+
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                        return html;
                }

                var tableBody = $('#oosconclusion_review_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>



    <div class="form-field-head">
      
        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / OOS Micro
        </div>
        <!-- <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div> -->
    </div>



    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm18')">Checklist - Investigation of Bacterial
                    Endotoxin Test</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">Checklist - Investigation of
                    Sterility</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Checklist - Investigation of Microbial
                    limit test/Bioburden and Water Test </button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist - Investigation of Microbial
                    assay</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Checklist - Investigation of Environmental
                    Monitoring</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm23')">Checklist - Investigation of MediaSuitability Test</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QC Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS CQ Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Re-Open</button>
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signature</button>--}}

            </div>

            <!-- General Information -->
            <form action="{{ route('oos_micro.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="sub-head">General Information</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Type </label>
                                <select id="dynamicSelectType" name="type">
                                    <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                                    <option value="{{ route('oos.index') }}">OOS Chemical</option>
                                    <option value="{{ route('oot.index')  }}">OOT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Record Number"> Record Number </label>
                                <input disabled type="text" name="record"
                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/OOS Micro /{{ date('Y') }}/{{ $record_number }}">
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label disabled for="Division Code">Division Code<span class="text-danger"></span></label>
                                <input disabled type="text" name="division_code_gi"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                    <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator">Initiator <span class="text-danger"></span></label>
                                <input type="hidden" name="initiator_id" value="{{ Auth::user()->id }}">
                                <input disabled type="text" name="initiator"
                                        value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="group-input ">
                                <label for="intiation-date"> Date Of Initiation<span class="text-danger"></span></label>
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date_gi">
                                <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date_gi">
                    
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Date Due"> Due Date </label>
                                <div><small class="text-primary">If revising Due Date, kindly mention revision
                                        reason in "Due Date Extension Justification" data field.</small></div>
                                <div class="calenderauditee">
                                    <input type="text" id="due_date_gi" readonly placeholder="DD-MM-YYYY" />
                                    <input type="date" name="due_date_gi"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'due_date_gi')" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description">Short Description
                                    <span class="text-danger">*</span></label>
                                    <span id="rchars">255</span>characters remaining
                                <textarea id="docname"  name="description_gi" maxlength="255" required></textarea>
                            </div>
                            @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <p id="docnameError" style="color:red">**Short Description is required</p>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description"> Severity Level</label>
                                <select name="severity_level_gi" >
                                    <option>Enter Your Selection Here</option>
                                    <option  value="Major">Major</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"><b>Initiator Group</b></label>
                                <select name="initiator_group_gi" id="initiator_group">
                                    <option value="">-- Select --</option>
                                    <option value="CQA" @if (old('initiator_Group') == 'CQA') selected @endif>
                                        Corporate Quality Assurance</option>
                                    <option value="QAB" @if (old('initiator_Group') == 'QAB') selected @endif>
                                        Quality
                                        Assurance Biopharma</option>
                                    <option value="CQC" @if (old('initiator_Group') == 'CQA') selected @endif>
                                        Central
                                        Quality Control</option>
                                    <option value="MANU" @if (old('initiator_Group') == 'MANU') selected @endif>
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
                                        Central Laboratory</option>

                                    <option value="TT" @if (old('initiator_Group') == 'TT') selected @endif>Tech
                                        team</option>
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
                                <input type="text" name="initiator_group_code_gi" id="initiator_group_code"
                                    value="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initiated Through ?</label>
                                <select name="initiated_through_gi"
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
                            <div class="group-input">
                                <label for="Initiator Group Code">If Others </label>
                                <textarea name="if_others_gi"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Is Repeat ?</label>
                                <select name="is_repeat_gi"
                                        onchange="otherController(this.value, 'Yes', 'is_repeat_gi')">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="NA">NA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="group-input">
                                <label for="Initiator Group">Repeat Nature</label>
                                <textarea name="repeat_nature_gi"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Nature of Change</label>
                                <select name="nature_of_change_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="permanent">Permanent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="due-date">Deviation Occured On</label>
                                <div class="calenderauditee">                                    
                                    <input type="text"  id="deviation_occured_on_gi" readonly placeholder="DD-MM-YYYY" />
                                    <input type="date" name="deviation_occured_on_gi"    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                    class="hide-input"
                                    oninput="handleDateInput(this, 'deviation_occured_on_gi')"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">Initial Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="initial_attachment_gi"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="initial_attachment_gi[]"
                                            oninput="addMultipleFiles(this, 'initial_attachment_gi')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Source Document Type</label>
                                <select name="source_document_type_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option value="oot">OOT</option>
                                    <option value="lab-incident">Lab Incident</option>
                                    <option value="deviation">Deviation</option>
                                    <option value="product-non-conformance">Product Non-conformance</option>
                                    <option value="inspectional-observation">Inspectional Observation</option>
                                    <option value="other">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference System Document</label>
                                <select multiple id="reference_record" name="reference_system_document_gi[]" id="">
                                    <option value="">--Select---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference Document</label>
                                <select multiple id="reference_record" name="reference_document_gi[]" id="">
                                    <option value="">--Select---</option>
                                    <option value="pdf">pdf</option>
                                    <option value="doc">doc</option>
                                </select>
                            </div>
                        </div>
                        <div class="sub-head pt-3">OOS Information</div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Sample Type</label>
                                <select name="sample_type_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option  value="raw material">Raw Material</option>
                                    <option value="packing material">Packing Material</option>
                                    <option value="finished product">Finished Product</option>
                                    <option value="stability sample">Stability Sample</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description ">Product / Material Name</label>
                                <input type="text" name="product_material_name_gi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Market</label>
                                <input type="text" name="market_gi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Customer</label>
                                <select name="customer_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <!-- ---------------------------grid-1 -------------------------------- -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Info. On Product/ Material
                                <button type="button" name="audit-agenda-grid" id="Product_Material">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Product_Material_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 10%">Item/Product Code</th>
                                            <th style="width: 8%"> Batch No*.</th>
                                            <th style="width: 8%"> Mfg.Date</th>
                                            <th style="width: 8%">Expiry Date</th>
                                            <th style="width: 8%"> Label Claim.</th>
                                            <th style="width: 8%">Pack Size</th>
                                            <th style="width: 8%">Analyst Name</th>
                                            <th style="width: 10%">Others (Specify)</th>
                                            <th style="width: 10%"> In- Process Sample Stage.</th>
                                            <th style="width: 12% pt-3">Packing Material Type</th>
                                            <th style="width: 16% pt-2"> Stability for</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $serialNumber= 1;
                                    @endphp
                                    <tbody>
                                        <td disabled >{{$serialNumber++}}</td>
                                        <td><input type="text" name="productMaterial[0][item_product_code]"></td>
                                        <td><input type="text" name="productMaterial[0][batch_no]"></td>
                                        <td><input type="text" name="productMaterial[0][mfg_date]"></td>
                                        <td><input type="text" name="productMaterial[0][expiry_date]"></td>
                                        <td><input type="text" name="productMaterial[0][label_claim]"></td>
                                        <td><input type="text" name="productMaterial[0][pack_size]"></td>
                                        <td><input type="text" name="productMaterial[0][analyst_name]"></td>
                                        <td><input type="text" name="productMaterial[0][others_specify]"></td>
                                        <td><input type="text" name="productMaterial[0][in_process_sample_stage]"></td>
                                        <td><select name="productMaterial[0][packingMaterialType]">
                                                <option value=''> Select Option</option>
                                                <option value='primary'>Primary</option>
                                                <option value='Secondary'>Secondary</option>
                                                <option value='tertiary'>Tertiary</option>
                                                <option value='not applicable'>Not Applicable</option>
                                            </select> </td>
                                        <td><select name="productMaterial[0][stabilityfor]">
                                               <option value=''> Select Option </option>
                                                <option value='Submission'>Submission</option>
                                                <option value='commercial'>Commercial</option>
                                                <option value='pack evaluation'>Pack Evaluation</option>
                                                <option value='not applicable'>Not Applicable</option>
                                            </select> </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- -------------------------------grid-2  ----------------------------------   -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Details of Stability Study
                                <button type="button" name="audit-agenda-grid" id="Details_Stability">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Details_Stability_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number</th>
                                            <th style="width: 12%">Condition: Temperature & RH</th>
                                            <th style="width: 12%">Interval</th>
                                            <th style="width: 16%">Orientation</th>
                                            <th style="width: 16%">Pack Details (if any)</th>
                                            <th style="width: 16%">Specification No.</th>
                                            <th style="width: 16%">Sample Description</th>
                                            <th style="width:4%">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="stability_study[0][serial_no]" value="1"></td>
                                        <td><input type="text" name="stability_study[0][ar_number]"></td>
                                        <td><input type="text" name="stability_study[0][condition_temperature_rh]"></td>
                                        <td><input type="text" name="stability_study[0][interval]"></td>
                                        <td><input type="text" name="stability_study[0][orientation]"></td>
                                        <td><input type="text" name="stability_study[0][pack_details]"></td>
                                        <td><input type="text" name="stability_study[0][specification_no]"></td>
                                        <td><input type="text" name="stability_study[0][sample_description]"></td>
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--------------------------------------------grid-3----------------------------------- -->

                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                OOS Details
                                <button type="button" name="audit-agenda-grid" id="OOS_Details">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="OOS_Details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number.</th>
                                            <th style="width: 8%">Test Name of OOS</th>
                                            <th style="width: 12%">Results Obtained</th>
                                            <th style="width: 16%">Specification Limit</th>
                                            <th style="width: 16%">Details of Obvious Error</th>
                                            <th style="width: 16%">File Attachment</th>
                                            <th style="width:4%"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="oos_details[0][serial]" value="1"></td>
                                        <td><input type="text" name="oos_details[0][ar_number]"></td>
                                        <td><input type="text" name="oos_details[0][test_name_of_oos]"></td>
                                        <td><input type="text" name="oos_details[0][results_obtained]"></td>
                                        <td><input type="text" name="oos_details[0][specification_limit]"></td>
                                        <td><input type="text" name="oos_details[0][details_of_obvious_error]"></td>
                                        <td><input type="file" name="oos_details[0][file_attachment_oos_details]"></td>
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </div>
       <!-- CCForm2 -->
     <!-- Preliminary Lab. Investigation -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Preliminary Lab. Investigation </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date"> Comments </label>
                                <div class="col-md-12 4">
                                    <div class="group-input">
                                      <textarea class="summernote" name="comments_pli" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Schedule End Date"> Field Alert Required</label>
                                <select name="field_alert_required_pli">
                                    <option>Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Field Alert Ref.No.
                                </label>
                                <select multiple id="reference_record" name="field_alert_ref_no_pli[]" id="">
                                    <option value="">--Select---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                <div class="col-md-12 mb-4">
                    <div class="group-input">
                        <label for="Description Deviation">Justify if no Field Alert</label>
                        <textarea class="summernote" name="justify_if_no_field_alert_pli" id="summernote-1">
                            </textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Product/Material Name"> Verification Analysis Required</label>
                        <select name="verification_analysis_required_pli">
                            <option>Enter Your Selection Here</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="verification_analysis_ref_pli">Verification Analysis Ref.</label>
                        <select multiple id="reference_record" name="verification_analysis_ref_pli[]" id="">
                            <option value="">--Select---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Product/Material Name">Analyst Interview Req.</label>
                        <select name="analyst_interview_req_pli">
                            <option>Enter Your Selection Here</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="analyst_interview_ref_pli">Analyst Interview Ref.</label>
                        <select multiple id="reference_record" name="analyst_interview_ref_pli[]" id="">
                            <option value="">--Select---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 mb-4">
                    <div class="group-input">
                        <label for="Audit Schedule Start Date">Justify if no Analyst Int. </label>
                        <textarea class="summernote" name="justify_if_no_analyst_int_pli" id="summernote-1">
                        </textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Product/Material Name">Phase I Investigation Required</label>
                        <select name="phase_i_investigation_required_pli">
                            <option>Enter Your Selection Here</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Product/Material Name">Phase I Investigation</label>
                        <select name="phase_i_investigation_pli">
                            <option value="">Enter Your Selection Here</option>
                            <option value="phase-I-micro">Phase I Micro</option>
                            <option value="phase-I-chemical">Phase I Chemical</option>
                            <option value="hypothesis">Hypothesis</option>
                            <option value="resampling">Resampling</option>
                            <option value="other">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="phase_i_investigation_ref_pli">Phase I Investigation Ref.</label>
                        <select multiple id="reference_record" name="phase_i_investigation_ref_pli[]" id="">
                            <option value="">--Select---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Audit Attachments">File Attachments</label>
                        <small class="text-primary">
                            Please Attach all relevant or supporting documents
                        </small>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach"></div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="file_attachments_pli[]" oninput="addMultipleFiles(this, 'file_attach')" multiple>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-12">
                        <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION REPORT</label>

                        @php
                            $phase_I_investigations = [
                                    "Aliquot and standard solutions preserved.",
                                    "Visual examination (solid and solution) reveals normal or abnormal appearance.",
                                    "The analyst is trained on the method.",
                                    "Correct test procedure followed e.g. Current Version of standard testing procedure has been used in testing.",
                                    "Current Validated analytical Method has been used and the data of analytical method validation has been reviewed and found satisfactory.",
                                    "Correct sample(s) tested.",
                                    "Sample Integrity maintained, correct container is used in testing.",
                                    "Assessment of the possibility that the sample contamination (sample left open to air or unattended) has occurred during the testing/ re-testing procedure.",
                                    "All equipment used in the testing is within calibration due period.",
                                    "Equipment log book has been reviewed and no any failure or malfunction has been reviewed.",
                                    "Any malfunctioning and / or out of calibration analytical instruments (including glassware) is used.",
                                    "Whether reference standard / working standard is correct (in terms of appearance, purity, LOD/water content & its storage) and assay values are determined correctly.",
                                    "Whether test solution / volumetric solution used are properly prepared & standardized.",
                                    "Review RSD, resolution factor and other parameters required for the suitability of the test system. Check if any out of limit parameters is included in the chromatographic analysis, correctness of the column used previous use of the column.",
                                    "In the raw data, including chromatograms and spectra; any anomalous or suspect peaks or data has been observed.",
                                    "Any such type of observation has been observed previously (Assay, Dissolution etc.).",
                                    "Any unusual or unexpected response observed with standard or test preparations (e.g. whether contamination of equipment by previous sample observed).",
                                    "System suitability conditions met (those before analysis and during analysis).",
                                    "Correct and clean pipette / volumetric flasks volumes, glassware used as per recommendation.",
                                    "Other potentially interfering testing/activities occurring at the time of the test which might lead to OOS.",
                                    "Review of other data for other batches performed within the same analysis set and any nonconformance observed.",
                                    "Consideration of any other OOS results obtained on the batch of material under test and any non-conformance observed.",
                                    "Media/Reagents prepared according to procedure.",
                                    "All the materials are within the due period of expiry.",
                                    "Whether, analysis was performed by any other alternate validated procedure",
                                    "Whether environmental condition is suitable to perform the test.",
                                    "Interview with analyst to assess knowledge of the correct procedure."

                            ];
                        @endphp


                    <div class="group-input ">

                        <div class="why-why-chart mx-auto" style="width: 100%">

                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sr.No.</th>
                                        <th style="width: 40%;">Question</th>
                                        <th style="width: 20%;">Response</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($phase_I_investigations as $phase_I_investigation )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$phase_I_investigation}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="phase_IB_investigation[{{$loop->index}}][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="phase_IB_investigation[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="button-block">
                    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" id="ChangeNextButton" class="nextButton"
                        onclick="nextStep()">Next</button>
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                </div>
                </div>
                </div>

            </div>
            <!-- Preliminary Lab Inv. Conclusion -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Investigation Conclusion</div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Summary of Prelim.Investiga.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="summary_of_prelim_investiga_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Auditor">Root Cause Identified</label>
                                <!-- <div class="text-primary">Please Choose the relevent units</div> -->
                                <select name="root_cause_identified_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Team"> OOS Category-Root Cause Ident.</label>
                                <select name="oos_category_root_cause_ident_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="analyst-error">Analyst Error</option>
                                    <option value="instrument-error">Instrument Error</option>
                                    <option value="product-material-related-error">Product/Material Related Error</option>
                                    <option value="other-error">Other Error</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS Category (Others)</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="oos_category_others_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Root Cause Details</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="root_cause_details_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS Category-Root Cause Ident.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="oos_category_root_cause_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">Recommended Actions Required?</label>
                                <select name="recommended_actions_required_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="recommended_actions_reference_plic">Recommended Actions Reference
                                </label>
                                <select multiple id="reference_record" name="recommended_actions_reference_plic[]" id="">
                                    <option value="">--Select---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">CAPA Required</label>
                                <select name="capa_required_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Agenda">Reference CAPA No.</label>
                                <input type="num" name="reference_capa_no_plic">
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Delay Justification for P.I.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="delay_justification_for_pi_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments"> Supporting Attachment </label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attach"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachment_plic[]" oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Preliminary Lab Invst. Review--->
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Preliminary Lab Invstigation Review</div>
                    <div class="row">

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Review Comments</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="review_comments_plir" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="sub-head">OOS Review for Similar Nature</div>

                        <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Info. On Product/ Material
                                <button type="button" name="audit-agenda-grid" id="oos_capa">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="oos_capa_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">OOS Number</th>
                                            <th style="width: 8%"> OOS Reported Date</th>
                                            <th style="width: 12%">Description of OOS</th>
                                            <th style="width: 16%">Previous OOS Root Cause</th>
                                            <th style="width: 16%"> CAPA</th>
                                            <th style="width: 16% pt-3">Closure Date of CAPA</th>
                                            <th style="width: 16%">CAPA Requirement</th>
                                            <th style="width: 16%">Reference CAPA Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="info_product_oos_capa[0][serial]" value="1"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][oos_number]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][oos_reported_date]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][description_of_oos]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][previous_oos_root_cause]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][capa]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][closure_date_of_capa]"></td>
                                        <td><select name="info_product_oos_capa[0][capa_Requirement]">
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><input type="text" name="info_product_oos_capa[0][reference_capa_number]"></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Start Date"> Phase II Inv. Required?</label>
                                <select name="phase_ii_inv_required_plir">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments"> Supporting Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attach"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                            oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </div>
       <!-- 5ti20 tap -->
        <div id="CCForm21" class="inner-block cctabcontent">

            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Training records Analyst Involved in Testing

                </div>
                    @php
                      $training_records_analyst_involvedIn_testing_microbial_asssays = [
    [
        'question' => "Was analyst trained on testing procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst qualified for testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tbody>
                                            @php
                                                $main_question_index = 1.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($training_records_analyst_involvedIn_testing_microbial_asssays as $index => $review_item)
                                            @php
                                                if ($review_item['is_sub_question']) {
                                                    $sub_question_index++;
                                                } else {
                                                    $sub_question_index = 0;
                                                    $main_question_index += 0.1;
                                                }
                                            @endphp
                                            <tr>
                                                <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                <td>{{$review_item['question']}}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>


                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of sample intactness before analysis ? </div>
                    @php
                       $sample_intactness_before_analysis = [
    [
        'question' => "Was intact samples /sample container received in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was it verified by sample receipt persons at the time of receipt in lab?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the sample collected in desired container and transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any discrepancy observed during sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were sample stored as per storage requirements specified in specification/SOP?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($sample_intactness_before_analysis as $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sample_intactness_before_analysis[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sample_intactness_before_analysis[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sample_intactness_before_analysis[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sample_intactness_before_analysis[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of test methods & Procedures</div>
                        @php
                       $checklist_for_review_of_test_method_IMAs = [
    [
        'question' => "Was correct applicable specification and method of analysis used for analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "MOA & specification number?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the results of the other samples analyzed on the same day/time satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the samples pipetted or loaded in appropriate quantity?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the samples tested transferred and incubated at desired temperature as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the tested samples results observed within the valid time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were zones /readings measured correctly? (Applicable for Antibiotics –Microbial Assay)",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was formula, dilution factors used for calculation of results corrected?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp

                    <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_review_of_test_method_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Media, Buffer, Standards preparation & test accessories </div>
                @php
  $cr_of_media_buffer_st_IMAs = [
    [
        'question' => "Name of the media used in the analysis:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Did the COA of the media review and found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of media preparation:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Lot No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Use before date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Did appropriate size wells prepare in the media plates? (Applicable for Antibiotics –Microbial Assay)",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the media sterilization and sanitization cycle found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Validated load pattern references documents No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was any contamination observed in test media /Buffers /Standard solution?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was appropriate and cleaned glasswares used for testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Whether the volumetric flask calibrated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "References standard lot No./Batch No?",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Reference standard expiry date?",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Were the challenged samples stored in appropriate storage condition?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the standard weight accurately as mentioned in test procedure?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Any event observed with the references standard of the same batch?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the working standard prepared with appropriate dilutions?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of preparation:",
        'is_sub_question' => true,
        'input_type' => 'date',
    ],
    [
        'question' => "Use before date:",
        'is_sub_question' => true,
        'input_type' => 'date',
    ],
    [
        'question' => "Were sterilized petriplates used for testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Lot/Batch No. of petriplates",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Size of the petriplates",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Size of the petriplate",
        'is_sub_question' => true, // <- corrected
        'input_type' => 'text'
    ],
    [
        'question' => "Dilutor prepared on:",
        'is_sub_question' => false,
        'input_type' => 'date'
    ],
    [
        'question' => "Validity time of the dilutor:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Used on:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
];

   @endphp
                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $main_question_index = 4.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($cr_of_media_buffer_st_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="cr_of_media_buffer_st_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="cr_of_media_buffer_st_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="cr_of_media_buffer_st_IMA[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="cr_of_media_buffer_st_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Microbial cultures/Inoculation (Test organism) </div>
                    @php
                       $CR_of_microbial_cultures_inoculation_IMAs = [
    [
        'question' => "Name of the test organism used:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Passage No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Whether the culture suspension was prepared from valid source (Slant/Cryo vails)?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the culture suspension used within the valid time?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was appropriate quantity of the inoculum challenged in the product?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the stock/test culture dilution store as per recommended condition before used",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                </thead>

                                    <tbody>
                                        @php
                                            $main_question_index = 5.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_microbial_cultures_inoculation_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_microbial_cultures_inoculation_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_microbial_cultures_inoculation_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_microbial_cultures_inoculation_IMAs[{{ $index }}][response]"
                                                                                                id="response"
                                                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                                            <option value="">Select an Option</option>
                                                                                            <option value="Yes">Yes</option>
                                                                                            <option value="No">No</option>
                                                                                            <option value="N/A">N/A</option>
                                                                                        </select>

                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_microbial_cultures_inoculation_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Environmental conditions in the testing area </div>
                    @php
                       $CR_of_Environmental_condition_in_testing_IMAs = [
    [
        'question' => "Was observed temp. of the area within limit",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was differential pressure of the area within limit:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was viable environmental monitoring results of LAF /BSC (used for testing) found within limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "LAF/BSC ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ]
];
                    @endphp

                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_Environmental_condition_in_testing_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][remark]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][remark]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][remark]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>

                            </div>

                        </div>

                    </div>

                </div>





            </div>

            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of instrument/equipment </div>
                            @php
                               $CR_of_instru_equipment_IMAs = [
    [
        'question' => "Was there any malfunctioning of autoclave observed? verify the qualification and requalification of steam sterilizer?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Autoclave ID No:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was any Microbial cultures handled in BSC/LAF prior testing",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "BSC/ULAF ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Did the equipment cleaned prior to testing?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Incubators ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Any events associated with incubators, when the samples under incubation.",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was there any power supply failure noted during analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Pipette IDs",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date & Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                            @endphp

                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $main_question_index = 7.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_instru_equipment_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_instru_equipment_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_instru_equipment_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_instru_equipment_IMA[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_instru_equipment_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>

            <div class="inner-block-content">

                <div class="sub-head">

                    Disinfectant Details: </div>
                    @php
                       $disinfectant_details_IMAs = [
    [
        'question' => "Name of the disinfectant used for cleaning of testing area:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the disinfectant prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Use before date of the disinfectant used for cleaning:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                    @endphp

                <div class="row">

                    <div class="col-12">

                        <div class="group-input">

                            <div class="why-why-chart">

                                <table class="table table-bordered">

                                    <thead>

                                        <tr>

                                            <th style="width: 5%;">Sr.No.</th>

                                            <th style="width: 40%;">Question</th>

                                            <th style="width: 20%;">Response</th>

                                            <th>Remarks</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 8.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($disinfectant_details_IMAs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="disinfectant_details_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="disinfectant_details_IMA[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="disinfectant_details_IMA[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_IMA[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="group-input">

                        <label for="Audit Attachments">If Yes, Provide attachment details</label>


                        <div class="file-attachment-field">

                            <div class="file-attachment-list" id="file_attach"></div>

                            <div class="add-btn">

                                <div>Add</div>

                                <input type="file" id="myfile" name="attachment_details_cima[]"

                                    oninput="addMultipleFiles(this, 'file_attach')" multiple/>

                            </div>

                        </div>



                    </div>

                </div>













                <div class="button-block">

                    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>

                    <button type="button" class="backButton" onclick="previousStep()">Back</button>

                    <button type="button" id="ChangeNextButton" class="nextButton"

                        onclick="nextStep()">Next</button>

                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">

                            Exit </a> </button>

                </div>

            </div>

        </div>



        <div id="CCForm22" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for review of Training records Analyst Involved in monitoring
                </div>
                    @php
                        $CR_of_training_rec_anaylst_in_monitoring_CIEMs = [
    [
        'question' => "Is the analyst trained for Environmental monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst qualified for Personnel qualification?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the analyst trained on entry exit /procedure/In production area or any monitoring area?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "SOP No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the analyst followed gowning procedure properly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was analyst performed colony counting correctly?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];
                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_training_rec_anaylst_in_monitoring_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for sample details:
                </div>
                    @php
                        $Check_for_Sample_details_CIEMs = [
    [
        'question' => "Was the plate verified at the time of monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the plate transported as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the correct location ID & Room Name mentioned on plate exposed?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "What is the grade of plate exposed area?",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Is area crossing Alert limit or action limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Check_for_Sample_details_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Check_for_Sample_details_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Check_for_Sample_details_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Check_for_Sample_details_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Check_for_Sample_details_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                   </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                    Checklist for comparison of results with other parameters:
                </div>
                        @php
                            $Check_for_comparision_of_results_CIEMs = [
    [
        'question' => "Was any Excursions in other settle plate exposure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in other active air plate sampling?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in surface monitoring?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was any Excursions in personnel monitoring on same day?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is results of next day monitoring within the acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was negative control of the test procedure found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were the plate transferred and incubated at desired temp.as per approved procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Check_for_comparision_of_results_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for details of media dehydrated media used:
                </div>
                        @php
                           $checklist_for_media_dehydrated_CIEMs = [
    [
        'question' => "Name of media used for in the analysis:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Did the COA of the media checked and found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Media Lot. No.",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Media Qualified date /Qualified By",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media expiry date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    @foreach ($checklist_for_media_dehydrated_CIEMs as $checklist_for_media_dehydrated_CIEM )
                                    <tbody>
                                        @php
                                            $main_question_index = 4.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @php
                                            if ($checklist_for_media_dehydrated_CIEM['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $checklist_for_media_dehydrated_CIEM['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$checklist_for_media_dehydrated_CIEM['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($checklist_for_media_dehydrated_CIEM['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($checklist_for_media_dehydrated_CIEM['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                  @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for media preparation details and sterilization :
                </div>
                        @php
                           $checklist_for_media_prepara_sterilization_CIEMs = [
    [
        'question' => "Date of media preparation",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media Lot. No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Media prepared date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Media expiry date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Preincubation of media",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Sterilization cycle No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Were cycle sterilization parameters found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 5.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_media_prepara_sterilization_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of environmental conditions in the testing area
                </div>
                    @php
                       $CR_of_En_condition_in_testing_CIEMs = [
    [
        'question' => "Is temperature of MLT testing area within the acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the differential pressure of the area within limit?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "While media plate preparation is LAF working satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_En_condition_in_testing_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for disinfectant Details:
                </div>
                    @php
                       $check_for_disinfectant_CIEMs = [
    [
        'question' => "Name of the disinfectant used for area cleaning",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the disinfectant used for cleaning and sanitization validated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Concentration:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the disinfectant prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 7.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($check_for_disinfectant_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="check_for_disinfectant_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="check_for_disinfectant_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="check_for_disinfectant_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="check_for_disinfectant_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for fogging details :
                </div>
                        @php
                          $checklist_for_fogging_CIEMs = [
    [
        'question' => "Name of the fogging agents used for area fogging",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the fogging agent used for fogging and validated?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Concentration:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the fogging agent prepared as per validated concentration?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 8.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_fogging_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_fogging_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_fogging_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_fogging_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_fogging_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Test Method & procedure:
                </div>
                    @php
                      $CR_of_test_method_CIEMs = [
    [
        'question' => "Was the test method, monitoring SOP followed correctly?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "SOP No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 9.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_test_method_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_test_method_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_test_method_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_test_method_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_test_method_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification)
                </div>
                        @php
                          $CR_microbial_isolates_contamination_CIEMs = [
    [
        'question' => "Were the contaminants/ isolates subculture?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Attach the colony morphology details:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Gram nature of the organism (GP/GN)",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "(Attach the details, if more than single organism)",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.",
        'is_sub_question' => false,
        'input_type' => 'number'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 10.1;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_microbial_isolates_contamination_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Instrument/Equipment:
                </div>
                    @php
                        $CR_of_instru_equip_CIEMs = [
    [
        'question' => "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is used incubators are qualified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Incubator :ID No.",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Is used Colony counter qualified?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Colony counter ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Qualification date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Is used Air sampler qualified?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Air sampler ID",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Validation date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was temp. of incubator with in the limit during incubation period?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was HVAC system of testing area qualified?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Qualification date and Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 11.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($CR_of_instru_equip_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="CR_of_instru_equip_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="CR_of_instru_equip_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="CR_of_instru_equip_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_instru_equip_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for trend Analysis:
                </div>
                        @php
                          $Ch_Trend_analysis_CIEMs = [
    [
        'question' => "Is trend of current month within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Is trend of previous month within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead><tbody>
                                        @php
                                            $main_question_index = 12.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($Ch_Trend_analysis_CIEMs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="Ch_Trend_analysis_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Ch_Trend_analysis_CIEM[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Ch_Trend_analysis_CIEM[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Ch_Trend_analysis_CIEM[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="group-input">

                            <label for="Audit Attachments">If Yes, Provide attachment details</label>


                            <div class="file-attachment-field">

                                <div class="file-attachment-list" id="file_attach"></div>

                                <div class="add-btn">

                                    <div>Add</div>

                                    <input type="file" id="myfile" name="attachment_details_ciem[]"

                                        oninput="addMultipleFiles(this, 'file_attach')" multiple/>

                                </div>

                            </div>



                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>
        </div>


        <div id="CCForm23" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Analyst training & Procedure
                </div>
                    @php
                        $checklist_for_analyst_training_CIMTs = [
    [
        'question' => "Is the analyst trained/qualified GPT test procedure?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of qualification:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Were appropriate precaution taken by the analyst throughout the test?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Analyst interview record.......",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Was an analyst persons suffering from any ailment such as cough/cold or open wound or skin infections?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 1.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_analyst_training_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_analyst_training_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_analyst_training_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_analyst_training_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_analyst_training_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                </div>
             </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Comparison of results (With same & Previous Day Media GPT) :
                </div>
                    @php
                       $checklist_for_comp_results_CIMTs = [
    [
        'question' => "Which media GPT performed at previous day:",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were dehydrated and ready to use media used for GPT?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Lot No./Batch No:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Date /Time of Incubation:",
        'is_sub_question' => false,
        'input_type' => 'date'
    ],
    [
        'question' => "Date/Time of Release:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Results of previous day GPT record?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Results of other plates released for GPT is within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 2.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_comp_results_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_comp_results_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_comp_results_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_comp_results_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_comp_results_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Culture verification ?
                </div>
                    @php
                     $checklist_for_Culture_verification_CIMTs = [
    [
        'question' => "Is culture COA checked?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the correct Inoculum used for GPT?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was used culture within culture due date?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Date of culture dilution:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Due date of culture dilution:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the storage condition of culture is appropriate?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was culture strength used within acceptance range?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 3.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_Culture_verification_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][response"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                                   </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div><div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Sterilize Accessories :
                </div>
                        @php
                            $sterilize_accessories_CIMTs = [
    [
        'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Sterilization cycle No.:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Whether disposable sterilized gloves used during testing were within the expiry date?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Results of other plates released for GPT is within acceptance?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                        @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 4.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($sterilize_accessories_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="sterilize_accessories_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="sterilize_accessories_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="sterilize_accessories_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sterilize_accessories_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                                   </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Instrument/Equipment Details:
                </div>
                    @php
                       $checklist_for_intrument_equip_last_CIMTs = [
    [
        'question' => "Was the equipment used, calibrated/qualified and within the specified range?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Biosafety equipment ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Validation date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Colony counter equipment ID:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was used pipettes within calibration?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Pipettes ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Calibration date",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was the refrigerator used for storage of culture is validated?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Refrigerator (2-8̊ C) ID:",
        'is_sub_question' => true,
        'input_type' => 'number'
    ],
    [
        'question' => "Validation date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Incubator ID:",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Validation date and next due date:",
        'is_sub_question' => true,
        'input_type' => 'date'
    ],
    [
        'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Were any other media GPT tested along with this sample?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "If yes, whether those media GPT results found satisfactory?",
        'is_sub_question' => true,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 5.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_intrument_equip_last_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Disinfectant Details:
                </div>
                    @php
                       $disinfectant_details_last_CIMTs = [
    [
        'question' => "Name of the disinfectant used for area cleaning",
        'is_sub_question' => false,
        'input_type' => 'number'
    ],
    [
        'question' => "Was the disinfectant used for cleaning and sanitization validated?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Concentration:",
        'is_sub_question' => true,
        'input_type' => 'text'
    ],
    [
        'question' => "Was the disinfectant prepared as per validated concentration?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 6.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($disinfectant_details_last_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name="disinfectant_details_last_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="disinfectant_details_last_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="disinfectant_details_last_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_last_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                              </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Results and Calculation :
                </div>
                    @php
                       $checklist_for_result_calculation_CIMTs = [
    [
        'question' => "Were results taken properly?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Raw data checked?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ],
    [
        'question' => "Was formula dilution factor used for calculating the results corrected?",
        'is_sub_question' => false,
        'input_type' => 'text'
    ]
];

                    @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="group-input">
                            <div class="why-why-chart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th style="width: 40%;">Question</th>
                                            <th style="width: 20%;">Response</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main_question_index = 7.0;
                                            $sub_question_index = 0;
                                        @endphp

                                        @foreach ($checklist_for_result_calculation_CIMTs as $index => $review_item)
                                        @php
                                            if ($review_item['is_sub_question']) {
                                                $sub_question_index++;
                                            } else {
                                                $sub_question_index = 0;
                                                $main_question_index += 0.1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                            <td>{{$review_item['question']}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                    <input type="date" name=" checklist_for_result_calculation_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name=" checklist_for_result_calculation_CIMT[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name=" checklist_for_result_calculation_CIMT[{{$loop->index}}][response]"
                                                            id="response"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        <option value="">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name=" checklist_for_result_calculation_CIMT[{{$loop->index}}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-lg-12">

                                    <div class="group-input">

                                        <label for="Audit Attachments">If Yes, Provide attachment details</label>


                                        <div class="file-attachment-field">

                                            <div class="file-attachment-list" id="file_attach"></div>

                                            <div class="add-btn">

                                                <div>Add</div>

                                                <input type="file" id="myfile" name="attachment_details_cimst[]"

                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple/>

                                            </div>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                        onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit </a> </button>
                    </div>

                </div>
            </div>
        </div>
      </form>
    </div>
</div>
<script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to, #manufacturing_invst, #manufacturing_multi_select'
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
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
        document.getElementById("dynamicSelectType").addEventListener("change", function() {
            var selectedRoute = this.value;
            window.location.href = selectedRoute; // Redirect to the selected route
        });
    </script>
    <script>
        VirtualSelect.init({
            ele: '#facility_name, #group_name, #auditee, #audit_team'
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
    </script>
    
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
@endsection
