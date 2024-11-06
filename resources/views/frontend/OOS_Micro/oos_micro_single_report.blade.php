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




    <header>
        <table>
            <tr>
                <td class="w-70 head">
                   OOS Micro Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo1.png" alt="" style="width: 60px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>OOS Microbiology No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>

                       <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">@if($data->record_number){{  str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ $data->division_id }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_group_gi){{ $data->initiator_group_gi }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-80">@if($data->initiator_group_code_gi){{ $data->initiator_group_code_gi }} @else Not Applicable @endif</td>

                     </tr>
                     <tr>
                        <th class="w-20">Description</th>
                        <td class="w-80">@if($data->description_gi){{ $data->description_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-80">@if($data->severity_level_gi){{ $data->severity_level_gi }}@else Not Applicable @endif</td>
                    </tr>


                    {{-- -------------------------Preliminary Lab Investigation------------------- --}}

                <div class=" block-head">
                    Preliminary Lab Investigation
                    </div>
                <table>
@php

    $Preliminary_Lab_Investigation = [
                    'comments_pli' => 'Comments',
                    'field_alert_required_pli' => 'Field Alert Required',
                    'justify_if_no_field_alert_pli' => 'Justify if no Field Alert',
                    'verification_analysis_required_pli' => 'Verification Analysis Required',
                    'analyst_interview_req_pli' => 'Analyst Interview Req.',
                    'justify_if_no_analyst_int_pli' => 'Justify if no Analyst Int.',
                    'phase_i_investigation_required_pli' => 'Phase I Investigation Required',
                    'phase_i_investigation_pli' => 'Phase I Investigation '
];

@endphp

                    @foreach ($Preliminary_Lab_Investigation as $key => $value)
                        @if(bcmod($loop->index, 2) == 0) 
                        <tr> @endif
                            <th class="w-20">{{$value}}</th>
                            <td class="w-80">@if($data->$key) {{ $data->$key}} @else
                                 Not Applicable @endif</td>
                          @if(bcmod($loop->index, 2) == 1 || $loop->last) 
                        </tr>
                        @endif
                    @endforeach
                </table>
               


{{-- -------------------------Preliminary Lab Investigation------------------- --}}


                <div class="block-head">
                    Preliminary Lab Investigation Conclusion
                </div>
                <table>
@php
              $Preliminary_Lab_Investigation_Conclusion = [
                            'summary_of_prelim_investiga_plic' => 'Summary of Prelim.Investigation',
                            'root_cause_identified_plic' => 'Root Cause Identified',
                            'oos_category_root_cause_ident_plic' => 'OOS Category-Root Cause Ident.',
                            'oos_category_others_plic' => 'OOS Category(Others)',
                            'root_cause_details_plic' => 'Root Cause Details',
                            'oos_category_root_cause_plic' => 'OOS Category-Root Cause Ident.',
                            'recommended_actions_required_plic' => 'Recommended Actions Required?',
                            'capa_required_plic' => 'CAPA Required',
                            'reference_capa_no_plic' => 'Reference CAPA No.',
                            'delay_justification_for_pi_plic' => 'Delay Justification for P.I.',
];

@endphp

                            @foreach ($Preliminary_Lab_Investigation_Conclusion as $key => $value)
                            @if(bcmod($loop->index, 2) == 0) 
                            <tr> 
                            @endif
                                <th class="w-20">{{$value}}</th>
                                <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                            @if(bcmod($loop->index, 2) == 1 || $loop->last) 
                            </tr> 
                            @endif
                            @endforeach

                    </table>
                    <div class="block-head">
                        Preliminary Lab Invst Review
                    </div>
                    <table>
@php

$Preliminary_lab_invst_review = [
    'review_comments_plir' => 'Review Comments',
    'phase_ii_inv_required_plir' => 'Phase II Inv. Required?',
];

@endphp

                            @foreach ($Preliminary_lab_invst_review as $key => $value)
                            @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                <th class="w-20">{{$value}}</th>
                                <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                            @if(bcmod($loop->index, 2) == 1 || $loop->last)  </tr> @endif
                            @endforeach
                        </table>

                        <div class="sub-head"><strong>OOS Review for Similar Nature </strong></div>
                        <hr style="width: 100%; height: 3px; background-color: black; border: none;">
                        <div class="block">
                                Info. On Product/ Material
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                    {{-- <th colspan="1">SR no.</th> --}}
                                    <th style="width: 2%">Row#</th>
                                    <th style="width: 8%">OOS Number</th>
                                    <th style="width: 8%"> OOS Reported Date</th>
                                    <th style="width: 12%">Description of OOS</th>
                                    <th style="width: 12%">Previous OOS Root Cause</th>
                                    <th style="width: 6%"> CAPA</th>
                                    </tr>
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>

                                    </tr>
                                    {{-- @endif --}}
                                </table>
                            </div>
                        </div>

                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                {{-- <th colspan="1">SR no.</th> --}}
                                <th style="width: 10% pt-3">Closure Date of CAPA</th>
                                <th style="width: 8%">CAPA Requirement</th>
                                <th style="width: 8%">Reference CAPA Number</th>
                                </tr>
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                </tr>
                                {{-- @endif --}}
                            </table>
                        </div>


                        <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
                        {{-- <div class="group-input">
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
                                            <th style="width: 8%"> OOS Reported Date</th>
                                            <th style="width: 12%">Description of OOS</th>
                                            <th style="width: 16%">Previous OOS Root Cause</th>
                                            <th style="width: 16%"> CAPA</th>
                                            <th style="width: 16% pt-3">Closure Date of CAPA</th>
                                            <th style="width: 16%">CAPA Requirement</th>
                                            <th style="width: 16%">Reference CAPA Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td><input disabled type="text" name="info_product_oos_capa[0][serial]" value="1"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][oos_number]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][oos_reported_date]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][description_of_oos]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][previous_oos_root_cause]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][capa]"></td>
                                        <td><input type="text" name="info_product_oos_capa[0][closure_date_of_capa]"></td>
                                        <td><select name = "info_product_oos_capa[0][capa_Requirement]" >
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><input type="text" name="info_product_oos_capa[0][reference_capa_number]"></td>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}

