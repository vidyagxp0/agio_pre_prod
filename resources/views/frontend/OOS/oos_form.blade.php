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
    <!-- ------------------------------grid-5 instrument_detail-------------------------script -->
    <script>
        $(document).ready(function() {
            $('#instrument_detail').click(function(e) {
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
                        '<td><input disabled type="text" name="oos_capa['+ serialNumber +'][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="number" name="oos_capa['+ serialNumber +'][info_oos_number]" value=""></td>' +
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
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }}/ OOS Chemical
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm35')">Phase IB CQAH/QAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II A Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm36')">Phase II A HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm37')">Phase II A CQA/QA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm38')">Phase II A QAH/CQAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm43')">Phase II B Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm39')">Phase II B HOD Primary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm40')">Phase II B CQA/QA</button>
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Phase II B QAH/CQAH</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button> --}}
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button> -->
                
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Extension</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Activity Log</button>
                
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
                                <label for="Initiator Group">Type </label>
                                <select id="dynamicSelectType" name="type">
                                    <option value="{{ route('oos.index') }}">OOS Chemical</option>
                                    <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                                    <option value="{{ route('oot.index')  }}">OOT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Record Number"> Record Number </label>
                                {{-- <input disabled type="text" name="record_number"
                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/OOS Chemical/{{ date('Y') }}/{{ $record_number }}"> --}}
                             <input type="hidden" name="record" value="{{ $record_number }}">
                                    <input disabled type="text" name="record"
                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/OOS Chemical/{{ date('Y') }}/{{ $record_number }}">
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label disabled for="Division Code">Division Code<span class="text-danger"></span></label>
                                <input disabled type="text" name="division_code"
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
                        
                       
                       {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description"> Severity Level</label>
                                <select name="severity_level_gi" >
                                    <option value="">Enter Your Selection Here</option>
                                    <option  value="Major">Major</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>
                        </div>--}} 
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
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description">Initiation department Group  <span class="text-danger"></span></label>
                                
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
                                        <option value="AL" >Analytical research and Development Laboratory</option>
                                        <option value="PD">Packaging Development</option>
                                        <option value="PU">Purchase Department</option>
                                        <option value="DC">Document Cell</option>
                                        <option value="RA">Regulatory Affairs</option>
                                        <option value="PV">Pharmacovigilance</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code">Initiation department Code <span class="text-danger"></span></label>
                                <input type="text" name="initiator_group_code" id="initiator_group_code" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="If Others">If Others
                                    <span class="text-danger">*</span></label>
                                <textarea id="docname"  name="if_others_gi" ></textarea>
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
                                <select name="source_document_type_gi">
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
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference System Document</label>
                                <input type="text" name="reference_system_document_gi"  id="reference_system_document_gi" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Document">Reference document</label>
                                <input type="text" name="reference_document"  id="reference_document" value="">
                            </div>
                        </div>
                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="due-date">OOS occurred On</label>
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
                                <label for="OOS Observed On">OOS Observed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="oos_observed_on" readonly placeholder="DD-MMM-YYYY" />
                                    {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                    <input type="date" name="oos_observed_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
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
                                <label for="Audit Schedule End Date">OOS Reported on</label>
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
                            
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="immediate_action">Immediate action</label>
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
                        <div class="sub-head pt-3">OOS Information</div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Sample Type</label>
                                <select name="sample_type_gi">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Raw Material">Raw Material</option>
                                    <option value="Packing Material">Packing Material</option>
                                    <option value="Finished Product">Finished Product</option>
                                    <option value="Satbility Sample">Satbility Sample</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
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

                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
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
                                                    </div>
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
                                                    </div>
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
                                Details of Stability Study
                                <button type="button" name="audit-agenda-grid" id="details_stability">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
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
                                            <th style="width: 16%">Pack Details (if any)</th>
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
                            <label for="audit-agenda-grid">
                                OOS Details
                                <button type="button" name="audit-agenda-grid" id="oos_details">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="oos_details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number.</th>
                                            <th style="width: 8%">Test Name of OOS</th>
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
                                            <td><input type="file" name="oos_detail[0][oos_file_attachment]"></td>
                                            <td><input type="text" name="oos_detail[0][oos_submit_by]"></td>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="oos_submit_on" readonly 
                                                        placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="oos_detail[0][oos_submit_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
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
                            Products details
                                <button type="button" name="audit-agenda-grid" id="products_details">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
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
                                                        <input type="date" name="products_details[0][sampled_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
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
                                                        <input type="date" name="products_details[0][analyzed_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'analyzed_on')">
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="observed_on" readonly placeholder="DD-MM-YYYY" />
                                                        <input type="date" name="products_details[0][observed_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
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
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
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
                                                            <input type="date" name="products_details[0][calibrated_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
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
                                                            <input type="date" name="products_details[0][calibratedduedate_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
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
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Checklist</label>
                                <select id="dynamicSelectType" name="type">
                                    <option value="">Enter Your Checklist Here</option>
                                    <option value="{{ route('oos.index') }}">CheckList - Preliminary Lab. Investigation</option>
                                    <option value="{{ route('oos_micro.index') }}">Checklist - Investigation of Chemical assay</option>
                                    <option value="{{ route('oot.index')  }}">Checklist - Residual solvent (RS)</option>
                                    <option value="{{ route('oot.index')  }}">Checklist - Dissolution </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date"> Comments </label>
                                <div class="col-md-12 4">
                                    <div class="group-input">
                                        <!-- <label for="Description Deviation">Description of Deviation</label> -->
                                        <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                        <textarea class="summernote" name="Comments_plidata" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Justify Field Alert</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="justify_if_no_field_alert_pli" id="summernote-1">
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
                        

                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date">Justify Analyst Int. </label>
                                    <textarea class="summernote" name="justify_if_no_analyst_int_pli" id="summernote-1">
                                    </textarea>

                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">Phase I Investigation</label>
                                <select name="phase_i_investigation_pli">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Phase I Micro">Phase I Micro</option>
                                    <option value="Phase I Chemical">Phase I Chemical</option>
                                    <option value="Hypothesis">Hypothesis</option>
                                    <option value="Resampling">Resampling</option>
                                    <option value="Others">Others</option>
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
                                    <div class="file-attachment-list" id="file_attachments_pli"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachments_pli[]"
                                            oninput="addMultipleFiles(this, 'file_attachments_pli')" multiple>
                                    </div>
                                </div>
                               

                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Summary of Preliminary Investigation.</label>
                                <textarea class="summernote" name="summary_of_prelim_investiga_plic" id="summernote-1"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Auditor">Root Cause Identified</label>
                                <select id="assignableSelect1" name="root_cause_identified_plic">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6" id="rootCauseGroup1" style="display: none;">
                            <div class="group-input">
                                <label for="RootCause">Comments<span class="text-danger">*</span></label>
                                <textarea name="root_comment" id="rootCauseTextarea" rows="4" placeholder="Describe the root cause here"></textarea>
                            </div>
                        </div>
                        
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
                                <label for="Audit Team"> OOS Category-Root Cause Ident.</label>
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
                                <label for="Description Deviation">OOS Category (Others)</label>
                               <textarea class="summernote" name="oos_category_others_plic" id="summernote-1">
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">OOS Category (Others)</label>
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
                        <div class="col-lg-12">
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">HOD Remark</label>
                                <input type="text" name="hod_remark1" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">HOD Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">CQA/QA Head Primary Remark</label>
                                <input type="text" name="QA_Head_primary_remark1" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">CQA/QA Head Primary Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IA HOD Primary Remark</label>
                                <input type="text" name="hod_remark2" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IA HOD Primary Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-IA CQAH/QAH Primary Remark</label>
                                <input type="text" name="QA_Head_primary_remark2" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-IA CQAH/QAH Primary Attachment</label>
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
                                <label for="If Others">Outcome of Phase IA investigation</label>
                                <textarea id="outcome_phase_IA"  name="outcome_phase_IA" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Reason for proceeding to Phase IB investigation</label>
                                <textarea id="reason_for_proceeding"  name="reason_for_proceeding" ></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                           
                                <label style="font-weight: bold; for="Audit Attachments">Phase IB investigation checklist</label>
                            
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
                                <label for="If Others">Summary of Review</label>
                                <textarea id="summaryy_of_review"  name="summaryy_of_review" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Probable Cause Identification</label>
                                <textarea id="Probable_cause_iden"  name="Probable_cause_iden" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Proposal for Phase IB hypothesis</label>
                                <select id="proposal_for_hypothesis_IB" name="proposal_for_hypothesis_IB">
                                    <option value="">--Select---</option>
                                    <option value="Re-injection of the original vial">Re-injection of the original vial</option>
                                    <option value="Re-filtration and Injection from final dilution">Re-filtration and Injection from final dilution</option>
                                    <option value="Re-dilution from the tock solution and injection">Re-dilution from the tock solution and injection</option>
                                    <option value="Re-sonication / re-shaking due to probable incomplete solubility and analyze">Re-sonication / re-shaking due to probable incomplete solubility and analyze</option>
                                    <option value="Other">Other</option>
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
                                <label for="If Others">Details of results (Including original OOS results for side by side comparison)</label>
                                <textarea id="details_of_result"  name="details_of_result" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Probable Cause Identified in Phase IB investigation</label>
                                <select id="Probable_Cause_Identified" name="Probable_Cause_Identified">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Any other Comments/ Probable Cause Evidence</label>
                                <textarea id="Any_other_Comments"  name="Any_other_Comments" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Proposal for Hypothesis testing to confirm Probable Cause identified</label>
                                <textarea id="Proposal_for_Hypothesis"  name="Proposal_for_Hypothesis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Summary of Hypothesis</label>
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
                                <label for="If Others">Types of assignable cause</label>
                                <select id="Types_of_assignable" name="Types_of_assignable">
                                    <option value="">--Select---</option>
                                    <option value="Analyst error">Analyst error</option>
                                    <option value="Instrument error">Instrument error</option>
                                    <option value="Method error">Method error</option>
                                    <option value="Environment">Environment</option>
                                    <option value="Other">Other</option>
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
                                <label for="If Others">Is Phase IB investigation timeline met</label>
                                <select id="timeline_met" name="timeline_met">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If No, Justify for timeline extension</label>
                                <textarea id="timeline_extension"  name="timeline_extension" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">CAPA applicable</label>
                                <select id="CAPA_applicable" name="CAPA_applicable">
                                    <option value="">--Select---</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Repeat testing plan</label>
                                <textarea id="Repeat_testing_plan"  name="Repeat_testing_plan" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Repeat analysis method/resampling</label>
                                <textarea id="Repeat_analysis_method"  name="Repeat_analysis_method" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Details of repeat analysis</label>
                                <textarea id="Details_repeat_analysis"  name="Details_repeat_analysis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Impact assessment</label>
                                <textarea id="Impact_assessment1"  name="Impact_assessment1" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Conclusion</label>
                                <textarea id="Conclusion1"  name="Conclusion1" ></textarea>
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
                                <label for="If Others">Laboratory Investigation Hypothesis details</label>
                                <textarea id="Laboratory_Investigation_Hypothesis"  name="Laboratory_Investigation_Hypothesis" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">Outcome of Laboratory Investigation</label>
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
                                <label for="If Others">If assignable cause identified perform re-testing</label>
                                <textarea id="If_assignable_cause"  name="If_assignable_cause" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If assignable error is not identified proceed as per Phase III investigation</label>
                                <textarea id="If_assignable_error"  name="If_assignable_error" ></textarea>
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
            <div id="CCForm44" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">pH meter</div>
                    <div class="row">
                                    @php
                                    $IIB_inv_questions = array(
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

                                                <div class="sub-head">Viscometer</div>
                                                @php
                                                    $IIB_inv_questions = array(
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

                                                                       <div class="sub-head">Melting Point</div> 
                                                                        @php
                                                                        $IIB_inv_questions = array(
                                                                                "Was instrument calibrated before start of analysis?",
                                                                                "Was sampled prepared as per STP?",
                                                                                "Was sampled properly filled inside the capillary tube?",
                                                                                "Were instrument properly connected at the time of analysis?",
                                                                                "Was temperature of the instrument as per STP?",
                                                                                "Was temperature acquired during analysis?",
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
                            $IIB_inv_questions = array(
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
                         $IIB_inv_questions = array(
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
                            $IIB_inv_questions = array(
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
                         $IIB_inv_questions = array(
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
                           
                            <label style="font-weight: bold; for="Audit Attachments">RM-PM Sampling</label>
                        
                            @php
                            $IIB_inv_questions = array(
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
            <div id="CCForm33" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase IB HOD Primary Remark</label>
                                <input type="text" name="hod_remark3" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase IB HOD Primary Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-IB CQAH/QAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark3" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-IB CQAH/QAH Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II A HOD Primary Remark</label>
                                <input type="text" name="hod_remark4" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II A HOD Primary Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">P-II A QAH/CQAH Remark</label>
                                <input type="text" name="QA_Head_primary_remark4" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">P-II A QAH/CQAH Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Initiator Group">Phase II B HOD Primary Remark</label>
                                <input type="text" name="hod_remark5" placeholder="Enter your Remark">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Audit Attachments">Phase II B HOD Primary Attachment</label>
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
                    <div class="sub-head">Phase IA Investigation</div>
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
                                <label for="Audit Team"> OOS Category-Root Cause Ident.</label>
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
                                <label for="Description Deviation">OOS Category (Others)</label>
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
        </div>
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
                        <div class="sub-head">
                            Phase II Investigation
                        </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">QA Approver Comments</label>
                            <textarea class="summernote" name="qa_approver_comments_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Reason for manufacturing </label>
                            <textarea class="summernote" name="reason_manufacturing_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments"> Manufact. Invest. Required? </label>
                            <select name="manufact_invest_required_piii">
                                <option value="">Enter Your Selection Here</option>
                                <option value="no">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
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
                   
                    
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Comments"> Audit Comments </label>
                            <textarea class="summernote" name="audit_comments_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Hypo/Exp. Required</label>
                            <select name="hypo_exp_required_piii">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo/Exp. Reference</label>
                            <textarea class="summernote" name="hypo_exp_reference_piii" id="summernote-1">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="group-input">
                            <label for="Audit Attachments"> Attachment</label>
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
                            <label for="Description Deviation">Details of Root Cause</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="details_of_root_cause_piiqcr" id="summernote-1">
                            </textarea>
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
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Exclamation FAR (Field alert) </label>
                            <textarea class="summernote" name="Field_alert_QA_initial_approval" id="summernote-1">
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
                            <label for="Description Deviation">Details of Root Cause</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="details_of_root_cause_piiqcr" id="summernote-1">
                            </textarea>
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
                            <select multiple id="reference_record" name="capa_ref_no_oosc" id="">
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
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1">
                                    </textarea>
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
                    <div class="sub-head">
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
                QA Head/Designee Approval
                </div>
                <div class="row">
                
                <div class="col-md-12 mb-4">
                    <div class="group-input">
                        <label for="Description Deviation"> Approval Comments </label>
                        <textarea class="summernote" name="reopen_approval_comments_uaa" id="summernote-1">
                        </textarea>
                    </div>
                </div>
                    <div class="col-12">
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
                    </div>
                </div>
                <div class="sub-head"> Batch Disposition </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Category</label>
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
                            <option value="release">To Be Released</option>
                            <option value="reject">To Be Rejected</option>
                            <option value="other">Other Action (Specify)</option>
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
                    <div class="col-md-12 mb-4">
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
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify for Delay in Activity</label>
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
                    <div class="sub-head"> OOS Extension </div>
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
                <div class="sub-head">
                    Activity Log
                </div>
                <div class="row">
                    <div class="col-12 sub-head">  Initiator </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Agenda">Submited by</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Agenda">Submited on</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled by">Cancelled By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="cancelled on">Cancelled On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">HOD/Designee</div>
                 <!-- Request More Info -->
                    <!--  Initial Phase I Investigation  Done By -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Team">HOD Primary Review Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Team">HOD Primary Review Complete On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">HOD Primary Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">QC Head/Designee </div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Found -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Comments">CQA/QA Head Primary Review Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">CQA/QA Head Primary Review Complete On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">CQA/QA Head Primary Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Not Found -->
                    <div class="col-12 sub-head">Initiator</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA Investigation By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA Investigation On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA Investigation Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head">HOD/Designee</div>
                     <!-- Request More Info -->
                    <!-- Correction Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA HOD Review Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IA HOD Review Complete On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA HOD Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Proposed Hypothesis Experiment -->
                    <div class="col-12 sub-head">QA/CQA</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Response Completed By"> Phase IA QA/CQA Review Complete By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Response Completed On">Phase IA QA/CQA Review Complete On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IA QA/CQA Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- Obvious Error Found -->
                    <div class="col-12 sub-head">CQA/QA Head/Designee</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Not Found By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Not Found On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Assignable Cause Not Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- No Assignable Cause Found -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Found By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Assignable Cause Found On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Assignable Cause Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head"> Initiator </div>
                    <!-- Request More Info -->
                    <!-- Repeat Analysis Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB Investigation By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB Investigation On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB Investigation Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Full Scale Investigation -->
                    <div class="col-12 sub-head">HOD/Designee</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB HOD Review Complete by</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase IB HOD Review Complete On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB HOD Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12 sub-head"> QA/CQA</div>
                    <!-- Request More Info -->
                    <!-- Assignable Cause Found (Manufacturing Defect) -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase IB QA/CQA Review Complete By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase IB QA/CQA Review Complete On </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase IB QA/CQA Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- No Assignable Cause Found (No Manufacturing Defect) -->
                    <div class="col-12 sub-head">CQA/QA Head/Designee</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Not Found By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Not Found On </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-I B Assignable Cause Not Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                     <!-- Request More Info -->
                     <!-- Phase II Correction Completed  -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Found By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">P-I B Assignable Cause Found On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-I B Assignable Cause Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                
                     <!--  Phase II A Correction Inconclusive -->
                     <div class="col-12 sub-head">Production</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A Investigation By</label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A Investigation On</label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A Investigation Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
               
                    <!-- Request More Info -->
                     <!-- Retesting/resampling -->
                     <div class="col-12 sub-head">Production Head</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A HOD Review Complete By </label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A HOD Review Complete On </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A HOD Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                
                    <!-- Phase II B Correction Inconclusive -->
                    <div class="col-12 sub-head">QA/CQA</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A QA/CQA Review Complete By </label>
                            <div class=" static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="Reference Recores">Phase II A QA/CQA Review Complete On </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II A QA/CQA Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                <div>
                <div class="row">
                   <div class="col-12 sub-head"> CQA/QA Head/Designee</div>
                    <!-- Final Approval -->
                    <!-- Request More Info -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="submitted by">P-II A Assignable Cause Not Found By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="submitted on">P-II A Assignable Cause Not Found On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II A Assignable Cause Not Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <!-- Request More Info -->
                    <!-- Approval Completed -->
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> P-II A Assignable Cause Found By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> P-II A Assignable Cause Found On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II A Assignable Cause Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">Initiator</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> Phase II B Investigation By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B Investigation On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B Investigation Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">HOD/Designee</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by"> Phase II B HOD Review Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B HOD Review Complete On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B HOD Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">QA/CQA</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">Phase II B QA/CQA Review Complete By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on"> Phase II B QA/CQA Review Complete On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">Phase II B QA/CQA Review Complete Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-12 sub-head">CQA/QA Head /Designee</div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">P-II B Assignable Cause Not Found By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on">P-II B Assignable Cause Not Found On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II B Assignable Cause Not Found Comment</label>
                        <div class="Date"></div>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed by">P-II B Assignable Cause Found By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="group-input">
                            <label for="completed on">P-II B Assignable Cause Found On</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="group-input">
                        <label for="Submitted on">P-II B Assignable Cause Found Comment</label>
                        <div class="Date"></div>
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
