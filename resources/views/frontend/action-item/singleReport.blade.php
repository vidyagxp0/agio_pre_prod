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
        max-width: 700px;
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
        font-size: 14px;
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
    
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Action-Item Report
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
                    <strong> Action-Item No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                        <td class="w-80">
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
                
                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">Description</div>
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
                                            {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <table>     
                        <tr>
                            <th class="w-20">Action Item Related Records</th>
                            <td class="w-80">
                                @if ($data->related_records)
                                    {{ str_replace(',', ', ', $data->related_records) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

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


                        <tr>
                            <th class="w-20">HOD Persons</th>
                            <td class="w-80">
                                @if ($data->hod_preson)
                                    {{ $data->hod_preson }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
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
                    <td class="w-80">
                        @if ($data->start_date)
                            {{ Helpers::getdateFormat($data->start_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Actual End Date</th>
                    <td class="w-80">
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

                    <!-- <div class="block-head">
                        Submit
                    </div> -->

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
    </div>


</body>

</html>
