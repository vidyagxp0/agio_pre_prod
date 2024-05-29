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
                    OOC Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Errata No.</strong>
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

                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record_number)
                                {{ str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_id)
                                {{ $data->division_id }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ $data->due_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ $data->Initiator_Group }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
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
                    <tr>
                        <th class="w-20">If Other</th>
                        <td class="w-80">
                            @if ($data->initiated_if_other)
                                {{ $data->initiated_if_other }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Is Repeat</th>
                        <td class="w-80">
                            @if ($data->is_repeat_ooc)
                                {{ $data->is_repeat_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-30">
                            @if ($data->Repeat_Nature)
                                {!! $data->Repeat_Nature !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Description</th>
                        <td class="w-80">
                            @if ($data->description_ooc)
                                {!! $data->description_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">
                            @if ($data->initial_attachment_ooc)
                                {{ $data->initial_attachment_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">OOC Logged By</th>
                        <td class="w-80">
                            @if ($data->assign_to)
                                {{ $data->assign_to }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    <tr>
                        <th class="w-20">OOC Logged On</th>
                        <td class="w-80">
                            @if ($data->ooc_due_date)
                                {{ $data->ooc_due_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Delay Justification for Reporting</th>
                        <td class="w-80">
                            @if ($data->Delay_Justification_for_Reporting)
                                {{ $data->Delay_Justification_for_Reporting }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                {{-- <div class="block"> --}}
                {{-- <div class="block-head"> --}}
                <div style="font-weight: 200">Instrument Details </div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">SR no.</th>
                            <th class="w-20">Instrument Name</th>
                            <th class="w-20">Instrument ID</th>
                            <th class="w-20">Remarks</th>
                            <th class="w-20">Calibration Parameter</th>
                            <th class="w-20">Acceptance Criteria</th>
                            <th class="w-20">Results</th>
                        </tr>
                        @if ($oocgrid && is_array($oocgrid->data))
                            @foreach ($oocgrid->data as $oogrid)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ isset($oogrid['instrument_name']) ? $oogrid['instrument_name'] : '' }}
                                    </td>
                                    <td>{{ isset($oogrid['instrument_id']) ? $oogrid['instrument_id'] : '' }}</td>
                                    <td>{{ isset($oogrid['remarks']) ? $oogrid['remarks'] : '' }}</td>
                                    <td>{{ isset($oogrid['calibration']) ? $oogrid['calibration'] : '' }}</td>
                                    <td>{{ isset($oogrid['instrument_id']) ? $oogrid['acceptancecriteria'] : '' }}</td>
                                    <td>{{ isset($oogrid['remarks']) ? $oogrid['results'] : '' }}</td>
                                </tr>
                            @endforeach
                            {{-- @else --}}
                            {{-- <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr> --}}
                            {{-- @endforeach --}}
                        @else
                            <p>No data available</p>
                        @endif

                    </table>
                </div>
            </div>
            </div>


                <div class="block">
                    <div class="block-head">
                        HOD/Supervisor Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">HOD Remarks</th>
                            <td class="w-80">
                                @if ($data->HOD_Remarks)
                                    {!! $data->HOD_Remarks !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            {{-- </tr>
                            <tr> --}}
                            <th class="w-20">HOD Attachement</th>
                            <td class="w-80">
                                @if ($data->attachments_hod_ooc)
                                    {!! $data->attachments_hod_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Immediate Action</th>
                            <td class="w-80">
                                @if ($data->Immediate_Action_ooc)
                                    {!! $data->Immediate_Action_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Preliminary Investigation</th>
                            <td class="w-80">
                                @if ($data->Preliminary_Investigation_ooc)
                                    {!! $data->Preliminary_Investigation_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>

                        <div class="block">
                            <div class="block-head">
                                OOC Evaluation Form
                            </div>

                            <div style="font-weight: 200">OOC Evolution Form </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">SR no.</th>
                                        <th class="w-20">Response</th>
                                        <th class="w-20">Remarks</th>
                                    </tr>
                                    <tbody>
                                        @if ($oocevolutions && is_array($oocevolutions->data))
                                        @foreach ($oocevolutions->data as $E_data)
                                                <tr>

                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ isset($E_data['response']) ? $E_data['response'] : '' }}

                                                    <td>
                                                        {{ isset($E_data['remarks']) ? $E_data['remarks'] : '' }}
                                                    </td>
                                                </tr>

                                            @endforeach
                                    </tbody>
                                    @else
                                        <p>No data available</p>
                                    @endif

                                </table>
                            </div>

                            <table>
                                <tr>
                                    <th class="w-20">Evaluation Remarks</th>
                                    <td class="w-80">
                                        @if ($data->qa_comments_ooc)
                                            {!! $data->qa_comments_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Description of Cause for OOC Results (If Identified)
                                    </th>
                                    <td class="w-80">
                                        @if ($data->qa_comments_description_ooc)
                                            {{ $data->qa_comments_description_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Assignable root cause found?</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_assingable_ooc)
                                            {!! $data->is_repeat_assingable_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Protocol Based Study/Hypothesis Study
                                    </th>
                                    <td class="w-80">
                                        @if ($data->protocol_based_study_hypthesis_study_ooc)
                                            {{ $data->protocol_based_study_hypthesis_study_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Justification for Protocol study/ Hypothesis Study</th>
                                    <td class="w-80">
                                        @if ($data->justification_for_protocol_study_hypothesis_study_ooc)
                                            {!! $data->justification_for_protocol_study_hypothesis_study_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Plan of Protocol Study/ Hypothesis Study
                                    </th>
                                    <td class="w-80">
                                        @if ($data->plan_of_protocol_study_hypothesis_study)
                                            {{ $data->plan_of_protocol_study_hypothesis_study }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                <tr>
                                    <th class="w-20">
                                        Conclusion of Protocol based Study/Hypothesis Study
                                    </th>
                                    <td class="w-80">
                                        @if ($data->conclusion_of_protocol_based_study_hypothesis_study_ooc)
                                            {{ $data->conclusion_of_protocol_based_study_hypothesis_study_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">
                                Stage I
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Analyst Remarks</th>
                                    <td class="w-80">
                                        @if ($data->analysis_remarks_stage_ooc)
                                            {!! $data->analysis_remarks_stage_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">
                                        Calibration Results</th>
                                    <td class="w-80">
                                        @if ($data->calibration_results_stage_ooc)
                                            {{ $data->calibration_results_stage_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Results Nature</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_result_naturey_ooc)
                                            {!! $data->is_repeat_result_naturey_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Review of Calibration Results of Analyst</th>
                                    <td class="w-80">
                                        @if ($data->review_of_calibration_results_of_analyst_ooc)
                                            {{ $data->review_of_calibration_results_of_analyst_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Stage I Attachement</th>
                                    <td class="w-80">
                                        @if ($data->attachments_stage_ooc)
                                            {!! $data->attachments_stage_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Results Criteria</th>
                                    <td class="w-80">
                                        @if ($data->results_criteria_stage_ooc)
                                            {{ $data->results_criteria_stage_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Initial OOC is Invalidated/Validated</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_stae_ooc)
                                            {!! $data->is_repeat_stae_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Additinal Remarks (if any)</th>
                                    <td class="w-80">
                                        @if ($data->qa_comments_stage_ooc)
                                            {{ $data->qa_comments_stage_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Additinal Remarks (if any)</th>
                                    <td class="w-80">
                                        @if ($data->additional_remarks_stage_ooc)
                                            {{ $data->additional_remarks_stage_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>


                        <div class="block">
                            <div class="block-head">
                                Stage II
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Rectification by Service Engineer required</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_stageii_ooc)
                                            {!! $data->is_repeat_stageii_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">
                                        Instrument is Out of Order</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_stage_instrument_ooc)
                                            {{ $data->is_repeat_stage_instrument_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Proposed By</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_proposed_stage_ooc)
                                            {!! $data->is_repeat_proposed_stage_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Details of Equipment Rectification Attachment</th>
                                    <td class="w-80">
                                        @if ($data->initial_attachment_stageii_ooc)
                                            {{ $data->initial_attachment_stageii_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Compiled by:</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_compiled_stageii_ooc)
                                            {!! $data->is_repeat_compiled_stageii_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Release of Instrument for usage</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_realease_stageii_ooc)
                                            {{ $data->is_repeat_realease_stageii_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Impact Assessment at Stage II</th>
                                    <td class="w-80">
                                        @if ($data->initiated_throug_stageii_ooc)
                                            {!! $data->initiated_throug_stageii_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Details of Impact Evaluation</th>
                                    <td class="w-80">
                                        @if ($data->initiated_through_stageii_ooc)
                                            {{ $data->initiated_through_stageii_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Result of Reanalysis:</th>
                                    <td class="w-80">
                                        @if ($data->is_repeat_reanalysis_stageii_ooc)
                                            {{ $data->is_repeat_reanalysis_stageii_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Cause for failure</th>
                                    <td class="w-80">
                                        @if ($data->initiated_through_stageii_cause_failure_ooc)
                                            {{ $data->initiated_through_stageii_cause_failure_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">
                                CAPA
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">CAPA Type?</th>
                                    <td class="w-80">
                                        @if (!empty($data->is_repeat_capas_ooc))
                                            {!! $data->is_repeat_capas_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Corrective Action</th>
                                    <td class="w-80">
                                        @if (!empty($data->initiated_through_capas_ooc))
                                            {{ $data->initiated_through_capas_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Preventive Action</th>
                                    <td class="w-80">
                                        @if (!empty($data->initiated_through_capa_prevent_ooc))
                                            {!! $data->initiated_through_capa_prevent_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Corrective & Preventive Action</th>
                                    <td class="w-80">
                                        @if (!empty($data->initiated_through_capa_corrective_ooc))
                                            {{ $data->initiated_through_capa_corrective_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Details of Equipment Rectification Attachment</th>
                                    <td class="w-80">
                                        @if (!empty($data->initial_attachment_capa_ooc))
                                            {!! $data->initial_attachment_capa_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">CAPA Post Implementation Comments</th>
                                    <td class="w-80">
                                        @if (!empty($data->initiated_through_capa_ooc))
                                            {{ $data->initiated_through_capa_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">CAPA Post Implementation Attachment</th>
                                    <td class="w-80">
                                        @if (!empty($data->initial_attachment_capa_post_ooc))
                                            {!! $data->initial_attachment_capa_post_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <div class="block">
                            <div class="block-head">
                                Closure
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Closure Comments</th>
                                    <td class="w-80">
                                        @if (!empty($data->short_description_closure_ooc))
                                            {!! $data->short_description_closure_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Details of Equipment Rectification</th>
                                    <td class="w-80">
                                        @if (!empty($data->initial_attachment_closure_ooc))
                                            {{ $data->initial_attachment_closure_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Document Code</th>
                                    <td class="w-80">
                                        @if (!empty($data->document_code_closure_ooc))
                                            {!! $data->document_code_closure_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Remarks</th>
                                    <td class="w-80">
                                        @if (!empty($data->remarks_closure_ooc))
                                            {{ $data->remarks_closure_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Immediate Corrective Action</th>
                                    <td class="w-80">
                                        @if (!empty($data->initiated_through_closure_ooc))
                                            {!! $data->initiated_through_closure_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>



                        <div class="block">
                            <div class="block-head">
                                HOD Review
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">HOD Remarks</th>
                                    <td class="w-80">
                                        @if ($data->initiated_through_hodreview_ooc)
                                            {!! $data->initiated_through_hodreview_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">HOD Attachment</th>
                                    <td class="w-80">
                                        @if ($data->initial_attachment_hodreview_ooc)
                                            {{ $data->initial_attachment_hodreview_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Root Cause Analysis</th>
                                    <td class="w-80">
                                        @if ($data->initiated_through_rootcause_ooc)
                                            {!! $data->initiated_through_rootcause_ooc !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Impact Assessment</th>
                                    <td class="w-80">
                                        @if ($data->initiated_through_impact_closure_ooc)
                                            {{ $data->initiated_through_impact_closure_ooc }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <div class="inner-block">
                            <div class="block-head">
                                Activity Log
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Submit By:</th>
                                    <td class="w-30">
                                        @if ($data->submitted_by)
                                            {!! $data->submitted_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Submit On:</th>
                                    <td class="w-30">
                                        @if ($data->submitted_on)
                                            {{ $data->submitted_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->comment)
                                            {!! $data->comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">initial_phase_ i_investigationb completed_by:</th>
                                    <td class="w-30">
                                        @if ($data->initial_phase_i_investigation_completed_by)
                                            {!! $data->initial_phase_i_investigation_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">initial_phase_ i_investigation completed_on:</th>
                                    <td class="w-30">
                                        @if ($data->initial_phase_i_investigation_completed_on)
                                            {{ $data->initial_phase_i_investigation_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->initial_phase_i_investigation_comment)
                                            {!! $data->initial_phase_i_investigation_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Assignable Cause Found Completed By:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f_completed_by)
                                            {!! $data->assignable_cause_f_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Assignable Cause Found Completed On:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f_completed_on)
                                            {{ $data->assignable_cause_f_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f_completed_comment)
                                            {!! $data->assignable_cause_f_completed_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Correction Completed By:</th>
                                    <td class="w-30">
                                        @if ($data->correction_completed_by)
                                            {!! $data->correction_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Correction Completed On:</th>
                                    <td class="w-30">
                                        @if ($data->correction_completed_on)
                                            {{ $data->correction_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->correction_completed_comment)
                                            {!! $data->correction_completed_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Obvious Results Not Found Done By:</th>
                                    <td class="w-30">
                                        @if ($data->obvious_r_n_completed_by)
                                            {!! $data->obvious_r_n_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Obvious Results Not Found On:</th>
                                    <td class="w-30">
                                        @if ($data->obvious_r_n_completed_on)
                                            {{ $data->obvious_r_n_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->cause_i_ncompleted_comment)
                                            {!! $data->cause_i_ncompleted_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Correction Complete By:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_completed_by)
                                            {!! $data->correction_ooc_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Correction Complete On:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_completed_on)
                                            {{ $data->correction_ooc_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_comment)
                                            {!! $data->correction_ooc_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Cause Identification Done By:</th>
                                    <td class="w-30">
                                        @if ($data->cause_i_completed_by)
                                            {!! $data->cause_i_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Cause Identification Done On:</th>
                                    <td class="w-30">
                                        @if ($data->cause_i_completed_on)
                                            {{ $data->cause_i_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->cause_i_ncompleted_comment)
                                            {!! $data->cause_i_ncompleted_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Correction Complete By:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_completed_by)
                                            {!! $data->correction_ooc_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Correction Completed On:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_completed_on)
                                            {{ $data->correction_ooc_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->correction_ooc_comment)
                                            {!! $data->correction_ooc_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Assignable Cause Not Found Complete By:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f_n_completed_by)
                                            {!! $data->assignable_cause_f_n_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Assignable Cause Not Found Complete On:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f_n_completed_on)
                                            {{ $data->assignable_cause_f_n_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->assignable_cause_f__ncompleted_comment)
                                            {!! $data->assignable_cause_f__ncompleted_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Cause Failed By:</th>
                                    <td class="w-30">
                                        @if ($data->cause_f_completed_by)
                                            {!! $data->cause_f_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Cause Failed On:</th>
                                    <td class="w-30">
                                        @if ($data->cause_f_completed_on)
                                            {{ $data->cause_f_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->cause_f_completed_comment)
                                            {!! $data->cause_f_completed_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Obvious Results Found By:</th>
                                    <td class="w-30">
                                        @if ($data->obvious_r_completed_by)
                                            {!! $data->obvious_r_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Obvious Results Found On:</th>
                                    <td class="w-30">
                                        @if ($data->obvious_r_completed_on)
                                            {{ $data->obvious_r_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->obvious_r_ncompleted_comment)
                                            {!! $data->obvious_r_ncompleted_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Cause Not Identified By:</th>
                                    <td class="w-30">
                                        @if ($data->cause_n_i_completed_by)
                                            {!! $data->cause_n_i_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Cause Not Identified On:</th>
                                    <td class="w-30">
                                        @if ($data->cause_n_i_completed_on)
                                            {{ $data->cause_n_i_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->cause_n_i_completed_comment)
                                            {!! $data->cause_n_i_completed_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">QA Review Complete By:</th>
                                    <td class="w-30">
                                        @if ($data->qareview_ooc_completed_by)
                                            {!! $data->qareview_ooc_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">QA Review Complete On:</th>
                                    <td class="w-30">
                                        @if ($data->qareview_ooc_completed_on)
                                            {{ $data->qareview_ooc_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->qareview_ooc_comment)
                                            {!! $data->qareview_ooc_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Approved By:</th>
                                    <td class="w-30">
                                        @if ($data->approved_ooc_completed_by)
                                            {!! $data->approved_ooc_completed_by !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Approved On:</th>
                                    <td class="w-30">
                                        @if ($data->approved_ooc_completed_on)
                                            {{ $data->approved_ooc_completed_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Comment:</th>
                                    <td class="w-30">
                                        @if ($data->approved_ooc_comment)
                                            {!! $data->approved_ooc_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
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