{{-- ================  Checklist-Investigation of Bacterial Endotoxin Test  ======================= --}}
<div class="block-head">
    Checklist-Investigation of Bacterial Endotoxin Test
</div>
@php
$questions = [
    'check_analyst_training_procedures' => [
        'headings' => 'Checklist for Analyst Training and Procedure',
        'identifier' => '',
        'questions' => [
            "Is the analyst trained/qualified BET test procedure?",
            "Reference procedure number :-",
            "Effective date",
            "Date of qualification:",
            "Were appropriate precaution taken by the analyst throughout the test?",
            "Analyst interview record",
            "Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections?",
            "Analyst interview record",
            "Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?",
        ]
    ],
    'sample_receiving_verifications' => [
        'headings' => 'Checklist for Sample receiving & verification in lab :',
        'identifier' => '',
        'questions' => [
            "Was the sample container (Physical integrity) verified at the time of sample receipt?",
            "Were clean and dehydrogenated sampling accessories and glassware used for sampling?",
            "Was the correct quantity of the sample withdrawn?",
            "Was there any discrepancy observed during sampling?",
            "Was the sample container (Physical integrity) checked before testing?",
        ]
    ],
    'method_procedure_used_during_anas' => [
        'headings' => 'Checklist for Method/Procedure used during analysis:',
        'identifier' => '',
        'questions' => [
            "Was correct applicable specification/Test procedure/MOA used for analysis?",
            "Verified specification/Test procedure/MOA No.",
            "Was the test procedure followed as per method validation?",
            "Was there any change in the validated change method? If yes, was test performed with the new validated method?",
            "Was BET reagents (Lysate, CSE, LRW and Buffer) procured from the approved vendor?",
            "Was lysate and CSE stored at the recommended temperature and duration? Storage condition:",
            "Were all product/reagents contact parts of BET testing (Tips/Accessories/Sample Container) depyrogenated?",
            "Assay tube/Batch No.",
            "Expiry date:",
            "Tip lot/Batch No.",
            "Expiry date:",
            "Was the test done at correct MVD as per validated method?",
            "Were calculations of MVD/Test dilution done correctly?",
            "Were correct dilutions prepared?",
            "Was labeled claim lysate sensitivity checked before the use of the lot?",
            "Were all reagents (LRW/CSE and Lysate) used in the test within the expiry?",
            "LRW expiry date?",
            "CSE expiry date?",
            "Lysate expiry date?",
            "Buffer expiry date?",
            "Was рН of the test sample/dilution verified?",
            "Were appropriate рН strip/measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?",
            "Were proper incubation conditions followed?",
            "Was there any spillage that occurred during the vortexing of dilutions?",
            "Were the results of positive, negative, and test controls found satisfactory?",
            "Is the test incubator/heating block kept on a vibration-free surface?",
            "Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:"
        ]
    ],
    'Instrument_Equipment_Details' => [
        'headings' => 'Checklist for Instrument/Equipment Details:',
        'identifier' => '',
        'questions' => [
            "Was the equipment used, calibrated/qualified and within the specified range?",
            "Dry block /Heating block equipment ID:",
            "Calibration date & Next due date:",
            "Pipettes ID:",
            "Calibration date and Next due date:",
            "Refrigerator (2-8̊ C) ID:",
            "Validation date and next due date:",
            "Dehydrogenation over ID:",
            "Validation date and next due date:",
            "Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?",
            "Was the depyrogenation done as per the validated load pattern?",
            "Was there any power failure noticed during the incubation of samples in the heating block?",
            "Was assay tubes incubated in the dry block (time and temp) as specified in the procedure?",
            "Were any other samples tested along with this sample?",
            "If yes, were those sample’s results found satisfactory?",
            "Were any other samples analyzed at the same time on the same instruments?",
            "If yes, what were the results of other Batches?"
        ]
    ],
    'Results_and_Calculations' => [
        'headings' => 'Checklist for Results and Calculation :',
        'identifier' => '',
        'questions' => [
            "Were results taken properly?",
            "Raw data checked By:",
            "Was formula dilution factor used for calculating the results correct?"
        ]
    ]
];
@endphp
<div class="row">
    <div class="col-12">
        <div class="group-input">
            <div class="why-why-chart">
                @foreach ($questions as $headings => $heading)
                <div class="inner-block-content">
                    <div class="sub-head"><strong>{{ $heading['headings'] }}</strong></div>
                    <hr style="width: 100%; height: 3px; background-color: black; border: none;">
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
                            @foreach ($heading['questions'] as $index => $single_question)
                            <tr>
                                <td class="flex text-center">{{ $index + 1 }}</td>
                                <td>{{ $single_question }}</td>
                                <td>
                                    <div style="display: flex; justify-content: space-around; align-items: center; margin: 5%; gap:5px">
                                        <select name="{{ $headings }}[{{ $index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black; background-color: #f0f0f0;">
                                            <option value="">Select an Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div style="margin: auto; display: flex; justify-content: center;">
                                        <p>Not applicable</p>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>






