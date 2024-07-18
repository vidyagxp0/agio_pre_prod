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
                        '<input type="text" readonly id="info_mfg_date_' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                        '<input type="month" name="info_product_material[' + serialNumber + '][info_mfg_date]" value="" class="hide-input" oninput="handleMonthInput(this, \'info_mfg_date_' + serialNumber + '\')">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="col-lg-6 new-date-data-field">' +
                        '<div class="group-input input-date">' +
                        '<div class="calenderauditee">' +
                        '<input type="text" readonly id="info_expiry_date' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
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
                        '<td><button type="text" class="removeRowBtn"> Remove </button></td>' +

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
                            '<td><button type="text" class="removeRowBtn"> Remove </button></td>' +
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
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_description]" value=""></td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_previous_root_cause]" value=""></td>' +
                        '<td><input type="text" name="oos_capa[' + serialNumber + '][info_oos_capa]" value=""></td>' +
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
            $('#oosconclusion_review').click(function(e) {
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

                var tableBody = $('#oosconclusion_review_details tbody');
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
            {{ Helpers::getDivisionName(session()->get('division')) }} / OOS Micro
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm24')">Extension</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signature</button>

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
                                <input type="hidden" name="record"
                            value="{{ $record_number }}">
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
                                <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                                <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                <input type="hidden" value="{{ date('d-M-Y') }}" name="intiation_date">
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Due Date"> Due Date </label>
                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                <div class="calenderauditee">
                                <input type="text"  id="due_date"  readonly placeholder="DD-MMM-YYYY"  value="{{ Helpers::getDueDate123(null, false, 'd-M-Y') }}" />
                                <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                class="hide-input"
                                oninput="handleDateInput(this, 'due_date')"  value="{{ Helpers::getDueDate123(null, false, 'Y-m-d') ?? '' }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
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
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"><b>Initiation department group</b></label>
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
                                <label for="Initiation department group code">Initiation department group code</label>
                                <input type="text" name="initiator_group_code_gi" id="initiator_group_code"
                                    value="">
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initiated Through ?</label>
                                <select name="initiated_through_gi"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Internal Audit">Internal Audit</option>
                                            <option value="External Audit">External Audit</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="Lab Incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
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
                       {{-- <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Nature of Change</label>
                                <select name="nature_of_change_gi">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="permanent">Permanent</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Source Document Type</label>
                                <select name="source_document_type_gi">
                                    <option value="">Enter Your Selection Here</option>
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
                                <input type="text" name="reference_system_document_gi" placeholder="Enter Reference System Document">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference Document</label>
                                <input type="text" name="reference_document_gi" placeholder="Enter Reference Document">
                            </div>
                        </div>
                        <div class="col-md-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOS Occurred On">OOS Occured On</label>
                                <div class="calenderauditee">                                    
                                    <input type="text"  id="deviation_occured_on_gi" readonly placeholder="DD-MM-YYYY" />
                                    <input type="date" name="deviation_occured_on_gi"    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
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
                        <div class="col-lg-6 new-time-data-field">
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
                                <label for="Reference Recores">Immediate action</label>
                                <input type="text" name="immediate_action"  id="immediate_action" value="">
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
                                <input type="text" name="product_material_name_gi"  placeholder="Enter your Product / Material Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Market</label>
                                <input type="text" name="market_gi" placeholder="Enter your Market">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Customer</label>
                                <input type="text" name="customer_gi" placeholder="Enter your Customer">
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
                                            <th style="width: 15%"> Action </th>
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
                                                        <input type="month" name="info_product_material[0][info_mfg_date]" value="" 
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
                                                        <input type="month" name="info_product_material[0][info_expiry_date]"
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
                                                    <option value="">--Select-- </option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="info_product_material[0][info_stability_for]">
                                                    <option value="">--Select-- </option>
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
                                            <th style="width: 15%"> Action </th>
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
                                            <th style="width: 16%">Submit On</th>
                                            <th style="width: 15%">Action </th>
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
                         <!---------------- grid-5 instrument_details----------------------------------- -->

                         <div class="group-input">
                            <label for="audit-agenda-grid">
                            Instrument details
                                <button type="button" name="audit-agenda-grid" id="instrument_details">+</button>
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
                                            <th style="width: 5%"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="instrument_detail[0][serial]" value="1"></td>
                                            <td><input type="text" name="instrument_detail[0][instrument_name]"></td>
                                            <td><input type="text" name="instrument_detail[0][instrument_id_number]"></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- close grid -->
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
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
                                    <option value="">Enter Your Selection Here</option>
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
                            <option value="">Enter Your Selection Here</option>
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
                        <option value="">Enter Your Selection Here</option>
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
                            <option value="">Enter Your Selection Here</option>
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
                            <div class="file-attachment-list" id="file_attachments_pli"></div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="file_attachments_pli[]" oninput="addMultipleFiles(this, 'file_attachments_pli')" multiple>
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
                                <label for="Description Deviation">Summary of Prelim.Investigation.</label>
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
                                            <th style="width: 10%">Description of OOS</th>
                                            <th style="width: 10%">Previous OOS Root Cause</th>
                                            <th style="width: 8%"> CAPA</th>
                                            <th style="width: 13%"> OOS Reported Date</th>
                                            <th style="width: 13%"> Closure Date of CAPA</th>
                                            <th style="width: 10%">CAPA Requirement</th>
                                            <th style="width: 8%">Reference CAPA Number</th>
                                            <th style="width: 4%"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="oos_capa[0][serial]" value="1"></td>
                                            <td><input type="text" id="info_oos_number" name="oos_capa[0][info_oos_number]" value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_description]" value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_previous_root_cause]"value=""></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa]" value=""></td>
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
                                                   <option value="">Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select></td>
                                            <td><input type="text" name="oos_capa[0][info_oos_capa_reference_number]" value=""></td> 
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
                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Reason for manufacturing</label>
                                <textarea class="summernote" name="reason_manufacturing_piii" id="summernote-1">
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="chemical">Chemical</option>
                                    <option value="microbiology">Microbiology</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="manufacturing_invst_ref_piii"> Manufacturing Invest. Ref. </label>
                                <select multiple id="reference_record" name="manufacturing_invst_ref_piii[]">
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
                                    <option value="">Enter Your Selection Here</option>
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
                                <label for="re_sampling_ref_no_piii">Re-sampling Ref. No.</label>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="hypo_exp_reference_piii">Hypo/Exp. Reference</label>
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
                                    <div class="file-attachment-list" id="attachment_piii"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="attachment_piii[]"
                                            oninput="addMultipleFiles(this, 'attachment_piii')" multiple>
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
                                                            <option value="">Select an Option</option>
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
                                    <option value="">Enter Your Selection Here</option>
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
                                <label for="Description Deviation">Impact Assessment.</label>
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="impact_assessment_piiqcr" id="summernote-1">
                                        </textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Mgr.more Info Reqd On">Recommended Action Required? </label>
                                <select name="recommended_action_required_piiqcr">
                                    <option value="">Enter Your Selection Here</option>    
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="recommended_action_reference_piiqcr">Recommended Action Reference</label>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="invest_ref_piiqcr">Invest ref.</label>
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
                                <label for="additional_test_reference_atp">Additional Test Reference.
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="action_task_reference_atp">Action Task Reference</label>
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
                            <div class="table-responsive">
                        </label>
                            <table class="table table-bordered" id="oos_conclusion_details" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">Row#</th>
                                        <th style="width: 16%">Analysis Detials</th>
                                        <th style="width: 16%">Hypo./Exp./Add.Test PR No.</th>
                                        <th style="width: 16%">Results</th>
                                        <th style="width: 16%">Analyst Name.</th>
                                        <th style="width: 16%">Remarks</th>
                                        <th style="width: 6%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><input disabled type="text" name="oos_conclusion[0][serial]" value="1"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_analysis_detials]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_hypothesis_experimentation_test_pr_no]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_analyst_name]"></td>
                                    <td><input type="text" name="oos_conclusion[0][summary_results_remarks]"></td> 
                                    <td><button type="text" class="removeRowBtn"> Remove </button> </td>
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
                                    <option value="">Enter Your Selection Here</option>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="valid">Valid</option>
                                    <option value="invalid">Invalid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">CAPA Req.</label>
                                <select name="capa_req_oosc">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                               
                                 </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="capa_ref_no_oosc">CAPA Ref No.</label>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="action_plan_ref_oosc">Action Plan Ref.</label>
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
                                    <div class="file-attachment-list" id="attachments_if_any_oosc"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="attachments_if_any_oosc[]"
                                            oninput="addMultipleFiles(this, 'attachments_if_any_oosc')" multiple>
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
                                        <th> Action </th>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="capa_refer_ocr">CAPA Refer.</label>
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
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Required Action Task?</label>
                                <select name="required_action_task_ocr">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="action_task_reference_ocr">Action Task Reference.</label>
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
                                   <option value="">Enter Your Selection Here</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="risk_assessment_ref_ocr">Risk Assessment Ref.</label>
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
                                    <option value="">Enter Your Selection Here</option>
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
                                <select name="action_plan_requirement_OOS_CQ" data-search="false" data-silent-initial-value-set="true" id="auditee">
                                    <option value="">Enter Your Selection Here</option>
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
                                    <div class="file-attachment-list" id="cq_attachment_OOS_CQ"></div>
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
                                <label for="field_alert_reference_BI">Field alert reference</label>
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
                                <label for="phase_III_inves_reference_BI">Phase-III Inves. Reference</label>
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
                                    <div class="file-attachment-list" id="disposition_attachment_BI"></div>
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
                                    <div class="file-attachment-list" id="reopen_attachment"></div>
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
                            <!-- <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button> -->
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div id="CCForm18" class="inner-block cctabcontent">
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
                                                        <input type="date" name="analyst_training_proce[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="analyst_training_proce[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="analyst_training_proce[{{$loop->index}}][response]"
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
                                                        <textarea name="analyst_training_proce[{{$loop->index}}][remark]"
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
                        Checklist for Sample receiving & verification in lab : </div>
                            @php
                            $sample_receiving_verifications = [
                                [
                                'question' => "Was the sample container (Physical integrity) verified at the time of sample receipt?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the correct quantity of the sample withdrawn?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was there any discrepancy observed during sampling?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the sample container (Physical integrity) checked before testing?",
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

                                            @foreach ($sample_receiving_verifications as $index => $review_item)
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
                                                        <input type="date" name="sample_receiving_verification_lab[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="sample_receiving_verification_lab[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="sample_receiving_verification_lab[{{$loop->index}}][response]"
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
                                                        <textarea name="sample_receiving_verification_lab[{{$loop->index}}][remark]"
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
                        Checklist for Method/Procedure used during analysis: </div>
                        @php
                        $method_procedure_used_during_anas = [
                                [
                                'question' => "Was correct applicable specification/Test procedure/MOA used for analysis?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Verified specification/Test procedure/MOA No.",
                                'is_sub_question' => true,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Was the test procedure followed as per method validation?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was there any change in the validated change method? If yes, was test performed with the new validated method?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was BET reagents (Lysate, CSE, LRW and Buffer) procured from the approved vendor?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was lysate and CSE stored at the recommended temperature and duration? Storage condition:",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were all product/reagents contact parts of BET testing (Tips/Accessories/Sample Container) depyrogenated?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Assay tube/Batch No.",
                                'is_sub_question' => false,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Expiry date:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Tip lot/Batch No.",
                                'is_sub_question' => false,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Expiry date:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Was the test done at correct MVD as per validated method?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were calculations of MVD/Test dilution done correctly?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were correct dilutions prepared?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was labeled claim lysate sensitivity checked before the use of the lot?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were all reagents (LRW/CSE and Lysate) used in the test within the expiry?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "LRW expiry date?",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "CSE expiry date?",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Lysate expiry date?",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Buffer expiry date?",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Was рН of the test sample/dilution verified?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were appropriate рН strip/measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were proper incubation conditions followed?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was there any spillage that occurred during the vortexing of dilutions?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were the results of positive, negative, and test controls found satisfactory?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Is the test incubator/heating block kept on a vibration-free surface?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:",
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
                                                $main_question_index = 3.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($method_procedure_used_during_anas as $index => $review_item)
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
                                                        <input type="date" name="method_procedure_used_during_analysis[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="method_procedure_used_during_analysis[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="method_procedure_used_during_analysis[{{$loop->index}}][response]"
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
                                                        <textarea name="method_procedure_used_during_analysis[{{$loop->index}}][remark]"
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
                        Checklist for Instrument/Equipment Details:</div>
                                @php
                            $Instrument_Equipment_Details = [
                                [
                                'question' => "Was the equipment used, calibrated/qualified and within the specified range?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Dry block /Heating block equipment ID:",
                                'is_sub_question' => true,
                                'input_type' => 'number'
                                ],
                                [
                                'question' => "Calibration date & Next due date:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
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
                                ],
                                [
                                'question' => "Refrigerator (2-8̊ C) ID:",
                                'is_sub_question' => false,
                                'input_type' => ' number'
                                ],
                                [
                                'question' => "Validation date and next due date:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Dehydrogenation over ID:",
                                'is_sub_question' => false,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Validation date and next due date:",
                                'is_sub_question' => true,
                                'input_type' => 'date'
                                ],
                                [
                                'question' => "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was the depyrogenation done as per the validated load pattern?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was there any power failure noticed during the incubation of samples in the heating block?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Was assay tubes incubated in the dry block (time and temp) as specified in the procedure?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were any other samples tested along with this sample?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "If yes, were those sample’s results found satisfactory?",
                                'is_sub_question' => true,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "Were any other samples analyzed at the same time on the same instruments?",
                                'is_sub_question' => false,
                                'input_type' => 'text'
                                ],
                                [
                                'question' => "If yes, what were the results of other Batches?",
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
                                                $main_question_index = 4.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($Instrument_Equipment_Details as $index => $review_item)
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
                                                        <input type="date" name="Instrument_Equipment_Det[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Instrument_Equipment_Det[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Instrument_Equipment_Det[{{$loop->index}}][response]"
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
                                                        <textarea name="Instrument_Equipment_Det[{{$loop->index}}][remark]"
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
                        Checklist for Results and Calculation : </div>
                            @php
                            $Results_and_Calculations = [
                            [
                            'question' => "Were results taken properly?",
                            'is_sub_question' => false,
                            'input_type' => 'text'
                            ],
                            [
                            'question' => "Raw data checked By:",
                            'is_sub_question' => false,
                            'input_type' => 'number'
                            ],
                            [
                            'question' => "Was formula dilution factor used for calculating the results correct?",
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

                                            @foreach ($Results_and_Calculations as $index => $review_item)
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
                                                        <input type="date" name="Results_and_Calculat[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Results_and_Calculat[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Results_and_Calculat[{{$loop->index}}][response]"
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
                                                        <textarea name="Results_and_Calculat[{{$loop->index}}][remark]"
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
                                <div class="file-attachment-list" id="attachment_details_cibet"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachment_details_cibet[]"
                                        oninput="addMultipleFiles(this, 'attachment_details_cibet')" multiple>
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
                                                <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                <td>{{$review_item['question']}}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="Training_records_Analyst_Involved[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Training_records_Analyst_Involved[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Training_records_Analyst_Involved[{{$loop->index}}][response]"
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
                                                        <textarea name="Training_records_Analyst_Involved[{{$loop->index}}][remark]"
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
                                                        <input type="date" name="sample_intactness_before_analysis[{{$loop->index}}][remark][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="sample_intactness_before_analysis[{{$loop->index}}][remark][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="sample_intactness_before_analysis[{{$loop->index}}][remark][response]"
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
                                                <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                <td>{{$review_item['question']}}</td>
                                                <td>
                                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                        @if ($review_item['input_type'] == 'date')
                                                        <input type="date" name="test_methods_Procedure[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="test_methods_Procedure[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="test_methods_Procedure[{{$loop->index}}][response]"
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
                                                        <textarea name="test_methods_Procedure[{{$loop->index}}][remark]"
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
                        Review of Media, Buffer, Standards preparation & test accessories </div>
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
                                                        <input type="date" name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][response]"
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
                                                        <textarea name="Review_of_Media_Buffer_Standards_prep[{{$loop->index}}][remark]"
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
                                                        <input type="date" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][response]"
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
                                                        <textarea name="Checklist_for_Revi_of_Media_Buffer_Stand_prep[{{$loop->index}}][remark]"
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
                                                        <input type="date" name="ccheck_for_disinfectant_detail[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="ccheck_for_disinfectant_detail[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="ccheck_for_disinfectant_detail[{{$loop->index}}][response]"
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
                                                        <textarea name="check_for_disinfectant_detail[{{$loop->index}}][remark]"
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
                                                        <input type="date" name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][response]"
                                                            style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @elseif ($review_item['input_type'] == 'number')
                                                        <input type="number" name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][response]"
                                                            style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                        @else
                                                        <select name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][response]"
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
                                                        <textarea name="Checklist_for_Review_of_instrument_equip[{{$loop->index}}][remark]"
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
                            {{-- <small class="text-primary">
                                        If Yes, attach details
                                    </small> --}}
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attachment_details_cis"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachment_details_cis[]"
                                        oninput="addMultipleFiles(this, 'attachment_details_cis')" multiple>
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
                                                                <input type="date" name="Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][response]"
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
                                                                <textarea name=" Checklist_for_Review_of_Training_records_Analyst[{{$loop->index}}][remark]"
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
                                                        <td class="flex text-center">{{ $review_item['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                        <td>{{$review_item['question']}}</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                                @if ($review_item['input_type'] == 'date')
                                                                <input type="date" name="Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @elseif ($review_item['input_type'] == 'number')
                                                                <input type="number" name="Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][response]"
                                                                    style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                @else
                                                                <select name="Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][response]"
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
                                                                <textarea name=" Checklist_for_Review_of_sampling_and_Transport[{{$loop->index}}][remark]
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
                                                        $main_question_index = 3.0;
                                                        $sub_question_index = 0;
                                                    @endphp
                                                    @foreach ($Checklist_Review_of_Test_Method_proceds as $Checklist_Review_of_Test_Method_proced)
                                                    @php
                                                        if ($Checklist_Review_of_Test_Method_proced['is_sub_question']) {
                                                            $sub_question_index++;
                                                        } else {
                                                            $sub_question_index = 0;
                                                            $main_question_index += 0.1;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="flex text-center">{{ $Checklist_Review_of_Test_Method_proced['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : $main_question_index }}</td>
                                                        <td>{{$Checklist_Review_of_Test_Method_proced['question']}}
                                                        </td>
                                                        <td>

                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                @if ($Checklist_Review_of_Test_Method_proced['input_type'] == 'date')
                                                                <input type="date" name="analyst_training_proce[{{ $index }}][response]"
                                                                    style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($Checklist_Review_of_Test_Method_proced['input_type'] == 'number')
                                                            <input type="number" name="analyst_training_proce[{{ $index }}][response]"  style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            @else
                                                                <select name="analyst_training_proce[{{ $index }}][response]"
                                                                        id="response"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No" >No</option>
                                                                    <option value="N/A">N/A</option>
                                                                </select>
                                                            @endif

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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                            {{-- <textarea name="who_will_not_be"></textarea> --}} <div
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
                                                    $main_question_index = 5.0;
                                                    $sub_question_index = 0;
                                                @endphp

                                                @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $Checklist_for_Review_Media_prepara_RTU_media)
                                                {{-- @php
                                                    if ($Checklist_for_Review_Media_prepara_RTU_media['is_sub_question']) {
                                                        $sub_question_index++;
                                                    } elseif {
                                                        $sub_question_index = 0;
                                                        // $main_question_index += 0.1;
                                                    }
                                                    else {
                                                        $sub_question_index = 0;
                                                        $main_question_index += 0.1;
                                                    }
                                                @endphp --}}
                                                @php
                                                if ($Checklist_for_Review_Media_prepara_RTU_media['is_sub_question']) {
                                                                $sub_question_index++;
                                                            } else {
                                                                $sub_question_index = 0;
                                                                $main_question_index += 0.1;
                                                            }
                                                    @endphp
                                                <tr>
                                                    <td class="flex text-center">{{ $Checklist_for_Review_Media_prepara_RTU_media['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : $main_question_index }}</td>
                                                    <td>{{$Checklist_for_Review_Media_prepara_RTU_media['question']}}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                                            @if ($Checklist_for_Review_Media_prepara_RTU_media['input_type'] == 'date')
                                                            <input type="date" name="media_prepara_RTU[{{ $loop->index }}][response]"
                                                                style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @elseif ($Checklist_for_Review_Media_prepara_RTU_media['input_type'] == 'number')
                                                            <input type="number" name="media_prepara_RTU[{{ $loop->index }}][response]"
                                                                style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                            @else
                                                            <select name="media_prepara_RTU[{{ $loop->index }}][response]"
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
                                                            <textarea name="Checklist_for_Review_Media_prepara_RTU_medias[{{$loop->index}}][remark]"
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
                                                        $main_question_index = 6.0;
                                                        $sub_question_index = 0;
                                                    @endphp
                                                    @foreach ($Checklist_Review_Environment_condition_in_tests as $Checklist_Review_Environment_condition_in_test )
                                                    @php
                                                    if ($Checklist_Review_Environment_condition_in_test['is_sub_question']) {
                                                        $sub_question_index++;
                                                    } else {
                                                        $sub_question_index = 0;
                                                        $main_question_index += 0.1;
                                                    }
                                                @endphp
                                                    <tr>
                                                        <td class="flex text-center">{{ $Checklist_Review_Environment_condition_in_test['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                        <td>{{$Checklist_Review_Environment_condition_in_test['question']}}</td>
                                                        <td>

                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="Checklist_Review_Environment_condition_in_test[{{$loop->index}}][response]" id="response"
                                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
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
                                                <tbody>

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
                                                                    <input type="date" name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][response]"
                                                                        style="padding: 2px; width: 90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @elseif ($review_item['input_type'] == 'number')
                                                                    <input type="number" name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][response]"
                                                                        style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                                                    @else
                                                                    <select name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][response]"
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
                                                                    <textarea name="review_of_instrument_bioburden_and_waters[{{$loop->index}}][remark]"
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
                                                @php
                                                $main_question_index = 8.0;
                                                $sub_question_index = 0;
                                            @endphp

                                            @foreach ($disinfectant_details_of_bioburden_and_water_tests as $index => $disinfectant_detail)
                                            @php
                                                if ($disinfectant_detail['is_sub_question']) {
                                                    $sub_question_index++;
                                                } else {
                                                    $sub_question_index = 0;
                                                    $main_question_index += 0.1;
                                                }
                                            @endphp
                                            <tr>
                                                <td class="flex text-center">{{ $disinfectant_detail['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                                <td>{{$disinfectant_detail['question']}}</td>
                                                <td>
                                                            <div
                                                                style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                <select name="disinfectant_details_of_bioburden_and_water_test[{{$loop->index}}][response]" id="response"
                                                                    style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                    <option value="">Select an Option</option>
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
                                        <div class="file-attachment-list" id="attachment_details_cimlbwt"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="attachment_details_cimlbwt[]"
                                                oninput="addMultipleFiles(this, 'attachment_details_cimlbwt')" multiple>
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

                <div class="sub-head">Checklist for Review of sample intactness before analysis ? </div>
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
                            <div class="file-attachment-list" id="attachment_details_cima"></div>

                            <div class="add-btn">
                                <div>Add</div>
                                <input type="file" id="myfile" name="attachment_details_cima[]"
                                    oninput="addMultipleFiles(this, 'attachment_details_cima')" multiple/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-block">
                    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>

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
                                <div class="file-attachment-list" id="attachment_details_ciem"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachment_details_ciem[]"
                                        oninput="addMultipleFiles(this, 'attachment_details_ciem')" multiple/>
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
                                            <div class="file-attachment-list" id="attachment_details_cimst"></div>
                                                <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attachment_details_cimst[]"
                                                    oninput="addMultipleFiles(this, 'attachment_details_cimst')" multiple/>
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
            <!-- Extention add -->

        <div id="CCForm24" class="inner-block cctabcontent">
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
                    <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
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
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
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

<!-- --------------------------------------button--------------------- -->
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
