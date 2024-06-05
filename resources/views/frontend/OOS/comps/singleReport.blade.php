<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td,
    .border-table table,
    .border-table th,
    .border-table td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    footer .head,
    header .head {
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        width: 100%;
        position: fixed;
        display: block;
        bottom: -40px;
        left: 0;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block tr {
        font-size: 0.8rem;
    }

    .inner-block .block {
        margin-bottom: 30px;
    }

    .inner-block .block-head {
        font-weight: bold;
        font-size: 1.1rem;
        padding-bottom: 5px;
        border-bottom: 2px solid #4274da;
        margin-bottom: 10px;
        color: #4274da;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }

    .table_bg {
        background: #4274da57;
    }
</style>

<body>
    <div>
      <header>
        <table>
            <tr>
                <td class="w-70 head">
                   OOS Cemical Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>OOS No.</strong>{{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
        </header>
    </div>
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
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> General Information </div>
                <table>
                       <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">@if($data->record_number){{  str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">@if($data->due_date){{  str_pad($data->due_date, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td>
                        <th class="w-20"> Severity Level</th>
                        <td class="w-30">@if($data->severity_level_gi){{ $data->severity_level_gi }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_group){{ $data->initiator_group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-80">{{ $data->initiator_group_code }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">@if($data->description_gi){{ $data->description_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>
                    </tr>
                   
                    <tr>
                       <th class="w-20">If Others</th>
                        <td class="w-80">@if($data->if_others_gi){{ $data->if_others_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Is Repeat </th>
                        <td class="w-80">@if($data->is_repeat_gi){{ $data->is_repeat_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature_gi){{ $data->repeat_nature_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Nature of Change</th>
                        <td class="w-80">@if($data->nature_of_change_gi){{ $data->nature_of_change_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Deviation Occurred On</th>
                        <td class="w-80">@if($data->deviation_occured_on_gi){{ $data->deviation_occured_on_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Source Document Type</th>
                        <td class="w-80">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                    </tr>
                     <tr>
                         <th class="w-20">Reference System Document</th>
                        <td class="w-80">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                     </tr>
                    <tr>
                        <th class="w-20">Sample Type</th>
                        <td class="w-80">@if($data->sample_type_gi){{ Helpers::recordFormat($data->sample_type_gi) }}@else Not Applicable @endif</td>
                        <th class="w-20">Product / Material Name</th>
                        <td class="w-80">@if($data->product_material_name_gi){{ Helpers::recordFormat($data->product_material_name_gi) }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Market</th>
                        <td class="w-80">@if($data->market_gi){{ $data->market_gi}}@else Not Applicable @endif</td>
                        <th class="w-20">Customer</th>
                        <td class="w-80">@if($data->customer_gi){{ $data->customer_gi }}@else Not Applicable @endif</td>
                    </tr>
                    
                <div class="block-head">OOS Camical Initial Attachement</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File </th>
                            </tr>
                            @if ($data->initial_attachment_gi)
                            @foreach ($data->initial_attachment_gi as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-80">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
            <!-- Allgrid -->
           <!-- Info. On Product/ Material -->
            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 10%">Item/Product Code</th>
                            <th style="width: 8%"> Batch No*.</th>
                            <th style="width: 8%"> Mfg.Date</th>
                            <th style="width: 8%">Expiry Date</th>
                            <th style="width: 8%"> Label Claim.</th>
                            <th style="width: 8%">Pack Size</th>
                        </tr>
                        @if($data->info_product_materials)
                        @foreach ($data->info_product_materials->data as $key => $datagridI)
                        <tr>
                            <td class="w-15">{{ $datagridI ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridI['info_product_code'] ?  $datagridI['info_product_code']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_batch_no'] ?  $datagridI['info_batch_no']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_mfg_date'] ?  $datagridI['info_mfg_date']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_expiry_date'] ?  $datagridI['info_expiry_date']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_label_claim'] ?  $datagridI['info_label_claim']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_pack_size'] ?  $datagridI['info_pack_size']: "Not Applicable"}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                   <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 8%">Analyst Name</th>
                            <th style="width: 10%">Others (Specify)</th>
                            <th style="width: 10%"> In- Process Sample Stage.</th>
                            <th style="width: 12% pt-3">Packing Material Type</th>
                            <th style="width: 16% pt-2"> Stability for</th>
                        </tr>
                        @if($data->info_product_materials)
                        @foreach ($data->info_product_materials->data as $key => $datagridI)
                        <tr>
                            <td class="w-15">{{ $datagridI ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridI['info_analyst_name'] ?  $datagridI['info_analyst_name']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_others_specify'] ?  $datagridI['info_others_specify']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_process_sample_stage'] ?  $datagridI['info_process_sample_stage']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_packing_material_type'] ?  $datagridI['info_packing_material_type']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridI['info_stability_for'] ?  $datagridI['info_stability_for']: "Not Applicable"}}</td>
                         </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                 </div>
                </div>
            </div>
            </div>
            </div>
        <!--  Details of Stability Study -->
            <div class="block">
                <div class="block-head"> Details of Stability Study</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                               <th style="width: 4%">Row#</th>
                                <th style="width: 8%">AR Number</th>
                                <th style="width: 12%">Condition: Temperature & RH</th>
                                <th style="width: 12%">Interval</th>
                                <th style="width: 16%">Orientation</th>
                        </tr>
                        @if(($data->details_stabilities) && is_array($data->details_stabilities->data))
                        @foreach ($data->details_stabilities->data as $key => $datagridII)
                        <tr>
                            <td class="w-15">{{ $datagridII ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridII['stability_study_arnumber'] ?  $datagridII['stability_study_arnumber']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridII['stability_study_condition_temprature_rh'] ?  $datagridII['stability_study_condition_temprature_rh']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridII['stability_study_Interval'] ?  $datagridII['stability_study_Interval']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridII['stability_study_orientation'] ?  $datagridII['stability_study_orientation']: "Not Applicable"}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head"> Details of Stability Study</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                               <th style="width: 4%">Row#</th>
                                <th style="width: 16%">Pack Details (if any)</th>
                                <th style="width: 16%">Specification No.</th>
                                <th style="width: 16%">Sample Description</th>
                        </tr>
                        @if(($data->details_stabilities) && is_array($data->details_stabilities->data))
                        @foreach ($data->details_stabilities->data as $key => $datagridII)
                        <tr>
                            <td class="w-15">{{ $datagridII ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridII['stability_study_pack_details'] ?  $datagridII['stability_study_pack_details']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridII['stability_study_specification_no'] ?  $datagridII['stability_study_specification_no']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridII['stability_study_sample_description'] ?  $datagridII['stability_study_sample_description']: "Not Applicable"}}</td>
                             </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        <!-- OOS Details  -->
          <div class="block">
                <div class="block-head"> OOS Details</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                        <th style="width: 4%">Row#</th>
                                <th style="width: 8%">AR Number.</th>
                                <th style="width: 8%">Test Name of OOS</th>
                                <th style="width: 12%">Results Obtained</th>
                                <th style="width: 16%">Specification Limit</th>
                                <th style="width: 16%">Details of Obvious Error</th>
                                <!-- <th style="width: 16%">File Attachment</th> -->
                                <th style="width: 16%">Submit By</th>
                                <th style="width: 16%">Submit On</th>
                        </tr>
                        @if(($data->oos_details) && is_array($data->oos_details->data))
                        @foreach ($data->oos_details->data as $key => $datagridIII)
                        <tr>
                            <td class="w-15">{{ $datagridIII ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridIII['oos_arnumber'] ?  $datagridIII['oos_arnumber']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_test_name'] ?  $datagridIII['oos_test_name']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_results_obtained'] ?  $datagridIII['oos_results_obtained']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_specification_limit'] ?  $datagridIII['oos_specification_limit']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_details_obvious_error'] ?  $datagridIII['oos_details_obvious_error']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_submit_by'] ?  $datagridIII['oos_submit_by']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_submit_on'] ?  $datagridIII['oos_submit_on']: "Not Applicable"}}</td>
                             </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

           <!-- grid close -->
           <!-- Preliminary Lab. Investigation TapII -->
        </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> Preliminary Lab. Investigation TapII </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Comments</th>
                        <td class="w-30">{{ $data->Comments_plidata ? $data->Comments_plidata : 'Not Applicable' }}</td>
                        <th class="w-20">Justify if no Field Alert</th>
                        <td class="w-30">{{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Justify if no Analyst Int.</th>
                        <td class="w-80">{{ $data->justify_if_no_analyst_int_pli ? $data->justify_if_no_analyst_int_pli : 'Not Applicable' }}</td>
                        <th class="w-20">Phase I Investigation Required</th>
                        <td class="w-80">{{ $data->phase_i_investigation_required_pli ? $data->phase_i_investigation_required_pli : 'Not Applicable' }}</td>
                  </tr>
                 <div class="block-head">File Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->file_attachments_pli)
                            @foreach ($data->file_attachments_pli as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> CheckList - Preliminary Lab. Investigation </div>
                <table>
                 <div class="block-head">PHASE- I B INVESTIGATION REPORT</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-20">Question</th>	
                                <th class="w-80">Response </th>
                                <th class="w-80">Remarks </th>
                            </tr>
                            @if ($checklist_lab_invs)
                                    @foreach ($lab_inv_questions as $index => $lab_inv_question)
                                        <tr>
                                            <td class="flex text-center">{{ $loop->index + 1 }}</td>
                                            <td><input type="text" readonly name="question[]" value="{{ $lab_inv_question }}">
                                            </td>
                                            <td>
                                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                    <select name="checklist_lab_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                        <option value="Yes">Select an Option</option>
                                                        <option value="Yes" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                        <option value="N/A" {{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div style="margin: auto; display: flex; justify-content: center;">
                                                    <textarea name="checklist_lab_inv[{{ $loop->index }}][remark]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getArrayKey($checklist_lab_invs->data[$loop->index], 'remark') }}</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> Investigation Conclusion </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Summary of Preliminary Investigation</th>
                        <td class="w-30">{{ $data->summary_of_prelim_investiga_plic ? $data->summary_of_prelim_investiga_plic : 'Not Applicable' }}</td>
                        <th class="w-20">Root Cause Identified</th>
                        <td class="w-30">{{ $data->root_cause_identified_plic ? $data->root_cause_identified_plic : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">OOS Category-Root Cause Ident.</th>
                        <td class="w-80">{{ $data->oos_category_root_cause_ident_plic ? $data->oos_category_root_cause_ident_plic : 'Not Applicable' }}</td>
                        <th class="w-20">OOS Category (Others)</th>
                        <td class="w-80">{{ $data->oos_category_others_plic ? $data->oos_category_others_plic : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20">Root Cause Details.</th>
                        <td class="w-80">{{ $data->root_cause_details_plic ? $data->root_cause_details_plic : 'Not Applicable' }}</td>
                        <th class="w-20">OOS Category-Root Cause Ident</th>
                        <td class="w-80">{{ $data->Description_Deviation ? $data->Description_Deviation : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20">CAPA Required.</th>
                        <td class="w-80">{{ $data->capa_required_plic ? $data->capa_required_plic : 'Not Applicable' }}</td>
                        <th class="w-20">Reference CAPA No</th>
                        <td class="w-80">{{ $data->reference_capa_no_plic ? $data->reference_capa_no_plic : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20"> Delay Justification for Preliminary Investigation.</th>
                        <td class="w-80">{{ $data->delay_justification_for_pi_plic ? $data->delay_justification_for_pi_plic : 'Not Applicable' }}</td>
                  </tr>
                  <div class="block-head">Supporting Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->supporting_attachment_plic)
                            @foreach ($data->supporting_attachment_plic as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> Preliminary Lab Invstigation Review </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Review Comments</th>
                        <td class="w-30">{{ $data->review_comments_plir ? $data->review_comments_plir : 'Not Applicable' }}</td>
                        <th class="w-20">Phase II Inv. Required?</th>
                        <td class="w-30">{{ $data->phase_ii_inv_required_plir ? $data->phase_ii_inv_required_plir : 'Not Applicable' }}</td>
                    </tr>
                    <div class="block">
                        <h2>OOS Review for Similar Nature</h2>
                        <div class="block-head"> Info. On Product/ Material</div>
                        <div class="border-table">
                        <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 12%">OOS Number</th>
                            <th style="width: 16%"> OOS Reported Date</th>
                            <th style="width: 18%">Description of OOS</th>
                            <th style="width: 40%">Previous OOS Root Cause</th>
                        </tr>
                        @if(($oos_capas) && is_array($oos_capas->data))
                        @foreach ($oos_capas->data as $key => $datagridIV)
                        <tr>
                            <td class="w-2">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-8">{{ $datagridIV['info_oos_number'] ?  $datagridIV['info_oos_number']: "Not Applicable"}}</td>
                            <td class="w-10">{{ $datagridIV['info_oos_reported_date'] ?  $datagridIV['info_oos_reported_date']: "Not Applicable"}}
                            </td>
                            <td class="w-8">{{ $datagridIV['info_oos_description'] ?  $datagridIV['info_oos_description']: "Not Applicable"}}</td>
                            <td class="w-8">{{ $datagridIV['info_oos_previous_root_cause'] ?  $datagridIV['info_oos_previous_root_cause']: "Not Applicable"}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                    <div class="block">
                        <div class="block-head"> Info. On Product/ Material</div>
                        <div class="border-table">
                        <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 12%"> CAPA</th>
                            <th style="width: 16% pt-3">Closure Date of CAPA</th>
                            <th style="width: 14%">CAPA Requirement</th>
                            <th style="width: 16%">Reference CAPA Number</th>
                        </tr>
                        @if ($oos_capas)
                        @foreach ($oos_capas->data as $key => $datagridV)
                        <tr>
                            <td class="w-2">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-8">{{ $datagridV['info_oos_capa'] ?  $datagridV['info_oos_capa']: "Not Applicable"}}</td>
                            <td class="w-10">{{ $datagridV['info_oos_closure_date'] ?  $datagridV['info_oos_closure_date']: "Not Applicable"}}
                            </td>
                            <td class="w-8">{{ $datagridV['info_oos_capa_requirement'] ?  $datagridV['info_oos_capa_requirement']: "Not Applicable"}}</td>
                            <td class="w-8">{{ $datagridV['info_oos_capa_reference_number'] ?  $datagridV['info_oos_capa_reference_number']: "Not Applicable"}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
           
                  <div class="block-head">Supporting Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->supporting_attachments_plir)
                            @foreach ($data->supporting_attachments_plir as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> Phase II Investigation </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">QA Approver Comments</th>
                        <td class="w-30">{{ $data->qa_approver_comments_piii ? $data->qa_approver_comments_piii : 'Not Applicable' }}</td>
                        <th class="w-20">Manufact. Invest. Required?</th>
                        <td class="w-30">{{ $data->manufact_invest_required_piii ? $data->manufact_invest_required_piii : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Manufacturing Invest. Type</th>
                        <td class="w-80">{{ $data->manufacturing_invest_type_piii ? $data->manufacturing_invest_type_piii : 'Not Applicable' }}</td>
                        <th class="w-20">Audit Comments</th>
                        <td class="w-80">{{ $data->audit_comments_piii ? $data->audit_comments_piii : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20">Hypo/Exp. Required.</th>
                        <td class="w-80">{{ $data->hypo_exp_required_piii ? $data->hypo_exp_required_piii : 'Not Applicable' }}</td>
                        <th class="w-20">Hypo/Exp. Reference</th>
                        <td class="w-80">{{ $data->hypo_exp_reference_piii ? $data->hypo_exp_reference_piii : 'Not Applicable' }}</td>
                  </tr>
                  <div class="block-head"> Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->file_attachments_pII)
                            @foreach ($data->file_attachments_pII as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> CheckList - Phase II Investigation</div>
                <table>
                <div class="block">
                <div class="block-head"> PHASE II OOS INVESTIGATION</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($phase_two_invs)
                        @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                       
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $phase_two_inv_question }}</td>
                            <td>
                                <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                    <select name="phase_two_inv[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                        <option value="Yes">Select an Option</option>
                                        <option value="Yes" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                        <option value="N/A" {{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                    </select>
                                </div>
                            </td>
                            <td class="w-15">{{ Helpers::getArrayKey($phase_two_invs->data[$loop->index], 'remarks') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

           <!-- grid close -->
           <!-- Preliminary Lab. Investigation TapII -->
        </div>
    </div>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head"> Summary of Phase II Testing </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Summary of Exp./Hyp.</th>
                        <td class="w-30">{{ $data->summary_of_exp_hyp_piiqcr ? $data->summary_of_exp_hyp_piiqcr : 'Not Applicable' }}</td>
                        <th class="w-20">Summary Mfg. Investigation</th>
                        <td class="w-30">{{ $data->summary_mfg_investigation_piiqcr ? $data->summary_mfg_investigation_piiqcr : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Root Casue Identified.</th>
                        <td class="w-80">{{ $data->root_casue_identified_piiqcr ? $data->root_casue_identified_piiqcr : 'Not Applicable' }}</td>
                        <th class="w-20">OOS Category-Reason identified </th>
                        <td class="w-80">{{ $data->oos_category_reason_identified_piiqcr ? $data->oos_category_reason_identified_piiqcr : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20">Others (OOS category).</th>
                        <td class="w-80">{{ $data->others_oos_category_piiqcr ? $data->others_oos_category_piiqcr : 'Not Applicable' }}</td>
                        <th class="w-20">Details of Root Cause</th>
                        <td class="w-80">{{ $data->details_of_root_cause_piiqcr ? $data->details_of_root_cause_piiqcr : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-20">Impact Assessment.</th>
                        <td class="w-80">{{ $data->hypo_exp_required_piii ? $data->hypo_exp_required_piii : 'Not Applicable' }}</td>
                  </tr>
                  
                  <div class="block-head"> Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->attachments_piiqcr)
                            @foreach ($data->attachments_piiqcr as $key => $file)
                                 <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-20">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                      </div>
                </table>
            </div>
    </div>
    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>
