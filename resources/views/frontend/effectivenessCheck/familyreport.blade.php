<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

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
                        Effectiveness Check Family Report 
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
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/EC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/EC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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

                <div class="block-head">
                    Effectiveness Planning Information
                </div>
                <table>

                    <tr>
                        <th class="w-20">Effectiveness check Plan</th>
                        <td class="w-80">
                            @if ($data->Effectiveness_check_Plan)
                                {{ $data->Effectiveness_check_Plan }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block-head">
                    Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->Attachments)
                            @foreach (json_decode($data->Attachments) as $key => $file)
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
                </table>
            </div>


            <div class="block-head">
                Acknowledge
            </div>
            <table>
                <tr>
                    <th class="w-20">Acknowledge Comment</th>
                    <td class="w-80">
                        @if ($data->acknowledge_comment)
                            {{ $data->acknowledge_comment }}
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
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->acknowledge_Attachment)
                        @foreach (json_decode($data->acknowledge_Attachment) as $key => $file)
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

        </div>


        <br>
        <div class="block-head">
            Effectiveness Check Results
        </div>
        <table>
            <tr>
                <th class="w-20">Effectiveness Results</th>
                <td class="w-80">
                    @if ($data->Effectiveness_Results)
                        {{ $data->Effectiveness_Results }}
                    @else
                        Not Applicable
                    @endif
                </td>

            </tr>
        </table>
        <div class="block-head">
            Effectiveness check Attachment
        </div>
        <div class="border-table">
            <table>
                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment </th>
                </tr>
                @if ($data->Effectiveness_check_Attachment)
                    @foreach (json_decode($data->Effectiveness_check_Attachment) as $key => $file)
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
        <div class="block-head">
            Effectiveness Summary
        </div>
        <table>
            <tr>
                <th class="w-20">Effectiveness Summary</th>
                <td class="w-80">
                    @if ($data->effect_summary)
                        {{ $data->effect_summary }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
        </table>

        <div class="block-head">
            HOD Review
        </div>
        <table>

            <tr>
                <th class="w-20">HOD Review Comment</th>
                <td class="w-80">
                    @if ($data->Comments)
                        {{ $data->Comments }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
        </table>
        <div class="block-head">
            HOD Review Attachment
        </div>
        <div class="border-table">
            <table>
                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment </th>
                </tr>
                @if ($data->Attachment)
                    @foreach (json_decode($data->Attachment) as $key => $file)
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
        <div class="block-head">
            QA/CQA Review
        </div>
        <table>

            <tr>
                <th class="w-20">QA/CQA Review Comment</th>
                <td class="w-80">
                    @if ($data->qa_cqa_review_comment)
                        {{ $data->qa_cqa_review_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
        </table>
        <div class="block-head">
            QA/CQA Review Attachment
        </div>
        <div class="border-table">
            <table>
                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment </th>
                </tr>
                @if ($data->qa_cqa_review_Attachment)
                    @foreach (json_decode($data->qa_cqa_review_Attachment) as $key => $file)
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
        <div class="block-head">
            QA/CQA Approval
        </div>
        <table>

            <tr>
                <th class="w-20">QA/CQA Approval Comment</th>
                <td class="w-80">
                    @if ($data->qa_cqa_approval_comment)
                        {{ $data->qa_cqa_approval_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
        </table>
        <div class="block-head">
            QA/CQA Approval Attachment
        </div>
        <div class="border-table">
            <table>
                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment </th>
                </tr>
                @if ($data->qa_cqa_approval_Attachment)
                    @foreach (json_decode($data->qa_cqa_approval_Attachment) as $key => $file)
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
        </div><br>
        <div class="block-head">
            Activity Log
        </div>
        <table>
            <tr>
                <th class="w-20">Submit By
                </th>
                <td class="w-30">@if( $data->submit_by ) {{ $data->submit_by }}  @else Not Applicable @endif </td>
                <th class="w-20">
                    Submit On</th>
                <td class="w-30"> @if( $data->submit_on ) {{ $data->submit_on }}  @else Not Applicable @endif</td>
                <th class="w-20">
                    Submit Comment</th>
                <td class="w-30"> @if( $data->submit_comment ) {{ $data->submit_comment }} @else Not Applicable @endif</td>
            </tr>
            <tr>
                <th class="w-20">Cancel By
                </th>
                <td class="w-30">@if($data->closed_cancelled_by) {{ $data->closed_cancelled_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Cancel On</th>
                <td class="w-30">@if($data->closed_cancelled_on) {{ $data->closed_cancelled_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Cancel Comment</th>
                <td class="w-30"> @if($data->closed_cancelled_comment) {{ $data->closed_cancelled_comment }} @else Not Applicable @endif</td>
            </tr>

            <tr>
                <th class="w-20">Acknowledge Complete By
                </th>
                <td class="w-30">@if($data->work_complition_by) {{ $data->work_complition_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Acknowledge Complete On</th>
                <td class="w-30"> @if($data->work_complition_on){{ $data->work_complition_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Acknowledge Complete Comment</th>
                <td class="w-30">@if($data->work_complition_comment){{ $data->work_complition_comment }} @else Not Applicable @endif</td>
            </tr>
            
            <tr>
                <th class="w-20"> Complete By
                </th>
                <td class="w-30">@if($data->effectiveness_check_complete_by) {{ $data->effectiveness_check_complete_by }} @else Not Applicable @endif </td>
                <th class="w-20">
                    Complete On</th>
                <td class="w-30">@if($data->effectiveness_check_complete_on){{ $data->effectiveness_check_complete_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Complete Comment</th>
                <td class="w-30">@if($data->effectiveness_check_complete_comment) {{ $data->effectiveness_check_complete_comment }} @else Not Applicable @endif</td>
            </tr>
            <tr>
                <th class="w-20">HOD Review Complete By
                </th>
                <td class="w-30">@if($data->hod_review_complete_by) {{ $data->hod_review_complete_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    HOD Review Complete On</th>
                <td class="w-30">@if($data->hod_review_complete_on) {{ $data->hod_review_complete_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    HOD Review Complete Comment</th>
                <td class="w-30">@if($data->hod_review_complete_comment) {{ $data->hod_review_complete_comment }} @else Not Applicable @endif</td>
            </tr>
            <tr>
                <th class="w-20">Not Effective By
                </th>
                <td class="w-30">@if($data->qa_review_complete_by) {{ $data->qa_review_complete_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Not Effective On</th>
                <td class="w-30">@if($data->qa_review_complete_on) {{ $data->qa_review_complete_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Not Effective Comment</th>
                <td class="w-30">@if($data->qa_review_complete_comment) {{ $data->qa_review_complete_comment }} @else Not Applicable @endif</td>
            </tr>
            <tr>
                <th class="w-20">Effective By
                </th>
                <td class="w-30">@if($data->effective_by) {{ $data->effective_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Effective On</th>
                <td class="w-30">@if($data->effective_on) {{ $data->effective_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Effective Comment</th>
                <td class="w-30">@if($data->effective_comment) {{ $data->effective_comment }} @else Not Applicable @endif</td>
            </tr>
            <tr>
                <th class="w-20">Not Effective Approval Complete By
                </th>
                <td class="w-30">@if($data->not_effective_approval_complete_by) {{ $data->not_effective_approval_complete_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Not Effective Approval Complete On</th>
                <td class="w-30">@if($data->not_effective_approval_complete_on) {{ $data->not_effective_approval_complete_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Not Effective Approval Complete Comment</th>
                <td class="w-30">@if($data->not_effective_approval_complete_comment) {{ $data->not_effective_approval_complete_comment }} @else Not Applicable @endif</td>
            </tr>


            <tr>
                <th class="w-20">Effective Approval Completed By
                </th>
                <td class="w-30">@if($data->effective_approval_complete_by){{ $data->effective_approval_complete_by }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Effective Approval Completed On</th>
                <td class="w-30">@if($data->effective_approval_complete_on) {{ $data->effective_approval_complete_on }} @else Not Applicable @endif</td>
                <th class="w-20">
                    Effective Approval Completed Comment</th>
                <td class="w-30">@if($data->effective_approval_complete_comment) {{ $data->effective_approval_complete_comment }} @else Not Applicable @endif</td>
            </tr>
        </table>
        </table>
    </div>


    <div class="block">

    </div>
    </div>
    </div>

</body>


<div class="inner-block">
    @if ($extensions->isNotEmpty())
    @foreach ($extensions as $data)
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
          @endforeach
@endif
    </div>

     <div class="inner-block">
         @if ($capas->isNotEmpty())
    @foreach ($capas as $data)
            <center>
                <h3>CAPA Report</h3>
            </center>
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
                    <!-- <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/CAPA/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                    </tr> -->
                    <tr>
                        <th class="w-20">Initiator Department</th>

                        <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                        {{-- <td class="w-30">{{ Helpers::getFullDepartmentName($data->initiator_Group) }}</td> --}}

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">{{ $data->initiator_group_code }}</td>

                     </tr>


                    </table>
                    <table>

                     {{-- <h5>
                        Short Description
                     </h5>
                    <div  style="font-size: 14px;">
                        @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                    </div> --}}
                     <tr>
                            <th class="w-20">Short Description</th>

                            <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                     </tr>

                     <tr>

                        <!-- <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
                       <th class="w-20">Initiated Through</th>
                        <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr>

                    </table>

                    <table>

                        <!-- <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td> -->

                        <tr>

                    <!-- <th class="w-20">Due Date</th>
                    <td class="w-80"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
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
                      {{-- <tr>
                            <th class="w-20">Short Description</th>

                            <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>

                      </tr>  --}}
                      <!-- <table>
                     <tr> -->
                        {{-- <th class="w-20">Short Description</th>
                        <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td> --}}
                        <!-- <th class="w-20">Severity Level</th>
                        <td class="w-80">{{ $data->severity_level_form }}</td> -->
                        <!-- <th class="w-20">Assigned To</th>
                            <td class="w-80">@if($data->assign_to){{ ($data->assign_to) }} @else Not Applicable @endif</td> -->
                    <!-- </tr>
     -->
                    <!-- <tr>

                        <!-- <th class="w-20">Due Date</th>
                        <td class="w-80"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
                       <!-- <th class="w-20">Initiated Through</th>
                        <td class="w-80">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr> --> -->
                <!-- </table> -->
                <!-- <table>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr>
                </table> -->
                <!-- <table>
                <tr>
                        <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>

                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table> -->
                        <!-- <tr>
                        <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>

                    </tr> -->
                </table>
                <!-- <table>
                    <tr>
                        <th class="w-20">Problem Description</th>
                        <td class="w-80">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>

                    </tr>
                </table> -->

                <!-- <table>
                    <tr>
                        <th class="w-20"> Initial Observation</th>
                        <td class="w-80">
                        @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                <!-- <table>
                    <tr>
                        <th class="w-20">Interim Containnment</th>
                        <td class="w-80">@if($data->interim_containnment){{ $data->interim_containnment }}@else Not Applicable @endif</td>
                        <th class="w-20"> Containment Comments </th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                <!-- <table>
                    <tr>

                        <th class="w-20"> Containment Comments </th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                {{-- <table>
                    <tr>
                        <th class="w-20">  CAPA QA Comments  </th>
                        <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> --}}
                <!-- <table>
                    <tr>
                        <th class="w-20">  Investigation  </th>
                        <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">  Root Cause Analysis  </th>
                        <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif </td>
                    </tr>


                </table>

                <table> -->
                    {{-- <tr>
                        <th class="w-20">Containment Comments</th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif</td>

                    </tr> --}}
                    {{-- <tr>
                        <th class="w-20">CAPA QA Comments</th>
                        <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                    </tr> --}}
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
                                @if($data1->Material_Details->material_name)
                                @foreach (unserialize($data1->Material_Details->material_name) as $key => $dataDemo)
                                <tr>
                                    <td class="w-15">{{ $dataDemo ? $key + 1  : "NA" }}</td>
                                    <td class="w-15">{{ unserialize($data1->Material_Details->material_name)[$key] ?  unserialize($data1->Material_Details->material_name)[$key]: "NA"}}</td>
                                    <td class="w-15">{{unserialize($data1->Material_Details->material_batch_no)[$key] ?  unserialize($data1->Material_Details->material_batch_no)[$key] : "NA" }}</td>
                                    <td class="w-5">{{unserialize($data1->Material_Details->material_mfg_date)[$key] ?  unserialize($data1->Material_Details->material_mfg_date)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data1->Material_Details->material_expiry_date)[$key] ?  unserialize($data1->Material_Details->material_expiry_date)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data1->Material_Details->material_batch_desposition)[$key] ?  unserialize($data1->Material_Details->material_batch_desposition)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data1->Material_Details->material_remark)[$key] ?  unserialize($data1->Material_Details->material_remark)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data1->Material_Details->material_batch_status)[$key] ?  unserialize($data1->Material_Details->material_batch_status)[$key] : "NA" }}</td>
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
                                @if($data1->Instruments_Details->equipment)
                                @foreach (unserialize($data1->Instruments_Details->equipment) as $key => $dataDemo)
                                <tr>
                                    <td class="w-15">{{ $dataDemo ? $key +1  : "Not Applicable" }}</td>

                                    <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                                    <td class="w-15">{{unserialize($data1->Instruments_Details->equipment_instruments)[$key] ?  unserialize($data1->Instruments_Details->equipment_instruments)[$key] : "Not Applicable" }}</td>
                                    <td class="w-15">{{unserialize($data1->Instruments_Details->equipment_comments)[$key] ?  unserialize($data1->Instruments_Details->equipment_comments)[$key] : "Not Applicable" }}</td>

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
                             <!-- <tr>

                                <th class="20">Preventive Action</th>
                                <td class="80">@if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                             </tr>
                            </table>
                        </div>

                    </tr> -->
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
        @endforeach
        @endif
    </div>

</html>






