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
    @page {
         margin: 160px 35px 100px; /* top header, side margin, bottom footer */
     }
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
        margin-top: 10px;
         margin-bottom: -60px; 
    }

    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        /* padding: 20px 35px; */
        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: 0;
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }
    /* To remove borders from content part only */
    .content-area table {
        border: none !important;
    }

    .inner-block {
        /* padding: 20px 35px;  */
        box-sizing: border-box;
    }
    
    .block {
        margin-bottom: 25px;
    }

    .block-head {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 2px solid #387478;
        color: #387478;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .table_bg {
        background-color: #387478;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    th, td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
         white-space: normal !important;
    word-wrap: break-word;
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-6 { width: 7%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-40 { width: 40%; }
    .w-50 { width: 50%; }
    .w-60 { width: 60%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }

    table th, table td {
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                     OOS/OOT Report
                    </div>
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong> OOS/OOT No.</strong>
                </td>
                <td class="w-40">
                {{ Helpers::getDivisionName($data->division_id) }}/{{ $data->Form_type }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '1' }}

                  {{--{{ Helpers::getDivisionName(session()->get('division')) }}/OOS/OOT/{{ date('Y') }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}--}}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

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
                <div class="block-head">General Information </div>
                <table>
                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-30">{{ $data->Form_type }}</td>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::getDivisionName($data->division_id) }}/{{ $data->Form_type }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '1' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">{{ Helpers::getDivisionName($data->division_id) }}</td>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="20">Short Description</th>
                        <td class="80">@if($data->description_gi ){{ $data->description_gi  }} @else Not Applicable @endif</td>
                    </tr>
                </table>
                <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if($data->initiator_group)
                                {{ $data->initiator_group }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiation Department Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                        <!-- <th class="w-20">If Others</th>
                        <td class="w-80">@if($data->if_others_gi){{ $data->if_others_gi }}@else Not Applicable @endif</td> -->
                    <tr>    
                        <th class="w-20">Is Repeat</th>
                        <td class="w-80">@if($data->is_repeat_gi){{ $data->is_repeat_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Source Document Type</th>
                        <td class="w-80">@if($data->source_document_type_gi){{ $data->source_document_type_gi }}@else Not Applicable @endif</td>
                    </tr>
                    </table>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Reference System Document</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->reference_system_document_gi ){{ $data->reference_system_document_gi  }} @else Not Applicable @endif</span>
                    </div> --}}

                    <div class="block">
                    <table>
                    <tr>
                        <th class="w-20">Reference System Document</th>
                        <td class="w-30">@if($data->reference_system_document_gi ){{ $data->reference_system_document_gi  }} @else Not Applicable @endif</td>

                        <th class="w-20">Reference Document</th>
                        <td class="w-30">@if($data->reference_document){{ $data->reference_document }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">OOS/OOT Occurred On</th>
                        <td class="w-30">
                            @if($data->deviation_occured_on_gi)
                                {{ Helpers::getdateFormat($data->deviation_occured_on_gi) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">OOS/OOT Observed On</th>
                        <td class="w-30">
                            @if($data->oos_observed_on)
                              {{ Helpers::getdateFormat($data->oos_observed_on) }}
                            @else 
                               Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Delay Justification</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->delay_justification ){{ $data->delay_justification }} @else Not Applicable @endif</span>
                    </div> --}}
                    <table>
                        <tr>
                            <th class="w-20">Delay Justification</th>
                            <td class="w-30">@if($data->delay_justification ){{ $data->delay_justification }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                    <div class="block">
                    <table>
                    <tr>
                        <th class="w-20">OOS/OOT Reported On</th>
                        <td class="w-30">@if($data->oos_reported_date){{ Helpers::getdateFormat($data->oos_reported_date) }}@else Not Applicable @endif </td>
                        <th></th>
                        <td></td>
                    </tr>
                </table>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Immediate Action</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->immediate_action ){{ $data->immediate_action  }} @else Not Applicable @endif</span>
                </div> --}}
                <table>
                    <tr>
                        <th>Immediate Action</th>
                        <td>@if($data->immediate_action ){{ $data->immediate_action  }} @else Not Applicable @endif</td>
                    </tr>
                </table>

                <div class="block-head">Initial Attachement</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60"> Attachement </th>
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
                      </div><br>

                <div class="block-head">OOS/OOT Information</div>
                <table>
                    <tr>
                        <th class="w-20">Sample Type</th>
                        <td class="w-80">@if($data->sample_type_gi){{ Helpers::recordFormat($data->sample_type_gi) }}@else Not Applicable @endif</td>
                        <th class="w-20">Product / Material Name</th>
                        <td class="w-80">@if($data->product_material_name_gi){{ Helpers::recordFormat($data->product_material_name_gi) }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Market</th>
                        <td class="w-80">@if($data->market_gi){{ $data->market_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Customer</th>
                        <td class="w-80">@if($data->customer_gi){{ $data->customer_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Specification Details</th>
                        <td class="w-80">@if($data->specification_details){{ Helpers::recordFormat($data->specification_details) }}@else Not Applicable @endif</td>
                        <th class="w-20">STP Details</th>
                        <td class="w-80">@if($data->STP_details){{ Helpers::recordFormat($data->STP_details) }}@else Not Applicable @endif</td>
                    </tr>
                </table>   
                <table> 
                    <tr>
                        <th class="w-20">Manufacture/Vendor</th>
                        <td class="w-80">@if($data->manufacture_vendor){{ Helpers::recordFormat($data->manufacture_vendor) }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <!-- Allgrid -->
            <!-- Info. On Product/ Material -->

            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 10%">Item/Product Code</th>
                            <th style="width: 8%"> Batch No</th>
                            <th style="width: 8%"> Mfg.Date</th>
                            <th style="width: 8%">Expiry Date</th>
                            <th style="width: 8%"> Label Claim.</th>
                            <th style="width: 8%">Pack Size</th>
                        </tr>
                        @if($data->info_product_materials && is_array($data->info_product_materials->data))
                            @foreach ($data->info_product_materials->data as $key => $datagridI)
                                <tr>
                                    <td class="w-15">{{ $datagridI ? $key + 1  : "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_product_code'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_batch_no'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">
                                        {{ isset($datagridI['info_mfg_date']) ? Helpers::getdateFormat($datagridI['info_mfg_date']) : 'Not Applicable' }}
                                    </td>
                                    <td class="w-15">
                                        {{ isset($datagridI['info_expiry_date']) ? Helpers::getdateFormat($datagridI['info_expiry_date']) : 'Not Applicable' }}
                                    </td>

                                    <td class="w-15">{{ $datagridI['info_label_claim'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_pack_size'] ?? "Not Applicable" }}</td>
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
            </div>
            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                   <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%">Analyst Name</th>
                            <th style="width: 10%">Others (Specify)</th>
                            <th style="width: 10%"> In- Process Sample Stage.</th>
                            <th style="width: 12% pt-3">Packing Material Type</th>
                            <th style="width: 16% pt-2"> Stability for</th>
                        </tr>
                        @if(isset($data->info_product_materials) && isset($data->info_product_materials->data) && is_array($data->info_product_materials->data))
                            @foreach ($data->info_product_materials->data as $key => $datagridI)
                                <tr>
                                    <td class="w-15">{{ $datagridI ? $key + 1 : "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_analyst_name'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_others_specify'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_process_sample_stage'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_packing_material_type'] ?? "Not Applicable" }}</td>
                                    <td class="w-15">{{ $datagridI['info_stability_for'] ?? "Not Applicable" }}</td>
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
                            </tr>
                        @endif
                    </table>
                 </div>
                </div>
            </div>
            <!--  Details of Stability Study -->
            <div class="block">
                <div class="block-head"> Details of Stability Study</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                               <th style="width: 4%">Sr.No.</th>
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
                               <th style="width: 4%">Sr.No.</th>
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
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
             <!-- OOS Details  -->
            <div class="block">
                <div class="block-head"> OOS/OOT Details</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                        <th style="width: 4%">Sr.No.</th>
                                <th style="width: 8%">AR Number.</th>
                                <th style="width: 8%">Test Name of OOS/OOT</th>
                                <th style="width: 12%">Results Obtained</th>
                                <th style="width: 16%">Specification Limit</th>
                                <th style="width: 16%">File Attachment</th>
                                <th style="width: 16%">Submit On</th>
                                <th style="width: 16%">Submit By</th>
                        </tr>
                        @if(($data->oos_details) && is_array($data->oos_details->data))
                        @foreach ($data->oos_details->data as $key => $datagridIII)
                        <tr>
                            <td class="w-15">{{ $datagridIII ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $datagridIII['oos_arnumber'] ?  $datagridIII['oos_arnumber']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_test_name'] ?  $datagridIII['oos_test_name']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_results_obtained'] ?  $datagridIII['oos_results_obtained']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $datagridIII['oos_specification_limit'] ?  $datagridIII['oos_specification_limit']: "Not Applicable"}}</td>
                            <td class="w-15">
                                {{ isset($datagridIII['oos_file_attachment']) && is_array($datagridIII['oos_file_attachment']) 
                                    ? implode(', ', $datagridIII['oos_file_attachment']) 
                                    : ($datagridIII['oos_file_attachment'] ?? "Not Applicable") 
                                }}
                            </td>

                            <td class="w-15">{{ $datagridIII['oos_submit_on'] ?  Helpers::getdateFormat($datagridIII['oos_submit_on'] ?? ''): "Not Applicable" }}
                            </td>
                            <td class="w-15">{{ $datagridIII['oos_submit_by'] ?  Helpers::getInitiatorName($datagridIII['oos_submit_by'] ?? ''): "Not Applicable" }}
                            </td>
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
             <!-- Product details  -->
            <div class="block">
                <div class="block-head"> Product details </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%"> Name of Product</th>
                            <th style="width: 8%"> A.R.No </th>
                            <th style="width: 8%"> Sampled on </th>
                            <th style="width: 8%"> Sample by</th>
                            <th style="width: 8%"> Analyzed on</th>
                            <th style="width: 8%"> Observed on </th>
                        </tr>
                        @if ($products_details && is_array($products_details->data))
                                @foreach ($products_details->data as $key => $products_detail)
                                    <tr>
                            <td class="w-15">{{ $products_detail ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $products_detail['product_name'] ?  $products_detail['product_name']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $products_detail['product_AR_No'] ?  $products_detail['product_AR_No']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $products_detail['sampled_on'] ?  Helpers::getdateFormat($products_detail['sampled_on'] ?? ''): "Not Applicable" }} </td>
                            <td class="w-15">{{ $products_detail['sample_by'] ?  $products_detail['sample_by']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $products_detail['analyzed_on'] ?  Helpers::getdateFormat($products_detail['analyzed_on'] ?? ''): "Not Applicable"}}</td>
                            <td class="w-15">{{ $products_detail['observed_on'] ?  Helpers::getdateFormat($products_detail['observed_on'] ?? ''): "Not Applicable"}}</td>
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
             <!-- Instrument details  -->
            <div class="block">
                <div class="block-head"> Instrument details </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%"> Name of instrument</th>
                            <th style="width: 8%"> Instrument Id Number</th>
                            <th style="width: 8%"> Calibrated On</th>
                            <th style="width: 8%">Calibrated Due Date</th>
                        </tr>

                        @if(($instrument_details) && is_array($instrument_details->data))
                        @foreach ($instrument_details->data as $key => $instrument_detail)
                        <tr>
                            <td class="w-15">{{ $instrument_detail ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ $instrument_detail['instrument_name'] ?  $instrument_detail['instrument_name']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $instrument_detail['instrument_id_number'] ?  $instrument_detail['instrument_id_number']: "Not Applicable"}}</td>
                            <td class="w-15">{{ $instrument_detail['calibrated_on'] ?  Helpers::getdateFormat($instrument_detail['calibrated_on']): "Not Applicable"}}</td>
                            <td class="w-15">{{ $instrument_detail['calibratedduedate_on'] ?  Helpers::getdateFormat($instrument_detail['calibratedduedate_on']): "Not Applicable"}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>1</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
           <!-- grid close -->

           {{-- <!-- HOD Primary Review --> ~Aditya Rajput --}}

           <div class="block">
            <div class="block-head">HOD Primary Review</div>
            <!-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">HOD Remarks</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->hod_remark1 ){{ $data->hod_remark1 }} @else Not Applicable @endif</span>
            </div> -->
            <table>
                <tr>
                    <th>HOD Remarks</th>
                    <td>@if($data->hod_remark1 ){{ $data->hod_remark1 }} @else Not Applicable @endif</td>
                </tr>
            </table>
           </div>
           <div class="block">
            <div class="block-head">HOD Primary Attachment</div>
              <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-80"> Attachment</th>
                    </tr>
                    @if ($data->hod_attachment1)
                    @foreach ($data->hod_attachment1 as $key => $file)
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

          {{-- <!-- CQA/QA Head --> ~Aditya Rajput --}}

           {{-- <div class="block">
            <div class="block-head">CQA/QA Head</div>
            <table>
               <tr>
                    <th class="w-20">CQA/QA Head Remark</th>
                    <td class="w-80">{{ $data->QA_Head_remark1 ? $data->QA_Head_remark1 : 'Not Applicable' }}</td>
              </tr>
             </table>
           </div>
           <div class="block">
            <div class="block-head">CQA/QA Head Attachment</div>
            <div class="border-table">
              <table>
                  <tr class="table_bg">
                      <th class="w-20">Sr.No.</th>
                      <th class="w-80"> Attachment </th>
                  </tr>
                  @if ($data->QA_Head_attachment1)
                  @foreach ($data->QA_Head_attachment1 as $key => $file)
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
           </div> --}}

            {{-- <!-- CQA/QA Head --> ~Aditya Rajput --}}

            <div class="block">
                <div class="block-head">CQA/QA Head Primary Review</div>
                <!-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">CQA/QA Head Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_primary_remark1 ){{ $data->QA_Head_primary_remark1 }} @else Not Applicable @endif</span>
                </div> -->
                <table>
                    <tr>
                        <th>CQA/QA Head Remark</th>
                        <td>@if($data->QA_Head_primary_remark1 ){{ $data->QA_Head_primary_remark1 }} @else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">CQA/QA Head Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @if ($data->QA_Head_primary_attachment1)
                            @foreach ($data->QA_Head_primary_attachment1 as $key => $file)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
            </div>
           <!-- Preliminary Lab. Investigation TapII -->
            <div class="block">
                <div class="block-head">Phase IA Investigation</div>
                {{-- <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Workbench Evaluation</label>
                    <span style="font-size:0.8rem; margin-left:10px">
                        @if($data->Comments_plidata)
                            {{ strip_tags($data->Comments_plidata) }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Checklists</label>
                    <span style="font-size:0.8rem; margin-left:10px">
                        @if($data->checklists)
                            {{ is_array($data->checklists) ? implode(', ', $data->checklists) : $data->checklists }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                        Checklist Outcome
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 10px;">
                        @if($data->justify_if_no_field_alert_pli)
                            {{ strip_tags($data->justify_if_no_field_alert_pli) }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">Workbench Evaluation</th>
                        <td class="w-80">                        
                            @if($data->Comments_plidata)
                                {{ strip_tags($data->Comments_plidata) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>    
                    <tr>
                        <th class="w-20">Checklists</th>
                        <td class="w-80">
                            @if($data->justify_if_no_field_alert_pli)
                                {{ strip_tags($data->justify_if_no_field_alert_pli) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>    
                    <tr>
                        <th class="w-20">Checklist Outcome</th>
                        <td class="w-80">                        
                            @if($data->justify_if_no_field_alert_pli)
                                {{ strip_tags($data->justify_if_no_field_alert_pli) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>    
                    <tr>
                        <th class="w-20">Immediate action taken</th>
                        <td class="w-80">@if($data->root_comment ){{ $data->root_comment }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Delay Justification For Investigation</th>
                        <td class="w-80">                        
                            @if($data->justify_if_no_analyst_int_pli)
                                {{ strip_tags($data->justify_if_no_analyst_int_pli) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Analyst Interview Details</th>
                        <td class="w-80">                        
                            @if($data->analyst_interview_pli)
                                {{ strip_tags($data->analyst_interview_pli) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Any Other Cause/Suspected Cause</th>
                        <td class="w-80">                        
                            @if($data->Any_other_cause ){{ $data->Any_other_cause }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Any Other Batches Analyzed</th>
                        <td class="w-80">                        
                            @if($data->Any_other_batches ){{ $data->Any_other_batches }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Details Of Trend</th>
                        <td class="w-80">                        
                            @if($data->details_of_trend ){{ $data->details_of_trend }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Assignable Cause And Rational For Assignable Cause</th>
                        <td class="w-80">                        
                            @if($data->rational_for_assingnable ){{ $data->rational_for_assingnable }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Summary of Investigation</th>
                        <td class="w-80">                        
                            @if($data->summary_of_prelim_investiga_plic)
                                {{ strip_tags($data->summary_of_prelim_investiga_plic) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Immediate action taken</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->root_comment ){{ $data->root_comment }} @else Not Applicable @endif</span>
                </div> 
                <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                        Delay Justification For Investigation
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 10px;">
                        @if($data->justify_if_no_analyst_int_pli)
                            {{ strip_tags($data->justify_if_no_analyst_int_pli) }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> 
                <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                        Analyst Interview Details
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 10px;">
                        @if($data->analyst_interview_pli)
                            {{ strip_tags($data->analyst_interview_pli) }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> 
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Any Other Cause/Suspected Cause</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->Any_other_cause ){{ $data->Any_other_cause }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Any Other Batches Analyzed</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->Any_other_batches ){{ $data->Any_other_batches }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Details Of Trend</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->details_of_trend ){{ $data->details_of_trend }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Assignable Cause And Rational For Assignable Cause</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->rational_for_assingnable ){{ $data->rational_for_assingnable }} @else Not Applicable @endif</span>
                </div>
                <div class="inner-block">
                    <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                        Summary of Investigation
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 10px;">
                        @if($data->summary_of_prelim_investiga_plic)
                            {{ strip_tags($data->summary_of_prelim_investiga_plic) }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}

            </div>
            <div class="block">
                <table>
            
                    {{-- <tr>  {{ $data->created_at }} Added By {{ $data->originator }}
                        <th class="w-10">Workbench Evaluation</th>
                        <td class="w-90">{{ $data->Comments_plidata ? $data->Comments_plidata : 'Not Applicable' }}</td>
                    </tr> --}}
                    {{-- <tr>  {{ $data->created_at }} Added By {{ $data->originator }}
                        <th class="w-10">Checklist Outcome</th>
                        <td class="w-90">{{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : 'Not Applicable' }}</td>
                    </tr> --}}
                  
                      <tr>
                        <th class="w-20">OOS/OOT Cause Identified</th>
                        <td class="w-30">{{ $data->phase_i_investigation_pli ? $data->phase_i_investigation_pli : 'Not Applicable' }}</td>
                        <th class="w-20">OOS/OOT Category</th>
                        <td class="w-30">{{ $data->oos_category_root_cause_ident_plic ? $data->oos_category_root_cause_ident_plic : 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>

                <div class="inner-block">
                    {{-- <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                        OOS/OOT Category (If Others)
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 10px;">
                        @if($data->oos_category_others_plic)
                            {{ strip_tags($data->oos_category_others_plic) }}
                        @else
                            Not Applicable
                        @endif
                    </span> --}}
                    <table>
                        <tr>
                            <th class="w-20">OOS/OOT Category (If Others)</th>
                            <td class="w-80">                        
                                @if($data->oos_category_others_plic)
                                    {{ strip_tags($data->oos_category_others_plic) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">CAPA Required</th>
                                <td class="w-30">{{ $data->capa_required_plic ? $data->capa_required_plic : 'Not Applicable' }}</td>
                                <th class="w-20">Reference CAPA No.</th>
                                <td class="w-30">{{ $data->reference_capa_no_plic ? $data->reference_capa_no_plic : 'Not Applicable' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="inner-block">
                        {{-- <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                            OOS/OOT Review For Similar Nature
                        </label>
                        <span style="font-size: 0.8rem; margin-left: 10px;">
                            @if($data->review_comments_plir)
                                {{ strip_tags($data->review_comments_plir) }}
                            @else
                                Not Applicable
                            @endif
                        </span> --}}
                        <table>
                            <tr>
                                <th class="w-20">OOS/OOT Review For Similar Nature</th>
                                <td class="w-80">                            
                                    @if($data->review_comments_plir)
                                        {{ strip_tags($data->review_comments_plir) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Phase IB Inv. Required?</th>
                                <td class="w-30">{{ $data->phase_ib_inv_required_plir ? $data->phase_ib_inv_required_plir : 'Not Applicable' }}</td>
                                <th class="w-20">Phase II Inv. Required?</th>
                                <td class="w-30">{{ $data->phase_ii_inv_required_plir ? $data->phase_ii_inv_required_plir : 'Not Applicable' }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">Retest/Re-Measurement Required</th>
                                <td class="w-30">{{ $data->root_cause_identified_pia ? $data->root_cause_identified_pia : 'Not Applicable' }}</td>
                                <th class="w-20">Resampling Required</th>
                                <td class="w-30">{{ $data->is_repeat_assingable_pia ? $data->is_repeat_assingable_pia : 'Not Applicable' }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">Repeat Testing Required</th>
                                <td class="w-30">{{ $data->repeat_testing_pia ? $data->repeat_testing_pia : 'Not Applicable' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Results Of Retest/Re-Measurement</th>
                                <td class="w-80">                            
                                    @if($data->Description_Deviation)
                                        {{ strip_tags($data->Description_Deviation) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Results Of Repeat Testing</th>
                                <td class="w-80">                            
                                    @if($data->result_of_repeat)
                                        {{ strip_tags($data->result_of_repeat) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment</th>
                                <td class="w-80">@if($data->impact_assesment_pia ){{ $data->impact_assesment_pia }} @else Not Applicable @endif</td>
                            </tr>
                        </table>
           
                    </div>

                    {{-- <div class="inner-block">
                        <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                            Results Of Retest/Re-Measurement
                        </label>
                        <span style="font-size: 0.8rem; margin-left: 10px;">
                            @if($data->Description_Deviation)
                                {{ strip_tags($data->Description_Deviation) }}
                            @else
                                Not Applicable
                            @endif
                        </span>
                    </div>
                    <div class="inner-block">
                        <label class="summer" style="font-weight: bold; font-size: 13px; display: inline;">
                            Results Of Repeat Testing
                        </label>
                        <span style="font-size: 0.8rem; margin-left: 10px;">
                            @if($data->result_of_repeat)
                                {{ strip_tags($data->result_of_repeat) }}
                            @else
                                Not Applicable
                            @endif
                        </span>
                    </div>
                    <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Impact Assessment</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->impact_assesment_pia ){{ $data->impact_assesment_pia }} @else Not Applicable @endif</span>
                    </div> --}}

                <div class="block-head">Analyst Interview Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80"> Attachment</th>
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

                <div class="block-head">Supporting Attachments</div>
                <div class="border-table">
                  <table>
                      <tr class="table_bg">
                          <th class="w-20">Sr.No.</th>
                          <th class="w-80"> Attachment</th>
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


            {{-- <div class="block">
                <table>
                   <tr>
                        <th class="w-20">Root Cause Identified</th>
                        <td class="w-30">{{ $data->root_cause_identified_plic ? $data->root_cause_identified_plic : 'Not Applicable' }}</td>
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
                                <th class="w-80"> Attachment </th>
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
            </div> --}}
            {{-- <div class="block">
                  <table>

                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}


                    </tr>
                    </table>
             </div>         --}}
            </div>
            {{-- <div class="block">
                <h2>OOS Review for Similar Nature</h2>
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 30%">OOS Number</th>
                            <th style="width: 40%">Description of OOS</th>
                            <th style="width: 20%">Previous OOS Root Cause</th>
                            <th style="width: 20%"> CAPA</th>
                            <th style="width: 30%"> OOS Reported Date</th>
                            <th style="width: 20% pt-3">Closure Date of CAPA</th>
                        </tr>
                        @if(($oos_capas) && is_array($oos_capas->data))
                            @foreach ($oos_capas->data as $key => $datagridIV)
                            <tr>
                                <td class="w-10">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                                <td class="w-10">{{ $datagridIV['info_oos_number'] ?  $datagridIV['info_oos_number']: "Not Applicable"}}</td>
                                <td class="w-40">{{ $datagridIV['info_oos_description'] ?  $datagridIV['info_oos_description']: "Not Applicable"}}</td>
                                <td class="w-0">{{ $datagridIV['info_oos_previous_root_cause'] ?  $datagridIV['info_oos_previous_root_cause']: "Not Applicable"}}</td>
                                <td class="w-8">{{ $datagridIV['info_oos_capa'] ?  $datagridIV['info_oos_capa']: "Not Applicable"}}</td>
                                <td class="w-30">
                                  {{ $datagridIV['info_oos_reported_date'] ?  Helpers::getdateFormat($datagridIV['info_oos_reported_date'] ?? ''): "Not Applicable" }}
                                </td>
                                <td class="w-10">
                                {{ $datagridIV['info_oos_closure_date'] ?  Helpers::getdateFormat($datagridIV['info_oos_closure_date'] ?? ''): "Not Applicable" }}
                                </td>
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
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 14%">CAPA Requirement</th>
                            <th style="width: 14%">CAPA Reference Number</th>
                        </tr>
                        @if ($oos_capas)
                           @foreach ($oos_capas->data as $key => $datagridV)
                            <tr>
                                <td class="w-2">{{ $datagridIV ? $key + 1  : "Not Applicable" }}</td>
                                <td class="w-8">{{ $datagridV['info_oos_capa_requirement'] ?  $datagridV['info_oos_capa_requirement']: "Not Applicable"}}</td>
                               <td class="w-8">{{ $datagridIV['info_oos_capa_reference_number'] ?  $datagridIV['info_oos_capa_reference_number']: "Not Applicable"}}</td>

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
            </div> --}}
              {{-- <!-- Phase IA HOD Primary --> ~Aditya Rajput --}}

              <div class="block">
                <div class="block-head">Phase IA HOD Review</div>
                <div class = "inner-block">
                    {{-- <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IA HOD Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->hod_remark2 ){{ $data->hod_remark2 }} @else Not Applicable @endif</span> --}}
                    <table>
                        <tr>
                            <th>Phase IA HOD Remark</th>
                            <td>@if($data->hod_remark2 ){{ $data->hod_remark2 }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
               </div>
               <div class="block">
                <div class="block-head">Phase IA HOD Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80"> Attachment</th>
                            </tr>
                            @if ($data->hod_attachment2)
                            @foreach ($data->hod_attachment2 as $key => $file)
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
               </div>

                {{-- <!-- Phase IA CQA/QA --> ~Aditya Rajput --}}

              <div class="block">
                <div class="block-head">Phase IA CQA/QA Review</div>
                <div class = "inner-block">
                    {{-- <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IA CQA/QA Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_remark2 ){{ $data->QA_Head_remark2 }} @else Not Applicable @endif</span> --}}
                    <table>
                        <tr>
                            <th class="w-20">Phase IA CQA/QA Remark</th>
                            <td class="w-80">@if($data->QA_Head_remark2 ){{ $data->QA_Head_remark2 }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
               </div>
               <div class="block">
                <div class="block-head">Phase IA CQA/QA Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @if ($data->QA_Head_attachment2)
                            @foreach ($data->QA_Head_attachment2 as $key => $file)
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
               </div>

                 {{-- <!-- Phase IA CQA/QA --> ~Aditya Rajput --}}

              {{-- <div class="block">
                <div class="block-head">Phase IA CQAH/QAH Review</div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IA CQAH/QAH Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_primary_remark2 ){{ $data->QA_Head_primary_remark2 }} @else Not Applicable @endif</span>
                </div>
              </div>

              <div class="block">
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IA Assignable Cause Found</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->assign_cause_found ){{ $data->assign_cause_found }} @else Not Applicable @endif</span>
              </div> --}}

              <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Phase IA CQAH/QAH Remark</th>
                        <td class="w-80">@if($data->QA_Head_primary_remark2 ){{ $data->QA_Head_primary_remark2 }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Phase IA Assignable Cause Found</th>
                        <td class="w-80">@if($data->assign_cause_found ){{ $data->assign_cause_found }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>



              <div class="block">
                <div class="block-head">Phase IA CQAH/QAH Attachment</div>
                <div class="border-table">
                  <table>
                      <tr class="table_bg">
                          <th class="w-20">Sr.No.</th>
                          <th class="w-80"> Attachment</th>
                      </tr>
                      @if ($data->QA_Head_primary_attachment2)
                      @foreach ($data->QA_Head_primary_attachment2 as $key => $file)
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
              </div>

              {{-- <!-- Phase IB Investigation --> ~Aditya Rajput --}}
              <div class="block">
                <div class="block-head">Phase IB Investigation</div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Outcome Of Phase IA Investigation</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->outcome_phase_IA ){{ $data->outcome_phase_IA }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Reason For Proceeding To Phase IB Investigation</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->reason_for_proceeding ){{ $data->reason_for_proceeding }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Summary Of Review</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->summaryy_of_review ){{ $data->summaryy_of_review }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Probable Cause Identification</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->Probable_cause_iden ){{ $data->Probable_cause_iden }} @else Not Applicable @endif</span>
                </div>

                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Proposal For Phase IB hypothesis</label>
                    <span style="font-size:0.8rem; margin-left:10px">
                        @if($data->proposal_for_hypothesis_IB)
                            {{ is_array($data->proposal_for_hypothesis_IB) ? implode(', ', $data->proposal_for_hypothesis_IB) : $data->proposal_for_hypothesis_IB }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Others</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->proposal_for_hypothesis_others ){{ $data->proposal_for_hypothesis_others }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Details Of Results (Including original OOS/OOT results for side by side comparison)</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->details_of_result ){{ $data->details_of_result }} @else Not Applicable @endif</span>
                </div> --}}

                <table>
                    <tr>
                        <th class="w-20">Outcome Of Phase IA Investigation</th>
                        <td class="w-80">@if($data->outcome_phase_IA ){{ $data->outcome_phase_IA }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Reason For Proceeding To Phase IB Investigation</th>
                        <td class="w-80">@if($data->reason_for_proceeding ){{ $data->reason_for_proceeding }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Summary Of Review</th>
                        <td class="w-80">@if($data->summaryy_of_review ){{ strip_tags($data->summaryy_of_review) }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Probable Cause Identification</th>
                        <td class="w-80">@if($data->Probable_cause_iden ){{ strip_tags($data->Probable_cause_iden) }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Proposal For Phase IB hypothesis</th>
                        <td class="w-80">                        
                            @if($data->proposal_for_hypothesis_IB)
                                {{ is_array($data->proposal_for_hypothesis_IB) ? implode(', ', $data->proposal_for_hypothesis_IB) : $data->proposal_for_hypothesis_IB }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->proposal_for_hypothesis_others ){{ strip_tags($data->proposal_for_hypothesis_others) }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Details Of Results (Including original OOS/OOT results for side by side comparison)</th>
                        <td class="w-80">@if($data->details_of_result ){{ strip_tags($data->details_of_result) }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>


              <div class="block">
                <table>
                  <tr>
                    <th class="w-20">Probable Cause Identified In Phase IB Investigation</th>
                    <td class="w-80">{{ $data->Probable_Cause_Identified ? $data->Probable_Cause_Identified : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                    <th class="w-20">Any Other Comments/ Probable Cause Evidence</th>
                    <td class="w-80">@if($data->Any_other_Comments ){{ $data->Any_other_Comments }} @else Not Applicable @endif</td>
                  </tr>
                  <tr>
                    <th class="w-20">Proposal For Hypothesis Testing To Confirm Probable Cause Identified</th>
                    <td class="w-80">@if($data->Proposal_for_Hypothesis ){{ strip_tags($data->Proposal_for_Hypothesis) }} @else Not Applicable @endif</td>
                  </tr>
                  <tr>
                    <th class="w-20">Summary Of Hypothesis</th>
                    <td class="w-80">@if($data->Summary_of_Hypothesis ){{ strip_tags($data->Summary_of_Hypothesis) }} @else Not Applicable @endif</td>
                  </tr>
               </table>
              </div>
              {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Any Other Comments/ Probable Cause Evidence</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Any_other_Comments ){{ $data->Any_other_Comments }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Proposal For Hypothesis Testing To Confirm Probable Cause Identified</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Proposal_for_Hypothesis ){{ $data->Proposal_for_Hypothesis }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Summary Of Hypothesis</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Summary_of_Hypothesis ){{ $data->Summary_of_Hypothesis }} @else Not Applicable @endif</span>
              </div> --}}

              <div class="block">
                <table>
                  <tr>
                    <th class="w-20">Assignable Cause</th>
                    <td class="w-30">{{ $data->Assignable_Cause ? $data->Assignable_Cause : 'Not Applicable' }}</td>
                    <th class="w-20">Types Of Assignable Cause</th>
                    <td class="w-30">{{ $data->Types_of_assignable ? $data->Types_of_assignable : 'Not Applicable' }}</td>
                  </tr>
               </table>
              </div>

              {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Others</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Types_of_assignable_others ){{ $data->Types_of_assignable_others }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Evaluation Of Phase IB Investigation Timeline</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Evaluation_Timeline ){{ $data->Evaluation_Timeline }} @else Not Applicable @endif</span>
              </div> --}}


              <div class="block">
                <table>
                  <tr>
                    <th class="w-20">Others</th>
                    <td class="w-80">@if($data->Types_of_assignable_others ){{ $data->Types_of_assignable_others }} @else Not Applicable @endif</td>
                  </tr>
                  <tr>
                    <th class="w-20">Evaluation Of Phase IB Investigation Timeline</th>
                    <td class="w-80">@if($data->Evaluation_Timeline ){{ strip_tags($data->Evaluation_Timeline) }} @else Not Applicable @endif</td>
                  </tr>
                  <tr>
                    <th class="w-20">Is Phase IB Investigation Timeline Met</th>
                    <td class="w-80">{{ $data->timeline_met ? $data->timeline_met : 'Not Applicable' }}</td>
                  </tr>
                  <tr>
                    <th class="w-20">If No, Justify For Timeline Extension</th>
                    <td class="w-80">@if($data->timeline_extension ){{ $data->timeline_extension }} @else Not Applicable @endif</td>
                  </tr>
                  <tr>
                    <th class="w-20">CAPA Applicable</th>
                    <td class="w-80">@if($data->CAPA_applicable ){{ $data->CAPA_applicable }} @else Not Applicable @endif</td>
                  </tr>
               </table>
              </div>

              {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">If No, Justify For Timeline Extension</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->timeline_extension ){{ $data->timeline_extension }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">CAPA Applicable</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->CAPA_applicable ){{ $data->CAPA_applicable }} @else Not Applicable @endif</span>
              </div> --}}

              <div class="block">
                <table>
                  <tr>
                    <th class="w-20">Resampling Required</th>
                    <td class="w-30">{{ $data->resampling_required_ib ? $data->resampling_required_ib : 'Not Applicable' }}</td>
                    <th class="w-20">Repeat Testing Required</th>
                    <td class="w-30">{{ $data->repeat_testing_ib ? $data->repeat_testing_ib : 'Not Applicable' }}</td> 
                  </tr>
               </table>
              </div>
              {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Repeat Testing Plan</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Repeat_testing_plan ){{ $data->Repeat_testing_plan }} @else Not Applicable @endif</span>
              </div> --}}
              <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Repeat Testing Plan</th>
                        <td class="w-80">@if($data->Repeat_testing_plan ){{ strip_tags($data->Repeat_testing_plan) }} @else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Phase II Investigation Required</th>
                        <td class="w-30">{{ $data->phase_ii_inv_req_ib ? $data->phase_ii_inv_req_ib : 'Not Applicable' }}</td>
                        <th class="w-20">Production Person</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->production_person_ib) ? Helpers::getInitiatorName($data->production_person_ib) : 'Not Applicable' }}</td>
                    </tr>
               </table>
              </div>

              <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Repeat Analysis Method/Resampling</th>
                        <td class="w-80">@if($data->Repeat_analysis_method ){{ strip_tags($data->Repeat_analysis_method) }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Details Of Repeat Analysis</th>
                        <td class="w-80">@if($data->Details_repeat_analysis ){{ strip_tags($data->Details_repeat_analysis) }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-80">@if($data->Impact_assessment1 ){{ strip_tags($data->Impact_assessment1) }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-80">@if($data->Conclusion1 ){{ strip_tags($data->Conclusion1) }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>
              {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Repeat Analysis Method/Resampling</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Repeat_analysis_method ){{ $data->Repeat_analysis_method }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Details Of Repeat Analysis</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Details_repeat_analysis ){{ $data->Details_repeat_analysis }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Impact Assessment</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Impact_assessment1 ){{ $data->Impact_assessment1 }} @else Not Applicable @endif</span>
              </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Conclusion</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->Conclusion1 ){{ $data->Conclusion1 }} @else Not Applicable @endif</span>
              </div> --}}
              </div>

              <div class="block">
                <div class="block-head">File Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @if ($data->file_attachment_IB_Inv)
                                @foreach ($data->file_attachment_IB_Inv as $key => $file)
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
              </div>

               {{-- <!-- Phase IB HOD Primary --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">Phase IB HOD Review</div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IB HOD Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->hod_remark3 ){{ $data->hod_remark3 }} @else Not Applicable @endif</span>
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">Phase IB HOD Remark</th>
                        <td class="w-80">@if($data->hod_remark3 ){{ $data->hod_remark3 }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>
              <div class="block">
                <div class="block-head">Phase IB HOD Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @if ($data->hod_attachment3)
                            @foreach ($data->hod_attachment3 as $key => $file)
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
              </div>

               {{-- <!-- Phase IB CQA/QA  --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">Phase IB CQA/QA Review</div>
                <div class = "inner-block">
                    {{-- <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase IB CQA/QA Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_remark3 ){{ $data->QA_Head_remark3 }} @else Not Applicable @endif</span> --}}
                    <table>
                        <tr>
                            <th class="w-20">Phase IB CQA/QA Remark</th>
                            <td class="w-80">@if($data->QA_Head_remark3 ){{ $data->QA_Head_remark3 }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="block">
                <div class="block-head">Phase IB CQA/QA Attachment</div>
                <div class="border-table">
                  <table>
                      <tr class="table_bg">
                          <th class="w-20">S.N.</th>
                          <th class="w-80"> Attachment </th>
                      </tr>
                      @if ($data->QA_Head_attachment3)
                      @foreach ($data->QA_Head_attachment3 as $key => $file)
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
              </div>

               {{-- <!-- P-IB CQAH/QAH --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">Phase IB CQAH/QAH Review</div>
                <table>
                    <tr>
                        <th class="w-20">Escalation required</th>
                        <td class="w-80">{{ $data->escalation_required ? $data->escalation_required : 'Not Applicable' }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">If Yes, Notification</th>
                        <td class="w-80">@if($data->notification_ib ){{ $data->notification_ib }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">If No, Justification</th>
                        <td class="w-80">@if($data->justification_ib ){{ $data->justification_ib }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">P-IB CQAH/QAH Remark</th>
                        <td class="w-80">@if($data->QA_Head_primary_remark3 ){{ $data->QA_Head_primary_remark3 }} @else Not Applicable @endif</td>
                    </tr>
                 </table>
              </div>

            {{-- <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">If Yes, Notification</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->notification_ib ){{ $data->notification_ib }} @else Not Applicable @endif</span>
            </div>
            <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">If No, Justification</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->justification_ib ){{ $data->justification_ib }} @else Not Applicable @endif</span>
            </div>
              <div class = "inner-block">
                <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">P-IB CQAH/QAH Remark</label>
                <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_primary_remark3 ){{ $data->QA_Head_primary_remark3 }} @else Not Applicable @endif</span>
            </div> --}}
            
              <div class="block">
                <div class="block-head">Phase IB CQAH/QAH Attachment</div>
                <div class="border-table">
                  <table>
                      <tr class="table_bg">
                          <th class="w-20">S.N.</th>
                          <th class="w-80"> Attachment</th>
                      </tr>
                      @if ($data->QA_Head_primary_attachment3)
                      @foreach ($data->QA_Head_primary_attachment3 as $key => $file)
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
              </div>

            @include('frontend.OOS.comps.allchecklistSingleReport')

            <div class="block">
                <div class="block-head"> Phase II A Investigation </div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Checklist Outcome</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->checklist_outcome_iia ){{ $data->checklist_outcome_iia }} @else Not Applicable @endif</span>
                </div> --}}
                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Checklist Outcome</th>
                            <td class="w-80">@if($data->checklist_outcome_iia ){{ $data->checklist_outcome_iia }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Production Head Person</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->production_head_person) ? Helpers::getInitiatorName($data->production_head_person) : 'Not Applicable' }}</td>
                        </tr>
                   </table>
                   <table>
                        <tr>
                            <th class="w-20">Immediate Action Taken</th>
                            <td class="w-80">@if($data->qa_approver_comments_piii ){{ $data->qa_approver_comments_piii }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Delay Justification For Investigation</th>
                            <td class="w-80">@if($data->reason_manufacturing_delay ){{ $data->reason_manufacturing_delay }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Any Other Cause/Suspected Cause</th>
                            <td class="w-80">@if($data->audit_comments_piii ){{ $data->audit_comments_piii }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Summary Investigation</th>
                            <td class="w-80">@if($data->hypo_exp_reference_piii ){{ $data->hypo_exp_reference_piii }} @else Not Applicable @endif</td>
                        </tr>
                   </table>
                  </div>

                  {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Immediate Action Taken</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->qa_approver_comments_piii ){{ $data->qa_approver_comments_piii }} @else Not Applicable @endif</span>
                  </div>
                  <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Delay Justification For Investigation</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->reason_manufacturing_delay ){{ $data->reason_manufacturing_delay }} @else Not Applicable @endif</span>
                  </div>
                  <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Any Other Cause/Suspected Cause</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->audit_comments_piii ){{ $data->audit_comments_piii }} @else Not Applicable @endif</span>
                  </div>
                  <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Summary Investigation</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->hypo_exp_reference_piii ){{ $data->hypo_exp_reference_piii }} @else Not Applicable @endif</span>
                  </div> --}}
                  <div class="block">
                    <table>
                        <tr>
                        <th class="w-20">OOS/OOT Cause Identified II A</th>
                        <td class="w-30">{{ $data->manufact_invest_required_piii ? $data->manufact_invest_required_piii : 'Not Applicable' }}</td>
                        <th class="w-20">OOS/OOT Category II A</th>
                        <td class="w-30">{{ $data->hypo_exp_required_piii ? $data->hypo_exp_required_piii : 'Not Applicable' }}</td>
                        </tr>
                   </table>
                   <table>
                        <tr>
                            <th class="w-20">OOS/OOT Category If Others</th>
                            <td class="w-80">@if($data->if_others_oos_category ){{ $data->if_others_oos_category }} @else Not Applicable @endif</td>
                        </tr>
                   </table>
                  </div>
                  {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">OOS/OOT Category If Others</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->if_others_oos_category ){{ $data->if_others_oos_category }} @else Not Applicable @endif</span>
                  </div> --}}
                  <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">CAPA Required</th>
                            <td class="w-80">{{ $data->capa_required_iia ? $data->capa_required_iia : 'Not Applicable' }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Reference CAPA No.</th>
                            <td class="w-80">@if($data->reference_capa_no_iia ){{ $data->reference_capa_no_iia }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">OOS/OOT Review For Similar Nature II A</th>
                            <td class="w-80">@if($data->OOS_review_similar ){{ $data->OOS_review_similar }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Impact Assessment</th>
                            <td class="w-80">@if($data->impact_assessment_IIA ){{ $data->impact_assessment_IIA }} @else Not Applicable @endif</td>
                        </tr>
                   </table>
                  </div>
                  {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Reference CAPA No.</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->reference_capa_no_iia ){{ $data->reference_capa_no_iia }} @else Not Applicable @endif</span>
                  </div>
                  <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">OOS/OOT Review For Similar Nature II A</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->OOS_review_similar ){{ $data->OOS_review_similar }} @else Not Applicable @endif</span>
                  </div>
                  <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Impact Assessment</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->impact_assessment_IIA ){{ $data->impact_assessment_IIA }} @else Not Applicable @endif</span>
                  </div> --}}
                  <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Phase IIB Inv. Required?</th>
                            <td class="w-80">{{ $data->phase_iib_inv_required_plir ? $data->phase_iib_inv_required_plir : 'Not Applicable' }}</td>
                        </tr>
                   </table>
                  </div>
                <div class="block-head">Manufacturing Operater Interview Details</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment</th>
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
            </div>
            {{-- <div class="block">
                <div class="block-head"> CheckList - Phase II Investigation</div>
                  <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @if ($phase_two_invss)
                        @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                        <tr>
                            <td class="w-15">{{ $loop->index+1 }}</td>
                            <td class="w-15">{{ $phase_two_inv_question }}</td>
                            <td>{{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'response') }} </td>
                            <td class="w-15">{{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'remarks') }}</td>
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
            </div> --}}
            <div class="block">
                <table>
                  <div class="block-head">II A Inv. Supporting Attachments</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment</th>
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

               {{-- <!-- Phase II A HOD Primary --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">Phase II A HOD Review</div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase II A HOD Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->hod_remark4 ){{ $data->hod_remark4 }} @else Not Applicable @endif</span>
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">Phase II A HOD Remark</th>
                        <td class="w-80">@if($data->hod_remark4 ){{ $data->hod_remark4 }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>
              <div class="block">
                <div class="block-head">Phase II A HOD Attachment</div>
                <div class="border-table">
                  <table>
                      <tr class="table_bg">
                          <th class="w-20">S.N.</th>
                          <th class="w-80"> Attachment </th>
                      </tr>
                      @if ($data->hod_attachment4)
                      @foreach ($data->hod_attachment4 as $key => $file)
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
              </div>


               {{-- <!-- Phase II A CQA/QA --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">Phase II A CQA/QA Review</div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase II A CQA/QA Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_remark4 ){{ $data->QA_Head_remark4 }} @else Not Applicable @endif</span>
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">Phase II A CQA/QA Remark</th>
                        <td class="w-80">@if($data->QA_Head_remark4 ){{ $data->QA_Head_remark4 }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>
              <div class="block">
                <div class="block-head">Phase II A CQA/QA Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @if ($data->QA_Head_attachment4)
                            @foreach ($data->QA_Head_attachment4 as $key => $file)
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
              </div>

               {{-- <!-- P-II A QAH/CQAH --> ~Aditya Rajput --}}

               <div class="block">
                <div class="block-head">P-II A QAH/CQAH Review</div>
                
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase II A Assinable Cause Found</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->phase_ii_a_assi_cause ){{ $data->phase_ii_a_assi_cause }} @else Not Applicable @endif</span>
                </div>
                <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">P-II A QAH/CQAH Remark</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_primary_remark4 ){{ $data->QA_Head_primary_remark4 }} @else Not Applicable @endif</span>
                </div> --}}

                <table>
                    <tr>
                        <th class="w-20">Phase II A Assinable Cause Found</th>
                        <td class="w-80">@if($data->phase_ii_a_assi_cause ){{ $data->phase_ii_a_assi_cause }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">P-II A QAH/CQAH Remark</th>
                        <td class="w-80">@if($data->QA_Head_primary_remark4 ){{ $data->QA_Head_primary_remark4 }} @else Not Applicable @endif</td>
                    </tr>
                </table>
              </div>
              <div class="block">
                <div class="block-head">P-II A QAH/CQAH Attachment</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment</th>
                            </tr>
                            @if ($data->QA_Head_primary_attachment4)
                            @foreach ($data->QA_Head_primary_attachment4 as $key => $file)
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
              </div>

                {{-- <!-- Phase IIB Investigation --> ~Aditya Rajput --}}

                <div class="block">
                    <div class="block-head">Phase II B Investigation</div>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Summary Of Investigation</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->Summary_Of_Inv_IIB ){{ $data->Summary_Of_Inv_IIB }} @else Not Applicable @endif</span>
                    </div> --}}
                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Summary Of Investigation</th>
                                <td class="w-80">@if($data->Summary_Of_Inv_IIB ){{ strip_tags($data->Summary_Of_Inv_IIB) }} @else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">CAPA Required</th>
                                <td class="w-30">{{ $data->capa_required_IIB ? $data->capa_required_IIB : 'Not Applicable' }}</td>

                                <th class="w-20">Reference CAPA No.</th>
                                <td class="w-30">@if($data->reference_capa_IIB ){{ $data->reference_capa_IIB }} @else Not Applicable @endif</td>
                            </tr>
                       </table>
                    </div>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Reference CAPA No.</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->reference_capa_IIB ){{ $data->reference_capa_IIB }} @else Not Applicable @endif</span>
                    </div> --}}
                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Resampling Required IIB Inv.</th>
                                <td class="w-30">{{ $data->resampling_req_IIB ? $data->resampling_req_IIB : 'Not Applicable' }}</td>
                                <th class="w-20">Repeat Testing Required IIB Inv.</th>
                                <td class="w-30">{{ $data->Repeat_testing_IIB ? $data->Repeat_testing_IIB : 'Not Applicable' }}</td>
                            </tr>
                       </table>

                        <table>
                            <tr>
                                <th class="w-20">Results Of Repeat Testing IIB Inv.</th>
                                <td class="w-80">@if($data->result_of_rep_test_IIB ){{ strip_tags($data->result_of_rep_test_IIB) }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Laboratory Investigation Hypothesis Details</th>
                                <td class="w-80">@if($data->Laboratory_Investigation_Hypothesis ){{ strip_tags($data->Laboratory_Investigation_Hypothesis) }} @else Not Applicable @endif</td>
                            </tr>

                            <tr>
                                <th class="w-20">Outcome Of Laboratory Investigation</th>
                                <td class="w-80">@if($data->Outcome_of_Laboratory ){{ strip_tags($data->Outcome_of_Laboratory) }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Evaluation</th>
                                <td class="w-80">@if($data->Evaluation_IIB ){{ strip_tags($data->Evaluation_IIB) }} @else Not Applicable @endif</td>
                            </tr>
                        </table>
                    </div>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Results Of Repeat Testing IIB Inv.</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->result_of_rep_test_IIB ){{ $data->result_of_rep_test_IIB }} @else Not Applicable @endif</span>
                    </div>
                    <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Laboratory Investigation Hypothesis Details</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->Laboratory_Investigation_Hypothesis ){{ $data->Laboratory_Investigation_Hypothesis }} @else Not Applicable @endif</span>
                    </div>
                    <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Outcome Of Laboratory Investigation</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->Outcome_of_Laboratory ){{ $data->Outcome_of_Laboratory }} @else Not Applicable @endif</span>
                    </div>
                    <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Evaluation</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->Evaluation_IIB ){{ $data->Evaluation_IIB }} @else Not Applicable @endif</span>
                    </div> --}}
                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Assignable Cause</th>
                                <td class="w-80">{{ $data->Assignable_Cause111 ? $data->Assignable_Cause111 : 'Not Applicable' }}</td>
                            </tr>

                            <tr>
                                <th class="w-20">If Assignable Cause Identified Perform Re-testing</th>
                                <td class="w-80">@if($data->If_assignable_cause ){{ strip_tags($data->If_assignable_cause) }} @else Not Applicable @endif</td>
                            </tr>

                            <tr>
                                <th class="w-20">If Assignable Cause Is Not Identified Proceed As Per Phase III Investigation</th>
                                <td class="w-80">@if($data->If_assignable_error ){{ strip_tags($data->If_assignable_error) }} @else Not Applicable @endif</td>
                            </tr>
                       </table>
                    </div>
                    {{-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">If Assignable Cause Identified Perform Re-testing</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->If_assignable_cause ){{ $data->If_assignable_cause }} @else Not Applicable @endif</span>
                    </div>
                    <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">If Assignable Cause Is Not Identified Proceed As Per Phase III Investigation</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->If_assignable_error ){{ $data->If_assignable_error }} @else Not Applicable @endif</span>
                    </div> --}}
                </div>


               {{-- <!-- Phase II B HOD Primary --> ~Aditya Rajput --}}

                <div class="block">
                    <div class="block-head">Phase II B HOD Review</div>
                    <!-- <div class = "inner-block">
                        <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase II B HOD Remark</label>
                        <span style="font-size:0.8rem; margin-left:10px">@if($data->hod_remark5 ){{ $data->hod_remark5 }} @else Not Applicable @endif</span>
                    </div> -->
                    <table>
                        <tr>
                            <th class="w-20">Phase II B HOD Remark/th>
                            <td class="w-80">@if($data->hod_remark5 ){{ $data->hod_remark5 }} @else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <div class="block-head">Phase II B HOD Attachment</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-80"> Attachment </th>
                                </tr>
                                @if ($data->hod_attachment5)
                                @foreach ($data->hod_attachment5 as $key => $file)
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
                </div>

                    {{-- <!-- Phase II B CQA/QA --> ~Aditya Rajput --}}

                    <div class="block">
                        <div class="block-head">Phase II B CQA/QA Review</div>
                        {{-- <div class = "inner-block">
                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Phase II B CQA/QA Remark</label>
                            <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_remark5 ){{ $data->QA_Head_remark5 }} @else Not Applicable @endif</span>
                        </div> --}}
                        <table>
                            <tr>
                                <th class="w-20">Phase II B CQA/QA Remark</th>
                                <td class="w-80">@if($data->QA_Head_remark5 ){{ $data->QA_Head_remark5 }} @else Not Applicable @endif</td>
                            </tr>
                        </table>
                    </div>
                    <div class="block">
                        <div class="block-head">Phase II B CQA/QA Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-80"> Attachment </th>
                                    </tr>
                                    @if ($data->QA_Head_attachment5)
                                    @foreach ($data->QA_Head_attachment5 as $key => $file)
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
                    </div>

                 {{-- <!-- P-II A QAH/CQAH --> ~Aditya Rajput --}}

                            <div class="block">
                                <div class="block-head">P-II A QAH/CQAH Review</div>
                                <!-- <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">P-II A QAH/CQAH Remark</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->QA_Head_primary_remark4 ){{ $data->QA_Head_primary_remark4 }} @else Not Applicable @endif</span>
                                </div> -->

                                <table>
                                    <tr>
                                        <th class="w-20">P-II A QAH/CQAH Remark</th>
                                        <td class="w-80">@if($data->QA_Head_primary_remark4 ){{ $data->QA_Head_primary_remark4 }} @else Not Applicable @endif</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="block">
                                <div class="block-head">P-II A QAH/CQAH Attachment</div>
                                <div class="border-table">
                                    <table>
                                        <tr class="table_bg">
                                            <th class="w-20">S.N.</th>
                                            <th class="w-80"> Attachment </th>
                                        </tr>
                                        @if ($data->QA_Head_primary_attachment4)
                                        @foreach ($data->QA_Head_primary_attachment4 as $key => $file)
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
                            </div>

                            <div class="block">
                                <div class="block-head">Phase II B QAH/CQAH Review</div>
                                {{-- <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Approval Comment</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->reopen_approval_comments_uaa ){{ strip_tags($data->reopen_approval_comments_uaa) }} @else Not Applicable @endif</span>
                                </div> --}}

                                <table>
                                    <tr>
                                        <th class="w-20">Approval Comment</th>
                                        <td class="w-80">@if($data->reopen_approval_comments_uaa ){{ strip_tags($data->reopen_approval_comments_uaa) }} @else Not Applicable @endif</td>
                                    </tr>
                                </table>

                                {{-- <div class="block">
                                    <div class="block-head"> Approval Attachment</div>
                                    <div class="border-table">
                                        <table>
                                            <tr class="table_bg">
                                                <th class="w-20">S.N.</th>
                                                <th class="w-80"> Attachment </th>
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
                                </div> --}}

                                <div class="block">
                                    <table>
                                        <tr>
                                            <th class="w-20">OOS/OOT Category</th>
                                            <td class="w-30">{{ $data->oos_category_bd ? $data->oos_category_bd : 'Not Applicable' }}</td>
                                            <th class="w-20">Material/Batch Release</th>
                                            <td class="w-30">{{ $data->material_batch_release_bd ? $data->material_batch_release_bd : 'Not Applicable' }}</td>
                                        </tr>
                                   </table>

                                    <table>
                                        <tr>
                                            <th class="w-20">Other's</th>
                                            <td class="w-80">@if($data->others_bd ){{ $data->others_bd }} @else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th class="w-20">Other Action (Specify)</th>
                                            <td class="w-80">@if($data->other_action_bd ){{ strip_tags($data->other_action_bd) }} @else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th class="w-20">Other Parameters Results</th>
                                            <td class="w-80">@if($data->other_parameters_results_bd ){{ strip_tags($data->other_parameters_results_bd) }} @else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th class="w-20">Justify for Delay in Activity</th>
                                            <td class="w-80">@if($data->justify_for_delay_in_activity_bd ){{ strip_tags($data->justify_for_delay_in_activity_bd) }} @else Not Applicable @endif</td>
                                        </tr>
                                    </table>
                                </div>
                                {{-- <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Other's</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->others_bd ){{ $data->others_bd }} @else Not Applicable @endif</span>
                                </div>
                                <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Other Action (Specify)</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->other_action_bd ){{ strip_tags($data->other_action_bd) }} @else Not Applicable @endif</span>
                                </div>
                                <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Other Parameters Results</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->other_parameters_results_bd ){{ strip_tags($data->other_parameters_results_bd) }} @else Not Applicable @endif</span>
                                </div>
                                <div class = "inner-block">
                                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Justify for Delay in Activity</label>
                                    <span style="font-size:0.8rem; margin-left:10px">@if($data->justify_for_delay_in_activity_bd ){{ strip_tags($data->justify_for_delay_in_activity_bd) }} @else Not Applicable @endif</span>
                                </div> --}}
                                <table>
                                    <div class="block-head"> Disposition Attachment</div>
                                    <div class="border-table">
                                    <table>
                                        <tr class="table_bg">
                                            <th class="w-20">S.N.</th>
                                            <th class="w-80"> Attachment </th>
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

                                    {{-- <div class="block">
                                        <div class="block-head"> Additional Testing Proposal by QA </div>
                                        <table>
                                            <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                                                <th class="w-20">Review Comment</th>
                                                <td class="w-30">{{ $data->review_comment_atp ? $data->review_comment_atp : 'Not Applicable' }}</td>
                                                <th class="w-20">Additional Test Proposal</th>
                                                <td class="w-30">{{ $data->additional_test_proposal_atp ? $data->additional_test_proposal_atp : 'Not Applicable' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-20">Additional Test Comment</th>
                                                <td class="w-80">{{ $data->additional_test_reference_atp ? $data->additional_test_reference_atp : 'Not Applicable' }}</td>
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
                                                        <th class="w-80"> Attachment </th>
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
                                    </div> --}}
                                    <div class="block">
                                        <div class="block-head"> OOS/OOT Conclusion </div>
                                        {{-- <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Conclusion Comments</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->conclusion_comments_oosc ){{ strip_tags($data->conclusion_comments_oosc) }} @else Not Applicable @endif</span>
                                        </div>
                                        <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Specification Limit</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->specification_limit_oosc ){{ $data->specification_limit_oosc }} @else Not Applicable @endif</span>
                                        </div> --}}
                                        <div class="block">
                                            <table>
                                                <tr>
                                                    <th class="w-20">Conclusion Comments</th>
                                                    <td class="w-80">@if($data->conclusion_comments_oosc ){{ strip_tags($data->conclusion_comments_oosc) }} @else Not Applicable @endif</td>
                                                </tr> 
                                                <tr>
                                                    <th class="w-20">Specification Limit</th>
                                                    <td class="w-80">@if($data->specification_limit_oosc ){{ $data->specification_limit_oosc }} @else Not Applicable @endif</td>
                                                </tr> 
                                                <tr>
                                                    <th class="w-20">Results to be Reported</th>
                                                    <td class="w-80">{{ $data->results_to_be_reported_oosc ? $data->results_to_be_reported_oosc : 'Not Applicable' }}</td>
                                                </tr> 
                                                <tr>
                                                    <th class="w-20">Final Reportable Results</th>
                                                    <td class="w-80">@if($data->final_reportable_results_oosc ){{ $data->final_reportable_results_oosc }} @else Not Applicable @endif</td>
                                                </tr>
                                                <tr>
                                                    <th class="w-20">Justifi. for Averaging Results</th>
                                                    <td class="w-80">@if($data->justifi_for_averaging_results_oosc ){{ strip_tags($data->justifi_for_averaging_results_oosc) }} @else Not Applicable @endif</td>
                                                </tr>
                                           </table>
                                        </div>
                                        {{-- <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Final Reportable Results</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->final_reportable_results_oosc ){{ $data->final_reportable_results_oosc }} @else Not Applicable @endif</span>
                                        </div>
                                        <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Justifi. for Averaging Results</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->justifi_for_averaging_results_oosc ){{ strip_tags($data->justifi_for_averaging_results_oosc) }} @else Not Applicable @endif</span>
                                        </div> --}}
                                        <div class="block">
                                            <table>
                                                <tr>
                                                    <th class="w-20">OOS/OOT Stands</th>
                                                    <td class="w-30">{{ $data->oos_stands_oosc ? $data->oos_stands_oosc : 'Not Applicable' }}</td>
                                                    <th class="w-20">CAPA Req.</th>
                                                    <td class="w-30">{{ $data->capa_req_oosc ? $data->capa_req_oosc : 'Not Applicable' }}</td>
                                                </tr>
                                           </table>
                                        </div>
                                        <div class="block">
                                            <table>
                                                <tr>
                                                    <th class="w-20">CAPA Ref No.</th>
                                                    <td class="w-30">{{ $data->capa_ref_no_oosc ? $data->capa_ref_no_oosc : 'Not Applicable' }}</td>

                                                    <th class="w-20">Justify If CAPA Not Required</th>
                                                    <td class="w-30">@if($data->justify_if_capa_not_required_oosc ){{ strip_tags($data->justify_if_capa_not_required_oosc) }} @else Not Applicable @endif</td>
                                                </tr>
                                           </table>
                                        </div>
                                        {{-- <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Justify If CAPA Not Required</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->justify_if_capa_not_required_oosc ){{ strip_tags($data->justify_if_capa_not_required_oosc) }} @else Not Applicable @endif</span>
                                        </div> --}}
                                            {{-- <div class="block">
                                                <div class="block-head"> Summary of OOS Test Results </div>
                                                <div class="border-table">
                                                <table>
                                                        <tr class="table_bg">
                                                            <th style="width: 4%">Sr.No.</th>
                                                                <th style="width: 14%">Analysis Detials</th>
                                                                <th style="width: 10%">Hypo./Exp./Add.Test PR No.</th>
                                                                <th style="width: 10%">Results</th>
                                                                <th style="width: 10%">Analyst Name.</th>
                                                                <th style="width: 16%">Remarks</th>
                                                        </tr>
                                                        @if ($oos_conclusion)
                                                        @foreach ($oos_conclusion->data as $key => $oos_conclusion)
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
                                            </div> --}}
                                            <div class="block-head"> Attachments if Any </div>
                                            <div class="border-table">
                                                <table>
                                                    <tr class="table_bg">
                                                        <th class="w-20">Sr.No.</th>
                                                        <th class="w-80"> Attachment </th>
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
                                        {{-- <div class = "inner-block">
                                            <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Action On Affected Batches</label>
                                            <span style="font-size:0.8rem; margin-left:10px">@if($data->action_on_affected_batch ){{ strip_tags($data->action_on_affected_batch) }} @else Not Applicable @endif</span>
                                        </div> --}}
                                        <table>
                                            <tr>
                                                <th class="w-20">Action On Affected Batches</th>
                                                <td class="w-80">@if($data->action_on_affected_batch ){{ strip_tags($data->action_on_affected_batch) }} @else Not Applicable @endif</td>
                                            </tr>
                                        </table>
                                        <table>
                                            <div class="block-head">Conclusion Attachment </div>
                                            <div class="border-table">
                                                <table>
                                                    <tr class="table_bg">
                                                        <th class="w-20">S.N.</th>
                                                        <th class="w-80"> Attachment </th>
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
                                    {{-- <div class="block">
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
                                                        <th class="w-80"> Attachment </th>
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
                                    </div> --}}

                                    {{-- <div class="block">
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
                                                        <th class="w-80"> Attachment </th>
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
                                    </div> --}}
                            <!-- close block -->
                                </div>
          </div>

</body>

</html>
