<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
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

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    OOS Microbiology Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt=""
                            class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong> OOS Microbiology No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>
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
            <!-- start block -->
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
                        <th class="w-20">Short Description</th>
                        <td class="w-80">@if($data->description_gi){{ $data->description_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_group){{ $data->initiator_group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-80">{{ $data->initiator_group_code }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiated Through ?</th>
                        <td class="w-80">{{ $data->initiated_through_gi }}</td>
                    </tr>
                    <tr>
                       <th class="w-20">If Others</th>
                        <td class="w-80">@if($data->if_others_gi){{ $data->if_others_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Is Repeat </th>
                        <td class="w-80">@if($data->is_repeat_gi){{ $data->is_repeat_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature_gi){{ $data->repeat_nature_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Nature of Change</th>
                        <td class="w-80">@if($data->nature_of_change_gi){{ $data->nature_of_change_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Deviation Occurred On</th>
                        <td class="w-80">@if($data->deviation_occured_on_gi){{ $data->deviation_occured_on_gi }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class="w-20">Source Document Type</th>
                        <td class="w-80">@if($data->source_document_type_gi){{ $data->source_document_type_gi }}@else Not Applicable @endif</td>
                    </tr>
                     <tr>
                        <th class="w-20">Reference System Document </th>
                        <td class="w-80"></td>
                        <th class="w-20">Reference Document </th>
                        <td class="w-80"></td>
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
                    
                <div class="block-head">OOS Microbiology Initial Attachement</div>
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
           <div class="block">
                <div class="block-head"> Preliminary Lab. Investigation TapII </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-10">Comments</th>
                        <td class="w-90">{{ $data->comments_pli ? $data->comments_pli : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-10">Field Alert Required</th>
                        <td class="w-90">{{ $data->field_alert_required_pli ? $data->field_alert_required_pli : 'Not Applicable' }}</td>
                        <th class="w-10">Field Alert Ref.No.</th>
                        <td class="w-90">Not Applicable</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-10">Justify if no Field Alert</th>
                        <td class="w-90">{{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-10">Verification Analysis Required.</th>
                        <td class="w-90">{{ $data->verification_analysis_required_pli ? $data->verification_analysis_required_pli : 'Not Applicable' }}</td>
                        <th class="w-10">Verification Analysis Ref.</th>
                        <td class="w-90"> Not Applicable</td>
                    </tr>
                    <tr> 
                        <th class="w-10">Analyst Interview Req.</th>
                        <td class="w-90">{{ $data->analyst_interview_req_pli ? $data->analyst_interview_req_pli : 'Not Applicable' }}</td>
                        <th class="w-10">Analyst Interview Ref. </th>
                        <td class="w-90">Not Applicable</td>
                    </tr>
                    <tr>  
                        <th class="w-20">Justify if no Analyst Int.</th>
                        <td class="w-80">{{ $data->justify_if_no_analyst_int_pli ? $data->justify_if_no_analyst_int_pli : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Phase I Investigation Required</th>
                        <td class="w-80">{{ $data->phase_i_investigation_required_pli ? $data->phase_i_investigation_required_pli : 'Not Applicable' }}</td>
                        <th class="w-20">Phase I Investigation</th>
                        <td class="w-80">{{ $data->phase_i_investigation_pli ? $data->phase_i_investigation_pli : 'Not Applicable' }}</td>
                        <th class="w-20">Phase I Investigation Ref.</th>
                        <td class="w-80">Not Applicable</td>
                    </tr>
                  <!-- -->
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
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
           
                <div class="block">
                <div class="block-head">  CheckList - Preliminary Lab. Investigation </div>
                <div class="border-table">
                <div class="block-head">PHASE- I B INVESTIGATION REPORT</div>
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
                    <table>
                        <tr class="table_bg">
                            <th class="w-10">S.N.</th>
                            <th class="w-40">Question</th>	
                            <th class="w-15">Response </th>
                            <th class="w-35">Remarks </th>
                        </tr>
                        @foreach ($phase_I_investigations as $phase_I_investigation )
                        <tr>
                            <td class="w-10">{{ $loop->index+1 }}</td>
                            <td class="w-40">{{ $phase_I_investigation }}</td>
                            <td class="w-15">{{ Helpers::getMicroGridData($data, 'phase_IB_investigation', true, 'response', true, $loop->index) }}</td>
                            <td class="w-35">{{ Helpers::getMicroGridData($data, 'phase_IB_investigation', true, 'remark', true, $loop->index) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
           <!-- Preliminary Lab. Investigation TapII -->
        
            <div class="block">
                <div class="block-head"> Investigation Conclusion </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Summary of Preliminary Investigation</th>
                        <td class="w-30">{{ $data->summary_of_prelim_investiga_plic ? $data->summary_of_prelim_investiga_plic : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Root Cause Identified</th>
                        <td class="w-30">{{ $data->root_cause_identified_plic ? $data->root_cause_identified_plic : 'Not Applicable' }}</td>
                        <th class="w-20">OOS Category-Root Cause Ident.</th>
                        <td class="w-80">{{ $data->oos_category_root_cause_ident_plic ? $data->oos_category_root_cause_ident_plic : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">OOS Category (Others)</th>
                        <td class="w-80">{{ $data->oos_category_others_plic ? $data->oos_category_others_plic : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Root Cause Details.</th>
                        <td class="w-80">{{ $data->root_cause_details_plic ? $data->root_cause_details_plic : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">OOS Category-Root Cause Ident</th>
                        <td class="w-80">{{ $data->Description_Deviation ? $data->Description_Deviation : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Recommended Actions Required?</th>
                        <td class="w-80">{{ $data->recommended_actions_required_plic ? $data->recommended_actions_required_plic : 'Not Applicable' }}</td>
                        <th class="w-20">Recommended Actions Reference</th>
                        <td class="w-80">{{ $data->recommended_actions_required_plic ? $data->recommended_actions_required_plic : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Required.</th>
                        <td class="w-80">{{ $data->capa_required_plic ? $data->capa_required_plic : 'Not Applicable' }}</td>
                        <th class="w-20">Reference CAPA No</th>
                        <td class="w-80">{{ $data->reference_capa_no_plic ? $data->reference_capa_no_plic : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                        <th class="w-80"> Delay Justification for Preliminary Investigation.</th>
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
            <div class="block">
                <div class="block-head"> Preliminary Lab Invstigation Review </div>
                <div class="border-table">
                <table>
                    <tr>
                        <th class="w-20">Review Comments</th>
                        <td class="w-30">{{ $data->review_comments_plir ? $data->review_comments_plir : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  
                        <th class="w-20">Phase II Inv. Required?</th>
                        <td class="w-30">{{ $data->phase_ii_inv_required_plir ? $data->phase_ii_inv_required_plir : 'Not Applicable' }}</td>
                    </tr>
                </table>
                </div> 
                <h2>OOS Review for Similar Nature</h2>
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 30%">OOS Number</th>
                            <th style="width: 30%"> OOS Reported Date</th>
                            <th style="width: 40%">Description of OOS</th>
                            <th style="width: 20%">Previous OOS Root Cause</th>
                            <th style="width: 20%"> CAPA</th>
                            <th style="width: 20% pt-3">Closure Date of CAPA</th>
                            <th style="width: 16%">Reference CAPA Number</th>
                        </tr>
                        @if(($oos_capas) && is_array($oos_capas->data))
                            @foreach ($oos_capas->data as $key => $datagridIV)
                            <tr>
                                <td class="w-10">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                                <td class="w-10">{{ $datagridIV['info_oos_number'] ?  $datagridIV['info_oos_number']: "Not Applicable"}}</td>
                                <td class="w-30">{{ $datagridIV['info_oos_reported_date'] ?  $datagridIV['info_oos_reported_date']: "Not Applicable"}}</td>
                                <td class="w-40">{{ $datagridIV['info_oos_description'] ?  $datagridIV['info_oos_description']: "Not Applicable"}}</td>
                                <td class="w-0">{{ $datagridIV['info_oos_previous_root_cause'] ?  $datagridIV['info_oos_previous_root_cause']: "Not Applicable"}}</td>
                                <td class="w-8">{{ $datagridIV['info_oos_capa'] ?  $datagridIV['info_oos_capa']: "Not Applicable"}}</td>
                                <td class="w-10">{{ $datagridIV['info_oos_closure_date'] ?  $datagridIV['info_oos_closure_date']: "Not Applicable"}}</td>
                                <td class="w-8">{{ $datagridIV['info_oos_capa_reference_number'] ?  $datagridIV['info_oos_capa_reference_number']: "Not Applicable"}}</td>
                           
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
                        </tr>
                        @endif
                    </table>
                </div>
                <div class="block-head"> Info. On Product/ Material</div>
                 <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Row#</th>
                            <th style="width: 14%">CAPA Requirement</th>
                        </tr>
                        @if ($oos_capas)
                           @foreach ($oos_capas->data as $key => $datagridV)
                            <tr>
                                <td class="w-2">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                                <td class="w-8">{{ $datagridV['info_oos_capa_requirement'] ?  $datagridV['info_oos_capa_requirement']: "Not Applicable"}}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
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
                </div>
              </table>
            </div>
            <!--Start Checklist - Investigation of Bacterial Endotoxin Test CCForm18 -->
            <div class="block">
               <div class="block-head"> Checklist for Review of Training records Analyst Involved in Testing </div>
               <div class="block-head"> Checklist for Sample receiving & verification in lab : </div>
                  <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'sample_receiving_verification_lab', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'sample_receiving_verification_lab', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
            <!-- Checklist - Investigation of Sterility CCForm19-->
            <div class="block">
                <div class="block-head"> Checklist - Investigation of Sterility: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'method_procedure_used_during_analysis', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'method_procedure_used_during_analysis', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Instrument/Equipment Details: </div>
                <div class="border-table">
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
                <table>
                    <tr class="table_bg">
                        <th style="width: 5%;">Sr.No.</th>
                        <th style="width: 40%;">Question</th>
                        <th style="width: 20%;">Response</th>
                        <th>Remarks</th>
                    </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'Instrument_Equipment_Det', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'Instrument_Equipment_Det', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <div class="block-head">If Yes, Provide attachment details</div>
            <div class="border-table">
            <table>
                <tr class="table_bg">
                    <th class="w-20">S.N.</th>
                    <th class="w-80">File </th>
                </tr>
                @if ($data->attachment_details_cis)
                @foreach ($data->attachment_details_cis as $file)
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
            <!--  Checklist3 - Investigation of Microbial limit test/Bioburden and Water Test CCForm20-->
            <div class="block">
                <div class="block-head"> Checklist - Investigation of Microbial limit test/Bioburden and Water Test </div>
                <div class="block-head"> Checklist for Review of Training records Analyst Involved in Testing </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_for_Review_of_Training_records_Analyst', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Review of sampling and Transportation procedures: </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_for_Review_of_sampling_and_Transport', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Review of Test Method & procedure:: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
                        @php
                            $main_question_index = 3.0;
                            $sub_question_index = 0;
                        @endphp
                        @foreach ($Checklist_Review_of_Test_Method_proceds as $index => $Checklist_Review_of_Test_Method_proced)
                        @php
                            if ($Checklist_Review_of_Test_Method_proced['is_sub_question']) {
                                $sub_question_index++;
                            } else {
                                $sub_question_index = 0;
                                $main_question_index += 0.1;
                            }
                        @endphp
                            <tr>
                                <td class="flex text-center">{{ $Checklist_Review_of_Test_Method_proced['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                <td>{{$Checklist_Review_of_Test_Method_proced['question']}}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_Review_of_Test_Method_proced', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_Review_of_Test_Method_proced', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">Checklist for Review of microbial isolates /Contamination: </div>
                    <div class="border-table"> 
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'Review_of_Media_Buffer_Standards_prep', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Review_of_Media_Buffer_Standards_prep', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Review of Media preparation, RTU media and Test Accessories:                    : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
                        @php
                            $main_question_index = 5.0;
                            $sub_question_index = 0;
                        @endphp

                        @foreach ($Checklist_for_Review_Media_prepara_RTU_medias as $index => $Checklist_for_Review_Media_prepara_RTU_media)
                        @php
                            if ($Checklist_for_Review_Media_prepara_RTU_media['is_sub_question']) {
                                $sub_question_index++;
                            } else {
                                $sub_question_index = 0;
                                $main_question_index += 0.1;
                            }
                        @endphp
                           <tr>
                                <td class="flex text-center">{{ $Checklist_for_Review_Media_prepara_RTU_media['is_sub_question'] ? $main_question_index .'.'. $sub_question_index : number_format($main_question_index, 1) }}</td>
                                <td>{{$review_item['question']}}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'media_prepara_RTU', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'media_prepara_RTU', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Review of Environmental condition in the testing area: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
                        @php
                            $main_question_index = 6.0;
                            $sub_question_index = 0;
                        @endphp
                        @foreach ($Checklist_Review_Environment_condition_in_tests as $index => $Checklist_Review_Environment_condition_in_test)
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
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_Review_Environment_condition_in_test', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'Checklist_Review_Environment_condition_in_test', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Review of Instrument/Equipment:: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'review_of_instrument_bioburden_and_waters', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'review_of_instrument_bioburden_and_waters', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Disinfectant Details: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_of_bioburden_and_water_test', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_of_bioburden_and_water_test', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                
                <div class="block-head">If Yes, Provide attachment details </div>
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
            </div>
            <!-- Checklist - Investigation of Microbial assay CCForm21----------------->
            <div class="block">
                <div class="block-head"> Checklist - Investigation of Microbial assay </div>
                <div class="block-head">Checklist for Review of Training records Analyst Involved in Testing: </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'training_records_analyst_involvedIn_testing_microbial_asssay', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Review of sample intactness before analysis ? </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'sample_intactness_before_analysis', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'sample_intactness_before_analysis', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Review of test methods & Procedures: </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'checklist_for_review_of_test_method_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'checklist_for_review_of_test_method_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Review of Media, Buffer, Standards preparation & test accessories: </div>
                    <div class="border-table"> 
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'cr_of_media_buffer_st_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'cr_of_media_buffer_st_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div> 
                <div class="block-head"> Checklist for Review of Microbial cultures/Inoculation (Test organism): </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_microbial_cultures_inoculation_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Review of Environmental conditions in the testing area : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_Environmental_condition_in_testing_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Review of instrument/equipment: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_instru_equipment_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'CR_of_instru_equipment_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Disinfectant Details: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_IMA', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_IMA', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">If Yes, Provide attachment details </div>
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
            </div>
            <!-- Checklist - Investigation of Environmental Monitoring CCForm22----------------->
            <div class="block">
                <div class="block-head"> Checklist - Investigation of Environmental Monitoring </div>
                <div class="block-head">Checklist for review of Training records Analyst Involved in monitoring: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_training_rec_anaylst_in_monitoring_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for sample details: </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'Check_for_Sample_details_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'Check_for_Sample_details_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for comparison of results with other parameters: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'Check_for_comparision_of_results_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'Check_for_comparision_of_results_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for details of media dehydrated media used: </div>
                    <div class="border-table"> 
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                                <td>{{ Helpers::getMicroGridData($data, 'checklist_for_media_dehydrated_CIEMs', true, 'response', true, $index) ?? '' }}</td>
                                <td>{{ Helpers::getMicroGridData($data, 'checklist_for_media_dehydrated_CIEMs', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div> 
                <div class="block-head"> Checklist for media preparation details and sterilization: </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_media_prepara_sterilization_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for review of environmental conditions in the testing area : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_En_condition_in_testing_CIEMs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_En_condition_in_testing_CIEMs', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for disinfectant Details: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'check_for_disinfectant_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'check_for_disinfectant_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for fogging details : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_fogging_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_fogging_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for review of Test Method & procedure: : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_test_method_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_test_method_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification) </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'CR_microbial_isolates_contamination_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'CR_microbial_isolates_contamination_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for review of Instrument/Equipment: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_instru_equip_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'CR_of_instru_equip_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">Checklist for trend Analysis: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'Ch_Trend_analysis_CIEM', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'Ch_Trend_analysis_CIEM', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                
                 <div class="block-head">If Yes, Provide attachment details </div>
                    <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File </th>
                        </tr>
                        @if ($data->attachment_details_ciem)
                        @foreach ($data->attachment_details_ciem as $key => $file)
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
            </div>
            <!-- Checklist - Investigation of MediaSuitability Test CCForm23----------------->
            <div class="block">
                <div class="block-head"> Checklist - Investigation of MediaSuitability Test </div>
                <div class="block-head"> Checklist for Analyst training & Procedure: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_analyst_training_CIMT', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_analyst_training_CIMT', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Comparison of results (With same & Previous Day Media GPT) : </div>
                    <div class="border-table">
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_comp_results_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_comp_results_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Culture verification ? </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_Culture_verification_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_Culture_verification_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Sterilize Accessories: </div>
                    <div class="border-table"> 
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

                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'sterilize_accessories_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'sterilize_accessories_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div> 
                <div class="block-head"> Checklist for Instrument/Equipment Details: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_intrument_equip_last_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_intrument_equip_last_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="block-head">  Checklist for Disinfectant Details: </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_last_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'disinfectant_details_last_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="block-head"> Checklist for Results and Calculation : </div>
                    <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr> 
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
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_result_calculation_CIMTs', true, 'response', true, $index) ?? '' }}</td>
                            <td>{{ Helpers::getMicroGridData($data, 'checklist_for_result_calculation_CIMTs', true, 'remark', true, $index) ?? '' }}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                
                 <div class="block-head">If Yes, Provide attachment details </div>
                    <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File </th>
                        </tr>
                        @if ($data->attachment_details_cimst)
                        @foreach ($data->attachment_details_cimst as $key => $file)
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
            </div>
        <!-- ====================== close CheckList Part ==================-->
        <div class="block">
                <div class="block-head"> Phase II Investigation </div>
                <table>
                    <tr> 
                        <th class="w-20">QA Approver Comments</th>
                        <td class="w-30">{{ $data->qa_approver_comments_piii ? $data->qa_approver_comments_piii : 'Not Applicable' }}</td>
                    </tr>
                   <tr>
                        <th class="w-20">Manufact. Invest. Required?</th>
                        <td class="w-30">{{ $data->manufact_invest_required_piii ? $data->manufact_invest_required_piii : 'Not Applicable' }}</td>
                        <th class="w-20">Manufacturing Invest. Type</th>
                        <td class="w-80">No Applicable</td>
                   </tr>
                   <tr>
                        <th class="w-20">Manufacturing Invst. Ref.</th>
                        <td class="w-30">{{ $data->manufact_invest_required_piii ? $data->manufact_invest_required_piii : 'Not Applicable' }}</td>
                        <th class="w-20">Re-sampling Required?</th>
                        <td class="w-80">{{ $data->re_sampling_required_piii ? $data->re_sampling_required_piii : 'Not Applicable' }}
                            </td>
                   </tr>
                 <tr>
                    <th class="w-20">Audit Comments</th>
                    <td class="w-80">{{ $data->audit_comments_piii ? $data->audit_comments_piii : 'Not Applicable' }}</td>
                </tr>
                <tr>
                    <th class="w-20">Re-sampling Ref. No.</th>
                    <td class="w-80">No Applicable</td>
                </tr>    
                <tr>
                    <th class="w-20">Hypo/Exp. Required.</th>
                    <td class="w-80">{{ $data->hypo_exp_required_piii ? $data->hypo_exp_required_piii : 'Not Applicable' }}</td>
                    <th class="w-20">Hypo/Exp. Reference</th>
                    <td class="w-80">No Applicable </td>
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
                <div class="block-head">Checklist PHASE II OOS INVESTIGATION</div>
                <div class="border-table">
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
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($phase_II_OOS_investigations)
                        @foreach ($phase_II_OOS_investigations as $phase_II_OOS_investigation)
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $phase_II_OOS_investigation }}</td>
                            <td class="w-15">{{ Helpers::getMicroGridData($data, 'phase_II_OOS_investigations', true, 'response', true, $loop->index) }}</td>
                            <td class="w-35">{{ Helpers::getMicroGridData($data, 'phase_II_OOS_investigations', true, 'remark', true, $loop->index) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            Not Applicable
                        </tr>
                        @endif
                    </table>
                </div>
            </div>    
        <div class="block">
                <div class="block-head"> Summary of Phase II Testing </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Summary of Exp./Hyp.</th>
                        <td class="w-30">{{ $data->summary_of_exp_hyp_piiqcr ? $data->summary_of_exp_hyp_piiqcr : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
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
            <div class="block">
                <div class="block-head"> Additional Testing Proposal by QA </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Review Comment.</th>
                        <td class="w-30">{{ $data->review_comment_atp ? $data->review_comment_atp : 'Not Applicable' }}</td>
                        <th class="w-20">Additional Test Proposal</th>
                        <td class="w-30">{{ $data->additional_test_proposal_atp ? $data->additional_test_proposal_atp : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Additional Test Comment.</th>
                        <td class="w-80"></td>
                    </tr>
                    <tr>
                        <th class="w-20">Any Other Actions Required </th>
                        <td class="w-80">{{ $data->any_other_actions_required_atp ? $data->any_other_actions_required_atp : 'Not Applicable' }}</td>
                    </tr>
                   
                  <div class="block-head"> Additional Testing Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->additional_testing_attachment_atp)
                            @foreach ($data->additional_testing_attachment_atp as $key => $file)
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
            <div class="block">
                <div class="block-head"> OOS Conclusion </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Conclusion Comments.</th>
                        <td class="w-30">{{ $data->conclusion_comments_oosc ? $data->conclusion_comments_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Specification Limit</th>
                        <td class="w-30">{{ $data->specification_limit_oosc ? $data->specification_limit_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Results to be Reported</th>
                        <td class="w-80">{{ $data->results_to_be_reported_oosc ? $data->results_to_be_reported_oosc : 'Not Applicable' }}</td>
                        <th class="w-20">Final Reportable Results</th>
                        <td class="w-80">{{ $data->final_reportable_results_oosc ? $data->final_reportable_results_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Justifi. for Averaging Results</th>
                        <td class="w-80">{{ $data->justifi_for_averaging_results_oosc ? $data->justifi_for_averaging_results_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  
                        <th class="w-20">OOS Stands</th>
                        <td class="w-80">{{ $data->oos_stands_oosc ? $data->oos_stands_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Req.</th>
                        <td class="w-80">{{ $data->capa_req_oosc ? $data->capa_req_oosc : 'Not Applicable' }}</td>
                        <th class="w-20">CAPA Ref No.</th>
                        <td class="w-80"></td>
                    </tr>
                    <tr>
                        <th class="w-20"> Justify if CAPA not required.</th>
                        <td class="w-80">{{ $data->justify_if_capa_not_required_oosc ? $data->justify_if_capa_not_required_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  
                        <th class="w-20"> Action Item Req..</th>
                        <td class="w-80">{{ $data->action_plan_req_oosc ? $data->action_plan_req_oosc : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20"> Action Item Ref..</th>
                        <td class="w-80"></td>
                    </tr>
                    <tr>
                        <th class="w-20">Justification for Delay.</th>
                        <td class="w-80">{{ $data->justification_for_delay_oosc ? $data->justification_for_delay_oosc : 'Not Applicable' }}</td>
                    </tr>
                    </table>
                    <div class="block">
                        <div class="block-head"> Summary of OOS Test Results </div>
                        <div class="border-table">
                        <table>
                                <tr class="table_bg">
                                    <th style="width: 4%">Row#</th>
                                        <th style="width: 14%">Analysis Detials</th>
                                        <th style="width: 10%">Hypo./Exp./Add.Test PR No.</th>
                                        <th style="width: 10%">Results</th>
                                        <th style="width: 10%">Analyst Name.</th>
                                        <th style="width: 16%">Remarks</th>
                                </tr>
                                @if ($oos_conclusions)
                                @foreach ($oos_conclusions->data as $key => $oos_conclusion)
                                <tr>
                                    <td style="width: 8%">{{$loop->index + 1 }}</td>
                                    <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analysis_detials') }}</td>
                                    <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_hypothesis_experimentation_test_pr_no') }}</td>
                                    <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion, 'summary_results') }}</td>
                                    <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analyst_name') }}</td>
                                    <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_remarks') }}</td> 
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
                    <div class="block-head"> Attachments if Any </div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->file_attachments_if_any_ooscattach)
                            @foreach ($data->file_attachments_if_any_ooscattach as $key => $file)
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
            <div class="block">
                <div class="block-head"> Conclusion Review Comments </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Conclusion Review Comments</th>
                        <td class="w-30">{{ $data->conclusion_review_comments_ocr ? $data->conclusion_review_comments_ocr : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Action Taken on Affec.batch</th>
                        <td class="w-30">{{ $data->action_taken_on_affec_batch_ocr ? $data->action_taken_on_affec_batch_ocr : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Req</th>
                        <td class="w-80">{{ $data->capa_req_ocr ? $data->capa_req_ocr : 'Not Applicable' }}</td>
                        <th class="w-20">CAPA Reference</th>
                        <td class="w-80">CAPA Reference</td>
                    </tr>
                    <tr>
                        <th class="w-20">Justify if No Risk Assessment</th>
                        <td class="w-80">{{ $data->justify_if_no_risk_assessment_ocr ? $data->justify_if_no_risk_assessment_ocr : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CQ Approver</th>
                        <td class="w-80">{{ $data->cq_approver ? $data->cq_approver : 'Not Applicable' }}</td>
                    </tr>
                    </table>
                    <div class="block">
                        <div class="block-head"> Summary of OOS Test Results </div>
                        <div class="border-table">
                        <table>
                                <tr class="table_bg">
                                    <th style="width: 4%">Row#</th>
                                    <th style="width: 8%">Material/Product Name</th>
                                    <th style="width: 8%">Batch No.(s) / A.R. No. (s)</th>
                                    <th style="width: 8%">Any Other Information</th>
                                    <th style="width: 16%">Action Taken on Affec.batch</th>
                                </tr>
                                @if ($oos_conclusion_reviews)
                                @foreach ($oos_conclusion_reviews->data as $key => $oos_conclusion_review)
                                    <tr>
                                        <td style="width: 8%">{{ $loop->index + 1 }}</td>
                                        <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_product_name') }}</td>
                                        <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_batch_no') }}</td>
                                        <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_any_other_information') }}</td>
                                        <td style="width: 8%">{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_action_affecte_batch') }}</td>
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
                    <div class="block-head">Conclusion Attachment </div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->conclusion_attachment_ocr)
                            @foreach ($data->conclusion_attachment_ocr as $key => $file)
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
            <div class="block">
                <div class="block-head"> OOS QA Review </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">CQ Review Comments</th>
                        <td class="w-30">{{ $data->cq_review_comments_ocqr ? $data->cq_review_comments_ocqr : 'Not Applicable' }}</td>
                    </tr>
                    
                  <div class="block-head"> CQ Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->cq_attachment_ocqr)
                            @foreach ($data->cq_attachment_ocqr as $key => $file)
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
            <div class="block">
                <div class="block-head">Batch Disposition</div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">OOS Category</th>
                        <td class="w-30">{{ $data->oos_category_bd ? $data->oos_category_bd : 'Not Applicable' }}</td>
                        <th class="w-20">Other's</th>
                        <td class="w-30">{{ $data->others_bd ? $data->others_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Material/Batch Release</th>
                        <td class="w-30">{{ $data->material_batch_release_bd ? $data->material_batch_release_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>   
                        <th class="w-20">Other Action (Specify)</th>
                        <td class="w-30">{{ $data->other_action_bd ? $data->other_action_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20"> Other Parameters Results</th>
                        <td class="w-30">{{ $data->other_parameters_results_bd ? $data->other_parameters_results_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                         <th class="w-20">Trend of Previous Batches</th>
                        <td class="w-30">{{ $data->trend_of_previous_batches_bd ? $data->trend_of_previous_batches_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20"> Stability Data</th>
                        <td class="w-30">{{ $data->stability_data_bd ? $data->stability_data_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Process Validation Data</th>
                        <td class="w-30">{{ $data->process_validation_data_bd ? $data->process_validation_data_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20"> Method Validation </th>
                        <td class="w-30">{{ $data->method_validation_bd ? $data->method_validation_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Any Market Complaints</th>
                        <td class="w-30">{{ $data->any_market_complaints_bd ? $data->any_market_complaints_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20"> Statistical Evaluation </th>
                        <td class="w-30">{{ $data->statistical_evaluation_bd ? $data->statistical_evaluation_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Risk Analysis for Disposition</th>
                        <td class="w-30">{{ $data->risk_analysis_disposition_bd ? $data->risk_analysis_disposition_bd : 'Not Applicable' }}</td>
                    </tr>
                    
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20"> Conclusion </th>
                        <td class="w-30">{{ $data->conclusion_bd ? $data->conclusion_bd : 'Not Applicable' }}</td>
                    </tr>
                    <tr> 
                        <th class="w-20">Justify for Delay in Activity</th>
                        <td class="w-30">{{ $data->justify_for_delay_in_activity_bd ? $data->justify_for_delay_in_activity_bd : 'Not Applicable' }}</td>
                    </tr>
                        <div class="block-head">Disposition Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->disposition_attachment_bd)
                            @foreach ($data->disposition_attachment_bd as $key => $file)
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
            <div class="block">
                <div class="block-head">  QA Head/designee Approval </div>
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Approval Comment</th>
                        <td class="w-30">{{ $data->reopen_approval_comments_uaa ? $data->reopen_approval_comments_uaa : 'Not Applicable' }}</td>
                    </tr>
                    
                  <div class="block-head"> Approval Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File </th>
                            </tr>
                            @if ($data->addendum_attachment_uaa)
                            @foreach ($data->addendum_attachment_uaa as $key => $file)
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
    <!-- close block -->
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
