@extends('frontend.layout.main')
@section('container')
@php
$users = DB::table('users')
    ->select('id', 'name')
    ->get();

    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>
    <!-- -----------------------------grid-1----------------------------script -->
    <script>
        $(document).ready(function() {
            $('#info_product_material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var currentDate = new Date();
                    var formattedCurrentDate = currentDate.toISOString().split('T')[0].slice(0, 7); // Format as YYYY-MM


                    var users = @json($users);
                    var html =
                    '<tr>' +
                        '<td><input disabled type="text" name="info_product_material[' + serialNumber + '][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" id="info_product_code" name="info_product_material[' + serialNumber + '][info_product_code]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_batch_no]" value=""></td>'+
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_mfg_date_' + serialNumber + '\')" max="' + formattedCurrentDate + '">' +
                        '</div>' +
                        // '<div class="calenderauditee">' +
                        // '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        // '<input type="date" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_mfg_date_' + serialNumber + '\')" max="' + currentDate + '">' +
                        // '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_expiry_date' + serialNumber + '\')" min="' + formattedCurrentDate + '">' +
                        '</div>' +
                        // '<div class="calenderauditee">' +
                        // '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        // '<input type="date" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_expiry_date' + serialNumber + '\')" min="' + currentDate + '">' +
                        // '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_label_claim]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_pack_size]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_analyst_name]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_others_specify]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_process_sample_stage]" value=""></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_packing_material_type]"><option value="">--Select--</option><option value="Primary">Primary</option><option value="Secondary">Secondary</option><option value="Tertiary">Tertiary</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_stability_for]"><option value="">--Select Option--</option><option vlaue="Submission">Submission</option><option vlaue="Commercial">Commercial</option><option vlaue="Pack Evaluation">Pack Evaluation</option><option vlaue="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                    '</tr>';
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#info_product_material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <!-- --------------------------------grid-2--------------------------->
    <script>
        $(document).ready(function() {
            $('#details_stability').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="details_stability[ '+ serialNumber + '][serial]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_arnumber]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_condition_temprature_rh]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_Interval]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_orientation]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_pack_details]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_specification_no]"></td>'+
                            '<td><input type="text" name="details_stability[ '+ serialNumber + '][stability_study_sample_description]"></td>'+
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +
                    return html;
                }

                var tableBody = $('#details_stability_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- ------------------------------grid-3-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#oos_details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="oos_detail['+ serialNumber +'][serial]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_arnumber]"></td>'+
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_test_name]"></td>' +
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_results_obtained]"></td>' +
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_specification_limit]"></td>' +
                            '<td><input type="file" name="oos_detail['+ serialNumber +'][oos_file_attachment]"></td>' +
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_submit_by]"></td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="oos_submit_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="oos_detail[' + serialNumber + '][oos_submit_on]" value="" class="hide-input" oninput="handleDateInput(this, \'oos_submit_on' + serialNumber + '\')">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +

                            '<td><button type="text" class="removeRowBtn">Remove</button></td>'
                         '</tr>';
                    return html;
                }

                var tableBody = $('#oos_details_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <!-- ------------------------------grid-4 products_details-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#products_details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var currentDate = new Date().toISOString().split('T')[0];

                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="products_details['+ serialNumber +'][serial]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="products_details['+ serialNumber +'][product_name]"></td>'+
                            '<td><input type="text" name="products_details['+ serialNumber +'][product_AR_No]"></td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="sampled_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="products_details[' + serialNumber + '][sampled_on]" value="" class="hide-input" oninput="handleDateInput(this, \'sampled_on' + serialNumber + '\')" max="' + currentDate + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +

                            '<td><input type="text" name="products_details['+ serialNumber +'][sample_by]"></td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="analyzed_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="products_details[' + serialNumber + '][analyzed_on]" value="" class="hide-input" oninput="handleDateInput(this, \'analyzed_on' + serialNumber + '\')" max="' + currentDate + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="observed_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="products_details[' + serialNumber + '][observed_on]" value="" class="hide-input" oninput="handleDateInput(this, \'observed_on' + serialNumber + '\')" max="' + currentDate + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                           '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#products_details_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- ------------------------------grid-5 instrument_detail-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#instrument_detail').click(function(e) {
                function generateTableRow(serialNumber) {
                    var currentDate = new Date().toISOString().split('T')[0];

                    var html =
                        '<tr>' +
                            '<td><input disabled type="text" name="instrument_detail['+ serialNumber +'][serial]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="instrument_detail['+ serialNumber +'][instrument_name]"></td>'+
                            '<td><input type="text" name="instrument_detail['+ serialNumber +'][instrument_id_number]"></td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="calibrated_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="instrument_detail[' + serialNumber + '][calibrated_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibrated_on' + serialNumber + '\')" max="' + currentDate + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="calibratedduedate_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="instrument_detail[' + serialNumber + '][calibratedduedate_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibratedduedate_on' + serialNumber + '\')" min="' + currentDate + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    return html;
                }

                var tableBody = $('#instrument_details_details tbody');
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oos_capa['+ serialNumber +'][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="number" name="oos_capa['+ serialNumber +'][info_oos_number]" value=""></td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" disabled id="info_oos_reported_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        '<input type="date" name="oos_capa[' + serialNumber + '][info_oos_reported_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_oos_reported_date' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><input type="text" name="oos_capa['+ serialNumber +'][info_oos_description]" value=""></td>' +
                        '<td><input type="text" name="oos_capa['+ serialNumber +'][info_oos_previous_root_cause]"value=""></td>' +
                        '<td><input type="text" name="oos_capa['+ serialNumber +'][info_oos_capa]" value=""></td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_oos_closure_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        '<input type="date" name="oos_capa[' + serialNumber + '][info_oos_closure_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_oos_closure_date' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><select name="oos_capa['+ serialNumber +'][info_oos_capa_requirement]"><option value="">Select Option</option><option value="yes">Yes</option><option value="No">No</option></select></td>' +
                        '<td><input type="text" name="oos_capa['+ serialNumber +'][info_oos_capa_reference_number]" value=""></td>' +
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
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oos_conclusion[' + serialNumber + '][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_analysis_detials]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_hypothesis_experimentation_test_pr_no]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_analyst_name]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_remarks]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
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
            $('#oos_conclusion_review').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="oos_conclusion_review[' + serialNumber + '][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_product_name]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_batch_no]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_any_other_information]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_action_affecte_batch]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>'
                        '</tr>';
                    '</tr>';

                    return html;
                }

                var tableBody = $('#oos_conclusion_review_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <!-- ======GRID END  =============-->

    <div class="form-field-head">
        <!-- <div class="pr-id">
                        New Document
                    </div> -->
        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :{{ Helpers::getDivisionName(session()->get('division')) }}/OOS/OOT
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

                <div id="OOS_Chemical_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                    <button class="cctablinks button1" style="display:none;" onclick="openCity(event, 'CCForm44')">CheckList - pH-Viscometer-MP</button>
                    <button class="cctablinks button2" style="display:none;" onclick="openCity(event, 'CCForm45')">CheckList - Dissolution</button>
                    <button class="cctablinks button3" style="display:none;" onclick="openCity(event, 'CCForm46')">CheckList - HPLC-GC</button>
                    <button class="cctablinks button4" style="display:none;" onclick="openCity(event, 'CCForm47')">CheckList - General checklist</button>
                    <button class="cctablinks button5" style="display:none;" onclick="openCity(event, 'CCForm48')">CheckList - KF-Potentiometer</button>
                    <button class="cctablinks button6" style="display:none;" onclick="openCity(event, 'CCForm49')">CheckList - RM-PM Sampling</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm35')">Phase IB CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II A Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Phase II B QAH/CQAH Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS/OOT Conclusion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                </div>
                 <!-- OOS Micro Buttons -->
                 <div id="OOS_Micro_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                    <button class="cctablinks button7" style="display:none;"  onclick="openCity(event, 'CCForm50')">Checklist - Bacterial Endotoxin Test</button>
                    <button class="cctablinks button8" style="display:none;"  onclick="openCity(event, 'CCForm51')">Checklist - Sterility</button>
                    <button class="cctablinks button9" style="display:none;"  onclick="openCity(event, 'CCForm52')">Checklist - Microbial limit test/Bioburden and Water Test</button>
                    <button class="cctablinks button10" style="display:none;"   onclick="openCity(event, 'CCForm53')">Checklist - Microbial assay</button>
                    <button class="cctablinks button11" style="display:none;"   onclick="openCity(event, 'CCForm54')">Checklist - Environmental Monitoring</button>
                    <button class="cctablinks button12" style="display:none;"   onclick="openCity(event, 'CCForm55')">Checklist - Media Suitability Test</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm35')">Phase IB CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II A Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Phase II B QAH/CQAH Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal</button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS/OOT Conclusion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                  </div>
                <div id="OOT_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                    <button class="cctablinks button1" style="display:none;" onclick="openCity(event, 'CCForm44')">CheckList - pH-Viscometer-MP</button>
                    <button class="cctablinks button2" style="display:none;" onclick="openCity(event, 'CCForm45')">CheckList - Dissolution</button>
                    <button class="cctablinks button3" style="display:none;" onclick="openCity(event, 'CCForm46')">CheckList - HPLC-GC</button>
                    <button class="cctablinks button4" style="display:none;" onclick="openCity(event, 'CCForm47')">CheckList - General checklist</button>
                    <button class="cctablinks button5" style="display:none;" onclick="openCity(event, 'CCForm48')">CheckList - KF-Potentiometer</button>
                    <button class="cctablinks button6" style="display:none;" onclick="openCity(event, 'CCForm49')">CheckList - RM-PM Sampling</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm35')">Phase IB CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II A Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Phase II B QAH/CQAH Review</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS/OOT Conclusion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                </div>

                <style>
                    #OOS_Micro_Buttons {
                        display: flex;
                        flex-wrap: wrap; /* Allow buttons to wrap onto the next line */
                        gap: 10px; /* Space between buttons */
                    }

                    .cctablinks {
                        flex: 1 1 auto; /* Allow the button to grow and shrink */
                        min-width: 200px; /* Minimum width for each button */
                        margin-bottom: 10px; /* Space below each button */
                        padding: 10px 15px; /* Padding inside buttons */
                        background-color: #007bff; /* Button background color */
                        color: white; /* Button text color */
                        border: none; /* Remove default border */
                        border-radius: 4px; /* Rounded corners */
                        cursor: pointer; /* Pointer cursor on hover */
                        text-align: center; /* Center button text */
                    }

                    .cctablinks:hover {
                        background-color: #0056b3; /* Darker background on hover */
                    }

                    .cctablinks.active {
                        background-color: #0056b3; /* Darker background for the active button */
                    }
                </style>






                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm41')">Phase II B QAH/CQAH</button> --}}

                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm18')">CheckList - Preliminary Lab. Investigation</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button> --}}
                <!-- checklist start -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm24')">Checklist - Investigation of Bacterial Endotoxin Test (BET)</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm25')">Checklist - Investigation of Sterility</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm26')">Checklist - Investigation of Microbial limit test (MLT)</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist - Investigation of Chemical assay</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Checklist - Residual solvent (RS)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm23')">Checklist - Dissolution </button> --}}
                <!-- checklist closed -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II A Investigation</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm19')">CheckList - Phase II Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QA Review</button> --}}

                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button> --}}
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button> -->

                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Extension</button> --}}


            </div>
          <form id="Mainform" action="{{ route('oos.oosstore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
            <!-- Tab content -->
            <!-- General Information -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="sub-head">General Information</div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Type<span class="text-danger">*</span></label>
                                <select required id="Form_type" name="Form_type" onchange="showChecklist()">
                                    <option value="">--select--</option>
                                    <option value="OOS_Chemical">OOS Chemical</option>
                                    <option value="OOS_Micro">OOS Micro</option>
                                    <option value="OOT">OOT</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Record Number">Record Number</label>
                                <input type="hidden" name="record">
                                {{-- <input disabled type="text" id=" " name="record"
                                       value="{{ Helpers::getDivisionName(session()->get('division')) }}/OOS/OOT/{{ date('Y') }}/{{ $record_number }}"> --}}


                                <input disabled type="text" name="record" id="record" placeholder="Record Number">



                            </div>
                        </div>

                        <script>
                        function showChecklist() {
                            // Hide all button groups initially
                            document.getElementById('OOS_Chemical_Buttons').style.display = 'none';
                            document.getElementById('OOS_Micro_Buttons').style.display = 'none';
                            document.getElementById('OOT_Buttons').style.display = 'none';

                            // Get the selected value
                            var formType = document.getElementById('Form_type').value;
                            var divisionName = "{{ Helpers::getDivisionName(session()->get('division')) }}";
                            var year = "{{ date('Y') }}";
                            var recordNumber = "{{ $record_number }}";

                            // Default to "OOS Chemical" if no option is selected
                            var recordText = divisionName + '/OOS_Chemical/' + year + '/' + recordNumber;

                            if (formType === 'OOS_Chemical') {
                                document.getElementById('OOS_Chemical_Buttons').style.display = 'block';
                                recordText = divisionName + '/OOS_Chemical/' + year + '/' + recordNumber;
                            } else if (formType === 'OOS_Micro') {
                                document.getElementById('OOS_Micro_Buttons').style.display = 'block';
                                recordText = divisionName + '/OOS_Micro/' + year + '/' + recordNumber;
                            } else if (formType === 'OOT') {
                                document.getElementById('OOT_Buttons').style.display = 'block';
                                recordText = divisionName + '/OOT/' + year + '/' + recordNumber;
                            }

                            // LABEL CHANGE LOGIC
                            var typeText = "OOS";

                            if(formType === 'OOT'){
                                typeText = "OOT";
                            }

                            document.getElementById('label_occured').innerHTML =
                                typeText + " Occurred On <span class='text-danger'>*</span>";

                            document.getElementById('label_observed').innerHTML =
                                typeText + " Observed On <span class='text-danger'>*</span>";

                            document.getElementById('oos_details').innerHTML =
                                typeText + " Details ";

                            document.getElementById('label_reported').innerHTML =
                                typeText + " Reported On ";

                            var headText = "OOS Information";

                            if(formType === 'OOT'){
                                headText = "OOT Information";
                            }

                            document.getElementById('info_head').innerHTML = headText;

                            // Update the Record Number display
                            document.getElementById('record_display').value = recordText;
                        }
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label disabled for="Division Code">Site/Location Code<span class="text-danger"></span></label>
                                <input disabled type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator">Initiator <span class="text-danger"></span></label>
                                <input type="hidden" name="initiator_id" value="{{ Auth::user()->id }}">
                                <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="group-input ">
                                <label for="intiation-date"> Date Of Initiation<span class="text-danger"></span></label>
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                            </div>
                        </div>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Due Date"> Due Date </label>
                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                <div class="calenderauditee">
                                    <input type="text" name="due_date"  id="due_date"  readonly placeholder="DD-MMM-YYYY"/>
                                    <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'due_date')" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Short Description">Short Description
                                    <span class="text-danger">*</span></label>
                                    <span id="rchars">255</span>characters remaining
                                <input id="docname"  name="description_gi" maxlength="255" required>
                            </div>
                            @error('short_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <p id="docnameError" style="color:red">**Short Description is required</p>

                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description">Initiation Department Group  <span class="text-danger"></span></label>

                                <select name="initiator_group" id="initiator_group">
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
                                        <option value="AL" >Analytical Research And Development Laboratory</option>
                                        <option value="PD">Packaging Development</option>
                                        <option value="PU">Purchase Department</option>
                                        <option value="DC">Document Cell</option>
                                        <option value="RA">Regulatory Affairs</option>
                                        <option value="PV">Pharmacovigilance</option>
                                    </select>
                            </div>
                        </div> --}}

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"><b>Initiator Department</b></label>
                                <input readonly type="text" name="initiator_group" id="initiator_group"
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

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code">Initiation Department Code <span class="text-danger"></span></label>
                                <input type="text" name="initiator_group_code" id="initiator_group_code" value="" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code">Is Repeat?</label>
                                <select name="is_repeat_gi" id="assignableSelect">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6" id="rootCauseGroup" style="display: none;">
                            <div class="group-input">
                                <label for="RootCause">Repeat Nature<span class="text-danger">*</span></label>
                                <textarea name="repeat_nature" id="rootCauseTextarea" rows="4" placeholder="Describe the Is Repeat here"></textarea>

                            </div>
                        </div>

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Initialize the display of the textarea based on the current value
                            toggleRootCauseInput();

                            function toggleRootCauseInput() {
                                var selectValue = document.getElementById("assignableSelect").value.toLowerCase(); // Convert value to lowercase for consistency
                                var rootCauseGroup = document.getElementById("rootCauseGroup");
                                var rootCauseTextarea = document.getElementById("rootCauseTextarea");

                                if (selectValue === "yes") {
                                    rootCauseGroup.style.display = "block";  // Show the textarea if "Yes" is selected
                                    rootCauseTextarea.setAttribute('required', 'required');  // Make textarea required
                                } else {
                                    rootCauseGroup.style.display = "none";   // Hide the textarea if "No" is selected
                                    rootCauseTextarea.removeAttribute('required');  // Remove required attribute
                                }
                            }

                            // Attach the event listener
                            document.getElementById("assignableSelect").addEventListener("change", toggleRootCauseInput);
                        });
                        </script>


                        {{--  <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"></label>
                                <label for="Repeat Nature">Repeat Nature</label>
                                 <textarea  name="repeat_nature_gi" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Nature of Change</label>
                                <select name="nature_of_change_gi">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="permanent">Permanent</option>
                                </select>
                            </div>
                        </div>--}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Source Document Type</label>
                                <select name="source_document_type_gi" id="Change_Application">
                                    <option value="0">Enter Your Selection Here</option>
                                    <option value="OOT">OOT</option>
                                    <option value="Lab Incident">Lab Incident</option>
                                    <option value="Deviation">Deviation</option>
                                    <option value="Product Non-conformance">Product Non-conformance</option>
                                    <option value="Inspectional Observation">Inspectional Observation</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-6 new-date-data-field" id="any-other-section" style="display: none;">
                            <div class="group-input">
                                <label for="Other Application"> Other Source Document Type</label>
                                <input type="text" name="sourceDocOtherGi" id="other_application"
                                    class="form-control" value="">
                            </div>
                        </div>


                        <script>
                            $(document).ready(function() {
                                $('#Change_Application').on('change', function() {
                                    var selectedValue = $(this).val(); // single select hai, array nahi

                                    // Hide by default
                                    $('#any-other-section').hide();
                                    // $('#other_application').removeAttr('required');
                                    $('#required-star').hide();

                                    if (selectedValue === 'Others') {
                                        $('#any-other-section').show();
                                        // $('#other_application').attr('required', true);
                                        $('#required-star').show();
                                    }
                                });

                                // Trigger on page load for pre-filled data
                                $('#Change_Application').trigger('change');
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference System Document</label>
                                <input type="text" name="reference_system_document_gi"  id="reference_system_document_gi" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Document">Reference Document</label>
                                <input type="text" name="reference_document"  id="reference_document" value="">
                            </div>
                        </div>
                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label id="label_occured">OOS Occurred On <span class="text-danger">*</span></label>
                                <div class="calenderauditee">
                                    <input type="text"  id="deviation_occured_on_gi" readonly placeholder="DD-MM-YYYY" />
                                    <input type="date" name="deviation_occured_on_gi"   value=""
                                    class="hide-input"
                                    oninput="handleDateInput(this, 'deviation_occured_on_gi')"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label id="label_observed">OOS Observed On <span class="text-danger">*</span></label>
                                <div class="calenderauditee">
                                    <input type="text" id="oos_observed_on" readonly placeholder="DD-MMM-YYYY" />
                                    {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                    <input type="date" name="oos_observed_on" class="hide-input"
                                        oninput="handleDateInput(this, 'oos_observed_on')" />
                                </div>
                            </div>
                            @error('Deviation_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Delay Justification</label>
                                <textarea id="delay_justification" name="delay_justification"></textarea>
                            </div>
                            {{-- @error('Deviation_date')
                                <div class="text-danger">{{  $message  }}</div>
                            @enderror --}}
                        </div>
                        <script>
                            flatpickr("#deviation_time", {
                                enableTime: true,
                                noCalendar: true,
                                dateFormat: "H:i", // 24-hour format without AM/PM
                                minuteIncrement: 1 // Set minute increment to 1

                            });
                        </script>

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <!-- <label for="Audit Schedule End Date">OOS/OOT Reported On</label> -->
                                <label id="label_reported">OOS Reported On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="oos_reported_date" readonly placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="oos_reported_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                      class="hide-input" oninput="handleDateInput(this, 'oos_reported_date')" />
                                </div>
                            </div>
                        </div>
                            <script>
                                $('.delayJustificationBlock').hide();

                                function calculateDateDifference() {
                                    let deviationDate = $('input[name=Deviation_date]').val();
                                    let reportedDate = $('input[name=Deviation_reported_date]').val();

                                    if (!deviationDate || !reportedDate) {
                                        console.error('Deviation date or reported date is missing.');
                                        return;
                                    }

                                    let deviationDateMoment = moment(deviationDate);
                                    let reportedDateMoment = moment(reportedDate);

                                    let diffInDays = reportedDateMoment.diff(deviationDateMoment, 'days');

                                    // if (diffInDays > 0) {
                                    //     $('.delayJustificationBlock').show();
                                    // } else {
                                    //     $('.delayJustificationBlock').hide();
                                    // }

                                }

                                $('input[name=Deviation_date]').on('change', function() {
                                    calculateDateDifference();
                                })

                                $('input[name=Deviation_reported_date]').on('change', function() {
                                    calculateDateDifference();
                                })
                            </script>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="immediate_action">Immediate Action</label>
                                    <textarea name="immediate_action" id="immediate_action" placeholder="Enter immediate action here"></textarea>
                                </div>
                        </div>
                        <div class="col-lg-12">
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
                        <div class="sub-head pt-3" id="info_head">OOS Information</div>                        
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Sample Type</label>
                                <select name="sample_type_gi" id="sample_other">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Raw Material">Raw Material</option>
                                    <option value="Packing Material">Packing Material</option>
                                    <option value="Finished Product">Finished Product</option>
                                    <option value="Stability Sample">Stability Sample</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 new-date-data-field" id="any-other1-section" style="display: none;">
                            <div class="group-input">
                                <label for="Other Application"> Other Sample Type</label>
                                <input type="text" name="Others1" id="other1_application"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#sample_other').on('change', function() {
                                    var selectedValue = $(this).val(); // single select hai, array nahi

                                    // Hide by default
                                    $('#any-other1-section').hide();
                                    // $('#other_application').removeAttr('required');
                                    $('#required-star').hide();

                                    if (selectedValue === 'Others') {
                                        $('#any-other1-section').show();
                                        // $('#other_application').attr('required', true);
                                        $('#required-star').show();
                                    }
                                });

                                // Trigger on page load for pre-filled data
                                $('#sample_other').trigger('change');
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description ">Product / Material Name</label>
                                <input type="text" name="product_material_name_gi" placeholder="Enter your Product / Material Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Market</label>
                                <input type="text" name="market_gi" placeholder="Enter your Market">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Customer</label>
                                <input type="text" name="customer_gi" placeholder="Enter your Customer">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Specification Details</label>
                                <input type="text" name="specification_details" placeholder="Enter your Specification Details">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">STP Details</label>
                                <input type="text" name="STP_details" placeholder="Enter your STP Details">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Manufacture/Vendor</label>
                                <input type="text" name="manufacture_vendor" placeholder="Enter your Manufacture/Vendor">
                            </div>
                        </div>
                        <!-- ---------------------------grid-1 -------------------------------- -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Info. On Product/ Material
                                <button type="button" name="audit-agenda-grid" id="info_product_material">+</button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="info_product_material_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 10%">Item/Product Code</th>
                                            <th style="width: 8%"> Batch No*.</th>
                                            <th style="width: 12%"> Mfg.Date</th>
                                            <th style="width: 12%">Expiry Date</th>
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
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="info_product_material[0][serial]" value="1"></td>
                                            <td><input type="text" name="info_product_material[0][info_product_code]" value=""></td>
                                            <td><input type="text" name="info_product_material[0][info_batch_no]" value=""></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_mfg_date" readonly placeholder="MM-YYYY" />
                                                        <input type="month"  name="info_product_material[0][info_mfg_date]" value=""
                                                        class="hide-input" oninput="handleMonthInput(this, 'info_mfg_date')">
                                                        <!-- max="{{ date('Y-m') }}" -->
                                                    </div>
                                                    {{-- <div class="calenderauditee">
                                                        <input type="text" id="info_mfg_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="info_product_material[0][info_mfg_date]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_mfg_date')">
                                                    </div> --}}
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_expiry_date" readonly placeholder="MM-YYYY" />
                                                        <input type="month"  name="info_product_material[0][info_expiry_date]"
                                                        class="hide-input" oninput="handleMonthInput(this, 'info_expiry_date')">
                                                        <!-- min="{{ date('Y-m') }}" -->
                                                    </div>
                                                    {{-- <div class="calenderauditee">
                                                        <input type="text" id="info_expiry_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="info_product_material[0][info_expiry_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_expiry_date')">
                                                    </div> --}}
                                                </div>
                                            </div>
                                            </td>

                                            <td><input type="text" name="info_product_material[0][info_label_claim]" value=""></td>
                                            <td><input type="text" name="info_product_material[0][info_pack_size]" value=""></td>
                                            <td><input type="text" name="info_product_material[0][info_analyst_name]" value=""></td>
                                            <td><input type="text" name="info_product_material[0][info_others_specify]" value=""></td>
                                            <td><input type="text" name="info_product_material[0][info_process_sample_stage]" value=""></td>
                                            <td>
                                                <select name="info_product_material[0][info_packing_material_type]">
                                                <option value="">Enter Your Selection Here</option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="info_product_material[0][info_stability_for]">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option vlaue="Submission">Submission</option>
                                                    <option vlaue="Commercial">Commercial</option>
                                                    <option vlaue="Pack Evaluation">Pack Evaluation</option>
                                                    <option vlaue="Not Applicable">Not Applicable</option>
                                                </select>
                                            </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- -------------------------------grid-2  ----------------------------------   -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Details Of Stability Study
                                <button type="button" name="audit-agenda-grid" id="details_stability">+</button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="details_stability_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number</th>
                                            <th style="width: 12%">Condition: Temperature & RH</th>
                                            <th style="width: 12%">Interval</th>
                                            <th style="width: 16%">Orientation</th>
                                            <th style="width: 16%">Pack Details (if Any)</th>
                                            <th style="width: 16%">Specification No.</th>
                                            <th style="width: 16%">Sample Description</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="details_stability[0][serial]" value="1"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_arnumber]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_condition_temprature_rh]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_Interval]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_orientation]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_pack_details]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_specification_no]"></td>
                                            <td><input type="text" name="details_stability[0][stability_study_sample_description]"></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!----------------grid-3----------------------------------- -->
                        <div class="group-input">
                            <label for="audit-agenda-grid" id="oos_details">
                                OOS Details
                                <button type="button" name="audit-agenda-grid" id="oos_details">+</button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="oos_details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number.</th>
                                            <th style="width: 8%">Test Name of OOS/OOT</th>
                                            <th style="width: 8%">Results Obtained</th>
                                            <th style="width: 8%">Specification Limit</th>
                                            <th style="width: 16%">File Attachment</th>
                                            <th style="width: 8%">Submit By</th>
                                            <th style="width: 16%">Submit On</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="oos_detail[0][serial]" value="1"></td>
                                            <td><input type="text" name="oos_detail[0][oos_arnumber]"></td>
                                            <td><input type="text" name="oos_detail[0][oos_test_name]"></td>
                                            <td><input type="text" name="oos_detail[0][oos_results_obtained]"></td>
                                            <td><input type="text" name="oos_detail[0][oos_specification_limit]"></td>
                                            <td>
                                                <input type="file" name="oos_detail[0][oos_file_attachment][]" multiple>
                                            </td>
                                            <td><input type="text" name="oos_detail[0][oos_submit_by]"></td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <div class="calenderauditee">
                                                            <input type="text" id="oos_submit_on" readonly placeholder="DD-MM-YYYY" />
                                                            <input type="date" name="oos_detail[0][oos_submit_on]"
                                                                class="hide-input" oninput="handleDateInput(this, 'oos_submit_on')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!---------------- grid-4 Products_details----------------------------------- -->

                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Products Details
                                <button type="button" name="audit-agenda-grid" id="products_details">+</button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="products_details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%"> Name of Product</th>
                                            <th style="width: 8%"> A.R.No </th>
                                            <th style="width: 8%"> Sampled on </th>
                                            <th style="width: 8%"> Sample by</th>
                                            <th style="width: 8%"> Analyzed on</th>
                                            <th style="width: 8%"> Observed on </th>
                                            <th style="width: 5%"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="products_details[0][serial]" value="1"></td>
                                            <td><input type="text" name="products_details[0][product_name]"></td>
                                            <td><input type="text" name="products_details[0][product_AR_No]"></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="sampled_on" readonly placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="products_details[0][sampled_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'sampled_on')">
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td><input type="text" name="products_details[0][sample_by]"></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="analyzed_on" readonly placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="products_details[0][analyzed_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'analyzed_on')">
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="observed_on" readonly placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="products_details[0][observed_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'observed_on')">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!---------------- grid-5 instrument_detail----------------------------------- -->

                         <div class="group-input">
                            <label for="audit-agenda-grid">
                                Instrument details
                                <button type="button" name="audit-agenda-grid" id="instrument_detail">+</button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="instrument_details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%"> Name of instrument</th>
                                            <th style="width: 8%"> Instrument Id Number</th>
                                            <th style="width: 8%"> Calibrated On</th>
                                            <th style="width: 8%"> Calibrated Due Date</th>
                                            <th style="width: 5%"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="instrument_detail[0][serial]" value="1"></td>
                                            <td><input type="text" name="instrument_detail[0][instrument_name]"></td>
                                            <td><input type="text" name="instrument_detail[0][instrument_id_number]"></td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <div class="calenderauditee">
                                                            <input type="text" id="calibrated_on" readonly placeholder="DD-MM-YYYY" />
                                                            <input type="date" name="instrument_detail[0][calibrated_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            class="hide-input" oninput="handleDateInput(this, 'calibrated_on')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <div class="calenderauditee">
                                                            <input type="text" id="calibratedduedate_on" readonly placeholder="DD-MM-YYYY" />
                                                            <input type="date" name="instrument_detail[0][calibratedduedate_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            class="hide-input" oninput="handleDateInput(this, 'calibratedduedate_on')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton on-submit-disable-button">Save</button>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date">Workbench Evaluation</label>
                                <div class="col-md-12 4">
                                    <div class="group-input">
                                        <textarea class="summernote" name="Comments_plidata" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="checklists">Checklists</label>
                                <select multiple  id="checklists" class="abc" name="checklists[]">
                                    <option value="pH-Viscometer-MP">CheckList - pH-Viscometer-MP</option>
                                    <option value="Dissolution">CheckList - Dissolution</option>
                                    <option value="HPLC-GC">CheckList - HPLC-GC</option>
                                    <option value="General-checklist">CheckList - General checklist</option>
                                    <option value="KF-Potentiometer">CheckList - KF-Potentiometer</option>
                                    <option value="RM-PM Sampling">CheckList - RM-PM Sampling</option>
                                    <option value="Bacterial-Endotoxin-Test">Checklist - Bacterial Endotoxin Test</option>
                                    <option value="Sterility">Checklist - Sterility</option>
                                    <option value="Water-Test">Checklist - Microbial Limit Test/Bioburden And Water Test</option>
                                    <option value="Microbial-assay">Checklist - Microbial Assay</option>
                                    <option value="Environmental-Monitoring">Checklist - Environmental Monitoring</option>
                                    <option value="Media-Suitability-Test">Checklist - Media Suitability Test</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Checklist Outcome</label>
                                <textarea class="summernote" name="justify_if_no_field_alert_pli" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="RootCause">Immediate Action Taken</label>
                                <textarea name="root_comment" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date">Delay Justification For Investigation</label>
                                    <textarea class="summernote" name="justify_if_no_analyst_int_pli" id="summernote-1">
                                    </textarea>

                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date">Analyst Interview Details</label>
                                    <textarea class="summernote" name="analyst_interview_pli" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">Analyst Interview Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attachments_pli"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachments_pli[]"
                                            oninput="addMultipleFiles(this, 'file_attachments_pli')" multiple>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Any Other Cause/Suspected Cause</label>
                                <textarea id="Any_other_cause" name="Any_other_cause"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Any Other Batches Analyzed</label>
                                <textarea id="Any_other_batches" name="Any_other_batches"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Details Of Trend</label>
                                <textarea id="details_of_trend" name="details_of_trend"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Assignable Cause And Rational For Assignable Cause</label>
                                <textarea id="rational_for_assingnable" name="rational_for_assingnable"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Summary Of Investigation</label>
                                <textarea class="summernote" name="summary_of_prelim_investiga_plic" id="summernote-1"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">OOS/OOT Cause Identified</label>
                                <select name="phase_i_investigation_pli">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Auditor">OOS category </label>
                                <select id="assignableSelect1" name="root_cause_identified_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Analyst">Analyst</option>
                                    <option value="Instrument">Instrument </option>
                                </select>
                            </div>
                        </div> --}}

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            toggleRootCauseInput(); // Call this on page load to ensure correct display

                            function toggleRootCauseInput() {
                                var selectValue = document.getElementById("assignableSelect1").value.toLowerCase(); // Convert to lowercase for consistency
                                var rootCauseGroup1 = document.getElementById("rootCauseGroup1");
                                var rootCauseTextarea = document.getElementById("rootCauseTextarea");

                                if (selectValue === "yes") {
                                    rootCauseGroup1.style.display = "block";  // Show the textarea if "yes" is selected
                                    rootCauseTextarea.setAttribute('', '');  // Make textarea required
                                } else {
                                    rootCauseGroup1.style.display = "none";   // Hide the textarea if "no" is selected
                                    rootCauseTextarea.removeAttribute('');  // Remove required attribute
                                }
                            }

                            // Attach the event listener
                            document.getElementById("assignableSelect1").addEventListener("change", toggleRootCauseInput);
                        });
                        </script>

                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Auditor">Root Cause Identified</label>
                                <!-- <div class="text-primary">Please Choose the relevent units</div> -->
                                <select name="root_cause_identified_plic" id="assignableSelect1" onchange="toggleRootCauseInput()">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Root Cause</label>
                                <select name="is_repeat_assingable_ooc" id="assignableSelect1" onchange="toggleRootCauseInput()">
                                    <option value="NA">Select</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="rootCauseGroup1" style="display: none;">
                            <div class="group-input">
                                <label for="RootCause">Comments</label>
                                <textarea name="root_comment" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here"></textarea>
                            </div>
                        </div>
                        <script>
                            function toggleRootCauseInput() {
                            var selectValue = document.getElementById("assignableSelect1").value;
                            var rootCauseGroup1 = document.getElementById("rootCauseGroup1");

                            if (selectValue === "YES") {
                                rootCauseGroup1.style.display = "block";  // Show the textarea if "YES" is selected
                            } else {
                                rootCauseGroup1.style.display = "none";   // Hide the textarea if "NO" or "NA" is selected
                            }
                        }

                        </script> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Team">OOS/OOT Category</label>
                                <select name="oos_category_root_cause_ident_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Analyst Error">Analyst Error</option>
                                    <option value="Instrument Error">Instrument Error</option>
                                    <option value="Product/Material Related Error">Product/Material Related Error</option>
                                    <option value="Other Error">Other Error</option>
                                    <option value="NA">NA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS/OOT Category (If Others)</label>
                               <textarea class="summernote" name="oos_category_others_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">CAPA Required</label>
                                <select name="capa_required_plic">
                                <option value="">--Select---</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Agenda">Reference CAPA No.</label>
                                <input type="text" name="reference_capa_no_plic" id="reference_capa_no_plic">
                            </div>
                        </div>
                        {{-- <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Delay Justification for Preliminary Investigation</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="delay_justification_for_pi_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Root Cause Details</label>
                                <textarea class="summernote" name="root_cause_details_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div> --}}
                        {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Supporting Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="supporting_attachment_plic"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachment_plic[]"
                                            oninput="addMultipleFiles(this, 'supporting_attachment_plic')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS/OOT Review For Similar Nature</label>
                                <textarea class="summernote" name="review_comments_plir" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>

                        {{-- <div class="sub-head">OOS Review for Similar Nature</div> --}}

                        <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
                        {{-- <div class="group-input">
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
                                            <th style="width: 16%"> OOS Reported Date</th>
                                            <th style="width: 12%">Description of OOS</th>
                                            <th style="width: 8%">Previous OOS Root Cause</th>
                                            <th style="width: 8%"> CAPA</th>
                                            <th style="width: 16% pt-3">Closure Date of CAPA</th>
                                            <th style="width: 16%">CAPA Requirement</th>
                                            <th style="width: 16%">Reference CAPA Number</th>
                                            <th style="width: 4%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="oos_capa[0][serial]" value="1"></td>
                                            <td><input type="text" id="info_oos_number" name="oos_capa[0][info_oos_number]" value=""></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_oos_reported_date" disabled
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="oos_capa[0][info_oos_reported_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_oos_reported_date')">
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td><input type="text" name="oos_capa[0][info_oos_description]" value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_previous_root_cause]"value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa]" value=""></td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_oos_closure_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="oos_capa[0][info_oos_closure_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_oos_closure_date')">
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td><select name="oos_capa[0][info_oos_capa_requirement]">
                                                   <option value="">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa_reference_number]" value=""></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Start Date"> Phase IB Inv. Required?</label>
                                <select name="phase_ib_inv_required_plir">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
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
                                <label for="Lead Auditor">Retest/Re-measurement Required</label>
                                <select name="root_cause_identified_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Resampling Required</label>
                                <select name="is_repeat_assingable_pia">
                                    <option value="">Select</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Repeat Testing Required </label>
                                <select name="repeat_testing_pia">
                                    <option value="">Select</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Results of Retest/Re-measurement</label>
                                <textarea class="summernote" name="Description_Deviation" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Results Of Repeat Testing</label>
                                <textarea class="summernote" name="result_of_repeat" id="summernote-1"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="deviation_time">Impact Assessment</label>
                                <textarea id="impact_assesment_pia" name="impact_assesment_pia"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments"> Supporting Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="supporting_attachments_plir"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                            oninput="addMultipleFiles(this, 'supporting_attachments_plir')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm27" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">HOD Primary Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remark</label>
                                <input type="text" name="hod_remark1" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">HOD Primary Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment1"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment1[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment1')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm28" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">CQA/QA Head</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark</label>
                                <input type="text" name="QA_Head_remark1" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">CQA/QA Head Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment1"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment1[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment1')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm29" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">CQA/QA Head Primary Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark</label>
                                <input type="text" name="QA_Head_primary_remark1" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">CQA/QA Head Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment1"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment1[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment1')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm30" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IA HOD Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Remark</label>
                                <input type="text" name="hod_remark2" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment2"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment2[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment2')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm31" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IA CQA/QA Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark2" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment2"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment2[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment2')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm32" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IA CQAH/QAH Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQAH/QAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark2" placeholder="Enter your Remark">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Assignable cause found">Phase IA Assignable Cause Found</label>
                                <select name="assign_cause_found" id="assign_cause_found">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase-IA CQAH/QAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment2"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment2[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment2')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm42" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IB Investigation</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Outcome of Phase IA Investigation</label>
                                <textarea id="outcome_phase_IA"  name="outcome_phase_IA" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Reason for proceeding to Phase IB Investigation</label>
                                <textarea id="reason_for_proceeding"  name="reason_for_proceeding" ></textarea>
                            </div>
                        </div>
                        <div class="col-12">

                                <label style="font-weight: bold; for="Audit Attachments">Phase IB Investigation Checklist</label>

                                    @php
                                        $IIB_inv_questions = array(
                                                "Analyst Interview required",
                                                "Raw data Examination (Examination of raw data, including chromatograms and spectra; any anomalous or suspect peaks or data)",
                                                "The analyst is trained on the method.",
                                                "Any Previous issues with this test",
                                                "Other potentially interfering testing/activities occurring at the time of the test",
                                                "Review of other data (Review of other data for other batches performed within the same analyst set)",
                                                "Other OOS results (Consideration of any other OOS results obtained on the batch of material under test)",
                                                "Assessment of method validation (Assessment of method validation and clarity of instructions in the worksheet)",
                                                "Adequacy of instructions (Assessment of the adequacy of instructions in the STP procedure)",
                                                "Any issues with environmental temperature/humidity within the area which the test was conducted.",
                                                "Reoccurrence (Whether any similar occurrence(s) with the analysis earlier)",
                                                "Observation Error (Analyst) [Any other observation Error]",
                                            );
                                    @endphp
                            <div class="group-input">
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
                                            @foreach ($IIB_inv_questions as $IIB_inv_question)
                                                <tr>
                                                    <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                    <td><input type="text" readonly name="question[]" value="{{ $IIB_inv_question }}">
                                                    </td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="checklist_IB_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                <option value="">Enter Your Selection Here</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                                <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="checklist_IB_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Summary Of Review</label>
                                <textarea id="summaryy_of_review"  name="summaryy_of_review" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Probable Cause Identification</label>
                                <textarea id="Probable_cause_iden"  name="Probable_cause_iden" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="checklists">Proposal For Phase IB hypothesis</label>
                                <select multiple id="reference_record" name="proposal_for_hypothesis_IB[]">
                                    <option value="">--Select---</option>
                                    <option value="Re-injection of the original vial"
                                        {{ in_array('Re-injection of the original vial', old('proposal_for_hypothesis_IB', $selectedHypotheses ?? [])) ? 'selected' : '' }}>
                                        Re-injection of the original vial
                                    </option>
                                    <option value="Re-filtration and Injection from final dilution"
                                        {{ in_array('Re-filtration and Injection from final dilution', old('proposal_for_hypothesis_IB', $selectedHypotheses ?? [])) ? 'selected' : '' }}>
                                        Re-filtration and Injection from final dilution
                                    </option>
                                    <option value="Re-dilution from the tock solution and injection"
                                        {{ in_array('Re-dilution from the tock solution and injection', old('proposal_for_hypothesis_IB', $selectedHypotheses ?? [])) ? 'selected' : '' }}>
                                        Re-dilution from the tock solution and injection
                                    </option>
                                    <option value="Re-sonication / re-shaking due to probable incomplete solubility and analyze"
                                        {{ in_array('Re-sonication / re-shaking due to probable incomplete solubility and analyze', old('proposal_for_hypothesis_IB', $selectedHypotheses ?? [])) ? 'selected' : '' }}>
                                        Re-sonication / re-shaking due to probable incomplete solubility and analyze
                                    </option>
                                    <option value="Other"
                                        {{ in_array('Other', old('proposal_for_hypothesis_IB', $selectedHypotheses ?? [])) ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Others</label>
                                <textarea id="proposal_for_hypothesis_others"  name="proposal_for_hypothesis_others" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Details of Results (Including original OOS/OOT results for side by side comparison)</label>
                                <textarea id="details_of_result"  name="details_of_result" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Probable Cause Identified In Phase IB investigation</label>
                                <select id="Probable_Cause_Identified" name="Probable_Cause_Identified">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Any Other Comments/ Probable Cause Evidence</label>
                                <textarea id="Any_other_Comments"  name="Any_other_Comments" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Proposal For Hypothesis Testing To Confirm Probable Cause Identified</label>
                                <textarea id="Proposal_for_Hypothesis"  name="Proposal_for_Hypothesis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Summary Of Hypothesis</label>
                                <textarea id="Summary_of_Hypothesis"  name="Summary_of_Hypothesis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Assignable Cause</label>
                                <select id="Assignable_Cause" name="Assignable_Cause">
                                    <option value="">--Select---</option>
                                    <option value="Found">Found</option>
                                    <option value="Not Found">Not Found</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">No Assignable Cause</label>
                                <select id="No_Assignable_Cause" name="No_Assignable_Cause">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Types Of Assignable Cause</label>
                                <select id="Types_of_assignable" name="Types_of_assignable">
                                    <option value="">--Select---</option>
                                    <option value="Analyst error">Analyst error</option>
                                    <option value="Instrument error">Instrument error</option>
                                    <option value="Method error">Method error</option>
                                    <option value="Environment">Environment</option>
                                    <option value="Other">Other</option>
                                    <option value="NA">NA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Others</label>
                                <textarea id="Types_of_assignable_others"  name="Types_of_assignable_others" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Evaluation of Phase IB investigation Timeline</label>
                                <textarea id="Evaluation_Timeline"  name="Evaluation_Timeline" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Is Phase IB investigation Timeline Met</label>
                                <select id="timeline_met" name="timeline_met">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If No, Justify For Timeline Extension</label>
                                <textarea id="timeline_extension"  name="timeline_extension" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">CAPA Applicable</label>
                                <textarea id="CAPA_applicable"  name="CAPA_applicable" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Resampling Required </label>
                                <select id="resampling_required_ib" name="resampling_required_ib">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Repeat Testing Required</label>
                                <select id="repeat_testing_ib" name="repeat_testing_ib">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Repeat Testing Plan</label>
                                <textarea id="Repeat_testing_plan"  name="Repeat_testing_plan" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Phase II Investigation Required</label>
                                <select id="phase_ii_inv_req_ib" name="phase_ii_inv_req_ib">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Production Person</label>
                                <select id="production_person_ib" name="production_person_ib">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned To">Production Person</label>
                                <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                    name="production_person_ib" placeholder="Select Production Person">
                                    <option value="">-- Select --</option>

                                    @if (!empty(Helpers::getProductionDropdown()))
                                        @foreach (Helpers::getProductionDropdown() as $lan)
                                            <option value="{{ $lan['id'] }}">
                                                {{ $lan['name'] }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Repeat Analysis Method/Resampling</label>
                                <textarea id="Repeat_analysis_method"  name="Repeat_analysis_method" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Details Of Repeat Analysis</label>
                                <textarea id="Details_repeat_analysis"  name="Details_repeat_analysis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Impact Assessment</label>
                                <textarea id="Impact_assessment1"  name="Impact_assessment1" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Conclusion</label>
                                <textarea id="Conclusion1"  name="Conclusion1" ></textarea>
                            </div>
                        </div>
                        <!-- -----------thik hai -->

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">File Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attachment_IB_Inv"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachment_IB_Inv[]"
                                            oninput="addMultipleFiles(this, 'file_attachment_IB_Inv')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm43" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IIB Investigation</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Summary Of Investigation</label>
                                <textarea id="Summary_Of_Inv_IIB"  name="Summary_Of_Inv_IIB" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">CAPA Required</label>
                                <select name="capa_required_IIB">
                                <option value="">--Select---</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Agenda">Reference CAPA No.</label>
                                <input type="text" name="reference_capa_IIB">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Attachments">Resampling Required IIB Inv.</label>
                                <select name="resampling_req_IIB">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">Repeat Testing Required IIB Inv.</label>
                                <select name="Repeat_testing_IIB">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Results Of Repeat Testing IIB Inv.</label>
                                <textarea id="result_of_rep_test_IIB"  name="result_of_rep_test_IIB" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Laboratory Investigation Hypothesis Details</label>
                                <textarea id="Laboratory_Investigation_Hypothesis"  name="Laboratory_Investigation_Hypothesis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Outcome Of Laboratory Investigation</label>
                                <textarea id="Outcome_of_Laboratory"  name="Outcome_of_Laboratory" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Evaluation</label>
                                <textarea id="Evaluation_IIB"  name="Evaluation_IIB" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Assignable Cause</label>
                                <select id="Assignable_Cause111" name="Assignable_Cause111">
                                    <option value="">--Select---</option>
                                    <option value="Found">Found</option>
                                    <option value="Not Found">No Found</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">No Assignable Cause</label>
                                <select id="No_Assignable_Cause111" name="No_Assignable_Cause111">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If Assignable Cause Identified Perform Re-testing</label>
                                <textarea id="If_assignable_cause"  name="If_assignable_cause" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If Assignable Cause Is Not Identified Proceed As Per Phase III Investigation</label>
                                <textarea id="If_assignable_error"  name="If_assignable_error" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IIB inv. Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="phaseII_attachment"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="phaseII_attachment[]"
                                            oninput="addMultipleFiles(this, 'phaseII_attachment')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="phase_IIB_attachment"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="phase_IIB_attachment[]"
                                            oninput="addMultipleFiles(this, 'phase_IIB_attachment')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm44" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">pH meter</div>
                    <div class="row">
                                    @php
                                    $ph_meter_questions = array(
                                            "Was instrument calibrated before start of analysis?",
                                            "Was temperature sensor working efficiently?",
                                            "Was pH electrode stored properly?",
                                            "Was sampled prepared as per STP?",
                                            "Was sufficient quantity of sample to ensure that the sensor is properly dipped?",
                                            "Was electrode filling solution sufficient inside the electrode?",
                                            "Were instrument properly connected at the time of analysis?",
                                        );
                                @endphp
                                                <div class="group-input">
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
                                                                @foreach ($ph_meter_questions as $ph_meter_question)
                                                                    <tr>
                                                                        <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                                        <td><input type="text" readonly name="question[]" value="{{ $ph_meter_question }}">
                                                                        </td>
                                                                        <td>
                                                                            <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                                <select name="ph_meter[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                                    <option value="">Enter Your Selection Here</option>
                                                                                    <option value="Yes">Yes</option>
                                                                                    <option value="No">No</option>
                                                                                    <option value="N/A">N/A</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td style="vertical-align: middle;">
                                                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                                                <textarea name="ph_meter[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                                <div class="sub-head">Viscometer</div>
                                                        @php
                                                            $Viscometer_questions = array(
                                                                    "Was instrument calibrated before start of analysis?",
                                                                    "Was sampled prepared as per STP?",
                                                                    "Was correct spindle used for analysis?",
                                                                    "Was Sufficient quantity used to performed the analysis?",
                                                                );
                                                        @endphp
                                                                        <div class="group-input">
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
                                                                                        @foreach ($Viscometer_questions as $Viscometer_question)
                                                                                            <tr>
                                                                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                                                                <td><input type="text" readonly name="question[]" value="{{ $Viscometer_question }}">
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                                                        <select name="Viscometer[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                                                            <option value="">Enter Your Selection Here</option>
                                                                                                            <option value="Yes">Yes</option>
                                                                                                            <option value="No">No</option>
                                                                                                            <option value="N/A">N/A</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td style="vertical-align: middle;">
                                                                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                                                                        <textarea name="Viscometer[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>

                                                                        </div>

                                                                       <div class="sub-head">Melting Point</div>
                                                                        @php
                                                                        $Melting_Point_questions = array(
                                                                                "Was instrument calibrated before start of analysis?",
                                                                                "Was sampled prepared as per STP?",
                                                                                "Was sampled properly filled inside the capillary tube?",
                                                                                "Were instrument properly connected at the time of analysis?",
                                                                                "Was temperature of the instrument as per STP?",
                                                                                "Was temperature acquired during analysis?",
                                                                                "Was analyst verified the oil is filled up to the level before start of analysis?",
                                                                            );
                                                                    @endphp
                                                                    <div class="group-input">
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
                                                                                    @foreach ($Melting_Point_questions as $Melting_Point_question)
                                                                                        <tr>
                                                                                            <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                                                            <td><input type="text" readonly name="question[]" value="{{ $Melting_Point_question }}">
                                                                                            </td>
                                                                                            <td>
                                                                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                                                    <select name="Melting_Point[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                                                        <option value="">Enter Your Selection Here</option>
                                                                                                        <option value="Yes">Yes</option>
                                                                                                        <option value="No">No</option>
                                                                                                        <option value="N/A">N/A</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td style="vertical-align: middle;">
                                                                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                                                                    <textarea name="Melting_Point[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm45" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Dissolution</div>
                    <div class="row">
                        <div class="col-12">

                            <label style="font-weight: bold; for="Audit Attachments">Dissolution</label>

                              @php
                            $Dis_solution_questions = array(
                                    "Was dissolution appartus in calibrated state?",
                                    "Was the instrument parameter as per STP?",
                                    "Was the bowl temperature at the start and end of analysis as per STP ?",
                                    "Was dissolution appartus clean before analysis?",
                                    "Were the pH of dissolution medium as per STP?",
                                    "Was correct volume of dissolution medium used for analysis?",
                                    "Was correct Appartus used as per STP ?",
                                    "Was the water level of dissolution bath as per SOP/recommendation?",
                                    "Was Tablet/capsule/suspention dropped manually or was placed on dispensing tablet?",
                                    "Was sampling involve profilling dissolution?",
                                    "Was sampling done manually or using auto sampler?",
                                    "Was filtration done immediately after sampling?",
                                    "Was there any dilution of sample after withdrawl of sample?",
                                    "Was correct  filter used for dilution?",
                                    "While performing profilling ,  Does sample withdrawl at specific timeline as per STP?",
                                    "Was Glassware used as per STP?",
                                    "Was bowl temperature found 37°C ± 0.5 before start of analysis?",
                                    "Is method validation/verification available ?",
                                );
                             @endphp
                        <div class="group-input">
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
                                        @foreach ($Dis_solution_questions as $Dis_solution_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                <td><input type="text" readonly name="question[]" value="{{ $Dis_solution_question }}">
                                                </td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="Dis_solution[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Dis_solution[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm46" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">HPLC-GC</div>
                    <div class="row">
                        <div class="col-12">

                            <label style="font-weight: bold; for="Audit Attachments">HPLC-GC</label>

                            @php
                         $HPLC_GC_questions = array(
                                 "Was analyst used correct column as per mentioned in STP?",
                                 "Was Chromatography Condition/Instrument Parameter like Retention time, wavelength, flow rate, injection volume, column temperature and autos ampler temperature as per mentioned in STP?",
                                 "Was inlet filter sonicated before start of analysis?",
                                 "Was suction of port A,port B,port C,port D and rinse port are working correctly?",
                                 "Was corrected rinse solution used for analysis as per SOP? ",
                                 "Was Buffer prepared as per mentioned in STP?",
                                 "Is mobile phase within validity periods?",
                                 "Is seal wash performed properly?",
                                 "Whether analyst used corrected solution for column wash/seal wash before start of analysis as per SOP ?",
                                 "Was buffer solution filtered before start of analysis?",
                                 "Was mobile phase maintained in recommended storage condition as per SOP/STP?",
                                 "Was mobile phase sonicated before start of analysis?",
                                 "Was sonication performed with appropriate time line or as per mentioned in STP?",
                                 "Was mobile phase ration maintained as per STP?",
                                 "Was Mobile phase prepared as per mentioned in STP?",
                                 "Was buffer/ mobile phase pH as per STP?",
                                 "Was mobile phase degassed before start of analysis?",
                                 "Whether analyst used correct water for mobile phase,diluent, sample and standard preparation?",
                                 "Was purge valve was closed before start of analysis?",
                                 "Was the vial position as per mentioned in printed sequence?",
                                 "Was analyst used appropriate test tubes for analysis?",
                                 "Was septa of vial/fitment of septa/ filament of cap proper?",
                                 "were capping/crimping of GC vial/HPLC Vial done properly?",
                                 "Was analyst used the Bonded septa for analysis?",
                                 "Was analyst used cleaned septa for analysis?",
                                 "Was vial labelled as per SOP?",
                                 "Is there any bubble observed inside pump port?",
                                 "Was vial filled 3/4th capacity ?",
                                 "Is There any pressure fluctuation observed in sample and standard run ?",
                                 "Is it correct placebo used during the analysis?",
                                 "Was the Glassware's used for preparation of same manufacture's?",
                                 "Was standard and sample weighed & prepared as per STP?",
                                 "Was analyst used correct dilution solution and made as per mentioned in STP?",
                                 "Was analyst used correct filtration technique for analysis of sample?",
                                 "Were all solutions injected within Validity periods?",
                                 "Is there any sign of unfiltered and non degassed mobile phase?",
                                 "Is there any system back pressure/Leakage observed during analysis?",
                                 "Is system suitability result as per acceptance criteria?",
                                 "Is there any hump interfering to peak integration, spilt peak observed?",
                                 "Is peak integrated properly?",
                                 "Is there any anomalous chromatographic elution pattern observed?",
                                 "Were environmental condition within properly?",
                                 "Is Instrument calibrated state ?  ",
                                 "Was cylinder level good before start of analysis?",
                                 "Was instrument connected to properly during analysis?(Communication failure)",
                                 "Was glass liner cleaned before analysis?",
                                 "Was glass wool maintained properly? (change in color white to brown or black)",
                                 "Was auto sampler work efficiently?",
                                 "Is there color changes observed in oxytrap before and after analysis?(Check silica color)",
                                 "Was jet cleaned before analysis?",
                                 "Is there any leakage in cylinder?",
                                 "Was column fitted properly before  start of analysis?(Check Ferrules and nuts)",
                                 "Was vial rack work efficiently?",
                                 "Was elevator movement up and down efficiently?",
                                 "was column conditioning  before start of analysis?",
                                 "Is there any column breakage observed during analysis?",
                                 "was there syringe blockage check before analysis?",
                                 "Was vial over-fitted?",
                                 "Was analyst change the rubber septa before start of analysis?",
                                 "Was chemical used of GC Grade?",
                                 "Was calibrated micropipettes used for analysis?",
                                 "Was tips sterilized before used?",
                                 "Is method validation/verification available ?",
                             );
                     @endphp
                        <div class="group-input">
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
                                        @foreach ($HPLC_GC_questions as $HPLC_GC_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                <td><input type="text" readonly name="question[]" value="{{ $HPLC_GC_question }}">
                                                </td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="HPLC_GC[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="HPLC_GC[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm47" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">General Checklist</div>
                    <div class="row">
                        <div class="col-12">

                            <label style="font-weight: bold; for="Audit Attachments">General Checklist</label>

                            @php
                            $General_Checklist_questions = array(
                                    "Was solid/Liquid Chemical used as per STP?",
                                    "Was chemical used within validity periods?",
                                    "Was correct chemical grade used for analysis?",
                                    "Was analyst weighed the chemical as per mentioned in STP?",
                                    "Was analyst used correct Reagent/Volumentrick solution for analysis?",
                                    "Were analyst used Cleaned and  Dried Glassware like volumetrik flask,
                                    Pippete,separating funnel & Beaker ? ",
                                    "Wheather analyst used corrected glassware's as per mentioned in STP?",
                                    "Is correct formulae used for calculation?",
                                    "Is correct response used for calculation?",
                                    "Is there any unauthorized change made in the formulae for calculation in excel sheet used for calculation",
                                    "Are correct weights, area count, dilution, factors transcribed in calculation sheet?",
                                    "Is correct specification, standard analytical procedure and version number used for analysis?",
                                    "Is analyst Qualified to performed the analysis? (Qualificaition number)",
                                    "Did analyst identify any usual finding during analysis?(Eg :- sample preparation,standard preparation)",
                                    "Was sample store as per storage condition?",
                                    "Was correct sample used for analysis?",
                                    "Was there any unusual obervation with respect to description of sample?",
                                    "Was correct Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard used for analysis?",
                                    "Was potency of Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard as per COA?",
                                    "Was Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard stored as per storage conditons?",
                                    "Wheather instrument parameter as per STP?",
                                    "Was Balance used for weighing within weighing range?",
                                    "Was Balance used withing validity periods?",
                                    "Was standard/Sample weights as per STP?",
                                    "Was there any spillage reported by analyst during weighing and transfer?",
                                    "Was sample/Standard diluted as per STP?",
                                    "Was solution stored as per storage requirements?",
                                    "Were chemical/Reagets used of same grade as per STP?",
                                    "Were chemical/Reagets used within validity/Expiry periods as per STP?",
                                    "Was correct filters and filtration technque used as STP?",
                                    "Was sonication time and temperature maintained as per STP?",
                                    "Were volumetric solution stored as per recommeded storage conditon?",
                                    "Were volumetric solution used within validity periods?",
                                    "Was appearance of sample solution satisfactory?",
                                    "Was validated analytical method used for analysis?",
                                    "Was method of analysis is inline with pharmacopial methods?",
                                    "Is instrument used for analysis in calibrated state?",
                                    "Is there any instrument breckdown before start of analysis?",


                                );
                        @endphp
                        <div class="group-input">
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
                                        @foreach ($General_Checklist_questions as $General_Checklist_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                <td><input type="text" readonly name="question[]" value="{{ $General_Checklist_question }}">
                                                </td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="General_Checklist[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="General_Checklist[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm48" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">kF/Potentionmeter</div>
                    <div class="row">
                        <div class="col-12">

                            <label style="font-weight: bold; for="Audit Attachments">kF/Potentionmeter</label>

                            @php
                         $kF_Potentionmeter_questions = array(
                                 "Was Correct Reagent used for analysis?",
                                 "Was dried methanol used for analysis?",
                                 "Was bureate withn calibrated state?",
                                 "Was kF reagent used within validity periods?",
                                 "Was sample quantity transfer comppletely in titration vessel ?",
                                 "Is there any sample spillage observed on side walls of titration vessel  or out side of titration vessel?",
                                 "Was silica found in good condition ?",
                                 "Was electrode was saturated before start of analysis?",
                                 "Was there any drift observed during analysis?",
                                 "Was correct electrode used for analysis?",
                                 "was power plug connection secure through out analsis?",
                                 "Was inlet tube found bubble free ?",
                                 "Was sample weight taken as per STP?",
                                 "Was standardization performed before start of analysis?",
                                 "Was electrode condtioning before start of analysis?",
                                 "Is RSD of KF within limit as per SOP/STP?",
                                 "Was activated desiccant used?",
                                 "Was tip of nozzle correctly attached with delivery tube of volumetric solution reservior?",

                             );
                     @endphp
                        <div class="group-input">
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
                                        @foreach ($kF_Potentionmeter_questions as $kF_Potentionmeter_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                <td><input type="text" readonly name="question[]" value="{{ $kF_Potentionmeter_question }}">
                                                </td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="kF_Potentionmeter[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="kF_Potentionmeter[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm49" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">RM-PM Sampling</div>
                    <div class="row">
                        <div class="col-12">

                            <label style="font-weight: bold; for="Audit Attachments">Sampling Checklist</label>

                            @php
                            $RM_PM_questions = array(
                                    "Was analyst Varified the GRN as per received samples?",
                                    "Was analyst used calibrated balanced for sampling ?",
                                    "Was analyst performed the correct sampling procedure?",
                                    "Was sampling performed by trained personal?",
                                    "Was analyst used the cleaned sampling tools for analysis?",
                                    "Was  analyst used correct container for sampling ?",
                                    "Was sample handled as per SOP?",
                                    "Was any deviation observed during the receipt of material?",
                                    "Was the material shipped as per recommended Transportation storage condition?",
                                    "Is the COA received with material complying with the specification and no discrepancy was observed?",
                                    "Was analyst performed the sampling inside the LAF?",
                                    "Was the prefilter pressure efficient before start of sampling?",
                                    "Was material stored as per recommeded storage conditon?",

                                 );
                           @endphp
                        <div class="group-input">
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
                                        @foreach ($RM_PM_questions as $RM_PM_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                <td><input type="text" readonly name="question[]" value="{{ $RM_PM_question }}">
                                                </td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="RM_PM[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="RM_PM[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm50" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head"> Checklist for Analyst Training and Procedure </div>
                            @php
                            $check_analyst_training_procedures = [
                            [
                            'question' => "Is the analyst trained/qualified BET test procedure?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Reference procedure number :-",
                            'is_sub_question' => true,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Effective date",
                            'is_sub_question' => true,
                            'input_type' => 'date'
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
                            'question' => "Analyst interview record",
                            'is_sub_question' => true,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Analyst interview record",
                            'is_sub_question' => true,
                            'input_type' => 'number'
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

                                                    @foreach ($check_analyst_training_procedures as $index => $review_item)
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
                                                                <input type="date" name="analyst_training_procedure[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="analyst_training_procedure[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="analyst_training_procedure[{{$loop->index}}][response]"
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
                                                                <textarea name="analyst_training_procedure[{{$loop->index}}][remark]"
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

                            <div class="sub-head">Sample receiving & verification in lab</div>
                                @php
                                        $check_sample_receiving_vars = [
                                        [
                                        'question' => "Was the sample container (Physical integrity) verified at the time of sample receipt?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Was the correct quantity of the sample withdrawn ?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Was there any discrepancy observed during sampling ?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Was the sample container (Physical integrity) checked before testing ? ",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
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
                                                        $main_question_index = 1.0;
                                                        $sub_question_index = 0;
                                                    @endphp

                                                    @foreach ($check_sample_receiving_vars as $index => $review_item)
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
                                                                <input type="date" name="sample_receiving_var[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="sample_receiving_var[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="sample_receiving_var[{{$loop->index}}][response]"
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
                                                                <textarea name="sample_receiving_var[{{$loop->index}}][remark]"
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

                            <div class="sub-head">Method /Procedure Used During Analysis</div>

                            @php
                            $check_method_procedure_during_analysis = [
                            [
                            'question' => "Was correct applicable specification/Test procedure/MOA/ used for analysis ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Verified specification/Test procedure/MOA No.",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was the test procedure followed as per method validation ?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was the any change in the validated change method ?if yes, was test performed with the new validated method ?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was BET reagents (Lysate ,CSE,LRW and Buffer) procured from the approved vender ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was lysate and CSE stored at the recommended temp.and duration? Storage condition:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were all product /reagents contact parts of BET testing (Tips/Accessories /Sample Container) depayrogenated ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Assay tube /Batch No.",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Expiry date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Tipe lot /Batch No.",
                            'is_sub_question' => false,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Expiry date:",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Was the test done at correct MVD as per validated method ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were calculation of MVD/Test dilution done correctly?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were correct dilutions prepared ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was labeled claim lysate sensitivity checked before the use of the lot?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were all reagents (LRW/CSE and Lysate) used in the test with in the expiry?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "LRW expiry date?",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "CSE expiry date?",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Lysate expiry date?",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Buffer expiry date?",
                            'is_sub_question' => false,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Was рН of the test sample/dilution verified?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were appropriate рН strip /measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were proper incubation conditions followed ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],

                            [
                            'question' => "Was there any spillage that occurred during the vortexing of dilutions?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were the results of positive, negative and test controls found satisfactory?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Is the test incubator /heating block kept on a vibration –free surface ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
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
                                                    @php
                                                        $main_question_index = 1.0;
                                                        $sub_question_index = 0;
                                                    @endphp

                                                    @foreach ($check_method_procedure_during_analysis as $index => $review_item)
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
                                                                <input type="date" name="method_used_during_analysis[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="method_used_during_analysis[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="method_used_during_analysis[{{$loop->index}}][response]"
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
                                                                <textarea name="method_used_during_analysis[{{$loop->index}}][remark]"
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

                            <div class="sub-head">Instrument/Equipment Details</div>

                            @php
                            $check_Instrument_Equipment_Details = [
                                [
                                'question' => "Was the equipment used, calibrated/qualified and within the specified range? ",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Dry block /Heating block equipment ID:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Calibration date & Next due date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Pipettes ID:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Calibration date and Next due date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Refrigerator (2-8̊ C) ID:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Validation date and next due date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Dehydrogenation over ID:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Validation date and next due date:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the depyrogenation done as per the validated load pattern?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was assay tubes incubated in the dry block (time and temp).as specified in the procedure?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were any other samples tested along with this sample?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "If yes, whether those sample’s results found satisfactory?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were any other sample’s analyzed on the same time on the same instruments ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "If yes, what were the results of other Batches:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
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
                                                    @php
                                                        $main_question_index = 1.0;
                                                        $sub_question_index = 0;
                                                    @endphp

                                                    @foreach ($check_Instrument_Equipment_Details as $index => $review_item)
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
                                                                <input type="date" name="instrument_equipment_detailss[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="instrument_equipment_detailss[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="instrument_equipment_detailss[{{$loop->index}}][response]"
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
                                                                <textarea name="instrument_equipment_detailss[{{$loop->index}}][remark]"
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

                            <div class="sub-head">Results And Calculation</div>
                            @php
                            $Results_and_Calculation = [
                                [
                                'question' => "Were results taken properly ?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Raw data checked By……………….",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was formula dilution factor used for calculating the results corrected?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
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
                                                        $main_question_index = 1.0;
                                                        $sub_question_index = 0;
                                                    @endphp

                                                    @foreach ($Results_and_Calculation as $index => $review_item)
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
                                                                <input type="date" name="result_and_calculation[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="result_and_calculation[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="result_and_calculation[{{$loop->index}}][response]"
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
                                                                <textarea name="result_and_calculation[{{$loop->index}}][remark]"
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

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                </div>
            </div>
            <div id="CCForm51" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head"> Checklist For Review Of Training Records Analyst Involved In Testing </div>
                                @php
                                $Training_records_Analyst_Involveds = [
                                    [
                                    'question' => "Was analyst trained on testing procedure?",
                                    'is_sub_question' => false,
                                    'input_type' => 'text'
                                    ],
                                    [
                                    'question' => "Date of training:",
                                    'is_sub_question' => true,
                                    'input_type' => 'date'
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
                                    ],
                                    [
                                    'question' => "Were the personnel in perfect health without any open injury or infection?",
                                    'is_sub_question' => false,
                                    'input_type' => 'text'
                                    ],
                                    [
                                    'question' => "Were the entry and exit procedures to the respective production area followed as per SOP?",
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

                                            @foreach ($Training_records_Analyst_Involveds as $index => $review_item)
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
                                                        <input type="date" name="Training_records_Analyst_Involved1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Training_records_Analyst_Involved1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Training_records_Analyst_Involved1[{{$loop->index}}][response]"
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
                                                        <textarea name="Training_records_Analyst_Involved1[{{$loop->index}}][remark]"
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
                        Checklist For Review Of Sample Intactness Before Analysis ? </div>
                        @php
                        $sample_intactness_before_analysis = [
                        [
                        'question' => "Was intact samples/sample container received in lab?",
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
                        'question' => "Any remark notified in sample request form?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Were samples stored as per storage requirements specified in specification/SOP?",
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

                                            @foreach ($sample_intactness_before_analysis as $index => $review_item)
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
                                                        <input type="date" name="sample_intactness_before_analysis1[{{$loop->index}}][remark][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="sample_intactness_before_analysis1[{{$loop->index}}][remark][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="sample_intactness_before_analysis1[{{$loop->index}}][remark][response]"
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
                                                        <textarea name="sample_intactness_before_analysis1[{{$loop->index}}][remark]"
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
                        Review Of Test Methods & Procedures </div>
                                    @php
                                    $test_methods_Procedures = [
                                        [
                                        'question' => "Was correct applicable specification and method of analysis used for analysis?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "MOA & specification number?",
                                        'is_sub_question' => false,
                                        'input_type' => 'number'
                                        ],
                                        [
                                        'question' => "Were the results of the other samples analyzed on the same day/time satisfactory?",
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

                                            @foreach ($test_methods_Procedures as $index => $review_item)
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
                                                        <input type="date" name="test_methods_Procedure1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="test_methods_Procedure1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="test_methods_Procedure1[{{$loop->index}}][response]"
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
                                                        <textarea name="test_methods_Procedure1[{{$loop->index}}][remark]"
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
                       Checklist For Review Of Media, Buffer, Standards Preparation & Test Accessories </div>
                                @php
                                $Review_of_Media_Buffer_Standards_prepar = [
                                [
                                'question' => "Name of the media used in the analysis:",
                                'is_sub_question' => false,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Did the COA of the media review and found satisfactory?",
                                'is_sub_question' => true,
                                'input_type' => 'number'
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
                                'question' => "Was any contamination observed in test media/diluents?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was appropriate and cleaned and sterilized glassware used for testing?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Are the negative controls still confirming?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Is the growth promotion test for the media confirming?",
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
                                                $main_question_index = 4.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Review_of_Media_Buffer_Standards_prepar as $index => $review_item)
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
                                                        <input type="date" name="Review_of_Media_Buffer_Standards_prep1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Review_of_Media_Buffer_Standards_prep1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Review_of_Media_Buffer_Standards_prep1[{{$loop->index}}][response]"
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
                                                        <textarea name="Review_of_Media_Buffer_Standards_prep1[{{$loop->index}}][remark]"
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
                        Checklist For Review Of Media, Buffer, Standards Preparation & Test Accessories </div>
                                    @php
                                    $Checklist_for_Revi_of_Media_Buffer_Stand_preps = [
                                        [
                                        'question' => "Were the environmental conditions during testing as per the conditions specified?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Was the Temperature of the area within the limit?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Pressure differentials of the area within the limit?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Were the other types of monitoring results confirming?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Are the under test environmental monitoring samples confirming?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Were the entry and exit procedures to the clean room / controlled rooms followed as per SOP? (by all personnel)",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                        ],
                                        [
                                        'question' => "Was the HEPA filter integrity of the area found satisfactory?",
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
                                        </thead><tbody>
                                            @php
                                                $main_question_index = 5.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Checklist_for_Revi_of_Media_Buffer_Stand_preps as $index => $review_item)
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
                                                        <input type="date" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{$loop->index}}][response]"
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
                                                        <textarea name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{$loop->index}}][remark]"
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
                        Checklist For Disinfectant Details: </div>
                        @php
                        $check_for_disinfectant_details = [
                        [
                        'question' => "Was the area disinfection done as per schedule?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Is the disinfectant used approved?",
                        'is_sub_question' => true,
                        'input_type' => 'number'
                        ],
                        [
                        'question' => "Is the concentration in which disinfectant used certified for efficacy?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Name of the disinfectant used?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was the disinfectant prepared correctly?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was cleaning done during operations?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was area fumigation done as per schedule?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was the concentration in which fumigant used correct?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Were there any spillages in the area?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                         ],
                         [
                        'question' => "Was viable environmental monitoring results of area and LAF within limit?",
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
                                        </thead><tbody>
                                            @php
                                                $main_question_index = 6.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($check_for_disinfectant_details as $index => $review_item)
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
                                                        <input type="date" name="ccheck_for_disinfectant_detail1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="ccheck_for_disinfectant_detail1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="ccheck_for_disinfectant_detail1[{{$loop->index}}][response]"
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
                                                        <textarea name="ccheck_for_disinfectant_detail1[{{$loop->index}}][remark]"
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
                        Checklist For Review Of Instrument/Equipment </div>
                        @php
                        $Checklist_for_Review_of_instrument_equips = [
                        [
                        'question' => "Was there any malfunctioning of autoclave observed? Verify the qualification and requalification of steam sterilizer?",
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
                        'question' => "Was there any power supply failure noted during analysis?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was incubators used is qualified Incubators ID:",
                        'is_sub_question' => false,
                        'input_type' => 'text'
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
                        'question' => "Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause this failure?",
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
                                                $main_question_index = 7.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Checklist_for_Review_of_instrument_equips as $index => $review_item)
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
                                                        <input type="date" name="Checklist_for_Review_of_instrument_equip1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Review_of_instrument_equip1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Review_of_instrument_equip1[{{$loop->index}}][response]"
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
                                                        <textarea name="Checklist_for_Review_of_instrument_equip1[{{$loop->index}}][remark]"
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
                            <label for="Audit Attachments">If Yes, Provide Attachment Details</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="provide_attachment1"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="provide_attachment1[]"
                                        oninput="addMultipleFiles(this, 'provide_attachment1')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>


            </div>
            <div id="CCForm52" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                    Checklist For Review Of Training Records Analyst Involved In Testing
                    </div>
                        @php
                            $Checklist_for_Review_of_Training_records_Analysts = [
                            [
                                'question' => "Is the analyst trained on respective procedures?",
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
                            ],
                            [
                                'question' => "Was the analyst trained on entry exit /procedure?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "SOP No.& Trained On",
                                'is_sub_question' => true,
                                'input_type' => 'number'
                            ],
                            [
                                'question' => "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Was the analyst followed gowning procedure?",
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

                                            @foreach ($Checklist_for_Review_of_Training_records_Analysts as $index => $review_item)
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
                                                        <input type="date" name="Checklist_for_Review_of_Training_records_Analyst1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Review_of_Training_records_Analyst1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Review_of_Training_records_Analyst1[{{$loop->index}}][response]"
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
                                                        <textarea name=" Checklist_for_Review_of_Training_records_Analyst1[{{$loop->index}}][remark]"
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
                    Checklist For Review Of Sampling And Transportation Procedures </div>
                        @php
                        $Checklist_for_Review_of_sampling_and_Transports = [
                        [
                        'question' => "Name of the sampler:",
                        'is_sub_question' => false,
                        'input_type' => 'number'
                        ],
                        [
                        'question' => "Was the sampling followed approved procedure?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Reference procedure No. & Trained on",
                        'is_sub_question' => true,
                        'input_type' => 'number'
                        ],
                        [
                        'question' => "Were clean and sterile sampling accessories used for sampling?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Used before date:",
                        'is_sub_question' => true,
                        'input_type' => 'date'
                        ],
                        [
                        'question' => "Was the sampling area cleaned on day of sampling?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Name of the disinfectant used for cleaning?",
                        'is_sub_question' => true,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "When was the last cleaning date from date of sampling?",
                        'is_sub_question' => true,
                        'input_type' => 'date'
                        ],
                        [
                        'question' => "Was the cleaning operator trained on the cleaning procedure?",
                        'is_sub_question' => true,
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
                        'question' => "Did the samples transfer to the lab within time?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Were samples stored as per storage requirements specified in specifications/procedure?",
                        'is_sub_question' => false,
                        'input_type' => 'text'
                        ],
                        [
                        'question' => "Was there any maintenance work carried out before or during sampling in sampling area?",
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
                                                $main_question_index = 2.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Checklist_for_Review_of_sampling_and_Transports as $index => $review_item)
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
                                                        <input type="date" name="Checklist_for_Review_of_sampling_and_Transport1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Review_of_sampling_and_Transport1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Review_of_sampling_and_Transport1[{{$loop->index}}][response]"
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
                                                        <textarea name=" Checklist_for_Review_of_sampling_and_Transport1[{{$loop->index}}][remark]
                                                            "
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
                    Checklist For Review Of Test Method & Procedure: </div>
                        @php
                            $Checklist_Review_of_Test_Method_proceds = [
                            [
                                'question' => "Was correct applicable specification/Test procedure/MOA/SOP used for analysis?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Verified specification/Test procedure/MOA No/SOP No.",
                                'is_sub_question' => true,
                                'input_type' => 'number'

                            ],
                            [
                                'question' => "Was the test procedure mentioned in specification/analytical procedure validated w.r.t. product concentration?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Was method used during testing evaluated with respect to method validation and historical data and found satisfactory?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Was negative control of the test procedure found satisfactory?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Were the sample tested transferred and incubated at desired temp. as per approved procedure?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Were the test samples results observed within the valid time?",
                                'is_sub_question' => true,
                                'input_type' => 'number'

                            ],
                            [
                                'question' => "Were colonies counted correctly?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Was correct formula, dilution factor used for calculation of results?",
                                'is_sub_question' => true,
                                'input_type' => 'text'

                            ],
                            [
                                'question' => "Was the interpretation of test result done correct?",
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
                                        </thead><tbody>
                                            @php
                                                $main_question_index = 2.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Checklist_Review_of_Test_Method_proceds as $index => $review_item)
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
                                                        <input type="date" name="Checklist_Review_of_Test_Method_proceds1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_Review_of_Test_Method_proceds1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_Review_of_Test_Method_proceds1[{{$loop->index}}][response]"
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
                                                        <textarea name=" Checklist_Review_of_Test_Method_proceds1[{{$loop->index}}][remark]
                                                            "
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
                    Checklist For Review Of Microbial Isolates / Contamination </div>
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
                                                        <select name="microbial_isolates_bioburden1[0][response]" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Enter Your Selection Here</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[0][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                                            id="microbial_isolates_bioburden1"></div>
                                                            <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                                <div>Add</div>
                                                                <input type="file" id="myfile" name="microbial_isolates_bioburden1[1][attachment]"
                                                                    oninput="addMultipleFiles(this, 'microbial_isolates_bioburden1')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[1][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.1.2</td>
                                                <td>Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden1[2][response]" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[2][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.1.3</td>
                                                <td>Gram nature of the organism (GP/GN)</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden1[3][response]" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                                <td>
                                                    <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[3][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                                            id="microbial_isolates_bioburden1 "></div>
                                                            <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                                <div>Add</div>
                                                                <input type="file" id="myfile" name="microbial_isolates_bioburden1[4][attachment]"
                                                                    oninput="addMultipleFiles(this, 'microbial_isolates_bioburden1')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[4][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.2</td>
                                                <td>Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden1[5][response]" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>


                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden1[5][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                    Checklist For Review Of Media Preparation, RTU Media And Test Accessories </div>
                            @php
                                $Checklist_for_Review_Media_prepara_RTU_medias = [
                                    [
                                        'question' => "Name of the media used in the analysis:",
                                        'is_sub_question' => false,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Review of the media COA",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Date of media preparation",
                                        'is_sub_question' => true,
                                        'input_type' => 'date'
                                    ],
                                    [
                                        'question' => "Lot No.",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Use before date",
                                        'is_sub_question' => true,
                                        'input_type' => 'date'
                                    ],
                                    [
                                        'question' => "Was GPT of the media complied for its acceptance criteria?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Was valid culture use in GPT of media?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Any events noticed with the same media used in other tests?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Was the media sterilized and sterilization cycle found satisfactory?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Sterilization cycle No?",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Whether gloves used during testing were within the expiry date?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Did the analyst use clean/sterilized garments during testing?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Rinsing fluid/diluents used for testing:",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Were rinsing fluid/diluents used for testing within the validity?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Date of preparation or manufacturing:",
                                        'is_sub_question' => true,
                                        'input_type' => 'date'
                                    ],
                                    [
                                        'question' => "Were the diluting or rinsing fluids visually inspected for any contamination before testing?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Lot number of diluents:",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Use before date:",
                                        'is_sub_question' => true,
                                        'input_type' => 'date'
                                    ],
                                    [
                                        'question' => "Type of filter used in filter testing:",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Use before date of filter:",
                                        'is_sub_question' => true,
                                        'input_type' => 'date'
                                    ],
                                    [
                                        'question' => "Lot number of filter:",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Was sanitization filter assembly performed before execution of the testing?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Were the filtration assembly and filtration cups sterilized?",
                                        'is_sub_question' => true,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Whether sterilized petri plates used for testing?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Lot No./Batch No of petri plates:",
                                        'is_sub_question' => true,
                                        'input_type' => 'number'
                                    ],
                                    [
                                        'question' => "Was temp. of media while pouring monitored and found satisfactory?",
                                        'is_sub_question' => false,
                                        'input_type' => 'text'
                                    ],
                                    [
                                        'question' => "Was any microbial cultures handled in BSC/LAF prior to testing?",
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

                                        @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $index => $review_item)
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
                                                    <input type="date" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_for_Review_Media_prepara_RTU_medias1[{{$loop->index}}][response]"
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
                                                    <textarea name=" Checklist_for_Review_Media_prepara_RTU_medias1[{{$loop->index}}][remark]
                                                        "
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
                    Checklist For Review Of Environmental Condition In The Testing Area :</div>
                        @php
                        $Checklist_Review_Environment_condition_in_tests = [
                                                    [
                                                        'question' => "Was temp. of testing area within limit during testing?",
                                                        'is_sub_question' => false,
                                                        'input_type' => 'text'
                                                    ],
                                                    [
                                                        'question' => "Was differential pressure of the area within the limit?",
                                                        'is_sub_question' => true,
                                                        'input_type' => 'text'
                                                    ],
                                                    [
                                                        'question' => "Were Environmental monitoring (Microbial) results of the LAF/BSC and its surrounding area within the limit on the day of testing and prior to the testing?",
                                                        'is_sub_question' => true,
                                                        'input_type' => 'text'
                                                    ],
                                                    [
                                                        'question' => "Was there any maintenance work performed in the testing area prior to the testing?",
                                                        'is_sub_question' => true,
                                                        'input_type' => 'text'
                                                    ],
                                                    [
                                                        'question' => "Was recovered isolate reviewed for its occurrence in the past, source, frequency and control taken against the isolate?",
                                                        'is_sub_question' => false,
                                                        'input_type' => 'text'
                                                    ],
                                                    [
                                                        'question' => "Were measures established and implemented to prevent contamination from personnel, material during testing reviewed and found satisfactory?",
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

                                        @foreach ($Checklist_Review_Environment_condition_in_tests as $index => $review_item)
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
                                                    <input type="date" name="Checklist_Review_Environment_condition_in_tests1[{{$loop->index}}][response]"
                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                    <input type="number" name="Checklist_Review_Environment_condition_in_tests1[{{$loop->index}}][response]"
                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                    <select name="Checklist_Review_Environment_condition_in_tests1[{{$loop->index}}][response]"
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
                                                    <textarea name=" Checklist_Review_Environment_condition_in_tests1[{{$loop->index}}][remark]
                                                        "
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

                    <div class="inner-block-content">
                    <div class="sub-head">
                    Checklist For Review Of Instrument/Equipment:</div>
                        @php
                            $review_of_instrument_bioburden_and_waters = [
                            [
                            'question' => "Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Autoclave :ID No",
                            'is_sub_question' => false,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Qualification date and Next due date:",
                            'is_sub_question' => true,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "BSC/LAF ID:",
                            'is_sub_question' => true,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Qualification date and Next due date:",
                            'is_sub_question' => true,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Incubator :ID No.",
                            'is_sub_question' => true,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Was temp. of incubator with in the limit during incubation period?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Qualification date and Next due date:",
                            'is_sub_question' => true,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Was the BSC/LAF cleaned prior to testing?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Was HVAC system of testing area qualified ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Qualification date and Next due date:",
                            'is_sub_question' => true,
                            'input_type' => 'date'
                            ],
                            [
                            'question' => "Was there any power failure during analysis ?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Any events associated with incubators, when the samples under incubation?",
                            'is_sub_question' => true,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Pipettes ID:",
                            'is_sub_question' => false,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Calibration date and Next due date:",
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
                                        {{-- <tbody> --}}

                                            <tbody>
                                                @php
                                                    $main_question_index = 7.0;
                                                    $sub_question_index = 0;
                                                @endphp

                                                @foreach ($review_of_instrument_bioburden_and_waters as $index => $review_item)
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
                                                            <input type="date" name="review_of_instrument_bioburden_and_waters1[{{$loop->index}}][response]"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="review_of_instrument_bioburden_and_waters1[{{$loop->index}}][response]"
                                                                style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                            <select name="review_of_instrument_bioburden_and_waters1[{{$loop->index}}][response]"
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
                                                            <textarea name="review_of_instrument_bioburden_and_waters1[{{$loop->index}}][remark]"
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
                    Checklist For Disinfectant Details:</div>
                        @php
                        $disinfectant_details_of_bioburden_and_water_tests = [
                        [
                            'question' => "Name of the disinfectant used for area cleaning",
                            'is_sub_question' => false,
                            'input_type' => 'text'
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
                                                $main_question_index = 7.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($disinfectant_details_of_bioburden_and_water_tests as $index => $review_item)
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
                                                        <input type="date" name="disinfectant_details_of_bioburden_and_water_tests1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="disinfectant_details_of_bioburden_and_water_tests1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="disinfectant_details_of_bioburden_and_water_tests1[{{$loop->index}}][response]"
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
                                                        <textarea name="disinfectant_details_of_bioburden_and_water_tests1[{{$loop->index}}][remark]"
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
                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide Attachment Details</label>
                        <small class="text-primary">
                            Please Attach all relevant or supporting documents
                        </small>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="provide_attachment2"></div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="provide_attachment2[]"
                                    oninput="addMultipleFiles(this, 'provide_attachment2')" multiple>
                            </div>
                        </div>

                    </div>
                </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="CCForm53" class="inner-block cctabcontent">

                <div class="inner-block-content">

                    <div class="sub-head">

                        Checklist For Review Of Training Records Analyst Involved In Testing

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
                                                                <input type="date" name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{$loop->index}}][response]"
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
                                                                <textarea name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{$loop->index}}][remark]"
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

                                    <div class="sub-head">Checklist For Review Of Sample Intactness Before Analysis ? </div>
                                        @php
                                        $sample_intactness_before_analysis2 = [
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

                                                            @foreach ($sample_intactness_before_analysis2 as $review_item)
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
                                                                        <input type="date" name="sample_intactness_before_analysis22[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="sample_intactness_before_analysis22[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="sample_intactness_before_analysis22[{{$loop->index}}][response]"
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
                                                                        <textarea name="sample_intactness_before_analysis22[{{$loop->index}}][remark]"
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

                                    <div class="sub-head">Checklist For Review Of Test Methods & Procedures</div>
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
                                                                        <input type="date" name="checklist_for_review_of_test_method_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="checklist_for_review_of_test_method_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="checklist_for_review_of_test_method_IMA1[{{$loop->index}}][response]"
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
                                                                        <textarea name="checklist_for_review_of_test_method_IMA1[{{$loop->index}}][remark]"
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

                                        Checklist For Review oF Media, Buffer, Standards Preparation & Test Accessories </div>
                                    @php
                                        $cr_of_media_buffe_rst_IMAs = [
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
                                            'question' => "Did appropriate size wells prepare in the media plates?",
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

                                                            @foreach ($cr_of_media_buffe_rst_IMAs as $index => $review_item)
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
                                                                        <input type="date" name="cr_of_media_buffer_st_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="cr_of_media_buffer_st_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="cr_of_media_buffer_st_IMA1[{{$loop->index}}][response]"
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
                                                                        <textarea name="cr_of_media_buffer_st_IMA1[{{$loop->index}}][remark]"
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

                                        Checklist For Review Of Microbial Cultures/Inoculation (Test Organism) </div>
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
                                                                        <input type="date" name="CR_of_microbial_cultures_inoculation_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="CR_of_microbial_cultures_inoculation_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="CR_of_microbial_cultures_inoculation_IMA1[{{ $index }}][response]"
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
                                                                        <textarea name="CR_of_microbial_cultures_inoculation_IMA1[{{$loop->index}}][remark]"
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

                                        Checklist For Review Of Environmental Conditions In The TEsting Area </div>
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
                                                                        <input type="date" name="CR_of_Environmental_condition_in_testing_IMA1[{{$loop->index}}][remark]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="CR_of_Environmental_condition_in_testing_IMA1[{{$loop->index}}][remark]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="CR_of_Environmental_condition_in_testing_IMA1[{{$loop->index}}][remark]"
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
                                                                        <textarea name="CR_of_Environmental_condition_in_testing_IMA1[{{$loop->index}}][remark]"
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

                                        Checklist For Review Of Instrument/Equipment </div>
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
                                                                        <input type="date" name="CR_of_instru_equipment_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="CR_of_instru_equipment_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="CR_of_instru_equipment_IMA1[{{$loop->index}}][response]"
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
                                                                        <textarea name="CR_of_instru_equipment_IMA1[{{$loop->index}}][remark]"
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
                                                                        <input type="date" name="disinfectant_details_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="disinfectant_details_IMA1[{{$loop->index}}][response]"
                                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                        <select name="disinfectant_details_IMA1[{{$loop->index}}][response]"
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
                                                                        <textarea name="disinfectant_details_IMA1[{{$loop->index}}][remark]"
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
                                            <label for="Audit Attachments">If Yes, Provide Attachment Details</label>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="provide_attachment3"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="provide_attachment3[]"
                                                        oninput="addMultipleFiles(this, 'provide_attachment3')" multiple>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>

                    </div>
                </div>
            </div>

            <div id="CCForm54" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Checklist For Review Of Training Records Analyst Involved In Monitoring
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
                                                        <input type="date" name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{$loop->index}}][remark]"
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
                                                        <input type="date" name="Check_for_Sample_details_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Check_for_Sample_details_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Check_for_Sample_details_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="Check_for_Sample_details_CIEM1[{{$loop->index}}][remark]"
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
                        Checklist For Comparison Of Results With Other Parameters:
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
                                                        <input type="date" name="Check_for_comparision_of_results_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Check_for_comparision_of_results_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Check_for_comparision_of_results_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="Check_for_comparision_of_results_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Details Of Media Dehydrated Media Used:
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
                                        <tbody>
                                            @php
                                                $main_question_index = 3.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($checklist_for_media_dehydrated_CIEMs as $index => $review_item)
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
                                                        <input type="date" name="checklist_for_media_dehydrated_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_media_dehydrated_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_media_dehydrated_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_media_dehydrated_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Media Preparation Details And Sterilization :
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
                                                        <input type="date" name="checklist_for_media_prepara_sterilization_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_media_prepara_sterilization_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_media_prepara_sterilization_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_media_prepara_sterilization_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Review Of Environmental Conditions In The Testing Area
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
                                                        <input type="date" name="CR_of_En_condition_in_testing_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_of_En_condition_in_testing_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="CR_of_En_condition_in_testing_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="CR_of_En_condition_in_testing_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Disinfectant Details:
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
                                                        <input type="date" name="check_for_disinfectant_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="check_for_disinfectant_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="check_for_disinfectant_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="check_for_disinfectant_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Fogging Details :
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
                                                        <input type="date" name="checklist_for_fogging_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_fogging_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_fogging_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_fogging_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Review Of Test Method & Procedure:
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
                                                        <input type="date" name="CR_of_test_method_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_of_test_method_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="CR_of_test_method_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="CR_of_test_method_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Review Of Microbial Isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification)
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
                                                        <input type="date" name="CR_microbial_isolates_contamination_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_microbial_isolates_contamination_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="CR_microbial_isolates_contamination_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="CR_microbial_isolates_contamination_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Review Of Instrument/Equipment:
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
                                                        <input type="date" name="CR_of_instru_equip_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_of_instru_equip_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="CR_of_instru_equip_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="CR_of_instru_equip_CIEM1[{{$loop->index}}][remark]"
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
                    Checklist For Trend Analysis:
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
                                                        <input type="date" name="Ch_Trend_analysis_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Ch_Trend_analysis_CIEM1[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Ch_Trend_analysis_CIEM1[{{$loop->index}}][response]"
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
                                                        <textarea name="Ch_Trend_analysis_CIEM1[{{$loop->index}}][remark]"
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
                                <label for="Audit Attachments">If Yes, Provide Attachment Details</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="provide_attachment4"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="provide_attachment4[]"
                                            oninput="addMultipleFiles(this, 'provide_attachment4')" multiple>
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
            <div id="CCForm55" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Checklist For Analyst Training & Procedure
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
                                                        <input type="date" name="checklist_for_analyst_training_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_analyst_training_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_analyst_training_CIMT2[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_analyst_training_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Comparison Of Results (With Same & Previous Day Media GPT) :
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
                                                        <input type="date" name="checklist_for_comp_results_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_comp_results_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_comp_results_CIMT2[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_comp_results_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Culture Verification ?
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
                                'question' => "Was the storage condition of culture appropriate?",
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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="checklist_for_Culture_verification_CIMT2[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="checklist_for_Culture_verification_CIMT2[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="checklist_for_Culture_verification_CIMT2[{{$loop->index}}][response]"
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
                                                            <textarea name="checklist_for_Culture_verification_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Sterilize Accessories :
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
                                                        <input type="date" name="sterilize_accessories_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="sterilize_accessories_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="sterilize_accessories_CIMT2[{{$loop->index}}][response]"
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
                                                        <textarea name="sterilize_accessories_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Instrument/Equipment Details:
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
                                                        <input type="date" name="checklist_for_intrument_equip_last_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_intrument_equip_last_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="checklist_for_intrument_equip_last_CIMT2[{{$loop->index}}][response]"
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
                                                        <textarea name="checklist_for_intrument_equip_last_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Disinfectant Details:
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
                                                        <input type="date" name="disinfectant_details_last_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="disinfectant_details_last_CIMT2[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="disinfectant_details_last_CIMT2[{{$loop->index}}][response]"
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
                                                        <textarea name="disinfectant_details_last_CIMT2[{{$loop->index}}][remark]"
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
                        Checklist For Results And Calculation :
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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap: 5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="checklist_for_result_calculation_CIMT2[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="checklist_for_result_calculation_CIMT2[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="checklist_for_result_calculation_CIMT2[{{$loop->index}}][response]"
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
                                                            <textarea name="checklist_for_result_calculation_CIMT2[{{$loop->index}}][remark]"
                                                                style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">If Yes, Provide Attachment Details</label>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="provide_attachment5"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="provide_attachment5[]"
                                                    oninput="addMultipleFiles(this, 'provide_attachment5')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-block">
                    <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" id="ChangeNextButton" class="nextButton"
                    onclick="nextStep()">Next</button>
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit </a> </button>
                </div>
            </div>


            <div id="CCForm33" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IB HOD Review</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Remark</label>
                                <input type="text" name="hod_remark3" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment3"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment3[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment3')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm34" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IB CQA/QA Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark3" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment3"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment3[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment3')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm35" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IB CQAH/QAH Review</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Escalation Required</label>
                                <select id="escalation_required" name="escalation_required">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6" id="notification_field" style="display:none;">
                            <div class="group-input">
                                <label for="If Others">If Yes, Notification</label>
                                <textarea id="notification_ib" name="notification_ib"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6" id="justification_field" style="display:none;">
                            <div class="group-input">
                                <label for="If Others">If No, Justification</label>
                                <textarea id="justification_ib" name="justification_ib"></textarea>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#escalation_required').change(function() {
                                    var selectedValue = $(this).val();

                                    if (selectedValue === 'Yes') {
                                        $('#notification_field').show();  // Show notification field
                                        $('#justification_field').hide(); // Hide justification field
                                    } else if (selectedValue === 'No') {
                                        $('#justification_field').show();  // Show justification field
                                        $('#notification_field').hide();   // Hide notification field
                                    } else {
                                        // If no value is selected, hide both fields
                                        $('#notification_field').hide();
                                        $('#justification_field').hide();
                                    }
                                });
                            });
                        </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="If Others">Phase IB Assignable Cause Found</label>
                                        <select id="phase_ib_assi_cause" name="phase_ib_assi_cause">
                                            <option value="">--Select---</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQAH/QAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark3" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB CQAH/QAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment3"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment3[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment3')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm36" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase II A HOD Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Remark</label>
                                <input type="text" name="hod_remark4" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment4"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment4[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment4')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm37" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase II A CQA/QA Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark4" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment4"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment4[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment4')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm38" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase II A QAH/CQAH Review</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Phase II A Assignable Cause Found</label>
                                <select id="phase_ii_a_assi_cause" name="phase_ii_a_assi_cause">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A QAH/CQAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark4" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A QAH/CQAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment4"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment4[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment4')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm39" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase II B HOD Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B HOD  Remark</label>
                                <input type="text" name="hod_remark5" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment5"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment5[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment5')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm40" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase II B CQA/QA Review</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark5" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment5"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment5[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment5')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div id="CCForm41" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-II B QAH/CQAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark5" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-II B QAH/CQAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment5"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment5[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment5')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div> --}}

            <!-- CheckList - Preliminary Lab. Investigation -->
            <div id="CCForm18" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">CheckList - Preliminary Lab. Investigation </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION REPORT</label>
                            </center>
                                @php
                                    $lab_inv_questions = array(
                                            "Aliquot and standard solutions preserved",
                                            "Visual examination (solid and solution) reveals normal or abnormal appearance",
                                            "The analyst is trained on the method.",
                                            "Correct test procedure followed e.g. Current Version of standard testing procedure has been used in testing.",
                                            "Current Validated analytical Method has been used and the data of analytical method validation has been reviewed and found satisfactory.",
                                            "Correct sample(s) tested.",
                                            "Sample Integrity maintained, correct container is used in testing.",
                                            "Assessment of the possibility that the sample contamination (sample left open to air or unattended) has occurred during the testing/ re-testing procedure",
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
                                            "Interview with analyst to assess knowledge of the correct procedure"
                                        );
                                @endphp
                            <div class="group-input">
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
                                            @foreach ($lab_inv_questions as $lab_inv_question)
                                                <tr>
                                                    <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                    <td><input type="text" readonly name="question[]" value="{{ $lab_inv_question }}">
                                                    </td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="checklist_lab_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                <option value="">Enter Your Selection Here</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                                <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="checklist_lab_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                                <label for="Description Deviation">Summary of Preliminary Investigation.</label>
                                <textarea class="summernote" name="summary_of_prelim_investiga_plic" id="summernote-1"></textarea>
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
                                <label for="Audit Team"> OOS/OOT Category-Root Cause Ident.</label>
                                <select name="oos_category_root_cause_ident_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Analyst Error">Analyst Error</option>
                                    <option value="Instrument Error">Instrument Error</option>
                                    <option value="Product/Material Related Error">Product/Material Related Error</option>
                                    <option value="Other Error">Other Error</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS/OOT Category (Others)</label>
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
                                <label for="Description Deviation">OOS/OOT Category-Root Cause Ident.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="Description_Deviation" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">CAPA Required</label>
                                <select name="capa_required_plic">
                                <option value="">--Select---</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Agenda">Reference CAPA No.</label>
                                <input type="text" name="reference_capa_no_plic">
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Delay Justification for Preliminary Investigation</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="delay_justification_for_pi_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">Supporting Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="supporting_attachment_plic"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachment_plic[]"
                                            oninput="addMultipleFiles(this, 'supporting_attachment_plic')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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

                        <div class="sub-head">OOS/OOT Review for Similar Nature</div>

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
                                            <th style="width: 16%"> OOS Reported Date</th>
                                            <th style="width: 12%">Description of OOS</th>
                                            <th style="width: 8%">Previous OOS Root Cause</th>
                                            <th style="width: 8%"> CAPA</th>
                                            <th style="width: 16% pt-3">Closure Date of CAPA</th>
                                            <th style="width: 16%">CAPA Requirement</th>
                                            <th style="width: 16%">Reference CAPA Number</th>
                                            <th style="width: 4%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="oos_capa[0][serial]" value="1"></td>
                                            <td><input type="text" id="info_oos_number" name="oos_capa[0][info_oos_number]" value=""></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_oos_reported_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="oos_capa[0][info_oos_reported_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_oos_reported_date')">
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td><input type="text" name="oos_capa[0][info_oos_description]" value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_previous_root_cause]"value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa]" value=""></td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="info_oos_closure_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="oos_capa[0][info_oos_closure_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'info_oos_closure_date')">
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td><select name="oos_capa[0][info_oos_capa_requirement]">
                                                   <option value="">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa_reference_number]" value=""></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
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
                                    <div class="file-attachment-list" id="supporting_attachments_plir"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                            oninput="addMultipleFiles(this, 'supporting_attachments_plir')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
        @include('frontend.OOS.oos_allchecklist')
        @php
                    $phase_two_inv_questions = array(
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
                        "All the in-process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
                        "Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
                        "Whether other batches/products impacted?",
                        "Any Other"
                    );

                @endphp

        <!--Phase II Investigation -->
        <div id="CCForm5" class="inner-block cctabcontent">
            <div class="inner-block-content">

                <div class="sub-head">
                    CheckList - Phase II Investigation
                </div>
                <div class="row">
                    <div class="col-12">
                        <center>
                            <label style="font-weight: bold;" for="Audit Attachments">PHASE II OOS INVESTIGATION</label>
                        </center>
                            <!-- <label for="Reference Recores">PHASE II OOS INVESTIGATION </label> -->
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
                                            @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                                <tr>
                                                    <td class="flex text-center">{{ $loop->index+1 }}</td>
                                                    <td>{{ $phase_two_inv_question }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="phase_two_inv1[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                                <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea name="phase_two_inv1[{{ $loop->index }}][remarks]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                <label for="If Others">Checklist Outcome</label>
                                <textarea id="checklist_outcome_iia"  name="checklist_outcome_iia" ></textarea>
                            </div>
                        </div>
                        <div class="sub-head">
                            Phase II Investigation
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Attachments">Production Head Person</label>
                                <select name="production_head_person">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned To">Production Head Person</label>
                                <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                    name="production_head_person" placeholder="Select Production Head Person">
                                    <option value="">-- Select --</option>
                                    @if (!empty(Helpers::getProductionHeadDropdown()))
                                        @foreach (Helpers::getProductionHeadDropdown() as $lan)
                                            <option value="{{ $lan['id'] }}">
                                                {{ $lan['name'] }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Immediate Action Taken</label>
                            <textarea class="summernote" name="qa_approver_comments_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Delay Justification For Investigation</label>
                            <textarea class="summernote" name="reason_manufacturing_delay" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Audit Attachments">Manufacturing Operator Interview Details</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="file_attachments_pII"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attachments_pII[]"
                                        oninput="addMultipleFiles(this, 'file_attachments_pII')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Comments">Any Other Cause/Suspected Cause</label>
                            <textarea class="summernote" name="audit_comments_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Reference Recores">Summary Investigation</label>
                            <textarea class="summernote" name="hypo_exp_reference_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">OOS/OOT Cause Identified II A</label>
                            <select name="manufact_invest_required_piii">
                                <option value="">Enter Your Selection Here</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS/OOT Category II A</label>
                            <select name="hypo_exp_required_piii">
                                <option value="">Enter Your Selection Here</option>
                                <option value="Analyst Error">Analyst Error</option>
                                <option value="Instrument Error">Instrument Error</option>
                                <option value="Product/Material Related Error">Product/Material Related Error</option>
                                <option value="Other Error">Other Error</option>
                                <option value="NA">NA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Preparation Completed On">OOS/OOT Category If Others </label>
                            <input type="text" name="if_others_oos_category">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Product/Material Name">CAPA Required</label>
                            <select name="capa_required_iia">
                            <option value="">--Select---</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Agenda">Reference CAPA No.</label>
                            <input type="text" name="reference_capa_no_iia">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Details of Obvious Error">OOS/OOT Review For Similar Nature II A</label>
                            <input type="text" name="OOS_review_similar">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Impact Assessment.</label>
                            <textarea class="summernote" name="impact_assessment_IIA" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Start Date"> Phase IIB Inv. Required?</label>
                            <select name="phase_iib_inv_required_plir">
                            <option value="">Enter Your Selection Here</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Lead More Info Reqd On">II A Inv. Supporting Attachments</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attachments_piiqcr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachments_piiqcr[]"
                                        oninput="addMultipleFiles(this, 'attachments_piiqcr')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Auditee"> Manufacturing Invest. Type </label>
                            <select name="manufacturing_invest_type_piii" placeholder="Select Nature of Deviation"
                                data-search="false" data-silent-initial-value-set="true" id="auditee">
                                <option value="">Enter Your Selection Here</option>
                                <option value="Chemical">Chemical</option>
                                <option value="Microbiology">Microbiology</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary of Exp./Hyp.</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_of_exp_hyp_piiqcr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary Mfg. Investigation</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_mfg_investigation_piiqcr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By"> Root Casue Identified. </label>
                            <select name="root_casue_identified_piiqcr">
                                <option value="">Select an Option</option>
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
                                <option value="Analyst Error">Analyst Error</option>
                                <option value="Instrument Error">Instrument Error</option>
                                <option value="Product/Material Related Error">Product/Material Related Error</option>
                                <option value="Other Error">Other Error</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Details of Root Cause</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="details_of_root_cause_piiqcr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Exclamation FAR (Field alert) </label>
                            <textarea class="summernote" name="Field_alert_QA_initial_approval" id="summernote-1">
                            </textarea>
                        </div>
                    </div>   --}}
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>

                </div>
            </div>
        </div>
{{-- @php
    $phase_two_inv_questions = array(
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
        "All the in-process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
        "Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
        "Whether other batches/products impacted?",
        "Any Other"
    );

@endphp --}}
        <!--CheckList Phase II Investigation -->
        {{-- <div id="CCForm19" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    CheckList - Phase II Investigation
                </div>
                <div class="row">
                    <div class="col-12">
                    <center>
                        <label style="font-weight: bold; for="Audit Attachments">PHASE II OOS INVESTIGATION</label>
                    </center>
                        <!-- <label for="Reference Recores">PHASE II OOS INVESTIGATION </label> -->
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
                                        @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                            <tr>
                                                <td class="flex text-center">{{ $loop->index+1 }}</td>
                                                <td>{{ $phase_two_inv_question }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="phase_two_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea name="phase_two_inv[{{ $loop->index }}][remarks]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>

                </div>
            </div>
        </div> --}}
        <!-- Phase II QC Review -->
        {{-- <div id="CCForm6" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">Summary of Phase II Testing</div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary of Exp./Hyp.</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_of_exp_hyp_piiqcr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary Mfg. Investigation</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_mfg_investigation_piiqcr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By"> Root Casue Identified. </label>
                            <select name="root_casue_identified_piiqcr">
                                <option value="">Select an Option</option>
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
                                <option value="Analyst Error">Analyst Error</option>
                                <option value="Instrument Error">Instrument Error</option>
                                <option value="Product/Material Related Error">Product/Material Related Error</option>
                                <option value="Other Error">Other Error</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Preparation Completed On">Others (OOS category)</label>
                            <input type="text" name="others_oos_category_piiqcr">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Details of Obvious Error">Details of Obvious Error</label>
                            <input type="text" name="oos_details_obvious_error">
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Impact Assessment.</label>
                            <textarea class="summernote" name="impact_assessment_piiqcr" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Lead More Info Reqd On">Attachments </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attachments_piiqcr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachments_piiqcr[]"
                                        oninput="addMultipleFiles(this, 'attachments_piiqcr')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>




                </div>
            </div>
        </div> --}}

        <!--Additional Testing Proposal  -->
        <div id="CCForm7" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Additional Testing Proposal
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
                                <option value="">Select an Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Reference Recores">Additional Test Comment.
                            </label>
                            <textarea class="summernote" name="additional_test_reference_atp" id="summernote-1">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Any Other Actions Required</label>
                            <select name="any_other_actions_required_atp">
                                <option value="">Select an Option</option>
                                <option value="Yes">Yes</option>
                                <option name="No">No</option>
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
                                <div class="file-attachment-list" id="additional_testing_attachment_atp"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="additional_testing_attachment_atp[]"
                                        oninput="addMultipleFiles(this, 'additional_testing_attachment_atp')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                OOS/OOT Conclusion
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
                    {{-- <div class="group-input">
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
                                        <th style="width: 16%">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                     <td><input disabled type="text" name="oos_conclusion[0][serial]" value="1"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_analysis_detials]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_hypothesis_experimentation_test_pr_no]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_analyst_name]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_remarks]"></td>
                                    <td><button type="text" class="removeRowBtn">Remove</button></td>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">Specification Limit </label>
                            <input type="text" name="specification_limit_oosc">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Results To Be Reported</label>
                            <select name="results_to_be_reported_oosc">
                                <option value="">Select an Option</option>
                                <option value="Intial">Initial</option>
                                <option value="Retested result">Retested Result</option>
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
                            <label for="Description Deviation">Justifi. For Averaging Results</label>
                            <textarea class="summernote" name="justifi_for_averaging_results_oosc" id="summernote-1"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">OOS/OOT Stands </label>
                            <select name="oos_stands_oosc">
                                <option value="">Select an Option</option>
                                <option value="Valid">Valid</option>
                                <option value="Invalid">Invalid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CAPA Req.</label>
                            <select name="capa_req_oosc">
                                <option value="">Select an Option</option>
                                <option name="Yes">Yes</option>
                                <option name="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">CAPA Ref No.</label>
                            <select multiple id="capa_ref_no_oosc" name="capa_ref_no_oosc[]"
                                placeholder="Select Capa Reference Records">
                                @foreach ($capa_record as $new)
                                    <option value="{{ $new->id }}">
                                        {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                    </option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify If CAPA Not Required</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_if_capa_not_required_oosc" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Action Item Req.</label>
                            <select name="action_plan_req_oosc">
                                <option value="">Select an Option</option>
                                 <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Item Ref.</label>
                            {{-- <select multiple id="reference_record" name="action_plan_ref_oosc[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select> --
                            <select multiple id="reference_record" name="action_plan_ref_oosc[]"
                                placeholder="Select Reference Records">
                                @if (!empty($old_record))
                                @foreach ($old_record as $new)
                                    <option value="{{ $new->id }}">
                                        {{ Helpers::getDivisionName($new->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                    </option>
                                @endforeach
                                @endif
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
                                <div class="file-attachment-list" id="file_attachments_if_any_ooscattach"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="file_attachments_if_any_ooscattach[]"
                                        oninput="addMultipleFiles(this, 'file_attachments_if_any_ooscattach')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="sub-head">
                        Conclusion Review Comments
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion Review Comments</label>
                            <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1"></textarea>
                        </div>
                    </div>


                    <!-- ---------------------------grid-1 ------"OOSConclusion_Review-------------------------- -->
                    <div class="group-input">
                        <label for="audit-agenda-grid">
                            Summary of OOS Test Results
                            <button type="button" name="audit-agenda-grid" id="oos_conclusion_review">+</button>
                            <span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-details-field-instruction-modal"
                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="oos_conclusion_review_details"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">Row#</th>
                                        <th style="width: 16%">Material/Product Name</th>
                                        <th style="width: 16%">Batch No.(s) / A.R. No. (s)</th>
                                        <th style="width: 16%">Any Other Information</th>
                                        <th style="width: 16%">Action Taken on Affec.batch</th>
                                        <th style="width: 5%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><input disabled type="text" name="oos_conclusion_review[0][serial]" value="1"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_product_name]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_batch_no]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_any_other_information]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_action_affecte_batch]"></td>
                                    <td><button type="text" class="removeRowBtn">Remove</button></td>
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
                                <option value="">Select an Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
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
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if No Risk Assessment</label>
                            <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1"></textarea>
                        </div>
                    </div> --}}
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Action On Affected Batches</label>
                            <textarea class="summernote" name="action_on_affected_batch" id="summernote-1"></textarea>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Approver</label>
                            <input type="text" name="cq_approver">
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Reference Recores">Conclusion Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="conclusion_attachment_ocr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="conclusion_attachment_ocr[]"
                                        oninput="addMultipleFiles(this, 'conclusion_attachment_ocr')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- <div class="sub-head">
                        CQ Review Comments
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">CQ Review comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="cq_review_comments_ocqr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Attachments"> CQ Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="cq_attachment_ocqr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="cq_attachment_ocqr[]"
                                        oninput="addMultipleFiles(this, 'cq_attachment_ocqr')" multiple>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                            <textarea class="summernote" name="other_action_specify_ro" id="summernote-1">
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
                                <div class="file-attachment-list" id="reopen_attachment_ro"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="reopen_attachment_ro[]"
                                        oninput="addMultipleFiles(this, 'reopen_attachment_ro')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
        {{-- <div id="CCForm9" class="inner-block cctabcontent">
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
                                <option value="">Select an Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
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
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if No Risk Assessment</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Reference Recores">Conclusion Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="conclusion_attachment_ocr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="conclusion_attachment_ocr[]"
                                        oninput="addMultipleFiles(this, 'conclusion_attachment_ocr')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Approver</label>
                            <input type="text" name="cq_approver">
                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--CQ Review Comments -->
        {{-- <div id="CCForm10" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    CQ Review Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">CQ Review comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="cq_review_comments_ocqr" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Attachments"> CQ Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="cq_attachment_ocqr"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="cq_attachment_ocqr[]"
                                        oninput="addMultipleFiles(this, 'cq_attachment_ocqr')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>

            </div>
        </div>
        --}}

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
                            <textarea class="summernote" name="other_action_specify_ro" id="summernote-1">
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
                                <div class="file-attachment-list" id="reopen_attachment_ro"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="reopen_attachment_ro[]"
                                        oninput="addMultipleFiles(this, 'reopen_attachment_ro')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>

        </div>
        <!--QA Head/Designee Approval -->
        <div id="CCForm13" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
               Phase II B QAH/CQAH
                </div>
                <div class="row">

                <div class="col-md-12 mb-4">
                    <div class="group-input">
                        <label for="Description Deviation"> Approval Comments </label>
                        <textarea class="summernote" name="reopen_approval_comments_uaa" id="summernote-1">
                        </textarea>
                    </div>
                </div>
                    {{-- <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Approval Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="addendum_attachment_uaa"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="addendum_attachment_uaa[]"
                                        oninput="addMultipleFiles(this, 'addendum_attachment_uaa')" multiple>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="sub-head"> Batch Disposition </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS/OOT Category</label>
                             <select name="oos_category_bd">
                                <option value="">Enter Your Selection Here</option>
                                <option value="default">Enter Your Selection Here</option>
                                <option value="Analyst Error">Analyst Error</option>
                                <option value="Instrument Error">Instrument Error</option>
                                <option value="Procedure Error">Procedure Error</option>
                                <option value="Product Related Error">Product Related Error</option>
                                <option value="Material Related Error">Material Related Error</option>
                                <option value="Other Error">Other Error</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Other's</label>
                            <input type="text" name="others_bd">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                        <label for="Reference Recores">Material/Batch Release</label>
                        <select name="material_batch_release_bd">
                            <option value="">Enter Your Selection Here</option>
                            <option value="To Be Released">To Be Released</option>
                            <option value="To Be Rejected">To Be Rejected</option>
                            <option value="Other">Other Action (Specify)</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Other Action (Specify)</label>
                            <textarea class="summernote" name="other_action_bd" id="summernote-1">
                            </textarea>
                        </div>
                    </div>

                    <div class="sub-head">Assessment for batch disposition</div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Other Parameters Results</label>
                            <textarea class="summernote" name="other_parameters_results_bd" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Trend of Previous Batches</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="trend_of_previous_batches_bd" id="summernote-1">
                                    </textarea>
                        </div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Stability Data</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="stability_data_bd" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Process Validation Data</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="process_validation_data_bd" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Method Validation </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="method_validation_bd" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Any Market Complaints </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="any_market_complaints_bd" id="summernote-1">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Statistical Evaluation </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="statistical_evaluation_bd" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Risk Analysis for Disposition </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="risk_analysis_disposition_bd" id="summernote-1">
                            </textarea>
                        </div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion </label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="conclusion_bd" id="summernote-1">
                            </textarea>
                        </div>
                    </div> --}}
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify For Delay In Activity</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="justify_for_delay_in_activity_bd" id="summernote-1">
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
                                <div class="file-attachment-list" id="disposition_attachment_bd"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="disposition_attachment_bd[]"
                                        oninput="addMultipleFiles(this, 'disposition_attachment_bd')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                            <textarea class="summernote" name="execution_comments_uae" id="summernote-1">
                                    </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Required?</label>
                            <select name="action_task_required_uae">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference No.</label>
                            <select multiple id="reference_record" name="action_task_reference_no_uae[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Req?</label>
                            <select name="addi_testing_req_uae">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Ref.</label>
                            <select multiple id="reference_record" name="Addi_testing_ref_uae[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Req.?</label>
                            <select name="investigation_req_uae">
                               <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Ref.</label>
                            <select multiple id="reference_record" name="investigation_ref_uae[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Req?</label>
                            <select name="hypo_exp_req_uae">
                             <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Ref.</label>
                            <select multiple id="reference_record" name="hypo_exp_ref_uae[]" id="">
                               <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
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
                                <div class="file-attachment-list" id="addendum_attachments_uae"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="addendum_attachments_uae[]"
                                        oninput="addMultipleFiles(this, 'addendum_attachments_uae')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                            <textarea class="summernote" name="addendum_review_comments_uar" id="summernote-1">
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
                                <div class="file-attachment-list" id="required_attachment_uar"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="required_attachment_uar[]"
                                        oninput="addMultipleFiles(this, 'required_attachment_uar')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
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
                            <textarea class="summernote" name="verification_comments_uav" id="summernote-1">
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
                                <div class="file-attachment-list" id="verification_attachment_uar"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="verification_attachment_uar[]"
                                        oninput="addMultipleFiles(this, 'verification_attachment_uar')" multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" id="ChangeNextButton" class="nextButton"
                            onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Extention add -->

        <div id="CCForm20" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="sub-head"> OOS/OOT Extension </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Audit Schedule End Date">Proposed Due Date (OOS)</label>
                            <div class="calenderauditee">
                                <input type="text" id="oos_proposed_due_date" placeholder="DD-MMM-YYYY" />
                                <input type="date" name="oos_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'oos_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="oos_extension_justification">Extension Justification (OOS)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div> -->
                            <textarea class="tiny" name="oos_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for=" oos_extension_completed_by"> OOS Extension Completed By
                            </label>
                            <select name="oos_extension_completed_by" id="oos_extension_completed_by" >
                                <option value="">-- Select --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Audit Schedule End Date">OOS Extension Completed On</label>
                            <div class="calenderauditee">
                                <input type="text" id="oos_extension_completed_on" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="oos_extension_completed_on"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'oos_extension_completed_on')" />
                            </div>
                        </div>
                    </div>
                    <div class="sub-head"> CAPA Extension </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                            <div class="calenderauditee">
                                <input type="text" id="capa_proposed_due_date" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="capa_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'capa_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div> -->
                            <textarea class="tiny" name="capa_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" capa_extension_completed_by"> CAPA Extension Completed By
                                </label>
                                <select name="capa_extension_completed_by" id="capa_extension_completed_by" >
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="capa_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date" name="capa_extension_completed_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        oninput="handleDateInput(this, 'capa_extension_completed_on')"   class="hide-input"/>
                                </div>
                            </div>
                        </div>
                        {{-- row_end --}}
                    </div>
                    <div class="sub-head"> Quality Risk Management Extension </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                            <div class="calenderauditee">
                                <input type="text" id="qrm_proposed_due_date" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="qrm_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'qrm_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="qrm_extension_justification">Extension Justification (Quality Risk Management)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                            <textarea class="tiny" name="qrm_extension_justification" id="summernote-10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Quality_Risk_Management_Extension_Completed_By"> Quality Risk Management Extension Completed By </label>
                                <select name="qrm_extension_completed_by" id="qrm_extension_completed_by">
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qrm_extension_completed_on">Quality Risk Management Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="qrm_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date"name="qrm_extension_completed_on"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'qrm_extension_completed_on')"  />
                                </div>
                            </div>
                        </div>
                        {{-- row_end --}}
                    </div>
                    <div class="sub-head">Investigation Extension </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                            <div class="calenderauditee">
                                <input type="text" id="investigation_proposed_due_date" readonly placeholder="DD-MMM-YYYY"  />
                                <input type="date" name="investigation_proposed_due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                 class="hide-input" oninput="handleDateInput(this, 'investigation_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="investigation_extension_justification">Extension Justification (Investigation)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div>
                            <textarea class="tiny" name="investigation_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    {{-- row --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" investigation_extension_completed_by"> Investigation Extension Completed By </label>
                                <select name="investigation_extension_completed_by"id="investigation_extension_completed_by" >
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="investigation_extension_completed_on">Investigation Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="investigation_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date" name="investigation_extension_completed_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class="hide-input" oninput="handleDateInput(this, 'investigation_extension_completed_on')"  />
                                </div>
                            </div>
                        </div>
                        {{-- row-end --}}
                    </div>

                </div>
                <div class="button-block">
                    <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton on-submit-disable-button">Save</button>
                    <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                        <button type="button"  class="backButton">Back</button>
                    </a>
                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}"
                            class="text-white">
                            Exit </a> </button>
                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                            class="button  launch_extension" data-bs-toggle="modal"
                            data-bs-target="#launch_extension">
                            Launch Extension
                        </a>  -->
                </div>
                </div>
            </div>



        <!----- Signature ----->
        <div id="CCForm17" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="col-12 sub-head">  Submit </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Agenda">Submit By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Agenda">Submit On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Submit Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Request for Cancellation</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled by">Request for Cancellation By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled on">Request for Cancellation On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Request for Cancellation Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">HOD Primary Review Complete</div>
                 <!-- Request More Info -->
                    <!--  Initial Phase I Investigation  Done By -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Team">HOD Primary Review Complete By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Team">HOD Primary Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">HOD Primary Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Cancel</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled by">Cancel By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled on">Cancel On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Cancel Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">CQA/QA Head Primary Review Complete</div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Found -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Comments">CQA/QA Head Primary Review Complete By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">CQA/QA Head Primary Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">CQA/QA Head Primary Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Not Found -->
                    <div class="col-12 sub-head">Phase IA Investigation</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA Investigation By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA Investigation On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA Investigation Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">Phase IA HOD Review Complete</div>
                     <!-- Request More Info -->
                    <!-- Correction Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA HOD Review Complete By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA HOD Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA HOD Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Proposed Hypothesis Experiment -->
                    <div class="col-12 sub-head">Phase IA QA/CQA Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Response Completed By"> Phase IA QA/CQA Review Complete By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Response Completed On">Phase IA QA/CQA Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA QA/CQA Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- Obvious Error Found -->
                    <div class="col-12 sub-head">Assignable Cause Found</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Not Found By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Not Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Assignable Cause Not Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- No Assignable Cause Found -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Found By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Assignable Cause Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head"> Phase IB Investigation </div>
                    <!-- Request More Info -->
                    <!-- Repeat Analysis Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB Investigation By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB Investigation On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB Investigation Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Full Scale Investigation -->
                    <div class="col-12 sub-head">Phase IB HOD Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB HOD Review Complete by</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB HOD Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB HOD Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">Phase IB QA/CQA Review Complete</div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Found (Manufacturing Defect) -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase IB QA/CQA Review Complete By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase IB QA/CQA Review Complete On </label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB QA/CQA Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- No Assignable Cause Found (No Manufacturing Defect) -->
                    <div class="col-12 sub-head">P-I B Assignable Cause Found</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Not Found By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Not Found On </label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-I B Assignable Cause Not Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                     <!-- Request More Info -->
                     <!-- Phase II Correction Completed  -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Found By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-I B Assignable Cause Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>

                     <!--  Phase II A Correction Inconclusive -->
                     <div class="col-12 sub-head">Phase II A Investigation</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A Investigation By</label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A Investigation On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A Investigation Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>

                    <!-- Request More Info -->
                     <!-- Retesting/resampling -->
                     <div class="col-12 sub-head">Phase II A HOD Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A HOD Review Complete By </label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A HOD Review Complete On </label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A HOD Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>

                    <!-- Phase II B Correction Inconclusive -->
                    <div class="col-12 sub-head">Phase II A QA/CQA Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A QA/CQA Review Complete By </label>
                            <div class=" static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A QA/CQA Review Complete On </label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A QA/CQA Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                <div>
                <div class="row">
                   <div class="col-12 sub-head">P-II A Assignable Cause Found</div>
                    <!-- Final Approval -->
                    <!-- Request More Info -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="submitted by">P-II A Assignable Cause Not Found By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="submitted on">P-II A Assignable Cause Not Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II A Assignable Cause Not Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Approval Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> P-II A Assignable Cause Found By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> P-II A Assignable Cause Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II A Assignable Cause Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Phase II B Investigation</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> Phase II B Investigation By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B Investigation On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B Investigation Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Phase II B HOD Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> Phase II B HOD Review Complete By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B HOD Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B HOD Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Phase II B QA/CQA Review Complete</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">Phase II B QA/CQA Review Complete By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B QA/CQA Review Complete On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B QA/CQA Review Complete Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">P-II B Assignable Cause Found</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">P-II B Assignable Cause Not Found By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on">P-II B Assignable Cause Not Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II B Assignable Cause Not Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">P-II B Assignable Cause Found By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on">P-II B Assignable Cause Found On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II B Assignable Cause Found Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">P III Investigation Applicable/Not Applicable</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">P III Investigation Applicable/Not Applicable By</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on">P III Investigation Applicable/Not Applicable On</label>
                            <div class="static">Not Applicable</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P III Investigation Applicable/Not Applicable Comment</label>
                        <div class="static">Not Applicable</div>
                       </div>
                    </div>
                </div>

                <div class="button-block">
                    <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                    <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                </div>
            </div>
        </div>

    </div>
    </form>

    </div>
    </div>
   <script>
    const virtualSelectInstance = VirtualSelect.init({
                ele: '#checklists'
            });

    document.querySelector('.abc').addEventListener('change', function() {
    const selectedOptions = $('#checklists').val();
    console.log(selectedOptions);
    console.log('selectedOptions', selectedOptions);


    const button1 = $('.button1')
    if (selectedOptions.includes('pH-Viscometer-MP')) {
        button1.show()
        console.log('Show button1');
    } else {
        button1.hide()
        console.log('Hide button1');
    }


    const button2 = $('.button2')
    if (selectedOptions.includes('Dissolution')) {
        button2.show()
        console.log('Show button2');
    } else {
        button2.hide()
        console.log('Hide button2');
    }


    const button3 = $('.button3');
    if (selectedOptions.includes('HPLC-GC')) {
        button3.show()
        console.log('Show button3');
    } else {
        button3.hide()
        console.log('Hide button3');
    }


    const button4 = $('.button4');
    if (selectedOptions.includes('General-checklist')) {
        button4.show()
        console.log('Show button4');
    } else {
        button4.hide()
        console.log('Hide button4');
    }


    const button5 = $('.button5');
    if (selectedOptions.includes('KF-Potentiometer')) {
        button5.show()
        console.log('Show button5');
    } else {
        button5.hide()
        console.log('Hide button5');
    }


    const button6 = $('.button6');
    if (selectedOptions.includes('RM-PM Sampling')) {
        button6.show()
        console.log('Show button6');
    } else {
        button6.hide()
        console.log('Hide button6');
    }

    const button7 = $('.button7');
    if (selectedOptions.includes('Bacterial-Endotoxin-Test')) {
        button7.show()
        console.log('Show button7');
    } else {
        button7.hide()
        console.log('Hide button7');
    }

    const button8 = $('.button8');
    if (selectedOptions.includes('Sterility')) {
        button8.show()
        console.log('Show button8');
    } else {
        button8.hide()
        console.log('Hide button8');
    }

    const button9 = $('.button9');
    if (selectedOptions.includes('Water-Test')) {
        button9.show()
        console.log('Show button9');
    } else {
        button9.hide()
        console.log('Hide button9');
    }

    const button10 = $('.button10');
    if (selectedOptions.includes('Microbial-assay')) {
        button10.show()
        console.log('Show button10');
    } else {
        button10.hide()
        console.log('Hide button10');
    }

    const button11 = $('.button11');
    if (selectedOptions.includes('Environmental-Monitoring')) {
        button11.show()
        console.log('Show button11');
    } else {
        button11.hide()
        console.log('Hide button11');
    }

    const button12 = $('.button12');
    if (selectedOptions.includes('Media-Suitability-Test')) {
        button12.show()
        console.log('Show button12');
    } else {
        button12.hide()
        console.log('Hide button12');
    }


        });

        function openCity(evt, cityName) {
            console.log('Open city:', cityName);
        }



   </script>
    <script>
        $(document).ready(function() {

            $('#Mainform').on('submit', function(e) {
                $('.on-submit-disable-button').prop('disabled', true);
            });
        })
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
        document.getElementById("dynamicSelectType").addEventListener("change", function() {
            var selectedRoute = this.value;
            window.location.href = selectedRoute; // Redirect to the selected route
        });
    </script>


    <script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to, #capa_ref_no_oosc'
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
