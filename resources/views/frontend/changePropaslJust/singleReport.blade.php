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

    .Summer {
        font-weight: bold;
        font-size: 0.8rem;
        margin-left: 10px;
    }

    .div-data {
        font-size: 0.8rem;
        margin-left: 10px;
        margin-bottom: 10px;

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
<body>
    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                   Change Proposal And Justification Report
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
                <td class="w-30"><strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="w-40">
                    {{ Helpers::getDivisionName($data->division_id) }}/CPJ/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30"><strong>Page No.</strong></td>
            </tr>
        </table>
    </header>
    <footer>
        <table>
            <tr>
                <td class="w-50"><strong>Printed On:</strong> {{ date('d-M-Y') }}</td>
                <td class="w-50"><strong>Printed By:</strong> {{Auth::user()->name }}</td>
            </tr>
        </table>
    </footer>


<div class="inner-block">
    <div class="content-table">

        {{-- ================= GENERAL INFO ================= --}}
        <div class="block">
            <div class="block-head">General Information</div>

            <table>
                <tr>
                    <th class="w-20">Record Number</th>
                    <td class="w-30">
                        {{ Helpers::getDivisionName($data->division_id) }}/CPJ/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <th class="w-20">Site/Location Code</th>
                    <td class="w-30">
                        {{ $data->division_code ?? 'Not Applicable' }}
                    </td>
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
            </table>

            <table>
                <tr>
                    <th class="w-20">Short Description</th>
                    <td class="w-80">
                        {{ $data->cpdescription ?? 'Not Applicable' }}
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <th class="w-20">Description of Change</th>
                    <td class="w-80">
                        {{ $data->impassesment ?? 'Not Applicable' }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="block">
                    <div class="block-head">
                        Change Proposal And Justification Details Grid
                    </div>
                    <div class="border-table">
                        <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                            <thead>
                                <tr class="table_bg">
                                    <th style="width: 5%">Sr. No.</th>
                                    <th style="width: 12%">Current Practice</th>
                                    <th style="width: 16%">Proposed Change</th>
                                    <th style="width: 15%">Justification / reason for change</th>
                                    {{-- <th style="width: 8%">Action</th> --}}
                                </tr>
                            </thead>
                             <tbody>
                                    @php $productsdetails = 1; @endphp
                                    @if (!empty($changeProposalGrid) && is_array($changeProposalGrid->data))

                                        @foreach ($changeProposalGrid->data as $index => $detail)
                                            <tr>
                                                <td>{{ $productsdetails++ }}</td>
                                                <td class="w-20">
                                                    {{ isset($detail['existing_system']) ? $detail['existing_system'] : '' }} </td>
                                                <td class="w-20">
                                                    {{ isset($detail['proposed_change']) ? $detail['proposed_change'] : '' }} </td>
                                                <td class="w-20">
                                                    {{ isset($detail['justification']) ? $detail['justification'] : '' }}
                                                </td>
                                                
                                                {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }} </td> --}}

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1</td>

                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            {{-- <td>Not Applicable</td> --}}

                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

        {{-- ================= INITIATOR ATTACHMENT ================= --}}
        <div class="block">
            <div class="block-head">Initiator Attachment</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th>Attachment</th>
                    </tr>

                    @if ($data->cpAttachment)
                        @foreach (json_decode($data->cpAttachment) as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $file }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>1</td>
                            <td>Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- ================= HOD ================= --}}
        <div class="block">
            <div class="block-head">HOD/Designee Review</div>

            <table>
                <tr>
                    <th class="w-20">HOD/Designee Review comment</th>
                    <td class="w-80">{{ $data->hod_comment ?? 'Not Applicable' }}</td>
                </tr>
            </table>
        </div>

        <div class="block">
            <div class="block-head">HOD/Designee Attachment</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th>Attachment</th>
                    </tr>

                    @if ($data->hodAttachment)
                        @foreach (json_decode($data->hodAttachment) as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $file }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>1</td>
                            <td>Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- ================= QA ================= --}}
        <div class="block">
            <div class="block-head">QA/CQA Review</div>

            <table>
                <tr>
                    <th class="w-20">QA/CQA Review Comments</th>
                    <td class="w-80">{{ $data->qa_comment ?? 'Not Applicable' }}</td>
                </tr>
            </table>
        </div>

        <div class="block">
            <div class="block-head">QA/CQA Review Attachments</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th>Attachment</th>
                    </tr>

                    @if ($data->qaAttachment)
                        @foreach (json_decode($data->qaAttachment) as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $file }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>1</td>
                            <td>Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- ================= QA CQA HEAD ================= --}}
        <div class="block">
            <div class="block-head">QA/CQA Head / Designee Approval</div>

            <table>
                <tr>
                    <th class="w-20">QA/CQA Head / Designee Approval Comments</th>
                    <td class="w-80">{{ $data->qa_cqa_head_comment ?? 'Not Applicable' }}</td>
                </tr>
            </table>
        </div>

        <div class="block">
            <div class="block-head">QA/CQA Head / designee Attachment</div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th>Attachment</th>
                    </tr>

                    @if ($data->qa_cqa_head_Attachment)
                        @foreach (json_decode($data->qa_cqa_head_Attachment) as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $file }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>1</td>
                            <td>Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

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
                    
                    <tr>
                        <th class="w-20">HOD/Designee Review By</th>
                        <td class="w-30">@if ($data->HOD_Review_Complete_By) {{ $data->HOD_Review_Complete_By }} @else Not Applicable @endif</td>
                        <th class="w-20">HOD/Designee Review On</th>
                        <td class="w-30">@if ($data->HOD_Review_Complete_On) {{ $data->HOD_Review_Complete_On }} @else Not Applicable @endif</td>
                        <th class="w-20">HOD/Designee Review Comment</th>
                        <td class="w-30">@if ($data->HOD_Review_Comments) {{ $data->HOD_Review_Comments }} @else Not Applicable @endif</td>
                    </tr>

                     <tr>
                        <th class="w-20">QA/CQA Review By</th>
                        <td class="w-30">@if ($data->qa_cqa_Review_Complete_By) {{ $data->qa_cqa_Review_Complete_By }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Review On</th>
                        <td class="w-30">@if ($data->qa_cqa__Review_Complete_On) {{ $data->qa_cqa__Review_Complete_On }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Review Comment</th>
                        <td class="w-30">@if ($data->qa_cqa__Review_Comments) {{ $data->qa_cqa__Review_Comments }} @else Not Applicable @endif</td>
                    </tr>
                   
                    <tr>
                        <th class="w-20">QA/CQA Head/Designee Complete By</th>
                        <td class="w-30">@if ($data->qa_cqa_head_Review_Complete_By) {{ $data->qa_cqa_head_Review_Complete_By }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Head/Designee Complete On</th>
                        <td class="w-30">@if ($data->qa_cqa_head_Review_Complete_On) {{ $data->qa_cqa_head_Review_Complete_On }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Head/Designee Complete Comment</th>
                        <td class="w-30">@if ($data->qa_cqa_head_Review_Comments) {{ $data->qa_cqa_head_Review_Comments }} @else Not Applicable @endif</td>
                    </tr>

                     <tr>
                        <th class="w-20">Reject By</th>
                        <td class="w-30">@if ($data->rejected_by) {{ $data->rejected_by }} @else Not Applicable @endif</td>
                        <th class="w-20">Reject On</th>
                        <td class="w-30">@if ($data->rejected_on) {{ $data->rejected_on }} @else Not Applicable @endif</td>
                        <th class="w-20">Reject Comment</th>
                        <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

    </div>
</div>



</body>

</html>
