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
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">Extension Report</td>
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
                <td class="w-30"><strong>Extension No.</strong></td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30"><strong>Record No.</strong> {{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>
    <footer>
        <table>
            <tr>
                <td class="w-30"><strong>Printed On:</strong> {{ date('d-M-Y') }}</td>
                <td class="w-40"><strong>Printed By:</strong> {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </footer>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">Extension Details</div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-80">
                            @if ($data->record_number)
                                {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-80">
                            @if ($data->site_location_code)
                                {{ Helpers::getDivisionName($data->site_location_code) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-80">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                </table>

                {{-- <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> --}}

                <label class="Summer" for="Short Description">Short Description</label>
                <div class="div-data">
                    @if ($data->short_description)
                        {{ $data->short_description }}
                    @else
                        Not Applicable
                    @endif
                </div>
                <table>

                    <tr>
                        <th class="w-20">Extension Number</th>
                        <td class="w-80">
                            @if ($data->Extension)
                                {{ $data->Extension }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review</th>
                        <td class="w-80">
                            @if ($data->reviewers)
                                {{ Helpers::getInitiatorName($data->reviewers) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Approval</th>
                        <td class="w-80">
                            @if ($data->approvers)
                                {{ Helpers::getInitiatorName($data->approvers) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20">Parent Record Number</th>
                        <td class="w-80">
                            @if ($data->related_records)
                                {{ str_replace(',', ', ', $data->related_records) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> --}}

                <label class="Summer" for="Parent Record Number">Parent Records Number</label>
                <div class="div-data">
                    @if ($data->related_records)
                        {{ str_replace(',', ', ', $data->related_records) }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <table>
                    <tr>
                        <th class="w-20">Current Due Date (Parent)</th>
                        <td class="w-80">
                            @if ($data->current_due_date)
                                {{ Helpers::getdateFormat($data->current_due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Proposed Due Date</th>
                        <td class="w-80">
                            @if ($data->proposed_due_date)
                                {{ Helpers::getdateFormat($data->proposed_due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20"> Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Justification / Reason</th>
                        <td class="w-80">
                            @if ($data->justification_reason)
                                {{ $data->justification_reason }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table> --}}
                <label class="Summer" for="Description">Description</label>
                <div class="div-data">
                    @if ($data->description)
                        {{ $data->description }}
                    @else
                        Not Applicable
                    @endif
                </div>

                <label class="Summer" for="Justification / Reason">Justification / Reason</label>
                <div class="div-data">
                    @if ($data->justification_reason)
                        {{ $data->justification_reason }}
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="block">
                <div class="block-head">Attachment Extension</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File</th>
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

                {{-- <table>
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
                </table> --}}

                <label class="Summer" for="HOD Remarks">HOD Remarks</label>
                <div class="div-data">
                    @if ($data->reviewer_remarks)
                        {{ $data->reviewer_remarks }}
                    @else
                        Not Applicable
                    @endif
                </div>

            </div>
            <div class="block">
                <div class="block-head">HOD Attachments</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File</th>
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

            <div class="block">
                <div class="block-head">QA Approval</div>

                {{-- <table>
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
                </table> --}}

                <label class="Summer" for="QA/CQA Approval Comments">QA/CQA Approval Comments</label>
                <div class="div-data">
                    @if ($data->approver_remarks)
                        {{ $data->approver_remarks }}
                    @else
                        Not Applicable
                    @endif
                </div>

            </div>
            <div class="block">
                <div class="block-head">QA/CQA Approval Attachments</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File</th>
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
            <div class="block">
                <div class="block-head">Activity Log</div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-80">{{ $data->submit_by }}</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-80">{{ $data->submit_on }}</td>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">{{ $data->submit_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-80">{{ $data->reject_by }}</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-80">{{ $data->reject_on }}</td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-80">{{ $data->reject_comment }}</td>
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
                        <td class="w-80">{{ $data->submit_by_review }}</td>
                        <th class="w-20">Review On</th>
                        <td class="w-80">{{ $data->submit_on_review }}</td>
                        <th class="w-20">Review Comment</th>
                        <td class="w-80">{{ $data->submit_comment_review }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">System By</th>
                        <td class="w-80">{{ $data->submit_by_review }}</td>
                        <th class="w-20">System On</th>
                        <td class="w-80">{{ $data->submit_on_review }}</td>
                        <th class="w-20">System Comment</th>
                        <td class="w-80">{{ $data->submit_comment_review }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Reject By</th>
                        <td class="w-80">{{ $data->submit_by_inapproved }}</td>
                        <th class="w-20">Reject On</th>
                        <td class="w-80">{{ $data->submit_on_inapproved }}</td>
                        <th class="w-20">Reject Comment</th>
                        <td class="w-80">{{ $data->submit_commen_inapproved }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                        <th class="w-20">More Information Required Comment</th>
                        <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Send for CQA By</th>
                        <td class="w-80">{{ $data->send_cqa_by }}</td>
                        <th class="w-20">Send for CQA On</th>
                        <td class="w-80">{{ $data->send_cqa_on }}</td>
                        <th class="w-20">Send for CQA Comment</th>
                        <td class="w-80">{{ $data->send_cqa_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-80">{{ $data->submit_by_approved }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-80">{{ $data->submit_on_approved }}</td>
                        <th class="w-20">Approved Comment</th>
                        <td class="w-80">{{ $data->submit_comment_approved }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CQA Approval Complete By</th>
                        <td class="w-80">{{ $data->cqa_approval_by }}</td>
                        <th class="w-20">CQA Approval Complete On</th>
                        <td class="w-80">{{ $data->cqa_approval_on }}</td>
                        <th class="w-20">CQA Approval Complete Comment</th>
                        <td class="w-80">{{ $data->cqa_approval_comment }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>



</body>

</html>
