<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
            bottom: -40px;
            left: 0;
            display: block;
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

        .table_bg th {
            background: #4274da57;
        }

        .table_bg td {
            background: none;
        }

        .page-break {
            page-break-before: always;
        }

        .head-number {
            font-weight: bold;
            font-size: 13px;
            padding-left: 10px;
        }

        .div-data {
            font-size: 13px;
            padding-left: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Risk Assessment Report
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
                    <strong>Risk Assessment No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/RA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::getDivisionName($data->division_id) }}/RA/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>


                    {{-- <th class="w-20">Assigned To</th> --}}
                    {{-- <td class="w-30">@if ($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td> --}}


                    <tr>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->Initiator_Group) }}
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
                    {{-- <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80"> @if ($data->due_date) {{ \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') }} @else Not Applicable @endif</td>
                    </tr> --}}

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
                        <th class="w-20">Source Of Risk/Opportunity</th>
                        <td class="w-80">
                            @if ($data->source_of_risk)
                                {{ $data->source_of_risk }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other (Source Of Risk/Opportunity)</th>
                        <td class="w-80">
                            @if ($data->other_source_of_risk)
                                {{ $data->other_source_of_risk }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-80">
                            @if ($data->type)
                                {{ $data->type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other (Type)</th>
                        <td class="w-80">
                            @if ($data->other_type)
                                {{ $data->other_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Priority Level</th>
                        <td class="w-80">
                            @if ($data->priority_level)
                                {{ $data->priority_level }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>

                <label class="head-number" for="Purpose">Purpose</label>
                <div class="div-data">
                    @if ($data->purpose)
                        {{ $data->purpose }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="head-number" for="Scope">Scope</label>
                <div class="div-data">
                    @if ($data->scope)
                        {{ $data->scope }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="head-number" for="Reason for Revision">Reason for Revision</label>
                <div class="div-data">
                    @if ($data->reason_for_revision)
                        {{ $data->reason_for_revision }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="head-number" for="Brief Description / Procedure">Brief Description / Procedure</label>
                <div class="div-data">
                    @if ($data->Brief_description)
                        {{ $data->Brief_description }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="head-number" for="Documents Used For Risk Management">Documents Used For Risk
                    Management</label>
                <div class="div-data">
                    @if ($data->document_used_risk)
                        {{ $data->document_used_risk }}
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>

            <div class="border-table">
                <div class="block-head">
                    Initial Attachments
                </div>
                <table>
                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">File No.</th>
                    </tr>
                    @if ($data->risk_attachment)
                        @foreach (json_decode($data->risk_attachment) as $key => $file)
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
                </table>
            </div>





            {{-- <div class="block">
                <div class="block-head">
                    Risk/Opportunity details
                </div>
                <table>
                    <tr>
                        <th class="w-20">Department(s)</th>
                        <td class="w-80">@if ($data->departments2){{ ($data->departments2) }}@else Not Applicable @endif</td>
                        <th class="w-20">Source of Risk</th>
                        <td class="w-80">@if ($data->source_of_risk){{ $data->source_of_risk }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site Name</th>
                        <td class="w-30">{{ $data->site_name ?? 'Not Applicable' }}</td>

                        <th class="w-20">Building</th>
                        <td class="w-30">{{ $data->building ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Floor</th>
                        <td class="w-30">{{ $data->floor ?? 'Not Applicable' }}</td>

                        <th class="w-20">Duration</th>
                        <td class="w-30">{{ $data->duration ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Hazard</th>
                        <td class="w-30">{{ $data->hazard ?? 'Not Applicable' }}</td>

                        <th class="w-20">Room</th>
                        <td class="w-30">{{ $data->room ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Regulatory Climate</th>
                        <td class="w-30">{{ $data->regulatory_climate ?? 'Not Applicable' }}</td>

                        <th class="w-20">Number of Employees</th>
                        <td class="w-30">{{ $data->Number_of_employees ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Room</th>
                        <td class="w-30">{{ $data->room2 ?? 'Not Applicable' }}</td>

                        <th class="w-20">Risk Management Strategy</th>
                        <td class="w-30">{{ $data->risk_management_strategy ?? 'Not Applicable' }}</td>
                    </tr>

                </table>
            </div> --}}


            {{-- <div class="block">
            <div class="block-head">
                Work Group Assignment
            </div>
            <table>
                <tr>
                    <th class="w-20">Scheduled Start Date</th>
                    <td class="w-30">@if ($data->schedule_start_date1){{ $data->schedule_start_date1 }}@else Not Applicable @endif</td>
                    <th class="w-20">Scheduled End Date</th>
                    <td class="w-30">@if ($data->schedule_end_date1){{ $data->schedule_end_date1 }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-50">Estimated Man-Hours</th>
                    <td class="w-50">@if ($data->estimated_man_hours){{ $data->estimated_man_hours }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Estimated Cost</th>
                    <td class="w-30">@if ($data->estimated_cost){{ $data->estimated_cost }}@else Not Applicable @endif</td>
                    <th class="w-20">Currency</th>
                    <td class="w-30">@if ($data->currency){{ $data->currency }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Justification/Rationale</th>
                    <td class="w-80">@if ($data->justification){{ $data->justification }}@else Not Applicable @endif</td>

                </tr>
            </table>
        </div> --}}




            {{--  <div class="block">
        <div class="block-head">
                Action Plan
            </div>
            <table>
                <tr>
                    <th class="w-20">Scheduled Start Date</th>
                    <td class="w-30">@if ($data->schedule_start_date1){{ $data->schedule_start_date1 }}@else Not Applicable @endif</td>
                    <th class="w-20">Scheduled End Date</th>
                    <td class="w-30">@if ($data->schedule_end_date1){{ $data->schedule_end_date1 }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-50">Estimated Man-Hours</th>
                    <td class="w-50">@if ($data->estimated_man_hours){{ $data->estimated_man_hours }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Estimated Cost</th>
                    <td class="w-30">@if ($data->estimated_cost){{ $data->estimated_cost }}@else Not Applicable @endif</td>
                    <th class="w-20">Currency</th>
                    <td class="w-30">@if ($data->currency){{ $data->currency }}@else Not Applicable @endif</td>
                </tr>

            </table>
        </div>  --}}



            <div class="border-table">
                {{-- <div class="block-head">
                    Action Plan
                </div> --}}
                {{-- <table>
                            <thead>
                                <tr class="table_bg">
                                    <th class="w-20">Row #</th>
                                    <th class="w-20">Action</th>
                                    <th class="w-20">Responsible</th>
                                    <th class="w-20">Deadline</th>
                                    <th class="w-20">Item Static</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $measurement_1 = unserialize($action_plan->action);
                                    $measurement_2 = unserialize($action_plan->responsible);
                                    $measurement_3 = unserialize($action_plan->deadline);
                                    $measurement_4 = unserialize($action_plan->item_static);
                                    $row_number = 1;

                                    // Create a map of user IDs to user names for quick lookup
                                    $userMap = $users->pluck('name', 'id')->toArray();
                                @endphp

                                @for ($i = 0; $i < count($measurement_1); $i++)
                                    <tr>
                                        <td class="w-10">{{ $row_number++ }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_1[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">
                                            {{ $userMap[$measurement_2[$i]] ?? 'Not Applicable' }}
                                        </td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_3[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_4[$i] ?? 'Not Applicable') }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table> --}}
            </div>



            {{-- <div class="border-table">
                    <div class="block-head">
                        Work Group Attachmentss
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File No</th>
                        </tr>
                        @if ($data->reference)
                            @foreach (json_decode($data->reference) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                    </div> --}}


            <div class="block">
                <div class="block-head">Risk Assessment</div>

                <label class="head-number" for="Root Cause Methodology">Root Cause Methodology</label>
                <div class="div-data">
                    @if ($data->root_cause_methodology)
                        {{ str_replace(',', ', ', $data->root_cause_methodology) }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="head-number" for="Other (Root Cause Methodology)">Other (Root Cause Methodology)</label>
                <div class="div-data">
                    @if ($data->other_root_cause_methodology)
                        {{ $data->other_root_cause_methodology }}
                    @else
                        Not Applicable
                    @endif
                </div>

                {{-- <table>
                    <tr>
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-30">
                            @if ($data->root_cause_methodology)
                                {{ $data->root_cause_methodology }}
                            @else
                                Not Applicable
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Other (Root Cause Methodology)</th>
                        <td class="w-30">
                            @if ($data->other_root_cause_methodology)
                                {{ $data->other_root_cause_methodology }}
                            @else
                                Not Applicable
                            @endif

                        </td>
                    </tr>
                </table> --}}

                {{-- <div class="block-head"> Failure Mode And Effect Analysis </div> --}}

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

                <div class="block-head">Failure Mode And Effect Analysis</div>
                            <div class="table-responsive">
                            <table class="tableFMEA">
                                <thead>
                                    <tr class="table_bg">
                                        <th class="thFMEA" rowspan="2">Row #</th>
                                        <th class="thFMEA" colspan="2">Risk Identification</th>
                                        <th class="thFMEA" rowspan="2">Risk Analysis</th>
                                        <th class="thFMEA" colspan="3">Risk Evaluation</th>
                                        <th class="thFMEA" rowspan="2">RPN</th>
                                        <th class="thFMEA" colspan="2">Risk Control</th>
                                        <th class="thFMEA" colspan="3">Risk Evaluation</th>
                                        <th class="thFMEA" rowspan="2">Risk Level</th>
                                        <th class="thFMEA" rowspan="2">Risk Acceptance (Y/N)</th>
                                        <th class="thFMEA" rowspan="2">Traceability Document</th>
                                    </tr>
                                    <tr class="table_bg">
                                        <th class="thFMEA">Activity</th>
                                        <th class="thFMEA">Possible Risk/Failure</th>
                                        <th class="thFMEA">Severity (S)</th>
                                        <th class="thFMEA">Probability (P)</th>
                                        <th class="thFMEA">Detection (D)</th>
                                        <th class="thFMEA">Control Measures</th>
                                        <th class="thFMEA">RPN</th>
                                        <th class="thFMEA">Severity (S)</th>
                                        <th class="thFMEA">Probability (P)</th>
                                        <th class="thFMEA">Detection (D)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($riskEffectAnalysis->risk_factor))
                                        @foreach (unserialize($riskEffectAnalysis->risk_factor) as $key => $riskFactor)
                                            <tr>
                                                <td class="tdFMEA">{{ $key + 1 }}</td>
                                                <td class="tdFMEA">{{ $riskFactor }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->problem_cause)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->existing_risk_control)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_rpn)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->risk_control_measure)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_rpn)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_rpn)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->risk_acceptance)[$key] ?? null }}</td>
                                                <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->mitigation_proposal)[$key] ?? null }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="3">No data available.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>


                <!-------------------- new data -->


               {{-- <div class="border-table">
                 <table>


                    <thead>
                        <tr class="table_bg">
                            <th class="w-20">Row #</th>
                            <th class="w-20">Activity</th>
                            <th class="w-20">Possible Risk/Failure (Identified Risk)</th>
                            <th class="w-20">Consequences of Risk/Potential Causes</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Unserialize data and ensure it's an array
                            $measurement_1 = is_array(unserialize($riskEffectAnalysis->risk_factor)) ? unserialize($riskEffectAnalysis->risk_factor) : [];
                            $measurement_2 = is_array(unserialize($riskEffectAnalysis->problem_cause)) ? unserialize($riskEffectAnalysis->problem_cause) : [];
                            $measurement_3 = is_array(unserialize($riskEffectAnalysis->existing_risk_control)) ? unserialize($riskEffectAnalysis->existing_risk_control) : [];
                            $row_number = 1;
                        @endphp

                        <tbody>
                            @for ($i = 0; $i < count($measurement_1); $i++)
                                <tr>
                                    <td class="w-10">{{ $row_number++ }}</td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_1[$i] ?? 'Not Applicable') }}</td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_2[$i] ?? 'Not Applicable') }}</td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_3[$i] ?? 'Not Applicable') }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </tbody>
                </table>
               </div>

                <table>
                    <thead>
                        <tr class="table_bg">
                            <th class="w-10">Row #</th>
                            <th class="w-20">Initial Severity (S)</th>
                            <th class="w-20">Initial Probability (P)</th>
                            <th class="w-20">Initial Detectability (D)</th>
                            <th class="w-20">RPN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Unserialize data and ensure each is an array
                            $measurement_4 = is_array(unserialize($riskEffectAnalysis->initial_severity)) ? unserialize($riskEffectAnalysis->initial_severity) : [];
                            $measurement_5 = is_array(unserialize($riskEffectAnalysis->initial_detectability)) ? unserialize($riskEffectAnalysis->initial_detectability) : [];
                            $measurement_6 = is_array(unserialize($riskEffectAnalysis->initial_probability)) ? unserialize($riskEffectAnalysis->initial_probability) : [];
                            $measurement_7 = is_array(unserialize($riskEffectAnalysis->initial_rpn)) ? unserialize($riskEffectAnalysis->initial_rpn) : [];
                            $row_number = 1; // Reset row number
                        @endphp

                        @for ($i = 0; $i < count($measurement_4); $i++)
                            <tr>
                                <td class="w-10">{{ $row_number++ }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_4[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_5[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_6[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_7[$i] ?? 'Not Applicable') }}</td>
                            </tr>
                        @endfor
                    </tbody>

                </table>

                <table>
                    <thead>
                        <tr class="table_bg">
                            <th class="w-10">Row #</th>
                            <th class="w-20">Control Measures recommended/ Risk mitigation proposed</th>
                            <th class="w-20">Residual Severity (S)</th>
                            <th class="w-20">Residual Probability (P)</th>
                            <th class="w-20">Residual Detectability (D)</th>
                            <th class="w-20">Risk Level (RPN)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $measurement_8 = unserialize($riskEffectAnalysis->risk_control_measure);
                            $measurement_9 = unserialize($riskEffectAnalysis->residual_severity);
                            $measurement_10 = unserialize($riskEffectAnalysis->residual_probability);
                            $measurement_11 = unserialize($riskEffectAnalysis->residual_detectability);
                            $measurement_12 = unserialize($riskEffectAnalysis->residual_rpn);
                            $row_number = 1; // Reset row number
                        @endphp

                        @if (is_array($measurement_8))
                            @for ($i = 0; $i < count($measurement_8); $i++)
                                <tr>
                                    <td class="w-10">{{ $row_number++ }}</td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_8[$i] ?? 'Not Applicable') }}
                                    </td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_9[$i] ?? 'Not Applicable') }}
                                    </td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_10[$i] ?? 'Not Applicable') }}
                                    </td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_11[$i] ?? 'Not Applicable') }}
                                    </td>
                                    <td class="w-20">{{ htmlspecialchars($measurement_12[$i] ?? 'Not Applicable') }}
                                    </td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td colspan="6">No measurements available</td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <table>
                    <thead>
                        <tr class="table_bg">
                            <th class="w-10">Row #</th>
                            <th class="w-20">Category of Risk Level (Low, Medium, and High)</th>
                            <th class="w-20">Risk Acceptance (Y/N)</th>
                            <th class="w-20">Traceability document</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            // Unserialize data and ensure each variable is an array
                            $measurement_13 = is_array(unserialize($riskEffectAnalysis->risk_acceptance)) ? unserialize($riskEffectAnalysis->risk_acceptance) : [];
                            $measurement_14 = is_array(unserialize($riskEffectAnalysis->risk_acceptance2)) ? unserialize($riskEffectAnalysis->risk_acceptance2) : [];
                            $measurement_15 = is_array(unserialize($riskEffectAnalysis->mitigation_proposal)) ? unserialize($riskEffectAnalysis->mitigation_proposal) : [];

                            // Calculate the maximum count of all arrays
                            $max_count = max(count($measurement_13), count($measurement_14), count($measurement_15));

                            // Reset row number
                            $row_number = 1;
                        @endphp

                        @for ($i = 0; $i < $max_count; $i++)
                            <tr>
                                <td class="w-10">{{ $row_number++ }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_13[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_14[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_15[$i] ?? 'Not Applicable') }}</td>
                            </tr>
                        @endfor
                    </tbody>

                </table> --}}



                {{-- <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>
                <table>
                    <tr>
                        <th class="w-20">Measurement</th>
                        <td class="w-80">
                            @php
                            $measurement = unserialize($riskgrdfishbone->measurement);
                            @endphp

                            @if (is_array($measurement))
                            @foreach ($measurement as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($measurement))
                            {{ htmlspecialchars($measurement) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Materials</th>
                        <td class="w-80">
                            @php
                            $materials = unserialize($riskgrdfishbone->materials);
                            @endphp

                            @if (is_array($materials))
                            @foreach ($materials as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($materials))
                            {{ htmlspecialchars($materials) }}
                            @else
                            Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Methods</th>
                        <td class="w-80">
                            @php
                            $methods = unserialize($riskgrdfishbone->methods);
                            @endphp

                            @if (is_array($methods))
                            @foreach ($methods as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($methods))
                            {{ htmlspecialchars($methods) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Environment</th>
                        <td class="w-80">
                            @php
                            $environment = unserialize($riskgrdfishbone->environment);
                            @endphp

                            @if (is_array($environment))
                            @foreach ($environment as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($environment))
                            {{ htmlspecialchars($environment) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Manpower</th>
                        <td class="w-80">
                            @php
                            $manpower = unserialize($riskgrdfishbone->manpower);
                            @endphp

                            @if (is_array($manpower))
                            @foreach ($manpower as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($manpower))
                            {{ htmlspecialchars($manpower) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Machine</th>
                        <td class="w-80">
                            @php
                            $machine = unserialize($riskgrdfishbone->machine);
                            @endphp

                            @if (is_array($machine))
                            @foreach ($machine as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($machine))
                            {{ htmlspecialchars($machine) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Problem Statement1</th>
                        <td class="w-80">
                            @if ($riskgrdfishbone->problem_statement)

                            {{ $riskgrdfishbone->problem_statement }}
                            @else
                            Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> --}}

                <div class="block-head">
                    Why-Why Chart
                </div>
                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($riskgrdwhy_chart->why_problem_statement)
                                {{ $riskgrdwhy_chart->why_problem_statement }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Why 1 </th>
                        <td class="w-80">
                            @php
                                $why_1 = unserialize($riskgrdwhy_chart->why_1);
                            @endphp

                            @if (is_array($why_1))
                                @foreach ($why_1 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_1))
                                {{ htmlspecialchars($why_1) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why 2</th>
                        <td class="w-80">
                            @php
                                $why_2 = unserialize($riskgrdwhy_chart->why_2);
                            @endphp

                            @if (is_array($why_2))
                                @foreach ($why_2 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_2))
                                {{ htmlspecialchars($why_2) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Why 3</th>
                        <td class="w-80">
                            @php
                                $why_3 = unserialize($riskgrdwhy_chart->why_3);
                            @endphp

                            @if (is_array($why_3))
                                @foreach ($why_3 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_3))
                                {{ htmlspecialchars($why_3) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why 4</th>
                        <td class="w-80">
                            @php
                                $why_4 = unserialize($riskgrdwhy_chart->why_4);
                            @endphp

                            @if (is_array($why_4))
                                @foreach ($why_4 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_4))
                                {{ htmlspecialchars($why_4) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Why 5</th>
                        <td class="w-80">
                            @php
                                $why_5 = unserialize($riskgrdwhy_chart->why_5);
                            @endphp


                            @if (is_array($why_5))
                                @foreach ($why_5 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_5))
                                {{ htmlspecialchars($why_5) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">Root Cause :</th>
                        <td class="w-80">@if ($riskgrdwhy_chart->why_root_cause){{ $riskgrdwhy_chart->why_root_cause }}@else Not Applicable @endif</td>

                    </tr> --}}
                </table>



                <div class="border">
                    <table>

                        <tr>
                            <th class="w-80">Other</th>
                            <td class="w-80">
                                @if ($data->other_root_cause_methodology)
                                    {{ $data->other_root_cause_methodology }}
                                @else
                                    Not Applicable
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th class="w-20">Risk Assessment Summary</th>
                            <td class="w-80">
                                @if ($data->investigation_summary)
                                    {{ $data->investigation_summary }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th class="w-20">Risk Assessment Conclusion</th>
                            <td class="w-80">
                                @if ($data->r_a_conclussion)
                                    {{ $data->r_a_conclussion }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="border-table">
                    <div class="block-head">
                        Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File No.</th>
                        </tr>
                        @if ($data->risk_ana_attach)
                            @foreach (json_decode($data->risk_ana_attach) as $key => $file)
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
                    </table>
                </div>

            </div>


            {{-- <div class="block">
                <div class="block-head">
                    Risk Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">Severity Rate</th>
                        <td class="w-80">
                            <div>
                                @if ($data->severity_rate)
                                    @switch($data->severity_rate)
                                        @case(1)
                                            1-Insignificant
                                        @break

                                        @case(2)
                                            2-Minor
                                        @break

                                        @case(3)
                                            3-Major
                                        @break

                                        @case(4)
                                            4-Critical
                                        @break

                                        @case(5)
                                            5-Catastrophic
                                        @break

                                        @default
                                            Not Applicable
                                    @endswitch
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>

                        <th class="w-20">Occurrence</th>
                        <td class="w-80">
                            <div>
                                @if ($data->occurrence)
                                    @switch($data->occurrence)
                                        @case(1)
                                            1-Very rare
                                        @break

                                        @case(2)
                                            2-Unlikely
                                        @break

                                        @case(3)
                                            3-Possibly
                                        @break

                                        @case(4)
                                            4-Likely
                                        @break

                                        @case(5)
                                            5-Almost certain (every time)
                                        @break

                                        @default
                                            Not Applicable
                                    @endswitch
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <th class="w-20">Detection</th>
                        <td class="w-80">
                            <div>
                                @if ($data->detection)
                                    @switch($data->detection)
                                        @case(5)
                                            5-Not detectable
                                        @break

                                        @case(4)
                                            4-Unlikely to detect
                                        @break

                                        @case(3)
                                            3-Possible to detect
                                        @break

                                        @case(2)
                                            2-Likely to detect
                                        @break

                                        @case(1)
                                            1-Always detected
                                        @break

                                        @default
                                            Not Applicable
                                    @endswitch
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">RPN</th>
                        <td class="w-80">
                            <div>
                                @if ($data->rpn)
                                    {{ $data->rpn }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>

                </table>
            </div> --}}

            {{-- <div class="border">
                        <table>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments2){{ $data->comments2 }}@else Not Applicable @endif</td>
                        </tr>
                        </table>
                    </div> --}}


            <div class="block">
                {{-- <div class="block-head">HOD/Designee</div>
                <table>
                    <tr>
                        <th class="w-20">CFT Reviewer Selection</th>
                        <td class="w-80">{!! Helpers::getInitiatorName($data->reviewer_person_value) ?? 'Not Applicable' !!}</td>
                    </tr>

                </table> --}}

                <label class="head-number" for="HOD/Designee Review Comment">HOD/Designee Review Comment</label>
                <div class="div-data">
                    @if ($data->hod_des_rev_comm)
                        {{ $data->hod_des_rev_comm }}
                    @else
                        Not Applicable
                    @endif
                </div>
                <div class="border-table">
                    <div class="block-head">
                        HOD/Designee  Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File No.</th>
                        </tr>
                        @if ($data->hod_design_attach)
                            @foreach (json_decode($data->hod_design_attach) as $key => $file)
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
                    </table>
                </div>
            </div>


            <div class="block">
                <div class="block-head">
                    CFT Review
                </div>
                <div class="block-head">Production (Tablet/Capsule/Powder) </div>
                <table>
                    <tr>
                        <th class="w-20">Production Tablet/Capsule/Powder Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_Review)
                                {{ $data1->Production_Table_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Tablet/Capsule/Powder Person</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_Person)
                                {{ $data1->Production_Table_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assesment(By Production Tablet/Capsule/Powder)</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_Assessment)
                                {{ strip_tags($data1->Production_Table_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Tablet/Capsule/Powder Feedback</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_Feedback)
                                {{ strip_tags($data1->Production_Table_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Tablet/Capsule/Powder Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_By)
                                {{ $data1->Production_Table_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Production Tablet/Capsule/Powder Review Completed On</th>
                        <td class="w-80">
                            @if ($data1->Production_Table_On)
                                {{ $data1->Production_Table_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Tablet/Capsule/Powder Attechments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Production_Table_Attachment)
                                @foreach (json_decode($data1->Production_Table_Attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Production Injection</div>
                <table>
                    <tr>
                        <th class="w-20">Production Injection Review Required </th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Review)
                                {{ $data1->Production_Injection_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assesment(By Production Injection)</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Assessment)
                                {{ strip_tags($data1->Production_Injection_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Feedback(By Production Injection) </th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Feedback)
                                {{ strip_tags($data1->Production_Injection_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Completed by</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_By)
                                {{ $data1->Production_Injection_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Injection Completed on</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_On)
                                {{ $data1->Production_Injection_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Injection Attechments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Production_Injection_Attachment)
                                @foreach (json_decode($data1->Production_Injection_Attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Research & Development</div>
                <table>
                    <tr>
                        <th class="w-20">Research Development Required? </th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_Review)
                                {{ $data1->ResearchDevelopment_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Reasearch & Developmemt Person</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Research & Development)</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_assessment)
                                {{ strip_tags($data1->ResearchDevelopment_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Feedback</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_feedback)
                                {{ strip_tags($data1->ResearchDevelopment_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Completed By</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_by)
                                {{ $data1->ResearchDevelopment_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Reasearch & Development Completed On</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_on)
                                {{ $data1->ResearchDevelopment_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Reasearch & Development Attechments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->ResearchDevelopment_attachment)
                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Human Resources</div>
                <table>
                    <tr>
                        <th class="w-20">Human Resources Required?</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_review)
                                {{ $data1->Human_Resource_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Human Resources Person</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Human Resources)</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_assessment)
                                {{ strip_tags($data1->Human_Resource_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Human Resources Feedback</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_feedback)
                                {{ strip_tags($data1->Human_Resource_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Human Resources Completed By</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_by)
                                {{ $data1->Human_Resource_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Human Resources Completed On</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_on)
                                {{ $data1->Human_Resource_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Human Resources Attechments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Human_Resource_attachment)
                                @foreach (json_decode($data1->Human_Resource_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Corporate Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Corporate Quality Assurance Required?</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_Review)
                                {{ $data1->CorporateQualityAssurance_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Corporate Quality Assurance Person</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_person)
                                {{ $data1->CorporateQualityAssurance_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Corporate Quality Assurance)</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_assessment)
                                {{ strip_tags($data1->CorporateQualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Feedback</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_feedback)
                                {{ strip_tags($data1->CorporateQualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Completed By</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_by)
                                {{ $data1->CorporateQualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Corporate Quality Assurance Completed On</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_on)
                                {{ $data1->CorporateQualityAssurance_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Corporate Quality Assurance Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Stores</div>
                <table>
                    <tr>
                        <th class="w-20">Store Required?</th>
                        <td class="w-80">
                            @if ($data1->Store_Review)
                                {{ $data1->Store_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Store Person</th>
                        <td class="w-80">
                            @if ($data1->Store_person)
                                {{ $data1->Store_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Store)</th>
                        <td class="w-80">
                            @if ($data1->Store_assessment)
                                {{ strip_tags($data1->Store_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Store Feedback</th>
                        <td class="w-80">
                            @if ($data1->Store_feedback)
                                {{ strip_tags($data1->Store_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Store Completed By</th>
                        <td class="w-80">
                            @if ($data1->Store_by)
                                {{ $data1->Store_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Store Completed On</th>
                        <td class="w-80">
                            @if ($data1->Store_on)
                                {{ $data1->Store_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Store Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->store_attachment)
                                @foreach (json_decode($data1->store_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Engineering</div>
                <table>
                    <tr>
                        <th class="w-20">Engineering Required?</th>
                        <td class="w-80">
                            @if ($data1->Engineering_review)
                                {{ $data1->Engineering_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Engineering Person</th>
                        <td class="w-80">
                            @if ($data1->Engineering_person)
                                {{ $data1->Engineering_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Engineering)</th>
                        <td class="w-80">
                            @if ($data1->Engineering_assessment)
                                {{ strip_tags($data1->Engineering_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Engineering Feedback</th>
                        <td class="w-80">
                            @if ($data1->Engineering_feedback)
                                {{ strip_tags($data1->Engineering_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Engineering Completed By</th>
                        <td class="w-80">
                            @if ($data1->Engineering_by)
                                {{ $data1->Engineering_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Engineering Completed On</th>
                        <td class="w-80">
                            @if ($data1->Store_on)
                                {{ $data1->Store_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Engineering Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Engineering_attachment)
                                @foreach (json_decode($data1->Engineering_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Regulatory Affair</div>
                <table>
                    <tr>
                        <th class="w-20">Regulatory affair Required?</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_Review)
                                {{ $data1->RegulatoryAffair_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regularory Affair Person</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_person)
                                {{ $data1->RegulatoryAffair_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (Regulatory Affair)</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_assessment)
                                {{ strip_tags($data1->RegulatoryAffair_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Feedback</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_feedback)
                                {{ strip_tags($data1->RegulatoryAffair_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Completed By</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_by)
                                {{ $data1->RegulatoryAffair_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regulatory Affair Completed On</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_on)
                                {{ $data1->RegulatoryAffair_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Regularory Affair Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->RegulatoryAffair_attechment)
                                @foreach (json_decode($data1->RegulatoryAffair_attechment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Assurance Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Quality_Assurance_Review)
                                {{ $data1->Quality_Assurance_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Assurance Person</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_person)
                                {{ $data1->QualityAssurance_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Quality assurance)</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_assessment)
                                {{ strip_tags($data1->QualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Feedback</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_feedback)
                                {{ strip_tags($data1->QualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_by)
                                {{ $data1->QualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Assurance Review Completed On</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_on)
                                {{ $data1->QualityAssurance_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Assurance Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Quality_Assurance_attachment)
                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Production (Liquid/Externa Prepartion)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Liquid/Externa Preparation Required?</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_Review)
                                {{ $data1->ProductionLiquid_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid Person</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_person)
                                {{ $data1->ProductionLiquid_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Production Liquid/Externa Prepartion)</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_assessment)
                                {{ strip_tags($data1->ProductionLiquid_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid/Externa Preparation Feedback</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_feedback)
                                {{ strip_tags($data1->ProductionLiquid_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid/Externa Preparation Completed By</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_by)
                                {{ $data1->ProductionLiquid_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid/Externa Preparation Completed On</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_on)
                                {{ $data1->ProductionLiquid_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Liquid/Externa Preparation Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->ProductionLiquid_attachment)
                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Quality Control</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Control Required?</th>
                        <td class="w-80">
                            @if ($data1->Quality_review)
                                {{ $data1->Quality_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Control Person</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_Person)
                                {{ $data1->Quality_Control_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Quality Control)</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_assessment)
                                {{ strip_tags($data1->Quality_Control_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Feedback</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_feedback)
                                {{ strip_tags($data1->Quality_Control_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Completed By</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_by)
                                {{ $data1->Quality_Control_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Control Completed On</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_on)
                                {{ $data1->Quality_Control_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Control Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Quality_Control_attachment)
                                @foreach (json_decode($data1->Quality_Control_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Microbiology</div>
                <table>
                    <tr>
                        <th class="w-20">Microbiology Required?</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_Review)
                                {{ $data1->Microbiology_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Microbiology Person</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_person)
                                {{ $data1->Microbiology_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Microbiology)</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_assessment)
                                {{ strip_tags($data1->Microbiology_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Feedback</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_feedback)
                                {{ strip_tags($data1->Microbiology_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Completed By</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_by)
                                {{ $data1->Microbiology_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Microbiology Completed On</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_on)
                                {{ $data1->Microbiology_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Microbiology Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Microbiology_attachment)
                                @foreach (json_decode($data1->Microbiology_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>

                <div class="block-head">Safety</div>
                <table>
                    <tr>
                        <th class="w-20">Safety Required?</th>
                        <td class="w-80">
                            @if ($data1->Environment_Health_review)
                                {{ $data1->Environment_Health_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Sefety Person</th>
                        <td class="w-80">
                            @if ($data1->Environment_Health_Safety_person)
                                {{ $data1->Environment_Health_Safety_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment(By Safety)</th>
                        <td class="w-80">
                            @if ($data1->Health_Safety_assessment)
                                {{ strip_tags($data1->Health_Safety_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Saftey Feedback</th>
                        <td class="w-80">
                            @if ($data1->Health_Safety_feedback)
                                {{ strip_tags($data1->Health_Safety_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Saftey Completed By</th>
                        <td class="w-80">
                            @if ($data1->Environment_Health_Safety_by)
                                {{ $data1->Environment_Health_Safety_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Saftey Completed On</th>
                        <td class="w-80">
                            @if ($data1->Environment_Health_Safety_on)
                                {{ $data1->Environment_Health_Safety_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Saftey Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Environment_Health_Safety_attachment)
                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Other's 1 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Other's 1 Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Other1_review)
                                {{ $data1->Other1_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Other's 1 Person </th>
                        <td class="w-80">
                            @if ($data1->Other1_person)
                                {{ $data1->Other1_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 1 Department</th>
                        <td class="w-80">
                            @if ($data1->Other1_Department_person)
                                {{ strip_tags($data1->Other1_Department_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Other's 1) </th>
                        <td class="w-80">
                            @if ($data1->Other1_assessment)
                                {{ strip_tags($data1->Other1_review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 1 Feedback</th>
                        <td class="w-80">
                            @if ($data1->Other1_feedback)
                                {{ strip_tags($data1->Other1_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Other's 1 Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Other1_by)
                                {{ $data1->Other1_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others 1 Completed On</th>
                        <td class="w-80">
                            @if ($data1->Other1_on)
                                {{ $data1->Other1_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Other's 1 Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Other1_attachment)
                                @foreach (json_decode($data1->Other1_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Other's 2 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Other's 2 Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Other2_review)
                                {{ $data1->Other2_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Other's 2 Person </th>
                        <td class="w-80">
                            @if ($data1->Other2_person)
                                {{ $data1->Other2_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 2 Department</th>
                        <td class="w-80">
                            @if ($data1->Other2_Department_person)
                                {{ strip_tags($data1->Other2_Department_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Other's 2) </th>
                        <td class="w-80">
                            @if ($data1->Other2_Assessment)
                                {{ strip_tags($data1->Other2_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 2 Feedback</th>
                        <td class="w-80">
                            @if ($data1->Other2_feedback)
                                {{ strip_tags($data1->Other2_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Other's 2 Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Other2_by)
                                {{ $data1->Other2_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others 2 Completed On</th>
                        <td class="w-80">
                            @if ($data1->Other2_on)
                                {{ $data1->Other2_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Other's 2 Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Other2_attachment)
                                @foreach (json_decode($data1->Other2_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Other's 3 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Other's 3 Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Other3_review)
                                {{ $data1->Other3_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Other's 3 Person </th>
                        <td class="w-80">
                            @if ($data1->Other3_person)
                                {{ $data1->Other3_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 3 Department</th>
                        <td class="w-80">
                            @if ($data1->Other3_Department_person)
                                {{ strip_tags($data1->Other3_Department_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Other's 3) </th>
                        <td class="w-80">
                            @if ($data1->Other3_assessment)
                                {{ strip_tags($data1->Other3_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 3 Feedback</th>
                        <td class="w-80">
                            @if ($data1->Other3_feedback)
                                {{ strip_tags($data1->Other3_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Other's 3 Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Other3_by)
                                {{ $data1->Other3_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others 3 Completed On</th>
                        <td class="w-80">
                            @if ($data1->Other3_on)
                                {{ $data1->Other3_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Other's 3 Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Other3_attachment)
                                @foreach (json_decode($data1->Other3_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Other's 4 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Other's 4 Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Other4_review)
                                {{ $data1->Other4_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Other's 4 Person </th>
                        <td class="w-80">
                            @if ($data1->Other4_person)
                                {{ $data1->Other4_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 4 Department</th>
                        <td class="w-80">
                            @if ($data1->Other4_Department_person)
                                {{ strip_tags($data1->Other4_Department_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Other's 4) </th>
                        <td class="w-80">
                            @if ($data1->Other4_assessment)
                                {{ strip_tags($data1->Other4_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 4 Feedback</th>
                        <td class="w-80">
                            @if ($data1->Other4_feedback)
                                {{ strip_tags($data1->Other4_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Other's 4 Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Other4_by)
                                {{ $data1->Other4_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others 4 Completed On</th>
                        <td class="w-80">
                            @if ($data1->Other4_on)
                                {{ $data1->Other4_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Other's 4 Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Other4_attachment)
                                @foreach (json_decode($data1->Other4_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>


                <div class="block-head">Other's 5 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Other's 5 Review Required?</th>
                        <td class="w-80">
                            @if ($data1->Other5_review)
                                {{ $data1->Other5_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Other's 5 Person </th>
                        <td class="w-80">
                            @if ($data1->Other5_person)
                                {{ $data1->Other5_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 5 Department</th>
                        <td class="w-80">
                            @if ($data1->Other5_Department_person)
                                {{ strip_tags($data1->Other5_Department_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Other's 5) </th>
                        <td class="w-80">
                            @if ($data1->Other5_assessment)
                                {{ strip_tags($data1->Other5_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other's 5 Feedback</th>
                        <td class="w-80">
                            @if ($data1->Other5_feedback)
                                {{ strip_tags($data1->Other5_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Other's 5 Review Completed By</th>
                        <td class="w-80">
                            @if ($data1->Other5_by)
                                {{ $data1->Other5_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others 5 Completed On</th>
                        <td class="w-80">
                            @if ($data1->Other5_on)
                                {{ $data1->Other5_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Other's 5 Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File No.</th>
                            </tr>
                            @if ($data1->Other5_attachment)
                                @foreach (json_decode($data1->Other5_attachment) as $key => $file)
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
                        </table>
                    </div>
                </table>





                {{-- <div class="block-head">Other's 1 (Additional Person Review Form Departments if Required)</div>
                        <table>
                            <tr>
                                <th class="w-20">Contract Giver Review</th>
                                <td class="w-30">@if ($data1->ContractGiver_Review) {{  $data1->ContractGiver_Review }}@else Not Applicable @endif</td>
                                <th class="w-20">Contract Giver Person</th>
                                <td class="w-30">@if ($data1->ContractGiver_person){{ $data1->Environment_Health_Safety_person}}@else Not Applicable @endif</td>
                            </tr>

                            <tr>
                                <th class="w-20"> Contract Giver Assessment</th>
                                <td class="w-80">@if ($data1->ContractGiver_assessment){{ strip_tags($data1->ContractGiver_assessment)  }}@else Not Applicable @endif</td>
                            </tr>

                            <tr>
                                <th class="w-20">Contract Giver Feedback</th>
                                <td class="w-80">@if ($data1->ContractGiver_feedback){{  strip_tags($data1->ContractGiver_feedback) }}@else Not Applicable @endif</td>

                            </tr>

                            <tr>
                                <th class="w-20">Contract Giver Completed by</th>
                                <td class="w-30">@if ($data1->ContractGiver_by){{ $data1->ContractGiver_by }}@else Not Applicable @endif</td>
                                <th class="w-20">Contract Giver Completed  on</th>
                                <td class="w-30">@if ($data1->ContractGiver_on){{ $data1->ContractGiver_on}}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <div class="border-table">
                                <div class="block-head">
                                    Contract Giver Attachment
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">File No</th>
                                    </tr>
                                    @if ($data1->ContractGiver_attachment)
                                        @foreach (json_decode($data1->ContractGiver_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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
                        </table> --}}

            </div>


            <div class="block">
                <div class="block-head">QA/CQA Review</div>

                <label class="head-number" for="QA/CQA Review Comment">QA/CQA Review Comment</label>
                <div class="div-data">
                    @if ($data->qa_cqa_comments)
                        {{ $data->qa_cqa_comments }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <div class="border-table">
                    <div class="block-head">
                        QA/CQA Review Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File No.</th>
                        </tr>
                        @if ($data->qa_cqa_attachments)
                            @foreach (json_decode($data->qa_cqa_attachments) as $key => $file)
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
                    </table>
                </div>
            </div>

            <div class="block">
                <div class="block-head">QA/CQA Head Approval</div>
                <label class="head-number" for="QA/CQA Head Approval Comment">QA/CQA Head Approval Comment</label>
                <div class="div-data">
                    @if ($data->qa_cqa_head_comm)
                        {{ $data->qa_cqa_head_comm }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <div class="border-table">
                    <div class="block-head">
                        QA/CQA Head Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File No.</th>
                        </tr>
                        @if ($data->qa_cqa_head_attach)
                            @foreach (json_decode($data->qa_cqa_head_attach) as $key => $file)
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
                    </table>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-head">
                Activity Log
            </div>

            {{-- <div class="block-head">
                        Submit
                    </div>
                        <table>
                            <tr>
                                <th class="w-20">Submit By</th>
                                <td class="w-30">{{ $data->submit_by }}</td>
                                <th class="w-20">Submit On</th>
                                <td class="w-30">{{ $data->submit_on }}</td>
                                <th class="w-20">Submit Comments</th>
                                <td class="w-30">{{ $data->submit_on }}</td>
                            </tr>
                        </table>
                        <table>

                            <tr>
                                <th class="w-20">Evaluated Complete By</th>
                                <td class="w-30">{{ $data->evaluated_by }}</td>
                                <th class="w-20">Evaluated Complete On</th>
                                <td class="w-30">{{ $data->evaluated_on }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">CFT Review Complete By</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_by }}</td>
                                <th class="w-20">CFT Review Complete On</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">QA/CQA Review Complete By</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_by }}</td>
                                <th class="w-20">QA/CQA Review Complete On</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                            </tr>

                            <tr>
                                <th class="w-20">Approve  By</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_by }}</td>
                                <th class="w-20">Approve On</th>
                                <td class="w-30">{{ $data->CFT_Review_Complete_On }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">More Information Required(Risk Analysis & Work Group
                                    Assignment) By</th>
                                <td class="w-30">{{ $data->cancelled_by }}</td>
                                <th class="w-20">More Information Required(Risk Analysis & Work Group
                                    Assignment) On</th>
                                <td class="w-30">{{ $data->cancelled_on }}</td>
                            </tr>
                        </table> --}}

            <div class="block-head">
                Submit
            </div>
            <table>
                <tr>
                    <th class="w-20">Submit By</th>
                    <td class="w-30">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                    <th class="w-20">
                        Submit On</th>
                    <td class="w-30">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        Submit Comment</th>
                    <td class="w-30">@if($data->submit_comment){{ $data->submit_comment }}@else Not Applicable @endif</td>
                </tr>

            </table>
            <div class="block-head">
                HOD Review Complete
            </div>
            <table>
                <tr>
                    <th class="w-20">HOD Review Complete By</th>
                    <td class="w-30">@if($data->evaluated_by){{ $data->evaluated_by }}@else Not Applicable @endif</td>
                    <th class="w-20">HOD Review Complete On</th>
                    <td class="w-30">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        HOD Review Complete Comment</th>
                    <td class="w-30">@if($data->evaluation_complete_comment){{ $data->evaluation_complete_comment }}@else Not Applicable @endif</td>
                </tr>
            </table>
            <div class="block-head">
                CFT Review Complete
            </div>
            <table>

                <tr>
                    <th class="w-20">CFT Review Complete By</th>
                    <td class="w-30">@if($data->CFT_Review_Complete_By){{ $data->CFT_Review_Complete_By }}@else Not Applicable @endif</td>
                    <th class="w-20">
                        CFT Review Complete On</th>
                    <td class="w-30">@if($data->CFT_Review_Complete_By){{ $data->CFT_Review_Complete_By }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        CFT Review Complete Comment</th>
                    <td class="w-30">@if($data->CFT_Review_Comments){{ $data->CFT_Review_Comments }}@else Not Applicable @endif</td>
                </tr>
            </table>
            <div class="block-head">
                QA/CQA Review Complete
            </div>
            <table>

                <tr>
                    <th class="w-20">QA/CQA Review Complete By</th>
                    <td class="w-30">@if($data->QA_Initial_Review_Complete_By){{ $data->QA_Initial_Review_Complete_By }}@else Not Applicable @endif</td>
                    <th class="w-20">QA/CQA Review Complete On</th>
                    <td class="w-30">@if($data->QA_Initial_Review_Complete_on){{ $data->QA_Initial_Review_Complete_on }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        QA/CQA Review Complete Comment</th>
                    <td class="w-30">@if($data->QA_Initial_Review_Complete_On){{ $data->QA_Initial_Review_Complete_On }}@else Not Applicable @endif</td>
                </tr>
            </table>
            <div class="block-head">
                Approved
            </div>
            <table>
                <tr>
                    <th class="w-20">Approved By</th>
                    <td class="w-30">@if($data->in_approve_by){{ $data->in_approve_by }}@else Not Applicable @endif</td>
                    <th class="w-20">Approved On</th>
                    <td class="w-30">@if($data->in_approve_on){{ $data->in_approve_on }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        Approved Comment</th>
                    <td class="w-30">@if($data->in_approve_Comments){{ $data->in_approve_Comments }}@else Not Applicable @endif</td>
                </tr>
            </table>

            <div class="block-head">
                Cancel
            </div>
            <table>
                <tr>
                    <th class="w-20">Cancel By</th>
                    <td class="w-30">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                    <th class="w-20">Cancel On</th>
                    <td class="w-30">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">
                        Cancel Comment</th>
                    <td class="w-30">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                </tr>
            </table>


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
                </tr>
            </table>
        </footer>

</body>

</html>