{{-- ----------------------------------------- Phase II INvestigation------------------------------------ --}}
                        <div class="block-head">
                            Phase II Investigation
                        </div>
                        <table>


    @php
        $Phase_II_Investigation = [
    'qa_approver_comments_piii' => 'QA Approver Comments',
    'manufact_invest_required_piii' => 'Manufact. Invest. Required?',
    'manufacturing_invest_type_piii' => 'Manufacturing Invest. Type',
    'manufacturing_invst_ref_piii' => 'Manufacturing Invst. Ref.',
    're_sampling_required_piii' => 'Re-sampling Required?',
    'audit_comments_piii' => 'Audit Comments',
    're_sampling_ref_no_piii' => 'Re-sampling Ref. No.',
    'hypo_exp_required_piii' => 'Hypo/Exp.Required',
    'hypo_exp_reference_piii' => 'Hypo/Exp. Reference',
];
    @endphp
                 @foreach ($Phase_II_Investigation as $key => $value)
                 @if(bcmod($loop->index, 2) == 0) <tr> @endif
                     <th class="w-20">{{$value}}</th>
                     <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                 @if(bcmod($loop->index, 2) == 1 || $loop->last) </tr> @endif
                 @endforeach
                </table>

{{-- ----------------------Phase_II_QC_Review--------------------- --}}

                                <div class="block-head w-100">
                                    Phase II QC Review
                                </div>
                            <table>

