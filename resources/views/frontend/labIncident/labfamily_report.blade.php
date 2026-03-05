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
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-50 { width: 50%; }
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

<!-- <style>
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
</style> -->


<style>

        #isPasted {
            width: 690px !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap;
            width: 1%;
            vertical-align: top;
        }

        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;

        }

        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 680px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted td > p span {
            display: inline-block;
            width: 650px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important;
            height: 100%;
            display: block;
            margin: 5px auto;
        }

        #isPasted td img {
            max-width: 400px !important;
            height: 300px;
            margin: 5px auto;
        }

        .table-containers {
            width: 690px;
            overflow-x: fixed;
        }


        #isPasted table {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
        }


        #isPasted table th,
        #isPasted table td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted table img {
            max-width: 100% !important;
            height: auto;
            display: block;
            margin: 5px auto;
        }

        .note-editable p {
            font-weight: normal !important;
        }

    </style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Lab Incident Familiy Report
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
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                <td class="w-50"><strong>Printed On :</strong> {{ date('d-M-Y') }}</td>
                <td class="w-50"><strong>Printed By :</strong> {{ Auth::user()->name }}</td>
                {{-- <td class="w-30"><strong>Page :</strong> 1 of 1</td> --}}
            </tr>
        </table>
    </footer>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                       
                    </tr>

                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">
                            {{ Helpers::getInitiatorName($data->initiator_id) }}
                        </td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">
                            {{ Helpers::getdateFormat($data->created_at) }}
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30" colspan="3">
                            @if($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Name of Analyst</th>
                        <td  class="w-80"  colspan="3">
                            @if($data->name_of_analyst)
                                {{ $data->name_of_analyst }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>



                <table>

                <tr>

                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if($data->short_desc){{ $data->short_desc }}@else Not Applicable @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
                    <div class="block-head">
                        Incident Investigation Report
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-5">Sr.No.</th>
                                <th class="w-30">Name of Product</th>
                                <th class="w-30">B No./A.R. No.</th>
                                <th class="w-30">Remarks</th>
                            </tr>
                            @php $investreport = 1; @endphp

                        @if (!empty($labgrid->data) && is_iterable($labgrid->data))
                            @foreach ($labgrid->data as $item)
                                <tr>
                                    <td class="w-5">{{ $investreport++ }}</td>
                                    <td class="w-30">{{ $item['name_of_product'] }}</td>
                                    <td class="w-30">{{ $item['batch_no'] }}</td>
                                    <td class="w-30">{{ $item['remarks'] }}</td>
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

                <table>
                    <!-- <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if(!empty($data->Initiator_Group)){{ $data->Initiator_Group }} @else Not Applicable  @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr> -->
                    <tr>
                        <!-- <th class="w-20">Severity Level</th>
                        <td class="w-30">@if(!empty($data->severity_level2)){{ $data->severity_level2 }} @else Not Applicable @endif</td> -->
                        <th class="w-20">Instrument Involved</th>
                          <td class="w-80" colspan="3">@if($data->incident_involved_others_gi){{ $data->incident_involved_others_gi }} @else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Stage</th>
                        <td class="w-30">@if($data->stage_stage_gi){{ $data->stage_stage_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Stability Condition (If Applicable)</th>
                        <td class="w-30">@if($data->incident_stability_cond_gi){{ $data->incident_stability_cond_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Interval (If Applicable)</th>
                        <td class="w-30">@if($data->incident_interval_others_gi){{ $data->incident_interval_others_gi }}@else Not Applicable @endif</td>

                        <th class="w-20">Test</th>
                        <td class="w-30">@if($data->test_gi){{ $data->test_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Date Of Analysis</th>
                        <td class="w-30">@if($data->incident_date_analysis_gi){{ Helpers::getdateFormat($data->incident_date_analysis_gi) }}@else Not Applicable @endif</td>

                        <th class="w-20">Specification Number</th>
                        <td class="w-30">@if($data->incident_specification_no_gi){{ $data->incident_specification_no_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">STP Number</th>
                        <td class="w-30">@if($data->incident_stp_no_gi){{ $data->incident_stp_no_gi }}@else Not Applicable @endif</td>

                        <th class="w-20">Date Of Incidence</th>
                        <td class="w-30">@if($data->incident_date_incidence_gi){{ Helpers::getdateFormat($data->incident_date_incidence_gi) }}@else Not Applicable @endif</td>

                    </tr>
                    {{-- <tr>
                        <th class="w-20">Description Of Incidence</th>
                        <td class="w-30" colspan="3">@if($data->description_incidence_gi){{ $data->description_incidence_gi }}@else Not Applicable @endif</td>
                    </tr> --}}


                   </table>
                    <div class="other-container ">
                    <table>

                                <th class="w-20">
                                    <div class="bold">Description Of Incidence</div>
                                </th>
                                <td class="w-80">{!! strip_tags($data->description_incidence_gi, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}</td>

                    </table>
                    {{-- <div class="custom-procedure-block">
                        <div class="custom-container">
                            <div class="custom-table-wrapper" id="custom-table2">
                                <div class="custom-procedure-content">
                                    <div class="custom-content-wrapper">
                                        <div class="table-containers">
                                            {!! strip_tags($data->description_incidence_gi, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <table>

                    <tr>
                        <th class="w-20">Reported By</th>
                        <td class="w-80">@isset($data->analyst_sign_date_gi) {{ $data->analyst_sign_date_gi }} @else Not Applicable @endisset</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->Incident_Category_others){{ $data->Incident_Category_others }}@else Not Applicable @endif</td>

                       </tr>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">@if($data->immediate_action_ia){{ $data->immediate_action_ia }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->attachments_gi)
                            @foreach (json_decode($data->attachments_gi) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                <table>
                    <tr>
                        <th class="w-20">QC Head/HOD Person</th>
                        <td class="w-30">@isset($data->investigator_qc) {{ Helpers::getInitiatorName($data->investigator_qc) }} @else Not Applicable @endisset</td>

                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">@if($data->qc_review_to){{ Helpers::getInitiatorName($data->qc_review_to) }}@else Not Applicable @endif</td>
                    </tr>
                </table>


            <div class="block">
                <div class="block-head">
                QC Head Review
                </div>
                <table>
                    <tr>
                        <th>QC Head Review Comments</th>
                        <td class="w-80">@if($data->QA_Review_Comments){{ $data->QA_Review_Comments }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QC Head Review Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->QA_Head_Attachment)
                            @foreach (json_decode($data->QA_Head_Attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

<br>
            <div class="block">
                <div class="block-head">
                QA Initial Review
                </div>
                <table>
                    <tr>
                        <th>QA Initial Review Comments</th>
                        <td class="w-80">@if($data->QA_initial_Comments){{ $data->QA_initial_Comments }}@else Not Applicable @endif</td>

                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QA Initial Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->QA_Initial_Attachment)
                            @foreach (json_decode($data->QA_Initial_Attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

<br>
            <div class="block">
                <div class="block-head">
                Investigation Details
                </div>

                <table>

                                <th class="w-20">
                                    <div class="bold">Investigation Details</div>
                                </th>
                                <td class="w-80">{!! strip_tags($data->Investigation_Details, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}</td>

                    </table>


                {{-- <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">Investigation Details</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="custom-procedure-block">
                        <div class="custom-container">
                            <div class="custom-table-wrapper" id="custom-table2">
                                <div class="custom-procedure-content">
                                    <div class="custom-content-wrapper">
                                        <div class="table-containers">
                                            {!! strip_tags($data->Investigation_Details, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}



                <table>
                    <!-- <tr>
                        <th>Investigation Details</th>
                        <td>@if($data->Investigation_Details){{ $data->Investigation_Details }}@else Not Applicable @endif</td>
                    </tr> -->

                    <tr>
                        <th>Action Taken</th>
                        <td class="w-80">@if($data->Action_Taken){{ $data->Action_Taken }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th>Probable Root Cause</th>
                        <td class="w-80">@if($data->Root_Cause){{ $data->Root_Cause }}@else Not Applicable @endif</td>
                    </tr>

                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                        Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Inv_Attachment)
                            @foreach (json_decode($data->Inv_Attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

           <div>
    <table>

        <tr>
            <th class="w-20">Proposed Corrective Action / Corrective Action Taken</th>
            <td class="w-80" colspan="3">
                @if ($data->proposed_correctivei_ia)
                    {{ $data->proposed_correctivei_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        <tr>
            <th class="w-20">Repeat Analysis Plan</th>
            <td class="w-80" colspan="3">
                @if ($data->repeat_analysis_plan_ia)
                    {{ $data->repeat_analysis_plan_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        <tr>
            <th class="w-20">Result of Repeat Analysis</th>
            <td class="w-80" colspan="3">
                @if ($data->result_of_repeat_analysis_ia)
                    {{ $data->result_of_repeat_analysis_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>
         <tr>
            <th class="w-20">Root Cause</th>
            <td class="w-80" colspan="3">
                @if ($data->details_investigation_ia)
                    {{ $data->details_investigation_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>


        <tr>
            <th class="w-20">Corrective and Preventive Action</th>
            <td class="w-80" colspan="3">
                @if ($data->corrective_and_preventive_action_ia)
                    {{ $data->corrective_and_preventive_action_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        <tr>
            <th class="w-20">Investigation Summary</th>
            <td class="w-80" colspan="3">
                @if ($data->investigation_summary_ia)
                    {{ $data->investigation_summary_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        <tr>
            <th class="w-20">CAPA Number</th>
            <td class="w-80" colspan="3">
                @if ($data->capa_number_im)
                    {{ $data->capa_number_im }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        {{-- <tr>
            <th class="w-20">Type of Incidence</th>
            <td class="w-80" colspan="3">
                @if ($data->type_incidence_ia)
                    {{ $data->type_incidence_ia }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr> --}}

        {{-- <tr>
            <th class="w-20">Other Incidence</th>
            <td class="w-80" colspan="3">
                @if ($data->other_incidence)
                    {{ $data->other_incidence }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr> --}}

        <tr>
            <th class="w-20">QC Investigator</th>
            <td class="w-80" colspan="3" >
                @if ($data->investigator_data)
                    {{ $data->investigator_data }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>
        <tr>
            <th class="w-20">QC Review</th>
            <td class="w-80" colspan="3">
                @if ($data->qc_review_data)
                    {{ Helpers::getInitiatorName($data->qc_review_data) }}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>
    </table>
</div>

            <div class="border-table">
                    <div class="block-head">
                    immediate Action Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->attachments_ia)
                            @foreach (json_decode($data->attachments_ia) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

            <br>

            <div class="block">
                <div class="block-head">
                    QC Head/HOD Secondary Review
                </div>
                <table>
                <tr>
                    <th>Incident Category</th>
                    <td>@if($data->Incident_Category){{ $data->Incident_Category }}@else Not Applicable @endif</td>
                    <th>Other Incident Category</th>
                    <td>@if($data->other_incidence_data){{ $data->other_incidence_data }}@else Not Applicable @endif</td>
                </tr>
                </table>
            <table>
                <tr>
                    <th class="w-20">QC Head/HOD Secondary Review Comments</th>
                    <td class="w-80">@if($data->QC_head_hod_secondry_Comments){{ $data->QC_head_hod_secondry_Comments }}@else Not Applicable @endif</td>
                </tr>
                </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                    QC Head/HOD Secondary Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                            @if ($data->QC_headhod_secondery_Attachment)
                                @foreach (json_decode($data->QC_headhod_secondery_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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

            <br>

            <div class="block">
                <div class="block-head">
                QA Secondary Review
                </div>
                <table>
                <tr>
                    <th class="w-20">QA Secondary Review Comments</th>
                    <td class="w-80" colspan='3'>@if($data->QA_secondry_Comments){{ $data->QA_secondry_Comments }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QA Secondary Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->QA_secondery_Attachment)
                            @foreach (json_decode($data->QA_secondery_Attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                Closure
                </div>
                    <table>
                        <tr>
                            <th class="w-20">Closure of Incident</th>
                            <td class="w-80" colspan='3'>@if($labtab->closure_incident_c){{ $labtab->closure_incident_c }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Head Comment</th>
                            <td class="w-80" colspan='3'>@if($labtab->qa_hear_remark_c){{ $labtab->qa_hear_remark_c }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                    Closure Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($labtab->closure_attachment_c)
                            @foreach (json_decode($labtab->closure_attachment_c) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

            <br>

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <div class="block-head">
                Submitted
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By</th>
                        <td class="w-30">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                    <div class="block-head">
                    QC Head/HOD Initial Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QC Head/HOD Initial Review Complete By</th>
                        <td class="w-30">@if($data->review_completed_by){{ $data->review_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Initial Review Complete On</th>
                        <td class="w-30">@if($data->review_completed_on){{ $data->review_completed_on }}@else Not Applicable @endif</td>
                      </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_1_by){{ $data->more_info_req_1_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_1_on){{ $data->more_info_req_1_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_1_comment){{ $data->more_info_req_1_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                    QA Initial Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Initial Review Complete By</th>
                        <td class="w-30">@if($data->preliminary_completed_by){{ $data->preliminary_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">@if($data->preliminary_completed_on){{ $data->preliminary_completed_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Comment</th>
                        <td class="w-80">@if($data->preliminary_completed_comment){{ $data->preliminary_completed_comment }}@else Not Applicable @endif</td>
                    </tr>


                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_2_by){{ $data->more_info_req_2_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_2_on){{ $data->more_info_req_2_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_2_comment){{ $data->more_info_req_2_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                    Pending Initiator Update
                </div>
                <table>
                    <tr>
                        <th class="w-20">Pending Initiator Update Complete By</th>
                        <td class="w-30">@if($data->all_activities_completed_by){{ $data->all_activities_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Pending Initiator Update Complete On</th>
                        <td class="w-30">@if($data->all_activities_completed_on){{ $data->all_activities_completed_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->all_activities_completed_comment){{ $data->all_activities_completed_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_3_by){{ $data->more_info_req_3_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_3_on){{ $data->more_info_req_3_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_3_comment){{ $data->more_info_req_3_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                    QC Head/HOD Secondary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QC Head/HOD Secondary Review Complete By</th>
                        <td class="w-30">@if($data->review_completed_by){{ $data->review_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Secondary Review Complete On</th>
                        <td class="w-30">@if($data->review_completed_on){{ $data->review_completed_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->solution_validation_comment){{ $data->solution_validation_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_4_by){{ $data->more_info_req_4_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_4_on){{ $data->more_info_req_4_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_4_comment){{ $data->more_info_req_4_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                    QA Secondary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Secondary Review Complete By</th>
                        <td class="w-30">@if($data->extended_inv_complete_by){{ $data->extended_inv_complete_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Secondary Review Complete On</th>
                        <td class="w-30">@if($data->extended_inv_complete_on){{ $data->extended_inv_complete_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Comment</th>
                        <td class="w-80">@if($data->extended_inv_comment){{ $data->extended_inv_comment }}@else Not Applicable @endif</td>
                    </tr>


                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_5_by){{ $data->more_info_req_5_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_5_on){{ $data->more_info_req_5_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_5_comment){{ $data->more_info_req_5_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                     QAH Approved
                </div>
                <table>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">@if($data->no_assignable_cause_by){{ $data->no_assignable_cause_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">@if($data->no_assignable_cause_on){{ $data->no_assignable_cause_on }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->no_assignable_cause_comment){{ $data->no_assignable_cause_comment }}@else Not Applicable @endif</td>
                    </tr>



                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->more_info_req_6_by){{ $data->more_info_req_6_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->more_info_req_6_on){{ $data->more_info_req_6_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">@if($data->more_info_req_6_comment){{ $data->more_info_req_6_comment }}@else Not Applicable @endif</td>
                    </tr> -->
                </table>

                    <div class="block-head">
                    Cancel
                </div>
                <table>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                      </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comment</th>
                        <td class="w-80">@if($data->cancell_comment){{ $data->cancell_comment }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>


        </div>
    </div>
    <div class="inner-block">
        @if($extensions->isNotEmpty())
        @foreach($extensions as $data)
        <center>
            <h3>Extension Report</h3>
        </center>
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

 <div class="inner-block">
     @if ($actionItem->isNotEmpty())
    @foreach ($actionItem as $data)
            <center>
                <h3>Action Item Report</h3>
            </center>
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
        @endforeach
        @endif
    </div>

     <div class="inner-block">
        @if($rootCouseAnalysis->isNotempty())
        @foreach($rootCouseAnalysis as $data)
        
        <center>
            <h3>Root Couse Analysis Report</h3>
        </center>
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
                            @if (Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                {{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}
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
                        <th class="w-20">HOD Review Comment</th>
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
                        <th class="w-20">Initial QA/CQA Review Comments</th>
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
                    table-layout: fixed;
                    /* Ensures columns are evenly distributed */
                }

                .thFMEA,
                .tdFMEA {
                    border: 1px solid black;
                    padding: 5px;
                    word-wrap: break-word;
                    text-align: center;
                    vertical-align: middle;
                    font-size: 6px;
                    /* Apply the same font size for all cells */
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
                    width: 80px;
                    /* Allocate more space for "Traceability Document" */
                }

                /* Adjust for smaller screens to fit */
                @media (max-width: 1200px) {

                    .tdFMEA:last-child,
                    .thFMEA:last-child {
                        font-size: 6px;
                        width: 70px;
                        /* Shrink width further for smaller screens */
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
                                {{ $investigation_teamNamesString }}
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
                            @if ($data->root_cause_methodology)
                                {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
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
                                <th class="thFMEA"> Control Measures recommended/ Risk mitigation proposed</th>
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
                                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                                        {{ $measurement[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                                        {{ $materials[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                                        {{ $methods[$i] ?? 'N/A' }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 70%;">
                                    <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                </td>
                                <td style="width: 30%;">
                                    <div
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
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
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            {{ $environment[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            {{ $manpower[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}
                                        </td>
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

            @if ($data->attachments)
            <a href="{{ asset('upload/document/', $data->attachments) }}">{{ $data->attachments }}
            @else
            Not Applicable
            @endif
      
        </table>
        


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
                  
                </tr>
            

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
    </div>
    @endforeach
    @endif
    </div>
    <div class="inner-block">
        @if($resampling->isNotEmpty())
        @foreach($resampling as $data)
        <center>
        <h3>Resampling Report</h3>
        </center>
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
        @endforeach
        @endif
    </div>

   @if (count($capa_Data) > 0)
        @foreach ($capa_Data as $data)

        <center>
            <h3>Capa Report</h3>
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
    
</body>
</html>
