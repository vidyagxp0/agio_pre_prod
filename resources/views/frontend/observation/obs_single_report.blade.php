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
                    Observations Single Report
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
                    <strong>Observation No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::getDivisionName(session()->get('division')) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                            {{ Helpers::getDivisionName(session()->get('division')) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if (Helpers::getDivisionName(session()->get('division')))
                                {{ Helpers::getDivisionName(session()->get('division')) }}
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
                        @php
                            $users = DB::table('users')->select('id', 'name')->get();
                            $matched = false;
                        @endphp
                        <th class="w-20">Assigned To</th>
                        @foreach ($users as $value)
                            @if ($data->assign_to == $value->id)
                                <td>{{ $value->name }}</td>
                                @php $matched = true; @endphp
                            @break
                        @endif
                    @endforeach

                    @if (!$matched)
                        <td>Not Applicable</td>
                    @endif

                    <th class="w-20"> Due Date</th>
                    <td class="w-80">{{ Helpers::getdateFormat($data->due_date)}}</td>

                </tr>
                <tr>
                    <th class="w-20">Short Description</th>
                    <td class="w-80">{{ $data->short_description }}</td>

                    <th class="w-20">Attached Files</th>
                    <td class="w-80">{{ str_replace(',', ', ', $data->attach_files_gi) }}</td>

                </tr>
                <tr>
                    <th class="w-20">Recomendation Due Date for CAPA</th>
                    <td class="w-80">
                        @if ($data->recomendation_capa_date_due)
                            {{ $data->recomendation_capa_date_due }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    {{-- <th class="w-20">Non Compliance</th>
                    <td class="w-80">{{ $data->non_compliance }}</td> --}}

                </tr>
                </table>

                <h5>Non Compliance</h5>
                <div style="font-size: 12px;">
                    {{ $data->non_compliance }}
                </div>

                <h5>Recommended Action</h5>
                <div style="font-size: 12px;">
                    {{ str_replace(',', ', ', $data->recommend_action) }}
                </div>

                    {{-- <th class="w-20">Recommended Action</th>
                    <td class="w-30">
                        @if ($data->recommend_action)
                            {!! $data->recommend_action !!}
                        @else
                            Not Applicable
                        @endif
                    </td> --}}


                <table>
                    <tr>
                    <th class="w-20">Related Obsevations</th>
                    <td class="w-80">
                        @if ($data->related_observations)
                            {{ $data->related_observations }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>
            </table>

            {{-- <div class="block"> --}}
            {{-- <div class="block-head"> --}}
            {{-- </div> --}}

        </div>



        <div class="block">
            <div class="block-head">
                CAPA Plan
            </div>
            <table>
                <tr>
                    <th class="w-20">Date Response Due</th>
                    <td class="w-80">
                        @if ($data->date_Response_due2)
                            {!! $data->date_Response_due2 !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Due Date</th>
                    <td class="w-80">
                        @if ($data->capa_date_due)
                            {!! $data->capa_date_due !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Assigned To</th>
                    @foreach ($users as $value)
                        @if ($data->assign_to2 == $value->id)
                            <td>{{ $value->name }}</td>
                            @php $matched = true; @endphp
                        @break
                    @endif
                @endforeach
                @if (!$matched)
                    <td>Not Applicable</td>
                @endif
                {{-- <th class="w-20">Commnets
                </th>
                <td class="w-80">
                    @if ($data->comments)
                        {!! $data->comments !!}
                    @else
                        Not Applicable
                    @endif
                </td> --}}
            </tr>
        </table>

        <h5>Commnets</h5>
        <div style="font-size: 12px;">
            {{ $data->comments }}
        </div>

    </div>

    <div style="font-weight: 200">Action Plan</div>
    <div class="border-table">
        <table>
            <tr class="table_bg">
                <th class="w-20" style="width: 25px;">S.No.</th>
                <th class="w-20">Action</th>
                <th class="w-20">Responsible</th>
                <th class="w-20">Deadline</th>
                <th class="w-20">Item Status</th>
            </tr>
            {{-- @if ($grid_Data && is_array($grid_Data->data)) --}}
            @foreach (unserialize($griddata->action) as $key => $temps)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ unserialize($griddata->action)[$key] ? unserialize($griddata->action)[$key] : '' }}
                    </td>
                    @foreach ($users as $value)
                        @if ($griddata && unserialize($griddata->responsible)[$key] == $value->id)
                            {{-- {{ unserialize($griddata->responsible)[$key] == $value->id ? 'selected' : '' }} --}}
                            <td>
                                {{ $value->name }}
                            </td>
                            @else
                                Not Applicable
                        @endif

                    @endforeach
                    <td>{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}</td>
                    <td>{{ unserialize($griddata->item_status)[$key] ? unserialize($griddata->item_status)[$key] : '' }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="block">
        <div class="block-head">
            Impact Analysis
        </div>
        <table>
            <tr>

                @php
                    $datas = [
                        '1' => 'High',
                        '2' => 'Medium',
                        '3' => 'Low',
                        '4' => 'None',
                    ];
                @endphp
                <th class="w-20">Impact</th>
                <td class="w-80">
                    @if ($data->impact)
                        {{ $datas[$data->impact] ?? '' }}
                    @else
                        Not Applicable
                    @endif
                </td>

                {{-- <th class="w-20">Impact Analysis
                </th>
                <td class="w-80">
                    @if ($data->impact_analysis)
                        {{ $data->impact_analysis }}
                    @else
                        Not Applicable
                    @endif
                </td> --}}
            </tr>
            </table>

            <h5>Impact Analysis</h5>
            <div style="font-size: 12px;">
                {{ $data->impact_analysis }}
            </div>

            <table>
            <tr>

                @php
                    $severity = [
                        '1' => 'Negligible',
                        '2' => 'Moderate',
                        '3' => 'Major',
                        '4' => 'Fatal',
                    ];
                @endphp

                    <th class="w-20">Severity Rate</th>
                    <td class="w-80">
                        @if ($data->severity_rate)
                            @if ($data->severity_rate == 1)
                                Negligible
                            @elseif($data->severity_rate == 2)
                                Moderate
                            @elseif($data->severity_rate == 3)
                                Major
                            @else
                                Fatal
                            @endif
                        @else
                            Not Applicable
                        @endif
                    </td>

                @php
                    $Occurance = [
                        '5' => 'Extremely Unlikely',
                        '4' => 'Rare',
                        '3' => 'Unlikely',
                        '2' => 'Likely',
                        '1' => 'Very Likely',
                    ];
                @endphp

                <th class="w-20">Occurrence
                </th>
                <td class="w-80">
                    @if ($data->occurrence)
                        {{ $Occurance[$data->occurrence] ?? '' }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                @php
                    $Detection = [
                        '5' => 'Impossible',
                        '4' => 'Rare',
                        '3' => 'Unlikely',
                        '2' => 'Likely',
                        '1' => 'Very Likely',
                    ];
                @endphp

                <th class="w-20">Detection
                </th>
                <td class="w-80">
                    @if ($data->detection)
                        {{ $Detection[$data->detection] ?? '' }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">RPN
                </th>
                <td class="w-80">
                    @if ($data->analysisRPN)
                        {{ $data->analysisRPN }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

        </table>
    </div>

    <div class="block">
        <div class="block-head">
            Summary
        </div>
        <table>
            <tr>
                <th class="w-20">Actual Start Date</th>
                <td class="w-80">
                    @if ($data->actual_start_date)
                        {!! $data->actual_start_date !!}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Actual End Date</th>
                <td class="w-80">
                    @if ($data->actual_end_date)
                        {{ $data->actual_end_date }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
        </table>


        <h5>Action Taken</h5>
        <div style="font-size: 12px;">
            {{ $data->action_taken }}
        </div>

            <table>

            <tr>
                {{-- <th class="w-20">Action Taken</th>
                <td class="w-80">
                    @if ($data->action_taken)
                        {!! $data->action_taken !!}
                    @else
                        Not Applicable
                    @endif
                </td> --}}

                <th class="w-20">Attached Files</th>
                <td class="w-80">
                    @if ($data->attach_files2)
                        {{ str_replace(',', ', ', $data->attach_files2) }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Related URL</th>
                <td class="w-80">
                    @if ($data->related_url)
                        {{ $data->related_url }}
                    @else
                        Not Applicable
                    @endif
                </td>

                {{-- <th class="w-20">Response Summary</th>
                <td class="w-80">
                    @if ($data->response_summary)
                        {{ $data->response_summary }}
                    @else
                        Not Applicable
                    @endif
                </td> --}}
            </tr>

        </table>


        <h5>Response Summary</h5>
        <div style="font-size: 12px;">
            {{ $data->response_summary }}
        </div>


    </div>



    <div class="block">
        <div class="block-head">
            Activity Log
        </div>
        <table>
            <tr>
                <th class="w-20">Report Issued By</th>
                <td class="w-80">
                    @if ($data->report_issued_by)
                        {{ $data->report_issued_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Report Issued On</th>
                <td class="w-80">
                    @if ($data->report_issued_on)
                        {{ $data->report_issued_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->report_issued_comment)
                        {!! $data->report_issued_comment !!}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Cancel By</th>
                <td class="w-80">
                    @if ($data->cancel_by)
                        {{ $data->cancel_by }}
                    @else
                        Not Applicable
                    @endif
                </td>
                <th class="w-20">Cancel On</th>
                <td class="w-80">
                    @if ($data->cancel_on)
                        {{ $data->cancel_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->cancel_comment)
                        {{ $data->cancel_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>


            <tr>
                <th class="w-20">Complete By</th>
                <td class="w-80">
                    @if ($data->complete_By)
                        {{ $data->complete_By }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Complete On</th>
                <td class="w-80">
                    @if ($data->complete_on)
                        {{ $data->complete_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->complete_comment)
                        {{ $data->complete_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">More Info Required By</th>
                <td class="w-80">
                    @if ($data->more_info_required_by)
                        {{ $data->more_info_required_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">More Info Required On</th>
                <td class="w-80">
                    @if ($data->more_info_required_on)
                        {{ $data->more_info_required_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->more_info_required_comment)
                        {{ $data->more_info_required_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">Reject CAPA Plan By</th>
                <td class="w-80">
                    @if ($data->reject_capa_plan_by)
                        {{ $data->reject_capa_plan_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Reject CAPA plan On</th>
                <td class="w-80">
                    @if ($data->reject_capa_plan_on)
                        {{ $data->reject_capa_plan_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->reject_capa_plan_comment)
                        {{ $data->reject_capa_plan_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">QA Approval Without CAPA By</th>
                <td class="w-80">
                    @if ($data->qa_approval_without_capa_by)
                        {{ $data->qa_approval_without_capa_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">QA Approval Without CAPA On</th>
                <td class="w-80">
                    @if ($data->qa_approval_without_capa_on)
                        {{ $data->qa_approval_without_capa_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->qa_approval_without_capa_comment)
                        {{ $data->qa_approval_without_capa_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">QA Approval By</th>
                <td class="w-80">
                    @if ($data->qa_appproval_by)
                        {{ $data->qa_appproval_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">QA Approval On</th>
                <td class="w-80">
                    @if ($data->qa_appproval_on)
                        {{ $data->qa_appproval_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->qa_appproval_comment)
                        {{ $data->qa_appproval_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">All CAPA closed By</th>
                <td class="w-80">
                    @if ($data->all_capa_closed_by)
                        {{ $data->all_capa_closed_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">All CAPA Closed On</th>
                <td class="w-80">
                    @if ($data->all_capa_closed_on)
                        {{ $data->all_capa_closed_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->all_capa_closed_comment)
                        {{ $data->all_capa_closed_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">Final Approval By</th>
                <td class="w-80">
                    @if ($data->Final_Approval_by)
                        {{ $data->Final_Approval_by }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Final Approval On</th>
                <td class="w-80">
                    @if ($data->Final_Approval_on)
                        {{ $data->Final_Approval_on }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <th class="w-20">Comment</th>
                <td class="w-80">
                    @if ($data->Final_Approval_comment)
                        {{ $data->Final_Approval_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

        </table>
    </div>


</div>
</div>

</body>

</html>