@php
                        $Phase_II_QC_Review = [
                'summary_of_exp_hyp_piiqcr' => 'Summary of Exp./Hyp.',
                'summary_mfg_investigation_piiqcr' => 'Summary Mfg.Investigation',
                'root_casue_identified_piiqcr' => 'Root Cause Identified',
                'oos_category_reason_identified_piiqcr' => 'OOS Category-Reason Identified',
                'others_oos_category_piiqcr' => 'Others (OOS category)',
                'details_of_root_cause_piiqcr' => 'Details of Root Cause',
                'impact_assessment_piiqcr' =>'Impact Assessment',
                'recommended_action_required_piiqcr' => 'Recommended Action Required?',
                'recommended_action_reference_piiqcr' => 'Recommended Action Reference',
                'investi_required_piiqcr' => 'Invest.Required',
                'invest_ref_piiqcr' => 'Invest ref.',
            ];
 @endphp
                                      @foreach ($Phase_II_QC_Review as $key => $value)
                                      @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                          <th class="w-20">{{$value}}</th>
                                          <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                                      @if(bcmod($loop->index, 2) == 1 || $loop->last) </tr> @endif
                                      @endforeach

                    </table>

               {{-- -----------Additional Testing Proposal----------- --}}
                                        <div class="block-head">
                                            Additional Testing Proposal
                                        </div>
                    <table>
@php
    $Additional_Testing_Proposal = [
    'review_comment_atp' => 'Review Comment',
    'additional_test_proposal_atp' => 'Additional Test Proposal',
    'additional_test_reference_atp' => 'Additional Test Reference',
    'any_other_actions_required_atp' => 'Any Other Actions Required',
    'action_task_reference_atp' => 'Action Task Reference',
];
@endphp
                            @foreach ($Additional_Testing_Proposal as $key => $value)
                            @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                <th class="w-20">{{$value}}</th>
                                <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                            @if(bcmod($loop->index, 2) == 1 || $loop->last) </tr> @endif
                            @endforeach
                </table>
                            {{-- --------------------------------OOS_Conclusion------------------------------------------------- --}}
                            <div class="block-head">
                                OOS/OOT Conclusion
                            </div>

                <table>
@php
    $OOS_Conclusion = [
    "conclusion_comments_oosc" => 'Conclusion Comments',
    "specification_limit_oosc" => 'Specification Limit',
    "results_to_be_reported_oosc" => 'Results to be Reported',
    "final_reportable_results_oosc" => 'Final Reportable Results',
    "justifi_for_averaging_results_oosc" => 'Justifi. for Averaging Results',
    "oos_stands_oosc" => 'OOS/OOT Stands',
    "capa_req_oosc" => 'CAPA Req.',
    "capa_ref_no_oosc" => 'CAPA Ref No.',
    "justify_if_capa_not_required_oosc" => 'Justify if CAPA not required',
    "action_plan_req_oosc" => 'Action Plan Req.',
    "action_plan_ref_oosc" => 'Action Plan Ref.',
    "justification_for_delay_oosc" => 'Justification for Delay',
];
@endphp
                                @foreach ($OOS_Conclusion as $key => $value)
                                @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                    <th class="w-20">{{$value}}</th>
                                    <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                                @if(bcmod($loop->index, 2) == 1 || $loop->last)  </tr> @endif
                                @endforeach
                </table>

{{-- --------------------------------OOS_Conclusion  Review------------------------------------------------ --}}
                                                <div class="block-head">
                                                    OOS Conclusion Review
                                                </div>
                                                <table>
@php

