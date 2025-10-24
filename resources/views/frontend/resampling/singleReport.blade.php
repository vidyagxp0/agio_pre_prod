<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

{{-- <style>
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
</style> --}}

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
                    Resampling Report
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
                    <strong> Resampling No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/Resampling/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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

                    <label class="head-number" for="Related Records">Related Records</label>
                    <div class="div-data">
                        @if ($data->related_records)
                            {{ str_replace(',', ', ', $data->related_records) }}
                        @else
                            Not Applicable
                        @endif
                    </div>

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
                            <td class="w-30">
                                @if ($data->departments)
                                    {{ Helpers::getFullDepartmentName($data->departments) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20">If Others</th>
                            <td class="w-30">
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
                            {{-- <td class="w-80">@if ($data->capa_related_record){{ $data->capa_related_record }}@else Not Applicable @endif</td> --}}
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
                        <td class="w-80">
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
                        <td class="w-80">
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
                        <td class="w-80">
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
                        <td class="w-80">
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
                        <td class="w-80">
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
    </div>


</body>

</html>
