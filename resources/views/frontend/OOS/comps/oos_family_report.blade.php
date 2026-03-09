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
                     OOS/OOT Family Report
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
                    <strong>Record No.</strong> {{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                {{ Helpers::getDivisionName($data->division_id) }}/{{ $data->Form_type }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '1' }}

                  {{--{{ Helpers::getDivisionName(session()->get('division')) }}/OOS/OOT/{{ date('Y') }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}--}}
                </td>
                <td class="w-30">
                    <strong>Page No.</strong>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-50">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-50">
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
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">@if($data->description_gi ){{ $data->description_gi  }} @else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
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
                    @if($data->source_document_type_gi == 'Others')
                        <tr>
                            <th class="w-20">Other Source Document Type</th>
                            <td class="w-80">@if($data->sourceDocOtherGi){{ $data->sourceDocOtherGi }}@else Not Applicable @endif</td>
                        </tr>
                    @endif
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
                            <td class="w-80">@if($data->delay_justification ){{ $data->delay_justification }} @else Not Applicable @endif</td>
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
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">@if($data->immediate_action ){{ $data->immediate_action  }} @else Not Applicable @endif</td>
                    </tr>
                </table>

                <div class="block-head">Initial Attachement</div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80"> Attachement </th>
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
                    </tr>
                    <tr>
                        <th class="w-20">Product / Material Name</th>
                        <td class="w-80">@if($data->product_material_name_gi){{ Helpers::recordFormat($data->product_material_name_gi) }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Market</th>
                        <td class="w-80">@if($data->market_gi){{ $data->market_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Customer</th>
                        <td class="w-80">@if($data->customer_gi){{ $data->customer_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Specification Details</th>
                        <td class="w-80">@if($data->specification_details){{ Helpers::recordFormat($data->specification_details) }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
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
                                @php
                                    $attachments = $datagridIII['oos_file_attachment'] ?? null;

                                    if (is_array($attachments)) {
                                        $attachments = array_map(function ($item) {
                                            return is_array($item)
                                                ? ($item['name'] ?? json_encode($item))
                                                : $item;
                                        }, $attachments);

                                        echo implode(', ', $attachments);
                                    } else {
                                        echo $attachments ?? 'Not Applicable';
                                    }
                                @endphp
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
                    <th class="w-20">HOD Remarks</th>
                    <td class="w-80">@if($data->hod_remark1 ){{ $data->hod_remark1 }} @else Not Applicable @endif</td>
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
                            <td class="w-60">Not Applicable</td>
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
                      <th class="w-60"> Attachment </th>
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
                          <td class="w-60">Not Applicable</td>
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
                        <th class="w-20">CQA/QA Head Remark</th>
                        <td class="w-80">@if($data->QA_Head_primary_remark1 ){{ $data->QA_Head_primary_remark1 }} @else Not Applicable @endif</td>
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
                            @php
                                $ChecklistData = $data->checklists;

                                if (is_array($ChecklistData)
                                    && array_key_exists(0, $ChecklistData)
                                    && is_string($ChecklistData[0])
                                    && !empty($ChecklistData[0])) {

                                    $selectedChecklist = explode(',', $ChecklistData[0]);

                                } elseif (is_array($ChecklistData)) {

                                    $selectedChecklist = $ChecklistData;

                                } else {

                                    $selectedChecklist = [];
                                }
                            @endphp

                            @if(!empty($selectedChecklist))
                                {{ implode(', ', $selectedChecklist) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                @include('frontend.OOS.comps.allchecklistSingleReport')


                <table>

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
                            @if($data->Any_other_cause ){{ strip_tags($data->Any_other_cause) }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Any Other Batches Analyzed</th>
                        <td class="w-80">
                            @if($data->Any_other_batches ){{ strip_tags($data->Any_other_batches) }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Details Of Trend</th>
                        <td class="w-80">
                            @if($data->details_of_trend ){{ strip_tags($data->details_of_trend) }} @else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Assignable Cause And Rational For Assignable Cause</th>
                        <td class="w-80">
                            @if($data->rational_for_assingnable ){{ strip_tags($data->rational_for_assingnable) }} @else Not Applicable @endif
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
                                <td class="w-80">@if($data->impact_assesment_pia ){{ strip_tags($data->impact_assesment_pia) }} @else Not Applicable @endif</td>
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
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
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
                              <td class="w-80">Not Applicable</td>
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
                  <div class="block-head">Phase IA CQAH/QAH Review</div>
              
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
                </table>

                    @php
                        $IIB_inv_questions = [
                            "Analyst Interview required?",
                            "Raw data Examination? (Examination of raw data, including chromatograms and spectra; any anomalous or suspect peaks or data)",
                            "The analyst is trained on the method.?",
                            "Any Previous issues with this test?",
                            "Other potentially interfering testing/activities occurring at the time of the test?",
                            "Review of other data ? (Review of other data for other batches performed within the same analyst set)",
                            "Other OOS results ? (Consideration of any other OOS results obtained on the batch of material under test)",
                            "Assessment of method validation ? (Assessment of method validation and clarity of instructions in the worksheet)",
                            "Adequacy of instructions? (Assessment of the adequacy of instructions in the STP procedure)",
                            "Any issues with environmental temperature/humidity within the area which the test was conducted?",
                            "Reoccurrence (Whether any similar occurrence(s) with the analysis earlier)?",
                            "Observation Error (Analyst) [Any other observation Error]?",
                        ];

                        $IIB_inv_answers = [];

                        if (!empty($checklist_IB_invs->data)) {
                            // Agar string hai, json_decode karo
                            if (is_string($checklist_IB_invs->data)) {
                                $IIB_inv_answers = json_decode($checklist_IB_invs->data, true);
                            } elseif (is_array($checklist_IB_invs->data)) {
                                // Agar already array hai, direct assign karo
                                $IIB_inv_answers = $checklist_IB_invs->data;
                            }
                        }
                    @endphp
                    <div class="block">
                        <div class="block-head">Phase IB investigation Checklist</div>
                    </div>
                    <table border="1" width="100%" cellspacing="0" cellpadding="6">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="55%">Question</th>
                                <th width="15%">Response</th>
                                <th width="25%">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($IIB_inv_questions as $index => $question)
                                @php
                                    $answer = $IIB_inv_answers[$index] ?? null;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $question }}</td>
                                    <td>{{ $answer['response'] ?? 'Not Applicable' }}</td>
                                    <td>{{ $answer['remark'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table>





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
                        <th class="w-20">Phase IB Assignable Cause Found</th>
                        <td class="w-80">@if($data->phase_ib_assi_cause ){{ $data->phase_ib_assi_cause }} @else Not Applicable @endif</td>
                    </tr>


                    <tr>
                        <th class="w-20">Phase IB Assignable Cause Found</th>
                        <td class="w-80">@if($data->phase_ib_assi_cause ){{ $data->phase_ib_assi_cause }} @else Not Applicable @endif</td>
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

            {{-- @include('frontend.OOS.comps.allchecklistSingleReport') --}}

            <div class="block">
                <div class="block-head"> Phase II A Investigation </div>
                {{-- <div class = "inner-block">
                    <label class="summer" style="font-weight: bold; font-size:13px; display:inline;">Checklist Outcome</label>
                    <span style="font-size:0.8rem; margin-left:10px">@if($data->checklist_outcome_iia ){{ $data->checklist_outcome_iia }} @else Not Applicable @endif</span>
                </div> --}}



               @php
                    $phase_two_inv_questions = [
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
                    ];

                    $phase_two_answers = [];

                    if ($phase_two_invss && !empty($phase_two_invss->data)) {
                        if (is_string($phase_two_invss->data)) {
                            $phase_two_answers = json_decode($phase_two_invss->data, true);
                        } elseif (is_array($phase_two_invss->data)) {
                            $phase_two_answers = $phase_two_invss->data;
                        }
                    }
                @endphp

                <div class="block-head">CheckList - Phase II Investigation</div>
                <div class="border-table">
                    <table border="1" width="100%" cellspacing="0" cellpadding="6">
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>

                        @if(!empty($phase_two_answers))
                            @foreach($phase_two_inv_questions as $index => $question)
                                @php
                                    $answer = $phase_two_answers[$index] ?? [];
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $question }}</td>
                                    <td>{{ $answer['response'] ?? 'Not Applicable' }}</td>
                                    <td>{{ $answer['remarks'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align:center;">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block">
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
                </div>
                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Checklist Outcome</th>
                            <td class="w-80">@if($data->checklist_outcome_iia ){{ strip_tags($data->checklist_outcome_iia) }} @else Not Applicable @endif</td>
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
                            <td class="w-80">@if($data->qa_approver_comments_piii ) {{ strip_tags($data->qa_approver_comments_piii) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Delay Justification For Investigation</th>
                            <td class="w-80">@if($data->reason_manufacturing_delay ){{ strip_tags($data->reason_manufacturing_delay) }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Any Other Cause/Suspected Cause</th>
                            <td class="w-80">@if($data->audit_comments_piii ){{ strip_tags($data->audit_comments_piii) }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Summary Investigation</th>
                            <td class="w-80">@if($data->hypo_exp_reference_piii ){{ strip_tags($data->hypo_exp_reference_piii) }} @else Not Applicable @endif</td>
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
                            <td class="w-80">@if($data->impact_assessment_IIA ){{ strip_tags($data->impact_assessment_IIA) }} @else Not Applicable @endif</td>
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
                                    <td class="w-80">Not Applicable</td>
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
                                    <td class="w-80">Not Applicable</td>
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
                    <div class="block">
                    <div class="block-head">Phase IIB inv. Attachment</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-80"> Attachment </th>
                                </tr>
                                @if ($data->phaseII_attachment)
                                @foreach ($data->phaseII_attachment as $key => $file)
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
                                            <td class="w-80">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                    </div>

                 {{-- <!-- P-II A QAH/CQAH --> ~Aditya Rajput --}}

                            {{-- <div class="block">
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
                            </div> --}}

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
                                    <div class="block-head">Batch Disposition</div>
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
                                                <td class="w-80">Not Applicable</td>
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
                                                    <th class="w-20">Justify for Averaging Results</th>
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
                                                    <th class="w-20">CAPA Ref jNo.</th>
                                                    <td class="w-30">
                                                        {{ is_array($data->capa_ref_no_oosc)
                                                            ? $data->capa_ref_no_oosc[0]
                                                            : ($data->capa_ref_no_oosc ?? 'Not Applicable')
                                                        }}
                                                    </td>
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
                                                            <td class="w-80">Not Applicable</td>
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
                                                            <td class="w-80">Not Applicable</td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                        </table>
                                    </div>



                                <div class="block">
                                    <div class="block-head">
                                        Activity Log
                                    </div>
                                    <table>
                                        {{-- Propose Plan --}}
                                        <tr>
                                            <th class="w-20">Submit By</th>
                                            <td class="w-30">@if($data->Submite_by){{ $data->Submite_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">Submit On</th>
                                            <td class="w-30">@if($data->Submite_on){{ $data->Submite_on }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Submit Comment</th>
                                            <td colspan="3">@if($data->Submite_comment){{ $data->Submite_comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- Cancel --}}
                                        <tr>
                                            <th>Request for Cancellation By</th>
                                            <td>@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                                            <th>Request for Cancellation  On</th>
                                            <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Request for Cancellation Comment</th>
                                            <td colspan="3">@if($data->comment_cancle){{ $data->comment_cancle }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- HOD Review --}}
                                        <tr>
                                            <th>HOD Primary Review Complete By</th>
                                            <td>@if($data->HOD_Primary_Review_Complete_By){{ $data->HOD_Primary_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>HOD Primary Review Complete On</th>
                                            <td>@if($data->HOD_Primary_Review_Complete_On){{ $data->HOD_Primary_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>HOD Primary Review Complete Comment</th>
                                            <td colspan="3">@if($data->HOD_Primary_Review_Complete_Comment){{ $data->HOD_Primary_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- QA/CQA Review --}}
                                        {{-- <tr>
                                            <th>Cancel By</th>
                                            <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                            <th>Cancel On</th>
                                            <td>@if($data->qa_review_completed_on){{ $data->qa_review_completed_on }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Cancel Comment</th>
                                            <td colspan="3">@if($data->comment_cancle){{ $data->comment_cancle }}@else Not Applicable @endif</td>
                                        </tr> --}}

                                        {{-- Approved --}}
                                        <tr>
                                            <th>QA/CQA Head Primary Review Complete By</th>
                                            <td>@if($data->CQA_Head_Primary_Review_Complete_By){{ $data->CQA_Head_Primary_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>QA/CQA Head Primary Review Complete On</th>
                                            <td>@if($data->CQA_Head_Primary_Review_Complete_On){{ $data->CQA_Head_Primary_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>QA/CQA Head Primary Review Complete Comment</th>
                                            <td colspan="3">@if($data->CQA_Head_Primary_Review_Complete_Comment){{ $data->CQA_Head_Primary_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- Completed --}}
                                        <tr>
                                            <th>Phase IA Investigation  By</th>
                                            <td>@if($data->Phase_IA_Investigation_By){{ $data->Phase_IA_Investigation_By }}@else Not Applicable @endif</td>
                                            <th>Phase IA Investigation  On</th>
                                            <td>@if($data->Phase_IA_Investiigation_On){{ $data->Phase_IA_Investiigation_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase IA Investigation  Comment</th>
                                            <td colspan="3">@if($data->Phase_IA_Investigation_Comment){{ $data->Phase_IA_Investigation_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- HOD Final Review --}}
                                        <tr>
                                            <th>Phase IA HOD Review Complete By</th>
                                            <td>@if($data->Phase_IA_HOD_Review_Complete_By){{ $data->Phase_IA_HOD_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase IA HOD Review Complete On</th>
                                            <td>@if($data->Phase_IA_HOD_Review_Complete_On){{ $data->Phase_IA_HOD_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase IA HOD Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_IA_HOD_Review_Complete_Comment){{ $data->Phase_IA_HOD_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- QA/CQA Closure Review --}}
                                        <tr>
                                            <th> Phase IA QA/CQA Review Complete By</th>
                                            <td>@if($data->Phase_IA_QA_Review_Complete_By){{ $data->Phase_IA_QA_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th> Phase IA QA/CQA Review Complete On</th>
                                            <td>@if($data->Phase_IA_QA_Review_Complete_On){{ $data->Phase_IA_QA_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th> Phase IA QA/CQA Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_IA_QA_Review_Complete_Comment){{ $data->Phase_IA_QA_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        {{-- QAH/CQA Head Approval --}}
                                          <tr>
                                            <th>Assignable Cause Not Found By</th>
                                            <td>@if($data->Assignable_Cause_Not_Found_By){{ $data->Assignable_Cause_Not_Found_By }}@else Not Applicable @endif</td>
                                            <th>Assignable Cause Not Found On</th>
                                            <td>@if($data->Assignable_Cause_Not_Found_On){{ $data->Assignable_Cause_Not_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Assignable Cause Not Found Comment</th>
                                            <td colspan="3">@if($data->Assignable_Cause_Not_Found_Comment){{ $data->Assignable_Cause_Not_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>














                                         <tr>
                                            <th>Assignable Cause Found By</th>
                                            <td>@if($data->Assignable_Cause_Found_By){{ $data->Assignable_Cause_Found_By }}@else Not Applicable @endif</td>
                                            <th>Assignable Cause Found On</th>
                                            <td>@if($data->Assignable_Cause_Found_On){{ $data->Assignable_Cause_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Assignable Cause Found Comment</th>
                                            <td colspan="3">@if($data->Assignable_Cause_Found_Comment){{ $data->Assignable_Cause_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                         <tr>
                                            <th>Phase IB Investigation By</th>
                                            <td>@if($data->Phase_IB_Investigation_By){{ $data->Phase_IB_Investigation_By }}@else Not Applicable @endif</td>
                                            <th>Phase IB Investigation On</th>
                                            <td>@if($data->Phase_IB_Investigation_On){{ $data->Phase_IB_Investigation_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase IB Investigation Comment</th>
                                            <td colspan="3">@if($data->Phase_IB_Investigation_Comment){{ $data->Phase_IB_Investigation_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                         <tr>
                                            <th>Phase IB HOD Review Complete By</th>
                                            <td>@if($data->Phase_IB_HOD_Review_Complete_By){{ $data->Phase_IB_HOD_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase IB HOD Review Complete On</th>
                                            <td>@if($data->Phase_IB_HOD_Review_Complete_On){{ $data->Phase_IB_HOD_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase IB HOD Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_IB_HOD_Review_Complete_Comment){{ $data->Phase_IB_HOD_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                           <tr>
                                            <th>Phase IB QA/CQA Review Complete By</th>
                                            <td>@if($data->Phase_IB_QA_Review_Complete_By){{ $data->Phase_IB_QA_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase IB QA/CQA Review Complete On</th>
                                            <td>@if($data->Phase_IB_QA_Review_Complete_On){{ $data->Phase_IB_QA_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase IB QA/CQA Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_IB_QA_Review_Complete_Comment){{ $data->Phase_IB_QA_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        

                                        <tr>
                                            <th>P-IB Assignable Cause Not Found  By</th>
                                            <td>@if($data->P_I_B_Assignable_Cause_Not_Found_By){{ $data->P_I_B_Assignable_Cause_Not_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-IB Assignable Cause Not Found  On</th>
                                            <td>@if($data->P_I_B_Assignable_Cause_Not_Found_On){{ $data->P_I_B_Assignable_Cause_Not_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-IB Assignable Cause Not Found  Comment</th>
                                            <td colspan="3">@if($data->P_I_B_Assignable_Cause_Not_Found_Comment){{ $data->P_I_B_Assignable_Cause_Not_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                        

                                           <tr>
                                            <th>P-IB Assignable Cause Found By</th>
                                            <td>@if($data->P_I_B_Assignable_Cause_Found_By){{ $data->P_I_B_Assignable_Cause_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-IB Assignable Cause Found On</th>
                                            <td>@if($data->P_I_B_Assignable_Cause_Found_On){{ $data->P_I_B_Assignable_Cause_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-IB Assignable Cause Found Comment</th>
                                            <td colspan="3">@if($data->P_I_B_Assignable_Cause_Found_Comment){{ $data->P_I_B_Assignable_Cause_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                          <tr>
                                            <th>Phase II A Investigation By</th>
                                            <td>@if($data->Phase_II_A_Investigation_By){{ $data->Phase_II_A_Investigation_By }}@else Not Applicable @endif</td>
                                            <th>Phase II A Investigation On</th>
                                            <td>@if($data->Phase_II_A_Investigation_On){{ $data->Phase_II_A_Investigation_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II A Investigation Comment</th>
                                            <td colspan="3">@if($data->Phase_II_A_Investigation_Comment){{ $data->Phase_II_A_Investigation_Comment }}@else Not Applicable @endif</td>
                                        </tr>

                                          <tr>
                                            <th>Phase II A HOD Review Complete By</th>
                                            <td>@if($data->Phase_II_A_HOD_Review_Complete_By){{ $data->Phase_II_A_HOD_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase II A HOD Review Complete On</th>
                                            <td>@if($data->Phase_II_A_HOD_Review_Complete_On){{ $data->Phase_II_A_HOD_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II A HOD Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_II_A_HOD_Review_Complete_Comment){{ $data->Phase_II_A_HOD_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                          <tr>
                                            <th>Phase II A QA/CQA Review Complete By</th>
                                            <td>@if($data->Phase_II_A_QA_Review_Complete_By){{ $data->Phase_II_A_QA_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase II A QA/CQA Review Complete On</th>
                                            <td>@if($data->Phase_II_A_QA_Review_Complete_On){{ $data->Phase_II_A_QA_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II A QA/CQA Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_II_A_QA_Review_Complete_Comment){{ $data->Phase_II_A_QA_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                          <tr>
                                            <th>P-II A Assignable Cause Not Found By</th>
                                            <td>@if($data->P_II_A_Assignable_Cause_Not_Found_By){{ $data->P_II_A_Assignable_Cause_Not_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-II A Assignable Cause Not Found On</th>
                                            <td>@if($data->P_II_A_Assignable_Cause_Not_Found_On){{ $data->P_II_A_Assignable_Cause_Not_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-II A Assignable Cause Not Found Comment</th>
                                            <td colspan="3">@if($data->P_II_A_Assignable_Cause_Not_Found_Comment){{ $data->P_II_A_Assignable_Cause_Not_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>



                                          <tr>
                                            <th>P-II A Assignable Cause Found By</th>
                                            <td>@if($data->P_II_A_Assignable_Cause_Found_By){{ $data->P_II_A_Assignable_Cause_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-II A Assignable Cause Found On</th>
                                            <td>@if($data->P_II_A_Assignable_Cause_Found_On){{ $data->P_II_A_Assignable_Cause_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-II A Assignable Cause Found Comment</th>
                                            <td colspan="3">@if($data->P_II_A_Assignable_Cause_Found_Comment){{ $data->P_II_A_Assignable_Cause_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>



                                        
                                          <tr>
                                            <th>Phase II B Investigation By</th>
                                            <td>@if($data->Phase_II_B_Investigation_By){{ $data->Phase_II_B_Investigation_By }}@else Not Applicable @endif</td>
                                            <th>Phase II B Investigation On</th>
                                            <td>@if($data->Phase_II_B_Investigation_On){{ $data->Phase_II_B_Investigation_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II B Investigation Comment</th>
                                            <td colspan="3">@if($data->Phase_II_B_Investigation_Comment){{ $data->Phase_II_B_Investigation_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                        
                                          <tr>
                                            <th>Phase II B HOD Review Complete By</th>
                                            <td>@if($data->Phase_II_B_HOD_Review_Complete_By){{ $data->Phase_II_B_HOD_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase II B HOD Review Complete On</th>
                                            <td>@if($data->Phase_II_B_HOD_Review_Complete_On){{ $data->Phase_II_B_HOD_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II B HOD Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_II_B_HOD_Review_Complete_Comment){{ $data->Phase_II_B_HOD_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                           <tr>
                                            <th>Phase II B QA/CQA Review Complete By</th>
                                            <td>@if($data->Phase_II_B_QA_Review_Complete_By){{ $data->Phase_II_B_QA_Review_Complete_By }}@else Not Applicable @endif</td>
                                            <th>Phase II B QA/CQA Review Complete On</th>
                                            <td>@if($data->Phase_II_B_QA_Review_Complete_On){{ $data->Phase_II_B_QA_Review_Complete_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Phase II B QA/CQA Review Complete Comment</th>
                                            <td colspan="3">@if($data->Phase_II_B_QA_Review_Complete_Comment){{ $data->Phase_II_B_QA_Review_Complete_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                        <tr>
                                            <th>P-II B Assignable Cause Not Found By</th>
                                            <td>@if($data->P_II_B_Assignable_Cause_Not_Found_By){{ $data->P_II_B_Assignable_Cause_Not_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-II B Assignable Cause Not Found On</th>
                                            <td>@if($data->P_II_B_Assignable_Cause_Not_Found_On){{ $data->P_II_B_Assignable_Cause_Not_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-II B Assignable Cause Not Found Comment</th>
                                            <td colspan="3">@if($data->P_II_B_Assignable_Cause_Not_Found_Comment){{ $data->P_II_B_Assignable_Cause_Not_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>


                                         <tr>
                                            <th>P-II B Assignable Cause Found By</th>
                                            <td>@if($data->P_II_B_Assignable_Cause_Found_By){{ $data->P_II_B_Assignable_Cause_Found_By }}@else Not Applicable @endif</td>
                                            <th>P-II B Assignable Cause Found On</th>
                                            <td>@if($data->P_II_B_Assignable_Cause_Found_On){{ $data->P_II_B_Assignable_Cause_Found_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P-II B Assignable Cause Found Comment</th>
                                            <td colspan="3">@if($data->P_II_B_Assignable_Cause_Found_Comment){{ $data->P_II_B_Assignable_Cause_Found_Comment }}@else Not Applicable @endif</td>
                                        </tr>



                                        <tr>
                                            <th>P III Investigation Applicable/Not Applicable By</th>
                                            <td>@if($data->P_III_Investigation_Applicable_By){{ $data->P_III_Investigation_Applicable_By }}@else Not Applicable @endif</td>
                                            <th>P III Investigation Applicable/Not Applicable On</th>
                                            <td>@if($data->P_III_Investigation_Applicable_On){{ $data->P_III_Investigation_Applicable_On }}@else Not Applicable @endif</td>
                                        </tr>
                                        <tr>
                                            <th>P III Investigation Applicable/Not Applicable Comment</th>
                                            <td colspan="3">@if($data->P_III_Investigation_Applicable_Comment){{ $data->P_III_Investigation_Applicable_Comment }}@else Not Applicable @endif</td>
                                        </tr>
                                        
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

    @if (count($Extension) > 0)
        @foreach ($Extension as $data)

            <center>
                <h3>Extension Child Report</h3>
            </center>

            <div class="inner-block">
                <div class="content-table">
                    <div class="block">
                        <div class="block-head">General Information</div>
                        <table>
                            <tr>
                                <th class="w-20">Record Number</th>
                                <td class="w-30">
                                    @if ($data->record_number)
                                        {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Site/Location Code</th>
                                <td class="w-30">
                                    @if ($data->site_location_code)
                                        {{ Helpers::getDivisionName($data->site_location_code) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator</th>
                                <td class="w-30">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                                <th class="w-20">Date of Initiation</th>
                                <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Short Description</th>
                                <td class="w-80">
                                    @if ($data->short_description)
                                        {{ $data->short_description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Extension Number</th>
                                <td class="w-30">
                                    @if ($data->count)
                                        {{ $data->count }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            
                                <th class="w-20">HOD Review</th>
                                <td class="w-30">
                                    @if ($data->reviewers)
                                        {{ Helpers::getInitiatorName($data->reviewers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Parent Record Number</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                <th class="w-20">QA/CQA Approval</th>
                                <td class="w-30">
                                    @if ($data->approvers)
                                        {{ Helpers::getInitiatorName($data->approvers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Current Due Date (Parent)</th>
                                <td class="w-30">
                                    @if ($data->current_due_date)
                                        {{ Helpers::getdateFormat($data->current_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Proposed Due Date</th>
                                <td class="w-30">
                                    @if ($data->proposed_due_date)
                                        {{ Helpers::getdateFormat($data->proposed_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20"> Description</th>
                                <td class="w-80">
                                    @if ($data->description)
                                        {{ $data->description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>    
                                <th class="w-20">Justification / Reason</th>
                                <td class="w-80">
                                    @if ($data->justification_reason)
                                        {{ $data->justification_reason }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">Attachment Extension</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_extension)
                                    @foreach (json_decode($data->file_attachment_extension) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
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
                    <div class="block">
                        <div class="block-head">HOD Review</div>

                        <table>
                            <tr>
                                <th class="w-20">HOD Remarks</th>
                                <td class="w-80">
                                    @if ($data->reviewer_remarks)
                                        {{ $data->reviewer_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">HOD Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_reviewer)
                                    @foreach (json_decode($data->file_attachment_reviewer) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
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
                @if ($data->count != 3)  
                    <div class="block">
                        <div class="block-head">QA/CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">QA/CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->approver_remarks)
                                        {{ $data->approver_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">QA/CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_approver)
                                    @foreach (json_decode($data->file_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
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

                @endif
                @if ($data->count == 3)  
                    <div class="block">
                        <div class="block-head">CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->QAapprover_remarks)
                                        {{ $data->QAapprover_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>                

                    </div>
                    <div class="block">
                        <div class="block-head">CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-80">File</th>
                                </tr>
                                @if ($data->QAfile_attachment_approver)
                                    @foreach (json_decode($data->QAfile_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
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
                @endif

                    <div class="block">
                        <div class="block-head">Activity Log</div>
                        <table>
                            <tr>
                                <th class="w-20">Submit By</th>
                                <td class="w-30">@if ($data->submit_by) {{ $data->submit_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit On</th>
                                <td class="w-30">@if ($data->submit_on) {{ $data->submit_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit Comment</th>
                                <td class="w-30">@if ($data->submit_comment) {{ $data->submit_comment }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Cancel By</th>
                                <td class="w-30">@if ($data->reject_by) {{ $data->reject_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel On</th>
                                <td class="w-30">@if ($data->reject_on) {{ $data->reject_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel Comment</th>
                                <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_review_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_review_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_review_comment }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Review By</th>
                                <td class="w-30">@if ($data->submit_by_review) {{ $data->submit_by_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review On</th>
                                <td class="w-30">@if ($data->submit_on_review) {{ $data->submit_on_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review Comment</th>
                                <td class="w-30">@if ($data->submit_comment_review) {{ $data->submit_comment_review }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">System By</th>
                                <td class="w-80">{{ $data->submit_by_review }}</td>
                                <th class="w-20">System On</th>
                                <td class="w-80">{{ $data->submit_on_review }}</td>
                                <th class="w-20">System Comment</th>
                                <td class="w-80">{{ $data->submit_comment_review }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Reject By</th>
                                <td class="w-30">@if ($data->submit_by_inapproved) {{ $data->submit_by_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject On</th>
                                <td class="w-30">@if ($data->submit_on_inapproved) {{ $data->submit_on_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject Comment</th>
                                <td class="w-30">@if ($data->submit_commen_inapproved) {{ $data->submit_commen_inapproved }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                            </tr> --}}
                            <!-- @if($data->count == 3)
                                <tr>
                                    <th class="w-20">Send for CQA By</th>
                                    <td class="w-80">@if ($data->send_cqa_by) {{ $data->send_cqa_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA On</th>
                                    <td class="w-80">@if ($data->send_cqa_on) {{ $data->send_cqa_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA Comment</th>
                                    <td class="w-80">@if ($data->send_cqa_comment) {{ $data->send_cqa_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif -->
                            @if($data->count != 3)
                                <tr>
                                    <th class="w-20">Approved By</th>
                                    <td class="w-30">@if ($data->submit_by_approved) {{ $data->submit_by_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved On</th>
                                    <td class="w-30">@if ($data->submit_on_approved) {{ $data->submit_on_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved Comment</th>
                                    <td class="w-30">@if ($data->submit_comment_approved) {{ $data->submit_comment_approved }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                            @if($data->count == 3)
                                <tr>
                                    <th class="w-20">CQA Approval Complete By</th>
                                    <td class="w-30">@if ($data->cqa_approval_by) {{ $data->cqa_approval_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete On</th>
                                    <td class="w-30">@if ($data->cqa_approval_on) {{ $data->cqa_approval_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete Comment</th>
                                    <td class="w-30">@if ($data->cqa_approval_comment) {{ $data->cqa_approval_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

    @if (count($ActionItem) > 0)
        @foreach ($ActionItem as $data)

        <center>
            <h3>Action Item Child Report</h3>
        </center>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        General Information
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Record Number</th>
                            <td class="w-30">
                                @if ($data->record)
                                    {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->division_id)
                                    {{ Helpers::getDivisionName($data->division_id) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        </tr>

                        <tr>
                            <th class="w-20">Parent Record Number</th>
                            <td class="w-30">
                                @if ($data->parent_record_number)
                                    {{ $data->parent_record_number }}
                                @elseif($data->parent_record_number_edit)
                                    {{ $data->parent_record_number_edit }}
                                    @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Assigned To</th>
                            <td class="w-30">
                                @if ($data->assign_to)
                                    {{ Helpers::getInitiatorName($data->assign_to) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-80">
                                @if ($data->due_date)
                                    {{ Helpers::getdateFormat($data->due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Short Description</th>
                                <td class="w-80">
                                    @if ($data->short_description)
                                        {{ $data->short_description }}
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
                                <th class="w-20">Action Item Related Records</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                            {{-- <tr>
                                <th class="w-20">HOD Persons</th>
                                <td class="w-80">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr> --}}

                                <th class="w-20">HOD Persons</th>
                                <td class="w-30">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- <div class="other-container ">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            <div class="bold">Description</div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="custom-procedure-block" style="margin-left: 12px">
                                <div class="custom-container">
                                    <div class="custom-table-wrapper" id="custom-table2">
                                        <div class="custom-procedure-content">
                                            <div class="custom-content-wrapper">
                                                <div class="table-containers">
                                                    {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="other-container">
                            <table style="width:100%; border-collapse: collapse;">
                                    <tr>
                                        <th class="w-20">
                                            <strong>Description</strong>
                                        </th>
                                        <td class="w-80">
                                            {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Responsible Department</th>
                                <td class="w-80">
                                    @if ($data->departments)
                                        {{ $data->departments }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="block-head">
                        File Attachment
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20"> Sr.No.</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                            @if ($data->file_attach)
                                @php $files = json_decode($data->file_attach); @endphp
                                @if (count($files) > 0)
                                    @foreach ($files as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>



                <div class="block-head">
                    Acknowledge
                </div>
                <table>
                    <tr>
                        <th class="w-20">Acknowledge Comment</th>
                        <td class="w-80">
                            @if ($data->acknowledge_comments)
                                {{ $data->acknowledge_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                    Acknowledge Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->acknowledge_attach)
                            @php $files = json_decode($data->acknowledge_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                    Post Completion
                </div>
                <table>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-80">
                            @if ($data->action_taken)
                                {{ $data->action_taken }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Actual Start Date</th>
                        <td class="w-30">
                            @if ($data->start_date)
                                {{ Helpers::getdateFormat($data->start_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Actual End Date</th>
                        <td class="w-30">
                            @if ($data->end_date)
                                {{ Helpers::getdateFormat($data->end_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="block-head">
                    Completion Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->Support_doc)
                            @php $files = json_decode($data->Support_doc); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                QA/CQA Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Verification Comments</th>
                        <td class="w-80">
                            @if ($data->qa_comments)
                                {{ $data->qa_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                        QA/CQA Verification Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->final_attach)
                            @php $files = json_decode($data->final_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="block" style="margin-top: 15px;">
                    <div class="block-head">
                        Activity Log
                    </div>
                    <table>
                        <tr>
                            <th class="w-10">Submit By</th>
                            <td class="w-20">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit On</th>
                            <td class="w-20">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit Comment</th>
                            <td class="w-30">@if($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</td>
                        </tr>


                        

                        <!-- </table>
                        <div class="block-head">
                            Cancel
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Cancel By</th>
                            <td class="w-20">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel On</th>
                            <td class="w-20">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel Comment</th>
                            <td class="w-30">@if($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</td>
                        </tr>

                        <!-- </table>
                        <div class="block-head">
                            Acknowledge Complete
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Acknowledge Complete By</th>
                            <td class="w-20">@if($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete On</th>
                            <td class="w-20">@if($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete Comment</th>
                            <td class="w-30">@if($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                            Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Complete By</th>
                            <td class="w-20">@if($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete On</th>
                            <td class="w-20">@if($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete Comment</th>
                            <td class="w-30">@if($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                        Verification Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Verification Complete By</th>
                            <td class="w-20">@if($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete On</th>
                            <td class="w-20">@if($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete Comment</th>
                            <td class="w-30">@if($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @endforeach
    @endif

    @if (count($capa_Data) > 0)
        @foreach ($capa_Data as $data)

        <center>
            <h3>Capa Child Report</h3>
        </center>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        General Information
                    </div>
                    <table>
                    <tr>
                            <th class="w-20">Record Number</th>
                            <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ $data->originator }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                        </tr>

                        <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ $data->assign_to }} @else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                            <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Initiator Department</th>

                            <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                            {{-- <td class="w-30">{{ Helpers::getFullDepartmentName($data->initiator_Group) }}</td> --}}

                            <th class="w-20">Initiator Department Code</th>
                            <td class="w-30">{{ $data->initiator_group_code }}</td>

                        </tr>


                        </table>
                        <table>

                        <tr>
                                <th class="w-20">Short Description</th>

                                <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        </tr>

                        <tr>

                        <th class="w-20">Initiated Through</th>
                            <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                        </tr>

                        </table>

                        <table>


                            <tr>

                    <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat ){{ $data->repeat }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>


                    </table>

                    <table>
                        <tr>
                            <th class="w-20">Problem Description</th>
                            <td class="w-80" colspan="5">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">CAPA Team</th>
                            <td class="w-80" colspan="5">@if($data->capa_team){{  $capa_teamNamesString }}@else Not Applicable @endif</td>

                        </tr>
                    </table>
                    <table>

                    <table>
                        <tr>
                                <th class="w-20">Reference Records</th>
                                <td class="w-80" colspan="5">
                                    @if($data->parent_record_number_edit){{ $data->parent_record_number_edit}}@else Not Applicable @endif
                                    {{--@if($data->capa_related_record){{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif--}}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20"> Initial Observation</th>
                                <td class="w-80" colspan="5">
                                @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <th class="w-20">Interim Containment</th>

                        <td class="w-80">
                                @if($data->interim_containnment)
                                    {{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->interim_containnment))) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>   
                        </tr>
                        <tr>
                            <th class="w-20"> Containment Comments </th>
                            <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                        </tr>
                    </table>
                   

                    <div class="block-head">
                        CAPA Attachments
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->capa_attachment)
                                    @foreach(json_decode($data->capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                </div>

                <div class="block">
                        <div class="block-head">
                            Other Type Details

                            </div>
                            <table>
                                <tr>
                                <th class="w-20">Investigation Summary</th>
                                <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                <th class="w-20">Root Cause</th>
                                <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Product / Material Details
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-10">Sr.No.</th>
                                    <th class="w-20">Product / Material Name</th>
                                    <th class="w-20">Product /Material Batch No./Lot No./AR No.</th>
                                    <th class="w-20">Product / Material Manufacturing Date</th>
                                    <th class="w-20">Product / Material Date of Expiry</th>
                                    <th class="w-20">Product Batch Disposition Decision</th>
                                    <th class="w-20">Product Remark</th>
                                    <th class="w-20">Product Batch Status</th>
                                </tr>
                                    {{-- @if($data->root_cause_initial_attachment)
                                    @foreach(json_decode($data->root_cause_initial_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else --}}
                                    @if($data->Material_Details->material_name)
                                    @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $dataDemo ? $key + 1  : "NA" }}</td>
                                        <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "NA"}}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "NA" }}</td>
                                        <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "NA" }}</td>
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
                        <br>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Equipment/Instruments Details
                            </div>
                            <div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-25">Sr.No.</th>
                                        <th class="w-25">Equipment/Instruments Name</th>
                                        <th class="w-25">Equipment/Instrument ID</th>
                                        <th class="w-25">Equipment/Instruments Comments</th>
                                    </tr>
                                    @if($data->Instruments_Details->equipment)
                                    @foreach (unserialize($data->Instruments_Details->equipment) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $dataDemo ? $key +1  : "Not Applicable" }}</td>

                                        <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                                        <td class="w-15">{{unserialize($data->Instruments_Details->equipment_instruments)[$key] ?  unserialize($data->Instruments_Details->equipment_instruments)[$key] : "Not Applicable" }}</td>
                                        <td class="w-15">{{unserialize($data->Instruments_Details->equipment_comments)[$key] ?  unserialize($data->Instruments_Details->equipment_comments)[$key] : "Not Applicable" }}</td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>

                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block-head">
                            Other Type CAPA Details
                            </div>
                            <table>
                            <tr>
                                <th class="w-20">Details</th>
                                <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>

                            </tr>
                            </table>

                        <div class="block">
                            <div class="block-head">
                                CAPA Details
                                </div>
                                <table>
                                <tr>

                                    <th class="w-20">CAPA Type</th>
                                    <td class="w-80" colspan="3"> @if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                                </tr>

                                
                                @if($data->corrective_action) 
                                <tr>

                                    <th class="w-20">Corrective Action</th>
                                    <td class="w-80" colspan="3"> @if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif

                                @if($data->preventive_action) 
                                <tr>

                                    <th class="w-20">Preventive Action</th>
                                    <td class="w-80" colspan="3"> @if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif
                                </table>

                        <div class="block-head">
                            File Attachment
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->capafileattachement)
                                        @foreach(json_decode($data->capafileattachement) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif

                                </table>
                            </div>
                        </table>
                        </div>
                        <br>
                <div class="block">
                    <div class="block-head">
                    HOD Review
                    </div>
                    <div>
                    <table>
                        <tr>
                            <th class="w-20">HOD Remark</th>
                            <td class="w-80">@if($data->hod_remarks){{ $data->hod_remarks }}@else Not Applicable @endif</td>

                        </tr>
                        </table>

                        <div class="block-head">
                            HOD Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->hod_attachment)
                                    @foreach(json_decode($data->hod_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                    </div>
                        <br>
                        <div class="block">
                    <div class="block-head">
                        QA/CQA Review
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th class="w-20"> QA/CQA Review Comment </th>
                                <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                            </tr>
                        </table>

                        <div class="block-head">
                            QA/CQA Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_attachment)
                                    @foreach(json_decode($data->qa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                        QA/CQA Approval
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Approval Comment</th>
                                            <td class="w-80">@if($data->qah_cq_comments){{ $data->qah_cq_comments }}@else Not Applicable @endif</td>

                                        </tr>
                        </table> <div class="block-head">
                            QA/CQA Approval Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qah_cq_attachment)
                                    @foreach(json_decode($data->qah_cq_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                    </div>


                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    Initiator CAPA update
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">Initiator CAPA Update Comment</th>
                                            <td class="w-80">@if($data->initiator_comment){{ $data->initiator_comment}}@else Not Applicable @endif</td>

                                            </tr>
                        </table>

                        <div class="block-head">
                            Initiator CAPA update Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->initiator_capa_attachment)
                                    @foreach(json_decode($data->initiator_capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    HOD Final Review
                                    </div>
                                    <div>
                                        <table>
                                            <tr>
                                                <th class="w-20">HOD Final Review Comments</th>
                                                <td class="w-80">@if($data->hod_final_review ){{ $data->hod_final_review }}@else Not Applicable @endif</td>

                                            </tr>
                                        </table>
                        <div class="block-head">
                            HOD Final Attachment
                        </div>
                        <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->hod_final_attachment)
                                        @foreach(json_decode($data->hod_final_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif

                                </table>
                        </div>
                    </table>
                    </div>
                        <br>

                        <div class="block">
                                    <div class="block-head">
                                    QA/CQA Closure Review
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Closure Review Comment</th>
                                            <td class="w-80">@if($data->qa_cqa_qa_comments){{ $data->qa_cqa_qa_comments }}@else Not Applicable @endif</td>

                                                </tr>
                        </table>
                        <div class="block-head">
                            QA/CQA Closure Review Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_closure_attachment)
                                    @foreach(json_decode($data->qa_closure_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </table>
                    </div>




                        <div class="block">
                        <div class="block-head">
                        CAPA Closure
                        </div>
                        <table>
                        <tr>

                        <th class="w-20">
                        Effectiveness check required
                            </th>
                        <td class="w-80">
                            @if($data->effectivness_check){{ $data->effectivness_check }}@else Not Applicable @endif
                            </td>
                        </tr>
                        <tr>
                        <th class="w-20">QA/CQA Head Closure Review Comment</th>
                        <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                        </tr>
                        </table>
                        </div>

                    </table>
                </div>



                                <div class="block-head">
                                    QA/CQA Head Closure Review Attachment
                                </div>
                                <div class="border-table">
                                    <table>
                                        <tr class="table_bg">
                                            <th class="w-20">Sr.No</th>
                                            <th class="w-60">Attachment </th>
                                        </tr>
                                            @if($data->closure_attachment)
                                            @foreach(json_decode($data->closure_attachment) as $key => $file)
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
                                {{-- <div class="block-head">
                                    Extension Justification
                                </div>

                                <table>
                                    <tr>
                                        <th class="w-20">Due Date Extension Justification</th>
                                            <td class="w-80">
                                                {{ $data->due_date_extension }}</td>
                                    </tr>
                                </table> --}}

                            <div class="block">
                                <div class="block-head">
                                    Activity Log
                                </div>
                                <table>
                                    {{-- Propose Plan --}}
                                    <tr>
                                        <th class="w-20">Propose Plan By</th>
                                        <td class="w-30">@if($data->plan_proposed_by){{ $data->plan_proposed_by }}@else Not Applicable @endif</td>
                                        <th class="w-20">Propose Plan On</th>
                                        <td class="w-30">@if($data->plan_proposed_on){{ $data->plan_proposed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Propose Plan Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Cancel --}}
                                    <tr>
                                        <th>Cancel By</th>
                                        <td>@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                                        <th>Cancel On</th>
                                        <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Cancel Comment</th>
                                        <td colspan="3">@if($data->cancelled_on_comment){{ $data->cancelled_on_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Review --}}
                                    <tr>
                                        <th>HOD Review Complete By</th>
                                        <td>@if($data->hod_review_completed_by){{ $data->hod_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Review Complete On</th>
                                        <td>@if($data->hod_review_completed_on){{ $data->hod_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Review Complete Comment</th>
                                        <td colspan="3">@if($data->hod_comment){{ $data->hod_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Review --}}
                                    <tr>
                                        <th>QA/CQA Review Complete By</th>
                                        <td>@if($data->qa_review_completed_by){{ $data->qa_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Review Complete On</th>
                                        <td>@if($data->qa_review_completed_on){{ $data->qa_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_comment){{ $data->qa_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Approved --}}
                                    <tr>
                                        <th>Approved By</th>
                                        <td>@if($data->approved_by){{ $data->approved_by }}@else Not Applicable @endif</td>
                                        <th>Approved On</th>
                                        <td>@if($data->approved_on){{ $data->approved_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Approved Comment</th>
                                        <td colspan="3">@if($data->approved_comment){{ $data->approved_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Completed --}}
                                    <tr>
                                        <th>Completed By</th>
                                        <td>@if($data->completed_by){{ $data->completed_by }}@else Not Applicable @endif</td>
                                        <th>Completed On</th>
                                        <td>@if($data->completed_on){{ $data->completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Complete Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Final Review --}}
                                    <tr>
                                        <th>HOD Final Review Complete By</th>
                                        <td>@if($data->hod_final_review_completed_by){{ $data->hod_final_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Final Review Complete On</th>
                                        <td>@if($data->hod_final_review_completed_on){{ $data->hod_final_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Final Review Complete Comment</th>
                                        <td colspan="3">@if($data->final_comment){{ $data->final_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Closure Review --}}
                                    <tr>
                                        <th>QA/CQA Closure Review Complete By</th>
                                        <td>@if($data->qa_closure_review_completed_by){{ $data->qa_closure_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Closure Review Complete On</th>
                                        <td>@if($data->qa_closure_review_completed_on){{ $data->qa_closure_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Closure Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_closure_comment){{ $data->qa_closure_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QAH/CQA Head Approval --}}
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete By</th>
                                        <td>@if($data->qah_approval_completed_by){{ $data->qah_approval_completed_by }}@else Not Applicable @endif</td>
                                        <th>QAH/CQA Head Approval Complete On</th>
                                        <td>@if($data->qah_approval_completed_on){{ $data->qah_approval_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete Comment</th>
                                        <td colspan="3">@if($data->qah_comment){{ $data->qah_comment }}@else Not Applicable @endif</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        </div>
            </div>
        </div>

        @endforeach
    @endif

    @if ($RootCause->isNotEmpty())
        @foreach ($RootCause as $data)

        <center>
            <h3>Root Cause Analysis Child Report</h3>
        </center>

        <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_code)
                                {{ $data->division_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>

                    <tr>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ( Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                {{  Helpers::getUsersDepartmentName(Auth::user()->departmentid)}}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> 
                <table>   
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Name Of Responsible Department Head</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->initiated_if_other)
                                    {!! $data->initiated_if_other !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            {{-- <th class="w-20">Type</th>
                            <td class="w-30">
                                @if ($data->Type)
                                    {{ $data->Type }}
                                @else
                                    Not Applicable
                                @endif
                            </td> --}}
                        </tr>
                    </table>
                    <table>    

                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->department)
                                    {{ $data->department }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                   
                </table>

                <div class="block-head">
                    Investigation Details
                </div>
                <table>
                    <tr>
                        <th class="w-20" >Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">
                            @if ($data->comments)
                                {{ $data->comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                
                <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->root_cause_initial_attachment)
                            @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
            <div class="block-head">
              HOD Review
            </div>
            <table>
                <tr>
                    <th class="w-20" >HOD Review Comment</th>
                    <td class="w-80">
                        @if ($data->hod_comments)
                            {{ $data->hod_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_attachments)
                        @foreach (json_decode($data->hod_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
            <div class="block-head">
              Initial QA/CQA Review 
            </div>
            <table>
                <tr>
                    <th class="w-20" >Initial QA/CQA Review Comments</th>
                    <td class="w-80">
                        @if ($data->cft_comments_new)
                            {{ $data->cft_comments_new }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            
            <div class="border-table">
                <div class="block-head">
                    Initial QA/CQA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cft_attchament_new)
                        @foreach (json_decode($data->cft_attchament_new) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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


        <style>
            .tableFMEA {
                width: 100%;
                border-collapse: collapse;
                font-size: 7px;
                table-layout: fixed; /* Ensures columns are evenly distributed */
            }

            .thFMEA,
            .tdFMEA {
                border: 1px solid black;
                padding: 5px;
                word-wrap: break-word;
                text-align: center;
                vertical-align: middle;
                font-size: 6px; /* Apply the same font size for all cells */
            }

            /* Rotating specific headers */
            .rotate {
                transform: rotate(-90deg);
                white-space: nowrap;
                width: 10px;
                height: 100px;
            }

            /* Ensure the "Traceability Document" column fits */
            .tdFMEA:last-child,
            .thFMEA:last-child {
                width: 80px; /* Allocate more space for "Traceability Document" */
            }

            /* Adjust for smaller screens to fit */
            @media (max-width: 1200px) {
                .tdFMEA:last-child,
                .thFMEA:last-child {
                    font-size: 6px;
                    width: 70px; /* Shrink width further for smaller screens */
                }
            }

        </style>


        <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>
                <!-- <div class="block-head">
                    Investigation
                </div> -->

                <table>
                    <tr>
                        <th class="w-20">Objective</th>
                        <td class="w-80">
                            @if ($data->objective)
                                {!! strip_tags($data->objective) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


               

                <table>
                    <tr>
                        <th class="w-20">Scope</th>
                        <td class="w-80">
                            @if ($data->scope)
                                {!! strip_tags($data->scope) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($data->problem_statement_rca)
                                {!! strip_tags($data->problem_statement_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Background</th>
                        <td class="w-80">
                            @if ($data->requirement)
                                {!! strip_tags($data->requirement) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">
                            @if ($data->immediate_action)
                                {!! strip_tags($data->immediate_action) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Team</th>
                        <td class="w-80">
                            @if ($data->investigation_team)
                                {{($investigation_teamNamesString) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>        
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if (!empty($data->selectedMethodologies))
                                {{ implode(', ', $data->selectedMethodologies) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <br><br>
                <div class="border-table  tbl-bottum">
                    <div class="block-head">
                        Failure Mode and Effect Analysis
                    </div>
                    <table class="tableFMEA">
                        <thead>
                            <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                <th class="thFMEA" rowspan="2">Sr.No</th>
                                <th class="thFMEA" colspan="2">Risk Identification</th>
                                <th class="thFMEA">Risk Analysis</th>
                                <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                <th class="thFMEA">Risk Control</th>
                                <th class="thFMEA" colspan="6">Risk Evaluation</th>

                                <th class="thFMEA" rowspan="2">Traceability Document</th>
                                
                            </tr>
                            <tr class="table_bg">
                                <th class="thFMEA">Activity</th>
                                <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                <!-- <th class="thFMEA">Others</th>
                                <th class="thFMEA">Attchment</th> -->
                                
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($data->risk_factor))
                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                <tr class="tr">
                                    <td class="tdFMEA">{{ $key + 1 }}</td>
                                    <td class="tdFMEA">{{ $riskFactor }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                    
                                </tr>
                            @endforeach
                            @else
                            @endif

                        </tbody>
                    </table>

                </div>
               
                <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>

                @if (!empty($data))
                    @php
                        $measurement = !empty($data->measurement) ? unserialize($data->measurement) : [];
                        $materials = !empty($data->materials) ? unserialize($data->materials) : [];
                        $methods = !empty($data->methods) ? unserialize($data->methods) : [];

                        $environment = !empty($data->environment) ? unserialize($data->environment) : [];
                        $manpower = !empty($data->manpower) ? unserialize($data->manpower) : [];
                        $machine = !empty($data->machine) ? unserialize($data->machine) : [];

                        $problem_statement = $data->problem_statement ?? 'N/A';

                        $maxCount = max(count($measurement), count($materials), count($methods));
                        $maxCount2 = max(count($environment), count($manpower), count($machine));
                    @endphp

                    <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                        <!-- Top Table -->
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr valign="top">
                                <!-- First Table -->
                                <td style="width: 70%;">
                                    <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                        <thead>
                                            <tr style="color: #007bff;">
                                                <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $maxCount; $i++)
                                                <tr>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>        
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr >
                                <td style="width: 70%;">
                                    <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                </td>
                                <td style="width: 30%;">
                                    <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                                        <strong style="color: #007bff;">Problem Statement:</strong>
                                        <div style="margin-top: 10px;">
                                            {{ $data->problem_statement ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>       
                            </tr>
                        </table>


                        <!-- Second Table -->
                        <table style="width: 70%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="color: #007bff;">
                                    <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $maxCount2; $i++)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                @else
                    <p style="text-align: center; color: red;">No Fishbone data available.</p>
                @endif



                    <br><br><br><br>
                

                <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Inference
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-5">Sr.No.</th>
                            <th class="w-30">Type</th>
                            <th class="w-30">Remarks</th>
                        </tr>

                        @if (!empty($data->inference_type))
                            @foreach (unserialize($data->inference_type) as $key => $inference_type)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_type)[$key] ? unserialize($data->inference_type)[$key] : 'Not Applicable' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_remarks)[$key] ? unserialize($data->inference_remarks)[$key] : 'Not Applicable' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div>

                




                <div class="why-why-chart-container">
                    <div class="block-head">
                        <strong>Why-Why Chart</strong>
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="problem-statement">
                                <th>Problem Statement :</th>
                                <td>
                                    {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        @php
                            $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];
                        @endphp

                        @if (is_array($why_data) && count($why_data) > 0)
                            @foreach ($why_data as $index => $why)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="why-label">Why {{ $index + 1 }}</th>
                                            <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="answer-label">Answer {{ $index + 1 }}</th>
                                            <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <p class="text-muted">No Why-Why Data Available</p>
                        @endif
                    </div>

                    <div id="root-cause-container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="root-cause">
                                    <th>Root Cause :</th>
                                    <td>
                                        {{ $data->why_root_cause ?? 'Not Applicable' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="block-head">
                    Is/Is Not Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">What Will Be</th>
                        <td class="w-80">
                            @if ($data->what_will_be)
                                {{ $data->what_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Not Be </th>
                        <td class="w-80">
                            @if ($data->what_will_not_be)
                                {{ $data->what_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Rationale </th>
                        <td class="w-80">
                            @if ($data->what_rationable)
                                {{ $data->what_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Be</th>
                        <td class="w-80">
                            @if ($data->where_will_be)
                                {{ $data->where_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Not Be </th>
                        <td class="w-80">
                            @if ($data->where_will_not_be)
                                {{ $data->where_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Rationale </th>
                        <td class="w-80">
                            @if ($data->where_rationable)
                                {{ $data->where_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    <tr>
                        <th class="w-20">When Will Be</th>
                        <td class="w-80">
                            @if ($data->when_will_be)
                                {{ $data->when_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Not Be </th>
                        <td class="w-80">
                            @if ($data->when_will_not_be)
                                {{ $data->when_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Rationale </th>
                        <td class="w-80">
                            @if ($data->when_rationable)
                                {{ $data->when_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Be</th>
                        <td class="w-80">
                            @if ($data->coverage_will_be)
                                {{ $data->coverage_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Not Be </th>
                        <td class="w-80">
                            @if ($data->coverage_will_not_be)
                                {{ $data->coverage_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Rationale </th>
                        <td class="w-80">
                            @if ($data->coverage_rationable)
                                {{ $data->coverage_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Be</th>
                        <td class="w-80">
                            @if ($data->who_will_be)
                                {{ $data->who_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>

                        <th class="w-20">Who Will Not Be </th>
                        <td class="w-80">
                            @if ($data->who_will_not_be)
                                {{ $data->who_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Who Will Rationale </th>
                        <td class="w-80">
                            @if ($data->who_rationable)
                                {{ $data->who_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
            </div>


                <table>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->root_cause_Others)
                                {!! strip_tags($data->root_cause_Others) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="border-table">
                    <div class="block-head">
                        Other Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->investigation_attachment)
                            @foreach (json_decode($data->investigation_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

                

                <table>
                    <tr>
                        <th class="w-20">Root Cause</th>
                        <td class="w-80">
                            @if ($data->root_cause)
                                {!! strip_tags($data->root_cause) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Impact / Risk Assessment</th>
                        <td class="w-80">
                            @if ($data->impact_risk_assessment)
                                {!! strip_tags($data->impact_risk_assessment) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                
                <table>
                    <tr>
                        <th class="w-20">CAPA</th>
                        <td class="w-80">
                            @if ($data->capa)
                                {!! strip_tags($data->capa) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Summary</th>
                        <td class="w-80">
                            @if ($data->investigation_summary_rca)
                                {!! strip_tags($data->investigation_summary_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
        
        
        <div class="border-table">
            <div class="block-head">
                Investigation Attachment

            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment</th>
                </tr>
                @if ($data->root_cause_initial_attachment_rca)
                    @foreach (json_decode($data->root_cause_initial_attachment_rca) as $key => $file)
                        <tr>
                            <td class="w-20">{{ $key + 1 }}</td>
                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
    
        </div><br>





                

        <div class="block">
            <div class="block-head">
                HOD Final Review
            </div>

            <table>
                <tr>
                    <th class="w-20"> HOD Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->hod_final_comments)
                            {!! strip_tags($data->hod_final_comments) !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_final_attachments)
                        @foreach (json_decode($data->hod_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->qa_final_comments)
                            {{ strip_tags($data->qa_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
            <div class="block-head">
                QAH/CQAH/Designee Final Approval
            </div>
            <table>
                <tr>
                    <th class="w-20">QAH/CQAH/Designee Final Approval Comments</th>
                    <td class="w-80">
                        @if ($data->qah_final_comments)
                            {{ strip_tags($data->qah_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH/Designee Final Approval Attachments

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
               

                {{-- <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                        </tr>
                      --}}
                </table>
                {{-- <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Root Cause
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Sr.No.</th>
                            <th class="w-30">Root Cause Category</th>
                            <th class="w-30">Root Cause Sub-Category</th>
                            <th class="w-30">Probability</th>
                            <th class="w-30">Remarks</th>
                        </tr>
                        {{-- @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
                        {{-- @if (!empty($data->Root_Cause_Category))
                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                    </td>
                                    <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div> --}} 
                
  
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
    
                                    <tr>
                                        <th class="w-20">Acknowledge By</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_by)
                                                {{ $data->acknowledge_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Acknowledge On</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_on)
                                                {{ Helpers::getdateFormat($data->acknowledge_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                
                                        <th class="w-20"> Acknowledge Comment</th>
                                        <td class="w-30">
                                            @if ($data->ack_comments)
                                                {{ $data->ack_comments }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                    {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
    
                                                                        
                                 <tr>
                                    <th class="w-20">HOD Review Complete By</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_By)
                                            {{ $data->HOD_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete On</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_On)
                                            {{ Helpers::getdateFormat($data->HOD_Review_Complete_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete Comment</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_Comment)
                                            {{ $data->HOD_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    {{-- <th class="w-20">QA Review Complete Comment</th>
                                            <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                                </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                </tr> --}}

                                <tr>
                                        <th class="w-20">QA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_By)
                                                {{ $data->QQQA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->QQQA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->QAQQ_Review_Complete_comment)
                                                {{ $data->QAQQ_Review_Complete_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                </tr> --}}
    
                           
                                    <tr>
                                        <th class="w-20">Submit By</th>
                                        <td class="w-30">
                                            @if ($data->submitted_by)
                                                {{ $data->submitted_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit On</th>
                                        <td class="w-30">
                                            @if ($data->submitted_on)
                                                {{ Helpers::getdateFormat($data->submitted_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit Comment</th>
                                        <td class="w-30">
                                            @if ($data->qa_comments_new)
                                                {{ $data->qa_comments_new }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">HOD Final Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_By)
                                            {{ $data->HOD_Final_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">HOD Final Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_On)
                                            {{ $data->HOD_Final_Review_Complete_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">
                                            HOD Final Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_Comment)
                                            {{ $data->HOD_Final_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr>
                                            <th class="w-20">More Info Required By
                                            </th>
                                            <td class="w-30"> @if($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20"> FinalQA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_By)
                                                {{ $data->Final_QA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->Final_QA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Completed Comment</th>
                                        <td class="w-30">
                                            @if ($data->evalution_Closure_comment)
                                                {{ $data->Final_QA_Review_Complete_Comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">QAH/CQAH Closure By</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_by)
                                                {{ $data->evaluation_complete_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QAH/CQAH Closure On</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_on)
                                                {{ Helpers::getdateFormat($data->evaluation_complete_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">
                                            QAH/CQAH Closure Comment</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_Comment)
                                                {{ $data->evalution_Closure_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Cancel By
                                        </th>
                                        <td class="w-30">
                                            @if ($data->cancelled_by)
                                                {{ $data->cancelled_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel On</th>
                                        <td class="w-30">
                                            @if ($data->cancelled_on)
                                                {{ $data->cancelled_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel comment</th>
                                        <td class="w-30">
                                            @if ($data->cancel_comment)
                                                {{ $data->cancel_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                    </tr>
    
                </table>
            </div>
        </div>

                {{-- <tr>
                    <th class="w-20">Investigation Tool</th>
                    <td class="w-80">
                        @if ($data->investigation_tool)
                            {{ $data->investigation_tool }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                {{-- <tr>
                    <th class="w-20">Root Cause</th>
                    <td class="w-80">
                        @if ($data->root_cause)
                            {{ $data->root_cause }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Impact / Risk Assessment</th>
                    <td class="w-80">
                        @if ($data->impact_risk_assessment)
                            {{ $data->impact_risk_assessment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA</th>
                    <td class="w-80">
                        @if ($data->capa)
                            {{ $data->capa }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Summary</th>
                    <td class="w-80">
                        @if ($data->investigation_summary_rca)
                            {{ $data->investigation_summary_rca }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>



            </table>
            
        </div>

      
       
       
        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QA/CQA Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qa_final_comments)
                        {{ $data->qa_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
            <div class="block-head">
                QAH/CQAH Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QAH/CQAH Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qah_final_comments)
                        {{ $data->qah_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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

        </div>--}}
       


        
        </div>
        </div>
        @endforeach
    @endif

    @if (count($Resampling) > 0)
        @foreach ($Resampling as $data)

        <center>
            <h3>Resampling Child Report</h3>
        </center>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        General Information
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Record Number</th>
                            <td class="w-30">
                                @if ($data->record)
                                    {{ Helpers::divisionNameForQMS($data->division_id) }}/Resampling/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->division_id)
                                    {{ Helpers::getDivisionName($data->division_id) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        </tr>

                        <tr>
                            <th class="w-20">Assigned To</th>
                            <td class="w-30">
                                @if ($data->assign_to)
                                    {{ Helpers::getInitiatorName($data->assign_to) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Due Date</th>
                            <td class="w-30">
                                @if ($data->due_date)
                                    {{ Helpers::getdateFormat($data->due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>


                        <!-- <tr>
                                <th class="w-20">Action Item Related Records</th>
                                <td class="w-80">
                                @if ($data->Reference_Recores1)
                                {{ Helpers::getDivisionName($data->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}
                                @else
                                Not Applicable
                                @endif
                                </td>
                    </tr> -->
                        <tr>


                            <!-- <td class="w-80">
                            @if ($data->hod_preson)
                            @foreach (explode(',', $data->hod_preson) as $hod)
                            {{ Helpers::getInitiatorName($hod) }} ,
                            @endforeach
                            @else
                            Not Applicable
                            @endif
                            </td> -->
                            

                        </tr>




                    </table>
                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Short Description</th>
                                <td class="w-80">
                                    @if ($data->short_description)
                                        {{ $data->short_description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <style>
                            .head-number {
                                font-weight: bold;
                                font-size: 13px;
                                padding-left: 8px;
                            }

                            .div-data {
                                font-size: 13px;
                                padding-left: 8px;
                            }
                        </style>

                        {{-- <label class="head-number" for="Related Records">Related Records</label>
                        <div class="div-data">
                            @if ($data->related_records)
                                {{ str_replace(',', ', ', $data->related_records) }}
                            @else
                                Not Applicable
                            @endif
                        </div> --}}

                        <table>
                            <tr>
                                <th class="w-20">Related Records</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                <th class="w-20">HOD Person</th>
                                <td class="w-30">
                                    @if ($data->hod_preson)
                                        {{ Helpers::getInitiatorName($data->hod_preson) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Description</th>
                                <td class="w-80">
                                    @if ($data->description)
                                        {{ $data->description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <table>    
                            <tr>
                                <th class="w-20">Responsible Department</th>
                                <td class="w-80">
                                    @if ($data->departments)
                                        {{ Helpers::getFullDepartmentName($data->departments) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                        </table>
                        <table>
                                <th class="w-20">If Others</th>
                                <td class="w-80">
                                    @if ($data->if_others)
                                        {{ $data->if_others }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="block-head">
                        File Attachments
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                            @if ($data->file_attach)
                                @php $files = json_decode($data->file_attach); @endphp
                                @if (count($files) > 0)
                                    @foreach ($files as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>


                </div>

                {{-- <div class="block">
                    <div class="head">
                        <table>
                            <tr>
                                <th class="w-20">CAPA Related Records</th>
                                <td class="w-80">@if ($data->capa_related_record){{ $data->capa_related_record }}@else Not Applicable @endif</td>
                            </tr>
                            </table>
                        </div>
                        </table>
                    </div>
                </div> --}}

                <div class="block-head">
                    Head QA/CQA Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Head Remark</th>
                        <td class="w-80">
                            @if ($data->qa_remark)
                                {{ $data->qa_remark }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                QA/CQA Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->qa_head)
                            @php $files = json_decode($data->qa_head); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                    Acknowledge
                </div>
                <table>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-80">
                            @if ($data->action_taken)
                                {{ $data->action_taken }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Actual Start Date</th>
                        <td class="w-30">
                            @if ($data->start_date)
                                {{ Helpers::getdateFormat($data->start_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Actual End Date</th>
                        <td class="w-30">
                            @if ($data->end_date)
                                {{ Helpers::getdateFormat($data->end_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>

                        <tr>
                            <th class="w-20">Sampled By</th>
                            <td class="w-80">
                                @if ($data->sampled_by)
                                    {{ $data->sampled_by }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="block-head">
                        Completion Attachment
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                            @if ($data->Support_doc)
                                @php $files = json_decode($data->Support_doc); @endphp
                                @if (count($files) > 0)
                                    @foreach ($files as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                </div>
                {{-- </table> --}}
                <div class="block-head">
                    QA/CQA Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Review Comments</th>
                        <td class="w-80">
                            @if ($data->qa_comments)
                                {{ $data->qa_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                </table>

                <div class="block-head">
                    QA/CQA Verification Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->final_attach)
                            @php $files = json_decode($data->final_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <!-- <div class="block-head">
                        Extension Justification
                    </div>
                        <table>
                        <tr>
                            <th class="w-20">Due Date Extension Justification</th>
                            <td class="w-80">
                            @if ($data->due_date_extension)
                            {{ $data->due_date_extension }}
                            @else
                            Not Applicable
                            @endif
                            </td>
                        </tr>
                    </table>
                    -->



                <div class="block">
                    <div class="block-head">
                        Activity Log
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Submitted By</th>
                            <td class="w-30">
                                @if ($data->acknowledgement_by){{ $data->acknowledgement_by}}
                                @else
                                Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Submitted On</th>
                            <td class="w-30">
                                @if ($data->acknowledgement_on){{ $data->acknowledgement_on}}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Submitted Comment</th>
                            <td class="w-80" colspan="3">
                                @if ($data->acknowledgement_comment )
                                {{ $data->acknowledgement_comment }}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th class="w-20">Approved By </th>
                            <td class="w-30">
                                @if ($data->work_completion_by)
                                {{ $data->work_completion_by }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                            <th class="w-20"> Approved On</th>
                            <td class="w-30">
                                @if ($data->work_completion_on )
                                {{ $data->work_completion_on }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20"> Approved Comment</th>
                            <td class="w-80" colspan="3">
                                @if ($data->work_completion_comment)
                                {{ $data->work_completion_comment }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Acknowledge Complete By </th>
                            <td class="w-30">
                                @if ($data->qa_varification_by){{ $data->qa_varification_by }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                            <th class="w-20"> Acknowledge Complete On</th>
                            <td class="w-30">
                                @if ($data->qa_varification_on)
                                {{ $data->qa_varification_on }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20"> Acknowledge Complete Comment</th>
                            <td class="w-80" colspan="3">
                                @if ( $data->qa_varification_comment)
                                {{ $data->qa_varification_comment }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th class="w-20">Verification Completed By </th>
                            <td class="w-30">
                                @if ($data->completed_by)
                                {{ $data->completed_by }}
                                @else
                                Not Applicable 
                                @endif
                            </td>
                            <th class="w-20"> Verification Completed On</th>
                            <td class="w-30">
                                @if ( $data->completed_on)
                                {{ $data->completed_on }}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20"> Verification Completed Comment</th>
                            <td class="w-80" colspan="3">
                                @if ( $data->completed_comment)
                                {{ $data->completed_comment }}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Cancelled By</th>
                            <td class="w-30">
                                @if ( $data->cancelled_by)
                                {{ $data->cancelled_by }}
                                @else
                                Not Applicable
                                @endif
                        </td>
                            <th class="w-20">
                                Cancelled On</th>
                            <td class="w-30">
                                @if ( $data->cancelled_on)
                                {{ $data->cancelled_on }}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Cancelled Comment</th>
                            <td class="w-80" colspan="3">
                                @if ( $data->cancelled_on)
                                {{ $data->cancelled_on }}
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @endforeach
    @endif
</body>

</html>