$OOS_Conclusion_Review = [
    "conclusion_review_comments_ocr" => 'Conclusion Review Comments',
    "action_taken_on_affec_batch_ocr" => 'Action Taken on Affec.batch',
    "capa_req_ocr" => 'CAPA Req.?',
    "capa_refer_ocr" => 'CAPA Refer.',
    "required_action_plan_ocr" => 'Required Action Plan?',
    "required_action_task_ocr" => 'Required Action Task?',
    "action_task_reference_ocr" => 'Action Task Reference',
    "risk_assessment_req_ocr" => 'Risk Assessment Req?',
    "risk_assessment_ref_ocr" => 'Risk Assessment Ref.',
    "justify_if_no_risk_assessment_ocr" => 'Justify if no risk Assessment',
    "qa_approver_ocr" => 'CQ Approver',
];
@endphp
                                    @foreach ($OOS_Conclusion_Review as $key => $value)
                                    @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                        <th class="w-20">{{$value}}</th>
                                        <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                                    @if(bcmod($loop->index, 2) == 1 || $loop->last)  </tr> @endif
                                    @endforeach
                                </table>

{{-- --------------------------------OOS CQ Review------------------------------------------------ --}}
                                            <div class="block-head">
                                                OOS CQ Review
                                            </div>
                                <table>
@php

$OOS_CQ_Review = [
    "capa_required_OOS_CQ" => 'CAPA required?',
    "ref_action_plan_OOS_CQ" => 'Ref Action Plan',
    "reference_of_capa_OOS_CQ" => 'Reference of CAPA',
    "cq_review_comments_OOS_CQ" => 'CQ Review Comments',
    "action_plan_requirement_OOS_CQ" => 'Action plan requirement?',
];
@endphp
                                    @foreach ($OOS_CQ_Review as $key => $value)
                                    @if(bcmod($loop->index, 2) == 0) <tr> @endif
                                        <th class="w-20">{{$value}}</th>
                                        <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                                    @if(bcmod($loop->index, 2) == 1 || $loop->last)  </tr> @endif
                                    @endforeach

                                </table>


{{-- --------------------------------OOS CQ Review------------------------------------------------ --}}
                            <div class="block-head">
                                Batch Disposition
                            </div>
                            <table>
@php
     $batchDisposition = [
            'others_BI' => 'Others',
            'oos_category_BI' => 'OOS Category',
            'material_batch_release_BI' => 'Material/Batch Release',
            'other_action_BI' => 'Other Action (Specify)',
            'field_alert_reference_BI' => 'Field Alert Reference',
            'other_parameter_result_BI' => 'Other Parameters Results',
            'trend_of_previous_batches_BI' => 'Trend of Previous Batches',
            'stability_data_BI' => 'Stability Data',
            'process_validation_data_BI' => 'Process Validation Data',
            'method_validation_BI' => 'Method Validation',
            'any_market_complaints_BI' => 'Any Market Complaints',
            'statistical_evaluation_BI' => 'Statistical Evaluation',
            'risk_analysis_for_disposition_BI' => 'Risk Analysis for Disposition',
            'conclusion_BI' => 'Conclusion',
            'phase_III_inves_required_BI' => 'Phase-III Inves.Required?',
            'phase_III_inves_reference_BI' => 'Phase-III Inves.Reference',
            'justify_for_delay_BI' => 'Justify for Delay in Activity',
            'reopen_request'=> 'Other Action (Specify)',
        ];
