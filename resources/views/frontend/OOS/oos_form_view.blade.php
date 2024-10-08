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
    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

/*
        #change-control-fields > div > div.inner-block.state-block > div.status > div.progress-bars.d-flex > div:nth-child(16){
            border-radius: 0px 20px 20px 0px;

        } */
        #statusBlock > div.progress-bars.d-flex > div:nth-child(21){
            border-radius: 0px 8px 8px 0px;

        }
    </style>



    <!-- -----------------------------grid-1----------------------------script -->
    {{-- <script>
        $(document).ready(function() {
            $('#info_product_material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                    '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_product_code]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_batch_no]" value=""></td>'+
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_mfg_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        '<input type="date" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_mfg_date' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        '<input type="date" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_expiry_date' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_label_claim]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_pack_size]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_analyst_name]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_others_specify]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_process_sample_stage]" value=""></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_packing_material_type]"><option value="">--Select--</option><option value="Primary">Primary</option><option value="Secondary">Secondary</option><option value="Tertiary">Tertiary</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_stability_for]"><option value="">--Select--</option><option vlaue="Submission">Submission</option><option vlaue="Commercial">Commercial</option><option vlaue="Pack Evaluation">Pack Evaluation</option><option vlaue="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }
                    // html += '</select></td>' +
                    return html;
                }

                var tableBody = $('#info_product_material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#info_product_material').click(function(e) {
                function generateTableRow(serialNumber) {
                    var currentDate = new Date();
                    var formattedCurrentDate = currentDate.toISOString().split('T')[0].slice(0, 7); // Format as YYYY-MM

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_product_code]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_batch_no]" value=""></td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        // '<input type="text" readonly id="info_mfg_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        // '<input type="date" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_mfg_date' + serialNumber + '\')" max="' + currentDate + '">' +  // Add min date here
                        // '</div>' +
                        '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_mfg_date_' + serialNumber + '\')" max="' + formattedCurrentDate + '">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        // '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        // '<input type="date" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_expiry_date' + serialNumber + '\')" min="' + currentDate + '">' + // Add min date here
                        // '</div>' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_expiry_date' + serialNumber + '\')" min="' + formattedCurrentDate + '">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_label_claim]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_pack_size]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_analyst_name]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_others_specify]" value=""></td>' +
                        '<td><input type="text" name="info_product_material[' + serialNumber + '][info_process_sample_stage]" value=""></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_packing_material_type]"><option value="">--Select--</option><option value="Primary">Primary</option><option value="Secondary">Secondary</option><option value="Tertiary">Tertiary</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><select name="info_product_material[' + serialNumber + '][info_stability_for]"><option value="">--Select--</option><option value="Submission">Submission</option><option value="Commercial">Commercial</option><option value="Pack Evaluation">Pack Evaluation</option><option value="Not Applicable">Not Applicable</option></select></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_arnumber]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_condition_temprature_rh]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_Interval]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_orientation]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_pack_details]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_specification_no]"></td>'+
                        '<td><input type="text" name="details_stability[' + serialNumber + '][stability_study_sample_description]"></td>'+
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
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
                            '<td><input type="text" name="oos_detail['+ serialNumber +'][oos_submit_by]"></td>' +
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +
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
    <!-- ------------------------------grid-5 instrument_details-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#instrument_details').click(function(e) {
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
                                '<input type="date" name="instrument_detail[' + serialNumber + '][calibratedduedate_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibratedduedate_on' + serialNumber + '\')" max="' + currentDate + '">' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="number" name="oos_capa[' + serialNumber + '][info_oos_number]" value=""></td>' +
                        '<td>' +
                            '<div class="col-lg-6 new-date-data-field">' +
                            '<div class="group-input input-date">' +
                            '<div class="calenderauditee">' +
                            '<input type="text" readonly id="info_oos_reported_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                            '<input type="date" name="oos_capa[' + serialNumber + '][info_oos_reported_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_oos_reported_date' + serialNumber + '\')">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_description]" value=""></td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_previous_root_cause]" value=""></td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_capa]" value=""></td>' +
                        '<td>' +
                            '<div class="col-lg-6 new-date-data-field">' +
                            '<div class="group-input input-date">' +
                            '<div class="calenderauditee">' +
                            '<input type="text" readonly id="info_oos_closure_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                            '<input type="date" name="oos_capa[' + serialNumber + '][info_oos_closure_date]" value="" class="hide-input"oninput="handleDateInput(this, \'info_oos_closure_date' + serialNumber + '\')">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td><select name="oos_capa['+ serialNumber +'][info_oos_capa_requirement]"><option vlaue="">--select--</option><option value="yes">Yes</option><option value="No">No</option></select></td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_capa_reference_number]" value=""></td>' +
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_analysis_detials]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_hypothesis_experimentation_test_pr_no]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_analyst_name]"></td>' +
                        '<td><input type="text" name="oos_conclusion[' + serialNumber + '][summary_results_remarks]"></td>' +
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
            $('#oos_conclusion_review').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_product_name]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_batch_no]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_any_other_information]"></td>' +
                        '<td><input type="text" name="oos_conclusion_review[' + serialNumber + '][conclusion_review_action_affecte_batch]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
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
        <div class="division-bar pt-3">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }}/OOS/OOT
        </div>
    </div>

