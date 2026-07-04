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
<style>
    table.change-grid {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .change-grid th,
    .change-grid td {
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 11px;
        vertical-align: top;
        text-align: left;
        word-break: break-word;
        overflow-wrap: break-word;
        line-height: 1;
    }

    .change-grid th {
        background: #f2f2f2;
        font-weight: bold;
    }

    .sr-no {
        width: 8%;
    }

    .current-practice {
        width: 31%;
    }

    .proposed-change {
        width: 31%;
    }

    .justification {
        width: 30%;
    }

    .pdf-text {
        white-space: pre-line;
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

                        <th class="w-20">Initiation Department</th>
                        <td class="w-30">
                            {{ Helpers::getUserDepartmentFromDB(Auth::user()->departmentid) }}
                        </td>
                    </tr>

                    <tr>  

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30" colspan="3">
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
                            <table class="change-grid">
                                <thead>
                                    <tr>
                                        <th class="sr-no">Sr. No.</th>
                                        <th class="current-practice">Current Practice</th>
                                        <th class="proposed-change">Proposed Change</th>
                                        <th class="justification">Justification / reason for change</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $productsdetails = 1; @endphp

                                    @if (!empty($changeProposalGrid) && is_array($changeProposalGrid->data))
                                        @foreach ($changeProposalGrid->data as $detail)
                                            <tr>
                                                <td>{{ $productsdetails++ }}</td>

                                                <td class="pdf-text">
                                                    {!! nl2br(e($detail['existing_system'] ?? '')) !!}
                                                </td>

                                                <td class="pdf-text">
                                                    {!! nl2br(e($detail['proposed_change'] ?? '')) !!}
                                                </td>

                                                <td class="pdf-text">
                                                    {!! nl2br(e($detail['justification'] ?? '')) !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </div>

                        {{-- Impact Assesment --}}

                        @php
                            $checklist = $checklistData->data ?? [];
                        @endphp
        <div class="block">
                <div class="block-head">
                    Impact Assesment
                </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">Sr.No.</th>
                                <th width="55%">Particular</th>
                          <th width="40%" style="text-align: center;">Yes/No</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($checklist as $key => $item)

                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item['question'] ?? '' }}
                                    </td>

                                    <td class="text-center">
                                        {{-- If manual input exists (Any Other) --}}
                                        @if(isset($item['manual_response']))
                                            {{ $item['manual_response'] }}
                                        @else
                                            {{ $item['response'] ?? '' }}
                                        @endif
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
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
                <div class="block-head">HOD/Designee Attachments</div>
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
                <div class="block-head">QA/CQA Head Approval Attachments</div>
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
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">@if ($data->hod_cancelled_by) {{ $data->hod_cancelled_by }} @else Not Applicable @endif</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">@if ($data->hod_cancelled_on) {{ $data->hod_cancelled_on }} @else Not Applicable @endif</td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">@if ($data->hod_cancel_comment) {{ $data->hod_cancel_comment }} @else Not Applicable @endif</td>
                    </tr>
                    

                    <tr>
                        <th class="w-20">QA/CQA Review Complete By</th>
                        <td class="w-30">@if ($data->qa_cqa_Review_Complete_By) {{ $data->qa_cqa_Review_Complete_By }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Review Complete On</th>
                        <td class="w-30">@if ($data->qa_cqa__Review_Complete_On) {{ $data->qa_cqa__Review_Complete_On }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Review Complete Comment</th>
                        <td class="w-30">@if ($data->qa_cqa__Review_Comments) {{ $data->qa_cqa__Review_Comments }} @else Not Applicable @endif</td>
                    </tr>
                
                    <tr>
                        <th class="w-20">QA/CQA Head/Designee Approval Complete By</th>
                        <td class="w-30">@if ($data->qa_cqa_head_Review_Complete_By) {{ $data->qa_cqa_head_Review_Complete_By }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Head/Designee Approval Complete On</th>
                        <td class="w-30">@if ($data->qa_cqa_head_Review_Complete_On) {{ $data->qa_cqa_head_Review_Complete_On }} @else Not Applicable @endif</td>
                        <th class="w-20">QA/CQA Head/Designee Approval Complete Comment</th>
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
