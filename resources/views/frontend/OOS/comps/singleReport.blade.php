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
                      {{ ucwords(str_replace('_', ' ', $data->Form_type)) }} Report
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

    {{-- ===== YE ADD KARO ===== --}}
    @php
        $filled = function ($v) {
            if (is_null($v)) return false;
            if (is_array($v)) {
                foreach ($v as $x) {
                    if (is_array($x)
                        ? !empty(array_filter($x, fn($y) => trim((string) $y) !== ''))
                        : trim((string) $x) !== '') {
                        return true;
                    }
                }
                return false;
            }
            if (is_object($v)) return true;
            $s = trim(strip_tags((string) $v));
            return $s !== '' && strtolower($s) !== 'not applicable' && $s !== '0000-00-00';
        };
    @endphp

    <div class="inner-block">
        <div class="content-table">
            <!-- start block -->
            <div class="block">
                <div class="block-head">General Information </div>
                <table>
                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-30">{{ ucwords(str_replace('_', ' ', $data->Form_type)) }}</td>
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

                    @php
                        $oosInfoHasData = $filled($data->sample_type_gi)
                            || $filled($data->product_material_name_gi)
                            || $filled($data->market_gi)
                            || $filled($data->customer_gi)
                            || $filled($data->specification_details)
                            || $filled($data->STP_details)
                            || $filled($data->manufacture_vendor);
                    @endphp

                    @if($oosInfoHasData)
                        <div class="block-head">OOS/OOT Information</div>
                        <table>
                            @if($filled($data->sample_type_gi))
                                <tr>
                                    <th class="w-20">Sample Type</th>
                                    <td class="w-80">{{ Helpers::recordFormat($data->sample_type_gi) }}</td>
                                </tr>
                            @endif

                            @if($filled($data->product_material_name_gi))
                                <tr>
                                    <th class="w-20">Product / Material Name</th>
                                    <td class="w-80">{{ Helpers::recordFormat($data->product_material_name_gi) }}</td>
                                </tr>
                            @endif

                            @if($filled($data->market_gi))
                                <tr>
                                    <th class="w-20">Market</th>
                                    <td class="w-80">{{ $data->market_gi }}</td>
                                </tr>
                            @endif

                            @if($filled($data->customer_gi))
                                <tr>
                                    <th class="w-20">Customer</th>
                                    <td class="w-80">{{ $data->customer_gi }}</td>
                                </tr>
                            @endif

                            @if($filled($data->specification_details))
                                <tr>
                                    <th class="w-20">Specification Details</th>
                                    <td class="w-80">{{ Helpers::recordFormat($data->specification_details) }}</td>
                                </tr>
                            @endif

                            @if($filled($data->STP_details))
                                <tr>
                                    <th class="w-20">STP Details</th>
                                    <td class="w-80">{{ Helpers::recordFormat($data->STP_details) }}</td>
                                </tr>
                            @endif

                            @if($filled($data->manufacture_vendor))
                                <tr>
                                    <th class="w-20">Manufacture/Vendor</th>
                                    <td class="w-80">{{ Helpers::recordFormat($data->manufacture_vendor) }}</td>
                                </tr>
                            @endif
                        </table>
                    @endif
            </div>

            <!-- Allgrid -->
            <!-- Info. On Product/ Material -->
            @php
                $infoRows = ($data->info_product_materials && is_array($data->info_product_materials->data))
                    ? $data->info_product_materials->data
                    : [];

                $infoGrid1Keys = ['info_product_code', 'info_batch_no', 'info_mfg_date', 'info_expiry_date', 'info_label_claim', 'info_pack_size'];
                $infoGrid2Keys = ['info_analyst_name', 'info_others_specify', 'info_process_sample_stage', 'info_packing_material_type', 'info_stability_for'];

                $rowHas = fn($row, $keys) => is_array($row) && collect($keys)->contains(fn($k) => $filled($row[$k] ?? null));

                $infoGrid1 = collect($infoRows)->filter(fn($r) => $rowHas($r, $infoGrid1Keys))->values();
                $infoGrid2 = collect($infoRows)->filter(fn($r) => $rowHas($r, $infoGrid2Keys))->values();
            @endphp

            {{-- Table 1 --}}
            @if($infoGrid1->count())
            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 10%">Item/Product Code</th>
                            <th style="width: 8%">Batch No</th>
                            <th style="width: 8%">Mfg.Date</th>
                            <th style="width: 8%">Expiry Date</th>
                            <th style="width: 8%">Label Claim.</th>
                            <th style="width: 8%">Pack Size</th>
                        </tr>
                        @foreach ($infoGrid1 as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['info_product_code'] ?? null) ? $row['info_product_code'] : '-' }}</td>
                                <td>{{ $filled($row['info_batch_no'] ?? null) ? $row['info_batch_no'] : '-' }}</td>
                                <td>{{ $filled($row['info_mfg_date'] ?? null) ? Helpers::getdateFormat($row['info_mfg_date']) : '-' }}</td>
                                <td>{{ $filled($row['info_expiry_date'] ?? null) ? Helpers::getdateFormat($row['info_expiry_date']) : '-' }}</td>
                                <td>{{ $filled($row['info_label_claim'] ?? null) ? $row['info_label_claim'] : '-' }}</td>
                                <td>{{ $filled($row['info_pack_size'] ?? null) ? $row['info_pack_size'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- Table 2 --}}
            @if($infoGrid2->count())
            <div class="block">
                <div class="block-head"> Info. On Product/ Material</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%">Analyst Name</th>
                            <th style="width: 10%">Others (Specify)</th>
                            <th style="width: 10%">In- Process Sample Stage.</th>
                            <th style="width: 12%">Packing Material Type</th>
                            <th style="width: 16%">Stability for</th>
                        </tr>
                        @foreach ($infoGrid2 as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['info_analyst_name'] ?? null) ? $row['info_analyst_name'] : '-' }}</td>
                                <td>{{ $filled($row['info_others_specify'] ?? null) ? $row['info_others_specify'] : '-' }}</td>
                                <td>{{ $filled($row['info_process_sample_stage'] ?? null) ? $row['info_process_sample_stage'] : '-' }}</td>
                                <td>{{ $filled($row['info_packing_material_type'] ?? null) ? $row['info_packing_material_type'] : '-' }}</td>
                                <td>{{ $filled($row['info_stability_for'] ?? null) ? $row['info_stability_for'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
            
            @php
                $stabRows = ($data->details_stabilities && is_array($data->details_stabilities->data))
                    ? $data->details_stabilities->data
                    : [];

                $stabGrid1Keys = ['stability_study_arnumber', 'stability_study_condition_temprature_rh', 'stability_study_Interval', 'stability_study_orientation'];
                $stabGrid2Keys = ['stability_study_pack_details', 'stability_study_specification_no', 'stability_study_sample_description'];

                $stabRowHas = fn($row, $keys) => is_array($row) && collect($keys)->contains(fn($k) => $filled($row[$k] ?? null));

                $stabGrid1 = collect($stabRows)->filter(fn($r) => $stabRowHas($r, $stabGrid1Keys))->values();
                $stabGrid2 = collect($stabRows)->filter(fn($r) => $stabRowHas($r, $stabGrid2Keys))->values();
            @endphp

            <!-- Details of Stability Study : Table 1 -->
            @if($stabGrid1->count())
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
                        @foreach ($stabGrid1 as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['stability_study_arnumber'] ?? null) ? $row['stability_study_arnumber'] : '-' }}</td>
                                <td>{{ $filled($row['stability_study_condition_temprature_rh'] ?? null) ? $row['stability_study_condition_temprature_rh'] : '-' }}</td>
                                <td>{{ $filled($row['stability_study_Interval'] ?? null) ? $row['stability_study_Interval'] : '-' }}</td>
                                <td>{{ $filled($row['stability_study_orientation'] ?? null) ? $row['stability_study_orientation'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            <!-- Details of Stability Study : Table 2 -->
            @if($stabGrid2->count())
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
                        @foreach ($stabGrid2 as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['stability_study_pack_details'] ?? null) ? $row['stability_study_pack_details'] : '-' }}</td>
                                <td>{{ $filled($row['stability_study_specification_no'] ?? null) ? $row['stability_study_specification_no'] : '-' }}</td>
                                <td>{{ $filled($row['stability_study_sample_description'] ?? null) ? $row['stability_study_sample_description'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
            
            @php
                $gridRows = fn($g) => ($g && isset($g->data) && is_array($g->data)) ? $g->data : [];
                $rowHasAny = fn($row, $keys) => is_array($row) && collect($keys)->contains(fn($k) => $filled($row[$k] ?? null));

                // ---------- OOS/OOT Details ----------
                $oosKeys = ['oos_arnumber','oos_test_name','oos_results_obtained','oos_specification_limit','oos_file_attachment','oos_submit_on','oos_submit_by'];
                $oosGrid = collect($gridRows($data->oos_details))->filter(fn($r) => $rowHasAny($r, $oosKeys))->values();

                // File attachment ko readable text me badalne ka helper
                $attachText = function ($att) {
                    if (is_array($att)) {
                        $att = array_map(fn($i) => is_array($i) ? ($i['name'] ?? json_encode($i)) : $i, $att);
                        return implode(', ', array_filter($att, fn($x) => trim((string)$x) !== ''));
                    }
                    return (string) $att;
                };

                // ---------- Product details ----------
                $prodKeys = ['product_name','product_AR_No','sampled_on','sample_by','analyzed_on','observed_on'];
                $prodGrid = collect($gridRows($products_details ?? null))->filter(fn($r) => $rowHasAny($r, $prodKeys))->values();

                // ---------- Instrument details ----------
                $instKeys = ['instrument_name','instrument_id_number','calibrated_on','calibratedduedate_on'];
                $instGrid = collect($gridRows($instrument_details ?? null))->filter(fn($r) => $rowHasAny($r, $instKeys))->values();
            @endphp

            <!-- OOS Details -->
            @if($oosGrid->count())
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
                        @foreach ($oosGrid as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['oos_arnumber'] ?? null) ? $row['oos_arnumber'] : '-' }}</td>
                                <td>{{ $filled($row['oos_test_name'] ?? null) ? $row['oos_test_name'] : '-' }}</td>
                                <td>{{ $filled($row['oos_results_obtained'] ?? null) ? $row['oos_results_obtained'] : '-' }}</td>
                                <td>{{ $filled($row['oos_specification_limit'] ?? null) ? $row['oos_specification_limit'] : '-' }}</td>
                                <td>{{ $filled($row['oos_file_attachment'] ?? null) ? $attachText($row['oos_file_attachment']) : '-' }}</td>
                                <td>{{ $filled($row['oos_submit_on'] ?? null) ? Helpers::getdateFormat($row['oos_submit_on']) : '-' }}</td>
                                <td>{{ $filled($row['oos_submit_by'] ?? null) ? Helpers::getInitiatorName($row['oos_submit_by']) : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            <!-- Product details -->
            @if($prodGrid->count())
            <div class="block">
                <div class="block-head"> Product details </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%">Name of Product</th>
                            <th style="width: 8%">A.R.No</th>
                            <th style="width: 8%">Sampled on</th>
                            <th style="width: 8%">Sample by</th>
                            <th style="width: 8%">Analyzed on</th>
                            <th style="width: 8%">Observed on</th>
                        </tr>
                        @foreach ($prodGrid as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['product_name'] ?? null) ? $row['product_name'] : '-' }}</td>
                                <td>{{ $filled($row['product_AR_No'] ?? null) ? $row['product_AR_No'] : '-' }}</td>
                                <td>{{ $filled($row['sampled_on'] ?? null) ? Helpers::getdateFormat($row['sampled_on']) : '-' }}</td>
                                <td>{{ $filled($row['sample_by'] ?? null) ? $row['sample_by'] : '-' }}</td>
                                <td>{{ $filled($row['analyzed_on'] ?? null) ? Helpers::getdateFormat($row['analyzed_on']) : '-' }}</td>
                                <td>{{ $filled($row['observed_on'] ?? null) ? Helpers::getdateFormat($row['observed_on']) : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            <!-- Instrument details -->
            @if($instGrid->count())
            <div class="block">
                <div class="block-head"> Instrument details </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 4%">Sr.No.</th>
                            <th style="width: 8%">Name of instrument</th>
                            <th style="width: 8%">Instrument Id Number</th>
                            <th style="width: 8%">Calibrated On</th>
                            <th style="width: 8%">Calibrated Due Date</th>
                        </tr>
                        @foreach ($instGrid as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $filled($row['instrument_name'] ?? null) ? $row['instrument_name'] : '-' }}</td>
                                <td>{{ $filled($row['instrument_id_number'] ?? null) ? $row['instrument_id_number'] : '-' }}</td>
                                <td>{{ $filled($row['calibrated_on'] ?? null) ? Helpers::getdateFormat($row['calibrated_on']) : '-' }}</td>
                                <td>{{ $filled($row['calibratedduedate_on'] ?? null) ? Helpers::getdateFormat($row['calibratedduedate_on']) : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
           <!-- grid close -->

            {{-- HOD Primary Review --}}
            @php
                $hodFiles1 = is_array($data->hod_attachment1)
                    ? array_values(array_filter($data->hod_attachment1, fn($f) => $filled($f)))
                    : [];
            @endphp

            @if($filled($data->hod_remark1))
            <div class="block">
                <div class="block-head">HOD Primary Review</div>
                <table>
                    <tr>
                        <th class="w-20">HOD Remarks</th>
                        <td class="w-80">{{ $data->hod_remark1 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($hodFiles1))
            <div class="block">
                <div class="block-head">HOD Primary Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                        @foreach ($hodFiles1 as $file)
                            <tr>
                                <td class="w-20">{{ $loop->iteration }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- CQA/QA Head Primary Review --}}
            @php
                $qaFiles1 = is_array($data->QA_Head_primary_attachment1)
                    ? array_values(array_filter($data->QA_Head_primary_attachment1, fn($f) => $filled($f)))
                    : [];
            @endphp

            @if($filled($data->QA_Head_primary_remark1))
            <div class="block">
                <div class="block-head">CQA/QA Head Primary Review</div>
                <table>
                    <tr>
                        <th class="w-20">CQA/QA Head Remark</th>
                        <td class="w-80">{{ $data->QA_Head_primary_remark1 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($qaFiles1))
            <div class="block">
                <div class="block-head">CQA/QA Head Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                        @foreach ($qaFiles1 as $file)
                            <tr>
                                <td class="w-20">{{ $loop->iteration }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            <!-- Preliminary Lab. Investigation TapII -->
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
                $selectedChecklist = array_values(array_filter(array_map('trim', $selectedChecklist), fn($x) => $x !== ''));

                $normalizedSelectedChecklist = collect($selectedChecklist)
                    ->map(fn($item) => strtolower(trim($item)))
                    ->flatMap(function ($item) {
                        if ($item === 'hplc-gc') {
                            return ['hplcgc'];
                        }

                        if ($item === 'ph-viscometer-mp') {
                            return ['ph', 'viscometer', 'meltingpoint'];
                        }

                        return [preg_replace('/[^a-z0-9]/i', '', $item)];
                    })
                    ->toArray();

                $isHplcGcSelected = in_array('hplcgc', $normalizedSelectedChecklist, true);
                $isPhSelected = in_array('ph', $normalizedSelectedChecklist, true);
                $isViscometerSelected = in_array('viscometer', $normalizedSelectedChecklist, true);
                $isMeltingPointSelected = in_array('meltingpoint', $normalizedSelectedChecklist, true);

                // Phase IA main block me kuch data hai ya nahi
                $hasPhaseIA = filled(strip_tags((string) $data->Comments_plidata))
                    || count($selectedChecklist)
                    || filled(strip_tags((string) $data->justify_if_no_field_alert_pli))
                    || filled($data->root_comment)
                    || filled(strip_tags((string) $data->justify_if_no_analyst_int_pli))
                    || filled(strip_tags((string) $data->analyst_interview_pli))
                    || filled(strip_tags((string) $data->Any_other_cause))
                    || filled(strip_tags((string) $data->Any_other_batches))
                    || filled(strip_tags((string) $data->details_of_trend))
                    || filled(strip_tags((string) $data->rational_for_assingnable))
                    || filled(strip_tags((string) $data->summary_of_prelim_investiga_plic));

                $analystFiles = is_array($data->file_attachments_pli) ? array_values(array_filter($data->file_attachments_pli)) : [];
                $supportFiles = is_array($data->supporting_attachments_plir) ? array_values(array_filter($data->supporting_attachments_plir)) : [];
            @endphp

            @if($hasPhaseIA)
            <div class="block">
                <div class="block-head">Phase IA Investigation</div>

                @if(filled(strip_tags((string) $data->Comments_plidata)) || count($selectedChecklist))
                <table>
                    @if(filled(strip_tags((string) $data->Comments_plidata)))
                    <tr>
                        <th class="w-20">Workbench Evaluation</th>
                        <td class="w-80">{{ strip_tags($data->Comments_plidata) }}</td>
                    </tr>
                    @endif
                    @if(count($selectedChecklist))
                    <tr>
                        <th class="w-20">Checklists</th>
                        <td class="w-80">{{ implode(', ', $selectedChecklist) }}</td>
                    </tr>
                    @endif
                </table>
                @endif

                @if(count($selectedChecklist))
                    @include('frontend.OOS.comps.allchecklistSingleReport')
                @endif

                <table>
                    @if(filled(strip_tags((string) $data->justify_if_no_field_alert_pli)))
                    <tr>
                        <th class="w-20">Checklist Outcome</th>
                        <td class="w-80">{{ strip_tags($data->justify_if_no_field_alert_pli) }}</td>
                    </tr>
                    @endif
                    @if(filled($data->root_comment))
                    <tr>
                        <th class="w-20">Immediate action taken</th>
                        <td class="w-80">{{ $data->root_comment }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->justify_if_no_analyst_int_pli)))
                    <tr>
                        <th class="w-20">Delay Justification For Investigation</th>
                        <td class="w-80">{{ strip_tags($data->justify_if_no_analyst_int_pli) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->analyst_interview_pli)))
                    <tr>
                        <th class="w-20">Analyst Interview Details</th>
                        <td class="w-80">{{ strip_tags($data->analyst_interview_pli) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Any_other_cause)))
                    <tr>
                        <th class="w-20">Any Other Cause/Suspected Cause</th>
                        <td class="w-80">{{ strip_tags($data->Any_other_cause) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Any_other_batches)))
                    <tr>
                        <th class="w-20">Any Other Batches Analyzed</th>
                        <td class="w-80">{{ strip_tags($data->Any_other_batches) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->details_of_trend)))
                    <tr>
                        <th class="w-20">Details Of Trend</th>
                        <td class="w-80">{{ strip_tags($data->details_of_trend) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->rational_for_assingnable)))
                    <tr>
                        <th class="w-20">Assignable Cause And Rational For Assignable Cause</th>
                        <td class="w-80">{{ strip_tags($data->rational_for_assingnable) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->summary_of_prelim_investiga_plic)))
                    <tr>
                        <th class="w-20">Summary of Investigation</th>
                        <td class="w-80">{{ strip_tags($data->summary_of_prelim_investiga_plic) }}</td>
                    </tr>
                    @endif
                </table>

            </div>
            @endif

            @if(filled($data->phase_i_investigation_pli) || filled($data->oos_category_root_cause_ident_plic))
            <div class="block">
                <table>
                    <tr>
                        @if(filled($data->phase_i_investigation_pli))
                        <th class="w-20">OOS/OOT Cause Identified</th>
                        <td class="w-30">{{ $data->phase_i_investigation_pli }}</td>
                        @endif
                        @if(filled($data->oos_category_root_cause_ident_plic))
                        <th class="w-20">OOS/OOT Category</th>
                        <td class="w-30">{{ $data->oos_category_root_cause_ident_plic }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            @endif

            @if(filled(strip_tags((string) $data->oos_category_others_plic)))
            <div class="inner-block">
                <table>
                    <tr>
                        <th class="w-20">OOS/OOT Category (If Others)</th>
                        <td class="w-80">{{ strip_tags($data->oos_category_others_plic) }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(filled($data->capa_required_plic) || filled($data->reference_capa_no_plic))
            <div class="block">
                <table>
                    <tr>
                        @if(filled($data->capa_required_plic))
                        <th class="w-20">CAPA Required</th>
                        <td class="w-30">{{ $data->capa_required_plic }}</td>
                        @endif
                        @if(filled($data->reference_capa_no_plic))
                        <th class="w-20">Reference CAPA No.</th>
                        <td class="w-30">{{ $data->reference_capa_no_plic }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            @endif

            @if(filled(strip_tags((string) $data->review_comments_plir)))
            <div class="inner-block">
                <table>
                    <tr>
                        <th class="w-20">OOS/OOT Review For Similar Nature</th>
                        <td class="w-80">{{ strip_tags($data->review_comments_plir) }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(filled($data->phase_ib_inv_required_plir) || filled($data->phase_ii_inv_required_plir) || filled($data->root_cause_identified_pia) || filled($data->is_repeat_assingable_pia) || filled($data->repeat_testing_pia))
            <div class="block">
                <table>
                    @if(filled($data->phase_ib_inv_required_plir) || filled($data->phase_ii_inv_required_plir))
                    <tr>
                        @if(filled($data->phase_ib_inv_required_plir))
                        <th class="w-20">Phase IB Inv. Required?</th>
                        <td class="w-30">{{ $data->phase_ib_inv_required_plir }}</td>
                        @endif
                        @if(filled($data->phase_ii_inv_required_plir))
                        <th class="w-20">Phase II Inv. Required?</th>
                        <td class="w-30">{{ $data->phase_ii_inv_required_plir }}</td>
                        @endif
                    </tr>
                    @endif
                    @if(filled($data->root_cause_identified_pia) || filled($data->is_repeat_assingable_pia))
                    <tr>
                        @if(filled($data->root_cause_identified_pia))
                        <th class="w-20">Retest/Re-Measurement Required</th>
                        <td class="w-30">{{ $data->root_cause_identified_pia }}</td>
                        @endif
                        @if(filled($data->is_repeat_assingable_pia))
                        <th class="w-20">Resampling Required</th>
                        <td class="w-30">{{ $data->is_repeat_assingable_pia }}</td>
                        @endif
                    </tr>
                    @endif
                    @if(filled($data->repeat_testing_pia))
                    <tr>
                        <th class="w-20">Repeat Testing Required</th>
                        <td class="w-30">{{ $data->repeat_testing_pia }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(filled(strip_tags((string) $data->Description_Deviation)) || filled(strip_tags((string) $data->result_of_repeat)) || filled(strip_tags((string) $data->impact_assesment_pia)))
            <div class="block">
                <table>
                    @if(filled(strip_tags((string) $data->Description_Deviation)))
                    <tr>
                        <th class="w-20">Results Of Retest/Re-Measurement</th>
                        <td class="w-80">{{ strip_tags($data->Description_Deviation) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->result_of_repeat)))
                    <tr>
                        <th class="w-20">Results Of Repeat Testing</th>
                        <td class="w-80">{{ strip_tags($data->result_of_repeat) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->impact_assesment_pia)))
                    <tr>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-80">{{ strip_tags($data->impact_assesment_pia) }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(count($analystFiles))
            <div class="block-head">Analyst Interview Attachment</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-80"> Attachment</th>
                    </tr>
                    @foreach ($analystFiles as $key => $file)
                    <tr>
                        <td class="w-20">{{ $key + 1 }}</td>
                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif

            @if(count($supportFiles))
            <div class="block-head">Supporting Attachments</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-80"> Attachment</th>
                    </tr>
                    @foreach ($supportFiles as $key => $file)
                    <tr>
                        <td class="w-20">{{ $key + 1 }}</td>
                        <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif

            </div>

            {{-- <!-- Phase IA HOD Primary -->  --}}
            @php
                $hodFiles2 = is_array($data->hod_attachment2) ? array_values(array_filter($data->hod_attachment2)) : [];
                $qaFiles2  = is_array($data->QA_Head_attachment2) ? array_values(array_filter($data->QA_Head_attachment2)) : [];
                $qahFiles2 = is_array($data->QA_Head_primary_attachment2) ? array_values(array_filter($data->QA_Head_primary_attachment2)) : [];
            @endphp

            @if(filled(strip_tags((string) $data->hod_remark2)))
            <div class="block">
                <div class="block-head">Phase IA HOD Review</div>
                <div class="inner-block">
                    <table>
                        <tr>
                            <th>Phase IA HOD Remark</th>
                            <td>{{ $data->hod_remark2 }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if(count($hodFiles2))
            <div class="block">
                <div class="block-head">Phase IA HOD Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80"> Attachment</th>
                        </tr>
                        @foreach ($hodFiles2 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IA CQA/QA --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->QA_Head_remark2)))
            <div class="block">
                <div class="block-head">Phase IA CQA/QA Review</div>
                <div class="inner-block">
                    <table>
                        <tr>
                            <th class="w-20">Phase IA CQA/QA Remark</th>
                            <td class="w-80">{{ $data->QA_Head_remark2 }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if(count($qaFiles2))
            <div class="block">
                <div class="block-head">Phase IA CQA/QA Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($qaFiles2 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IA CQA/QA --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->QA_Head_primary_remark2)) || filled(strip_tags((string) $data->assign_cause_found)))
            <div class="block">
                <div class="block-head">Phase IA CQAH/QAH Review</div>

                <table>
                    @if(filled(strip_tags((string) $data->QA_Head_primary_remark2)))
                    <tr>
                        <th class="w-20">Phase IA CQAH/QAH Remark</th>
                        <td class="w-80">{{ $data->QA_Head_primary_remark2 }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->assign_cause_found)))
                    <tr>
                        <th class="w-20">Phase IA Assignable Cause Found</th>
                        <td class="w-80">{{ $data->assign_cause_found }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(count($qahFiles2))
            <div class="block">
                <div class="block-head">Phase IA CQAH/QAH Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80"> Attachment</th>
                        </tr>
                        @foreach ($qahFiles2 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IB Investigation --> ~Aditya Rajput --}}
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
                        $IIB_inv_answers = json_decode($checklist_IB_invs->data, true) ?: [];
                    } elseif (is_array($checklist_IB_invs->data)) {
                        // Agar already array hai, direct assign karo
                        $IIB_inv_answers = $checklist_IB_invs->data;
                    }
                }

                // Checklist me jin questions ka response/remark bhara hai
                $ibAnswered = [];
                foreach ($IIB_inv_questions as $index => $question) {
                    $a = $IIB_inv_answers[$index] ?? null;
                    if (is_array($a) && (filled($a['response'] ?? null) || filled($a['remark'] ?? null))) {
                        $ibAnswered[$index] = $a;
                    }
                }

                // Proposal for hypothesis (array ya string dono)
                $hypoIB = is_array($data->proposal_for_hypothesis_IB)
                    ? implode(', ', array_filter($data->proposal_for_hypothesis_IB))
                    : $data->proposal_for_hypothesis_IB;

                // Production person
                $prodPersonIB = $data->production_person_ib ? Helpers::getInitiatorName($data->production_person_ib) : null;

                $ibFiles = is_array($data->file_attachment_IB_Inv) ? array_values(array_filter($data->file_attachment_IB_Inv)) : [];
            @endphp

            @if(filled($data->outcome_phase_IA) || filled($data->reason_for_proceeding) || count($ibAnswered)
                || filled(strip_tags((string) $data->summaryy_of_review)) || filled(strip_tags((string) $data->Probable_cause_iden))
                || filled($hypoIB) || filled(strip_tags((string) $data->proposal_for_hypothesis_others))
                || filled(strip_tags((string) $data->details_of_result)))
            <div class="block">
                <div class="block-head">Phase IB Investigation</div>

                @if(filled($data->outcome_phase_IA) || filled($data->reason_for_proceeding))
                <table>
                    @if(filled($data->outcome_phase_IA))
                    <tr>
                        <th class="w-20">Outcome Of Phase IA Investigation</th>
                        <td class="w-80">{{ $data->outcome_phase_IA }}</td>
                    </tr>
                    @endif
                    @if(filled($data->reason_for_proceeding))
                    <tr>
                        <th class="w-20">Reason For Proceeding To Phase IB Investigation</th>
                        <td class="w-80">{{ $data->reason_for_proceeding }}</td>
                    </tr>
                    @endif
                </table>
                @endif

                @if(count($ibAnswered))
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
                        @foreach($ibAnswered as $index => $answer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $IIB_inv_questions[$index] }}</td>
                                <td>{{ filled($answer['response'] ?? null) ? $answer['response'] : '-' }}</td>
                                <td>{{ filled($answer['remark'] ?? null) ? $answer['remark'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                @if(filled(strip_tags((string) $data->summaryy_of_review)) || filled(strip_tags((string) $data->Probable_cause_iden)) || filled($hypoIB) || filled(strip_tags((string) $data->proposal_for_hypothesis_others)) || filled(strip_tags((string) $data->details_of_result)))
                <table>
                    @if(filled(strip_tags((string) $data->summaryy_of_review)))
                    <tr>
                        <th class="w-20">Summary Of Review</th>
                        <td class="w-80">{{ strip_tags($data->summaryy_of_review) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Probable_cause_iden)))
                    <tr>
                        <th class="w-20">Probable Cause Identification</th>
                        <td class="w-80">{{ strip_tags($data->Probable_cause_iden) }}</td>
                    </tr>
                    @endif
                    @if(filled($hypoIB))
                    <tr>
                        <th class="w-20">Proposal For Phase IB hypothesis</th>
                        <td class="w-80">{{ $hypoIB }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->proposal_for_hypothesis_others)))
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">{{ strip_tags($data->proposal_for_hypothesis_others) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->details_of_result)))
                    <tr>
                        <th class="w-20">Details Of Results (Including original OOS/OOT results for side by side comparison)</th>
                        <td class="w-80">{{ strip_tags($data->details_of_result) }}</td>
                    </tr>
                    @endif
                </table>
                @endif
            </div>
            @endif

            @if(filled($data->Probable_Cause_Identified) || filled($data->Any_other_Comments) || filled(strip_tags((string) $data->Proposal_for_Hypothesis)) || filled(strip_tags((string) $data->Summary_of_Hypothesis)))
            <div class="block">
                <table>
                    @if(filled($data->Probable_Cause_Identified))
                    <tr>
                        <th class="w-20">Probable Cause Identified In Phase IB Investigation</th>
                        <td class="w-80">{{ $data->Probable_Cause_Identified }}</td>
                    </tr>
                    @endif
                    @if(filled($data->Any_other_Comments))
                    <tr>
                        <th class="w-20">Any Other Comments/ Probable Cause Evidence</th>
                        <td class="w-80">{{ $data->Any_other_Comments }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Proposal_for_Hypothesis)))
                    <tr>
                        <th class="w-20">Proposal For Hypothesis Testing To Confirm Probable Cause Identified</th>
                        <td class="w-80">{{ strip_tags($data->Proposal_for_Hypothesis) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Summary_of_Hypothesis)))
                    <tr>
                        <th class="w-20">Summary Of Hypothesis</th>
                        <td class="w-80">{{ strip_tags($data->Summary_of_Hypothesis) }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(filled($data->Assignable_Cause) || filled($data->Types_of_assignable))
            <div class="block">
                <table>
                    <tr>
                        @if(filled($data->Assignable_Cause))
                        <th class="w-20">Assignable Cause</th>
                        <td class="w-30">{{ $data->Assignable_Cause }}</td>
                        @endif
                        @if(filled($data->Types_of_assignable))
                        <th class="w-20">Types Of Assignable Cause</th>
                        <td class="w-30">{{ $data->Types_of_assignable }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            @endif

            @if(filled($data->Types_of_assignable_others) || filled(strip_tags((string) $data->Evaluation_Timeline)) || filled($data->timeline_met) || filled($data->timeline_extension) || filled($data->CAPA_applicable))
            <div class="block">
                <table>
                    @if(filled($data->Types_of_assignable_others))
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">{{ $data->Types_of_assignable_others }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Evaluation_Timeline)))
                    <tr>
                        <th class="w-20">Evaluation Of Phase IB Investigation Timeline</th>
                        <td class="w-80">{{ strip_tags($data->Evaluation_Timeline) }}</td>
                    </tr>
                    @endif
                    @if(filled($data->timeline_met))
                    <tr>
                        <th class="w-20">Is Phase IB Investigation Timeline Met</th>
                        <td class="w-80">{{ $data->timeline_met }}</td>
                    </tr>
                    @endif
                    @if(filled($data->timeline_extension))
                    <tr>
                        <th class="w-20">If No, Justify For Timeline Extension</th>
                        <td class="w-80">{{ $data->timeline_extension }}</td>
                    </tr>
                    @endif
                    @if(filled($data->CAPA_applicable))
                    <tr>
                        <th class="w-20">CAPA Applicable</th>
                        <td class="w-80">{{ $data->CAPA_applicable }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(filled($data->resampling_required_ib) || filled($data->repeat_testing_ib))
            <div class="block">
                <table>
                    <tr>
                        @if(filled($data->resampling_required_ib))
                        <th class="w-20">Resampling Required</th>
                        <td class="w-30">{{ $data->resampling_required_ib }}</td>
                        @endif
                        @if(filled($data->repeat_testing_ib))
                        <th class="w-20">Repeat Testing Required</th>
                        <td class="w-30">{{ $data->repeat_testing_ib }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            @endif

            @if(filled(strip_tags((string) $data->Repeat_testing_plan)) || filled($data->phase_ii_inv_req_ib) || filled($prodPersonIB))
            <div class="block">
                @if(filled(strip_tags((string) $data->Repeat_testing_plan)))
                <table>
                    <tr>
                        <th class="w-20">Repeat Testing Plan</th>
                        <td class="w-80">{{ strip_tags($data->Repeat_testing_plan) }}</td>
                    </tr>
                </table>
                @endif
                @if(filled($data->phase_ii_inv_req_ib) || filled($prodPersonIB))
                <table>
                    <tr>
                        @if(filled($data->phase_ii_inv_req_ib))
                        <th class="w-20">Phase II Investigation Required</th>
                        <td class="w-30">{{ $data->phase_ii_inv_req_ib }}</td>
                        @endif
                        @if(filled($prodPersonIB))
                        <th class="w-20">Production Person</th>
                        <td class="w-30">{{ $prodPersonIB }}</td>
                        @endif
                    </tr>
                </table>
                @endif
            </div>
            @endif

            @if(filled(strip_tags((string) $data->Repeat_analysis_method)) || filled(strip_tags((string) $data->Details_repeat_analysis)) || filled(strip_tags((string) $data->Impact_assessment1)) || filled(strip_tags((string) $data->Conclusion1)))
            <div class="block">
                <table>
                    @if(filled(strip_tags((string) $data->Repeat_analysis_method)))
                    <tr>
                        <th class="w-20">Repeat Analysis Method/Resampling</th>
                        <td class="w-80">{{ strip_tags($data->Repeat_analysis_method) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Details_repeat_analysis)))
                    <tr>
                        <th class="w-20">Details Of Repeat Analysis</th>
                        <td class="w-80">{{ strip_tags($data->Details_repeat_analysis) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Impact_assessment1)))
                    <tr>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-80">{{ strip_tags($data->Impact_assessment1) }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->Conclusion1)))
                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-80">{{ strip_tags($data->Conclusion1) }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            </div>

            @if(count($ibFiles))
            <div class="block">
                <div class="block-head">File Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($ibFiles as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IB HOD Primary --> ~Aditya Rajput --}}
            @php
                $hodFiles3 = is_array($data->hod_attachment3) ? array_values(array_filter($data->hod_attachment3)) : [];
                $qaFiles3  = is_array($data->QA_Head_attachment3) ? array_values(array_filter($data->QA_Head_attachment3)) : [];
                $qahFiles3 = is_array($data->QA_Head_primary_attachment3) ? array_values(array_filter($data->QA_Head_primary_attachment3)) : [];
            @endphp

            @if(filled(strip_tags((string) $data->hod_remark3)))
            <div class="block">
                <div class="block-head">Phase IB HOD Review</div>
                <table>
                    <tr>
                        <th class="w-20">Phase IB HOD Remark</th>
                        <td class="w-80">{{ $data->hod_remark3 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($hodFiles3))
            <div class="block">
                <div class="block-head">Phase IB HOD Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($hodFiles3 as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IB CQA/QA  --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->QA_Head_remark3)))
            <div class="block">
                <div class="block-head">Phase IB CQA/QA Review</div>
                <div class="inner-block">
                    <table>
                        <tr>
                            <th class="w-20">Phase IB CQA/QA Remark</th>
                            <td class="w-80">{{ $data->QA_Head_remark3 }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if(count($qaFiles3))
            <div class="block">
                <div class="block-head">Phase IB CQA/QA Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($qaFiles3 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- P-IB CQAH/QAH --> ~Aditya Rajput --}}

            @if(filled($data->escalation_required) || filled($data->notification_ib) || filled($data->justification_ib) || filled($data->phase_ib_assi_cause) || filled(strip_tags((string) $data->QA_Head_primary_remark3)))
            <div class="block">
                <div class="block-head">Phase IB CQAH/QAH Review</div>
                <table>
                    @if(filled($data->escalation_required))
                    <tr>
                        <th class="w-20">Escalation required</th>
                        <td class="w-80">{{ $data->escalation_required }}</td>
                    </tr>
                    @endif
                    @if(filled($data->notification_ib))
                    <tr>
                        <th class="w-20">If Yes, Notification</th>
                        <td class="w-80">{{ $data->notification_ib }}</td>
                    </tr>
                    @endif
                    @if(filled($data->justification_ib))
                    <tr>
                        <th class="w-20">If No, Justification</th>
                        <td class="w-80">{{ $data->justification_ib }}</td>
                    </tr>
                    @endif
                    @if(filled($data->phase_ib_assi_cause))
                    <tr>
                        <th class="w-20">Phase IB Assignable Cause Found</th>
                        <td class="w-80">{{ $data->phase_ib_assi_cause }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->QA_Head_primary_remark3)))
                    <tr>
                        <th class="w-20">P-IB CQAH/QAH Remark</th>
                        <td class="w-80">{{ $data->QA_Head_primary_remark3 }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(count($qahFiles3))
            <div class="block">
                <div class="block-head">Phase IB CQAH/QAH Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment</th>
                        </tr>
                        @foreach ($qahFiles3 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif


            {{-- ================= Phase II A Investigation ================= --}}
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
                            $decoded = json_decode($phase_two_invss->data, true);
                            $phase_two_answers = is_array($decoded) ? $decoded : [];
                        } elseif (is_array($phase_two_invss->data)) {
                            $phase_two_answers = $phase_two_invss->data;
                        } elseif (is_object($phase_two_invss->data)) {
                            $phase_two_answers = (array) $phase_two_invss->data;
                        }
                    }

                    // Check whether actual response/remarks are available
                    $hasActualValue = function ($value) {
                        if ($value === null || is_array($value) || is_object($value)) {
                            return false;
                        }

                        $value = strtolower(trim(strip_tags((string) $value)));

                        return !in_array($value, [
                            '',
                            'null',
                            '-',
                            '--',
                            'select',
                            'please select',
                            'choose',
                            'n/a'
                        ], true);
                    };

                    $iiaAnswered = [];

                    foreach ($phase_two_inv_questions as $index => $question) {
                        $a = $phase_two_answers[$index] ?? null;

                        if (!is_array($a)) {
                            continue;
                        }

                        $hasResponse = $hasActualValue($a['response'] ?? null);
                        $hasRemarks  = $hasActualValue($a['remarks'] ?? null);

                        if ($hasResponse || $hasRemarks) {
                            $iiaAnswered[$index] = $a;
                        }
                    }


                $prodHeadPerson = $data->production_head_person ? Helpers::getInitiatorName($data->production_head_person) : null;

                $iiaOperatorFiles = is_array($data->file_attachments_pII) ? array_values(array_filter($data->file_attachments_pII)) : [];
                $iiaSupportFiles  = is_array($data->attachments_piiqcr) ? array_values(array_filter($data->attachments_piiqcr)) : [];

                $hasIIA = count($iiaAnswered) || count($iiaOperatorFiles)
                    || filled(strip_tags((string) $data->checklist_outcome_iia)) || filled($prodHeadPerson)
                    || filled(strip_tags((string) $data->qa_approver_comments_piii)) || filled(strip_tags((string) $data->reason_manufacturing_delay))
                    || filled(strip_tags((string) $data->audit_comments_piii)) || filled(strip_tags((string) $data->hypo_exp_reference_piii))
                    || filled($data->manufact_invest_required_piii) || filled($data->hypo_exp_required_piii) || filled($data->if_others_oos_category)
                    || filled($data->capa_required_iia) || filled($data->reference_capa_no_iia) || filled($data->OOS_review_similar)
                    || filled(strip_tags((string) $data->impact_assessment_IIA)) || filled($data->phase_iib_inv_required_plir);
            @endphp

            @if($hasIIA)
            <div class="block">
                <div class="block-head"> Phase II A Investigation </div>

                @if(count($iiaAnswered))
                <div class="block-head">CheckList - Phase II Investigation</div>
                <div class="border-table">
                    <table border="1" width="100%" cellspacing="0" cellpadding="6">
                        <tr class="table_bg">
                            <th style="width: 5%;">Sr.No.</th>
                            <th style="width: 40%;">Question</th>
                            <th style="width: 20%;">Response</th>
                            <th>Remarks</th>
                        </tr>
                        @foreach($iiaAnswered as $index => $answer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $phase_two_inv_questions[$index] }}</td>
                                <td>{{ filled($answer['response'] ?? null) ? $answer['response'] : '-' }}</td>
                                <td>{{ filled($answer['remarks'] ?? null) ? $answer['remarks'] : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif

                @if(filled(strip_tags((string) $data->checklist_outcome_iia)) || filled($prodHeadPerson) || filled(strip_tags((string) $data->qa_approver_comments_piii)) || filled(strip_tags((string) $data->reason_manufacturing_delay)) || filled(strip_tags((string) $data->audit_comments_piii)) || filled(strip_tags((string) $data->hypo_exp_reference_piii)))
                <div class="block">
                    @if(filled(strip_tags((string) $data->checklist_outcome_iia)))
                    <table>
                        <tr>
                            <th class="w-20">Checklist Outcome</th>
                            <td class="w-80">{{ strip_tags($data->checklist_outcome_iia) }}</td>
                        </tr>
                    </table>
                    @endif
                    @if(filled($prodHeadPerson))
                    <table>
                        <tr>
                            <th class="w-20">Production Head Person</th>
                            <td class="w-30">{{ $prodHeadPerson }}</td>
                        </tr>
                    </table>
                    @endif
                    @if(filled(strip_tags((string) $data->qa_approver_comments_piii)) || filled(strip_tags((string) $data->reason_manufacturing_delay)) || filled(strip_tags((string) $data->audit_comments_piii)) || filled(strip_tags((string) $data->hypo_exp_reference_piii)))
                    <table>
                        @if(filled(strip_tags((string) $data->qa_approver_comments_piii)))
                        <tr>
                            <th class="w-20">Immediate Action Taken</th>
                            <td class="w-80">{{ strip_tags($data->qa_approver_comments_piii) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->reason_manufacturing_delay)))
                        <tr>
                            <th class="w-20">Delay Justification For Investigation</th>
                            <td class="w-80">{{ strip_tags($data->reason_manufacturing_delay) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->audit_comments_piii)))
                        <tr>
                            <th class="w-20">Any Other Cause/Suspected Cause</th>
                            <td class="w-80">{{ strip_tags($data->audit_comments_piii) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->hypo_exp_reference_piii)))
                        <tr>
                            <th class="w-20">Summary Investigation</th>
                            <td class="w-80">{{ strip_tags($data->hypo_exp_reference_piii) }}</td>
                        </tr>
                        @endif
                    </table>
                    @endif
                </div>
                @endif

                @if(filled($data->manufact_invest_required_piii) || filled($data->hypo_exp_required_piii) || filled($data->if_others_oos_category))
                <div class="block">
                    @if(filled($data->manufact_invest_required_piii) || filled($data->hypo_exp_required_piii))
                    <table>
                        <tr>
                            @if(filled($data->manufact_invest_required_piii))
                            <th class="w-20">OOS/OOT Cause Identified II A</th>
                            <td class="w-30">{{ $data->manufact_invest_required_piii }}</td>
                            @endif
                            @if(filled($data->hypo_exp_required_piii))
                            <th class="w-20">OOS/OOT Category II A</th>
                            <td class="w-30">{{ $data->hypo_exp_required_piii }}</td>
                            @endif
                        </tr>
                    </table>
                    @endif
                    @if(filled($data->if_others_oos_category))
                    <table>
                        <tr>
                            <th class="w-20">OOS/OOT Category If Others</th>
                            <td class="w-80">{{ $data->if_others_oos_category }}</td>
                        </tr>
                    </table>
                    @endif
                </div>
                @endif

                @if(filled($data->capa_required_iia) || filled($data->reference_capa_no_iia) || filled($data->OOS_review_similar) || filled(strip_tags((string) $data->impact_assessment_IIA)))
                <div class="block">
                    <table>
                        @if(filled($data->capa_required_iia))
                        <tr>
                            <th class="w-20">CAPA Required</th>
                            <td class="w-80">{{ $data->capa_required_iia }}</td>
                        </tr>
                        @endif
                        @if(filled($data->reference_capa_no_iia))
                        <tr>
                            <th class="w-20">Reference CAPA No.</th>
                            <td class="w-80">{{ $data->reference_capa_no_iia }}</td>
                        </tr>
                        @endif
                        @if(filled($data->OOS_review_similar))
                        <tr>
                            <th class="w-20">OOS/OOT Review For Similar Nature II A</th>
                            <td class="w-80">{{ $data->OOS_review_similar }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->impact_assessment_IIA)))
                        <tr>
                            <th class="w-20">Impact Assessment</th>
                            <td class="w-80">{{ strip_tags($data->impact_assessment_IIA) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                @endif

                @if(filled($data->phase_iib_inv_required_plir))
                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Phase IIB Inv. Required?</th>
                            <td class="w-80">{{ $data->phase_iib_inv_required_plir }}</td>
                        </tr>
                    </table>
                </div>
                @endif

                @if(count($iiaOperatorFiles))
                <div class="block-head">Manufacturing Operater Interview Details</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment</th>
                        </tr>
                        @foreach ($iiaOperatorFiles as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
            @endif

            @if(count($iiaSupportFiles))
            <div class="block">
                <table>
                    <div class="block-head">II A Inv. Supporting Attachments</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment</th>
                            </tr>
                            @foreach ($iiaSupportFiles as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
            </div>
            @endif

               {{-- <!-- Phase II A HOD Primary --> ~Aditya Rajput --}}
            @php
                $hodFiles4  = is_array($data->hod_attachment4) ? array_values(array_filter($data->hod_attachment4)) : [];
                $qaFiles4   = is_array($data->QA_Head_attachment4) ? array_values(array_filter($data->QA_Head_attachment4)) : [];
                $qahFiles4  = is_array($data->QA_Head_primary_attachment4) ? array_values(array_filter($data->QA_Head_primary_attachment4)) : [];
                $iibFiles   = is_array($data->phaseII_attachment) ? array_values(array_filter($data->phaseII_attachment)) : [];
                $hodFiles5  = is_array($data->hod_attachment5) ? array_values(array_filter($data->hod_attachment5)) : [];
                $qaFiles5   = is_array($data->QA_Head_attachment5) ? array_values(array_filter($data->QA_Head_attachment5)) : [];
                $dispFiles  = is_array($data->disposition_attachment_bd) ? array_values(array_filter($data->disposition_attachment_bd)) : [];

                // Phase II B Investigation me kuch data hai ya nahi
                $hasIIBinv = filled(strip_tags((string) $data->Summary_Of_Inv_IIB)) || filled($data->capa_required_IIB) || filled($data->reference_capa_IIB)
                    || filled($data->resampling_req_IIB) || filled($data->Repeat_testing_IIB)
                    || filled(strip_tags((string) $data->result_of_rep_test_IIB)) || filled(strip_tags((string) $data->Laboratory_Investigation_Hypothesis))
                    || filled(strip_tags((string) $data->Outcome_of_Laboratory)) || filled(strip_tags((string) $data->Evaluation_IIB))
                    || filled($data->Assignable_Cause111) || filled(strip_tags((string) $data->If_assignable_cause)) || filled(strip_tags((string) $data->If_assignable_error))
                    || count($iibFiles);

                // Batch Disposition
                $hasBD = filled($data->oos_category_bd) || filled($data->material_batch_release_bd) || filled($data->others_bd)
                    || filled(strip_tags((string) $data->other_action_bd)) || filled(strip_tags((string) $data->other_parameters_results_bd))
                    || filled(strip_tags((string) $data->justify_for_delay_in_activity_bd));
            @endphp

            @if(filled(strip_tags((string) $data->hod_remark4)))
            <div class="block">
                <div class="block-head">Phase II A HOD Review</div>
                <table>
                    <tr>
                        <th class="w-20">Phase II A HOD Remark</th>
                        <td class="w-80">{{ $data->hod_remark4 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($hodFiles4))
            <div class="block">
                <div class="block-head">Phase II A HOD Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($hodFiles4 as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif


            {{-- <!-- Phase II A CQA/QA --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->QA_Head_remark4)))
            <div class="block">
                <div class="block-head">Phase II A CQA/QA Review</div>
                <table>
                    <tr>
                        <th class="w-20">Phase II A CQA/QA Remark</th>
                        <td class="w-80">{{ $data->QA_Head_remark4 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($qaFiles4))
            <div class="block">
                <div class="block-head">Phase II A CQA/QA Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($qaFiles4 as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- P-II A QAH/CQAH --> ~Aditya Rajput --}}

            @if(filled($data->phase_ii_a_assi_cause) || filled(strip_tags((string) $data->QA_Head_primary_remark4)))
            <div class="block">
                <div class="block-head">P-II A QAH/CQAH Review</div>
                <table>
                    @if(filled($data->phase_ii_a_assi_cause))
                    <tr>
                        <th class="w-20">Phase II A Assinable Cause Found</th>
                        <td class="w-80">{{ $data->phase_ii_a_assi_cause }}</td>
                    </tr>
                    @endif
                    @if(filled(strip_tags((string) $data->QA_Head_primary_remark4)))
                    <tr>
                        <th class="w-20">P-II A QAH/CQAH Remark</th>
                        <td class="w-80">{{ $data->QA_Head_primary_remark4 }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            @if(count($qahFiles4))
            <div class="block">
                <div class="block-head">P-II A QAH/CQAH Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment</th>
                        </tr>
                        @foreach ($qahFiles4 as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase IIB Investigation --> ~Aditya Rajput --}}

            @if($hasIIBinv)
            <div class="block">
                <div class="block-head">Phase II B Investigation</div>

                @if(filled(strip_tags((string) $data->Summary_Of_Inv_IIB)) || filled($data->capa_required_IIB) || filled($data->reference_capa_IIB))
                <div class="block">
                    @if(filled(strip_tags((string) $data->Summary_Of_Inv_IIB)))
                    <table>
                        <tr>
                            <th class="w-20">Summary Of Investigation</th>
                            <td class="w-80">{{ strip_tags($data->Summary_Of_Inv_IIB) }}</td>
                        </tr>
                    </table>
                    @endif
                    @if(filled($data->capa_required_IIB) || filled($data->reference_capa_IIB))
                    <table>
                        <tr>
                            @if(filled($data->capa_required_IIB))
                            <th class="w-20">CAPA Required</th>
                            <td class="w-30">{{ $data->capa_required_IIB }}</td>
                            @endif
                            @if(filled($data->reference_capa_IIB))
                            <th class="w-20">Reference CAPA No.</th>
                            <td class="w-30">{{ $data->reference_capa_IIB }}</td>
                            @endif
                        </tr>
                    </table>
                    @endif
                </div>
                @endif

                @if(filled($data->resampling_req_IIB) || filled($data->Repeat_testing_IIB) || filled(strip_tags((string) $data->result_of_rep_test_IIB)) || filled(strip_tags((string) $data->Laboratory_Investigation_Hypothesis)) || filled(strip_tags((string) $data->Outcome_of_Laboratory)) || filled(strip_tags((string) $data->Evaluation_IIB)))
                <div class="block">
                    @if(filled($data->resampling_req_IIB) || filled($data->Repeat_testing_IIB))
                    <table>
                        <tr>
                            @if(filled($data->resampling_req_IIB))
                            <th class="w-20">Resampling Required IIB Inv.</th>
                            <td class="w-30">{{ $data->resampling_req_IIB }}</td>
                            @endif
                            @if(filled($data->Repeat_testing_IIB))
                            <th class="w-20">Repeat Testing Required IIB Inv.</th>
                            <td class="w-30">{{ $data->Repeat_testing_IIB }}</td>
                            @endif
                        </tr>
                    </table>
                    @endif

                    @if(filled(strip_tags((string) $data->result_of_rep_test_IIB)) || filled(strip_tags((string) $data->Laboratory_Investigation_Hypothesis)) || filled(strip_tags((string) $data->Outcome_of_Laboratory)) || filled(strip_tags((string) $data->Evaluation_IIB)))
                    <table>
                        @if(filled(strip_tags((string) $data->result_of_rep_test_IIB)))
                        <tr>
                            <th class="w-20">Results Of Repeat Testing IIB Inv.</th>
                            <td class="w-80">{{ strip_tags($data->result_of_rep_test_IIB) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->Laboratory_Investigation_Hypothesis)))
                        <tr>
                            <th class="w-20">Laboratory Investigation Hypothesis Details</th>
                            <td class="w-80">{{ strip_tags($data->Laboratory_Investigation_Hypothesis) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->Outcome_of_Laboratory)))
                        <tr>
                            <th class="w-20">Outcome Of Laboratory Investigation</th>
                            <td class="w-80">{{ strip_tags($data->Outcome_of_Laboratory) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->Evaluation_IIB)))
                        <tr>
                            <th class="w-20">Evaluation</th>
                            <td class="w-80">{{ strip_tags($data->Evaluation_IIB) }}</td>
                        </tr>
                        @endif
                    </table>
                    @endif
                </div>
                @endif

                @if(filled($data->Assignable_Cause111) || filled(strip_tags((string) $data->If_assignable_cause)) || filled(strip_tags((string) $data->If_assignable_error)))
                <div class="block">
                    <table>
                        @if(filled($data->Assignable_Cause111))
                        <tr>
                            <th class="w-20">Assignable Cause</th>
                            <td class="w-80">{{ $data->Assignable_Cause111 }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->If_assignable_cause)))
                        <tr>
                            <th class="w-20">If Assignable Cause Identified Perform Re-testing</th>
                            <td class="w-80">{{ strip_tags($data->If_assignable_cause) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->If_assignable_error)))
                        <tr>
                            <th class="w-20">If Assignable Cause Is Not Identified Proceed As Per Phase III Investigation</th>
                            <td class="w-80">{{ strip_tags($data->If_assignable_error) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                @endif

                @if(count($iibFiles))
                <div class="block">
                    <div class="block-head">Phase IIB inv. Attachment</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @foreach ($iibFiles as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif
            </div>
            @endif

            {{-- <!-- Phase II B HOD Primary --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->hod_remark5)))
            <div class="block">
                <div class="block-head">Phase II B HOD Review</div>
                <table>
                    <tr>
                        <th class="w-20">Phase II B HOD Remark</th>
                        <td class="w-80">{{ $data->hod_remark5 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($hodFiles5))
            <div class="block">
                <div class="block-head">Phase II B HOD Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($hodFiles5 as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif

            {{-- <!-- Phase II B CQA/QA --> ~Aditya Rajput --}}

            @if(filled(strip_tags((string) $data->QA_Head_remark5)))
            <div class="block">
                <div class="block-head">Phase II B CQA/QA Review</div>
                <table>
                    <tr>
                        <th class="w-20">Phase II B CQA/QA Remark</th>
                        <td class="w-80">{{ $data->QA_Head_remark5 }}</td>
                    </tr>
                </table>
            </div>
            @endif

            @if(count($qaFiles5))
            <div class="block">
                <div class="block-head">Phase II B CQA/QA Attachment</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($qaFiles5 as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif


            {{-- Phase II B QAH/CQAH Review + Batch Disposition --}}
            @if(filled(strip_tags((string) $data->reopen_approval_comments_uaa)) || $hasBD || count($dispFiles))
            <div class="block">
                <div class="block-head">Phase II B QAH/CQAH Review</div>

                @if(filled(strip_tags((string) $data->reopen_approval_comments_uaa)))
                <table>
                    <tr>
                        <th class="w-20">Approval Comment</th>
                        <td class="w-80">{{ strip_tags($data->reopen_approval_comments_uaa) }}</td>
                    </tr>
                </table>
                @endif

                @if($hasBD)
                <div class="block">
                    <div class="block-head">Batch Disposition</div>

                    @if(filled($data->oos_category_bd) || filled($data->material_batch_release_bd))
                    <table>
                        <tr>
                            @if(filled($data->oos_category_bd))
                            <th class="w-20">OOS/OOT Category</th>
                            <td class="w-30">{{ $data->oos_category_bd }}</td>
                            @endif
                            @if(filled($data->material_batch_release_bd))
                            <th class="w-20">Material/Batch Release</th>
                            <td class="w-30">{{ $data->material_batch_release_bd }}</td>
                            @endif
                        </tr>
                    </table>
                    @endif

                    @if(filled($data->others_bd) || filled(strip_tags((string) $data->other_action_bd)) || filled(strip_tags((string) $data->other_parameters_results_bd)) || filled(strip_tags((string) $data->justify_for_delay_in_activity_bd)))
                    <table>
                        @if(filled($data->others_bd))
                        <tr>
                            <th class="w-20">Other's</th>
                            <td class="w-80">{{ $data->others_bd }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->other_action_bd)))
                        <tr>
                            <th class="w-20">Other Action (Specify)</th>
                            <td class="w-80">{{ strip_tags($data->other_action_bd) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->other_parameters_results_bd)))
                        <tr>
                            <th class="w-20">Other Parameters Results</th>
                            <td class="w-80">{{ strip_tags($data->other_parameters_results_bd) }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->justify_for_delay_in_activity_bd)))
                        <tr>
                            <th class="w-20">Justify for Delay in Activity</th>
                            <td class="w-80">{{ strip_tags($data->justify_for_delay_in_activity_bd) }}</td>
                        </tr>
                        @endif
                    </table>
                    @endif
                </div>
                @endif

                @if(count($dispFiles))
                <table>
                    <div class="block-head"> Disposition Attachment</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @foreach ($dispFiles as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
                @endif
            </div>
            @endif

            {{-- ================= OOS/OOT Conclusion ================= --}}
            @php
                $capaRefOosc = is_array($data->capa_ref_no_oosc) ? ($data->capa_ref_no_oosc[0] ?? null) : $data->capa_ref_no_oosc;
                $conclAttach = is_array($data->file_attachments_if_any_ooscattach) ? array_values(array_filter($data->file_attachments_if_any_ooscattach)) : [];
                $conclReviewAttach = is_array($data->conclusion_attachment_ocr) ? array_values(array_filter($data->conclusion_attachment_ocr)) : [];

                $hasConclusion = filled(strip_tags((string) $data->conclusion_comments_oosc)) || filled($data->specification_limit_oosc)
                    || filled($data->results_to_be_reported_oosc) || filled($data->final_reportable_results_oosc)
                    || filled(strip_tags((string) $data->justifi_for_averaging_results_oosc)) || filled($data->oos_stands_oosc)
                    || filled($data->capa_req_oosc) || filled($capaRefOosc)
                    || filled(strip_tags((string) $data->justify_if_capa_not_required_oosc)) || count($conclAttach);

                $hasConclReview = filled(strip_tags((string) $data->action_on_affected_batch)) || count($conclReviewAttach);
            @endphp

            @if($hasConclusion)
            <div class="block">
                <div class="block-head"> OOS/OOT Conclusion </div>

                @if(filled(strip_tags((string) $data->conclusion_comments_oosc)) || filled($data->specification_limit_oosc) || filled($data->results_to_be_reported_oosc) || filled($data->final_reportable_results_oosc) || filled(strip_tags((string) $data->justifi_for_averaging_results_oosc)))
                <div class="block">
                    <table>
                        @if(filled(strip_tags((string) $data->conclusion_comments_oosc)))
                        <tr>
                            <th class="w-20">Conclusion Comments</th>
                            <td class="w-80">{{ strip_tags($data->conclusion_comments_oosc) }}</td>
                        </tr>
                        @endif
                        @if(filled($data->specification_limit_oosc))
                        <tr>
                            <th class="w-20">Specification Limit</th>
                            <td class="w-80">{{ $data->specification_limit_oosc }}</td>
                        </tr>
                        @endif
                        @if(filled($data->results_to_be_reported_oosc))
                        <tr>
                            <th class="w-20">Results to be Reported</th>
                            <td class="w-80">{{ $data->results_to_be_reported_oosc }}</td>
                        </tr>
                        @endif
                        @if(filled($data->final_reportable_results_oosc))
                        <tr>
                            <th class="w-20">Final Reportable Results</th>
                            <td class="w-80">{{ $data->final_reportable_results_oosc }}</td>
                        </tr>
                        @endif
                        @if(filled(strip_tags((string) $data->justifi_for_averaging_results_oosc)))
                        <tr>
                            <th class="w-20">Justify for Averaging Results</th>
                            <td class="w-80">{{ strip_tags($data->justifi_for_averaging_results_oosc) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                @endif

                @if(filled($data->oos_stands_oosc) || filled($data->capa_req_oosc))
                <div class="block">
                    <table>
                        <tr>
                            @if(filled($data->oos_stands_oosc))
                            <th class="w-20">OOS/OOT Stands</th>
                            <td class="w-30">{{ $data->oos_stands_oosc }}</td>
                            @endif
                            @if(filled($data->capa_req_oosc))
                            <th class="w-20">CAPA Req.</th>
                            <td class="w-30">{{ $data->capa_req_oosc }}</td>
                            @endif
                        </tr>
                    </table>
                </div>
                @endif

                @if(filled($capaRefOosc) || filled(strip_tags((string) $data->justify_if_capa_not_required_oosc)))
                <div class="block">
                    <table>
                        <tr>
                            @if(filled($capaRefOosc))
                            <th class="w-20">CAPA Ref No.</th>
                            <td class="w-30">{{ $capaRefOosc }}</td>
                            @endif
                            @if(filled(strip_tags((string) $data->justify_if_capa_not_required_oosc)))
                            <th class="w-20">Justify If CAPA Not Required</th>
                            <td class="w-30">{{ strip_tags($data->justify_if_capa_not_required_oosc) }}</td>
                            @endif
                        </tr>
                    </table>
                </div>
                @endif

                @if(count($conclAttach))
                <div class="block-head"> Attachments if Any </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80"> Attachment </th>
                        </tr>
                        @foreach ($conclAttach as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
            @endif

            @if($hasConclReview)
            <div class="block">
                <div class="block-head"> Conclusion Review Comments </div>

                @if(filled(strip_tags((string) $data->action_on_affected_batch)))
                <table>
                    <tr>
                        <th class="w-20">Action On Affected Batches</th>
                        <td class="w-80">{{ strip_tags($data->action_on_affected_batch) }}</td>
                    </tr>
                </table>
                @endif

                @if(count($conclReviewAttach))
                <table>
                    <div class="block-head">Conclusion Attachment </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80"> Attachment </th>
                            </tr>
                            @foreach ($conclReviewAttach as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
                @endif
            </div>
            @endif


            {{-- ================= Activity Log ================= --}}
            @php
                // [Label (By/On), By field, On field, Comment field, Comment label]
                $activityList = [
                    ['Submit',                                            'Submite_by', 'Submite_on', 'Submite_comment'],
                    ['Request for Cancellation',                          'cancelled_by', 'cancelled_on', 'comment_cancle'],
                    ['HOD Primary Review Complete',                       'HOD_Primary_Review_Complete_By', 'HOD_Primary_Review_Complete_On', 'HOD_Primary_Review_Complete_Comment'],
                    ['QA/CQA Head Primary Review Complete',               'CQA_Head_Primary_Review_Complete_By', 'CQA_Head_Primary_Review_Complete_On', 'CQA_Head_Primary_Review_Complete_Comment'],
                    ['Phase IA Investigation',                            'Phase_IA_Investigation_By', 'Phase_IA_Investiigation_On', 'Phase_IA_Investigation_Comment'],
                    ['Phase IA HOD Review Complete',                      'Phase_IA_HOD_Review_Complete_By', 'Phase_IA_HOD_Review_Complete_On', 'Phase_IA_HOD_Review_Complete_Comment'],
                    ['Phase IA QA/CQA Review Complete',                   'Phase_IA_QA_Review_Complete_By', 'Phase_IA_QA_Review_Complete_On', 'Phase_IA_QA_Review_Complete_Comment'],
                    ['Assignable Cause Not Found',                        'Assignable_Cause_Not_Found_By', 'Assignable_Cause_Not_Found_On', 'Assignable_Cause_Not_Found_Comment'],
                    ['Assignable Cause Found',                            'Assignable_Cause_Found_By', 'Assignable_Cause_Found_On', 'Assignable_Cause_Found_Comment'],
                    ['Phase IB Investigation',                            'Phase_IB_Investigation_By', 'Phase_IB_Investigation_On', 'Phase_IB_Investigation_Comment'],
                    ['Phase IB HOD Review Complete',                      'Phase_IB_HOD_Review_Complete_By', 'Phase_IB_HOD_Review_Complete_On', 'Phase_IB_HOD_Review_Complete_Comment'],
                    ['Phase IB QA/CQA Review Complete',                   'Phase_IB_QA_Review_Complete_By', 'Phase_IB_QA_Review_Complete_On', 'Phase_IB_QA_Review_Complete_Comment'],
                    ['P-IB Assignable Cause Not Found',                   'P_I_B_Assignable_Cause_Not_Found_By', 'P_I_B_Assignable_Cause_Not_Found_On', 'P_I_B_Assignable_Cause_Not_Found_Comment'],
                    ['P-IB Assignable Cause Found',                       'P_I_B_Assignable_Cause_Found_By', 'P_I_B_Assignable_Cause_Found_On', 'P_I_B_Assignable_Cause_Found_Comment'],
                    ['Phase II A Investigation',                          'Phase_II_A_Investigation_By', 'Phase_II_A_Investigation_On', 'Phase_II_A_Investigation_Comment'],
                    ['Phase II A HOD Review Complete',                    'Phase_II_A_HOD_Review_Complete_By', 'Phase_II_A_HOD_Review_Complete_On', 'Phase_II_A_HOD_Review_Complete_Comment'],
                    ['Phase II A QA/CQA Review Complete',                 'Phase_II_A_QA_Review_Complete_By', 'Phase_II_A_QA_Review_Complete_On', 'Phase_II_A_QA_Review_Complete_Comment'],
                    ['P-II A Assignable Cause Not Found',                 'P_II_A_Assignable_Cause_Not_Found_By', 'P_II_A_Assignable_Cause_Not_Found_On', 'P_II_A_Assignable_Cause_Not_Found_Comment'],
                    ['P-II A Assignable Cause Found',                     'P_II_A_Assignable_Cause_Found_By', 'P_II_A_Assignable_Cause_Found_On', 'P_II_A_Assignable_Cause_Found_Comment'],
                    ['Phase II B Investigation',                          'Phase_II_B_Investigation_By', 'Phase_II_B_Investigation_On', 'Phase_II_B_Investigation_Comment'],
                    ['Phase II B HOD Review Complete',                    'Phase_II_B_HOD_Review_Complete_By', 'Phase_II_B_HOD_Review_Complete_On', 'Phase_II_B_HOD_Review_Complete_Comment'],
                    ['Phase II B QA/CQA Review Complete',                 'Phase_II_B_QA_Review_Complete_By', 'Phase_II_B_QA_Review_Complete_On', 'Phase_II_B_QA_Review_Complete_Comment'],
                    ['P-II B Assignable Cause Not Found',                 'P_II_B_Assignable_Cause_Not_Found_By', 'P_II_B_Assignable_Cause_Not_Found_On', 'P_II_B_Assignable_Cause_Not_Found_Comment'],
                    ['P-II B Assignable Cause Found',                     'P_II_B_Assignable_Cause_Found_By', 'P_II_B_Assignable_Cause_Found_On', 'P_II_B_Assignable_Cause_Found_Comment'],
                    ['P III Investigation Applicable/Not Applicable',     'P_III_Investigation_Applicable_By', 'P_III_Investigation_Applicable_On', 'P_III_Investigation_Applicable_Comment'],
                ];

                // Jis group me By/On/Comment teeno khaali hain use hata do
                $activityRows = [];
                foreach ($activityList as $g) {
                    $by  = $data->{$g[1]};
                    $on  = $data->{$g[2]};
                    $com = $data->{$g[3]};
                    if (filled($by) || filled($on) || filled($com)) {
                        $activityRows[] = ['label' => $g[0], 'by' => $by, 'on' => $on, 'com' => $com];
                    }
                }
            @endphp

            @if(count($activityRows))
            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    @foreach($activityRows as $row)
                        @if(filled($row['by']) || filled($row['on']))
                        <tr>
                            @if(filled($row['by']))
                            <th class="w-20">{{ $row['label'] }} By</th>
                            <td class="w-30" @if(!filled($row['on'])) colspan="3" @endif>{{ $row['by'] }}</td>
                            @endif
                            @if(filled($row['on']))
                            <th class="w-20">{{ $row['label'] }} On</th>
                            <td class="w-30" @if(!filled($row['by'])) colspan="3" @endif>{{ $row['on'] }}</td>
                            @endif
                        </tr>
                        @endif
                        @if(filled($row['com']))
                        <tr>
                            <th>{{ $row['label'] }} Comment</th>
                            <td colspan="3">{{ $row['com'] }}</td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            @endif
        <!-- close block -->
        </div>
    </div>

</body>

</html>
