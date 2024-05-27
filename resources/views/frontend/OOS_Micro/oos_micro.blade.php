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
                                <label disabled for="Short Description">Division Code<span class="text-danger"></span></label>
                                <input disabled type="text" name="division_code_gi"
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
                                <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date_gi">
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date_gi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"> Due Date
                                </label>

                                <small class="text-primary">
                                    Please mention expected date of completion
                                </small>
                                <input type="date" id="date" name="due_date_gi">

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
                                <select name="is_is_repeat_gi_gi"
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
                                    <option></option>
                                    {{-- <option>Lab Incident</option>
                                        <option>Deviation</option>
                                        <option>Product Non-conformance</option>
                                        <option>Inspectional Observation</option>
                                        <option>Others</option>  --}}

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
                                                                <option value="Yes">Select an Option</option>
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
@php
    $phase_II_OOS_investigations = [
    "Is correct batch manufacturing record used?",
    "Correct quantities of correct ingredients were used in manufacturing?",
    "Balances used in dispensing / verification were calibrated using valid standard weights?",
    "Equipment used in the manufacturing is as per batch manufacturing record?",
    "Processing steps followed in correct sequence as per the BMR?",
    "Whether material used in the batch had any OOS result?",
    "All the processing parameters were within the range specified in BMR?",
    "Environmental conditions during manufacturing are as per BMR?",
    "Whether there was any deviation observed during manufacturing?",
    "The yields at different stages were within the acceptable range as per BMR?",
    "All the equipment’s used during manufacturing are calibrated?",
    "Whether there is malfunctioning or breakdown of equipment during manufacturing?",
    "Whether the processing equipment was maintained as per preventive maintenance schedule?",
    "All the in process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
    "Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
    "Whether other batches/products impacted?",
    "Any Other"
];
@endphp
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
                                    @foreach ($phase_II_OOS_investigations as $phase_II_OOS_investigation )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$phase_II_OOS_investigation}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="phase_II_OOS_investigation[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="phase_II_OOS_investigation[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
@php
    $check_analyst_training_procedures=[
                "Is the analyst trained/qualified BET test procedure?",
                "Reference procedure number :-",
                "Effective date",
                "Date of qualification:",
                "Were appropriate precaution taken by the analyst throughout the test?",
                "Analyst interview record",
                "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections?",
                "Analyst interview record",
                "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?"
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
                                    @foreach ($check_analyst_training_procedures as $check_analyst_training_procedure )
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$check_analyst_training_procedure}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="analyst_training_proce[{{$loop->index}}][response]" id="response"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                        </div>
                                                 </td>
                                                <td>
                                                   <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="analyst_training_proce[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist for Sample receiving & verification in lab : </div>
                        @php
                            $sample_receiving_verifications = [
                        "Was the sample container (Physical integrity) verified at the time of sample receipt?",
                        "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
                        "Was the correct quantity of the sample withdrawn?",
                        "Was there any discrepancy observed during sampling?",
                        "Was the sample container (Physical integrity) checked before testing?"
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
                                        @foreach ($sample_receiving_verifications as $sample_receiving_verification)
                                       <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$sample_receiving_verification}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="sample_receiving_verification_lab[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="sample_receiving_verification_lab[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist for Method/Procedure used during analysis: </div>
                     @php
                        $method_procedure_used_during_anas =  [
                            ['question' => "Was correct applicable specification/Test procedure/MOA used for analysis?", 'input_type' => 'select'],
                            ['question' => "Verified specification/Test procedure/MOA No.", 'input_type' => 'number'],
                            ['question' => "Was the test procedure followed as per method validation?", 'input_type' => 'text'],
                            ['question' => "Was there any change in the validated change method? If yes, was test performed with the new validated method?", 'input_type' => 'text'],
                            ['question' => "Was BET reagents (Lysate, CSE, LRW and Buffer) procured from the approved vendor?", 'input_type' => 'text'],
                            ['question' => "Was lysate and CSE stored at the recommended temperature and duration? Storage condition:", 'input_type' => 'text'],
                            ['question' => "Were all product/reagents contact parts of BET testing (Tips/Accessories/Sample Container) depyrogenated?", 'input_type' => 'text'],
                            ['question' => "Assay tube/Batch No.", 'input_type' => 'number'],
                            ['question' => "Expiry date:", 'input_type' => 'date'],
                            ['question' => "Tip lot/Batch No.", 'input_type' => 'number'],
                            ['question' => "Expiry date:", 'input_type' => 'date'],
                            ['question' => "Was the test done at correct MVD as per validated method?", 'input_type' => 'text'],
                            ['question' => "Were calculations of MVD/Test dilution done correctly?", 'input_type' => 'text'],
                            ['question' => "Were correct dilutions prepared?", 'input_type' => 'text'],
                            ['question' => "Was labeled claim lysate sensitivity checked before the use of the lot?", 'input_type' => 'text'],
                            ['question' => "Were all reagents (LRW/CSE and Lysate) used in the test within the expiry?", 'input_type' => 'text'],
                            ['question' => "LRW expiry date?", 'input_type' => 'date'],
                            ['question' => "CSE expiry date?", 'input_type' => 'date'],
                            ['question' => "Lysate expiry date?", 'input_type' => 'date'],
                            ['question' => "Buffer expiry date?", 'input_type' => 'date'],
                            ['question' => "Was рН of the test sample/dilution verified?", 'input_type' => 'text'],
                            ['question' => "Were appropriate рН strip/measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?", 'input_type' => 'text'],
                            ['question' => "Were proper incubation conditions followed?", 'input_type' => 'text'],
                            ['question' => "Was there any spillage that occurred during the vortexing of dilutions?", 'input_type' => 'text'],
                            ['question' => "Were the results of positive, negative, and test controls found satisfactory?", 'input_type' => 'text'],
                            ['question' => "Is the test incubator/heating block kept on a vibration-free surface?", 'input_type' => 'text'],
                            ['question' => "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:", 'input_type' => 'text']
                            
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
                                        @foreach ($method_procedure_used_during_anas as $index => $method_procedure_used_during_ana)
                                           <tr>
                                            <td class="flex text-center">{{ $loop->index+1 }}</td>
                                            <td>{{$method_procedure_used_during_ana['question']}}
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="method_procedure_used_during_analysis[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="method_procedure_used_during_analysis[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist for Instrument/Equipment Details:</div>
                            @php
                            $Instrument_Equipment_Details = [
                            "Was the equipment used, calibrated/qualified and within the specified range?",
                            "Dry block /Heating block equipment ID:",
                            "Calibration date & Next due date:",
                            "Pipettes ID:",
                            "Calibration date and Next due date:",
                            "Refrigerator (2-8̊ C) ID:",
                            "Validation date and next due date:",
                            "Dehydrogenation over ID:",
                            "Validation date and next due date:",
                            "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
                            "Was the depyrogenation done as per the validated load pattern?",
                            "Was there any power failure noticed during the incubation of samples in the heating block?",
                            "Was assay tubes incubated in the dry block (time and temp) as specified in the procedure?",
                            "Were any other samples tested along with this sample?",
                            "If yes, were those sample’s results found satisfactory?",
                            "Were any other samples analyzed at the same time on the same instruments?",
                            "If yes, what were the results of other Batches?"
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
                                        @foreach ($Instrument_Equipment_Details as $Instrument_Equipment_Detail )
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Instrument_Equipment_Detail}}
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Instrument_Equipment_Det[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Instrument_Equipment_Det[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist for Results and Calculation : </div>
@php  
    $Results_and_Calculations = [
  "Were results taken properly?",
  "Raw data checked By:",
  "Was formula dilution factor used for calculating the results correct?"
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
                                        @foreach ($Results_and_Calculations as $Results_and_Calculation )
                                         <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Results_and_Calculation}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Results_and_Calculat[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Results_and_Calculat[{{$loop->index}}][response]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            @php
                                $Training_records_Analyst_Involveds = [
                              "Was analyst trained on testing procedure?",
                              "Date of training:",
                              "Was the analyst qualified for testing?",
                              "Date of qualification:",
                              "Were the personnel in perfect health without any open injury or infection?",
                              "Were the entry and exit procedures to the respective production area followed as per SOP?"
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
                                        @foreach ($Training_records_Analyst_Involveds as $Training_records_Analyst_Involved )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Training_records_Analyst_Involved}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Training_records_Analyst_Involved[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Training_records_Analyst_Involved[{{$loop->index}}][response]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                      "Was intact samples/sample container received in lab?",
                      "Was it verified by sample receipt persons at the time of receipt in lab?",
                      "Was the sample collected in desired container and transported as per approved procedure?",
                      "Was there any discrepancy observed during sampling?",
                      "Any remark notified in sample request form?",
                      "Were samples stored as per storage requirements specified in specification/SOP?"
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
                                        @foreach ($sample_intactness_before_analysis as $sample_intactness_before_analys )


                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$sample_intactness_before_analys}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="sample_intactness_before_analysis[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="sample_intactness_before_analysis[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Review of test methods & Procedures </div>
                                @php
                                    $test_methods_Procedures =  [
                                  "Was correct applicable specification and method of analysis used for analysis?",
                                  "MOA & specification number?",
                                  "Were the results of the other samples analyzed on the same day/time satisfactory?",
                                  "Were the samples tested transferred and incubated at desired temperature as per approved procedure?",
                                  "Were the tested samples results observed within the valid time?"
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
                                        @foreach ($test_methods_Procedures as $test_methods_Procedure)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$test_methods_Procedure}}
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="test_methods_Procedure[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="test_methods_Procedure[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Review of Media, Buffer, Standards preparation & test accessories </div>
                            @php
                                $Review_of_Media_Buffer_Standards_prepar = [
                              "Name of the media used in the analysis:",
                              "Did the COA of the media review and found satisfactory?",
                              "Date of media preparation:",
                              "Lot No.",
                              "Use before date:",
                              "Was the media sterilization and sanitization cycle found satisfactory?",
                              "Validated load pattern references documents No.",
                              "Was any contamination observed in test media/diluents?",
                              "Was appropriate and cleaned and sterilized glassware used for testing?",
                              "Are the negative controls still confirming?",
                              "Is the growth promotion test for the media confirming?"
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
                                        @foreach ($Review_of_Media_Buffer_Standards_prepar as $Review_of_Media_Buffer_Standards_prep )
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Review_of_Media_Buffer_Standards_prep}}
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                    $Checklist_for_Revi_of_Media_Buffer_Stand_preps=[
                                  "Were the environmental conditions during testing as per the conditions specified?",
                                  "Was the Temperature of the area within the limit?",
                                  "Pressure differentials of the area within the limit?",
                                  "Were the other types of monitoring results confirming?",
                                  "Are the under test environmental monitoring samples confirming?",
                                  "Were the entry and exit procedures to the clean room / controlled rooms followed as per SOP? (by all personnel)",
                                  "Was the HEPA filter integrity of the area found satisfactory?"
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
                                        @foreach ($Checklist_for_Revi_of_Media_Buffer_Stand_preps as $Checklist_for_Revi_of_Media_Buffer_Stand_prep )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index}}</td>
                                            <td>{{$Checklist_for_Revi_of_Media_Buffer_Stand_prep}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist for Disinfectant Details: </div>
@php
    $check_for_disinfectant_details=[
  "Was the area disinfection done as per schedule?",
  "Is the disinfectant used approved?",
  "Is the concentration in which disinfectant used certified for efficacy?",
  "Name of the disinfectant used?",
  "Was the disinfectant prepared correctly?",
  "Was cleaning done during operations?",
  "Was area fumigation done as per schedule?",
  "Was the concentration in which fumigant used correct?",
  "Were there any spillages in the area?"
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
                                        @foreach ($check_for_disinfectant_details as $check_for_disinfectant_detail )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index}}</td>
                                            <td>{{$check_for_disinfectant_detail}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="check_for_disinfectant_detail[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="check_for_disinfectant_detail[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
    $Checklist_for_Review_of_instrument_equips = [
  "Was there any malfunctioning of autoclave observed? Verify the qualification and requalification of steam sterilizer?",
  "Autoclave ID No:",
  "Qualification date and Next due date:",
  "Was there any power supply failure noted during analysis?",
  "Was incubators used is qualified Incubators ID:",
  "Qualification date and Next due date:",
  "Any events associated with incubators, when the samples under incubation.",
  "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause this failure?"
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
                                        @foreach ($Checklist_for_Review_of_instrument_equips as $Checklist_for_Review_of_instrument_equip )
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_for_Review_of_instrument_equip}} </td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][response]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    @php
                        $Checklist_for_Review_of_Training_records_Analysts =[
                    "Is the analyst trained on respective procedures?",
                    "Was the analyst qualified for testing?",
                    "Date of qualification:",
                    "Was the analyst trained on entry exit /procedure?",
                    "SOP No.& Trained On",
                    "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
                    "Was the analyst followed gowning procedure?",
                    "Was analyst performed colony counting correctly?"
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
                                        @foreach ($Checklist_for_Review_of_Training_records_Analysts as $Checklist_for_Review_of_Training_records_Analyst)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_for_Review_of_Training_records_Analyst}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                Checklist for Review of sampling and Transportation procedures </div>
                    @php
                        $Checklist_for_Review_of_sampling_and_Transports = [
                    "Name of the sampler:",
                    "Was the sampling followed approved procedure?",
                    "Reference procedure No. & Trained on",
                    "Were clean and sterile sampling accessories used for sampling?",
                    "Used before date:",
                    "Was the sampling area cleaned on day of sampling?",
                    "Name of the disinfectant used for cleaning?",
                    "When was the last cleaning date from date of sampling?",
                    "Was the cleaning operator trained on the cleaning procedure?",
                    "Was the sample collected in desired container and transported as per approved procedure?",
                    "Was there any discrepancy observed during sampling?",
                    "Did the samples transfer to the lab within time?",
                    "Were samples stored as per storage requirements specified in specifications/procedure?",
                    "Was there any maintenance work carried out before or during sampling in sampling area?"
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
                                        @foreach ($Checklist_for_Review_of_sampling_and_Transports as $Checklist_for_Review_of_sampling_and_Transport )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_for_Review_of_sampling_and_Transport}}</td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text" name="Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][response]"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                Checklist for Review of Test Method & procedure: </div>
                    @php
                        $Checklist_Review_of_Test_Method_proceds = [
                    "Was correct applicable specification/Test procedure/MOA/SOP used for analysis?",
                    "Verified specification/Test procedure/MOA No/SOP No.",
                    "Was the test procedure mentioned in specification/analytical procedure validated w.r.t. product concentration?",
                    "Was method used during testing evaluated with respect to method validation and historical data and found satisfactory?",
                    "Was negative control of the test procedure found satisfactory?",
                    "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
                    "Were the sample tested transferred and incubated at desired temp. as per approved procedure?",
                    "Were the test samples results observed within the valid time?",
                    "Were colonies counted correctly?",
                    "Was correct formula, dilution factor used for calculation of results?",
                    "Was the interpretation of test result done correct?"
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
                                        @foreach ($Checklist_Review_of_Test_Method_proceds as $Checklist_Review_of_Test_Method_proced)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_Review_of_Test_Method_proced}}
                                            </td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Checklist_Review_of_Test_Method_proced[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Checklist_Review_of_Test_Method_proced[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        @php
                            $Checklist_for_Review_Media_prepara_RTU_medias = [
                        "Name of the media used in the analysis:",
                        "Review of the media COA",
                        "Date of media preparation",
                        "Lot No.",
                        "Use before date",
                        "Was GPT of the media complied for its acceptance criteria?",
                        "Was valid culture use in GPT of media?",
                        "Any events noticed with the same media used in other tests?",
                        "Was the media sterilized and sterilization cycle found satisfactory?",
                        "Sterilization cycle No?",
                        "Whether gloves used during testing were within the expiry date?",
                        "Did the analyst use clean/sterilized garments during testing?",
                        "Rinsing fluid/diluents used for testing:",
                        "Were rinsing fluid/diluents used for testing:",
                        "Were rinsing fluid/diluents used for testing within the validity?",
                        "Date of preparation or manufacturing:",
                        "Were the diluting or rinsing fluids visually inspected for any contamination before testing?",
                        "Lot number of diluents:",
                        "Use before date:",
                        "Type of filter used in filter testing:",
                        "Use before date of filter:",
                        "Lot number of filter:",
                        "Was sanitization filter assembly performed before execution of the testing?",
                        "Were the filtration assembly and filtration cups sterilized?",
                        "Whether sterilized petri plates used for testing?",
                        "Lot No./Batch No of petri plates:",
                        "Was temp. of media while pouring monitored and found satisfactory?",
                        "Was any microbial cultures handled in BSC/LAF prior to testing?"
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
                                        @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $Checklist_for_Review_Media_prepara_RTU_media )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_for_Review_Media_prepara_RTU_media}}</td>
                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text" name="Checklist_for_Review_Media_prepara_RTU_media[{{$loop->index}}][response]"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_Media_prepara_RTU_media[{{$loop->index}}][response]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                Checklist for Review of Environmental condition in the testing area :</div>
                    @php
                        $Checklist_Review_Environment_condition_in_tests = [
                    "Was temp. of testing area within limit during testing?",
                    "Was differential pressure of the area within the limit?",
                    "Were Environmental monitoring (Microbial) results of the LAF/BSC and its surrounding area within the limit on the day of testing and prior to the testing?",
                    "Was there any maintenance work performed in the testing area prior to the testing?",
                    "Was recovered isolate reviewed for its occurrence in the past, source, frequency and control taken against the isolate?",
                    "Were measures established and implemented to prevent contamination from personnel, material during testing reviewed and found satisfactory?"
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
                                        @foreach ($Checklist_Review_Environment_condition_in_tests as $Checklist_Review_Environment_condition_in_test )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Checklist_Review_Environment_condition_in_test}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Checklist_Review_Environment_condition_in_test[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="Checklist_Review_Environment_condition_in_test[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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

                <div class="inner-block-content">
                <div class="sub-head">
                Checklist for Review of Instrument/Equipment:</div>
                    @php
                        $review_of_instrument_bioburden_and_waters =[

                        "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
                        "Autoclave :ID No",
                        "Qualification date and Next due date:",
                        "BSC/LAF ID:",
                        "Qualification date and Next due date:",
                        "Incubator :ID No.",
                        "Was temp. of incubator with in the limit during incubation period?",
                        "Qualification date and Next due date:",
                        "Was the BSC/LAF cleaned prior to testing?",
                        "Was HVAC system of testing area qualified ?",
                        "Qualification date and Next due date:",
                        "Was there any power failure during analysis ?",
                        "Any events associated with incubators, when the samples under incubation?",
                        "Pipettes ID:",
                        "Calibration date and Next due date:"

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
                                        @foreach ( $review_of_instrument_bioburden_and_waters as $review_of_instrument_bioburden_and_water )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$review_of_instrument_bioburden_and_water}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        @endforeach

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
                    @php
                        $disinfectant_details_of_bioburden_and_water_tests = [
                        "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
                        "Autoclave :ID No",
                        "Qualification date and Next due date:",
                        "BSC/LAF ID:",
                        "Qualification date and Next due date:",
                        "Incubator :ID No.",
                        "Was temp. of incubator with in the limit during incubation period?",
                        "Qualification date and Next due date:",
                        "Was the BSC/LAF cleaned prior to testing?",
                        "Was HVAC system of testing area qualified?",
                        "Qualification date and Next due date:",
                        "Was there any power failure during analysis?",
                        "Any events associated with incubators, when the samples under incubation?",
                        "Pipettes ID:",
                        "Calibration date and Next due date:",
                        "Name of the disinfectant used for area cleaning",
                        "Was the disinfectant used for cleaning and sanitization validated?",
                        "Concentration:",
                        "Was the disinfectant prepared as per validated concentration?"
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
                                        @foreach ($disinfectant_details_of_bioburden_and_water_tests as $disinfectant_details_of_bioburden_and_water_test )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$disinfectant_details_of_bioburden_and_water_test}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="disinfectant_details_of_bioburden_and_water_test[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="disinfectant_details_of_bioburden_and_water_test[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    @php
                        $training_records_analyst_involvedIn_testing_microbial_asssays =[
                            "Was analyst trained on testing procedure ?",
                            "Was the analyst qualified for testing?",
                            "Date of qualification:",
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
                                        @foreach ($training_records_analyst_involvedIn_testing_microbial_asssays as $training_records_analyst_involvedIn_testing_microbial_asssay )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$training_records_analyst_involvedIn_testing_microbial_asssay}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][response]" id="response"

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

                                                    <textarea name="training_records_analyst_involvedIn_testing_microbial_asssay[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $sample_intactness_before_analysis=[
                        "Was intact samples /sample container received in lab?",
                        "Was it verified by sample receipt persons at the time of receipt in lab?",
                        "Was the sample collected in desired container and transported as per approved procedure?",
                        "Was there any discrepancy observed during sampling?",
                        "Were sample stored as per storage requirements specified in specification/SOP?"
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
                                        @foreach ($sample_intactness_before_analysis as $sample_intactness_before_analysi )

                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$sample_intactness_before_analysi}}</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="sample_intactness_before_analysis[{{$loop->index}}][response]" id="response"

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

                                                    <textarea name="sample_intactness_before_analysis[{{$loop->index}}][response]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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

            </div>



            <div class="inner-block-content">

                <div class="sub-head">

                    Checklist for Review of test methods & Procedures</div>
                        @php
                        $checklist_for_review_of_test_method_IMAs=[
                            "Was correct applicable specification and method of analysis used for analysis?",
                            "MOA & specification number?",
                            "Were the results of the other samples analyzed on the same day/time satisfactory?",
                            "Was the samples pipetted or loaded in appropriate quantity?",
                            "Were the samples tested transferred and incubated at desired temperature as per approved procedure?",
                            "Were the tested samples results observed within the valid time?",
                            "Were zones /readings measured correctly? (Applicable for Antibiotics –Microbial Assay)",
                            "Was formula, dilution factors used for calculation of results corrected?"
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
                                        @foreach ($checklist_for_review_of_test_method_IMAs as $checklist_for_review_of_test_method_IMA )


                                        <tr>

                                            <td style="font-weight: normal;" class="flex text-center">{{$loop->index+1}}</td>

                                            <td style="font-weight: normal;">{{$checklist_for_review_of_test_method_IMA}}

                                            </td>

                                            <td>



                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][response]" id="response"
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

                                                    <textarea name="checklist_for_review_of_test_method_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    "Name of the media used in the analysis:",
                    "Did the COA of the media review and found satisfactory?",
                    "Date of media preparation:",
                    "Lot No.",
                    "Use before date:",
                    "Did appropriate size wells prepare in the media plates? (Applicable for Antibiotics –Microbial Assay)",
                    "Was the media sterilization and sanitization cycle found satisfactory?",
                    "Validated load pattern references documents No.",
                    "Was any contamination observed in test media /Buffers /Standard solution?",
                    "Was appropriate and cleaned glasswares used for testing?",
                    "Whether the volumetric flask calibrated?",
                    "References standard lot No./Batch No?",
                    "Reference standard expiry date?",
                    "Were the challenged samples stored in appropriate storage condition?",
                    "Was the standard weighty accurately as mentioned in test procedure?",
                    "Was the standard weighty accurately as mentioned in test procedure?",
                    "Any event observed with the references standard of the same batch?",
                    "Was the working standard prepared with appropriate dilutions?",
                    "Date of preparation:",
                    "Use before date:",
                    "Were sterilized petriplates used for testing?",
                    "Lot/Batch No. of petriplates",
                    "Size of the petriplates",
                    "Size of the petriplates",
                    "Dilutor prepared on:",
                    "Validity time of the dilutor:",
                    "Used on:"
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
                                        @foreach ($cr_of_media_buffer_st_IMAs as $cr_of_media_buffer_st_IMA)


                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$cr_of_media_buffer_st_IMA}}</td>

                                            <td>
                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text" name="cr_of_media_buffer_st_IMA[{{$loop->index}}][response]"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                            </div>


                                            </td>

                                            <td>

                                                 <div

                                                    style="margin: auto; display: flex; justify-content: center;">

                                                    <textarea name="cr_of_media_buffer_st_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $CR_of_microbial_cultures_inoculation_IMAs=[
                        "Name of the test organism used:",
                        "Passage No.",
                        "Whether the culture suspension was prepared from valid source (Slant/Cryo vails)?",
                        "Was the culture suspension used within the valid time?",
                        "Was appropriate quantity of the inoculum challenged in the product?",
                        "Was the stock/test culture dilution store as per recommended condition before used"
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
                                        @foreach ($CR_of_microbial_cultures_inoculation_IMAs as $CR_of_microbial_cultures_inoculation_IMA )


                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$CR_of_microbial_cultures_inoculation_IMA}}</td>

                                            <td>



                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text" name="CR_of_microbial_cultures_inoculation_IMA[{{$loop->index}}][response]"
                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>
                                            </td>
                                            <td>
                                                 <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_microbial_cultures_inoculation_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $CR_of_Environmental_condition_in_testing_IMAs= [
                        "Was observed temp. of the area within limit",
                        "Was differential pressure of the area within limit:",
                        "Was viable environmental monitoring results of LAF /BSC (used for testing) found within limit?",
                        "LAF/BSC ID:"
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
                                        @foreach ($CR_of_Environmental_condition_in_testing_IMAs as $CR_of_Environmental_condition_in_testing_IMA )

                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$CR_of_Environmental_condition_in_testing_IMA}}</td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][response]" id="response"

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
                                                    <textarea name="CR_of_Environmental_condition_in_testing_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                "Was there any malfunctioning of autoclave observed? verify the qualification and requalification of steam sterilizer?",
                                "Autoclave ID No:",
                                "Qualification date and Next due date:",
                                "Was any Microbial cultures handled in BSC/LAF prior testing",
                                "BSC/ULAF ID:",
                                "Did the equipment cleaned prior to testing?",
                                "Qualification date and Next due date:",
                                "Incubators ID:",
                                "Qualification date and Next due date:",
                                "Any events associated with incubators, when the samples under incubation.",
                                "Was there any power supply failure noted during analysis?",
                                "Pipette IDs",
                                "Calibration date & Next due date:",
                                "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?"
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
                                        @foreach ($CR_of_instru_equipment_IMAs as $CR_of_instru_equipment_IMA )


                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$CR_of_instru_equipment_IMA}}

                                                 </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="CR_of_instru_equipment_IMA[{{$loop->index}}][response]" id="response"

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

                                                    <textarea name="CR_of_instru_equipment_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

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
                        "Name of the disinfectant used for cleaning of testing area:",
                        "Was the disinfectant prepared as per validated concentration?",
                        "Use before date of the disinfectant used for cleaning:"
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
                                        @foreach ($disinfectant_details_IMAs as $disinfectant_details_IMA )



                                        <tr>

                                            <td class="flex text-center">{{$loop->index+1}}</td>

                                            <td>{{$disinfectant_details_IMA}}

                                                 </td>

                                            <td>



                                                <div

                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                    <select name="disinfectant_details_IMA[{{$loop->index}}][response]" id="response"

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

                                                    <textarea name="disinfectant_details_IMA[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>

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
                        "Is the analyst trained for Environmental monitoring?",
                        "Was the analyst qualified for Personnel qualification?",
                        "Date of qualification:",
                        "Was the analyst trained on entry exit /procedure/In production area or any monitoring area?",
                        "SOP No.:",
                        "Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
                        "Was the analyst followed gowning procedure properly?",
                        "Was analyst performed colony counting correctly?"
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
                                        @foreach ($CR_of_training_rec_anaylst_in_monitoring_CIEMs as $CR_of_training_rec_anaylst_in_monitoring_CIEM  )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$CR_of_training_rec_anaylst_in_monitoring_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="CR_of_training_rec_anaylst_in_monitoring_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $Check_for_Sample_details_CIEMs =[
                        "Was the plate verified at the time of monitoring?",
                        "Was the plate transported as per approved procedure?",
                        "Was the correct location ID & Room Name mentioned on plate exposed?",
                        "What is the grade of plate exposed area?",
                        "Is area crossing Alert limit or action limit?"
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
                                        @foreach ($Check_for_Sample_details_CIEMs as $Check_for_Sample_details_CIEM )
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Check_for_Sample_details_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Check_for_Sample_details_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="Check_for_Sample_details_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            $Check_for_comparision_of_results_CIEMs =  [
                            "Was any Excursions in other settle plate exposure?",
                            "Was any Excursions in other active air plate sampling?",
                            "Was any Excursions in surface monitoring?",
                            "Was any Excursions in personnel monitoring on same day?",
                            "Is results of next day monitoring within the acceptance?",
                            "Was negative control of the test procedure found satisfactory?",
                            "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
                            "Were the plate transferred and incubated at desired temp.as per approved procedure?"
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
                                        @foreach ($Check_for_comparision_of_results_CIEMs as $Check_for_comparision_of_results_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>Was any Excursions in other settle plate exposure ?</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="Check_for_comparision_of_results_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            "Name of media used for in the analysis:",
                            "Did the COA of the media checked and found satisfactory?",
                            "Media Lot. No.",
                            "Media Qualified date /Qualified By",
                            "Media expiry date"
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
                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_media_dehydrated_CIEM}}</td>
                                            <td>
                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_media_dehydrated_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            $checklist_for_media_prepara_sterilization_CIEMs=  [
                            "Date of media preparation",
                            "Media Lot. No.",
                            "Media prepared date",
                            "Media expiry date",
                            "Preincubation of media",
                            "Was the media sterilized and sterilization cycle found satisfactory?",
                            "Sterilization cycle No.:",
                            "Were cycle sterilization parameters found satisfactory?"
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
                                        @foreach ($checklist_for_media_prepara_sterilization_CIEMs as $checklist_for_media_prepara_sterilization_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index }}</td>
                                            <td>{{$checklist_for_media_prepara_sterilization_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="date"  name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][response]" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">

                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_media_prepara_sterilization_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $CR_of_En_condition_in_testing_CIEMs =[
                        "Is temperature of MLT testing area within the acceptance?",
                        "Was the differential pressure of the area within limit?",
                        "While media plate preparation is LAF working satisfactory?"
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
                                        @foreach ($CR_of_En_condition_in_testing_CIEMs as $CR_of_En_condition_in_testing_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$CR_of_En_condition_in_testing_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="CR_of_En_condition_in_testing_CIEMs[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                Checklist for disinfectant Details:
                </div>
                    @php
                        $check_for_disinfectant_CIEMs =  [
                        "Name of the disinfectant used for area cleaning",
                        "Was the disinfectant used for cleaning and sanitization validated?",
                        "Concentration:",
                        "Was the disinfectant prepared as per validated concentration?"
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
                                        @foreach ($check_for_disinfectant_CIEMs as $check_for_disinfectant_CIEM)


                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$check_for_disinfectant_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" name="check_for_disinfectant_CIEM[{{$loop->index}}][response]" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="check_for_disinfectant_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            "Name of the fogging agents used for area fogging",
                            "Was the fogging agent used for fogging and validated?",
                            "Concentration:",
                            "Was the fogging agent prepared as per validated concentration?"
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
                                        @foreach ($checklist_for_fogging_CIEMs as $checklist_for_fogging_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_fogging_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <input type="text" name="checklist_for_fogging_CIEM[{{$loop->index}}][response]" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" placeholder="Enter the value">
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_fogging_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        $CR_of_test_method_CIEMs=[
                        "Was the test method, monitoring SOP followed correctly?",
                        "SOP No.:"
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
                                        @foreach ($CR_of_test_method_CIEMs as $CR_of_test_method_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$CR_of_test_method_CIEM}} </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="CR_of_test_method_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="CR_of_test_method_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            "Were the contaminants/ isolates subculture?",
                            "Attach the colony morphology details:",
                            "Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)",
                            "Gram nature of the organism (GP/GN)",
                            "(Attach the details, if more than single organism)",
                            "Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates."
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
                                        @foreach ($CR_microbial_isolates_contamination_CIEMs as $CR_microbial_isolates_contamination_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$CR_microbial_isolates_contamination_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="CR_microbial_isolates_contamination_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
                        "Is used incubators are qualified?",
                        "Incubator :ID No.",
                        "Qualification date:",
                        "Next due date:",
                        "Is used Colony counter qualified?",
                        "Colony counter ID:",
                        "Qualification date:",
                        "Next due date:",
                        "Is used Air sampler qualified?",
                        "Air sampler ID",
                        "Validation date:",
                        "Next due date:",
                        "Was temp. of incubator with in the limit during incubation period?",
                        "Was HVAC system of testing area qualified?",
                        "Qualification date and Next due date:"
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
                                        @foreach ($CR_of_instru_equip_CIEMs as $CR_of_instru_equip_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$CR_of_instru_equip_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="CR_of_instru_equip_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="CR_of_instru_equip_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                "Is trend of current month within acceptance?",
                                "Is trend of previous month within acceptance?",
                            ]
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
                                        @foreach ($Ch_Trend_analysis_CIEMs as $Ch_Trend_analysis_CIEM )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$Ch_Trend_analysis_CIEM}}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="Ch_Trend_analysis_CIEM[{{$loop->index}}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
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
                                                    <textarea name="Ch_Trend_analysis_CIEM[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                   </tbody>
                                   @endforeach

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
                        $checklist_for_analyst_training_CIMTs =  [
                        "Is the analyst trained/qualified GPT test procedure?",
                        "Date of qualification:",
                        "Were appropriate precaution taken by the analyst throughout the test?",
                        "Analyst interview record.......",
                        "Was an analyst persons suffering from any ailment such as cough/cold or open wound or skin infections?",
                        "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?"
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
                                        @foreach ($checklist_for_analyst_training_CIMTs as $checklist_for_analyst_training_CIMT )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_analyst_training_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_analyst_training_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_analyst_training_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
             </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Comparison of results (With same & Previous Day Media GPT) :
                </div>
                    @php
                        $checklist_for_comp_results_CIMTs=  [
                        "Which media GPT performed at previous day:",
                        "Were dehydrated and ready to use media used for GPT?",
                        "Lot No./Batch No:",
                        "Date /Time of Incubation:",
                        "Date/Time of Release:",
                        "Results of previous day GPT record?",
                        "Results of other plates released for GPT is within acceptance?"
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
                                        @foreach ($checklist_for_comp_results_CIMTs as $checklist_for_comp_results_CIMT)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_comp_results_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_comp_results_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_comp_results_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
            </div>
            <div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Culture verification ?
                </div>
                    @php
                        $checklist_for_Culture_verification_CIMTs = [
                        "Is culture COA checked?",
                        "Was the correct Inoculum used for GPT?",
                        "Was used culture within culture due date?",
                        "Date of culture dilution:",
                        "Due date of culture dilution:",
                        "Was the storage condition of culture is appropriate?",
                        "Was culture strength used within acceptance range?"
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
                                        @foreach ($checklist_for_Culture_verification_CIMTs as $checklist_for_Culture_verification_CIMT )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_Culture_verification_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_Culture_verification_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
            </div><div class="inner-block-content">
                <div class="sub-head">
                    Checklist for Sterilize Accessories :
                </div>
                        @php
                            $sterilize_accessories_CIMTs= [
                            "Was the media sterilized and sterilization cycle found satisfactory?",
                            "Sterilization cycle No.:",
                            "Whether disposable sterilized gloves used during testing were within the expiry date?",
                            "Results of other plates released for GPT is within acceptance?"
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
                                    @foreach ($sterilize_accessories_CIMTs as $sterilize_accessories_CIMT )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$sterilize_accessories_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="sterilize_accessories_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="sterilize_accessories_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        "Was the equipment used, calibrated/qualified and within the specified range?",
                        "Biosafety equipment ID:",
                        "Validation date:",
                        "Next due date:",
                        "Colony counter equipment ID:",
                        "Calibration date:",
                        "Was used pipettes within calibration?",
                        "Pipettes ID:",
                        "Calibration date",
                        "Was the refrigerator used for storage of culture is validated?",
                        "Refrigerator (2-8̊ C) ID:",
                        "Validation date:",
                        "Incubator ID:",
                        "Validation date and next due date:",
                        "Was there any power failure noticed during the incubation of samples in the heating block?",
                        "Were any other media GPT tested along with this sample?",
                        "If yes, whether those media GPT results found satisfactory?"
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
                                    @foreach ($checklist_for_intrument_equip_last_CIMTs as $checklist_for_intrument_equip_last_CIMT)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_intrument_equip_last_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_intrument_equip_last_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        "Name of the disinfectant used for area cleaning",
                        "Was the disinfectant used for cleaning and sanitization validated?",
                        "Concentration:",
                        "Was the disinfectant prepared as per validated concentration?"
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
                                    @foreach ($disinfectant_details_last_CIMTs as  $disinfectant_details_last_CIMT)

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$disinfectant_details_last_CIMT}} </td>
                                            <td>

                                                <div
                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                <input type="text" name="disinfectant_details_last_CIMT[{{$loop->index}}][response]"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                </div>


                                            </td>
                                            <td>
                                                {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                    style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_last_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                        "Were results taken properly?",
                        "Raw data checked?",
                        "Was formula dilution factor used for calculating the results corrected?"
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
                                    @foreach ($checklist_for_result_calculation_CIMTs as $checklist_for_result_calculation_CIMT )

                                        <tr>
                                            <td class="flex text-center">{{$loop->index+1}}</td>
                                            <td>{{$checklist_for_result_calculation_CIMT}}</td>
                                            <td>

                                                <div
                                                    style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_for_result_calculation_CIMT[{{$loop->index}}][response]" id="response"
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
                                                    <textarea name="checklist_for_result_calculation_CIMT[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