{{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">
        <div id="change-control-fields">
        <div class="container-fluid">

            @include('frontend.OOS.comps.stage')


            <!-- Tab links -->
            <div class="cctab">
                <div id="OOS_Chemical_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    @if ($data->stage == 3)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button>
                    @endif

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
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                </div>
                 <!-- OOS Micro Buttons -->
                 <div id="OOS_Micro_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    @if ($data->Stage == 3)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button>
                    @endif
                    <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                    <button class="cctablinks button7" style="display:none;" onclick="openCity(event, 'CCForm50')">Checklist - Bacterial Endotoxin Test</button>
                    <button class="cctablinks button8" style="display:none;" onclick="openCity(event, 'CCForm51')">Checklist - Sterility</button>
                    <button class="cctablinks button9" style="display:none;" onclick="openCity(event, 'CCForm52')">Checklist - Microbial limit test/Bioburden and Water Test</button>
                    <button class="cctablinks button10" style="display:none;"  onclick="openCity(event, 'CCForm53')">Checklist - Microbial assay</button>
                    <button class="cctablinks button11" style="display:none;"  onclick="openCity(event, 'CCForm54')">Checklist - Environmental Monitoring</button>
                    <button class="cctablinks button12" style="display:none;"  onclick="openCity(event, 'CCForm55')">Checklist - Media Suitability Test</button>
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
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                </div>
                <div id="OOT_Buttons" style="display: none;">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                    @if ($data->stage == 3)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button>
                    @endif
                    <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                    <button class="cctablinks button1" onclick="openCity(event, 'CCForm44')">CheckList - pH-Viscometer-MP</button>
                    <button class="cctablinks button2" onclick="openCity(event, 'CCForm45')">CheckList - Dissolution</button>
                    <button class="cctablinks button3" onclick="openCity(event, 'CCForm46')">CheckList - HPLC-GC</button>
                    <button class="cctablinks button4" onclick="openCity(event, 'CCForm47')">CheckList - General checklist</button>
                    <button class="cctablinks button5" onclick="openCity(event, 'CCForm48')">CheckList - KF-Potentiometer</button>
                    <button class="cctablinks button6" onclick="openCity(event, 'CCForm49')">CheckList - RM-PM Sampling</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm35')">Phase IB CQAH/QAH Review</button>

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

                {{-- <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm44')">CheckList - pH-Viscometer-MP</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm45')">CheckList - Dissolution</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm46')">CheckList - HPLC-GC</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm47')">CheckList - General checklist</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm48')">CheckList - KF-Potentiometer</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm49')">CheckList - RM-PM Sampling</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm35')"> Phase IB CQAH/QAH</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm18')">CheckList - Preliminary Lab. Investigation</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button> --}}
                <!-- checklist start -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm24')">Checklist - Investigation of Bacterial Endotoxin Test (BET)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm25')">Checklist - Investigation of Sterility</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm26')">Checklist - Investigation of Microbial limit test (MLT)</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist - Investigation of Chemical assay</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Checklist - Residual solvent (RS)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm23')">Checklist - Dissolution </button>--}}
                <!-- checklist closed -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase IIA Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Phase II B QAH/CQAH</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm41')">Phase II B QAH/CQAH</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm19')">CheckList - Phase II Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QA Review</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button> --}}
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button> -->

                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Extension</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button> --}}

            </div>
        <form action="{{ route('oos.oosupdate', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
            <!-- Tab content -->

            <!-- General Information -->
            <!-- Tab content -->

            <!-- General Information -->
            @include('frontend.OOS.comps.general_information')

            <div id="CCForm27" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Hod Primary Review
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remarks <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea name="hod_remark1"
                                    class="form-control {{$errors->has('hod_remark1') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 2 ? 'required' : 'readonly' }}>{{$data->hod_remark1}}</textarea>
                                @if($errors->has('hod_remark1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark1') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">HOD Primary Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment1">

                                        @if ($data->hod_attachment1)
                                            @foreach ($data->hod_attachment1 as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                        <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                    </a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                        <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                    </a>
                                                </h6>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment1[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment1')"
                                            {{ $data->stage == 2 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>

                </div>

            </div>
            <div id="CCForm28" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CQA/QA Head
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_remark1"
                                    class="form-control {{$errors->has('QA_Head_remark1') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 3 ? '' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark1}}</textarea>
                                    @if($errors->has('QA_Head_remark1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_remark1') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">CQA/QA Head Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment1">

                                        @if ($data->QA_Head_attachment1)
                                        @foreach ($data->QA_Head_attachment1 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment1[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment1')" {{$data->stage == 1 || $data->stage == 2 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm29" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        CQA/QA Head Primary Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_primary_remark1"
                                    class="form-control {{$errors->has('QA_Head_primary_remark1') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 4 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark1}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark1') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">CQA/QA Head Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment1">

                                        @if ($data->QA_Head_primary_attachment1)
                                        @foreach ($data->QA_Head_primary_attachment1 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment1[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment1')" {{ $data->stage == 4 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>

            @include('frontend.OOS.comps.preliminary')

            <div id="CCForm44" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        pH-Viscometer-MP
                    </div>
                    <div class="row">
                         <!-- Others Field -->



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
                                        @if ($ph_meters)
                                            @foreach ($ph_meter_questions as $ph_meter_question)
                                                <tr>
                                                    <td class="flex text-center">{{ $loop->index+1 }}</td>
                                                    <td>{{ $ph_meter_question }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                            <select name="ph_meter[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                <option value="Yes">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea name="ph_meter[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getArrayKey($ph_meters->data[$loop->index], 'remark') }}</textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @php
                    $Viscometer_questions = array(
                            "Was instrument calibrated before start of analysis?",
                            "Was sampled prepared as per STP?",
                            "Was correct spindle used for analysis?",
                            "Was Sufficient quantity used to performed the analysis?",
                        );
                @endphp
                 <div class="col-12">
                         <label style="font-weight: bold; for="Audit Attachments">Viscometer</label>
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
                                     @if ($Viscometers)
                                         @foreach ($Viscometer_questions as $index => $Viscometer_question)
                                             <tr>
                                                 <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                 <td><input type="text" readonly name="question[]" value="{{ $Viscometer_question }}">
                                                 </td>
                                                 <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                         <select name="Viscometer[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                             <option value="">Select an Option</option>
                                                             <option value="Yes" {{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                             <option value="No" {{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                             <option value="N/A" {{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                         </select>
                                                     </div>
                                                 </td>
                                                 <td style="vertical-align: middle;">
                                                     <div style="margin: auto; display: flex; justify-content: center;">
                                                         <textarea name="Viscometer[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($Viscometers->data[$loop->index], 'remark') }}</textarea>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     @endif
                                 </tbody>
                             </table>
                         </div>

                     </div>
                 </div>

                 @php
                     $Melting_Point_questions = array(
                             "Was instrument calibrated before start of analysis?",
                             "Was sampled prepared as per STP?",
                             "Was sampled properly filled inside the capillary tube?",
                             "Were instrument properly connected at the time of analysis?",
                             "Was temperature of the instrument as per STP?",
                             "Was temperature acquired during analysis?",
                         );
                 @endphp
                 <div class="col-12">
                         <label style="font-weight: bold; for="Audit Attachments">Melting Point</label>
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
                                     @if ($Melting_Points)
                                         @foreach ($Melting_Point_questions as $index => $Melting_Point_question)
                                             <tr>
                                                 <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                 <td><input type="text" readonly name="question[]" value="{{ $Melting_Point_question }}">
                                                 </td>
                                                 <td>
                                                     <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                         <select name="Melting_Point[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                             <option value="">Select an Option</option>
                                                             <option value="Yes" {{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                             <option value="No" {{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                             <option value="N/A" {{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                         </select>
                                                     </div>
                                                 </td>
                                                 <td style="vertical-align: middle;">
                                                     <div style="margin: auto; display: flex; justify-content: center;">
                                                         <textarea name="Melting_Point[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($Melting_Points->data[$loop->index], 'remark') }}</textarea>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     @endif
                                 </tbody>
                             </table>
                         </div>

                     </div>
                 </div>


                 <div class="button-block">
                    @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                    @else
                    <button type="submit" class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    @endif
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                </div>
                    </div>
                </div>

            </div>

            <div id="CCForm45" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Dissolution
                    </div>
                    <div class="row">
                         <!-- Others Field -->
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

                     <div class="col-12">
                             <label style="font-weight: bold; for="Audit Attachments">Dissolution Tester</label>
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
                                         @if ($Dis_solutions)
                                             @foreach ($Dis_solution_questions as $index => $Dis_solution_question)
                                                 <tr>
                                                     <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                     <td><input type="text" readonly name="question[]" value="{{ $Dis_solution_question }}">
                                                     </td>
                                                     <td>
                                                         <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                             <select name="Dis_solution[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                 <option value="">Select an Option</option>
                                                                 <option value="Yes" {{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                 <option value="No" {{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                 <option value="N/A" {{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                             </select>
                                                         </div>
                                                     </td>
                                                     <td style="vertical-align: middle;">
                                                         <div style="margin: auto; display: flex; justify-content: center;">
                                                             <textarea name="Dis_solution[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($Dis_solutions->data[$loop->index], 'remark') }}</textarea>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         @endif
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>




                     <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                    </div>
                </div>

            </div>
            <div id="CCForm46" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        HPLC-GC
                    </div>
                    <div class="row">
                         <!-- Others Field -->



                         @php
                         $HPLC_GC_questions = array(
                                 "Was analyst used correct column as per mentioned in STP?",
                                 "Was Chromatography Condition/Instrument Parameter like Retention time, wavelength,
                                  flow rate, injection volume, column temperature and autos ampler temperature as per mentioned in STP?",
                                 "Was inlet filter sonicated before start of analysis?",
                                 "Was suction of port A,port B,port C,port D and rinse port are working correctly?",
                                 "Was corrected rinse solution used for analysis as per SOP? ",
                                 "Was Buffer prepared as per mentioned in STP?",
                                 "Is mobile phase within validity periods?",
                                 "Is seal wash performed properly?",
                                 "Whether analyst used corrected solution for column wash/seal wash before start of
                                  analysis as per SOP ?",
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
                                 "Was analyst used SS (Stainiless steel) tubes for analysis?",
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
                                 "Is method validation/verification available ?"
                             );
                     @endphp
                     <div class="col-12">
                             <label style="font-weight: bold; for="Audit Attachments">HPLC-GC</label>
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
                                         @if ($HPLC_GCs)
                                             @foreach ($HPLC_GC_questions as $index => $HPLC_GC_question)
                                                 <tr>
                                                     <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                     <td><input type="text" readonly name="question[]" value="{{ $HPLC_GC_question }}">
                                                     </td>
                                                     <td>
                                                         <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                             <select name="HPLC_GC[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                 <option value="">Select an Option</option>
                                                                 <option value="Yes" {{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                 <option value="No" {{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                 <option value="N/A" {{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                             </select>
                                                         </div>
                                                     </td>
                                                     <td style="vertical-align: middle;">
                                                         <div style="margin: auto; display: flex; justify-content: center;">
                                                             <textarea name="HPLC_GC[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($HPLC_GCs->data[$loop->index], 'remark') }}</textarea>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         @endif
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>




                     <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                    </div>
                </div>

            </div>
            <div id="CCForm47" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        General Checklist
                    </div>
                    <div class="row">
                         <!-- Others Field -->



                         @php
                         $General_Checklist_questions = array(
                                 "Was solid/Liquid Chemical used as per STP?",
                                 "Was chemical used within validity periods?",
                                 "Was correct chemical grade used for analysis?",
                                 "Was analyst weighed the chemical as per mentioned in STP?",
                                 "Was analyst used correct Reagent/Volumentrick solution for analysis",
                                 "Were analyst used Cleaned and  Dried Glassware like volumetrik flask,Pippete,separating funnel & Beaker ? ",
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
                     <div class="col-12">
                             <label style="font-weight: bold; for="Audit Attachments">General Checklist</label>
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
                                         @if ($General_Checklists)
                                             @foreach ($General_Checklist_questions as $index => $General_Checklist_question)
                                                 <tr>
                                                     <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                     <td><input type="text" readonly name="question[]" value="{{ $General_Checklist_question }}">
                                                     </td>
                                                     <td>
                                                         <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                             <select name="General_Checklist[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                 <option value="">Select an Option</option>
                                                                 <option value="Yes" {{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                 <option value="No" {{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                 <option value="N/A" {{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                             </select>
                                                         </div>
                                                     </td>
                                                     <td style="vertical-align: middle;">
                                                         <div style="margin: auto; display: flex; justify-content: center;">
                                                             <textarea name="General_Checklist[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($General_Checklists->data[$loop->index], 'remark') }}</textarea>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         @endif
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>




                     <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                    </div>
                </div>

            </div>
            <div id="CCForm48" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        KF-Potentionmeter
                    </div>
                    <div class="row">
                         <!-- Others Field -->



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
                     <div class="col-12">
                             <label style="font-weight: bold; for="Audit Attachments">kF/Potentionmeter</label>
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
                                         @if ($kF_Potentionmeters)
                                             @foreach ($kF_Potentionmeter_questions as $index => $kF_Potentionmeter_question)
                                                 <tr>
                                                     <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                     <td><input type="text" readonly name="question[]" value="{{ $kF_Potentionmeter_question }}">
                                                     </td>
                                                     <td>
                                                         <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                             <select name="kF_Potentionmeter[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                 <option value="">Select an Option</option>
                                                                 <option value="Yes" {{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                 <option value="No" {{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                 <option value="N/A" {{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                             </select>
                                                         </div>
                                                     </td>
                                                     <td style="vertical-align: middle;">
                                                         <div style="margin: auto; display: flex; justify-content: center;">
                                                             <textarea name="kF_Potentionmeter[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($kF_Potentionmeters->data[$loop->index], 'remark') }}</textarea>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         @endif
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>




                     <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                    </div>
                </div>

            </div>
            <div id="CCForm49" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        RM-PM Sampling
                    </div>
                    <div class="row">
                         <!-- Others Field -->



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
                     <div class="col-12">
                             <label style="font-weight: bold; for="Audit Attachments">Sampling Checklist </label>
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
                                         @if ($RM_PMs)
                                             @foreach ($RM_PM_questions as $index => $RM_PM_question)
                                                 <tr>
                                                     <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                     <td><input type="text" readonly name="question[]" value="{{ $RM_PM_question }}">
                                                     </td>
                                                     <td>
                                                         <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                             <select name="RM_PM[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                 <option value="">Select an Option</option>
                                                                 <option value="Yes" {{ Helpers::getArrayKey($RM_PMs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                 <option value="No" {{ Helpers::getArrayKey($RM_PMs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                 <option value="N/A" {{ Helpers::getArrayKey($RM_PMs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                             </select>
                                                         </div>
                                                     </td>
                                                     <td style="vertical-align: middle;">
                                                         <div style="margin: auto; display: flex; justify-content: center;">
                                                             <textarea name="RM_PM[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($RM_PMs->data[$loop->index], 'remark') }}</textarea>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         @endif
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>




                     <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                    </div>
                </div>

            </div>
            <div id="CCForm50" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Checklist for Analyst Training and Procedure
                    </div>
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
                                'question' => "Were appropriate precautions taken by the analyst throughout the test?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Analyst interview record",
                                'is_sub_question' => true,
                                'input_type' => 'number'
                            ],
                            [
                                'question' => "Was an analyst/sampling person suffering from any ailment such as cough/cold or open wound or skin infections?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                            ],
                            [
                                'question' => "Analyst interview record",
                                'is_sub_question' => true,
                                'input_type' => 'number'
                            ],
                            [
                                'question' => "Was the correct procedure for the transfer of samples and accessories to sampling/testing areas followed?",
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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="analyst_training_procedure[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="analyst_training_procedure[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="analyst_training_procedure[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="analyst_training_procedure[{{ $index }}][remark]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'analyst_training_procedure', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="sample_receiving_var[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="sample_receiving_var[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="sample_receiving_var[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="sample_receiving_var[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'sample_receiving_var', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="sub-head">Method /procedure used during analysis</div>

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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="method_used_during_analysis[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="method_used_during_analysis[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="method_used_during_analysis[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="method_used_during_analysis[{{ $index }}][remark]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'method_used_during_analysis', true, 'remark', true, $index) ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="instrument_equipment_detailss[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="instrument_equipment_detailss[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="instrument_equipment_detailss[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="instrument_equipment_detailss[{{ $index }}][remark]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'instrument_equipment_detailss', true, 'remark', true, $index) ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="sub-head">Results and Calculation</div>

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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="result_and_calculation[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="result_and_calculation[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="result_and_calculation[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="result_and_calculation[{{ $index }}][remark]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'result_and_calculation', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                                @else
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                @endif
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                            </div>
                    </div>
                </div>
            </div>

            <div id="CCForm51" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head"> Checklist for Review of Training records Analyst Involved in Testing </div>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="Training_records_Analyst_Involved1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Training_records_Analyst_Involved1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="Training_records_Analyst_Involved1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Training_records_Analyst_Involved1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Training_records_Analyst_Involved1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="sample_intactness_before_analysis1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="sample_intactness_before_analysis1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="sample_intactness_before_analysis1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="sample_intactness_before_analysis1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="test_methods_Procedure1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="test_methods_Procedure1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="test_methods_Procedure1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="test_methods_Procedure1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'test_methods_Procedure1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist For Review of Media, Buffer, Standards preparation & test accessories </div>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Review_of_Media_Buffer_Standards_prep1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Review_of_Media_Buffer_Standards_prep1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Review_of_Media_Buffer_Standards_prep1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Review_of_Media_Buffer_Standards_prep1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Review_of_Media_Buffer_Standards_prep1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_for_Revi_of_Media_Buffer_Stand_prep1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="ccheck_for_disinfectant_detail1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="ccheck_for_disinfectant_detail1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="ccheck_for_disinfectant_detail1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="ccheck_for_disinfectant_detail1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'ccheck_for_disinfectant_detail1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Checklist_for_Review_of_instrument_equip1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_for_Review_of_instrument_equip1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_for_Review_of_instrument_equip1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_for_Review_of_instrument_equip1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_instrument_equip1', true, 'remark', true, $index) ?? '' }}</textarea>
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

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Attachments">If Yes, Provide attachment details</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="provide_attachment1">

                                    @if ($data->provide_attachment1)
                                    @foreach ($data->provide_attachment1 as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                class="fa fa-eye text-primary"
                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                    </h6>
                                    @endforeach
                                    @endif

                                </div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="provide_attachment1[]"
                                        oninput="addMultipleFiles(this, 'provide_attachment1')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                        @else
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                    </div>
                </div>


            </div>
            <div id="CCForm52" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                    Checklist for Review of Training records Analyst Involved in Testing
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'Checklist_for_Review_of_Training_records_Analyst1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_for_Review_of_Training_records_Analyst1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_for_Review_of_Training_records_Analyst1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_for_Review_of_Training_records_Analyst1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_Training_records_Analyst1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Checklist_for_Review_of_sampling_and_Transport1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_for_Review_of_sampling_and_Transport1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_for_Review_of_sampling_and_Transport1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_for_Review_of_sampling_and_Transport1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_of_sampling_and_Transport1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                        </thead>
                                        <tbody>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Checklist_Review_of_Test_Method_proceds1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_Review_of_Test_Method_proceds1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_Review_of_Test_Method_proceds1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_Review_of_Test_Method_proceds1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_Review_of_Test_Method_proceds1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                        <select name="microbial_isolates_bioburden[0][response]" id="response"
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
                                                        <textarea name="microbial_isolates_bioburden[0][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                                            id="microbial_isolates_bioburden "></div>
                                                            <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                                <div>Add</div>
                                                                <input type="file" id="myfile" name="microbial_isolates_bioburden[1][attachment]"
                                                                    oninput="addMultipleFiles(this, 'microbial_isolates_bioburden')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden[1][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.1.2</td>
                                                <td>Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden[2][response]" id="response"
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
                                                        <textarea name="microbial_isolates_bioburden[2][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.1.3</td>
                                                <td>Gram nature of the organism (GP/GN)</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden[3][response]" id="response"
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
                                                        <textarea name="microbial_isolates_bioburden[3][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                                            id="microbial_isolates_bioburden "></div>
                                                            <div class="add-btn" style="position:relative; left:23px; width: 75px; height: 43px; background-color:white;" >
                                                                <div>Add</div>
                                                                <input type="file" id="myfile" name="microbial_isolates_bioburden[4][attachment]"
                                                                    oninput="addMultipleFiles(this, 'microbial_isolates_bioburden')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                     <div
                                                        style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="microbial_isolates_bioburden[4][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">4.2</td>
                                                <td>Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.</td>
                                                <td>

                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="microbial_isolates_bioburden[5][response]" id="response"
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
                                                        <textarea name="microbial_isolates_bioburden[5][remark]" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                                value="{{ is_string($value = Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index)) ? $value : '' }}"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                                value="{{ is_string($value = Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index)) ? $value : '' }}"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][remark]"
                                                                style="border-radius: 7px; border: 1.5px solid black;">{{ is_string($value = Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'remark', true, $index)) ? $value : '' }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>

                                        {{--<tr>
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>

                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_for_Review_Media_prepara_RTU_medias1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_for_Review_Media_prepara_RTU_medias1', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>--}}
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="Checklist_Review_Environment_condition_in_tests1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_Review_Environment_condition_in_tests1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="Checklist_Review_Environment_condition_in_tests1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Checklist_Review_Environment_condition_in_tests1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Checklist_Review_Environment_condition_in_tests1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                    <td class="flex text-center">
                                                        {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                    </td>
                                                    <td>{{ $review_item['question'] }}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="review_of_instrument_bioburden_and_waters1[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="review_of_instrument_bioburden_and_waters1[{{ $index }}][response]"
                                                                       value="{{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) ?? '' }}"
                                                                       style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                                <select name="review_of_instrument_bioburden_and_waters1[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="review_of_instrument_bioburden_and_waters1[{{ $index }}][remark]"
                                                                      style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'review_of_instrument_bioburden_and_waters1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                    Checklist for Disinfectant Details:</div>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="disinfectant_details_of_bioburden_and_water_tests1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="disinfectant_details_of_bioburden_and_water_tests1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="disinfectant_details_of_bioburden_and_water_tests1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="disinfectant_details_of_bioburden_and_water_tests1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'disinfectant_details_of_bioburden_and_water_tests1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                <div class="col-12">
                    <div class="group-input">
                        <label for="Audit Attachments">If Yes, Provide attachment details</label>
                        <small class="text-primary">
                            Please Attach all relevant or supporting documents
                        </small>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="provide_attachment2">

                                @if ($data->provide_attachment2)
                                @foreach ($data->provide_attachment2 as $file)
                                <h6 type="button" class="file-container text-dark"
                                    style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                            class="fa fa-eye text-primary"
                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                            class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                </h6>
                                @endforeach
                                @endif

                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="provide_attachment2[]"
                                    oninput="addMultipleFiles(this, 'provide_attachment2')" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-block">
                    @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                    @else
                    <button type="submit" class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    @endif
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                </div>
                    </div>
                </div>
            </div>
            <div id="CCForm53" class="inner-block cctabcontent">

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
                                                        <td class="flex text-center">
                                                            {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                        </td>
                                                        <td>{{ $review_item['question'] }}</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                @if ($review_item['input_type'] == 'date')
                                                                    <input type="date" name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{ $index }}][response]"
                                                                           value="{{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) ?? '' }}"
                                                                           style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                    <input type="number" name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{ $index }}][response]"
                                                                           value="{{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) ?? '' }}"
                                                                           style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                    <select name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{ $index }}][response]"
                                                                            id="response"
                                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        <option value="">Select an Option</option>
                                                                        <option value="Yes" {{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                        <option value="No" {{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                        <option value="N/A" {{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="training_records_analyst_involvedIn_testing_microbial_asssays1[{{ $index }}][remark]"
                                                                          style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssays1', true, 'remark', true, $index) ?? '' }}</textarea>
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

                                    <div class="sub-head">Checklist for Review of sample intactness before analysis ? </div>
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
                                                            <td class="flex text-center">
                                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                            </td>
                                                            <td>{{ $review_item['question'] }}</td>
                                                            <td>
                                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                    @if ($review_item['input_type'] == 'date')
                                                                        <input type="date" name="sample_intactness_before_analysis22[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="sample_intactness_before_analysis22[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @else
                                                                        <select name="sample_intactness_before_analysis22[{{ $index }}][response]"
                                                                                id="response"
                                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                            <option value="">Select an Option</option>
                                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                                    <textarea name="sample_intactness_before_analysis22[{{ $index }}][remark]"
                                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'sample_intactness_before_analysis22', true, 'remark', true, $index) ?? '' }}</textarea>
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

                                    <div class="sub-head">Checklist for Review of test methods & Procedures</div>
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
                                                            <td class="flex text-center">
                                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                            </td>
                                                            <td>{{ $review_item['question'] }}</td>
                                                            <td>
                                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                    @if ($review_item['input_type'] == 'date')
                                                                        <input type="date" name="checklist_for_review_of_test_method_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="checklist_for_review_of_test_method_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @else
                                                                        <select name="checklist_for_review_of_test_method_IMA1[{{ $index }}][response]"
                                                                                id="response"
                                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                            <option value="">Select an Option</option>
                                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                                    <textarea name="checklist_for_review_of_test_method_IMA1[{{ $index }}][remark]"
                                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_review_of_test_method_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                                <td class="flex text-center">
                                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                                </td>
                                                                <td>{{ $review_item['question'] }}</td>
                                                                <td>
                                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                        @if ($review_item['input_type'] == 'date')
                                                                            <input type="date" name="cr_of_media_buffer_st_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                            <input type="number" name="cr_of_media_buffer_st_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                            <select name="cr_of_media_buffer_st_IMA1[{{ $index }}][response]"
                                                                                    id="response"
                                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                                <option value="">Select an Option</option>
                                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                            </select>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="cr_of_media_buffer_st_IMA1[{{ $index }}][remark]"
                                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'cr_of_media_buffer_st_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                            <td class="flex text-center">
                                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                            </td>
                                                            <td>{{ $review_item['question'] }}</td>
                                                            <td>
                                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                    @if ($review_item['input_type'] == 'date')
                                                                        <input type="date" name="CR_of_microbial_cultures_inoculation_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="CR_of_microbial_cultures_inoculation_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @else
                                                                        <select name="CR_of_microbial_cultures_inoculation_IMA1[{{ $index }}][response]"
                                                                                id="response"
                                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                            <option value="">Select an Option</option>
                                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                                    <textarea name="CR_of_microbial_cultures_inoculation_IMA1[{{ $index }}][remark]"
                                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_microbial_cultures_inoculation_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                                <td class="flex text-center">
                                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                                </td>
                                                                <td>{{ $review_item['question'] }}</td>
                                                                <td>
                                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                        @if ($review_item['input_type'] == 'date')
                                                                            <input type="date" name="CR_of_Environmental_condition_in_testing_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                            <input type="number" name="CR_of_Environmental_condition_in_testing_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                            <select name="CR_of_Environmental_condition_in_testing_IMA1[{{ $index }}][response]"
                                                                                    id="response"
                                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                                <option value="">Select an Option</option>
                                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                            </select>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="CR_of_Environmental_condition_in_testing_IMA1[{{ $index }}][remark]"
                                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_Environmental_condition_in_testing_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                                <td class="flex text-center">
                                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                                </td>
                                                                <td>{{ $review_item['question'] }}</td>
                                                                <td>
                                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                        @if ($review_item['input_type'] == 'date')
                                                                            <input type="date" name="CR_of_instru_equipment_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @elseif ($review_item['input_type'] == 'number')
                                                                            <input type="number" name="CR_of_instru_equipment_IMA1[{{ $index }}][response]"
                                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                        @else
                                                                            <select name="CR_of_instru_equipment_IMA1[{{ $index }}][response]"
                                                                                    id="response"
                                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                                <option value="">Select an Option</option>
                                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                            </select>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="CR_of_instru_equipment_IMA1[{{ $index }}][remark]"
                                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equipment_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                            <td class="flex text-center">
                                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                            </td>
                                                            <td>{{ $review_item['question'] }}</td>
                                                            <td>
                                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                    @if ($review_item['input_type'] == 'date')
                                                                        <input type="date" name="disinfectant_details_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @elseif ($review_item['input_type'] == 'number')
                                                                        <input type="number" name="disinfectant_details_IMA1[{{ $index }}][response]"
                                                                               value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) ?? '' }}"
                                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @else
                                                                        <select name="disinfectant_details_IMA1[{{ $index }}][response]"
                                                                                id="response"
                                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                            <option value="">Select an Option</option>
                                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                                    <textarea name="disinfectant_details_IMA1[{{ $index }}][remark]"
                                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'disinfectant_details_IMA1', true, 'remark', true, $index) ?? '' }}</textarea>
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

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Audit Attachments">If Yes, Provide attachment details</label>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="provide_attachment3">

                                                    @if ($data->provide_attachment3)
                                                    @foreach ($data->provide_attachment3 as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                    @endforeach
                                                    @endif

                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="provide_attachment3[]"
                                                        oninput="addMultipleFiles(this, 'provide_attachment3')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               <div class="button-block">
                                    @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                                    @else
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    @endif
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                             </div>
                </div>
            </div>

            <div id="CCForm54" class="inner-block cctabcontent">
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'CR_of_training_rec_anaylst_in_monitoring_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="CR_of_training_rec_anaylst_in_monitoring_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'Check_for_Sample_details_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Check_for_Sample_details_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Check_for_Sample_details_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Check_for_Sample_details_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Check_for_Sample_details_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'Check_for_comparision_of_results_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="Check_for_comparision_of_results_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="Check_for_comparision_of_results_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="Check_for_comparision_of_results_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Check_for_comparision_of_results_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_media_dehydrated_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_media_dehydrated_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_media_dehydrated_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_media_dehydrated_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_media_dehydrated_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_media_prepara_sterilization_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_media_prepara_sterilization_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_media_prepara_sterilization_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_media_prepara_sterilization_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_media_prepara_sterilization_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="'CR_of_En_condition_in_testing_CIEM1',[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="CR_of_En_condition_in_testing_CIEM1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="CR_of_En_condition_in_testing_CIEM1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="CR_of_En_condition_in_testing_CIEM1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_En_condition_in_testing_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="'check_for_disinfectant_CIEM1',[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="check_for_disinfectant_CIEM1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="check_for_disinfectant_CIEM1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="check_for_disinfectant_CIEM1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'check_for_disinfectant_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_fogging_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_fogging_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_fogging_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_fogging_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_fogging_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'CR_of_test_method_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="CR_of_test_method_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="CR_of_test_method_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="CR_of_test_method_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_test_method_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'CR_microbial_isolates_contamination_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="CR_microbial_isolates_contamination_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="CR_microbial_isolates_contamination_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="CR_microbial_isolates_contamination_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_microbial_isolates_contamination_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'CR_of_instru_equip_CIEM1',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="CR_of_instru_equip_CIEM1[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="CR_of_instru_equip_CIEM1[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="CR_of_instru_equip_CIEM1[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'CR_of_instru_equip_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="'Ch_Trend_analysis_CIEM1',[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Ch_Trend_analysis_CIEM1[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="Ch_Trend_analysis_CIEM1[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="Ch_Trend_analysis_CIEM1[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'Ch_Trend_analysis_CIEM1', true, 'remark', true, $index) ?? '' }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">If Yes, Provide attachment details</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="provide_attachment4">

                                        @if ($data->provide_attachment4)
                                        @foreach ($data->provide_attachment4 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="provide_attachment4[]"
                                            oninput="addMultipleFiles(this, 'provide_attachment4')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                </div>

                </div>
            </div>


            <div id="CCForm55" class="inner-block cctabcontent">
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_analyst_training_CIMT2',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_analyst_training_CIMT2[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_analyst_training_CIMT2[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_analyst_training_CIMT2[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_analyst_training_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="'checklist_for_comp_results_CIMT2',[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="checklist_for_comp_results_CIMT2[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="checklist_for_comp_results_CIMT2[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_for_comp_results_CIMT2[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_comp_results_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_Culture_verification_CIMT2',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_Culture_verification_CIMT2[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_Culture_verification_CIMT2[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_Culture_verification_CIMT2[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_Culture_verification_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'sterilize_accessories_CIMT2',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="sterilize_accessories_CIMT2[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="sterilize_accessories_CIMT2[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="sterilize_accessories_CIMT2[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'sterilize_accessories_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_intrument_equip_last_CIMT2',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_intrument_equip_last_CIMT2[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_intrument_equip_last_CIMT2[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_intrument_equip_last_CIMT2[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_intrument_equip_last_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                            <td class="flex text-center">
                                                {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                            </td>
                                            <td>{{ $review_item['question'] }}</td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                    @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="'disinfectant_details_last_CIMT2',[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="disinfectant_details_last_CIMT2[{{ $index }}][response]"
                                                               value="{{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                               style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                    @else
                                                        <select name="disinfectant_details_last_CIMT2[{{ $index }}][response]"
                                                                id="response"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                            <option value="N/A" {{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="disinfectant_details_last_CIMT2[{{ $index }}][remark]"
                                                              style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'disinfectant_details_last_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
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
                                                <td class="flex text-center">
                                                    {{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}
                                                </td>
                                                <td>{{ $review_item['question'] }}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                            <input type="date" name="'checklist_for_result_calculation_CIMT2',[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                            <input type="number" name="checklist_for_result_calculation_CIMT2[{{ $index }}][response]"
                                                                   value="{{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) ?? '' }}"
                                                                   style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                            <select name="checklist_for_result_calculation_CIMT2[{{ $index }}][response]"
                                                                    id="response"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                <option value="">Select an Option</option>
                                                                <option value="Yes" {{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'response', true, $index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="checklist_for_result_calculation_CIMT2[{{ $index }}][remark]"
                                                                  style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getChemicalGridData($data, 'checklist_for_result_calculation_CIMT2', true, 'remark', true, $index) ?? '' }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Audit Attachments">If Yes, Provide attachment details</label>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="provide_attachment5">

                                                    @if ($data->provide_attachment5)
                                                    @foreach ($data->provide_attachment5 as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                    @endforeach
                                                    @endif

                                                </div>
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
                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                  </div>
                </div>
            </div>

            <div id="CCForm42" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Outcome of Phase IA investigation<span class="text-danger">*</span></label>
                                <textarea id="outcome_phase_IA" name="outcome_phase_IA" {{ $data->stage == 9 ? 'required' : 'readonly' }}>{{ $data->outcome_phase_IA }} </textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Reason for proceeding to Phase IB investigation</label>
                                <textarea id="reason_for_proceeding" name="reason_for_proceeding" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->reason_for_proceeding }}</textarea>
                            </div>
                        </div>
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
                        <div class="col-12">
                                <label style="font-weight: bold; for="Audit Attachments">Phase IB investigation Checklist</label>
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
                                            @if ($checklist_IB_invs)
                                                @foreach ($IIB_inv_questions as $index => $IIB_inv_question)
                                                    <tr>
                                                        <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                                        <td><input type="text" readonly name="question[]" value="{{ $IIB_inv_question }}">
                                                        </td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">

                                                            @php
                                                                $dataItem = $checklist_IB_invs->data[$loop->index] ?? null;
                                                            @endphp

                                                            <select name="checklist_IB_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;" {{Helpers::isOOSChemical($data->stage)}}>
                                                                <option value="">Select an Option</option>

                                                                <option value="Yes" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                <option value="N/A" {{ isset($dataItem) && Helpers::getArrayKey($dataItem, 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            </select>

                                                                {{--<select name="checklist_IB_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>--}}
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                                @php
                                                                $dataItem = $checklist_IB_invs->data[$loop->index] ?? null;
                                                                $remark = isset($dataItem) ? Helpers::getArrayKey($dataItem, 'remark') : '';
                                                            @endphp

                                                            <textarea name="checklist_IB_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;" {{Helpers::isOOSChemical($data->stage)}}>{{ $remark }}</textarea>

                                                                {{--<textarea name="checklist_IB_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'remark') }}</textarea>--}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Summary of Review</label>
                                <textarea id="summaryy_of_review" name="summaryy_of_review" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->summaryy_of_review }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Probable Cause Identification</label>
                                <textarea id="Probable_cause_iden" name="Probable_cause_iden" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Probable_cause_iden }}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Proposal for Phase IB hypothesis</label>
                                    <select name="proposal_for_hypothesis_IB" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'disabled' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Re-injection of the original vial" {{ $data->proposal_for_hypothesis_IB == 'Re-injection of the original vial' ? 'selected' : '' }}>Re-injection of the original vial</option>
                                    <option value="Re-filtration and Injection from final dilution" {{ $data->proposal_for_hypothesis_IB == 'Re-filtration and Injection from final dilution' ? 'selected' : '' }}>Re-filtration and Injection from final dilution</option>
                                    <option value="Re-dilution from the tock solution and injection" {{ $data->proposal_for_hypothesis_IB == 'Re-dilution from the tock solution and injection' ? 'selected' : '' }}>Re-dilution from the tock solution and injection</option>
                                    <option value="Re-sonication / re-shaking due to probable incomplete solubility and analyze" {{ $data->proposal_for_hypothesis_IB == 'Re-sonication / re-shaking due to probable incomplete solubility and analyze' ? 'selected' : '' }}>Re-sonication / re-shaking due to probable incomplete solubility and analyze</option>
                                    <option value="Other" {{ $data->proposal_for_hypothesis_IB == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="checklists">Proposal for Phase IB hypothesis</label>
                                @php
                                $ChecklistData = $data->proposal_for_hypothesis_IB;

                                if (is_array($ChecklistData) && array_key_exists('0', $ChecklistData) && is_string($ChecklistData[0]) && !empty($ChecklistData[0])) {
                                    $selectedChecklist = explode(',', $ChecklistData[0]);
                                } else {
                                    $selectedChecklist = is_array($ChecklistData) ? $ChecklistData : [];
                                }
                            @endphp
                                <select multiple id="reference_record" name="proposal_for_hypothesis_IB[]">
                                    {{-- <option value="">--Select---</option> --}}
                                    <option value="Re-injection of the original vial" @if (in_array('Re-injection of the original vial', $selectedChecklist)) selected @endif>Re-injection of the original vial</option>
                                    <option value="Re-filtration and Injection from final dilution" @if (in_array('Re-filtration and Injection from final dilution', $selectedChecklist)) selected @endif>Re-filtration and Injection from final dilution</option>
                                    <option value="Re-dilution from the tock solution and injection" @if (in_array('Re-dilution from the tock solution and injection', $selectedChecklist)) selected @endif>Re-dilution from the tock solution and injection</option>
                                    <option value="Re-sonication / re-shaking due to probable incomplete solubility and analyze" @if (in_array('Re-sonication / re-shaking due to probable incomplete solubility and analyze', $selectedChecklist)) selected @endif>Re-sonication / re-shaking due to probable incomplete solubility and analyze</option>
                                    <option value="Other" @if (in_array('Other', $selectedChecklist)) selected @endif>Other</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Others</label>
                                <textarea id="proposal_for_hypothesis_others" name="proposal_for_hypothesis_others" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->proposal_for_hypothesis_others }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Details of results (Including original OOS/OOT results for side by side comparison)</label>
                                <textarea id="details_of_result" name="details_of_result" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->details_of_result }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Probable Cause Identified in Phase IB investigation</label>
                                    <select name="Probable_Cause_Identified" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->Probable_Cause_Identified == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->Probable_Cause_Identified == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Any other Comments/ Probable Cause Evidence</label>
                                <textarea id="Any_other_Comments" name="Any_other_Comments" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Any_other_Comments }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Proposal for Hypothesis testing to confirm Probable Cause identified</label>
                                <textarea id="Proposal_for_Hypothesis" name="Proposal_for_Hypothesis" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Proposal_for_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Summary of Hypothesis</label>
                                <textarea id="Summary_of_Hypothesis" name="Summary_of_Hypothesis" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Summary_of_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Assignable Cause</label>
                                    <select name="Assignable_Cause" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Found" {{ $data->Assignable_Cause == 'Found' ? 'selected' : '' }}>Found</option>
                                    <option value="Not Found" {{ $data->Assignable_Cause == 'Not Found' ? 'selected' : '' }}>Not Found</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Types of assignable cause</label>
                                    <select name="Types_of_assignable" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Analyst error" {{ $data->Types_of_assignable == 'Analyst error' ? 'selected' : '' }}>Analyst error</option>
                                    <option value="Instrument error" {{ $data->Types_of_assignable == 'Instrument error' ? 'selected' : '' }}>Instrument error</option>
                                    <option value="Method error" {{ $data->Types_of_assignable == 'Method error' ? 'selected' : '' }}>Method error</option>
                                    <option value="Environment" {{ $data->Types_of_assignable == 'Environment' ? 'selected' : '' }}>Environment</option>
                                    <option value="Other" {{ $data->Types_of_assignable == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Others</label>
                                <textarea id="Types_of_assignable_others" name="Types_of_assignable_others" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Types_of_assignable_others }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Evaluation of Phase IB investigation Timeline</label>
                                <textarea id="Evaluation_Timeline" name="Evaluation_Timeline" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Evaluation_Timeline }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Is Phase IB investigation timeline met</label>
                                    <select name="timeline_met" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->timeline_met == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->timeline_met == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If No, Justify for timeline extension</label>
                                <textarea id="timeline_extension" name="timeline_extension" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->timeline_extension }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">CAPA applicable</label>
                                <textarea id="CAPA_applicable" name="CAPA_applicable" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->CAPA_applicable }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Resampling required</label>
                                    <select name="resampling_required_ib" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->resampling_required_ib == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->resampling_required_ib == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Repeat testing required </label>
                                    <select name="repeat_testing_ib" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->repeat_testing_ib == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->repeat_testing_ib == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Repeat testing plan</label>
                                <textarea id="Repeat_testing_plan" name="Repeat_testing_plan" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Repeat_testing_plan }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Phase II investigation required</label>
                                    <select name="phase_ii_inv_req_ib" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->phase_ii_inv_req_ib == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->phase_ii_inv_req_ib == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Production Person</label>
                                    <select name="production_person_ib" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'disabled' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->production_person_ib == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->production_person_ib == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned To">Production Person</label>
                                <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                    name="production_person_ib" placeholder="Select Reviewers" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 9 ? '' : 'readonly' }}>
                                    <option value="">-- Select --</option>
                                    @if (!empty(Helpers::getProductionDropdown()))
                                        @foreach (Helpers::getProductionDropdown() as $listPersone)
                                            <option value="{{ $listPersone['id'] }}"
                                                @if ($listPersone['id'] == $data->production_person_ib) selected @endif>
                                                {{ $listPersone['name'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Repeat analysis method/resampling</label>
                                <textarea id="Repeat_analysis_method" name="Repeat_analysis_method" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Repeat_analysis_method }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Details of repeat analysis</label>
                                <textarea id="Details_repeat_analysis" name="Details_repeat_analysis" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Details_repeat_analysis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Impact assessment</label>
                                <textarea id="Impact_assessment1" name="Impact_assessment1" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Impact_assessment1 }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Conclusion</label>
                                <textarea id="Conclusion1" name="Conclusion1" {{ $data->stage == 9 ? '' : 'readonly' }}>{{ $data->Conclusion1 }}</textarea>
                            </div>
                        </div>

                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>

            <div id="CCForm30" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA HOD Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="hod_remark2"
                                    class="form-control {{$errors->has('hod_remark2') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 6 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark2}}</textarea>
                                    @if($errors->has('hod_remark2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark2') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment2">

                                        @if ($data->hod_attachment2)
                                        @foreach ($data->hod_attachment2 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment2[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment2')" {{ $data->stage == 6 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm31" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA CQA/QA Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_remark2"
                                    class="form-control {{$errors->has('QA_Head_remark2') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 7 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark2}}</textarea>
                                    @if($errors->has('QA_Head_remark2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_remark2') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment2">

                                        @if ($data->QA_Head_attachment2)
                                        @foreach ($data->QA_Head_attachment2 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment2[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment2')" {{ $data->stage == 7 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm32" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA CQAH/QAH Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQAH/QAH Remark <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_primary_remark2"
                                    class="form-control {{$errors->has('QA_Head_primary_remark2') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 8 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark2}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark2') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Assignable cause found">Phase IA Assignable cause found</label>
                                <select name="assign_cause_found" id="assign_cause_found">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes" {{ $data->assign_cause_found == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->assign_cause_found == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA CQAH/QAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment2">

                                        @if ($data->QA_Head_primary_attachment2)
                                        @foreach ($data->QA_Head_primary_attachment2 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment2[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment2')" {{ $data->stage == 8 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm33" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB HOD Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="hod_remark3"
                                    class="form-control {{$errors->has('hod_remark3') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 10 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark3}}</textarea>
                                    @if($errors->has('hod_remark3'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark3') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment3">

                                        @if ($data->hod_attachment3)
                                        @foreach ($data->hod_attachment3 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment3[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment3')" {{ $data->stage == 10 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm34" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB CQA/QA Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_remark3"
                                    class="form-control {{$errors->has('QA_Head_remark3') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 11 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark3}}</textarea>
                                    @if($errors->has('QA_Head_remark3'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_remark3') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment3">

                                        @if ($data->QA_Head_attachment3)
                                        @foreach ($data->QA_Head_attachment3 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment3[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment3')" {{ $data->stage == 11 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm35" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB CQAH/QAH Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Escalation required</label>
                                <select id="escalation_required" name="escalation_required" {{ Helpers::isOOSChemical($data->stage) }} {{ $data->stage == 12 ? '' : 'readonly' }}>
                                    <option value="">--Select---</option>
                                    <option value="Yes" {{ $data->escalation_required == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->escalation_required == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 new-time-data-field" id="notification_field" style="display: none;">
                            <div class="group-input input-time">
                                <label for="If Others">If Yes, Notification</label>
                                <textarea id="notification_ib" name="notification_ib" {{ $data->stage == 12 ? '' : 'readonly' }}>{{ $data->notification_ib }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6 new-time-data-field" id="justification_field" style="display: none;">
                            <div class="group-input input-time">
                                <label for="If Others">If No, Justification</label>
                                <textarea id="justification_ib" name="justification_ib" {{ $data->stage == 12 ? '' : 'readonly' }}>{{ $data->justification_ib }}</textarea>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                // Function to show or hide the fields based on the selected value
                                function toggleFields() {
                                    var selectedValue = $('#escalation_required').val();

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
                                }

                                // On page load, toggle the fields based on the selected value
                                toggleFields();

                                // Event listener for the dropdown change event
                                $('#escalation_required').change(function() {
                                    toggleFields();
                                });
                            });
                        </script>



                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQAH/QAH Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_primary_remark3"
                                    class="form-control {{$errors->has('QA_Head_primary_remark3') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 12 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark3}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark3'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark3') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB CQAH/QAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment3">

                                        @if ($data->QA_Head_primary_attachment3)
                                        @foreach ($data->QA_Head_primary_attachment3 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment3[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment3')" {{ $data->stage == 12 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            @include('frontend.OOS.comps.phase_two_investigation')

            <div id="CCForm36" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase II A HOD Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="hod_remark4"
                                    class="form-control {{$errors->has('hod_remark4') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 14 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark4}}</textarea>
                                    @if($errors->has('hod_remark4'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark4') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment4">

                                        @if ($data->hod_attachment4)
                                        @foreach ($data->hod_attachment4 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment4[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment4')" {{ $data->stage == 14 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm37" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase II A CQA/QA Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_remark4"
                                    class="form-control {{$errors->has('QA_Head_remark4') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 15 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark4}}</textarea>
                                    @if($errors->has('QA_Head_remark4'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_remark4') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment4">

                                        @if ($data->QA_Head_attachment4)
                                        @foreach ($data->QA_Head_attachment4 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment4[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment4')" {{ $data->stage == 15 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm38" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase II A QAH/CQAH Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A QAH/CQAH Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_primary_remark4"
                                    class="form-control {{$errors->has('QA_Head_primary_remark4') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 16 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark4}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark4'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark4') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A QAH/CQAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment4">

                                        @if ($data->QA_Head_primary_attachment4)
                                        @foreach ($data->QA_Head_primary_attachment4 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment4[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment4')" {{ $data->stage == 16 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm43" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IIB Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Summary Of Investigation<span class="text-danger">*</span></label>
                                <textarea id="Summary_Of_Inv_IIB" name="Summary_Of_Inv_IIB" {{ $data->stage == 17 ? 'required' : 'readonly' }}>{{ $data->Summary_Of_Inv_IIB }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">CAPA Required</label>
                                <select name="capa_required_IIB"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 17 ? '' : 'readonly' }}>
                                    <option value="" {{ $data->capa_required_IIB == '0' ? 'selected' : ''
                                        }}>--Select---</option>
                                    <option value="yes" {{ $data->capa_required_IIB == 'yes' ? 'selected' : ''
                                        }}>Yes</option>
                                    <option value="no" {{ $data->capa_required_IIB == 'no' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Agenda">Reference CAPA No.</label>
                                <input  {{Helpers::isOOSChemical($data->stage)}} type="text" value="{{$data->reference_capa_IIB}}" name="reference_capa_IIB" {{ $data->stage == 17 ? '' : 'readonly' }}>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Attachments">Resampling required IIB Inv.</label>
                                <select name="resampling_req_IIB" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 17 ? '' : 'readonly' }}>
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes" {{ $data->resampling_req_IIB === 'Yes' ? 'selected' :
                                            '' }}>Yes</option>
                                    <option value="No" {{ $data->resampling_req_IIB === 'No' ? 'selected' : ''
                                            }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">Repeat testing required IIB Inv.</label>
                                <select name="Repeat_testing_IIB" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 17 ? '' : 'readonly' }}>
                                   <option value="" {{ $data->Repeat_testing_IIB == '0' ? 'selected' : ''
                                        }}>Enter Your Selection Here</option>
                                    <option value="yes" {{ $data->Repeat_testing_IIB == 'yes' ?
                                        'selected' : '' }}>Yes</option>
                                    <option value="no" {{ $data->Repeat_testing_IIB == 'no' ?
                                        'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Results Of Repeat testing IIB Inv.</label>
                                <textarea id="result_of_rep_test_IIB" name="result_of_rep_test_IIB" {{ $data->stage == 17 ? '' : 'readonly' }}>{{ $data->result_of_rep_test_IIB }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Laboratory Investigation Hypothesis details<span class="text-danger">*</span></label>
                                <textarea id="Laboratory_Investigation_Hypothesis" name="Laboratory_Investigation_Hypothesis" {{ $data->stage == 17 ? 'required' : 'readonly' }}>{{ $data->Laboratory_Investigation_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Outcome of Laboratory Investigation</label>
                                <textarea id="Outcome_of_Laboratory" name="Outcome_of_Laboratory" {{ $data->stage == 17 ? '' : 'readonly' }}>{{ $data->Outcome_of_Laboratory }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Evaluation</label>
                                <textarea id="Evaluation_IIB" name="Evaluation_IIB" {{ $data->stage == 17 ? '' : 'readonly' }}>{{ $data->Evaluation_IIB }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Assignable Cause</label>
                                    <select name="Assignable_Cause111" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 17 ? '' : 'readonly' }}>
                                    <option value="" >--Select---</option>
                                    <option value="Found" {{ $data->Assignable_Cause111 == 'Found' ? 'selected' : '' }}>Found</option>
                                    <option value="Not Found" {{ $data->Assignable_Cause111 == 'Not Found' ? 'selected' : '' }}>Not Found</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If assignable cause identified perform re-testing</label>
                                <textarea id="If_assignable_cause" name="If_assignable_cause" {{ $data->stage == 17 ? '' : 'readonly' }}>{{ $data->If_assignable_cause }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If assignable error is not identified proceed as per Phase III investigation</label>
                                <textarea id="If_assignable_error" name="If_assignable_error" {{ $data->stage == 17 ? '' : 'readonly' }}>{{ $data->If_assignable_error }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IIB inv. Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="phase_IIB_attachment">

                                        @if ($data->phase_IIB_attachment)
                                        @foreach ($data->phase_IIB_attachment as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="phase_IIB_attachment[]"
                                            oninput="addMultipleFiles(this, 'phase_IIB_attachment')" {{ $data->stage == 15 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm39" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase II B HOD Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B HOD Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="hod_remark5"
                                    class="form-control {{$errors->has('hod_remark5') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 18 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark5}}</textarea>
                                    @if($errors->has('hod_remark5'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark5') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment5">

                                        @if ($data->hod_attachment5)
                                        @foreach ($data->hod_attachment5 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment5[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment5')" {{ $data->stage == 18 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm40" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase II B CQA/QA Review
                    </div>
                    <div class="row">
                         <!-- Others Field -->

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea
                                    name="QA_Head_remark5"
                                    class="form-control {{$errors->has('QA_Head_remark5') ? 'is-invalid' : ''}}"
                                    {{ $data->stage == 19 ? 'required' : 'readonly' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark5}}</textarea>
                                    @if($errors->has('QA_Head_remark5'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_remark5') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B CQA/QA Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_attachment5">

                                        @if ($data->QA_Head_attachment5)
                                        @foreach ($data->QA_Head_attachment5 as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                    class="fa fa-eye text-primary"
                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        </h6>
                                        @endforeach
                                        @endif

                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="QA_Head_attachment5[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment5')" {{ $data->stage == 19 ? '' : 'readonly' }} multiple>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)

                            @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            @endif
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>

            @include('frontend.OOS.comps.under_approval')

            @include('frontend.OOS.comps.additional_testing')

            @include('frontend.OOS.comps.oos_conclusion')

            @include('frontend.OOS.comps.signature')






            <!-- Phase IA Investigation -->
            {{-- @include('frontend.OOS.comps.preliminary') --}}

            <!-- CheckList - Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary_checklist')

            <!-- Preliminary Lab Inv. Conclusion -->
            @include('frontend.OOS.comps.preliminary_lab_conclusion')

            <!-- Preliminary Lab Invst. Review--->
            @include('frontend.OOS.comps.preliminary_lab_investigation')
             <!-- All CheckList-->
            @include('frontend.OOS.comps.all_checklist_Investigation_bsmmem')

            <!--Phase II Investigation -->
            {{-- @include('frontend.OOS.comps.phase_two_investigation') --}}

            <!--CheckList Phase II Investigation -->
            @include('frontend.OOS.comps.checklist_phase_two')

            <!-- Phase II QC Review -->
            @include('frontend.OOS.comps.phase_two_qc')

            <!--Additional Testing Proposal  -->
            {{-- @include('frontend.OOS.comps.additional_testing') --}}

            <!--OOS Conclusion  -->
            {{-- @include('frontend.OOS.comps.oos_conclusion') --}}

            <!--OOS Conclusion Review -->
            @include('frontend.OOS.comps.oos_conclusion_review')

            <!--CQ Review Comments -->
            @include('frontend.OOS.comps.oos_cq_review')

            <!-- Batch Disposition -->
            {{-- @include('frontend.OOS.comps.batch_disposition') --}}

            <!-- Re-Open -->
           {{--  @include('frontend.OOS.comps.oos_reopen')  --}}

            <!-- Under Addendum Approval -->
            {{-- @include('frontend.OOS.comps.under_approval') --}}

            {{-- @include('frontend.OOS.comps.oos_extension')  --}}

            <!--Under Addendum Execution -->
            {{-- @include('frontend.OOS.comps.under_execution') --}}

            <!-- Under Addendum Review-->
            {{--  @include('frontend.OOS.comps.under_review') --}}

            <!-- Under Addendum Verification -->
            {{-- @include('frontend.OOS.comps.under_verification')  --}}

            <!----- Signature ----->
            {{-- @include('frontend.OOS.comps.signature') --}}

         </div>


        </div>
        </form>

    </div>
    </div>

    <!-- Extention Model -->

    <!-- close extention model -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        if (selectedOptions.includes('RM-PM')) {
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
    @if(Session::has('swal'))
        Swal.fire({
            title: '{{ Session::get('swal.title') }}',
            text: '{{ Session::get('swal.message') }}',
            icon: '{{ Session::get('swal.type') }}',  // Type can be success, warning, error
            confirmButtonText: 'OK',
            width: '300px',
            height: '200px',
            size: '50px',
        });
    @endif
</script>
<style>
    .swal2-title {
        font-size: 18px;  /* Customize title font size */
    }
    .swal2-html-container {
        font-size: 14px;  /* Customize content text font size */
    }
    .swal2-confirm {
        font-size: 14px;  /* Customize confirm button font size */
    }
</style>

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
        VirtualSelect.init({
            ele: '#reference_record, #notify_to ,#action_plan_ref_oosc, #capa_ref_no_oosc '
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
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
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
@endsection
