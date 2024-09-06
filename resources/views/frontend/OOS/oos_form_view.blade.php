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
                <button class="cctablinks" onclick="openCity(event, 'CCForm32')">Phase IA CQAH/QAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm42')">Phase IB Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm33')">Phase IB HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm34')">Phase IB CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm35')"> Phase IB CQAH/QAH</button>
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm41')">Phase II B QAH/CQAH</button>
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
                         {{-- <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remark</label>
                                
                                <input type="text" name="hod_remark1" value="{{ $data->hod_remark1 ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                            </div>
                        </div> --}}
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remarks <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="hod_remark1" 
                                    class="form-control {{$errors->has('hod_remark1') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 2 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark1}}</textarea>
                                    @if($errors->has('hod_remark1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark1') }}
                                    </div>
                                @endif
                            </div>
                        </div>
            
                        <div class="col-12">
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
                        </div>
                        
                        
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                        
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Remark <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_remark1" 
                                    class="form-control {{$errors->has('QA_Head_remark1') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 3 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark1}}</textarea>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                        
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Primary Remark <span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_primary_remark1" 
                                    class="form-control {{$errors->has('QA_Head_primary_remark1') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 4 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark1}}</textarea>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_primary_attachment1')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                        
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Primary Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="hod_remark2" 
                                    class="form-control {{$errors->has('hod_remark2') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 6 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark2}}</textarea>
                                    @if($errors->has('hod_remark2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark2') }}
                                    </div>
                                @endif
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                        
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_remark2" 
                                    class="form-control {{$errors->has('QA_Head_remark2') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 7 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark2}}</textarea>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment2')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                       
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">P-IA CQAH/QAH Primary Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_primary_remark2" 
                                    class="form-control {{$errors->has('QA_Head_primary_remark2') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 8 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark2}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark2') }}
                                    </div>
                                @endif
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                         
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Primary Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="hod_remark3" 
                                    class="form-control {{$errors->has('hod_remark3') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 10 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark3}}</textarea>
                                    @if($errors->has('hod_remark3'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark3') }}
                                    </div>
                                @endif
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                        
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB CQA/QA Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_remark3" 
                                    class="form-control {{$errors->has('QA_Head_remark3') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 11 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_remark3}}</textarea>
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
                                            oninput="addMultipleFiles(this, 'QA_Head_attachment3')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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

                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB CQAH/QAH Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="QA_Head_primary_remark3" 
                                    class="form-control {{$errors->has('QA_Head_primary_remark3') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 12 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->QA_Head_primary_remark3}}</textarea>
                                    @if($errors->has('QA_Head_primary_remark3'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('QA_Head_primary_remark3') }}
                                    </div>
                                @endif
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                         
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Primary Remark<span class="text-danger">*</span></label>
                                <div>
                                    <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                </div>
                                <textarea 
                                    name="hod_remark4" 
                                    class="form-control {{$errors->has('hod_remark4') ? 'is-invalid' : ''}}" 
                                    {{ $data->stage == 14 ? 'required' : '' }} {{Helpers::isOOSChemical($data->stage)}}>{{$data->hod_remark4}}</textarea>
                                    @if($errors->has('hod_remark4'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hod_remark4') }}
                                    </div>
                                @endif
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
            <div id="CCForm42" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IB Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Outcome of Phase IA investigation</label>
                                <textarea id="outcome_phase_IA" name="outcome_phase_IA">{{ $data->outcome_phase_IA }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Reason for proceeding to Phase IB investigation</label>
                                <textarea id="reason_for_proceeding" name="reason_for_proceeding">{{ $data->reason_for_proceeding }}</textarea>
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
                                <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION REPORT</label>
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
                                                                <select name="checklist_IB_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;"  {{Helpers::isOOSChemical($data->stage)}}>
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="No" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                                    <option value="N/A" {{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                                <textarea name="checklist_IB_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;"  {{Helpers::isOOSChemical($data->stage)}}>{{ Helpers::getArrayKey($checklist_IB_invs->data[$loop->index], 'remark') }}</textarea>
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
                                <textarea id="summaryy_of_review" name="summaryy_of_review">{{ $data->summaryy_of_review }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Probable Cause Identification</label>
                                <textarea id="Probable_cause_iden" name="Probable_cause_iden">{{ $data->Probable_cause_iden }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Proposal for Phase IB hypothesis</label>
                                    <select name="proposal_for_hypothesis_IB" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Re-injection of the original vial" {{ $data->proposal_for_hypothesis_IB == 'Re-injection of the original vial' ? 'selected' : '' }}>Re-injection of the original vial</option>
                                    <option value="Re-filtration and Injection from final dilution" {{ $data->proposal_for_hypothesis_IB == 'Re-filtration and Injection from final dilution' ? 'selected' : '' }}>Re-filtration and Injection from final dilution</option>
                                    <option value="Re-dilution from the tock solution and injection" {{ $data->proposal_for_hypothesis_IB == 'Re-dilution from the tock solution and injection' ? 'selected' : '' }}>Re-dilution from the tock solution and injection</option>
                                    <option value="Re-sonication / re-shaking due to probable incomplete solubility and analyze" {{ $data->proposal_for_hypothesis_IB == 'Re-sonication / re-shaking due to probable incomplete solubility and analyze' ? 'selected' : '' }}>Re-sonication / re-shaking due to probable incomplete solubility and analyze</option>
                                    <option value="Other" {{ $data->proposal_for_hypothesis_IB == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Others</label>
                                <textarea id="proposal_for_hypothesis_others" name="proposal_for_hypothesis_others">{{ $data->proposal_for_hypothesis_others }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Details of results (Including original OOS results for side by side comparison)</label>
                                <textarea id="details_of_result" name="details_of_result">{{ $data->details_of_result }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Probable Cause Identified in Phase IB investigation</label>
                                    <select name="Probable_Cause_Identified" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->Probable_Cause_Identified == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->Probable_Cause_Identified == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Any other Comments/ Probable Cause Evidence</label>
                                <textarea id="Any_other_Comments" name="Any_other_Comments">{{ $data->Any_other_Comments }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Proposal for Hypothesis testing to confirm Probable Cause identified</label>
                                <textarea id="Proposal_for_Hypothesis" name="Proposal_for_Hypothesis">{{ $data->Proposal_for_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Summary of Hypothesis</label>
                                <textarea id="Summary_of_Hypothesis" name="Summary_of_Hypothesis">{{ $data->Summary_of_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Assignable Cause</label>
                                    <select name="Assignable_Cause" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Found" {{ $data->Assignable_Cause == 'Found' ? 'selected' : '' }}>Found</option>
                                    <option value="Not Found" {{ $data->Assignable_Cause == 'Not Found' ? 'selected' : '' }}>Not Found</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Types of assignable cause</label>
                                    <select name="Types_of_assignable" {{Helpers::isOOSChemical($data->stage)}}>
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
                                <textarea id="Types_of_assignable_others" name="Types_of_assignable_others">{{ $data->Types_of_assignable_others }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Evaluation of Phase IB investigation Timeline</label>
                                <textarea id="Evaluation_Timeline" name="Evaluation_Timeline">{{ $data->Evaluation_Timeline }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Is Phase IB investigation timeline met</label>
                                    <select name="timeline_met" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->timeline_met == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->timeline_met == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If No, Justify for timeline extension</label>
                                <textarea id="timeline_extension" name="timeline_extension">{{ $data->timeline_extension }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">CAPA applicable</label>
                                    <select name="CAPA_applicable" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Yes" {{ $data->CAPA_applicable == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $data->CAPA_applicable == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Repeat testing plan</label>
                                <textarea id="Repeat_testing_plan" name="Repeat_testing_plan">{{ $data->Repeat_testing_plan }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Repeat analysis method/resampling</label>
                                <textarea id="Repeat_analysis_method" name="Repeat_analysis_method">{{ $data->Repeat_analysis_method }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Details of repeat analysis</label>
                                <textarea id="Details_repeat_analysis" name="Details_repeat_analysis">{{ $data->Details_repeat_analysis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Impact assessment</label>
                                <textarea id="Impact_assessment1" name="Impact_assessment1">{{ $data->Impact_assessment1 }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Conclusion</label>
                                <textarea id="Conclusion1" name="Conclusion1">{{ $data->Conclusion1 }}</textarea>
                            </div>
                        </div>

                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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

            <div id="CCForm43" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Phase IA Investigation
                    </div>
                    <div class="row">
                         <!-- Others Field -->
                         <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Laboratory Investigation Hypothesis details</label>
                                <textarea id="Laboratory_Investigation_Hypothesis" name="Laboratory_Investigation_Hypothesis">{{ $data->Laboratory_Investigation_Hypothesis }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Outcome of Laboratory Investigation</label>
                                <textarea id="Outcome_of_Laboratory" name="Outcome_of_Laboratory">{{ $data->Outcome_of_Laboratory }}</textarea>
                            </div>
                        </div>
            
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">Evaluation</label>
                                <textarea id="Evaluation_IIB" name="Evaluation_IIB">{{ $data->Evaluation_IIB }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time">
                                <label for="If Others">Assignable Cause</label>
                                    <select name="Assignable_Cause111" {{Helpers::isOOSChemical($data->stage)}}>
                                    <option value="" >--Select---</option>
                                    <option value="Found" {{ $data->Assignable_Cause111 == 'Found' ? 'selected' : '' }}>Found</option>
                                    <option value="Not Found" {{ $data->Assignable_Cause111 == 'Not Found' ? 'selected' : '' }}>Not Found</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If assignable cause identified perform re-testing</label>
                                <textarea id="If_assignable_cause" name="If_assignable_cause">{{ $data->If_assignable_cause }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 new-time-data-field">
                            <div class="group-input input-time ">
                                <label for="If Others">If assignable error is not identified proceed as per Phase III investigation</label>
                                <textarea id="If_assignable_error" name="If_assignable_error">{{ $data->If_assignable_error }}</textarea>
                            </div>
                        </div>
            
                        <div class="button-block">
                            
                        @if ($data->stage == 0  || $data->stage >= 25)
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
