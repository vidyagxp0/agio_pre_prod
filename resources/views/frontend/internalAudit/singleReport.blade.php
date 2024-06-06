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
                    Internal Audit Single Report
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
                    <strong>Internal Audit No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/IA{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ $data->record }}
                            @else
                                Not Applicable
                            @endif
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
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ $data->Initiator_Group }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Severity Level </th>
                        <td class="w-30">
                            @if ($data->severity_level_form)
                                {{ $data->severity_level_form }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit type</th>
                        <td class="w-30">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ $data->due_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">External Agencies</th>
                        <td class="w-30">
                            @if ($data->external_agencies)
                                {{ $data->external_agencies }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">If Other</th>
                        <td class="w-30">
                            @if ($data->if_other)
                                {{ $data->if_other }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Type of Audit</th>
                        <td class="w-30">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Audit start date</th>
                        <td class="w-30">
                            @if ($data->audit_start_date)
                                {{ $data->audit_start_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">
                            @if ($data->initial_comments)
                                {{ $data->initial_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Others</th>
                        <td class="w-30">
                            @if ($data->Others)
                                {{ $data->Others }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                    </tr>

                </table>



                <div class="block">
                    <div class="head">
                        <div class="block-head">
                            Audit Planning
                        </div>
                        <table>

                            <div style="font-weight: 200"></div>
                            {{-- </div> --}}
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">SR no.</th>
                                        <th class="w-20">Audit Schedule Start Date</th>
                                        <th class="w-20">Audit Schedule End Date</th>

                                        <th class="w-20">Audit Schedule Start Time</th>
                                        <th class="w-20">Audit Schedule End Time</th>

                                        <th class="w-20">Auditee</th>
                                        <th class="w-20">Auditore</th>
                                        <th class="w-20">Remarks</th>

                                    </tr>
                                    @if ($data && is_array($data->data))
                                        @foreach ($data->data as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ isset($data['audit_schedule_start_date']) ? $data['audit_schedule_start_date'] : '' }}
                                                </td>
                                                <td>{{ isset($data['audit_schedule_end_date']) ? $data['audit_schedule_end_date'] : '' }}
                                                </td>

                                                <td>{{ isset($data['audit_schedule_start_time']) ? $data['audit_schedule_start_time'] : '' }}
                                                </td>
                                                <td>{{ isset($data['audit_schedule_end_ime']) ? $data['audit_schedule_end_time'] : '' }}
                                                </td>
                                                <td>{{ isset($data['auditor']) ? $data['auditor'] : '' }}</td>
                                                <td>{{ isset($data['auditee']) ? $data['auditee'] : '' }}</td>
                                                <td>{{ isset($data['remarks']) ? $data['remarks '] : '' }}</td>

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

                                <table>

                                </table>
                            </div>
                    </div>
                </div>


                {{-- <tr>
                            <th class="w-30">Audit Schedule Start Date</th>
                            <td class="w-20">@if ($data->audit_schedule_start_date){{ $data->audit_schedule_start_date }}@else Not Applicable @endif</td>
                            <th class="w-30">Audit Schedule End Date</th>
                            <td class="w-20">@if ($data->audit_schedule_end_date){{ $data->audit_schedule_end_date }}@else Not Applicable @endif</td>

                        </tr>
                        <tr>
                        <th class="w-30">Scheduled Start Date</th>
                        <td class="w-20">@if ($data->scheduled_start_time){{ $data->audit_schedule_end_date }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-30">Scheduled End Time</th>
                        <td class="w-20">@if ($data->scheduled_end_time){{ $data->audit_schedule_end_date }}@else Not Applicable @endif</td>
                        <th class="w-30">Auditore</th>
                        <td class="w-20">@if ($data->auditor){{ $data->audit_auditor }}@else Not Applicable @endif</td>

                    </tr>

                <tr>

                        <th class="w-20">Auditee</th>
                        <td class="w-20">@if ($data->auditee){{ $data->audit_auditee }}@else Not Applicable @endif</td>
                        <th class="w-20">Remarks</th>
                        <td class="w-20">@if ($data->remarks){{ $data->audit_remarks }}@else Not Applicable @endif</td>


                                   </tr>

 --}}


                </table>
            </div>
            <table>

                <tr>
                    <th class="w-20">Audit Schedule Start Date</th>
                    <td class="w-80">
                        @if ($data->audit_schedule_start_date)
                            {{ $data->audit_schedule_start_date }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-30">Audit Schedule End Date</th>
                    <td class="w-20">
                        @if ($data->audit_schedule_end_date)
                            {{ $data->audit_schedule_end_date }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-30">Scheduled End Time</th>
                    <td class="w-20">
                        @if ($data->scheduled_end_time)
                            {{ $data->audit_schedule_end_date }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-30">Auditore</th>
                    <td class="w-20">
                        @if ($data->auditor)
                            {{ $data->audit_auditor }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>

            </table>

        </div>
        <div class="block">
            <div class="block-head">
                Audit Preparation
            </div>
            <table>
                <tr>
                    <th class="w-20">Lead Auditor</th>
                    <td class="w-30">
                        @if ($data->lead_auditor)
                            {{ Helpers::getInitiatorName($data->lead_auditor) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">External Auditor Details</th>
                    <td class="w-30">
                        @if ($data->Auditor_Details)
                            {{ $data->Auditor_Details }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

                <tr>
                    <th class="w-20">Audit Team</th>
                    <td class="w-30">
                        @if ($data->Audit_team)
                            {{ Helpers::getInitiatorName($data->Audit_team) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Auditee</th>
                    <td class="w-30">
                        @if ($data->Auditee)
                            {{ $data->Auditee }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

                <tr>
                    <th class="w-20">External Auditor Details</th>
                    <td class="w-30">
                        @if ($data->Auditor_Details)
                            {{ $data->Auditor_Details }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">QA Comments</th>
                    <td class="w-30">
                        @if ($data->QA_Comments)
                            {{ $data->QA_Comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>
                <tr>
                    <th class="w-20">External Auditing Agencys</th>
                    <td class="w-30">
                        @if ($data->External_Auditing_Agency)
                            {{ $data->External_Auditing_Agency }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Relevant Guidelines /Industry Standards</th>
                    <td class="w-30">
                        @if ($data->Relevant_Guideline)
                            {{ $data->Relevant_Guideline }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>

                <tr>
                    <th class="w-20">QA Comments</th>
                    <td class="w-30">
                        @if ($data->QA_Comments)
                            {{ $data->QA_Comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>

                <tr>
                    <th class="w-20">Audit team</th>
                    <td class="w-30">
                        @if ($data->Audit_team)
                            @foreach (explode(',', $data->Audit_team) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Auditee</th>
                    <td class="w-30">
                        @if ($data->Auditee)
                            @foreach (explode(',', $data->Auditee) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                        @else
                            Not Applicable
                        @endif
                    </td>

                </tr>
                <tr>
                    <th class="w-20">Comments</th>
                    <td class="w-30">
                        @if ($data->Comments)
                            {{ $data->Comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Audit Category</th>
                    <td class="w-30">
                        @if ($data->Audit_Category)
                            {{ Helpers::getInitiatorName($data->Audit_Category) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Supplier/Vendor/Manufacturer Site</th>
                    <td class="w-30">
                        @if ($data->Supplier_Site)
                            {{ $data->Supplier_Site }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Supplier/Vendor/Manufacturer Details</th>
                    <td class="w-30">
                        @if ($data->Supplier_Details)
                            {{ $data->Supplier_Details }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="border-table">
            <div class="block-head">
                File Attachment
            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">S.N.</th>
                    <th class="w-60">Batch No</th>
                </tr>
                @if ($data->file_attachment)
                    @foreach (json_decode($data->file_attachment) as $key => $file)
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
        <div class="border-table">
            <div class="block-head">
                Guideline Attachment
            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">S.N.</th>
                    <th class="w-60">Batch No</th>
                </tr>
                @if ($data->file_attachment)
                    @foreach (json_decode($data->file_attachment_guideline) as $key => $file)
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
        <div class="block">
            <div class="head">
                <div class="block-head">
                    Audit Execution
                </div>
                <table>

                    <tr>
                        <th class="w-20">Audit Start Date</th>
                        <td class="w-30">
                            <div>
                                @if ($data->audit_start_date)
                                    {{ $data->audit_start_date }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">Audit End Date</th>
                        <td class="w-30">
                            <div>
                                @if ($data->audit_end_date)
                                    {{ $data->audit_end_date }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Comments</th>
                        <td class="w-80">
                            @if ($data->Audit_Comments1)
                                {{ $data->Audit_Comments1 }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                    Audit Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->Audit_file)
                        @foreach (json_decode($data->Audit_file) as $key => $file)
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



            <div class="block">
                <div class="block-head">
                    Audit Response & Closure
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remarks
                        </th>
                        <td class="w-80">
                            <div>
                                @if ($data->Remarks)
                                    {{ $data->Remarks }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">Reference Record</th>
                        <td class="w-30">
                            <div>
                                @if ($data->refrence_record)
                                    {{ Helpers::getDivisionName($data->refrence_record) }}/IA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}
                                @else
                                    Not Applicable
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Comments
                        </th>
                        <td class="w-80">

                            <div>
                                @if ($data->Audit_Comments2)
                                    {{ $data->Audit_Comments2 }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">Due Date Extension Justification</th>
                        <td class="w-30">
                            <div>
                                @if ($data->due_date_extension)
                                    {{ $data->due_date_extension }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="border-table">
        <div class="block-head">
            Report Attachment
        </div>
        <table>

            <tr class="table_bg">
                <th class="w-20">S.N.</th>
                <th class="w-60">Batch No</th>
            </tr>
            @if ($data->report_file)
                @foreach (json_decode($data->report_file) as $key => $file)
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



    <div class="border-table">
        <div class="block-head">
            Audit Attachments
        </div>
        <table>

            <tr class="table_bg">
                <th class="w-20">S.N.</th>
                <th class="w-60">Batch No</th>
            </tr>
            @if ($data->myfile)
                @foreach (json_decode($data->myfile) as $key => $file)
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
            <th class="w-20">Audit Comments</th>
            <td class="w-80">
                @if ($data->Audit_Comments2)
                    {{ $data->Audit_Comments2 }}
                @else
                    Not Applicable
                @endif
            </td>
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
    </div>



    <!----------------------------------------------------------------------------Qutions Tabs------------------------------------------------------------------------------------------------>


    <div class="block">
        <div class="head">
            <div class="block-head">
                Checklist - Tablet Compression
            </div>
            <table>

                <div style="font-weight: 200"></div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>

                    </table>

                    <table>

                    </table>
                </div>
        </div>
    </div>

    </table>
    </div>
    <table class="table   ">
        <thead>
            <tr>

                <th>Question</th>
                <th>Response</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>


            <tr>
                <td class="flex w-10">1.1</td>
                <td class="w-50"> Is status labels displayed on all equipments / machines? </td>

                <td class="w-20">
                    @if ($checklist1 && $checklist1->tablet_compress_response_1)
                        {{ $checklist1->tablet_compress_response_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist1 && $checklist1->tablet_compress_remark_1)
                        {{ $checklist1->tablet_compress_remark_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.2</td>
                <td> Equipment cleanliness, check few equipments.</td>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_2)
                        {{ $checklist1->tablet_compress_response_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_2)
                        {{ $checklist1->tablet_compress_remark_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.3</td>
                <td>Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non
                    – additive so as not to affect the product?</td>

                <td>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_3)
                        {{ $checklist1->tablet_compress_response_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_3)
                        {{ $checklist1->tablet_compress_remark_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.4</td>
                <td>Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove
                    the previous materials? For active ingredients, have these procedures been validated?</td>
                <td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_4)
                        {{ $checklist1->tablet_compress_response_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_4)
                        {{ $checklist1->tablet_compress_remark_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.5</td>
                <td>
                    Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What
                    are the sanitizing agents used in this plant?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_5)
                        {{ $checklist1->tablet_compress_response_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_5)
                        {{ $checklist1->tablet_compress_remark_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.6</td>
                <td>
                    Are there data to show that the residues left by the cleaning and/or sanitizing agent are within
                    acceptable limits when cleaning is performed in accordance with the approved method?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_6)
                        {{ $checklist1->tablet_compress_response_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_6)
                        {{ $checklist1->tablet_compress_remark_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.7</td>
                <td>Do you have written procedures that describe the sufficient details of the cleaning schedule,
                    methods, equipment and material? Check for procedure compliance. </td>
                <td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_7)
                        {{ $checklist1->tablet_compress_response_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_7)
                        {{ $checklist1->tablet_compress_remark_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.9</td>
                <td> Are all piece of equipment clearly identified with easily visible markings? Check the equipment
                    nos. corresponds to an entry in a log book.
                </td>
                <td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_9)
                        {{ $checklist1->tablet_compress_response_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_9)
                        {{ $checklist1->tablet_compress_remark_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.10</td>
                <td>
                    Is equipment inspected immediately prior to use?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_10)
                        {{ $checklist1->tablet_compress_response_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_10)
                        {{ $checklist1->tablet_compress_remark_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.11</td>
                <td>
                    Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no
                    cleaning solutions or rinse remains in the equipment?
                </td>


                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_11)
                        {{ $checklist1->tablet_compress_response_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_11)
                        {{ $checklist1->tablet_compress_remark_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.12</td>
                <td>
                    Has a written schedule been established and is it followed for cleaning of equipment?


                <td>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_12)
                        {{ $checklist1->tablet_compress_response_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_12)
                        {{ $checklist1->tablet_compress_remark_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.13</td>
                <td>
                    Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of
                    product, dirt, and organic matter and to avoid growth of microorganisms?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_13)
                        {{ $checklist1->tablet_compress_response_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_13)
                        {{ $checklist1->tablet_compress_remark_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.14</td>
                <td>
                    Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag?
                    Check for few equipments
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_14)
                        {{ $checklist1->tablet_compress_response_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_14)
                        {{ $checklist1->tablet_compress_remark_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.15</td>
                <td>
                    Is equipment cleaned promptly after use?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_15)
                        {{ $checklist1->tablet_compress_response_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_15)
                        {{ $checklist1->tablet_compress_remark_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.16</td>
                <td>
                    Is there proper storage of cleaned equipment so as to prevent contamination?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_16)
                        {{ $checklist1->tablet_compress_response_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_16)
                        {{ $checklist1->tablet_compress_remark_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.17</td>
                <td>
                    Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling
                    with clean status)?
                </td>


                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_17)
                        {{ $checklist1->tablet_compress_response_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_17)
                        {{ $checklist1->tablet_compress_remark_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.18</td>
                <td>
                    Is sewage, trash and other reuse disposed off in a safe and sanitary manner ( and with sufficient
                    frequency)
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_18)
                        {{ $checklist1->tablet_compress_response_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_18)
                        {{ $checklist1->tablet_compress_remark_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.19</td>
                <td>
                    Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each
                    piece of equipment? Check 2 equipment records.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_19)
                        {{ $checklist1->tablet_compress_response_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_19)
                        {{ $checklist1->tablet_compress_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.20</td>
                <td>
                    Are all weighing and measuring performed by one qualified person and checked by a second person
                    Check the weighing balance record

                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_20)
                        {{ $checklist1->tablet_compress_response_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_20)
                        {{ $checklist1->tablet_compress_remark_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.21</td>
                <td>
                    Is the pressure differential of every particular area are within limit?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_21)
                        {{ $checklist1->tablet_compress_response_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_21)
                        {{ $checklist1->tablet_compress_remark_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.22</td>

                All the person working in compression area having proper gowning?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_22)
                        {{ $checklist1->tablet_compress_response_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_22)
                        {{ $checklist1->tablet_compress_remark_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.23</td>

                Is Inventory record of punch etc. maintained?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_23)
                        {{ $checklist1->tablet_compress_response_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_23)
                        {{ $checklist1->tablet_compress_remark_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.24</td>
                <td>
                    Check the punches records, for ‘B’ & ‘D’ tooling
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_24)
                        {{ $checklist1->tablet_compress_response_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_24)
                        {{ $checklist1->tablet_compress_remark_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.25</td>
                <td>
                    Have you any SOP regarding Hold time of material during staging?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_25)
                        {{ $checklist1->tablet_compress_response_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_25)
                        {{ $checklist1->tablet_compress_remark_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.26</td>
                <td>
                    Is there a written procedure specifying the frequency of inspection and replacement for air filters?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_26)
                        {{ $checklist1->tablet_compress_response_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_26)
                        {{ $checklist1->tablet_compress_remark_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.27</td>
                <td>
                    Are written operating procedures available for each equipment used in the compression area ? Check
                    for SOP compliance. Check the list of equipment and equipment details.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_27)
                        {{ $checklist1->tablet_compress_response_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_27)
                        {{ $checklist1->tablet_compress_remark_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.28</td>
                <td>
                    Does each equipment have written instructions for maintenance that includes a schedule for
                    maintenance?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_28)
                        {{ $checklist1->tablet_compress_response_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_28)
                        {{ $checklist1->tablet_compress_remark_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.29</td>
                <td>
                    Does the process control address all issues to ensure identity, strength, quality and purity of
                    product?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_29)
                        {{ $checklist1->tablet_compress_response_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_29)
                        {{ $checklist1->tablet_compress_remark_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.30</td>
                <td>
                    Check the calibration labels for instrument calibration status
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_30)
                        {{ $checklist1->tablet_compress_response_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_30)
                        {{ $checklist1->tablet_compress_remark_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.31</td>
                <td>
                    Temperature & RH record log book is available for each staging area.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_31)
                        {{ $checklist1->tablet_compress_response_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_31)
                        {{ $checklist1->tablet_compress_remark_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.32</td>
                <td>
                    Check for area activity record
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_32)
                        {{ $checklist1->tablet_compress_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_32)
                        {{ $checklist1->tablet_compress_remark_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.33</td>
                <td>
                    Check for equipment usage record
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_33)
                        {{ $checklist1->tablet_compress_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_33)
                        {{ $checklist1->tablet_compress_remark_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.34</td>
                <td>
                    Check for general equipment details and accessory details.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_34)
                        {{ $checklist1->tablet_compress_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_34)
                        {{ $checklist1->tablet_compress_remark_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.35</td>
                <td>
                    Check for man & material movement in the area
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_35)
                        {{ $checklist1->tablet_compress_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_35)
                        {{ $checklist1->tablet_compress_remark_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.36</td>
                <td>
                    Air handling system qualification, cleaning details and PAO test reports.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_36)
                        {{ $checklist1->tablet_compress_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_36)
                        {{ $checklist1->tablet_compress_remark_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.37</td>
                <td>
                    Check for purified water hose pipe status and water hold up.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_37)
                        {{ $checklist1->tablet_compress_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_37)
                        {{ $checklist1->tablet_compress_remark_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.38</td>
                <td>
                    Check for the status labeling in the area and, material randomly
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_38)
                        {{ $checklist1->tablet_compress_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_38)
                        {{ $checklist1->tablet_compress_remark_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.39</td>
                <td>
                    Check the in-process equipments cleaning status & records.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_39)
                        {{ $checklist1->tablet_compress_response_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_39)
                        {{ $checklist1->tablet_compress_remark_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.40</td>
                <td>
                    Are any unplanned process changes (process excursions) documented in the batch record?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_40)
                        {{ $checklist1->tablet_compress_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_40)
                        {{ $checklist1->tablet_compress_remark_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.41</td>
                <td>
                    Are materials and equipment clearly labeled as to identity and, if appropriate, stage of
                    manufacture?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_41)
                        {{ $checklist1->tablet_compress_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_41)
                        {{ $checklist1->tablet_compress_remark_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.42</td>
                <td>
                    Is there is an preventive maintenance program for all equipment and status of it.
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_42)
                        {{ $checklist1->tablet_compress_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_42)
                        {{ $checklist1->tablet_compress_remark_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.1</td>
                <td>Do records have doer & checker signatures? Check the timings, date and yield etc in the batch
                    manufacturing record. </td>

                <td>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_43)
                        {{ $checklist1->tablet_compress_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_43)
                        {{ $checklist1->tablet_compress_remark_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.2</td>
                <td>Is each batch assigned a distinctive code, so that material can be traced through manufacturing and
                    distribution? Check for In process analytical reports</td>


                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_44)
                        {{ $checklist1->tablet_compress_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_44)
                        {{ $checklist1->tablet_compress_remark_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">2.3</td>
                <td> Is the batch record is on line up to the current stage of a process?</td>


                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_45)
                        {{ $checklist1->tablet_compress_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_45)
                        {{ $checklist1->tablet_compress_remark_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.4</td>
                <td>In process carried out as per the written instruction describe in batch record? </td>


                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_46)
                        {{ $checklist1->tablet_compress_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_46)
                        {{ $checklist1->tablet_compress_remark_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">2.5</td>
                <td> Is there any punch inventory and punch utilization record?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_47)
                        {{ $checklist1->tablet_compress_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_47)
                        {{ $checklist1->tablet_compress_remark_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.6</td>
                <td> Is there any punch inventory and punch utilization record?
                <td>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_48)
                        {{ $checklist1->tablet_compress_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_48)
                        {{ $checklist1->tablet_compress_remark_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.7</td>
                <td> Is there any punch inventory and punch utilization record?
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_49)
                        {{ $checklist1->tablet_compress_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_remark_49)
                        {{ $checklist1->tablet_compress_remark_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <th> Final Comments </th>
                <td>
                    @if ($checklist1 && $checklist1->tablet_compress_response_final_comment)
                        {{ $checklist1->tablet_compress_response_final_comment }}
                    @else
                        Not Applicable
                    @endif
                </td>
                <th> Supporting Attachment </th>
                <td>
                    @if ($checklist1 && $checklist1->supproting_attachment)
                        {{ $checklist1->supproting_attachment }}
                    @else
                        Not Applicable
                    @endif
                </td>

            </tr>

        </tbody>
    </table>

    <div class="block">
        <div class="head">
            <div class="block-head">
                Checklist - Tablet Coating
            </div>
            <table>

                <div style="font-weight: 200"></div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>

                    </table>

                    <table>

                    </table>
                </div>
        </div>
    </div>

    </table>
    </div>
    <table class="table ">
        <thead>
            <tr>

                <th>Question</th>
                <th>Response</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>


            <tr>

                <td class="flex text-center">1.1</td>
                <td> Is status labels displayed on all equipments? </td>

                <td class="w-20">
                    @if ($checklist2 && $checklist2->tablet_coating_response_1)
                        {{ $checklist2->tablet_coating_response_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist2 && $checklist2->tablet_coating_remark_1)
                        {{ $checklist2->tablet_coating_remark_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.2</td>
                <td>Equipment cleanliness, check few equipments.</td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_2)
                        {{ $checklist2->tablet_coating_response_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_2)
                        {{ $checklist2->tablet_coating_remark_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.3</td>
                <td> Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non
                    – additive so as not to affect the product?</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_3)
                        {{ $checklist2->tablet_coating_response_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_3)
                        {{ $checklist2->tablet_coating_remark_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.4</td>
                <td>Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove
                    the previous materials? For active ingredients, have these procedures been validated? </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_4)
                        {{ $checklist2->tablet_coating_response_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_4)
                        {{ $checklist2->tablet_coating_remark_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.5</td>
                <td>
                    Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What
                    are the sanitizing agents used in this plant?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_5)
                        {{ $checklist2->tablet_coating_response_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_5)
                        {{ $checklist2->tablet_coating_remark_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.2</td>
                <td>
                    Are there data to show that the residues left by the cleaning and/or sanitizing agent are within
                    acceptable limits when cleaning is performed in accordance with the approved method?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_6)
                        {{ $checklist2->tablet_coating_response_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_6)
                        {{ $checklist2->tablet_coating_remark_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.7</td>
                <td>Do you have written procedures that describe the sufficient details of the cleaning schedule,
                    methods, equipment and material? Check for procedure compliance </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_7)
                        {{ $checklist2->tablet_coating_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_7)
                        {{ $checklist2->tablet_coating_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.8</td>
                <td>Are there written instructions describing how to use in-process data to control the process?</td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_8)
                        {{ $checklist2->tablet_coating_response_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_8)
                        {{ $checklist2->tablet_coating_remark_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.9</td>
                <td>
                    Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos.
                    corresponds to an entry in a log book.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_9)
                        {{ $checklist2->tablet_coating_response_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_9)
                        {{ $checklist2->tablet_coating_remark_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.10</td>
                <td> Equipment cleanliness, check few equipments.</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_10)
                        {{ $checklist2->tablet_coating_response_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_10)
                        {{ $checklist2->tablet_coating_remark_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.11</td>
                <td>
                    Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no
                    cleaning solutions or rinse remains in the equipment?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_11)
                        {{ $checklist2->tablet_coating_response_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_11)
                        {{ $checklist2->tablet_coating_remark_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.12</td>
                <td>
                    Has a written schedule been established and is it followed for cleaning of equipment?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_12)
                        {{ $checklist2->tablet_coating_response_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_12)
                        {{ $checklist2->tablet_coating_remark_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.13</td>
                <td>
                    Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of
                    product, dirt, and organic matter and to avoid growth of microorganisms?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_13)
                        {{ $checklist2->tablet_coating_response_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_13)
                        {{ $checklist2->tablet_coating_remark_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.14</td>
                <td>
                    Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag?
                    Check for few equipments
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_14)
                        {{ $checklist2->tablet_coating_response_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_14)
                        {{ $checklist2->tablet_coating_remark_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.15</td>
                <td>
                    Is equipment cleaned promptly after use?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_15)
                        {{ $checklist2->tablet_coating_response_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_15)
                        {{ $checklist2->tablet_coating_remark_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.16</td>
                <td>
                    Is there proper storage of cleaned equipment so as to prevent contamination?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_16)
                        {{ $checklist2->tablet_coating_response_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_16)
                        {{ $checklist2->tablet_coating_remark_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.17</td>
                <td>
                    Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling
                    with clean status)?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_17)
                        {{ $checklist2->tablet_coating_response_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_17)
                        {{ $checklist2->tablet_coating_remark_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.18</td>
                <td>
                    Is sewage, trash and other reuse disposed off in a safe and sanitary manner ( and with sufficient
                    frequency)
                </td>
                <td> Equipment cleanliness, check few equipments.</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_18)
                        {{ $checklist2->tablet_coating_response_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_18)
                        {{ $checklist2->tablet_coating_remark_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>


            <tr>

                <td class="flex text-center">1.19</td>
                <td>
                    Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each
                    piece of equipment? Check 2 equipment records.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_19)
                        {{ $checklist2->tablet_coating_response_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_19)
                        {{ $checklist2->tablet_coating_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.20</td>
                <td>
                    Are all weighing and measuring performed by one qualified person and checked by a second personCheck
                    the weighing balance record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_20)
                        {{ $checklist2->tablet_coating_response_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_20)
                        {{ $checklist2->tablet_coating_remark_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.21</td>
                <td>
                    Is the pressure differential of every particular area are within limit?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_21)
                        {{ $checklist2->tablet_coating_response_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_21)
                        {{ $checklist2->tablet_coating_remark_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.22</td>
                <td>
                    All the person working in manufacturing area having proper gowning?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_22)
                        {{ $checklist2->tablet_coating_response_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_22)
                        {{ $checklist2->tablet_coating_remark_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.23</td>
                <td>
                    Have you any SOP regarding Hold time of material during staging?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_23)
                        {{ $checklist2->tablet_coating_response_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_23)
                        {{ $checklist2->tablet_coating_remark_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.24</td>
                <td>
                    Is there a written procedure specifying the frequency of inspection and replacement for air filters?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_24)
                        {{ $checklist2->tablet_coating_response_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_24)
                        {{ $checklist2->tablet_coating_remark_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.25</td>
                <td>
                    Are written operating procedures available for each piece of equipment used in the manufacturing,
                    processing? Check for SOP compliance. Check the list of equipment and equipment details.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_25)
                        {{ $checklist2->tablet_coating_response_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_25)
                        {{ $checklist2->tablet_coating_remark_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.26</td>
                <td>
                    Does each equipment have written instructions for maintenance that includes a schedule for
                    maintenance?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_26)
                        {{ $checklist2->tablet_coating_response_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_26)
                        {{ $checklist2->tablet_coating_remark_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.27</td>
                <td>
                    Does the process control address all issues to ensure identity, strength, quality and purity of
                    product?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_27)
                        {{ $checklist2->tablet_coating_response_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_27)
                        {{ $checklist2->tablet_coating_remark_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.28</td>
                <td>
                    Check the calibration labels for instrument calibration status.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_28)
                        {{ $checklist2->tablet_coating_response_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_28)
                        {{ $checklist2->tablet_coating_remark_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.29</td>
                <td>
                    Temperature & RH record log book is available for each staging area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_29)
                        {{ $checklist2->tablet_coating_response_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_29)
                        {{ $checklist2->tablet_coating_remark_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.30</td>
                <td>
                    Material/Product in out register is available for each staging area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_30)
                        {{ $checklist2->tablet_coating_response_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_30)
                        {{ $checklist2->tablet_coating_remark_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.31</td>
                <td>
                    Check for area activity record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_31)
                        {{ $checklist2->tablet_coating_response_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_31)
                        {{ $checklist2->tablet_coating_remark_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.32</td>
                <td>
                    Check for equipment usage record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_32)
                        {{ $checklist2->tablet_coating_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_32)
                        {{ $checklist2->tablet_coating_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.33</td>
                <td>
                    Check for general equipment details and accessory details.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_33)
                        {{ $checklist2->tablet_coating_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_33)
                        {{ $checklist2->tablet_coating_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.34</td>
                <td>
                    Check for man & material movement in the area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_34)
                        {{ $checklist2->tablet_coating_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_34)
                        {{ $checklist2->tablet_coating_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.35</td>
                <td>
                    Air handling system qualification, cleaning details and PAO test reports
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_35)
                        {{ $checklist2->tablet_coating_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_35)
                        {{ $checklist2->tablet_coating_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.36</td>
                <td>
                    Check for purified water hose pipe status and water hold up.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_36)
                        {{ $checklist2->tablet_coating_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_36)
                        {{ $checklist2->tablet_coating_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.37</td>
                <td>
                    Check for the status labeling in the area and material randomly
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_37)
                        {{ $checklist2->tablet_coating_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_37)
                        {{ $checklist2->tablet_coating_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.38</td>
                <td>
                    Check the in-process equipments cleaning status & records.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_38)
                        {{ $checklist2->tablet_coating_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_38)
                        {{ $checklist2->tablet_coating_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.39</td>
                <td>
                    Are any unplanned process changes (process excursions) documented in the batch record?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_39)
                        {{ $checklist2->tablet_coating_response_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_39)
                        {{ $checklist2->tablet_coating_response_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.40</td>
                <td>
                    Are materials and equipment clearly labeled as to identity and, if appropriate, stage of
                    manufacture?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_40)
                        {{ $checklist2->tablet_coating_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_40)
                        {{ $checklist2->tablet_coating_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.41</td>
                <td>
                    Is there is an preventive maintenance program for all equipment and status of it
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_41)
                        {{ $checklist2->tablet_coating_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_41)
                        {{ $checklist2->tablet_coating_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.42</td>
                <td>
                    Do you have any sop for operation of autocoator?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_42)
                        {{ $checklist2->tablet_coating_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_42)
                        {{ $checklist2->tablet_coating_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.43</td>
                <td>
                    Have u any usage log book for autocoator.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_43)
                        {{ $checklist2->tablet_coating_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_43)
                        {{ $checklist2->tablet_coating_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.1</td>
                <td>Do records have doer & checker signatures? Check the timings, date and yield etc in the batch
                    manufacturing record.</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_44)
                        {{ $checklist2->tablet_coating_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_44)
                        {{ $checklist2->tablet_coating_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.2</td>
                <td>Is each batch assigned a distinctive code, so that material can be traced through manufacturing and
                    distribution? Check for In process analytical reports.</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_45)
                        {{ $checklist2->tablet_coating_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_45)
                        {{ $checklist2->tablet_coating_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.3</td>
                <td>Is the batch record is on line up to the current stage of a process?</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_46)
                        {{ $checklist2->tablet_coating_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_46)
                        {{ $checklist2->tablet_coating_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.4</td>
                <td>In process carried out as per the written instruction describe in batch record? </td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_47)
                        {{ $checklist2->tablet_coating_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_47)
                        {{ $checklist2->tablet_coating_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.5</td>
                <td>Is there any area cleaning record available for all individual areas?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_48)
                        {{ $checklist2->tablet_coating_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_48)
                        {{ $checklist2->tablet_coating_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.6</td>
                <td>Current version of SOP’s is available in respective areas?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_49)
                        {{ $checklist2->tablet_coating_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_49)
                        {{ $checklist2->tablet_coating_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <th> Final Comments </th>
            <td>
                @if ($checklist2 && $checklist2->tablet_coating_remark_comment)
                    {{ $checklist2->tablet_coating_remark_comment }}
                @else
                    Not Applicable
                @endif
            </td>
            <th> Supporting Attachment </th>
            <td>
                @if ($checklist2 && $checklist2->tablet_coating_supporting_attachment)
                    {{ $checklist2->tablet_coating_supporting_attachment }}
                @else
                    Not Applicable
                @endif
            </td>

            </tr>
        </tbody>
    </table>


    <div class="block">
        <div class="head">
            <div class="block-head">
                Checklist - Tablet Coating
            </div>
            <table>

                <div style="font-weight: 200"></div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>

                    </table>

                    <table>

                    </table>
                </div>
        </div>
    </div>

    </table>
    </div>
    <table class="table ">
        <thead>
            <tr>

                <th>Question</th>
                <th>Response</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>


            <tr>

                <td class="flex text-center">1.1</td>
                <td> Is status labels displayed on all equipments? </td>

                <td class="w-20">
                    @if ($checklist2 && $checklist2->tablet_coating_response_1)
                        {{ $checklist2->tablet_coating_response_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist2 && $checklist2->tablet_coating_remark_1)
                        {{ $checklist2->tablet_coating_remark_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.2</td>
                <td>Equipment cleanliness, check few equipments.</td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_2)
                        {{ $checklist2->tablet_coating_response_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_2)
                        {{ $checklist2->tablet_coating_remark_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.3</td>
                <td> Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non
                    – additive so as not to affect the product?</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_3)
                        {{ $checklist2->tablet_coating_response_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_3)
                        {{ $checklist2->tablet_coating_remark_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.4</td>
                <td>Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove
                    the previous materials? For active ingredients, have these procedures been validated? </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_4)
                        {{ $checklist2->tablet_coating_response_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_4)
                        {{ $checklist2->tablet_coating_remark_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.5</td>
                <td>
                    Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What
                    are the sanitizing agents used in this plant?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_5)
                        {{ $checklist2->tablet_coating_response_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_5)
                        {{ $checklist2->tablet_coating_remark_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.2</td>
                <td>
                    Are there data to show that the residues left by the cleaning and/or sanitizing agent are within
                    acceptable limits when cleaning is performed in accordance with the approved method?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_6)
                        {{ $checklist2->tablet_coating_response_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_6)
                        {{ $checklist2->tablet_coating_remark_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.7</td>
                <td>Do you have written procedures that describe the sufficient details of the cleaning schedule,
                    methods, equipment and material? Check for procedure compliance </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_7)
                        {{ $checklist2->tablet_coating_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_7)
                        {{ $checklist2->tablet_coating_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.8</td>
                <td>Are there written instructions describing how to use in-process data to control the process?</td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_8)
                        {{ $checklist2->tablet_coating_response_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_8)
                        {{ $checklist2->tablet_coating_remark_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.9</td>
                <td>
                    Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos.
                    corresponds to an entry in a log book.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_9)
                        {{ $checklist2->tablet_coating_response_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_9)
                        {{ $checklist2->tablet_coating_remark_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.10</td>
                <td> Equipment cleanliness, check few equipments.</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_10)
                        {{ $checklist2->tablet_coating_response_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_10)
                        {{ $checklist2->tablet_coating_remark_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.11</td>
                <td>
                    Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no
                    cleaning solutions or rinse remains in the equipment?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_11)
                        {{ $checklist2->tablet_coating_response_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_11)
                        {{ $checklist2->tablet_coating_remark_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.12</td>
                <td>
                    Has a written schedule been established and is it followed for cleaning of equipment?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_12)
                        {{ $checklist2->tablet_coating_response_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_12)
                        {{ $checklist2->tablet_coating_remark_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.13</td>
                <td>
                    Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of
                    product, dirt, and organic matter and to avoid growth of microorganisms?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_13)
                        {{ $checklist2->tablet_coating_response_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_13)
                        {{ $checklist2->tablet_coating_remark_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.14</td>
                <td>
                    Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag?
                    Check for few equipments
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_14)
                        {{ $checklist2->tablet_coating_response_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_14)
                        {{ $checklist2->tablet_coating_remark_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.15</td>
                <td>
                    Is equipment cleaned promptly after use?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_15)
                        {{ $checklist2->tablet_coating_response_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_15)
                        {{ $checklist2->tablet_coating_remark_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.16</td>
                <td>
                    Is there proper storage of cleaned equipment so as to prevent contamination?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_16)
                        {{ $checklist2->tablet_coating_response_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_16)
                        {{ $checklist2->tablet_coating_remark_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.17</td>
                <td>
                    Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling
                    with clean status)?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_17)
                        {{ $checklist2->tablet_coating_response_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_17)
                        {{ $checklist2->tablet_coating_remark_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.18</td>
                <td>
                    Is sewage, trash and other reuse disposed off in a safe and sanitary manner ( and with sufficient
                    frequency)
                </td>
                <td> Equipment cleanliness, check few equipments.</td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_18)
                        {{ $checklist2->tablet_coating_response_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_18)
                        {{ $checklist2->tablet_coating_remark_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>


            <tr>

                <td class="flex text-center">1.19</td>
                <td>
                    Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each
                    piece of equipment? Check 2 equipment records.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_19)
                        {{ $checklist2->tablet_coating_response_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_19)
                        {{ $checklist2->tablet_coating_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.20</td>
                <td>
                    Are all weighing and measuring performed by one qualified person and checked by a second personCheck
                    the weighing balance record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_20)
                        {{ $checklist2->tablet_coating_response_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_20)
                        {{ $checklist2->tablet_coating_remark_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.21</td>
                <td>
                    Is the pressure differential of every particular area are within limit?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_21)
                        {{ $checklist2->tablet_coating_response_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_21)
                        {{ $checklist2->tablet_coating_remark_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.22</td>
                <td>
                    All the person working in manufacturing area having proper gowning?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_22)
                        {{ $checklist2->tablet_coating_response_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_22)
                        {{ $checklist2->tablet_coating_remark_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>

                <td class="flex text-center">1.23</td>
                <td>
                    Have you any SOP regarding Hold time of material during staging?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_23)
                        {{ $checklist2->tablet_coating_response_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_23)
                        {{ $checklist2->tablet_coating_remark_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>

                <td class="flex text-center">1.24</td>
                <td>
                    Is there a written procedure specifying the frequency of inspection and replacement for air filters?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_24)
                        {{ $checklist2->tablet_coating_response_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_24)
                        {{ $checklist2->tablet_coating_remark_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.25</td>
                <td>
                    Are written operating procedures available for each piece of equipment used in the manufacturing,
                    processing? Check for SOP compliance. Check the list of equipment and equipment details.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_25)
                        {{ $checklist2->tablet_coating_response_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_25)
                        {{ $checklist2->tablet_coating_remark_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.26</td>
                <td>
                    Does each equipment have written instructions for maintenance that includes a schedule for
                    maintenance?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_26)
                        {{ $checklist2->tablet_coating_response_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_26)
                        {{ $checklist2->tablet_coating_remark_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.27</td>
                <td>
                    Does the process control address all issues to ensure identity, strength, quality and purity of
                    product?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_27)
                        {{ $checklist2->tablet_coating_response_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_27)
                        {{ $checklist2->tablet_coating_remark_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.28</td>
                <td>
                    Check the calibration labels for instrument calibration status.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_28)
                        {{ $checklist2->tablet_coating_response_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_28)
                        {{ $checklist2->tablet_coating_remark_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.29</td>
                <td>
                    Temperature & RH record log book is available for each staging area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_29)
                        {{ $checklist2->tablet_coating_response_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_29)
                        {{ $checklist2->tablet_coating_remark_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.30</td>
                <td>
                    Material/Product in out register is available for each staging area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_30)
                        {{ $checklist2->tablet_coating_response_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_30)
                        {{ $checklist2->tablet_coating_remark_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.31</td>
                <td>
                    Check for area activity record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_31)
                        {{ $checklist2->tablet_coating_response_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_remark_31)
                        {{ $checklist2->tablet_coating_remark_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.32</td>
                <td>
                    Check for equipment usage record.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_32)
                        {{ $checklist2->tablet_coating_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_32)
                        {{ $checklist2->tablet_coating_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.33</td>
                <td>
                    Check for general equipment details and accessory details.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_33)
                        {{ $checklist2->tablet_coating_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_33)
                        {{ $checklist2->tablet_coating_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.34</td>
                <td>
                    Check for man & material movement in the area.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_34)
                        {{ $checklist2->tablet_coating_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_34)
                        {{ $checklist2->tablet_coating_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.35</td>
                <td>
                    Air handling system qualification, cleaning details and PAO test reports
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_35)
                        {{ $checklist2->tablet_coating_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_35)
                        {{ $checklist2->tablet_coating_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.36</td>
                <td>
                    Check for purified water hose pipe status and water hold up.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_36)
                        {{ $checklist2->tablet_coating_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_36)
                        {{ $checklist2->tablet_coating_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.37</td>
                <td>
                    Check for the status labeling in the area and material randomly
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_37)
                        {{ $checklist2->tablet_coating_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_37)
                        {{ $checklist2->tablet_coating_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.38</td>
                <td>
                    Check the in-process equipments cleaning status & records.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_38)
                        {{ $checklist2->tablet_coating_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_38)
                        {{ $checklist2->tablet_coating_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.39</td>
                <td>
                    Are any unplanned process changes (process excursions) documented in the batch record?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_39)
                        {{ $checklist2->tablet_coating_response_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_39)
                        {{ $checklist2->tablet_coating_response_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.40</td>
                <td>
                    Are materials and equipment clearly labeled as to identity and, if appropriate, stage of
                    manufacture?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_40)
                        {{ $checklist2->tablet_coating_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_40)
                        {{ $checklist2->tablet_coating_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.41</td>
                <td>
                    Is there is an preventive maintenance program for all equipment and status of it
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_41)
                        {{ $checklist2->tablet_coating_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_41)
                        {{ $checklist2->tablet_coating_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.42</td>
                <td>
                    Do you have any sop for operation of autocoator?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_42)
                        {{ $checklist2->tablet_coating_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_42)
                        {{ $checklist2->tablet_coating_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.43</td>
                <td>
                    Have u any usage log book for autocoator.
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_43)
                        {{ $checklist2->tablet_coating_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_43)
                        {{ $checklist2->tablet_coating_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.1</td>
                <td>Do records have doer & checker signatures? Check the timings, date and yield etc in the batch
                    manufacturing record.</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_44)
                        {{ $checklist2->tablet_coating_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_44)
                        {{ $checklist2->tablet_coating_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.2</td>
                <td>Is each batch assigned a distinctive code, so that material can be traced through manufacturing and
                    distribution? Check for In process analytical reports.</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_45)
                        {{ $checklist2->tablet_coating_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_45)
                        {{ $checklist2->tablet_coating_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.3</td>
                <td>Is the batch record is on line up to the current stage of a process?</td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_46)
                        {{ $checklist2->tablet_coating_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_46)
                        {{ $checklist2->tablet_coating_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.4</td>
                <td>In process carried out as per the written instruction describe in batch record? </td>
                <td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_47)
                        {{ $checklist2->tablet_coating_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_47)
                        {{ $checklist2->tablet_coating_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.5</td>
                <td>Is there any area cleaning record available for all individual areas?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_48)
                        {{ $checklist2->tablet_coating_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_48)
                        {{ $checklist2->tablet_coating_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.6</td>
                <td>Current version of SOP’s is available in respective areas?
                </td>
                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_49)
                        {{ $checklist2->tablet_coating_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td>
                    @if ($checklist2 && $checklist2->tablet_coating_response_49)
                        {{ $checklist2->tablet_coating_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <th> Final Comments </th>
            <td>
                @if ($checklist2 && $checklist2->tablet_coating_remark_comment)
                    {{ $checklist2->tablet_coating_remark_comment }}
                @else
                    Not Applicable
                @endif
            </td>
            <th> Supporting Attachment </th>
            <td>
                @if ($checklist2 && $checklist2->tablet_coating_supporting_attachment)
                    {{ $checklist2->tablet_coating_supporting_attachment }}
                @else
                    Not Applicable
                @endif
            </td>

            </tr>
        </tbody>
    </table>
    <div class="block">
        <div class="head">
            <div class="block-head">
                Checklist - Tablet/ Capsule Packing
            </div>
            <table>
                <div style="font-weight: 200"></div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>

                    </table>

                    <table>

                    </table>
                </div>
        </div>
    </div>

    </table>
    </div>
    <table class="table ">
        <thead>
            <tr>

                <th>Question</th>
                <th>Response</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>


            <tr>
                <td class="flex text-center">1.1</td>
                <td> Check for area activity record. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_1)
                        {{ $checklist3->tablet_capsule_packing_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_1)
                        {{ $checklist3->tablet_capsule_packing_remark_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.2</td>
                <td> Check for equipment usage record. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_2)
                        {{ $checklist3->tablet_capsule_packing_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_2)
                        {{ $checklist3->tablet_capsule_packing_remark_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.3</td>
                <td> Check for general equipment details and accessory details. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_3)
                        {{ $checklist3->tablet_capsule_packing_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_3)
                        {{ $checklist3->tablet_capsule_packing_remark_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.4</td>
                <td>Check for man & material movement in the area. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_4)
                        {{ $checklist3->tablet_capsule_packing_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_4)
                        {{ $checklist3->tablet_capsule_packing_remark_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.5</td>
                <td>Air handling system qualification, cleaning details and PAO test reports. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_5)
                        {{ $checklist3->tablet_capsule_packing_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_5)
                        {{ $checklist3->tablet_capsule_packing_remark_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.6</td>
                <td> Check for purified water hose pipe status and water hold up. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_6)
                        {{ $checklist3->tablet_capsule_packing_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_6)
                        {{ $checklist3->tablet_capsule_packing_remark_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.7</td>
                <td> Check for the status labeling in the area and, material randomly </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_7)
                        {{ $checklist3->tablet_capsule_packing_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_7)
                        {{ $checklist3->tablet_capsule_packing_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.8</td>
                <td> Check the in-process equipments cleaning status & records. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_8)
                        {{ $checklist3->tablet_capsule_packing_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_8)
                        {{ $checklist3->tablet_capsule_packing_remark_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.9</td>
                <td> Are any unplanned process changes (process excursions) documented in the batch record? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_9)
                        {{ $checklist3->tablet_capsule_packing_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_9)
                        {{ $checklist3->tablet_capsule_packing_remark_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.10</td>
                <td> Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_10)
                        {{ $checklist3->tablet_capsule_packing_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_10)
                        {{ $checklist3->tablet_capsule_packing_remark_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.11</td>
                <td> Is there a preventive maintenance program for all equipment and status of it? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_11)
                        {{ $checklist3->tablet_capsule_packing_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_11)
                        {{ $checklist3->tablet_capsule_packing_remark_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.12</td>
                <td> Status label of area & equipment available? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_12)
                        {{ $checklist3->tablet_capsule_packing_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_12)
                        {{ $checklist3->tablet_capsule_packing_remark_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.13</td>
                <td> Have you any proper storage area for primary and secondary packing material? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_13)
                        {{ $checklist3->tablet_capsule_packing_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_13)
                        {{ $checklist3->tablet_capsule_packing_remark_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.14</td>
                <td> Do you have proper segregation system for keeping product/batch separately? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_14)
                        {{ $checklist3->tablet_capsule_packing_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_14)
                        {{ $checklist3->tablet_capsule_packing_remark_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.15</td>
                <td>Do you have proper segregation system for keeping product/batch separately? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_15)
                        {{ $checklist3->tablet_capsule_packing_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_15)
                        {{ $checklist3->tablet_capsule_packing_remark_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.16</td>
                <td> Is there proper covering of printed foil roll with poly bag? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_16)
                        {{ $checklist3->tablet_capsule_packing_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_16)
                        {{ $checklist3->tablet_capsule_packing_remark_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.17</td>
                <td> Stereo impression record available? Check the record for any 2 batches. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_17)
                        {{ $checklist3->tablet_capsule_packing_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_17)
                        {{ $checklist3->tablet_capsule_packing_remark_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.18</td>
                <td> Where you keep the rejected strips / blisters / containers / cartons? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_18)
                        {{ $checklist3->tablet_capsule_packing_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_18)
                        {{ $checklist3->tablet_capsule_packing_remark_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.19</td>
                <td> Is there any standard practice for destruction of printed aluminum foil & printed cartons? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_19)
                        {{ $checklist3->tablet_capsule_packing_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_19)
                        {{ $checklist3->tablet_capsule_packing_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">1.20</td>
                <td> Is there a written procedure for cleaning the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_19)
                        {{ $checklist3->tablet_capsule_packing_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_19)
                        {{ $checklist3->tablet_capsule_packing_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.1</td>
                <td> Have you any standard procedure for removal of scrap? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_20)
                        {{ $checklist3->tablet_capsule_packing_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_20)
                        {{ $checklist3->tablet_capsule_packing_remark_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>


            <tr>
                <td class="flex text-center">2.2</td>
                <td> Have you any standard procedure for removal of scrap? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_21)
                        {{ $checklist3->tablet_capsule_packing_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_22)
                        {{ $checklist3->tablet_capsule_packing_remark_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.3</td>
                <td> Check for area activity record. </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_23)
                        {{ $checklist3->tablet_capsule_packing_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_23)
                        {{ $checklist3->tablet_capsule_packing_remark_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
                <td class="flex text-center">2.4</td>
                <td>In process carried out as per the written instruction describe in batch record? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_24)
                        {{ $checklist3->tablet_capsule_packing_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_24)
                        {{ $checklist3->tablet_capsule_packing_remark_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">2.5</td>
                <td> Is there any area cleaning record available for all individual areas? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_25)
                        {{ $checklist3->tablet_capsule_packing_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_25)
                        {{ $checklist3->tablet_capsule_packing_remark_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">2.6</td>
                <td> Current version of SOP's is available in respective areas? </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_26)
                        {{ $checklist3->tablet_capsule_packing_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist3 && $checklist3->tablet_capsule_packing_remark_26)
                        {{ $checklist3->tablet_capsule_packing_remark_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
            <tr>
            <th> Final Comments </th>
            <td>
                @if ($checklist3 && $checklist3->tablet_capsule_packing_comment)
                {{ $checklist3->tablet_capsule_packing_comment}}
                @else
                    Not Applicable
                @endif
            </td>
        </tr>

        <div class="border-table">
            <div class="block-head">
                Supporting Attachment
            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">S.N.</th>
                    <th class="w-60">Batch No</th>
                </tr>
                @if ($data->report_file)
                    @foreach (json_decode($data->report_file) as $key => $file)
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
        </tbody>
    </table>





    <div class="block">
        <div class="head">
            <div class="block-head">
                Checklist - Capsule
            </div>
            <table>
                <div style="font-weight: 200"></div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>

                    </table>

                    <table>

                    </table>
                </div>
        </div>
    </div>

    </table>
    </div>
    <table class="table ">
        <thead>
            <tr>

                <th>Question</th>
                <th>Response</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>


            <tr>
                <td class="flex text-center">1.1</td>
                <td> Is status labels displayed on all equipments? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_1)
                        {{ $checklist4->capsule_response_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_1)
                        {{ $checklist4->capsule_remark_1 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <td class="flex text-center">1.2</td>
                <td>Equipment cleanliness, check few equipments. </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_2)
                        {{ $checklist4->capsule_response_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_2)
                        {{ $checklist4->capsule_remark_2 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>


            <tr>
                <td class="flex text-center">1.3</td>
                <td>Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_3)
                        {{ $checklist4->capsule_response_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_3)
                        {{ $checklist4->capsule_remark_3 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.4</td>
                <td>Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials?  For active ingredients, have these procedures been validated? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_4)
                        {{ $checklist4->capsule_response_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_4)
                        {{ $checklist4->capsule_remark_4 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.5</td>
                <td>Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_5)
                        {{ $checklist4->capsule_response_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_5)
                        {{ $checklist4->capsule_remark_5 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.6</td>
                <td> Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_6)
                        {{ $checklist4->capsule_response_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_6)
                        {{ $checklist4->capsule_remark_6 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.7</td>
                <td>Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance. </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_7)
                        {{ $checklist4->capsule_response_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_7)
                        {{ $checklist4->capsule_remark_7 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.8</td>
                <td>Are there written instructions describing how to use in-process data to control the process? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_8)
                        {{ $checklist4->capsule_response_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_8)
                        {{ $checklist4->capsule_remark_8 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.9</td>
                <td>Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book. </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_9)
                        {{ $checklist4->capsule_response_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_9)
                        {{ $checklist4->capsule_remark_9 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.10</td>
                <td>Is equipment inspected immediately prior to use? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_10)
                        {{ $checklist4->capsule_response_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_10)
                        {{ $checklist4->capsule_remark_10 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.11</td>
                <td>Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?  </td>


                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_11)
                        {{ $checklist4->capsule_response_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_11)
                        {{ $checklist4->capsule_remark_11 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.12</td>
                <td>Has a written schedule been established and is it followed for cleaning of equipment? </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_12)
                        {{ $checklist4->capsule_response_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_12)
                        {{ $checklist4->capsule_remark_12 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.13</td>
                <td>Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_13)
                        {{ $checklist4->capsule_response_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_13)
                        {{ $checklist4->capsule_remark_13 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.14</td>
                <td>Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_14)
                        {{ $checklist4->capsule_response_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_14)
                        {{ $checklist4->capsule_remark_14 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.15</td>
                <td>Is equipment cleaned promptly after use?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_15)
                        {{ $checklist4->capsule_response_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_15)
                        {{ $checklist4->capsule_remark_15 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.16</td>
                <td> Is there proper storage of cleaned equipment so as to prevent contamination?<td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_16)
                        {{ $checklist4->capsule_response_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_16)
                        {{ $checklist4->capsule_remark_16 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.17</td>
                <td>Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?    <td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_17)
                        {{ $checklist4->capsule_response_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_17)
                        {{ $checklist4->capsule_remark_17 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.18</td>
                <td>Is sewage, trash and other reuse disposed off in a safe and sanitary manner ( and with sufficient frequency)

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_18)
                        {{ $checklist4->capsule_response_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_18)
                        {{ $checklist4->capsule_remark_18 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.19</td>
                <td>Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records. </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_19)
                        {{ $checklist4->capsule_response_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_19)
                        {{ $checklist4->capsule_remark_19 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.20</td>
                <td>
                    Are all weighing and measuring performed by one qualified person and checked by a second person Check the weighing balance record. </td>
                <td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_20)
                        {{ $checklist4->capsule_response_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_20)
                        {{ $checklist4->capsule_remark_20 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.21</td>
                <td>Is the pressure differential of every particular area are within limit?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_21)
                        {{ $checklist4->capsule_response_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_21)
                        {{ $checklist4->capsule_remark_21 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.22</td>
                <td>All the person working in manufacturing area having proper gowning?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_22)
                        {{ $checklist4->capsule_response_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_22)
                        {{ $checklist4->capsule_remark_22 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.23</td>
                <td>Have you any SOP regarding Hold time of material during staging?
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_23)
                        {{ $checklist4->capsule_response_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_23)
                        {{ $checklist4->capsule_remark_23 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.24</td>
                <td>Is there a written procedure specifying the frequency of inspection and replacement for air filters?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_24)
                        {{ $checklist4->capsule_response_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_24)
                        {{ $checklist4->capsule_remark_24 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.25</td>
                <td>Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_25)
                        {{ $checklist4->capsule_response_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_25)
                        {{ $checklist4->capsule_remark_25 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.26</td>
                <td>Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_26)
                        {{ $checklist4->capsule_response_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_26)
                        {{ $checklist4->capsule_remark_26 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.27</td>
                <td>Does the process control address all issues to ensure identity, strength, quality and purity of product?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_27)
                        {{ $checklist4->capsule_response_27}}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_27)
                        {{ $checklist4->capsule_remark_27 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.28</td>
                <td>Check the calibration labels for instrument calibration status.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_28)
                        {{ $checklist4->capsule_response_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_28)
                        {{ $checklist4->capsule_remark_28 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.29</td>
                <td>Temperature & RH record log book is available for each staging area.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_29)
                        {{ $checklist4->capsule_response_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_29)
                        {{ $checklist4->capsule_remark_29 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.30</td>
                <td>Check for area activity record.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_30)
                        {{ $checklist4->capsule_response_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_30)
                        {{ $checklist4->capsule_remark_30 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.31</td>
                <td>Check for equipment usage record.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_31)
                        {{ $checklist4->capsule_response_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_31)
                        {{ $checklist4->capsule_remark_31 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.32</td>
                <td>Check for general equipment details and accessory details.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_32)
                        {{ $checklist4->capsule_response_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_32)
                        {{ $checklist4->capsule_remark_32 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.33</td>
                <td>Check for man & material movement in the area.
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_33)
                        {{ $checklist4->capsule_response_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_33)
                        {{ $checklist4->capsule_remark_33 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.34</td>
                <td>Air handling system qualification, cleaning details and PAO test reports.
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_34)
                        {{ $checklist4->capsule_response_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_34)
                        {{ $checklist4->capsule_remark_34 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.35</td>
                <td>Check for purified water hose pipe status and water hold up.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_35)
                        {{ $checklist4->capsule_response_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_35)
                        {{ $checklist4->capsule_remark_35 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.36</td>
                <td>Check for the status labeling in the area and, material randomly.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_36)
                        {{ $checklist4->capsule_response_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_36)
                        {{ $checklist4->capsule_remark_36 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.37</td>
                <td>Check the in-process equipments cleaning status & records.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_37)
                        {{ $checklist4->capsule_response_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_37)
                        {{ $checklist4->capsule_remark_37 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.38</td>
                <td>Are any unplanned process changes (process excursions) documented in the batch record?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_38)
                        {{ $checklist4->capsule_response_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_38)
                        {{ $checklist4->capsule_remark_38 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.39</td>
                <td>Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_39)
                        {{ $checklist4->capsule_response_39}}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_39)
                        {{ $checklist4->capsule_remark_39 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.40</td>
                <td>Is there is an preventive maintenance program for all equipment and status of it.</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_40)
                        {{ $checklist4->capsule_response_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_40)
                        {{ $checklist4->capsule_remark_40 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.41</td>
                <td>Is there a written procedure for clearing the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_41)
                        {{ $checklist4->capsule_response_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_41)
                        {{ $checklist4->capsule_remark_41 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.42</td>
                <td>Have you any standard procedure for removal of scrap?</td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_42)
                        {{ $checklist4->capsule_response_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_42)
                        {{ $checklist4->capsule_remark_42 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.43</td>
                <td>Is this plant free from infestation by rodents, birds, insects and vermin?   <td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_43)
                        {{ $checklist4->capsule_response_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_43)
                        {{ $checklist4->capsule_remark_43 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">1.44</td>
                <td>Do you have written procedures for the safe use of suitable rodenticides, insecticides, fungicides and fumigating agent? Check the corresponding records. </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_44)
                        {{ $checklist4->capsule_response_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_44)
                        {{ $checklist4->capsule_remark_44 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.1</td>
                <td>Do records have doer & checker signatures?  Check the timings, date and yield etc in the batch production record.     <td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_45)
                        {{ $checklist4->capsule_response_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_45)
                        {{ $checklist4->capsule_remark_45 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.2</td>
                <td>Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports. <td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_46)
                        {{ $checklist4->capsule_response_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_46)
                        {{ $checklist4->capsule_remark_46 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.3</td>
                <td>Is the batch record is on line up to the current stage of a process?
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_47)
                        {{ $checklist4->capsule_response_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_47)
                        {{ $checklist4->capsule_remark_47 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.4</td>
                <td> In process carried out as per the written instruction describe in batch record?
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_48)
                        {{ $checklist4->capsule_response_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_48)
                        {{ $checklist4->capsule_remark_48 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.5</td>
                <td>Is there any area cleaning record available for all individual areas?
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_49)
                        {{ $checklist4->capsule_response_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_49)
                        {{ $checklist4->capsule_remark_49 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center">2.6</td>
                <td> Current version of SOP’s is available in respective areas?
                </td>
                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_response_50)
                        {{ $checklist4->capsule_response_50 }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->capsule_remark_50)
                        {{ $checklist4->capsule_remark_50 }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>




            <tr>
                <td class="flex text-center"></td>
                <td>Final Comment </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->Description_Deviation)
                        {{ $checklist4->Description_Deviation }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <td class="w-20">
                    @if ($checklist4 && $checklist4->Description_Deviation)
                        {{ $checklist4->Description_Deviation }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

        </table>
    </div>












































































































        </table>
    </div>

























































































































































































































































































































































































































































































































































































































































    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Audit Schedule By</th>
                        <td class="w-30">{{ $data->audit_schedule_by }}</td>
                        <th class="w-20">Audit Schedule On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_schedule_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->audit_mgr_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_mgr_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Observation Submitted By</th>
                        <td class="w-30">{{ $data->audit_observation_submitted_by }}</td>
                        <th class="w-20">Supervisor Reviewed On(QA)</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_observation_submitted_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Lead More Info Reqd By
                        </th>
                        <td class="w-30">{{ $data->audit_lead_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Req. On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_lead_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Response Completed By</th>
                        <td class="w-30">{{ $data->audit_response_completed_by }}</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_response_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Response Feedback Verified By</th>
                        <td class="w-30">{{ $data->response_feedback_verified_by }}</td>
                        <th class="w-20">
                            Response Feedback Verified On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->response_feedback_verified_on) }}</td>
                    </tr>


                </table>
            </div>
        </div>
    </div>





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

</body>

</html>
