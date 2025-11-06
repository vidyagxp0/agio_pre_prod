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

@php
$users = DB::table('users')->select('id', 'name')->get();

@endphp
<footer>
    <table>
        <tr>
            <td class="w-50">
                <strong>Printed On :</strong> {{ date('d-M-Y') }}
            </td>
            <td class="w-50">
                <strong>Printed By :</strong> {{ Auth::user()->name }}
            </td>
            <!-- <td class="w-30">
                <strong>Page :</strong> 1 of 1
            </td>
        </tr> -->
    </table>
</footer>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Audit Program Report
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
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/AP/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Page No.</strong>
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
                        <th>Record Number</th>
                        <td>{{ Helpers::divisionNameForQMS($data->division_id) }}/AP/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}</td>
                        <th>Site/Location Code</th>
                        <td>{{ Helpers::divisionNameForQMS($data->division_id) }}</td>
                    </tr>

                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                            {{ $data->Initiator_Group }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Initiator Department code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                            {{ $data->initiator_group_code }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">
                            @if ($data->intiation_date)
                            {{ Helpers::getdateFormat($data->intiation_date) }}
                            @else
                            Not Applicable
                            @endif
                        </td>


                    </tr>
                    <tr>



                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                            {{ $data->assign_to }}
                            @else
                            Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Assigned To Department</th>
                        <td class="w-30">
                            @if ($data->assign_to_department)
                            {{ $data->assign_to_department }}
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
                <table>    
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
                </table>
                <table>    
                    <tr>    
                        @if ($data->type == 'Other')
                        <th class="w-20">Type(Others)</th>
                        <td class="w-80">
                            @if ($data->through_req)
                            {{ $data->through_req }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        @endif
                        <!-- <th class="w-20">Initiated through</th>
                        <td class="w-80">
                            @if ($data->year)
                            {{ $data->year }}
                            @else
                            Not Applicable
                            @endif
                        </td> -->
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Initiated through</th>
                        <td class="w-80">
                            @if ($data->year)
                            {{ $data->year }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        @if ($data->year == 'Other')
                        <th class="w-20">Initiated through(Others)</th>
                        <td class="w-80">
                            @if ($data->yearly_other)
                            {{ $data->yearly_other }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                        @endif
                    </tr>
                </table>
                <!-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px;">Due Date Extension Justification
                    </label>
                    <div style="font-size: 0.8rem">
                        @if ($data->due_date_extension)
                            {{ $data->due_date_extension }}
                        @else
                            Not Applicable
                        @endif
                    </div>
                </div> -->
               

                <div class="block">
                    <div class="block-head">
                        Audit Program
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-5" style="width: 25px;">Sr.No.</th>
                                <th class="w-20">Auditees</th>
                                <th class="w-20">Date Start</th>
                                <th class="w-20">Date End</th>
                                <th class="w-20">Lead Auditor</th>
                                <th class="w-20"> Comment</th>

                            </tr>
                            @if ($grid_Data3 && is_array($grid_Data3->data))
                            @foreach ($grid_Data3->data as $grid_Data)
                            <tr>
                                <td class="w-5">{{ $loop->index + 1 }}</td>
                                <td class="w-20">
                                    {{ isset($grid_Data['Auditees']) ? $grid_Data['Auditees'] : 'Not Applicable' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['Due_Date']) ? Helpers::getdateFormat( $grid_Data['Due_Date']) : 'Not Applicable' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['End_date']) ?  Helpers::getdateFormat( $grid_Data['End_date']) : 'Not Applicable' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['Lead_Investigator']) ? $grid_Data['Lead_Investigator'] : 'Not Applicable' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['Comment']) ? $grid_Data['Comment'] : 'Not Applicable' }}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>


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
                        Attached Files
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->attachments)
                        @foreach (json_decode($data->attachments) as $key => $file)
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
                        <th class="w-20">Related URl </th>
                        <td class="w-80">
                            @if ($data->related_url)
                            {{ $data->related_url }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>    
                        <th class="w-20">URl's description</th>
                        <td class="w-80">
                            @if ($data->url_description)
                            {{ $data->url_description }}
                            @else
                            Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                </div>

            </div>
        </div>
    </div>
    {{-- </div> --}}


    <div class="inner-block">
        <div class="content-table">

            <div class="block">
                <div class="block-head">
                    Self Inspection Circular
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-5" style="width: 25px;">Sr.No.</th>
                            <th class="w-20">Department</th>
                            <th class="w-20">Audit Date</th>
                            <th class="w-20">Name of Auditors</th>
                        </tr>


                        @if ($grid_Data2 && is_array($grid_Data2->data))
                        @foreach ($grid_Data2->data as $grid_Data)
                        <tr>
                            <td class="w-5">{{ $loop->index + 1 }}</td>
                            <td class="w-20">
                                {{ isset($grid_Data['departments']) ? $grid_Data['departments'] : 'Not Applicable' }}
                            </td>
                            <td>
                                {{ isset($grid_Data['info_mfg_date']) ? Helpers::getdateFormat( $grid_Data['info_mfg_date']) : 'Not Applicable' }}
                            </td>

                            <td>
                                @php
                                $auditors = [];
                                if (isset($grid_Data['Auditor'])) {
                                $auditorIds = is_array($grid_Data['Auditor'])
                                ? $grid_Data['Auditor']
                                : explode(',', $grid_Data['Auditor']);
                                $auditors = \App\Models\User::whereIn('id', $auditorIds)->pluck('name')->toArray();
                                }
                                @endphp
                                {{ !empty($auditors) ? implode(', ', $auditors) : 'Not Applicable' }}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>

            <table>

                <th class="w-20">Comments</th>
                <td class="w-80">
                    @if ($data->comment)
                    {{ $data->comment }}
                    @else
                    Not Applicable
                    @endif
                </td>
            </table>

            <div class="border-table">
                <div class="block-head">
                    Attached Files
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->Attached_File)
                    @foreach (json_decode($data->Attached_File) as $key => $file)
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

        <div class="block">
            <div class="block-head" style="">CQA/QA Approval</div>
            <table>
                <tr>
                    <th class="w-20">CQA/QA Approval Comments</th>
                    <td class="w-80">
                        @if ($data->cqa_qa_comment)
                        {{ $data->cqa_qa_comment }}
                        @else
                        Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    CQA/QA Attached Files
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cqa_qa_Attached_File)
                    @foreach (json_decode($data->cqa_qa_Attached_File) as $key => $file)
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

        <div class="block">
            <div class="block-head" style="">CQA/QA Review</div>
            <table>
                <tr>
                    <th class="w-20">CQA/QA Review Comments</th>
                    <td class="w-80">
                        @if ($data->cqa_qa_review_comment)
                        {{ $data->cqa_qa_review_comment }}
                        @else
                        Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    CQA/QA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cqa_qa_review_Attached_File)
                    @foreach (json_decode($data->cqa_qa_review_Attached_File) as $key => $file)
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

    </div>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>

                <!-- <div class="block-head">
                    Submit
                </div> -->
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                        <th class="w-20">
                            Submit On</th>
                        <td class="w-30">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                        <th class="w-20">
                            Submit Comment</th>
                        <td class="w-30">@if($data->Submitted_comment){{ $data->Submitted_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- </table>
                    <div class="block-head">
                        Approve
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-20">Approve By</th>
                        <td class="w-30">@if($data->approved_by){{ $data->approved_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Approve On</th>
                        <td class="w-30">@if($data->approved_on){{ $data->approved_on }}@else Not Applicable @endif</td>
                        <th class="w-20">
                            Approve Comment</th>
                        <td class="w-30">@if($data->approved_comment){{ $data->approved_comment }}@else Not Applicable @endif</td>
                    </tr>


                    <!-- </table>

                    <div class="block-head">
                        More Info Required
                    </div>
                    <table> -->
                    <!-- <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">@if($data->rejected_by){{ $data->rejected_by }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">@if($data->rejected_on){{ $data->rejected_on }}@else Not Applicable @endif</td>
                        <th class="w-20">More Info Required Comment</th>
                        <td class="w-30">@if($data->reject_comment){{ $data->reject_comment }}@else Not Applicable @endif</td>
                    </tr> -->

                    <!-- </table>
                    <div class="block-head">
                        Audit Completed
                    </div>
                    <table> -->

                    <tr>
                        <th class="w-20">Audit Completed By</th>
                        <td class="w-30">@if($data->Audit_Completed_By){{ $data->Audit_Completed_By }}@else Not Applicable @endif</td>
                        <th class="w-20">
                            Audit Completed On</th>
                        <td class="w-30">@if($data->Audit_Completed_On){{ $data->Audit_Completed_On }}@else Not Applicable @endif</td>
                        <th class="w-20">
                            Audit Completed Comment</th>
                        <td class="w-30">@if($data->Audit_Completed_comment){{ $data->Audit_Completed_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- </table>

                    <div class="block-head">
                        Cancel
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">@if($data->Cancelled_comment){{ $data->Cancelled_comment }}@else Not Applicable @endif</td>
                    </tr>

                </table>
            </div>

            <!-- ------------------------------- audit program grid--------------------------------------- -->

        </div>
    </div>
</body>

</html>