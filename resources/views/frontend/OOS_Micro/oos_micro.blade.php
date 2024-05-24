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
                        '<td><select name="info_of_product_material['+ loopIndex +'][packingMaterialType]"><option value="primary">Primary</option><option value="secondary">Secondary</option><option value="tertiary">Tertiary</option><option value="not_applicable">Not Applicable</option></select></td>'+
                        '<td><select name="info_of_product_material['+ loopIndex +'][stabilityfor]"><option value="submission">Submission</option><option value="commercial">Commercial</option><option value="pack_evaluation">Pack Evaluation</option><option value="not_applicable">Not Applicable</option></select></td>'+
                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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

                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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
                      ' <td><input disabled type="text" name="oosConclusion_review['+ loopIndex +'][serial]" value="' + serialNumber +
                        '"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][material_product_no]"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][batch_no_ar_no]"></td>'+
                                   ' <td><input type="text" name="oosConclusion_review['+ loopIndex +'][any_other_information]"></td>'+
                                    '<td><input type="text" name="oosConclusion_review['+ loopIndex +'][action_taken_on_affecBatch]"></td>'+


                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

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
        <!-- <div class="pr-id">
                                                    New Document
                                                </div> -->
        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :
            QMS-North America / OOS_Micro
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
                                <label for="Initiator"> Record Number </label>
                                <input disabled type="text" name="record"
                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/OOS_MICRO/{{ date('Y') }}/{{ $record_number }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Division Code">Division Code</label>
                                <input readonly type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-input">
                                <label for="Short Description">Initiator <span class="text-danger"></span></label>
                                <input disabled type="text" name="initiator_id"
                                 value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="intiation_date">Date of Initiation</label>
                                <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"> Due Date
                                </label>

                                <small class="text-primary">
                                    Please mention expected date of completion
                                </small>
                                <input type="date" id="due_date" name="due_date">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description">Severity Level</label>
                                <select name="severity_level_gi">
                                    <option value="0">-- Select --</option>
                                    <option value="minor">Minor</option>
                                    <option value="major">Major</option>
                                    <option value="critical">Critical</option>
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
                                        onchange="otherController(this.value, 'Yes', 'repeat_nature')">
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
                                    <option></option>
                                    <!-- <option>Lab Incident</option>
                                         <option>Deviation</option>
                                         <option>Product Non-conformance</option>
                                         <option>Inspectional Observation</option>
                                         <option>Others</option> -->

                                </select>


                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Deviation Occured On</label>
                                <input type="date" name="deviation_occured_on_gi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Description</label>
                                <textarea name="description_gi"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initial Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>

                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attach"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="initial_attachment_gi[]" oninput="addMultipleFiles(this, 'file_attach')" multiple>
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
                                    @foreach ($old_record as $new)
                                        <option value="{{ $new->id }}">
                                            {{ Helpers::getDivisionName($new->division_id) }}/OOS_MICRO/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                        </option>
                                    @endforeach
                                    {{--<option value="1">1</option>
                                    <option value="2">2</option>--}}
                                </select>
                            </div>
                        </div>

                        <div class="sub-head pt-3">OOS Information</div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Sample Type</label>
                                <select name="sample_type_gi">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="raw-material">Raw Material</option>
                                    <option value="packing-material">Packing Material</option>
                                    <option value="finished-product">Finished Product</option>
                                    <option value="stability-sample">Stability Sample</option>
                                    <option value="other">Others</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description ">Product / Material Name</label>

                                <input type="number" name="product_material_name_gi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Market</label>

                                <input type="number" name="market_gi">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Initiator Group">Customer*</label>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="serial[]" value="1"></td>
                                        <td><input type="text" name="item_product_code[]"></td>
                                        <td><input type="text" name="batch_no[]"></td>
                                        <td><input type="text" name="mfg_date[]"></td>
                                        <td><input type="text" name="expiry_date[]"></td>
                                        <td><input type="text" name="label_claim[]"></td>
                                        <td><input type="text" name="pack_size[]"></td>
                                        <td><input type="text" name="analyst_name[]"></td>
                                        <td><input type="text" name="others_specify[]"></td>
                                        <td><input type="text" name="in_process_sample_stage[]"></td>
                                        <td><select name="packingMaterialType[]">
                                                <option>Primary</option>
                                                <option>Secondary</option>
                                                <option>Tertiary</option>
                                                <option>Not Applicable</option>
                                            </select> </td>
                                        <td><select name="stabilityfor[]">
                                                <option>Submission</option>
                                                <option>Commercial</option>
                                                <option>Pack Evaluation</option>
                                                <option>Not Applicable</option>
                                            </select> </td>



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
                                    </tbody>

                                </table>
                            </div>
                        </div>


                        <!--
                                            ------------------------------------------grid-3----------------------------------- -->

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
                                            {{-- <th style="width: 16%">Submit By</th>
                                            <th style="width: 16%">Submit On</th> --}}

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
                                        {{-- <td><input type="text" name="text[]"></td>
                                        <td><input type="date" name="time[]"></td> --}}



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
                                        <!-- <label for="Description Deviation">Description of Deviation</label> -->
                                        <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                        <textarea class="summernote" name="comments_pli[]" id="summernote-1">
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
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="justify_if_no_field_alert_pli[]" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                                                                        <div class="group-input">
                                                                            <label for="Facility Name"> Facility Name </label>
                                                                            <select multiple name="facility_name" placeholder="Select Nature of Deviation" data-search="false" data-silent-initial-value-set="true" id="facility_name">
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="group-input">
                                                                            <label for="Group Name"> Group Name </label>
                                                                            <select multiple name="group_name" placeholder="Select Nature of Deviation" data-search="false" data-silent-initial-value-set="true" id="group_name">
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                                <option value="Piyush">Piyush Sahu</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> -->
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
                                <label for="Reference Recores">Verification Analysis Ref.</label>
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
                                <label for="Reference Recores">Analyst Interview Ref.</label>
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

                                <!-- <label for="Description Deviation">Description of Deviation</label> -->
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="justify_if_no_analyst_int_pli[]" id="summernote-1">
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
                                <label for="Reference Recores">Phase I Investigation Ref.</label>
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
                            <center>
                                <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION
                                    REPORT</label>
                            </center>

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
                                            <tr>
                                                <td class="flex text-center">1</td>
                                                <td>Aliquot and standard solutions preserved.</td>
                                                <td>


                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>





                                            </tr>
                                            <tr>
                                                <td class="flex text-center">2</td>
                                                <td>Visual examination (solid and solution) reveals normal or abnormal
                                                    appearance.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">3</td>
                                                <td>The analyst is trained on the method.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="flex text-center">4</td>
                                                <td>Correct test procedure followed e.g. Current Version of standard testing
                                                    procedure has been used in testing.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">5</td>
                                                <td>Current Validated analytical Method has been used and the data of
                                                    analytical method validation has been reviewed and found satisfactory.
                                                </td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">6</td>
                                                <td>Correct sample(s) tested.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">7</td>
                                                <td>Sample Integrity maintained, correct container is used in testing.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">8</td>
                                                <td>Assessment of the possibility that the sample contamination (sample left
                                                    open to air or unattended) has occurred during the testing/ re-testing
                                                    procedure. </td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">9</td>
                                                <td>All equipment used in the testing is within calibration due period.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">10</td>
                                                <td>Equipment log book has been reviewed and no any failure or malfunction
                                                    has been reviewed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">11</td>
                                                <td>Any malfunctioning and / or out of calibration analytical instruments
                                                    (including glassware) is used.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">12</td>
                                                <td>Whether reference standard / working standard is correct (in terms of
                                                    appearance, purity, LOD/water content & its storage) and assay values
                                                    are determined correctly.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">13</td>
                                                <td>Whether test solution / volumetric solution used are properly prepared &
                                                    standardized.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">14</td>
                                                <td>Review RSD, resolution factor and other parameters required for the
                                                    suitability of the test system. Check if any out of limit parameters is
                                                    included in the chromatographic analysis, correctness of the column used
                                                    previous use of the column.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">15</td>
                                                <td>In the raw data, including chromatograms and spectra; any anomalous or
                                                    suspect peaks or data has been observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">16</td>
                                                <td>Any such type of observation has been observed previously (Assay,
                                                    Dissolution etc.).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">17</td>
                                                <td>Any unusual or unexpected response observed with standard or test
                                                    preparations (e.g. whether contamination of equipment by previous sample
                                                    observed).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">18</td>
                                                <td>System suitability conditions met (those before analysis and during
                                                    analysis).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">19</td>
                                                <td>Correct and clean pipette / volumetric flasks volumes, glassware used as
                                                    per recommendation.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">20</td>
                                                <td>Other potentially interfering testing/activities occurring at the time
                                                    of the test which might lead to OOS.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">21</td>
                                                <td>Review of other data for other batches performed within the same
                                                    analysis set and any nonconformance observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">22</td>
                                                <td>Consideration of any other OOS results obtained on the batch of material
                                                    under test and any non-conformance observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">23</td>
                                                <td>Media/Reagents prepared according to procedure.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">24</td>
                                                <td>All the materials are within the due period of expiry.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">25</td>
                                                <td>Whether, analysis was performed by any other alternate validated
                                                    procedure</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="flex text-center">26</td>
                                                <td>Whether environmental condition is suitable to perform the test.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">27</td>
                                                <td>Interview with analyst to assess knowledge of the correct procedure</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
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
                                <textarea class="summernote" name="summary_of_prelim_investiga_plic[]" id="summernote-1">
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
                                <textarea class="summernote" name="oos_category_others_plic[]" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Root Cause Details</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="root_cause_details_plic[]" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS Category-Root Cause Ident.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="oos_category_root_cause_plic[]" id="summernote-1">
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
                                <label for="Reference Recores">Recommended Actions Reference
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
                                <textarea class="summernote" name="delay_justification_for_pi_plic[]" id="summernote-1">
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
                                <textarea class="summernote" name="review_comments_plir[]" id="summernote-1">
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
        
        <!--Phase II Investigation -->
        <div id="CCForm5" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Phase II Investigation
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">QA Approver Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="qa_approver_comments_piii" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments"> Manufact. Invest. Required? </label>
                            <select name="manufact_invest_required_piii">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">


                            <label for="Auditee"> Manufacturing Invest. Type </label>
                            <select multiple name="manufacturing_invest_type_piii[]" placeholder="Select Nature of Deviation"
                                data-search="false" data-silent-initial-value-set="true" id="manufacturing_multi_select">
                                <option value="chemical">Chemical</option>
                                <option value="microbiology">Microbiology</option>

                            </select>
                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="group-input">
                            <select multiple id="manufacturing_invst" name="manufacturing_invst_ref_piii[]">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Re-sampling Required? </label>
                            <select name="re_sampling_required_piii">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Comments"> Audit Comments </label>
                            <textarea name="audit_comments_piii"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Re-sampling Ref. No.</label>
                            <select multiple id="reference_record" name="re_sampling_ref_no_piii[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Hypo/Exp. Required</label>
                            <select name="hypo_exp_required_piii">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo/Exp. Reference</label>
                            <select multiple id="reference_record" name="hypo_exp_reference_piii[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachment_piii[]"
                                        oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <label for="Reference Recores">PHASE II OOS INVESTIGATION </label>
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
                                        <tr>
                                            <td class="flex text-center">1</td>
                                            <td>Is correct batch manufacturing record used?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2</td>
                                            <td>Correct quantities of correct ingredients were used in manufacturing? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3</td>
                                            <td>Balances used in dispensing / verification were calibrated using valid
                                                standard weights?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4</td>
                                            <td>Equipment used in the manufacturing is as per batch manufacturing record?
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5</td>
                                            <td>Processing steps followed in correct sequence as per the BMR?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6</td>
                                            <td>Whether material used in the batch had any OOS result?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7</td>
                                            <td>All the processing parameters were within the range specified in BMR? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8</td>
                                            <td>Environmental conditions during manufacturing are as per BMR?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">9</td>
                                            <td>Whether there was any deviation observed during manufacturing?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10</td>
                                            <td>The yields at different stages were within the acceptable range as per BMR?
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11</td>
                                            <td>All the equipment’s used during manufacturing are calibrated?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">12</td>
                                            <td>Whether there is malfunctioning or breakdown of equipment during
                                                manufacturing?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">13</td>
                                            <td>Whether the processing equipment was maintained as per preventive
                                                maintenance schedule?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">14</td>
                                            <td>All the in process checks were carried out as per the frequency given in BMR
                                                & the results were within acceptance limit?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">15</td>
                                            <td>Whether there were any failures of utilities (like Power, Compressed air,
                                                steam etc.) during manufacturing ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">16</td>
                                            <td>Whether other batches/products impacted? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">17</td>
                                            <td>Any Other</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
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

        <!-- Phase II QC Review -->
        <div id="CCForm6" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">Summary of Phase II Testing</div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary of Exp./Hyp.</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_of_exp_hyp_piiqcr[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary Mfg. Investigation</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_mfg_investigation_piiqcr[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By"> Root Casue Identified. </label>
                            <select name="root_casue_identified_piiqcr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By">OOS Category-Reason identified </label>
                            <select name="oos_category_reason_identified_piiqcr">
                                <option value="">Enter Your Selection Here</option>
                                <option value="analyst-error">Analyst Error</option>
                                <option value="instrument-error">Instrument Error</option>
                                <option value="product-material-related-error">Product/Material Related Error</option>
                                <option value="other-error">Other Error</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Preparation Completed On">Others (OOS category)</label>
                            <input type="string" name="others_oos_category_piiqcr">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Details of Root Cause</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="details_of_root_cause_piiqcr[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Impact Assessment.</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="impact_assessment_piiqcr[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Mgr.more Info Reqd On">Recommended Action Required? </label>
                            <select name="recommended_action_required_piiqcr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Recommended Action Reference</label>
                            <select multiple id="reference_record" name="recommended_action_reference_piiqcr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Observation Submitted On">Investi. Required</label>
                            <select name="investi_required_piiqcr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Invest ref.</label>
                            <select multiple id="reference_record" name="invest_ref_piiqcr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Lead More Info Reqd On">Attachments </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachments_piiqcr[]"
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



        <!--Additional Testing Proposal  -->
        <div id="CCForm7" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Additional Testing Proposal by QA
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Review Comment</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="review_comment_atp" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments"> Additional Test Proposal </label>
                            <select name="additional_test_proposal_atp">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Additional Test Reference.
                            </label>
                            <select multiple id="reference_record" name="additional_test_reference_atp[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Any Other Actions Required</label>
                            <select name="any_other_actions_required_atp">
                                <option value="">Yes</option>
                                <option value="">No</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference</label>
                            <select multiple id="reference_record" name="action_task_reference_atp[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Additional Testing Attachment </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="additional_testing_attachment_atp[]"
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


        <!--OOS Conclusion  -->
        <div id="CCForm8" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Conclusion Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="conclusion_comments_oosc" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <!-- ---------------------------grid-1 -------------------------------- -->
                    <div class="group-input">
                        <label for="audit-agenda-grid">
                            Summary of OOS Test Results
                            <button type="button" name="audit-agenda-grid" id="oos_conclusion">+</button>
                            <span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-details-field-instruction-modal"
                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="oos_conclusion_details" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">Row#</th>
                                        <th style="width: 16%">Analysis Detials</th>
                                        <th style="width: 16%">Hypo./Exp./Add.Test PR No.</th>
                                        <th style="width: 16%">Results</th>
                                        <th style="width: 16%">Analyst Name.</th>
                                        <th style="width: 16%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><input disabled type="text" name="summary_of_oos_test_results[0][serial]" value="1"></td>
                                    <td><input type="text" name="summary_of_oos_test_results[0][analysis_details]"></td>
                                    <td><input type="text" name="summary_of_oos_test_results[0][hypo_exp_add_test_pr_no]"></td>
                                    <td><input type="text" name="summary_of_oos_test_results[0][results]"></td>
                                    <td><input type="text" name="summary_of_oos_test_results[0][analyst_name]"></td>
                                    <td><input type="text" name="summary_of_oos_test_results[0][Remarks]"></td>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">Specification Limit </label>
                            <input type="text" name="specification_limit_oosc">
                        </div>
                    </div>




                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Results to be Reported</label>
                            <select name="results_to_be_reported_oosc">
                                <option value="initial">Initial</option>
                                <option value="retested-result">Retested Result</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Final Reportable Results</label>
                            <input type="text" name="final_reportable_results_oosc">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justifi. for Averaging Results</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justifi_for_averaging_results_oosc" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">OOS Stands </label>
                            <select name="oos_stands_oosc">
                                <option value="valid">Valid</option>
                                <option value="invalid">Invalid</option>



                            </select>
                        </div>
                    </div>




                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CAPA Req.</label>
                            <select name="capa_req_oosc">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>


                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">CAPA Ref No.</label>
                            <select multiple id="reference_record" name="capa_ref_no_oosc[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if CAPA not required</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_if_capa_not_required_oosc" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Action Plan Req.</label>
                            <select name="action_plan_req_oosc">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>


                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Plan Ref.</label>
                            <select multiple id="reference_record" name="action_plan_ref_oosc[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justification for Delay</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justification_for_delay_oosc" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Attachments if Any</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachments_if_any_oosc[]"
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


        <!--OOS Conclusion Review -->
        <div id="CCForm9" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Conclusion Review Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion Review Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>


                    <!-- ---------------------------grid-1 ------"OOSConclusion_Review-------------------------- -->
                    <div class="group-input">
                        <label for="audit-agenda-grid">
                            Summary of OOS Test Results
                            <button type="button" name="audit-agenda-grid" id="oosconclusion_review">+</button>
                            <span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-details-field-instruction-modal"
                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="oosconclusion_review_details"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">Row#</th>
                                        <th style="width: 16%">Material/Product Name</th>
                                        <th style="width: 16%">Batch No.(s) / A.R. No. (s)</th>
                                        <th style="width: 16%">Any Other Information</th>
                                        <th style="width: 16%">Action Taken on Affec.batch</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <td><input disabled type="text" name="serial[]" value="1"></td>
                                    <td><input type="text" name="oosConclusion_review[0][material_product_no]"></td>
                                    <td><input type="text" name="oosConclusion_review[0][batch_no_ar_no]"></td>
                                    <td><input type="text" name="oosConclusion_review[0][any_other_information]"></td>
                                    <td><input type="text" name="oosConclusion_review[0][action_taken_on_affecBatch]"></td>




                                </tbody>

                            </table>
                        </div>
                    </div>


                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Action Taken on Affec.batch</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="action_taken_on_affec_batch_ocr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>






                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CAPA Req?</label>
                            <select name="capa_req_ocr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">CAPA Refer.</label>
                            <select multiple id="reference_record" name="capa_refer_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">Required Action Plan? </label>
                            <select name="required_action_plan_ocr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Required Action Task?</label>
                            <select name="required_action_task_ocr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference.</label>
                            <select multiple id="reference_record" name="action_task_reference_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Risk Assessment Req?</label>
                            <select name="risk_assessment_req_ocr">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Risk Assessment Ref.</label>
                            <select multiple id="reference_record" name="risk_assessment_ref_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if No Risk Assessment</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Conclusion Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="conclusion_attachment_ocr[]"
                                        oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Approver</label>
                            <input type="text" name="qa_approver_ocr">
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





        <!--CQ Review Comments -->
        <div id="CCForm10" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    CQ Review Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">CQ Review comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="cq_review_comments_OOS_CQ" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments"> CAPA Required ?</label>
                            <select name="capa_required_OOS_CQ">
                                <option>Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reference of CAPA </label>
                            <input type="num" name="reference_of_capa_OOS_CQ">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">


                            <label for="Auditee"> Action plan requirement ? </label>
                            <select multiple name="action_plan_requirement_OOS_CQ" placeholder="Select Nature of Deviation"
                                data-search="false" data-silent-initial-value-set="true" id="auditee">
                                <option valu="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>




                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Ref Action Plan </label>
                            <input type="num" name="ref_action_plan_OOS_CQ">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Attachments"> CQ Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="cq_attachment_OOS_CQ[]"
                                        oninput="addMultipleFiles(this, 'cq_attachment_OOS_CQ')" multiple>
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





        <!-- Batch Disposition -->
        <div id="CCForm11" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Batch Disposition
                </div>
                <div class="row">



                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Category</label>
                            <select name="oos_category_BI">
                                <option value="">Enter Your Selection Here</option>
                                <option value="analyst-error">Analyst Error</option>
                                <option value="instrument-error">Instrument Error</option>
                                <option value="procedure-error">Procedure Error</option>
                                <option value="product-related-error">Product Related Error</option>
                                <option value="material-related-error">Material Related Error</option>
                                <option value="other-error">Other Error</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Other's</label>
                            <input type="string" name="others_BI">
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                                                                <div class="group-input">
                                                                    <label for="Report Attachments">Required Action Plan? </label>
                                                                    <input type="num" name="num">
                                                                </div>
                                                            </div> -->

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Material/Batch Release</label>
                            <select name="material_batch_release_BI">
                                <option value="">Enter Your Selection Here</option>
                                <option value="to-be-release">To Be Release</option>
                                <option value="to-be-rejected">To Be Rejected</option>
                                <option value="other-action">Other Action (Specify)</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Other Action (Specify)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="other_action_BI" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Field alert reference</label>
                            <select multiple id="reference_record" name="field_alert_reference_BI[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="sub-head">Assessment for batch disposition</div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Other Parameters Results</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="other_parameter_result_BI" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>



                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Trend of Previous Batches</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="trend_of_previous_batches_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Stability Data</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="stability_data_BI" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Process Validation Data</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="process_validation_data_BI" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Method Validation </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="method_validation_BI" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Any Market Complaints </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="any_market_complaints_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Statistical Evaluation </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="statistical_evaluation_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Risk Analysis for Disposition </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="risk_analysis_for_disposition_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="conclusion_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Phase-III Inves. Required?</label>
                            <select name="phase_III_inves_required_BI">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Phase-III Inves. Reference</label>
                            <select multiple id="reference_record" name="phase_III_inves_reference_BI[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify for Delay in Activity</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_for_delay_BI" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Disposition Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="disposition_attachment_BI[]"
                                        oninput="addMultipleFiles(this, 'disposition_attachment_BI')" multiple>
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
        <!-- Re-Open -->
        <div id="CCForm12" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Reopen Request
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Other Action (Specify)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="reopen_request" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="reopen_attachment[]"
                                        oninput="addMultipleFiles(this, 'reopen_attachment')" multiple>
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


        <!-- Under Addendum Approval -->

        <div id="CCForm13" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Approval Comment
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Reopen Approval Comments </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attach[]"
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

        <!--Under Addendum Execution -->
        <div id="CCForm14" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Execution Comment
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Execution Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Required?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference No.</label>
                            <select multiple id="reference_record" name="refrence_record[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Req?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Ref.</label>
                            <select multiple id="reference_record" name="refrence_record[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Req.?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Ref.</label>
                            <select multiple id="reference_record" name="refrence_record[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Req?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Ref.</label>
                            <select multiple id="reference_record" name="refrence_record[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Attachments
                            </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attach[]"
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

        <!-- Under Addendum Review-->
        <div id="CCForm15" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Under Addendum Review
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Addendum Review Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Required Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attach[]"
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


        <!-- Under Addendum Verification -->
        <div id="CCForm16" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Verification Comment
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Verification Comments </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Verification Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attach[]"
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


        <!----- Signature ----->

        <div id="CCForm17" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Activity Log
                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Agenda">Preliminary Lab Inves. Done By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Agenda">Preliminary Lab Inves. Done On</label>
                            <div class="Date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Team">Pre. Lab Inv. Conclusion By</label>
                            <div class="static"></div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Team">Pre. Lab Inv. Conclusion On</label>
                            <div class="Date"></div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="group-input">
                            <label for="Audit Comments"> Pre.Lab Invest. Review By </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Pre.Lab Invest. Review On</label>
                            <div class="Date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase II Invest. Proposed By</label>
                            <div class="static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase II Invest. Proposed On</label>
                            <div class="Date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Response Completed By"> Phase II QC Review Done By</label>
                            <div class=" static"></div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Response Completed On">Phase II QC Review Done On</label>
                            <div class="date"></div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Additional Test Proposed By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Additional Test Proposed On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Conclusion Complete By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Conclusion Complete On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Review Done By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Review Done On</label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Disposition Decision Done by</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Disposition Decision Done On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete on

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Approval Completed By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete on

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Execution Done By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Execution Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Review Done By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Review Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Verification Review Done By
                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Verification Review Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>




                    <!-- ====================================================================== -->
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted by">Submitted By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted on">Submitted On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="cancelled by">Cancelled By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="cancelled on">Cancelled On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="More information required By">More information required By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="More information required On">More information required On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="completed by">Completed By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="completed on">Completed On :</label>
                            <div class="Date"></div>
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

        <div id="CCForm18" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Analyst Training and Procedure
                </div>
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
                                        <tr>
                                            <td class="flex text-center">1.1</td>
                                            <td>Is the analyst trained/qualified BET test procedure ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.1</td>
                                            <td>Reference procedure number :-</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                    placeholder="Enter  value here"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" >
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.2</td>
                                            <td> Effective date </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.3</td>
                                            <td>Date of qualification:
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2</td>
                                            <td>Were appropriate precaution taken by the analyst throughout the test ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2.1</td>
                                            <td>Analyst interview record………………………….</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3</td>
                                            <td>Was an analyst /sampling persons suffering from any ailment such as
                                                cough/cold or open wound or skin infections?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3.1</td>
                                            <td>Analyst interview record………………………….</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4</td>
                                            <td>Was the correct procedure for the transfer of samples and accessories to
                                                sampling testing areas followed ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Sample receiving & verification in lab : </div>
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
                                        <tr>
                                            <td class="flex text-center">2.1</td>
                                            <td>Was the sample container (Physical integrity) verified at the time of sample
                                                receipt?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Were clean and dehydrogenated sampling accessories and glassware used for
                                                sampling?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3</td>
                                            <td>Was the correct quantity of the sample withdrawn ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4</td>
                                            <td>8. Was there any discrepancy observed during sampling ? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.5</td>
                                            <td>Was the sample container (Physical integrity) checked before testing ? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Method/Procedure used during analysis: </div>
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
                                        <tr>
                                            <td class="flex text-center">3.1</td>
                                            <td>Was correct applicable specification/Test procedure/MOA/ used for analysis ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.1</td>
                                            <td>Verified specification/Test procedure/MOA No.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.2</td>
                                            <td>Was the test procedure followed as per method validation ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.3</td>
                                            <td>Was the any change in the validated change method ?if yes, was test
                                                performed with the new validated method ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.4</td>
                                            <td>Was BET reagents (Lysate ,CSE,LRW and Buffer) procured from the approved
                                                vender ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.5</td>
                                            <td>Was lysate and CSE stored at the recommended temp.and duration? Storage
                                                condition:
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.6</td>
                                            <td>Were all product /reagents contact parts of BET testing (Tips/Accessories
                                                /Sample Container) depayrogenated ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.7.1</td>
                                            <td>Assay tube /Batch No.
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.7.2</td>
                                            <td>Expiry date:
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.8.1</td>
                                            <td>Tipe lot /Batch No.
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.8.2</td>
                                            <td>Expiry date:
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.9.1</td>
                                            <td>Was the test done at correct MVD as per validated method ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.9.2</td>
                                            <td> Were calculation of MVD/Test dilution done correctly?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.9.3</td>
                                            <td>Were correct dilutions prepared ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.10</td>
                                            <td>Was labeled claim lysate sensitivity checked before the use of the lot?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.11</td>
                                            <td>Were all reagents (LRW/CSE and Lysate) used in the test with in the expiry?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.11.1</td>
                                            <td>LRW expiry date?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px;">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.11.2</td>
                                            <td>CSE expiry date?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.11.3</td>
                                            <td>Lysate expiry date?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.11.4</td>
                                            <td> Buffer expiry date?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>


                                        <tr>
                                            <td class="flex text-center">3.12</td>
                                            <td>Was рН of the test sample/dilution verified?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.13</td>
                                            <td>Were appropriate рН strip /measuring device used, which provides the least
                                                count measurement of test sample/dilution wherever applicable?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.14</td>
                                            <td>Were proper incubation conditions followed ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.15</td>
                                            <td>Was there any spillage that occurred during the vortexing of dilutions?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.16</td>
                                            <td>Were the results of positive, negative and test controls found satisfactory?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.17</td>
                                            <td>Is the test incubator /heating block kept on a vibration –free surface ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.18</td>
                                            <td>Were measures established and implemented to prevent contamination from
                                                personal material, material during testing reviewed and found satisfactory?
                                                List the measures:
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Instrument/Equipment Details:</div>
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
                                        <tr>
                                            <td class="flex text-center">4.1</td>
                                            <td>Was the equipment used, calibrated/qualified and within the specified range?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Dry block /Heating block equipment ID:
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.2</td>
                                            <td>Calibration date & Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2.1</td>
                                            <td>Pipettes ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2.2</td>
                                            <td>Calibration date and Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.3.1</td>
                                            <td>Refrigerator (2-8̊ C) ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.3.2</td>
                                            <td>Validation date and next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.4.1</td>
                                            <td>Dehydrogenation over ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.4.2</td>
                                            <td>Validation date and next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.4.3</td>
                                            <td>Did the dehydrogenation cycle challenge with endotoxin and found
                                                satisfactory during validation? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.4.4</td>
                                            <td>Was the depyrogenation done as per the validated load pattern? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.5</td>
                                            <td>Was there any power failure noticed during the incubation of samples in the
                                                heating block? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.6</td>
                                            <td>Was assay tubes incubated in the dry block (time and temp).as specified in
                                                the procedure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.7.1</td>
                                            <td>Were any other samples tested along with this sample? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.7.2</td>
                                            <td>If yes, whether those sample’s results found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.8.1</td>
                                            <td>Were any other sample’s analyzed on the same time on the same instruments ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.8.2</td>
                                            <td>If yes, what were the results of other Batches:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Results and Calculation : </div>
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
                                        <tr>
                                            <td class="flex text-center">5.1</td>
                                            <td>Were results taken properly ? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Raw data checked By……………….</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.3</td>
                                            <td>Was formula dilution factor used for calculating the results corrected?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                <input type="file" id="myfile" name="attachment_details_cibet[]"
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

        <div id="CCForm19" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Review of Training records Analyst Involved in Testing
                </div>
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
                                        <tr>
                                            <td class="flex text-center">1.1</td>
                                            <td>Was analyst trained on testing procedure ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.1</td>
                                            <td>Date of training:</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2</td>
                                            <td> Was the analyst qualified for testing? </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2.1</td>
                                            <td>Date of qualification:
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3</td>
                                            <td>Were the personnel in perfect health without any open injury or infection?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4</td>
                                            <td>Were the entry and exit procedures to the respective production area followed as per SOP?</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>


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
                                        <tr>
                                            <td class="flex text-center">2.1</td>
                                            <td>Was intact samples /sample container received in lab?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Was it verified by sample receipt persons at the time of receipt in lab?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3</td>
                                            <td>Was the sample collected in desired container and transported as per approved procedure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4</td>
                                            <td>Was there any discrepancy observed during sampling?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4.1</td>
                                            <td>Any remark notified in sample request from?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                 <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.5</td>
                                            <td>Were sample stored as per storage requirements specified in specification/SOP?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                 <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Review of test methods & Procedures </div>
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
                                        <tr>
                                            <td class="flex text-center">3.1</td>
                                            <td>Was correct applicable specification and method of analysis used for analysis?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.2</td>
                                            <td>MOA & specification number?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.3</td>
                                            <td>Were the results of the other samples analyzed on the same day/time satisfactory?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.4</td>
                                            <td>Were the samples tested transferred and incubated at desired temperature as per approved procedure?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.5</td>
                                            <td>Were the tested samples results observed within the valid time?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                    Review of Media, Buffer, Standards preparation & test accessories </div>
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
                                        <tr>
                                            <td class="flex text-center">4.1</td>
                                            <td>Name of the media used in the analysis :
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Did the COA of the media review and found satisfactory ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.2</td>
                                            <td>Date of media preparation:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.3</td>
                                            <td>Lot No.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.4</td>
                                            <td>Use before date :</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.5</td>
                                            <td>Was the media sterilization and sanitization cycle found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.6</td>
                                            <td>Validated load pattern references documents No. </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.7</td>
                                            <td>Was any contamination observed in test media /diluents?</td>
                                            <td>

                                               <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.8</td>
                                            <td>Was appropriate and cleaned and sterilized glasswares used for testing?</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.9</td>
                                            <td>Are the negative controls still confirming?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2</td>
                                            <td>Is the growth promotion test for the media confirming?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

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
                                        <tr>
                                            <td class="flex text-center">5.1</td>
                                            <td>Were the environmental conditions during testing were as per the conditions specified? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.1</td>
                                            <td>Was the Temperature of the area within the limit?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.2</td>
                                            <td>Pressure differentials of the area within the limit?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.3</td>
                                            <td>Were the other types of monitoring results confirming?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.1.4</td>
                                            <td>Are the under test environmental monitoring samples confirming?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.1.5</td>
                                            <td>Were the entry and exit procedures to the clean room / controlled rooms followed as per SOP? ( by all personnel )</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td class="flex text-center">5.1.6</td>
                                            <td>Was the HEPA filter integrity of the area found Satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Disinfectant Details: </div>
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
                                        <tr>
                                            <td class="flex text-center">6.1</td>
                                            <td>Was the area disinfection done as per schedule? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.1</td>
                                            <td>Is the disinfectant used approved?</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.2</td>
                                            <td>Is the concentration in which disinfectant used certified for efficacy?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.3</td>
                                            <td>Name of the disinfectant used?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">6.1.4</td>
                                            <td>Was the disinfectant prepared correctly?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">6.1.5</td>
                                            <td>Was cleaning done during operations?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.6</td>
                                            <td>Was area fumigation done as per schedule?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.7</td>
                                            <td>Was the concentration in which fumigant used is correct?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                 <tr>
                                                <td class="flex text-center">6.1.8</td>
                                                <td>Were there any spillages in the area?</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                                <td>
                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                                </td>


                                        </tr>



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
                                        <tr>
                                            <td class="flex text-center">7.1</td>
                                            <td>Was there any malfunctioning of autoclave observed ? verify the qualification and requalification of steam sterilizer? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.1.1</td>
                                            <td>Autoclave ID No:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.1.2</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2</td>
                                            <td>Was there any powewr supply failure noted during analysis?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">7.3</td>
                                            <td>Was incubators used is qualified Incubators ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">7.3.1</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td class="flex text-center">7.3.2</td>
                                            <td>Any events associated with incubators, when the samples under incubation.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.3.3</td>
                                            <td>Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>
                        {{-- <small class="text-primary">
                                    If Yes, attach details
                                </small> --}}
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach"></div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cis[]"
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


        <div id="CCForm20" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Training records Analyst Involved in Testing
                </div>
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
                                        <tr>
                                            <td class="flex text-center">1.1</td>
                                            <td>Is the analyst trained on respective procedures ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2</td>
                                            <td>Was the analyst qualified for testing?</td>
                                            <td>
                                            <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2.1</td>
                                            <td> Date of qualification:</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3</td>
                                            <td>Was the analyst trained on entry exit /procedure?
                                            </td>
                                            <td>
                                            <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3.1</td>
                                            <td>SOP No.& Trained On</td>
                                            <td>
                                            <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4</td>
                                            <td>Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?</td>
                                            <td>
                                            <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4.1</td>
                                            <td>Was the analyst followed gowning procedure ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.5</td>
                                            <td>Was analyst performed colony counting correctly ?</td>
                                            <td>
                                            <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of sampling and Transportation procedures </div>
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
                                        <tr>
                                            <td class="flex text-center">2.1</td>
                                            <td>Name of the sampler :</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Was the sampling followed approved procedure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2.1</td>
                                            <td>Reference procedure No.& Trained on</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3</td>
                                            <td>Were clean and sterile sampling accessories used for sampling?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3.1</td>
                                            <td>Used before date:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">2.4</td>
                                            <td>Was the sampling area cleaned on day of sampling ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">2.4.1</td>
                                            <td>Name of the disinfectant used for cleaning?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4.2</td>
                                            <td>When was the last cleaning date from date of sampling ?</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4.3</td>
                                            <td>Was the cleaning operator trained on the cleaning procedure ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.5</td>
                                            <td>Was the sample collected in desired container and transported as per approved procedure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.6</td>
                                            <td>Was there any discrepancy observed during sampling ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.7</td>
                                            <td>Did the samples transfer to the lab within time?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.8</td>
                                            <td>Were samples stored as per storage requirements specified in specifications/procedure?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.9</td>
                                            <td>Was there any maintenance work carried out before or during sampling in sampling area?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>




                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Test Method & procedure: </div>
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
                                        <tr>
                                            <td class="flex text-center">3.1</td>
                                            <td>Was correct applicable specification/Test procedure/MOA/ SOP used for analysis ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.1</td>
                                            <td>Verified specification/Test procedure/MOA No/SOP No.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.1.2</td>
                                            <td>Was the test procedure mentioned in specification/analytical procedure validated w.r.t. product concentration ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.3</td>
                                            <td>Was method used during testing evaluated with respect to method validation and historical data and found satisfactory?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.1.4</td>
                                            <td>Was negative control of the test procedure found satisfactory ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.5</td>
                                            <td>Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.6</td>
                                            <td>Were the sample tested transferred and incubated at desired temp.as per approved procedure ?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="flex text-center">3.1.7</td>
                                            <td>Were the test samples results observed within the valid time?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.8</td>
                                            <td>Were colonies counted correctly?
                                            </td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.9</td>
                                            <td>Was correct formula, dilution factor used for calculation of results?
                                            </td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.1.10</td>
                                            <td>Was the interpretation of test result done correct?
                                            </td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of microbial isolates /Contamination </div>
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
                                        <tr>
                                            <td class="flex text-center">4.1</td>
                                            <td>Were the contaminants/ isolates subculture?
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Attach the colony morphology details:
                                            </td>
                                            <td>

                                                <div class="group-input">

                                                    <div class="file-attachment-field">
                                                        <div style="width: 170px; height: 30px; border: 2px solid black; position: relative; top: 17px; left:27px; border-radius: 5px;"
                                                        id="file_attach "></div>
                                                        <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                            <div>Add</div>
                                                            <input type="file" id="myfile" name="file_attach[]"
                                                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                        </div>
                                                    </div>

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.2</td>
                                            <td>Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.3</td>
                                            <td>Gram nature of the organism (GP/GN)</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.4</td>
                                            <td>(Attach the details, if more than single organism)</td>
                                            <td>

                                                <div class="group-input">

                                                    <div class="file-attachment-field">
                                                        <div style="width: 170px; height: 30px; border: 2px solid black; position: relative; top: 17px; left:27px; border-radius: 5px;"
                                                        id="file_attach "></div>
                                                        <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                            <div>Add</div>
                                                            <input type="file" id="myfile" name="file_attach[]"
                                                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                        </div>
                                                    </div>

                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2</td>
                                            <td>Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Media preparation, RTU media and Test Accessories </div>
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
                                        <tr>
                                            <td class="flex text-center">5.1</td>
                                            <td>Name of the media used in the analysis :</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.1</td>
                                            <td>Review of the media COA</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.2</td>
                                            <td>Date of media preparation</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.3</td>
                                            <td>Lot No .</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.4</td>
                                            <td>Use before date</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.5</td>
                                            <td>Was GPT of the media complied for its acceptance criteria ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.6</td>
                                            <td>Was valid culture use in GPT of media?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.7</td>
                                            <td>Any events noticed with the same media used in other tests? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.2</td>
                                            <td>Was the media sterilized and sterilization cycle found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.2.1</td>
                                            <td>Sterilization cycle No?</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.3</td>
                                            <td>Whether gloves used during testing were within the expiry date?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.4</td>
                                            <td>Did the analyst use clean/sterilized garments during testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5</td>
                                            <td>Rinsing fluid /diluents used for testing:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.1</td>
                                            <td>Were rinsing fluid/diluents used for testing:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.2</td>
                                            <td>Were rinsing fluid /diluents used for testing within the validity?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.3</td>
                                            <td>Date of preparation or manufacturing :</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>

                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.4</td>
                                            <td>Were the diluting or rinsing fluids visually inspected for any contamination before testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.5</td>
                                            <td>Lot number of diluents:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.5.6</td>
                                            <td>Use before date:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.6</td>
                                            <td>Type of filter used in filter testing:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.6.1</td>
                                            <td>Use before date of filter:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.6.2</td>
                                            <td>Lot number of filter:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.6.3</td>
                                            <td>Was sanitization filter assembly performed before execution of the testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.6.4</td>
                                            <td>Were the filtration assembly and filtration cups sterilized?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.7</td>
                                            <td>Whether sterilized pettriplates used for testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.7.1</td>
                                            <td>Lot No./Batch No of petriplates:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.8</td>
                                            <td>Was temp. of media while pouring monitored and found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.9</td>
                                            <td>Was any microbial cultures handled in BSC/LAF prior to testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Environmental condition in the testing area :</div>
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
                                        <tr>
                                            <td class="flex text-center">6.1</td>
                                            <td>Was temp. of testing area within limit during testing ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.1</td>
                                            <td>Was differential pressure of the area within the limit ?</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.2</td>
                                            <td>Were was Environmental monitoring (Microbial) results of the LAF/BSC and its surrounding area, with in  the limit on the day of  testing and prior to the testing</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.1.3</td>
                                            <td>Was there any maintenance work performed in the testing area prior to the testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.2</td>
                                            <td>Was recovered isolate reviewed for its occurrence in the past, source, frequency and control taken against the isolate?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.3</td>
                                            <td>Were measures established and implemented to prevent contamination from personnel, material during testing reviewed and found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Instrument/Equipment:</div>
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
                                        <tr>
                                            <td class="flex text-center">7.1</td>
                                            <td>Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2</td>
                                            <td>Autoclave :ID No</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.1</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.2</td>
                                            <td>BSC/LAF ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.3</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.4</td>
                                            <td>Incubator :ID No.</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.5</td>
                                            <td>Was temp. of incubator with in the limit during incubation period?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.6</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2.7</td>
                                            <td>Was the BSC/LAF cleaned prior to testing?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.3</td>
                                            <td>Was HVAC system of testing area qualified ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.3.1</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.4</td>
                                            <td>Was there any power failure during analysis ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.4.1</td>
                                            <td>Any events associated with incubators, when the samples under incubation?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.5</td>
                                            <td>Pipettes ID:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.5.1</td>
                                            <td>Calibration date and Next due date:</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                            </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Disinfectant Details:</div>
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
                                        <tr>
                                            <td class="flex text-center">8 .1</td>
                                            <td>Name of the disinfectant used for area cleaning </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8.2</td>
                                            <td>Was the disinfectant used for cleaning and sanitization validated?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8.2.1</td>
                                            <td>Concentration:</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8.3</td>
                                            <td>Was the disinfectant prepared as per validated concentration? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>
                        {{-- <small class="text-primary">
                                    If Yes, attach details
                                </small> --}}
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="file_attach"></div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cimlbwt[]"
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


        <div id="CCForm21" class="inner-block cctabcontent">

            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of Training records Analyst Involved in Testing

                </div>

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

                                        <tr>

                                            <td class="flex text-center">1.1</td>

                                            <td>Was analyst trained on testing procedure ?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">1.2</td>

                                            <td>Was the analyst qualified for testing?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">1.2.1</td>

                                            <td>Date of qualification:

                                            </td>

                                            <td>

                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="date"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>



                                                </div>

                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



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

                                        <tr>

                                            <td class="flex text-center">2.1</td>

                                            <td>Was intact samples /sample container received in lab?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">2.2</td>

                                            <td>Was it verified by sample receipt persons at the time of receipt in lab?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">2.3</td>

                                            <td>Was the sample collected in desired container and transported as per approved procedure?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">2.4</td>

                                            <td>Was there any discrepancy observed during sampling?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">2.5</td>

                                            <td>Were sample stored as per storage requirements specified in specification/SOP?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of test methods & Procedures

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

                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.1</td>

                                            <td style="font-weight: normal;">Was correct applicable specification and method of analysis used for analysis?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.2</td>

                                            <td style="font-weight: normal;">MOA & specification number?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>



                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.3</td>

                                            <td style="font-weight: normal;">Were the results of the other samples analyzed on the same day/time satisfactory?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.4</td>

                                            <td style="font-weight: normal;">Was the samples pipetted or loaded in appropriate quantity?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.5</td>

                                            <td style="font-weight: normal;">Were the samples tested transferred and incubated at desired temperature as per approved procedure?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.6</td>

                                            <td style="font-weight: normal;">Were the tested samples results observed within the valid time?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                       <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.7</td>

                                            <td style="font-weight: normal;">Were zones /readings measured correctly?

                                                (Applicable for Antibiotics –Microbial Assay)



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                       <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">3.8</td>

                                            <td style="font-weight: normal;">Was formula, dilution factors used for calculation of results corrected ?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



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

                                        <tr>

                                            <td class="flex text-center">4.1</td>

                                            <td>Name of the media used in the analysis :</td>

                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                            </div>


                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.1</td>

                                            <td>Did the COA of the media review and found satisfactory ?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.2</td>

                                            <td>Date of media preparation:</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="date"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.3</td>

                                            <td>Lot No.</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.4</td>

                                            <td>Use before date :</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="date"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.5</td>

                                            <td>Did appropriate size wells prepare in the media plates ?

                                                (Applicable for Antibiotics –Microbial Assay)

                                                </td>

                                                <td>



                                                    <div

                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                        <select name="response" id="response"

                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                            <option value="Yes">Select an Option</option>

                                                            <option value="Yes">Yes</option>

                                                            <option value="No">No</option>

                                                            <option value="N/A">N/A</option>

                                                        </select>

                                                    </div>





                                                </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.6</td>

                                            <td>Was the media sterilization and sanitization cycle found satisfactory?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.7</td>

                                            <td>Validated load pattern references documents No. </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.8</td>

                                            <td>Was any contamination observed in test media /Buffers /Standard solution?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.9</td>

                                            <td>Was appropriate and cleaned glasswares used for testing? </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.1.10</td>

                                            <td>Whether the volumetric flask calibrated?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2</td>

                                            <td>References standard lot No./Batch No? </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.1</td>

                                            <td>Reference standard expiry date?</td>

                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                            </div>


                                               </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.2</td>

                                            <td>Were the challenged samples stored in appropriate storage condition ?



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.3</td>

                                            <td>Was the standard weighty accurately as mentioned in test procedure?



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.4</td>

                                            <td>Was the standard weighty accurately as mentioned in test procedure?</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.5</td>

                                            <td>Any event observed with the references standard of the same batch ?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.2.6</td>

                                            <td>Was the working standard prepared with appropriate dilutions?



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td class="flex text-center">4.2.7</td>

                                            <td>Date of preparation :

                                                </td>

                                                <td>
                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>

                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td class="flex text-center">4.2.8</td>

                                            <td>Use before date :



                                            </td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>



                                        <tr>

                                            <td class="flex text-center">4.3</td>

                                            <td>Were sterilized petriplates used for testing ?

                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.3.1</td>

                                            <td>Lot/Batch No. of petriplates



                                            </td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.3.2</td>

                                            <td>Size of the petriplates



                                            </td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.4</td>

                                            <td>Size of the petriplates



                                            </td>

                                             <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.5</td>

                                            <td>Dilutor prepared on:



                                            </td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    </div>




                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.5.1</td>

                                            <td>Validity time of the dilutor:



                                            </td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">4.5.2</td>

                                            <td>Used on:

                                            </td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>





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

                                        <tr>

                                            <td class="flex text-center">5.1</td>

                                            <td>Name of the test organism used: </td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">5.1.1</td>

                                            <td>Passage No.</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">5.2</td>

                                            <td>Whether the culture suspension was prepared from valid source (Slant/Cryo vails)?

                                            </td>



                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">5.3</td>

                                            <td>Was the culture suspension used within the valid time? </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">5.4</td>

                                            <td>Was appropriate quantity of the inoculum challenged in the product?

                                            </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">5.5</td>

                                            <td>Was the stock/test culture dilution store as per recommended condition before used

                                            </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>







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

                                        <tr>

                                            <td class="flex text-center">6.1</td>

                                            <td>Was observed temp. of the area within limit </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                       <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">6.1.1</td>

                                            <td>Was differential pressure of the area within limit:



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>






                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">6.2</td>

                                            <td>Was viable environmental monitoring results of LAF /BSC (used for testing) found within limit?

                                            </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">6.2.1</td>

                                            <td>LAF/BSC ID:</td>

                                                <td>
                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>



                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>





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

                                        <tr>

                                            <td class="flex text-center">7.1</td>

                                            <td>Was there any malfunctioning of autoclave observed? verify the qualification and requalification of steam sterilizer?

                                                 </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.1.1</td>

                                            <td>Autoclave ID No:</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="number"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.1.2</td>

                                            <td>Qualification date and Next due date:

                                            </td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>




                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">7.2</td>

                                            <td>Was any Microbial cultures handled in BSC/LAF prior testing </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.1</td>

                                            <td>BSC/ULAF ID:</td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.2</td>

                                            <td>Did the equipment cleaned prior to testing?</td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.3</td>

                                            <td>Qualification date and Next due date:</td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.4</td>

                                            <td>Incubators ID:</td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.5</td>

                                            <td>Qualification date and Next due date:</td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.2.6</td>

                                            <td>Any events associated with incubators, when the samples under incubation.</td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>



                                        <tr>

                                            <td class="flex text-center">7.3</td>

                                            <td>Was there any power supply failure noted during analysis?</td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.4</td>

                                            <td>Pipette IDs</td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                            </div>




                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.4.1</td>

                                            <td>Calibration date & Next due date:</td>

                                                <td>



                                                    <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>



                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td class="flex text-center">7.5</td>

                                            <td>Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?

                                            </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>







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

                                        <tr>

                                            <td class="flex text-center">8.1</td>

                                            <td>Name of the disinfectant used for cleaning of testing area:

                                                 </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">8.1.1</td>

                                            <td>Was the disinfectant prepared as per validated concentration?



                                            </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <input type="text"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"/>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>



                                        </tr>

                                        <tr>

                                            <td class="flex text-center">8.1.2</td>

                                            <td>Use before date of the disinfectant used for cleaning:

                                            </td>

                                                <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="response" id="response"

                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                        <option value="Yes">Select an Option</option>

                                                        <option value="Yes">Yes</option>

                                                        <option value="No">No</option>

                                                        <option value="N/A">N/A</option>

                                                    </select>

                                                </div>





                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

                                                </div>

                                            </td>

                                        </tr>

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
        </div>



        <div id="CCForm22" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for review of Training records Analyst Involved in monitoring
                </div>
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
                                        <tr>
                                            <td class="flex text-center">1.1</td>
                                            <td>Is the analyst trained for Environmental monitoring ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.1</td>
                                            <td>Was the analyst qualified for Personnel qualification ? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.2</td>
                                            <td>Date of qualification:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3.1</td>
                                            <td>Was the analyst trained on entry exit /procedure/In production area or any monitoring area?
                                            </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3.2</td>
                                            <td>SOP No.:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4.1</td>
                                            <td>Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4.2</td>
                                            <td>Was the analyst followed gowning procedure properly?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.5</td>
                                            <td>Was analyst performed colony counting correctly ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for sample details:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">2.1</td>
                                            <td>Was the plate verified at the time of monitoring ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Was the plate transported as per approved procedure
                                            </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3</td>
                                            <td>Was the correct location ID & Room Name mentioned on plate exposed?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4</td>
                                            <td>What is the grade of plate exposed area ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.5</td>
                                            <td>Is area crossing Alert limit or action limit ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                    Checklist for comparison of results with other parameters:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">3.1</td>
                                            <td>Was any Excursions in other settle plate exposure ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.2</td>
                                            <td>Was any Excursions in other active air plate sampling?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.3</td>
                                            <td>Was any Excursions in surface monitoring? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.4</td>
                                            <td>Was any Excursions in personnel monitoring on same day?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.5</td>
                                            <td>Is results of next day monitoring within the acceptance ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.6</td>
                                            <td>Was negative control of the test procedure found satisfactory ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.7</td>
                                            <td>Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.8</td>
                                            <td>Were the plate transferred and incubated at desired temp.as per approved procedure ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for details of media dehydrated media used:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Name of media used for in the analysis:</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.2</td>
                                            <td>Did the COA of the media checked and found satisfactory?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.3</td>
                                            <td>Media Lot. No.</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.4</td>
                                            <td>Media Qualified date /Qualified By</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="flex text-center">4.1.5</td>
                                            <td>Media expiry date</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <select name="response" id="response"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    <option value="Yes">Select an Option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for media preparation details and sterilization :
                </div>
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
                                        <tr>
                                            <td class="flex text-center">5.1.1</td>
                                            <td>Date of media preparation</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.2</td>
                                            <td>Media Lot. No.</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.3</td>
                                            <td>Media prepared date </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.4</td>
                                            <td>Media expiry date</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.5</td>
                                            <td>Preincubation of media</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.6</td>
                                            <td>Was the media sterilized and sterilization cycle found satisfactory?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.7</td>
                                            <td>Sterilization cycle No.:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.8</td>
                                            <td>Were cycle sterilization parameters found satisfactory ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of environmental conditions in the testing area
                </div>
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
                                        <tr>
                                            <td class="flex text-center">6.1</td>
                                            <td>Is temperature of MLT testing area within the acceptance?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.2</td>
                                            <td>Was the differential pressure of the area with in limit ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.3</td>
                                            <td>While media plate preparation is LAF working satisfactory?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for disinfectant Details:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">7.1.1</td>
                                            <td>Name of the disinfectant used for area cleaning </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.1.2</td>
                                            <td>Was the disinfectant used for cleaning and sanitization validated?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.1.3</td>
                                            <td>Concentration:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.1.4</td>
                                            <td>Was the disinfectant prepared as per validated concentration?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for fogging details :
                </div>
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
                                        <tr>
                                            <td class="flex text-center">8.1.1</td>
                                            <td>Name of the fogging agents used for area fogging</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="flex text-center">8.1.2</td>
                                            <td>Was the fogging agent used for fogging and validated?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8.1.3</td>
                                            <td>Concentration:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">8.1.4</td>
                                            <td>Was the fogging agent prepared as per validated concentration? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Test Method & procedure:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">9.1.1</td>
                                            <td>Was the test method, monitoring SOP followed correctly? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">9.1.2</td>
                                            <td>SOP No.:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification)
                </div>
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
                                        <tr>
                                            <td class="flex text-center">10.1.1</td>
                                            <td>Were the contaminants/ isolates subculture? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10.1.2</td>
                                            <td>Attach the colony morphology details: </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10.1.3</td>
                                            <td>Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10.1.4</td>
                                            <td>Gram nature of the organism (GP/GN) </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10.1.5</td>
                                            <td>(Attach the details, if more than single organism) </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">10.2</td>
                                            <td>Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for review of Instrument/Equipment:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">11.1</td>
                                            <td>Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.1</td>
                                            <td>Is used incubators are qualified?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.2</td>
                                            <td>Incubator :ID No. </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.3</td>
                                            <td>Qualification date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.4</td>
                                            <td>Next due date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.5</td>
                                            <td>Is used Colony counter qualified? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.6</td>
                                            <td>Colony counter ID:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.7</td>
                                            <td>Qualification date: </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.8</td>
                                            <td>Next due date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.9</td>
                                            <td>Is used Air sampler qualified ? </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.10</td>
                                            <td>Air sampler ID</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="number" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.11</td>
                                            <td>Validation date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.12</td>
                                            <td>Next due date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.2.13</td>
                                            <td>Was temp. of incubator with in the limit during incubation period?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.3.1</td>
                                            <td>Was HVAC system of testing area qualified ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">11.3.2</td>
                                            <td>Qualification date and Next due date:</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-head">
                Checklist for trend Analysis:
                </div>
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
                                        <tr>
                                            <td class="flex text-center">12.1</td>
                                            <td>Is trend of current month within acceptance?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">12.2</td>
                                            <td>Is trend of previous month within acceptance?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">1.1</td>
                                            <td>Is the analyst trained/qualified GPT test procedure ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.1.1</td>
                                            <td>Date of qualification: </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                    </div>

                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2</td>
                                            <td>Were appropriate precaution taken by the analyst throughout the test ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.2.1</td>
                                            <td>alyst interview record.......
                                            </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>

                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.3</td>
                                            <td>Was an analyst persons suffering from any ailment such as cough/cold or open wound or skin infections?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">1.4</td>
                                            <td>Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">2.1</td>
                                            <td>Which media GPT performed at previous day :</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.2</td>
                                            <td>Were dehydrated and ready to use media used for GPT ?  </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.3</td>
                                            <td>Lot No./Batch No:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>

                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4</td>
                                            <td>Date /Time of Incubation:


                                            </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>

                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.4.1</td>
                                            <td>Date/Time of Release:
                                                </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.5</td>
                                            <td>Results of previous day GPT record?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">2.6</td>
                                            <td>Results of other plates released for GPT is within acceptance?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">3.1</td>
                                            <td>Is culture COA checked ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.2</td>
                                            <td>Was the correct Inoculum used for GPT?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.3</td>
                                            <td>Was used culture within culture due date?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.3.1</td>
                                            <td>Date of culture dilution:


                                            </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.3.2</td>
                                            <td>Due date of culture dilution:
                                                </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.4</td>
                                            <td>Was the storage condition of culture is appropriate ? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">3.5</td>
                                            <td>Was culture strength used within acceptance range?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">4.1</td>
                                            <td>Was the media sterilized and sterilization cycle found satisfactory?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.1.1</td>
                                            <td>Sterilization cycle No.:  </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">4.2</td>
                                            <td>Whether disposable sterilized gloves used during testing were within the expiry date?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                            <td class="flex text-center">2.6</td>
                                            <td>Results of other plates released for GPT is within acceptance?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">5.1</td>
                                            <td>Was the equipment used, calibrated/qualified and within the specified range? </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.1</td>
                                            <td>Biosafety equipment ID: </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.2</td>
                                            <td>Validation date:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.1.3</td>
                                            <td>Next due date:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.2</td>
                                            <td>Colony counter equipment ID:
                                                </td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.2.1</td>
                                            <td>Calibration date:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.3</td>
                                            <td>Was used pipettes within calibration ?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.3.1</td>
                                            <td>Pipettes ID:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.3.2</td>
                                            <td>Calibration date</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.4</td>
                                            <td>Was the refrigerator used for storage of culture is validated?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.4.1</td>
                                            <td>Refrigerator (2-8̊ C) ID:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">5.4.2</td>
                                            <td>Validation date:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="flex text-center">5.5</td>
                                            <td>Incubator ID:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="number"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.5.1</td>
                                            <td>Validation date and next due date:</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="date"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.6</td>
                                            <td>Was there any power failure noticed during the incubation of samples in the heating block?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.7</td>
                                            <td>Were any other media GPT tested along with this sample?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr> <tr>
                                            <td class="flex text-center">5.7.1</td>
                                            <td>If yes, whether those media GPT results found satisfactory? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td class="flex text-center">6.1</td>
                                            <td>Name of the disinfectant used for area cleaning </td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.2</td>
                                            <td>Was the disinfectant used for cleaning and sanitization validated? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.2.1</td>
                                            <td>Concentration:</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex text-center">6.3</td>
                                            <td>Was the disinfectant prepared as per validated concentration?


                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>

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
                                        <tr>
                                            <td class="flex text-center">7.1</td>
                                            <td>Were results taken properly ?</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.2</td>
                                            <td>Raw data checked ? </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="flex text-center">7.3</td>
                                            <td>Was formula dilution factor used for calculating the results corrected?</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="response" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>


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
@endsection
