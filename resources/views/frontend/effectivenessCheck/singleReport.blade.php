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
                        Effectiveness Check Report
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


        <br>
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

</html>
