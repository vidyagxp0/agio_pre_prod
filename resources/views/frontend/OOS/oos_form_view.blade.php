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
    <script>
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
                        '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_mfg_date_' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_expiry_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_expiry_date' + serialNumber + '\')">' +
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
                                '<input type="date" name="products_details[' + serialNumber + '][sampled_on]" value="" class="hide-input" oninput="handleDateInput(this, \'sampled_on' + serialNumber + '\')">' +
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
                                '<input type="date" name="products_details[' + serialNumber + '][analyzed_on]" value="" class="hide-input" oninput="handleDateInput(this, \'analyzed_on' + serialNumber + '\')">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="observed_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="products_details[' + serialNumber + '][observed_on]" value="" class="hide-input" oninput="handleDateInput(this, \'observed_on' + serialNumber + '\')">' +
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
                                '<input type="date" name="products_details[' + serialNumber + '][calibrated_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibrated_on' + serialNumber + '\')">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="col-lg-6 new-date-data-field">' +
                                '<div class="group-input input-date">' +
                                '<div class="calenderauditee">' +
                                '<input type="text" readonly id="calibratedduedate_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                                '<input type="date" name="products_details[' + serialNumber + '][calibratedduedate_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibratedduedate_on' + serialNumber + '\')">' +
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
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_number]" value=""></td>' +
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
                            '<input type="date" name="oos_capa[' + serialNumber + '][info_oos_closure_date]" value="" class="hide-input" oninput="handleDateInput(this, \'info_oos_closure_date' + serialNumber + '\')">' +
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
            {{ Helpers::getDivisionName(session()->get('division')) }} / OOS Chemical
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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm27')">HOD Primary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm28')">CQA/QA Head </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm29')">CQA/QA Head Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Phase IA Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm30')">Phase IA HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm31')">Phase IA CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm32')">P-IA CQAH/QAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase-IB Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm35')">P-IB CQAH/QAH</button>
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase IIA Investigation</button> 
                <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm38')">P-II A QAH/CQAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm44')">Phase-II B Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm41')">P-II B QAH/CQAH</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm19')">CheckList - Phase II Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QA Review</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button> --}}
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">QA Head/Designee Approval</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Extension</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
               
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
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remark</label>
                                <input type="text" name="hod_remark1" value="{{ $data->hod_remark1 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        {{-- <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment1">
            
                                        @if ($data->hod_attachment1)
                                        @foreach ($data->hod_attachment1 as $file)
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
                                        <input type="file" id="myfile" name="hod_attachment1[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">HOD Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="hod_attachment1">
                                        @if (is_array($data->hod_attachment1))
                                            @foreach ($data->hod_attachment1 as $file)
                                                @if (is_string($file)) <!-- Ensure $file is a string -->
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ htmlspecialchars($file, ENT_QUOTES, 'UTF-8') }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name="{{ htmlspecialchars($file, ENT_QUOTES, 'UTF-8') }}"><i
                                                                class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="hod_attachment1[]"
                                            oninput="addMultipleFiles(this, 'hod_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm28" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark</label>
                                <input type="text" name="QA_Head_remark1" value="{{ $data->QA_Head_remark1 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm29" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark</label>
                                <input type="text" name="QA_Head_primary_remark1" value="{{ $data->QA_Head_primary_remark1 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm30" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Primary Remark</label>
                                <input type="text" name="hod_remark2" value="{{ $data->hod_remark2 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA HOD Primary Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'hod_attachment2')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm31" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark2" value="{{ $data->QA_Head_remark2 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment2')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm32" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-IA CQAH/QAH Primary Remark</label>
                                <input type="text" name="QA_Head_primary_remark2" value="{{ $data->QA_Head_primary_remark2 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-IA CQAH/QAH Primary Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment2')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm33" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Primary Remark</label>
                                <input type="text" name="hod_remark3" value="{{ $data->hod_remark3 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB HOD Primary Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'hod_attachment3')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm34" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark3" value="{{ $data->QA_Head_remark3 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment3')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm35" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB CQAH/QAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark3" value="{{ $data->QA_Head_primary_remark3 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-IB CQAH/QAH Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment3')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm36" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Primary Remark</label>
                                <input type="text" name="hod_remark4" value="{{ $data->hod_remark4 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A HOD Primary Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'hod_attachment4')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm37" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark4" value="{{ $data->QA_Head_remark4 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment4')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm38" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-II A QAH/CQAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark4" value="{{ $data->QA_Head_primary_remark4 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-II A QAH/CQAH Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment4')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm39" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B HOD Primary Remark</label>
                                <input type="text" name="hod_remark5" value="{{ $data->hod_remark5 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B HOD Primary Attachment</label>
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
                                            oninput="addMultipleFiles(this, 'hod_attachment5')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm40" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B CQA/QA Remark</label>
                                <input type="text" name="QA_Head_remark5" value="{{ $data->QA_Head_remark5 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment5')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div id="CCForm41" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-II A QAH/CQAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark5" value="{{ $data->QA_Head_primary_remark5 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div>
                       
            
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-II A QAH/CQAH Attachment</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="QA_Head_primary_attachment5">
            
                                        @if ($data->QA_Head_primary_attachment5)
                                        @foreach ($data->QA_Head_primary_attachment5 as $file)
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
                                        <input type="file" id="myfile" name="QA_Head_primary_attachment5[]"
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment5')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 15)
                        <div class="progress-bars">
                                <div class="bg-danger">Workflow is already Closed-Done</div>
                            </div>
                        @else
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        @endif
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                        </div>
                    </div>
                </div>
            
            </div>

            <!-- Phase IA Investigation -->
            @include('frontend.OOS.comps.preliminary')

            <!-- CheckList - Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary_checklist')

            <!-- Preliminary Lab Inv. Conclusion -->
            @include('frontend.OOS.comps.preliminary_lab_conclusion')

            <!-- Preliminary Lab Invst. Review--->
            @include('frontend.OOS.comps.preliminary_lab_investigation')
             <!-- All CheckList-->
            @include('frontend.OOS.comps.all_checklist_Investigation_bsmmem')

            <!--Phase II Investigation -->
            @include('frontend.OOS.comps.phase_two_investigation')

            <!--CheckList Phase II Investigation -->
            @include('frontend.OOS.comps.checklist_phase_two')

            <!-- Phase II QC Review -->
            @include('frontend.OOS.comps.phase_two_qc')    

            <!--Additional Testing Proposal  -->
            @include('frontend.OOS.comps.additional_testing')

            <!--OOS Conclusion  -->
            @include('frontend.OOS.comps.oos_conclusion')

            <!--OOS Conclusion Review -->
            @include('frontend.OOS.comps.oos_conclusion_review')

            <!--CQ Review Comments -->
            @include('frontend.OOS.comps.oos_cq_review')

            <!-- Batch Disposition -->
            {{-- @include('frontend.OOS.comps.batch_disposition') --}}

            <!-- Re-Open -->
           {{--  @include('frontend.OOS.comps.oos_reopen')  --}}  

            <!-- Under Addendum Approval -->
            @include('frontend.OOS.comps.under_approval')
            
            {{-- @include('frontend.OOS.comps.oos_extension')  --}}

            <!--Under Addendum Execution -->
            {{-- @include('frontend.OOS.comps.under_execution') --}}

            <!-- Under Addendum Review-->
            {{--  @include('frontend.OOS.comps.under_review') --}}

            <!-- Under Addendum Verification -->
            {{-- @include('frontend.OOS.comps.under_verification')  --}}   

            <!----- Signature ----->
            @include('frontend.OOS.comps.signature')

         </div>


        </div>
        </form>

    </div>
    </div>

    <!-- Extention Model -->

    <!-- close extention model -->
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
