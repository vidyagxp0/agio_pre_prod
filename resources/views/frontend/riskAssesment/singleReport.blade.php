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
    </style>
</head>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Risk Assessment Single Report
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
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Severity Level</th>
                        <td class="w-30">@if($data->severity2_level){{ $data->severity2_level }} @else Not Applicable @endif</td>
                        <th class="w-20">State/District</th>
                        <td class="w-30">@if($data->state){{ $data->state }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->Initiator_Group){{ $data->Initiator_Group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80"> @if($data->due_date) {{ \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>

                    <tr>
                        <th class="w-20">Department(s)</th>
                        <td class="w-80">@if($data->departments){{ ($data->departments) }}@else Not Applicable @endif</td>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">@if($data->short_description){{ $data->short_description }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-80">@if($data->type){{ $data->type }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Priority Level</th>
                        <td class="w-80">@if($data->priority_level){{ $data->priority_level }}@else Not Applicable @endif</td>
                        <th class="w-20">Source of Risk/Opportunity</th>
                        <td class="w-80">@if($data->source_of_risk){{ $data->source_of_risk }}@else Not Applicable @endif</td>
                    </tr>


                </table>
            </div>


          <div class="border">
            <table>

                    <tr>
                        <th class="w-20">Risk/Opportunity Description</th>
                        <td class="w-80">@if($data->description){{ $data->description }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Purpose</th>
                        <td class="w-80">@if($data->purpose){{ $data->purpose }}@else Not Applicable @endif</td>
                    </tr>


                    <tr>
                        <th class="w-20">Scope</th>
                        <td class="w-80">@if($data->purpose){{ $data->purpose }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Reason for Revision</th>
                        <td class="w-80">@if($data->purpose){{ $data->purpose }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Brief Description / Procedure</th>
                        <td class="w-80">@if($data->purpose){{ $data->purpose }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Documents Used for Risk Management</th>
                        <td class="w-80">@if($data->purpose){{ $data->purpose }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Risk/Opportunity Comments</th>
                        <td class="w-80">@if($data->comments){{ $data->comments }}@else Not Applicable @endif</td>

                    </tr>
            </table>
          </div>

            <div class="border-table">
                    <div class="block-head">
                    Risk Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                        @if($data->risk_attachment)
                            @foreach(json_decode($data->risk_attachment) as $key => $file)
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
            </div>




            <div class="block">
                <div class="block-head">
                    Risk/Opportunity details
                </div>
                <table>
                    <tr>
                        <th class="w-20">Department(s)</th>
                        <td class="w-80">@if($data->departments2){{ ($data->departments2) }}@else Not Applicable @endif</td>
                        <th class="w-20">Source of Risk</th>
                        <td class="w-80">@if($data->source_of_risk){{ $data->source_of_risk }}@else Not Applicable @endif</td>
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
            </div>


        <div class="block">
            <div class="block-head">
                Work Group Assignment
            </div>
            <table>
                <tr>
                    <th class="w-20">Scheduled Start Date</th>
                    <td class="w-30">@if($data->schedule_start_date1){{ $data->schedule_start_date1 }}@else Not Applicable @endif</td>
                    <th class="w-20">Scheduled End Date</th>
                    <td class="w-30">@if($data->schedule_end_date1){{ $data->schedule_end_date1 }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-50">Estimated Man-Hours</th>
                    <td class="w-50">@if($data->estimated_man_hours){{ $data->estimated_man_hours }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Estimated Cost</th>
                    <td class="w-30">@if($data->estimated_cost){{ $data->estimated_cost }}@else Not Applicable @endif</td>
                    <th class="w-20">Currency</th>
                    <td class="w-30">@if($data->currency){{ $data->currency }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Justification/Rationale</th>
                    <td class="w-80">@if($data->justification){{ $data->justification }}@else Not Applicable @endif</td>

                </tr>
            </table>
        </div>




    {{--  <div class="block">
        <div class="block-head">
                Action Plan
            </div>
            <table>
                <tr>
                    <th class="w-20">Scheduled Start Date</th>
                    <td class="w-30">@if($data->schedule_start_date1){{ $data->schedule_start_date1 }}@else Not Applicable @endif</td>
                    <th class="w-20">Scheduled End Date</th>
                    <td class="w-30">@if($data->schedule_end_date1){{ $data->schedule_end_date1 }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-50">Estimated Man-Hours</th>
                    <td class="w-50">@if($data->estimated_man_hours){{ $data->estimated_man_hours }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Estimated Cost</th>
                    <td class="w-30">@if($data->estimated_cost){{ $data->estimated_cost }}@else Not Applicable @endif</td>
                    <th class="w-20">Currency</th>
                    <td class="w-30">@if($data->currency){{ $data->currency }}@else Not Applicable @endif</td>
                </tr>

            </table>
        </div>  --}}

        <div class="border">
            <table>
            <tr>
                    <th class="w-20">Justification/Rationale</th>
                    <td class="w-80">@if($data->justification){{ $data->justification }}@else Not Applicable @endif</td>

                </tr>
            </table>
        </div>




           <div class="border-table">
                <div class="block-head">
                    Action Plan
                </div>
                        <table>
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
                        </table>
                   </div>



            <div class="border-table">
                    <div class="block-head">
                        Work Group Attachments
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                        @if($data->reference)
                            @foreach(json_decode($data->reference) as $key => $file)
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




       <div class="block">
                <div class="block-head">
                    Failure Mode and Effect Analysis
                </div>
                <table>

                   <tr>
                            <th class="w-20">Root Cause Methodology</th>
                            <td class="w-80">
                                @if($data->root_cause_methodology)
                                {{ $data->root_cause_methodology}}

                                @else Not Applicable

                                @endif

                            </td>
                        </tr>
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
                            $measurement_1 = unserialize($failure_mode->risk_factor);
                            $measurement_2 = unserialize($failure_mode->problem_cause);
                            $measurement_3 = unserialize($failure_mode->existing_risk_control);
                            $row_number = 1;
                        @endphp

                        @for ($i = 0; $i < count($measurement_1); $i++)
                            <tr>
                                <td class="w-10">{{ $row_number++ }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_1[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_2[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_3[$i] ?? 'Not Applicable') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

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
                            $measurement_4 = unserialize($failure_mode->initial_severity);
                            $measurement_5 = unserialize($failure_mode->initial_probability);
                            $measurement_6 = unserialize($failure_mode->initial_detectability);
                            $measurement_7 = unserialize($failure_mode->initial_rpn);
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
                            $measurement_8 = unserialize($failure_mode->risk_control_measure);
                            $measurement_9 = unserialize($failure_mode->residual_severity);
                            $measurement_10 = unserialize($failure_mode->residual_probability);
                            $measurement_11 = unserialize($failure_mode->residual_detectability);
                            $measurement_12 = unserialize($failure_mode->residual_rpn);
                            $row_number = 1; // Reset row number
                        @endphp

                        @for ($i = 0; $i < count($measurement_8); $i++)
                            <tr>
                                <td class="w-10">{{ $row_number++ }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_8[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_9[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_10[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_11[$i] ?? 'Not Applicable') }}</td>
                                <td class="w-20">{{ htmlspecialchars($measurement_12[$i] ?? 'Not Applicable') }}</td>
                            </tr>
                        @endfor
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
                        $measurement_13 = unserialize($failure_mode->risk_acceptance);
                        $measurement_14 = unserialize($failure_mode->mitigation_proposal);
                        $measurement_15 = unserialize($failure_mode->risk_acceptance2);
                        $max_count = max(count($measurement_13), count($measurement_14), count($measurement_15));
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
            </table>

            </div>
                <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>
                <table>
                    <tr>
                        <th class="w-20">Measurement</th>
                        <td class="w-80">
                            @php
                            $measurement = unserialize($riskgrdfishbone->measurement);
                            @endphp

                            @if(is_array($measurement))
                            @foreach($measurement as $value)
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

                            @if(is_array($materials))
                            @foreach($materials as $value)
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

                            @if(is_array($methods))
                            @foreach($methods as $value)
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

                            @if(is_array($environment))
                            @foreach($environment as $value)
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

                            @if(is_array($manpower))
                            @foreach($manpower as $value)
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

                            @if(is_array($machine))
                            @foreach($machine as $value)
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
                            @if($riskgrdfishbone->problem_statement)

                            {{ $riskgrdfishbone->problem_statement }}
                            @else
                            Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>

                <div class="block-head">
                    Why-Why Chart
                </div>
                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">@if($riskgrdwhy_chart->why_problem_statement){{ $riskgrdwhy_chart->why_problem_statement }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Why 1 </th>
                        <td class="w-80">
                            @php
                            $why_1 = unserialize($riskgrdwhy_chart->why_1);
                            @endphp

                            @if(is_array($why_1))
                            @foreach($why_1 as $value)
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

                            @if(is_array($why_2))
                            @foreach($why_2 as $value)
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

                            @if(is_array($why_3))
                            @foreach($why_3 as $value)
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

                            @if(is_array($why_4))
                            @foreach($why_4 as $value)
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


                            @if(is_array($why_5))
                            @foreach($why_5 as $value)
                            {{ htmlspecialchars($value) }}
                            @endforeach
                            @elseif(is_string($why_5))
                            {{ htmlspecialchars($why_5) }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Root Cause :</th>
                        <td class="w-80">@if($riskgrdwhy_chart->why_root_cause){{ $riskgrdwhy_chart->why_root_cause }}@else Not Applicable @endif</td>

                    </tr>
                </table>

                <div class="block-head">
                    Is/Is Not Analysis
                </div>

                <table style="max-width: 700px!important; overflow: hidden;">
                    <tr>
                        <th class="w-20">What Will Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->what_will_be) {!! nl2br(e($riskgrdwhat_who_where->what_will_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Not Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->what_will_not_be) {!! nl2br(e($riskgrdwhat_who_where->what_will_not_be)) !!} @else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">What Will Rationale</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->what_rationable) {!! nl2br(e($riskgrdwhat_who_where->what_rationable)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->where_will_be) {!! nl2br(e($riskgrdwhat_who_where->where_will_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>

                        <th class="w-20">Where Will Not Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->where_will_not_be) {!! nl2br(e($riskgrdwhat_who_where->where_will_not_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Rationale</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->where_rationable) {!! nl2br(e($riskgrdwhat_who_where->where_rationable)) !!} @else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">When Will Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->when_will_be) {!! nl2br(e($riskgrdwhat_who_where->when_will_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Not Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->when_will_not_be) {!! nl2br(e($riskgrdwhat_who_where->when_will_not_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Rationale</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->when_rationable) {!! nl2br(e($riskgrdwhat_who_where->when_rationable)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Coverage Will Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->coverage_will_be) {!! nl2br(e($riskgrdwhat_who_where->coverage_will_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>

                        <th class="w-20">Coverage Will Not Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->coverage_will_not_be) {!! nl2br(e($riskgrdwhat_who_where->coverage_will_not_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Coverage Will Rationale</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->coverage_rationable) {!! nl2br(e($riskgrdwhat_who_where->coverage_rationable)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->who_will_be) {!! nl2br(e($riskgrdwhat_who_where->who_will_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Not Be</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->who_will_not_be) {!! nl2br(e($riskgrdwhat_who_where->who_will_not_be)) !!} @else Not Applicable @endif</td>
                    </tr>
                    <tr>

                        <th class="w-20">Who Will Rationale</th>
                        <td class="w-80">@if($riskgrdwhat_who_where->who_rationable) {!! nl2br(e($riskgrdwhat_who_where->who_rationable)) !!} @else Not Applicable @endif</td>
                    </tr>

                </table>


           <div class="border">
            <table>
                        <tr>
                            <th class="w-20">Root Cause Description</th>
                            <td class="w-80">@if($data->root_cause_description){{ $data->root_cause_description}}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Investigation Summary</th>
                            <td class="w-80">@if($data->investigation_summary){{ $data->investigation_summary }}@else Not Applicable @endif</td>
                        </tr>

            </table>
           </div>

          <div class="block">
                <div class="block-head">
                   Risk Analysis
                </div>
                    <table>
                        <tr>
                            <th class="w-20">Severity Rate</th>
                            <td class="w-80">
                                <div>
                                    @if($data->severity_rate)
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
                                    @if($data->occurrence)
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
                                    @if($data->detection)
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
                                    @if($data->rpn)
                                    {{ $data->rpn }}
                                    @else
                                    Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Risk Level</th>
                            <td class="w-80">@if($data->risk_level){{ $data->risk_level }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>


            <div class="block">

                    <div class="block-head">
                        Residual Risk
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Residual Risk</th>
                            <td class="w-30">@if($data->residual_risk){{ $data->residual_risk }}@else Not Applicable @endif</td>
                            <th class="w-20">Residual Risk Impact</th>
                            <td class="w-30">
                                @if($data->residual_risk_impact)

                                @switch($data->residual_risk_impact)
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
                                @case(6)
                                None
                                @break
                                @default
                                Not Applicable
                                @endswitch
                                @else
                                Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Residual Risk Probability</th>
                            <td class="w-30">
                                @if($data->residual_risk_probability)
                                @switch($data->residual_risk_probability)
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
                            </td>
                            <th class="w-20">Residual Detection</th>
                            <td class="w-30">
                                @if ($data->detection2)
                                @switch($data->detection2)
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
                            </td>

                        </tr>
                        <tr>
                            <th class="w-20">Residual RPN</th>
                            <td class="w-30">@if($data->rpn2){{ $data->rpn2 }}@else Not Applicable @endif</td>

                            <th class="w-20">Residual Risk Level</th>
                            <td class="w-30">@if($data->risk_level_2){{ $data->risk_level_2 }}@else Not Applicable @endif</td>
                        </tr>
                    </table>

            </div>

        <div class="border">
            <table>
            <tr>
                <th class="w-20">Comments</th>
                <td class="w-80">@if($data->comments2){{ $data->comments2 }}@else Not Applicable @endif</td>
              </tr>
            </table>
        </div>

        <div class="border-table">
    <div class="block-head">
   Mitigation Plan Details
    </div>
    <table>
        <thead>
            <tr class="table_bg">
                <th class="w-10">Row #</th>
                <th class="w-18">Mitigation Steps</th>
                  <th class="w-18">Deadline</th>
                <th class="w-18">Responsible Person</th>
                <th class="w-18">Status</th>
                <th class="w-18">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @php
                $measurement_1 = unserialize($mitigation->mitigation_steps);
                $measurement_2 = unserialize($mitigation->deadline2);
                $measurement_3 = unserialize($mitigation->responsible_person);
                $measurement_4 = unserialize($mitigation->status);
                 $measurement_5 = unserialize($mitigation->remark);
                $row_number = 1;

                // Create a map of user IDs to user names for quick lookup
                $userMap = $users->pluck('name', 'id')->toArray();
            @endphp

            @for ($i = 0; $i < count($measurement_1); $i++)
                <tr>
                    <td class="w-10">{{ $row_number++ }}</td>
                    <td class="w-20">{{ htmlspecialchars($measurement_1[$i] ?? 'Not Applicable') }}</td>
                     <td class="w-20">{{ htmlspecialchars($measurement_2[$i] ?? 'Not Applicable') }}</td>
                    <td class="w-20">
                        {{ $userMap[$measurement_3[$i]] ?? 'Not Applicable' }}
                    </td>
                    <td class="w-20">{{ htmlspecialchars($measurement_4[$i] ?? 'Not Applicable') }}</td>
                    <td class="w-20">{{ htmlspecialchars($measurement_5[$i] ?? 'Not Applicable') }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Risk Mitigation
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Mitigation Required</th>
                            <td class="w-30">@if($data->mitigation_required){{ $data->mitigation_required }}@else Not Applicable @endif</td>
                            </tr>
                        <tr>

                           <th class="w-20">Scheduled End Date</th>
                            <td class="w-30">@if($data->mitigation_due_date){{ $data->mitigation_due_date }}@else Not Applicable @endif</td>

                            <th class="w-20">Status of Mitigation</th>
                            <td class="w-30">@if($data->mitigation_status){{ $data->mitigation_status }}@else Not Applicable @endif</td>
                        </tr>

                    </table>
            <div class="border">
                <table>
                        <tr>
                            <th class="w-20">Mitigation Plan</th>
                            <td class="w-80">@if($data->mitigation_plan){{ $data->mitigation_plan}}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                        <th class="w-20">Mitigation Status Comments</th>
                            <td class="w-80">@if($data->mitigation_status_comments){{ $data->mitigation_status_comments}}@else Not Applicable @endif</td>

                        </tr>
                </table>
            </div>

            <div class="block">
                <div class="head">
                    <div class="block-head">
                    Overall Assessment
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Impact</th>
                            <td class="w-30">@if($data->impact){{ $data->impact }}@else Not Applicable @endif</td>
                            <th class="w-20">Criticality</th>
                            <td class="w-30">@if($data->criticality){{ $data->criticality}}@else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Reference Record</th>
                            <td class="w-30">@if($data->refrence_record){{ Helpers::getDivisionName($data->refrence_record) }}/RA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif</td>
                         </tr>
                    </table>


            <div class="border">
                <table>
                        <tr>
                            <th class="w-20">Impact Analysis</th>
                            <td class="w-80">@if($data->impact_analysis){{ $data->impact_analysis }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>

                            <th class="w-20">Risk Analysis</th>
                            <td class="w-80">@if($data->risk_analysis){{ $data->risk_analysis}}@else Not Applicable @endif</td>
                        </tr>
                </table>
            </div>

            <div class="border">
                        <div class="block-head">
                        Extension Justification
                        </div>
                     <table>
                        <tr>
                        <th class="w-20">Due Date Extension Justification</th>
                            <td class="w-80">@if($data->due_date_extension){{ $data->due_date_extension}}@else Not Applicable @endif</td>

                        </tr>
                     </table>

            </div>

            <div class="block">
                <div class="block-head"> CFT</div>
                <div class="block-head">Production (Table/Capsule/Powder)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Review Required</th>
                        <td class="w-30">@if($data->impact){{ $data->Production_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Person</th>
                        <td class="w-30">@if($data->criticality){{ $data->Production_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Assesment</th>
                        <td class="w-30">@if($data->impact){{ $data->Production_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Feedback</th>
                        <td class="w-30">@if($data->criticality){{ $data->Production_feedback}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Assesment</th>
                        <td class="w-30">@if($data->impact){{ $data->Production_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Feedback</th>
                        <td class="w-30">@if($data->criticality){{ $data->Production_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Production Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->production_attachment) as $key => $file)
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
                    <tr>
                        <th class="w-20">Production by</th>
                        <td class="w-30">@if($data->impact){{ $data->Production_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Production on</th>
                        <td class="w-30">@if($data->criticality){{ $data->production_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Production Injection</div>
                <table>
                    <tr>
                        <th class="w-20">Production Injection Review</th>
                        <td class="w-30">@if($data->Production_Injection_Review){{ $data->Production_Injection_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-30">@if($data->Production_Injection_Person){{ $data->Production_Injection_Person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Injection Assesment</th>
                        <td class="w-30">@if($data->Production_Injection_Assessment){{ $data->Production_Injection_Assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-30">@if($data->Production_Injection_Assessment){{ $data->Production_Injection_Assessment}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Production Injection Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Production_Injection_Attachment) as $key => $file)
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
                    <tr>
                        <th class="w-20">Production Injection by</th>
                        <td class="w-30">@if($data->Production_Injection_By){{ $data->Production_Injection_By}}@else Not Applicable @endif</td>
                        <th class="w-20">Production Injection on</th>
                        <td class="w-30">@if($data->Production_Injection_On){{ $data->Production_Injection_On}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Quality Control</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Review</th>
                        <td class="w-30">@if($data->Quality_review){{ $data->Quality_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Control Person</th>
                        <td class="w-30">@if($data->Quality_Control_Person){{ $data->Quality_Control_Person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Quality Control Assesment</th>
                        <td class="w-30">@if($data->Quality_Control_assessment){{ $data->Quality_Control_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Control Feedback</th>
                        <td class="w-30">@if($data->Quality_Control_feedback){{ $data->Quality_Control_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Quality Control Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Quality_Control_attachment) as $key => $file)
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
                    <tr>
                        <th class="w-20">Quality Control By</th>
                        <td class="w-30">@if($data->Quality_Control_by){{ $data->Quality_Control_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Control  on</th>
                        <td class="w-30">@if($data->Quality_Control_on){{ $data->Quality_Control_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Quality Assurance </div>
                <table>
                    <tr>
                        <th class="w-20">Quality Assurance</th>
                        <td class="w-30">@if($data->Quality_Assurance_Review){{ $data->Quality_Assurance_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality AssurancePerson</th>
                        <td class="w-30">@if($data->QualityAssurance_person){{ $data->QualityAssurance_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Quality Assurance Assesment</th>
                        <td class="w-30">@if($data->QualityAssurance_assessment){{ $data->QualityAssurance_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Assurance Feedback</th>
                        <td class="w-30">@if($data->QualityAssurance_feedback){{ $data->QualityAssurance_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Quality Assurance Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Quality_Assurance_attachment) as $key => $file)
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
                    <tr>
                        <th class="w-20">Quality Control By</th>
                        <td class="w-30">@if($data->QualityAssurance_by){{ $data->QualityAssurance_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Assurance on</th>
                        <td class="w-30">@if($data->QualityAssurance_on){{ $data->QualityAssurance_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Engineering </div>
                <table>
                    <tr>
                        <th class="w-20">Engineering Review</th>
                        <td class="w-30">@if($data->Engineering_review){{ $data->Engineering_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Engineering Person</th>
                        <td class="w-30">@if($data->Engineering_person){{ $data->Engineering_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Engineering Person</th>
                        <td class="w-30">@if($data->Engineering_assessment){{ $data->Engineering_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Engineering Feedback</th>
                        <td class="w-30">@if($data->Engineering_feedback){{ $data->Engineering_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Engineering Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Engineering_attachment) as $key => $file)
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
                    <tr>
                        <th class="w-20">Engineering By</th>
                        <td class="w-30">@if($data->Engineering_by){{ $data->Engineering_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Engineering on</th>
                        <td class="w-30">@if($data->Engineering_on){{ $data->Engineering_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Analytical Development Laboratory </div>
                <table>
                    <tr>
                        <th class="w-20">Analytical Development Review</th>
                        <td class="w-30">@if($data->Analytical_Development_review){{ $data->Analytical_Development_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Analytical Development Person</th>
                        <td class="w-30">@if($data->Analytical_Development_person){{ $data->Analytical_Development_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Analytical Development Assesment</th>
                        <td class="w-30">@if($data->Analytical_Development_assessment){{ $data->Analytical_Development_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Analytical Development Feedback</th>
                        <td class="w-30">@if($data->Analytical_Development_feedback){{ $data->Analytical_Development_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Analytical Development Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Analytical_Development_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Analytical Development By</th>
                        <td class="w-30">@if($data->Analytical_Development_by){{ $data->Analytical_Development_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Analytical Development On</th>
                        <td class="w-30">@if($data->Analytical_Development_on){{ $data->Analytical_Development_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>



            <div class="block">
                <div class="block-head">Technology Transfer / Design </div>
                <table>
                    <tr>
                        <th class="w-20">Technology Transfer Review</th>
                        <td class="w-30">@if($data->Technology_transfer_review){{ $data->Technology_transfer_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Technology Transfer Person</th>
                        <td class="w-30">@if($data->Technology_transfer_person){{ $data->Technology_transfer_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Technology Transfer Assesment</th>
                        <td class="w-30">@if($data->Technology_transfer_assessment){{ $data->Technology_transfer_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Analytical Transfer Feedback</th>
                        <td class="w-30">@if($data->Technology_transfer_feedback){{ $data->Technology_transfer_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Technology Transfer Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Technology_transfer_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Technology Transfer By</th>
                        <td class="w-30">@if($data->Technology_transfer_by){{ $data->Technology_transfer_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Technology Development On</th>
                        <td class="w-30">@if($data->Technology_transfer_on){{ $data->Technology_transfer_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>


            <div class="block">
                <div class="block-head">Saftey</div>
                <table>
                    <tr>
                        <th class="w-20">Environment Health Review</th>
                        <td class="w-30">@if($data->Environment_Health_review){{ $data->Environment_Health_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Environment Health Safety Person</th>
                        <td class="w-30">@if($data->Environment_Health_Safety_person){{ $data->Environment_Health_Safety_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Safety Assesment</th>
                        <td class="w-30">@if($data->Health_Safety_assessment){{ $data->Health_Safety_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Safety Feedback</th>
                        <td class="w-30">@if($data->Health_Safety_feedback){{ $data->Health_Safety_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Saftey Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Environment_Health_Safety_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Saftey By</th>
                        <td class="w-30">@if($data->Environment_Health_Safety_by){{ $data->Environment_Health_Safety_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Saftey On</th>
                        <td class="w-30">@if($data->Environment_Health_Safety_on){{ $data->Environment_Health_Safety_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Human Resource</div>
                <table>
                    <tr>
                        <th class="w-20">Human Resource Review</th>
                        <td class="w-30">@if($data->Human_Resource_review){{ $data->Human_Resource_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Human Resource Person</th>
                        <td class="w-30">@if($data->Human_Resource_person){{ $data->Human_Resource_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20"> Human Resource Assesment</th>
                        <td class="w-30">@if($data->Human_Resource_assessment){{ $data->Human_Resource_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Human Resource  Feedback</th>
                        <td class="w-30">@if($data->Human_Resource_feedback){{ $data->Human_Resource_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Human Resource Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Human_Resource_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Human Resource  By</th>
                        <td class="w-30">@if($data->Human_Resource_by){{ $data->Human_Resource_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Human Resource  On</th>
                        <td class="w-30">@if($data->Human_Resource_on){{ $data->Human_Resource_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Information Technology</div>
                <table>
                    <tr>
                        <th class="w-20">Information Technology Review</th>
                        <td class="w-30">@if($data->Information_Technology_review){{ $data->Information_Technology_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Information Technlogy Person</th>
                        <td class="w-30">@if($data->Information_Technology_person){{ $data->Information_Technology_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20"> Information Technology Assesment</th>
                        <td class="w-30">@if($data->Information_Technology_assessment){{ $data->Information_Technology_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Information Technology Feedback</th>
                        <td class="w-30">@if($data->Information_Technology_feedback){{ $data->Information_Technology_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Information Technology Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Information_Technology_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Information Technology By</th>
                        <td class="w-30">@if($data->Information_Technology_by){{ $data->Information_Technology_by }}@else Not Applicable @endif</td>
                        <th class="w-20"> Information Technology On</th>
                        <td class="w-30">@if($data->Information_Technology_on){{ $data->Information_Technology_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Information Technology</div>
                <table>
                    <tr>
                        <th class="w-20">Project Managment Review</th>
                        <td class="w-30">@if($data->Project_management_review){{ $data->Project_management_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Project Managment Person</th>
                        <td class="w-30">@if($data->Project_management_person){{ $data->Project_management_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Project Managment Assesment</th>
                        <td class="w-30">@if($data->Project_management_assessment){{ $data->Project_management_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Project Managment Feedback</th>
                        <td class="w-30">@if($data->Project_management_feedback){{ $data->Project_management_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            Project Managment Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Project_management_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Project Managment By</th>
                        <td class="w-30">@if($data->Project_management_by){{ $data->Project_management_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Project Managment On</th>
                        <td class="w-30">@if($data->Project_management_on){{ $data->Project_management_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">RA Review</div>
                <table>
                    <tr>
                        <th class="w-20">R A Review</th>
                        <td class="w-30">@if($data->RA_Review){{ $data->RA_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">R A Person</th>
                        <td class="w-30">@if($data->RA_person){{ $data->RA_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">R A  Assesment</th>
                        <td class="w-30">@if($data->RA_assessment){{ $data->RA_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">R A  Feedback</th>
                        <td class="w-30">@if($data->RA_feedback){{ $data->RA_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     <div class="border-table">
                        <div class="block-head">
                            R A  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->RA_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">R A  By</th>
                        <td class="w-30">@if($data->RA_by){{ $data->RA_by }}@else Not Applicable @endif</td>
                        <th class="w-20">R A On</th>
                        <td class="w-30">@if($data->RA_on){{ $data->RA_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Stores</div>
                <table>
                    <tr>
                        <th class="w-20">Store Review</th>
                        <td class="w-30">@if($data->Store_Review){{ $data->Store_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Store Person</th>
                        <td class="w-30">@if($data->Store_person){{ $data->Store_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Store Assesment</th>
                        <td class="w-30">@if($data->Store_assessment){{ $data->Store_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">Store Feedback</th>
                        <td class="w-30">@if($data->Store_feedback){{ $data->Store_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     {{-- <div class="border-table">
                        <div class="block-head">
                            R A  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->RA_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Store  By</th>
                        <td class="w-30">@if($data->Store_by){{ $data->Store_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Store On</th>
                        <td class="w-30">@if($data->Store_on){{ $data->Store_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Regulatory Affairs</div>
                <table>
                    <tr>
                        <th class="w-20">Regulatory affair Review</th>
                        <td class="w-30">@if($data->RegulatoryAffair_Review){{ $data->RegulatoryAffair_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Regulatory Affair Person</th>
                        <td class="w-30">@if($data->RegulatoryAffair_person){{ $data->RegulatoryAffair_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Regulatory Affair Assesment</th>
                        <td class="w-30">@if($data->RegulatoryAffair_assessment){{ $data->RegulatoryAffair_assessment }}@else Not Applicable @endif</td>
                        <th class="w-20">regulatory Affair Feedback</th>
                        <td class="w-30">@if($data->RegulatoryAffair_feedback){{ $data->RegulatoryAffair_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     {{-- <div class="border-table">
                        <div class="block-head">
                            R A  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->RA_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Regulatory Affair By</th>
                        <td class="w-30">@if($data->RegulatoryAffair_by){{ $data->RegulatoryAffair_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Regulatory Affair On</th>
                        <td class="w-30">@if($data->RegulatoryAffair_on){{ $data->RegulatoryAffair_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Microbiology Review</div>
                <table>
                    <tr>
                        <th class="w-20">Microbiology  Review</th>
                        <td class="w-30">@if($data->Microbiology_Review){{ $data->Microbiology_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Regulatory Affair Person</th>
                        <td class="w-30">@if($data->Microbiology_person){{ $data->Microbiology_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Microbilogy Assesment</th>
                        <td class="w-30">@if($data->Microbiology_assessment){{ $data->Microbiology_assessment}}@else Not Applicable @endif</td>
                        <th class="w-20">Microbiology Feedback</th>
                        <td class="w-30">@if($data->Microbiology_feedback){{ $data->Microbiology_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     {{-- <div class="border-table">
                        <div class="block-head">
                            R A  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->RA_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Microbiology By</th>
                        <td class="w-30">@if($data->Microbiology_by){{ $data->Microbiology_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Microbiology On</th>
                        <td class="w-30">@if($data->Microbiology_on){{ $data->Microbiology_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Contract/Give/Others</div>
                <table>
                    <tr>
                        <th class="w-20">Contract Review</th>
                        <td class="w-30">@if($data->ContractGiver_Review){{ $data->ContractGiver_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Contact Person</th>
                        <td class="w-30">@if($data->ContractGiver_person){{ $data->ContractGiver_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Contract Assesment</th>
                        <td class="w-30">@if($data->ContractGiver_assessment){{ $data->ContractGiver_assessment}}@else Not Applicable @endif</td>
                        <th class="w-20">Contract Feedback</th>
                        <td class="w-30">@if($data->ContractGiver_feedback){{ $data->ContractGiver_feedback}}@else Not Applicable @endif</td>
                    </tr>

                     {{-- <div class="border-table">
                        <div class="block-head">
                            R A  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->RA_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Microbiology By</th>
                        <td class="w-30">@if($data->ContractGiver_by){{ $data->ContractGiver_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Microbiology On</th>
                        <td class="w-30">@if($data->ContractGiver_on){{ $data->ContractGiver_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">Other's 1 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Others 1 Review</th>
                        <td class="w-30">@if($data->Other1_review){{ $data->Other1_review }}@else Not Applicable @endif</td>
                        <th class="w-20"> Others 1 Person</th>
                        <td class="w-30">@if($data->Other1_person){{ $data->Other1_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others 1 Department Person</th>
                        <td class="w-30">@if($data->Other1_Department_person){{ $data->Other1_Department_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others 1  Assesment</th>
                        <td class="w-30">@if($data->Other1_assessment){{ $data->Other1_assessment}}@else Not Applicable @endif</td>


                        <th class="w-20">Others 1  feedback</th>
                        <td class="w-30">@if($data->Other1_feedback){{ $data->Other1_feedback}}@else Not Applicable @endif</td>
                    </tr>

                      <div class="border-table">
                        <div class="block-head">
                            Others 1 Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Other1_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Others 1  By</th>
                        <td class="w-30">@if($data->Other1_by){{ $data->Other1_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Others 1  On</th>
                        <td class="w-30">@if($data->Other1_on){{ $data->Other1_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head"> Other's 2 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Others 2 Review</th>
                        <td class="w-30">@if($data->Other2_review){{ $data->Other2_review }}@else Not Applicable @endif</td>
                        <th class="w-20"> Others 2 Person</th>
                        <td class="w-30">@if($data->Other2_person){{ $data->Other2_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others 2 Department Person</th>
                        <td class="w-30">@if($data->Other2_Department_person){{ $data->Other2_Department_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others 2  Assesment</th>
                        <td class="w-30">@if($data->Other2_Assessment){{ $data->Other2_Assessment}}@else Not Applicable @endif</td>


                        <th class="w-20">Others 2 feedback</th>
                        <td class="w-30">@if($data->Other2_feedback){{ $data->Other2_feedback}}@else Not Applicable @endif</td>
                    </tr>

                      <div class="border-table">
                        <div class="block-head">
                            Others 2 Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Other2_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Others 2  By</th>
                        <td class="w-30">@if($data->Other1_by){{ $data->Other2_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Others 2  On</th>
                        <td class="w-30">@if($data->Other2_on){{ $data->Other2_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>


            <div class="block">
                <div class="block-head"> Other's 3 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Others 2 Review</th>
                        <td class="w-30">@if($data->Other3_review){{ $data->Other3_review }}@else Not Applicable @endif</td>
                        <th class="w-20"> Others 3 Person</th>
                        <td class="w-30">@if($data->Other3_person){{ $data->Other3_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others 3 Department Person</th>
                        <td class="w-30">@if($data->Other3_Department_person){{ $data->Other3_Department_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others 3 Assesment</th>
                        <td class="w-30">@if($data->Other3_Assessment){{ $data->Other3_Assessment}}@else Not Applicable @endif</td>


                        <th class="w-20">Others 3 feedback</th>
                        <td class="w-30">@if($data->Other3_feedback){{ $data->Other3_feedback}}@else Not Applicable @endif</td>
                    </tr>

                      <div class="border-table">
                        <div class="block-head">
                            Others 3 Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Other3_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Others 3 By</th>
                        <td class="w-30">@if($data->Other3_by){{ $data->Other2_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Others 3 On</th>
                        <td class="w-30">@if($data->Other3_on){{ $data->Other2_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head"> Other's 4 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Others 4 Review</th>
                        <td class="w-30">@if($data->Other4_review){{ $data->Other4_review }}@else Not Applicable @endif</td>
                        <th class="w-20"> Others 4 Person</th>
                        <td class="w-30">@if($data->Other4_person){{ $data->Other4_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others 4 Department Person</th>
                        <td class="w-30">@if($data->Other4_Department_person){{ $data->Other4_Department_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others 4 Assesment</th>
                        <td class="w-30">@if($data->Other4_Assessment){{ $data->Other4_Assessment}}@else Not Applicable @endif</td>


                        <th class="w-20">Others 4 feedback</th>
                        <td class="w-30">@if($data->Other4_feedback){{ $data->Other4_feedback}}@else Not Applicable @endif</td>
                    </tr>

                      <div class="border-table">
                        <div class="block-head">
                            Others 4 Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Other4_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Others 4 By</th>
                        <td class="w-30">@if($data->Other4_by){{ $data->Other4_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Others 4 On</th>
                        <td class="w-30">@if($data->Other4_on){{ $data->Other4_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head"> Other's 4 ( Additional Person Review From Departments If Required)</div>
                <table>
                    <tr>
                        <th class="w-20">Others 5 Review</th>
                        <td class="w-30">@if($data->Other5_review){{ $data->Other5_review }}@else Not Applicable @endif</td>
                        <th class="w-20"> Others 5 Person</th>
                        <td class="w-30">@if($data->Other5_person){{ $data->Other5_person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others 5 Department Person</th>
                        <td class="w-30">@if($data->Other5_Department_person){{ $data->Other5_Department_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others 5 Assesment</th>
                        <td class="w-30">@if($data->Other5_Assessment){{ $data->Other5_Assessment}}@else Not Applicable @endif</td>


                        <th class="w-20">Others 5 feedback</th>
                        <td class="w-30">@if($data->Other5_feedback){{ $data->Other5_feedback}}@else Not Applicable @endif</td>
                    </tr>

                      <div class="border-table">
                        <div class="block-head">
                            Others 5 Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data->reference)
                                @foreach(json_decode($data->Other5_attachment) as $key => $file)
                                    <tr>_
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
                    <tr>
                        <th class="w-20">Others 5 By</th>
                        <td class="w-30">@if($data->Other5_by){{ $data->Other5_by}}@else Not Applicable @endif</td>
                        <th class="w-20">Others 5 On</th>
                        <td class="w-30">@if($data->Other5_on){{ $data->Other5_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

         <div class="block">
            <div class="block-head"> Activity Log </div>
    <table>
        <tr>
            <th class="w-20">Submitted By</th>
            <td class="w-30">{{ $data->submitted_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Submitted On</th>
            <td class="w-30">{{ $data->submitted_on ? Helpers::getdateFormat($data->submitted_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Cancelled By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Cancelled On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Evaluated Complete By</th>
            <td class="w-30">{{ $data->evaluated_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Evaluated Complete On</th>
            <td class="w-30">{{ $data->evaluated_on ? Helpers::getdateFormat($data->evaluated_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">More Information Required(Risk Analysis & Work Group Assignment) By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">More Information Required(Risk Analysis & Work Group Assignment) On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Risk Processing & Action Plan Complete By</th>
            <td class="w-30">{{ $data->evaluated_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Risk Processing & Action Plan Complete On</th>
            <td class="w-30">{{ $data->evaluated_on ? Helpers::getdateFormat($data->evaluated_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Risk Processing & Action Plan (Request More Info) By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Risk Processing & Action Plan (Request more info) On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Pending HOD Approval(Action Plan Approved) By</th>
            <td class="w-30">{{ $data->plan_approved_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Pending HOD Approval(Action Plan Approved) On</th>
            <td class="w-30">{{ $data->plan_approved_on ? Helpers::getdateFormat($data->plan_approved_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Pending HOD Approval(Reject Action Plan) By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Pending HOD Approval(Reject Action Plan) On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Actions Items in Progress(All Action Completed) By</th>
            <td class="w-30">{{ $data->plan_approved_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Actions Items in Progress(All Action Completed) On</th>
            <td class="w-30">{{ $data->plan_approved_on ? Helpers::getdateFormat($data->plan_approved_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Actions Items in Progress(Request More Info) By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Actions Items in Progress(Request More Info) On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Residual Risk Evaluation Completed By</th>
            <td class="w-30">{{ $data->risk_analysis_completed_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Residual Risk Evaluation Completed On</th>
            <td class="w-30">{{ $data->risk_analysis_completed_on ? Helpers::getdateFormat($data->risk_analysis_completed_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Residual Risk Evaluation(More Action Needed) By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Residual Risk Evaluation(More Action Needed) On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
        </tr>

        <tr>
            <th class="w-20">Cancelled By</th>
            <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
            <th class="w-20">Cancelled On</th>
            <td class="w-30">{{ $data->cancelled_on ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</td>
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
            </tr>
        </table>
    </footer>

</body>

</html>