@endphp
                            @foreach ($batchDisposition as $key => $value)
                            @if(bcmod($loop->index, 2) == 0) 
                                <tr>
                             @endif
                                    <th class="w-20">{{$value}}</th>
                                    <td class="w-80">@if($data->$key){{ $data->$key}} @else Not Applicable @endif</td>
                                @if(bcmod($loop->index, 2) == 1 || $loop->last)  
                            </tr> 
                            @endif
                            @endforeach



                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_group_gi){{ $data->initiator_group_gi }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-80">@if($data->initiator_group_code_gi){{ $data->initiator_group_code_gi }} @else Not Applicable @endif</td>
                    </tr>
                    </table>
                </div>
                <div class="block-head">
                       Capa Attachement
                    </div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File </th>
                            </tr>
                                @if($data->capa_attachment)
                                @foreach(json_decode($data->capa_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                    Material Details
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                        <th colspan="1">SR no.</th>
                            <th class="w-10">Material Name</th>
                            <th class="w-10">Batch Number</th>
                            <th class="w-10">Date Of Manufacturing</th>
                            <th class="w-10">Date Of Expiry</th>
                            <th class="w-10">Batch Disposition</th>
                            <th class="w-10">Remark</th>
                            <th>Batch Status</th>
                        </tr>
                        {{-- @if($data->Material_Details->material_name) --}}
                        {{-- @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo) --}}
                        {{-- <tr>
                            <td class="w-15">{{ $dataDemo ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "Not Applicable"}}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "Not Applicable" }}</td>
                            <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "Not Applicable" }}</td>
                        </tr> --}}
                        {{-- @endforeach --}}
                        {{-- @else --}}
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
                        {{-- @endif --}}
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Equipment/Instruments Details
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-25">SR no.</th>
                            <th class="w-25">Equipment/Instruments Name</th>
                            <th class="w-25">Equipment/Instruments ID</th>
                            <th class="w-25">Equipment/Instruments Comments</th>
                        </tr>
                        {{-- @if($data->Instruments_Details->equipment)
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

                        @endif --}}
                    </table>
                </div>
            </div>
                    </table>
                </div>

            <div class="block">
                <div class="block-head">
                  Other type CAPA Details
                </div>
                <table>
                       <tr>
                            <th class="w-20">Details</th>
                            <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>
                        </tr>
                       <tr>
                            <th class="w-20">CAPA QA Comments
                            </th>
                            <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                        </tr>
                <tr>
                        <th class="w-20">CAPA Type</th>
                        <td class="w-80">@if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective Action</th>
                        <td class="w-80">@if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-80">@if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Supervisor Review Comments
                        </th>
                        <td class="w-80">@if($data->supervisor_review_comments){{ $data->supervisor_review_comments }}@else Not Applicable @endif</td>
                    </tr>

                    <div class="block-head">
                       CAPA Closure
                    </div>
                    <table>
                     <tr>
                        <th class="w-20">QA Review & Closure</th>
                        <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Due Date Extension Justification</th>
                        <td class="w-80">@if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif</td>
                   </tr>
                    {{-- <tr>
                        <th class="w-20">Closure Attachment</th>
                        <td class="w-80">@if($data->closure_attachment)<a href="{{asset('upload/document/',$data->closure_attachment)}}">{{ $data->closure_attachment }}</a>@else Not Applicable @endif</td>

                    </tr> --}}

                <div class="block-head">
                    Closure Attachment
                 </div>
                   <div class="border-table">
                     <table>
                         <tr class="table_bg">
                             <th class="w-20">S.N.</th>
                             <th class="w-60">File </th>
                         </tr>
                             @if($data->closure_attachment)
                             @foreach(json_decode($data->closure_attachment) as $key => $file)
                                 <tr>
                                     <td class="w-20">{{ $key + 1 }}</td>
                                     <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                    </div>




 {{-- -------------------------Preliminary Lab Investigation review------------------- --}}

              

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Plan Proposed By
                        </th>
                        <td class="w-30">{{ $data->plan_proposed_by }}</td>
                        <th class="w-20">
                            Plan Proposed On</th>
                        <td class="w-30">{{ $data->plan_proposed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Plan Approved By
                        </th>
                        <td class="w-30">{{ $data->plan_approved_by }}</td>
                        <th class="w-20">
                            Plan Approved On</th>
                        <td class="w-30">{{ $data->Plan_approved_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA More Info Required By
                        </th>
                        <td class="w-30">{{ $data->qa_more_info_required_by }}</td>
                        <th class="w-20">
                            QA More Info Required On</th>
                        <td class="w-30">{{ $data->qa_more_info_required_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By
                        </th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">
                            Cancelled On</th>
                        <td class="w-30">{{ $data->cancelled_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Completed By
                        </th>
                        <td class="w-30">{{ $data->completed_by }}</td>
                        <th class="w-20">
                            Completed On</th>
                        <td class="w-30">{{ $data->completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->approved_by }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ $data->approved_on }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Rejected By</th>
                        <td class="w-30">{{ $data->rejected_by }}</td>
                        <th class="w-20">Rejected On</th>
                        <td class="w-30">{{ $data->rejected_on }}</td>
                    </tr>

                </table>
            </div>
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
