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
        #statusBlock > div.progress-bars.d-flex > div:nth-child(15){
            border-radius: 0px 20px 20px 0px;

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
    <!-- ------------------------------grid-4 instrument_details-------------------------script -->
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
            $('#oosconclusion_review').click(function(e) {
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm18')">CheckList - Preliminary Lab. Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Preliminary Lab Inv. Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Preliminary Lab Invst. Review</button>
                <!-- checklist start -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm24')">Checklist - Investigation of Bacterial Endotoxin Test (BET)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm25')">Checklist - Investigation of Sterility</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm26')">Checklist - Investigation of Microbial limit test (MLT)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm21')">Checklist - Investigation of Chemical assay</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm22')">Checklist - Residual solvent (RS)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm23')">Checklist - Dissolution </button>
                <!-- checklist closed -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Phase II Investigation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">CheckList - Phase II Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Phase II QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Additional Testing Proposal </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">OOS Conclusion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">OOS Conclusion Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">OOS QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Batch Disposition</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">QA Head/Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm20')">Extension</button>
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

            <!-- Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary')

            <!-- CheckList - Preliminary Lab. Investigation -->
            @include('frontend.OOS.comps.preliminary_checklist')

            <!-- Preliminary Lab Inv. Conclusion -->
            @include('frontend.OOS.comps.preliminary_lab_conclusion')

            <!-- Preliminary Lab Invst. Review--->
            @include('frontend.OOS.comps.preliminary_lab_investigation')
             <!-- All CheckList-->
            {{-- @include('frontend.OOS.comps.all_checklist_Investigation_bsmmem') --}} 

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
            @include('frontend.OOS.comps.batch_disposition')

            <!-- Re-Open -->
           {{--  @include('frontend.OOS.comps.oos_reopen')  --}}  

            <!-- Under Addendum Approval -->
            @include('frontend.OOS.comps.under_approval')
            
            @include('frontend.OOS.comps.oos_extension') 
            

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
    <div class="container">
        <div class="modal right fade" id="myModal3" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-titles">OOS Workflow</h4>
                    </div>
                    <div style="padding:3px;" class="modal-body">
                        <Div class="button-box">
                            <div style="background: #85be859e;" class="mini_buttons">
                                Opened
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">

                            </div>
                            <div style="background: #0000ff1f;" class="mini_buttons">
                                HOD Review
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">

                            </div>
                            <div style="background: #0000ff1f;" class="mini_buttons">
                                QA Initial Review
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">

                            </div>
                            <div style="background: #0000ff1f;" class="mini_buttons">
                                CFT Review
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">

                            </div>
                            <div style="background: #0000ff1f;" class="mini_buttons">
                                QA Final Review
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">

                            </div>
                            <div style="background: #0000ff1f;" class="mini_buttons">
                                QA Head/Manager Designee Approval
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">
                            </div>

                            <div style="background: #0000ff1f;" class="mini_buttons">
                                Pending Initiator Update
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">
                            </div>

                            <div style="background: #0000ff1f;" class="mini_buttons">
                                QA Final Approval
                            </div>
                            <div class="down-logo">
                                <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                    class="w-100 h-100">
                            </div>
                            <div style="background: #ff000042;" class="mini_buttons">
                                Closed - Done
                            </div>
                        </Div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal right fade" id="myModal4" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">WorkFlow</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

  <div class="modal fade" id="launch_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="launch_extension_header">
                    <h4 class="modal-title text-center">Launch Extension</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="main_head_modal">
                        <ul>
                            <li>
                                <div>
                                    @if($qrmExtension && $qrmExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#qrm_extension"> QRM</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($investigationExtension && $investigationExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href=""data-bs-toggle="modal" data-bs-target="#investigation_extension"> Investigation</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($capaExtension && $capaExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#capa_extension"> CAPA</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($oosExtension && $oosExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#deviation_extension"> Deviation</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="qrm_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">QRM-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-qrm', $data->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date(QRM)</label>
                        <input class="extension_modal_signature" type="date" name="qrm_proposed_due_date" id="qrm_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (QRM)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="qrm_extension_justification" id="qrm_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">Quality Risk Management Extension Completed By </label>
                        <select class="extension_modal_signature" name="qrm_extension_completed_by"
                            id="qrm_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Quality Risk Management Extension Completed On </label>
                        <input class="extension_modal_signature" type="date"
                            name="qrm_completed_on" id="qrm_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="QRM" hidden >
                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="investigation_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Investigation-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-investigation', $data->id) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">

                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date(Investigation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_proposed_due_date" id="investigation_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (Investigation)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="investigation_extension_justification" id="investigation_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Extension Completed By </label>
                        <select class="extension_modal_signature" name="investigation_extension_completed_by" id="investigation_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="investigation_completed_on" id="investigation_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="Investigation" hidden >
                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="capa_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">CAPA-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-capa', $data->id) }}" method="post">
                @csrf

                <!-- Modal body -->
                <div class="modal-body">

                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date (CAPA)</label>
                        <input class="extension_modal_signature" type="date" name="capa_proposed_due_date" id="capa_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (CAPA)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="capa_extension_justification" id="capa_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Extension Completed By </label>
                        <select class="extension_modal_signature" name="capa_extension_completed_by" id="capa_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="Capa" hidden >
                    <div class="group-input">
                        <label for="password">CAPA Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="capa_completed_on" id="capa_completed_on">
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deviation_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">OOS-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-deviation', $data->id) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date (OOS)</label>
                        <input class="extension_modal_signature" type="date" name="dev_proposed_due_date" id="dev_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (OOS)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="dev_extension_justification" id="dev_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">OOS Extension Completed By </label>
                        <select class="extension_modal_signature" name="dev_extension_completed_by" id="dev_extension_completed_by">
                        <option value="">-- Select --</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">OOS Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="dev_completed_on" id="dev_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden  >
                    <input name="extension_identifier" id="extension_identifier" value="Deviation"  hidden >
                </div>

                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="effectivenss_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="launch_extension_header">
                    <h4 class="modal-title text-center">Launch Effectiveness Check</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="main_head_modal">
                        <ul>
                            <li>
                                <div> <a href="" data-bs-toggle="modal"
                                        data-bs-target="#deviation_effectiveness"> Deviation Effectiveness
                                        Check</a></div>
                            </li>

                            <li>
                                <div> <a href="" data-bs-toggle="modal"
                                        data-bs-target="#capa_effectiveness"> CAPA Effectivenss Check</a></div>
                            </li>
                            <li>
                                <div> <a href="" data-bs-toggle="modal"
                                        data-bs-target="#qrm_effectiveness"> QRM Effectiveness Check</a></div>
                            </li>
                            <li>
                                <div> <a href=""data-bs-toggle="modal"
                                        data-bs-target="#investigation_effectiveness"> Investigation Effectiveness
                                        Check</a></div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deviation_effectiveness">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Deviation-Effectiveness</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="deviation">Effectiveness Check Plan(Deviation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="effectiveness_deviation">
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Effectiveness Check Plan Proposed By<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="effectiveness_deviation_proposed_by">
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Effectiveness Check Plan Proposed On </label>
                        <input class="extension_modal_signature" type="text"
                            name="deviation_effectiveness_by">
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Colsure Comments(Deviation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="deviation_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Next Review Date(Deviation)</label>
                        <input class="extension_modal_signature" type="date" name="next_review_deviation">
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Effectiveness Check closed By </label>
                        <select class="extension_modal_signature" name="deviation_feectiveness_closed_by"
                            id="">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Effectiveness Check CLosed On</label>
                        <input class="extension_modal_signature" type="date"
                            name="deviation_effectiveness_on">
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="capa_effectiveness">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">CAPA-Effectiveness</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Plan(CAPA)</label>
                        <input class="extension_modal_signature" type="date"
                            name="effectiveness_check_capa">
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Effectiveness Check Plan Proposed By<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="_eefectiveness_capa_proposed_by">
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Effectiveness Check Plan Proposed On </label>
                        <input class="extension_modal_signature" type="text"
                            name="deviation_effectiveness_by">
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Colsure Comments(CAPA)</label>
                        <input class="extension_modal_signature" type="date"
                            name="deviation_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Next Review Date(CAPA)</label>
                        <input class="extension_modal_signature" type="date" name="next_review_capa">
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Effectiveness Check closed By </label>
                        <select class="extension_modal_signature" name="capa_effectiveness_closed"
                            id="">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Effectiveness Check CLosed On</label>
                        <input class="extension_modal_signature" type="date" name="capa_effectiveness_on">
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="qrm_effectiveness">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">QRM-Effectiveness</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task.
                    </div>
                    <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Plan(QRM)</label>
                        <input class="extension_modal_signature" type="date" name="deviation_due_capa">
                    </div>
                    <div class="group-input">
                        <label for="password">QRM Effectiveness Check Plan Proposed By<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="qrm_proposed_by">
                    </div>
                    <div class="group-input">
                        <label for="password">QRM Effectiveness Check Plan Proposed On </label>
                        <input class="extension_modal_signature" type="text" name="qrm_effectiveness_by">
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Colsure Comments(QRM)</label>
                        <input class="extension_modal_signature" type="date" name="qrm_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Next Review Date(QRM)</label>
                        <input class="extension_modal_signature" type="date" name="next_review_qrm">
                    </div>
                    <div class="group-input">
                        <label for="password">QRM Effectiveness Check closed By </label>
                        <select class="extension_modal_signature" name="qrm_effectivenss_check_by"
                            id="">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">QRM Effectiveness Check CLosed On</label>
                        <input class="extension_modal_signature" type="date" name="qrm_effectiveness_on">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- ==============================investigation effectiveness===========  -->
<div class="modal fade" id="investigation_effectiveness">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Investigation-Effectiveness</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Plan(Investigation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_effectivenss_check">
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Effectiveness Check Plan Proposed By<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="investigation_effectivenss_by">
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Effectiveness Check Plan Proposed On </label>
                        <input class="extension_modal_signature" type="text"
                            name="investigation_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Effectiveness Check Colsure Comments(Investigation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Next Review Date(Investigation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_effectiveness_on">
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Effectiveness Check closed By </label>
                        <select class="extension_modal_signature" name="investigation_effectiveness_by"
                            id="">
                            <option value="">-- Select --</option>
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Effectiveness Check CLosed On</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_effectiveness_on">
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="submit">
                        Submit
                    </button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
