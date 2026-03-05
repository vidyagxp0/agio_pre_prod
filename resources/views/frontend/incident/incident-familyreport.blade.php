<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
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
                    Incident Report
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
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/INC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30"><strong>Page No.</strong>
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
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/INC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <th class="w-20">Site/Location Code </th>
                        <td class="w-30"> {{ Helpers::getDivisionName($data->division_id) }}</td>


                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ $data->created_at ? $data->created_at->format('d-M-Y') : '' }} </td>

                    </tr>
                </table>
                <table>
                    <tr>

                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiation Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ $data->Initiator_Group }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
                <table>
                    <tr>
                        <th class="w-20">Initiation Department Code</th>
                        <td class="w-80">
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
                        <th class="w-20"> Repeat Incident?</th>
                        <td class="w-30">
                            @if ($data->short_description_required)
                                {{ $data->short_description_required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> Repeat Nature</th>
                        <td class="w-30">
                            @if ($data->nature_of_repeat)
                                {{ $data->nature_of_repeat }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Incident Observed On (Date)</th>
                        <td class="w-30">
                            @if ($data->incident_date)
                                {{ Helpers::getdateFormat($data->incident_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Incident Observed On (Time)</th>
                        <td class="w-30">
                            @if ($data->incident_time)
                                {{ $data->incident_time }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Incident Observed By</th>
                        <td class="w-30">
                            @if ($data->Facility)
                                {{ $data->Facility }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Incident Reported On </th>
                        <td class="w-30">
                            @if ($data->incident_reported_date)
                                {{ Helpers::getdateFormat($data->incident_reported_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{--@php
                            $facilityIds = explode(',', $data->Facility);
                            $users = $facilityIds ? DB::table('users')->whereIn('id', $facilityIds)->get() : [];
                        @endphp

                        <td>
                            @if ($facilityIds && count($users) > 0)
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>--}}

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Incident Related To</th>
                        <td class="w-80">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                       <th class="w-20"> Others</th>
                        <td class="w-80">
                            @if ($data->others)
                                {{ $data->others }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">Delay Justification</th>
                        <td class="w-80">
                            @if ($data->Delay_Justification)
                                {{ $data->Delay_Justification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Department Head</th>
                        <td class="w-30">
                            @if ($data->department_head)
                                {{ Helpers::getInitiatorName($data->department_head) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Facility/ Equipment/ Instrument/ System Details Required?</th>
                        <td class="w-80">
                            @if ($data->Facility_Equipment)
                                {{ ucfirst($data->Facility_Equipment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block">
                    <div class="block-head">
                        Facility/Equipment/Instrument/System Details
                    </div>
                    <div class="border-table">
                        <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                            <thead>
                                <tr class="table_bg">
                                    <th style="width: 5%">Sr. No.</th>
                                    <th style="width: 12%">Name</th>
                                    <th style="width: 16%">ID Number</th>
                                    <th style="width: 15%">Remarks</th>
                                    {{-- <th style="width: 8%">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach (unserialize($grid_data->Remarks) as $key => $temps)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ isset(unserialize($grid_data->facility_name)[$key]) ? unserialize($grid_data->facility_name)[$key] : '' }}

                                        </td>
                                        <td>{{ isset(unserialize($grid_data->IDnumber)[$key]) ? unserialize($grid_data->IDnumber)[$key] : '' }}

                                        </td>
                                        <td>{{ unserialize($grid_data->Remarks)[$key] ? unserialize($grid_data->Remarks)[$key] : '' }}

                                        </td>

                                    </tr>
                                @endforeach

                                    {{-- @if (!empty($remarks))
                                        @foreach ($remarks as $key => $remark)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $facility_names[$key] ?? '' }}</td>
                                                <td>{{ $id_numbers[$key] ?? '' }}</td>
                                                <td>{{ $remark ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="4">No Data Available</td></tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- @endif --}}

                <table>
                    <tr>
                        <th class="w-20">Document Details Required?</th>
                        <td class="w-80">
                            @if ($data->Document_Details_Required)
                                {{ ucfirst($data->Document_Details_Required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block">
                    <div class="block-head">
                        Document Details
                    </div>
                    <div class="border-table">
                        <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                            <thead>
                                <tr class="table_bg">
                                    <th style="width: 4%">Sr. No.</th>
                                    <th style="width: 16%">Document Number</th>
                                    <th style="width: 12%">Document Name</th>
                                    <th style="width: 16%">Remarks</th>

                                    {{-- <th style="width: 8%">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach (unserialize($grid_data1->ReferenceDocumentName) as $key => $temps)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : '' }}</td>


                                        <td>{{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : '' }}</td>

                                        <td>{{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : '' }}

                                        </td>

                                    </tr>
                                @endforeach


                                    {{-- @if (!empty($document_names))
                                        @foreach ($document_names as $key => $doc_name)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $doc_name ?? '' }}</td>
                                                <td>{{ $document_numbers[$key] ?? '' }}</td>
                                                <td>{{ $document_remarks[$key] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="4">No Data Available</td></tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- @endif --}}


                <table>
                    <tr>
                        <th class="w-20">Products / Material Details Required?</th>
                        <td class="w-80">
                            @if ($data->Product_Details_Required)
                                {{ ucfirst($data->Product_Details_Required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block">
                    <div class="block-head">
                        Product / Material Details
                    </div>
                    <div class="border-table">
                        <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                            <thead>
                                <tr class="table_bg">
                                    <th style="width: 4%">Sr. No.</th>
                                    <th style="width: 12%">Product / Material</th>
                                    <th style="width: 16%">Stage</th>
                                    <th style="width: 16%">A.R.No. / Batch No</th>

                                    {{-- <th style="width: 8%">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach (unserialize($grid_data2->product_name) as $key => $temps)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ isset(unserialize($grid_data2->product_name)[$key]) ? unserialize($grid_data2->product_name)[$key] : '' }}

                                        </td>
                                        <td>{{ isset(unserialize($grid_data2->product_stage)[$key]) ? unserialize($grid_data2->product_stage)[$key] : '' }}

                                        </td>
                                        <td>{{ isset(unserialize($grid_data2->batch_no)[$key]) ? unserialize($grid_data2->batch_no)[$key] : '' }}

                                        </td>

                                    </tr>
                                @endforeach

                                    {{-- @if (!empty($product_names))
                                        @foreach ($product_names as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product ?? '' }}</td>
                                                <td>{{ $product_stages[$key] ?? '' }}</td>
                                                <td>{{ $batch_numbers[$key] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="4">No Data Available</td></tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- @endif --}}


                
                <style>
                table {
                    width: 100% !important;
                    max-width: 100% !important;
                    border-collapse: collapse;
                    table-layout: fixed;
                }

                th, td {
                    word-break: break-word;
                    word-wrap: break-word;
                    font-size: 12px;
                }

                tr {
                    page-break-inside: avoid;
                }

                img {
                    max-width: 100% !important;
                    height: auto;
                }
            </style>


                <table style="width:100%; border-collapse: collapse; table-layout: fixed;">
                    <tr>
                        <th class="w-20" style="vertical-align: top;">
                            <strong>Description of Incident</strong>
                        </th>
                        <td class="w-80" style="vertical-align: top; word-break: break-word;">
                            
                            {!! strip_tags(
                                $data->Description_incident,
                                '<br><table><thead><tbody><tr><th><td>
                                <p><div><span>
                                <b><strong><i><u>
                                <ul><ol><li>
                                <img><a>
                                <h1><h2><h3><h4><h5><h6>'
                            ) !!}
                        </td>
                    </tr>
                </table>

                 <table style="width:100%; border-collapse: collapse; table-layout: fixed;">
                    <tr>
                        <th class="w-20" style="vertical-align: top;">
                            <strong>Investigation</strong>
                        </th>
                        <td class="w-80" style="vertical-align: top; word-break: break-word;">
                            
                            {!! strip_tags(
                                $data->investigation,
                                '<br><table><thead><tbody><tr><th><td>
                                <p><div><span>
                                <b><strong><i><u>
                                <ul><ol><li>
                                <img><a>
                                <h1><h2><h3><h4><h5><h6>'
                            ) !!}
                        </td>
                    </tr>
                </table>

                


                <table>
                    <tr>
                        <th class="w-20">Immediate Corrective Action</th>
                        <td class="w-80">
                            @if ($data->immediate_correction)
                                {{ $data->immediate_correction }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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
                    @if ($data->Audit_file)
                        @foreach (json_decode($data->Audit_file) as $key => $file)
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
                    HOD initial Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Review Of Incident And Verification Of Effectiveness Of Correction</th>
                        <td class="w-80">
                            @if ($data->review_of_verific)
                                {{ $data->review_of_verific }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Recommendations</th>
                        <td class="w-80">
                            @if ($data->Recommendations)
                                {{ $data->Recommendations }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">
                            Impact Assessment</th>
                        <td class="w-80">
                            @if ($data->Impact_Assessmenta)
                                {{ $data->Impact_Assessmenta }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Remark</th>
                        <td class="w-80">
                            @if ($data->HOD_Remarks)
                                {{ $data->HOD_Remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                    HOD Attachments
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
                    QA Initial Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">
                            Product Quality Impact</th>
                        <td class="w-30">
                            @if ($data->product_quality_imapct)
                                {{ Ucfirst($data->product_quality_imapct) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                            Process Performance Impact</th>
                        <td class="w-30">
                            @if ($data->process_performance_impact)
                                {{ Ucfirst($data->process_performance_impact )}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">
                            Yield Impact</th>
                        <td class="w-30">
                            @if ($data->yield_impact)
                                {{ Ucfirst($data->yield_impact) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                            GMP Impact</th>
                        <td class="w-30">
                            @if ($data->gmp_impact)
                                {{ Ucfirst($data->gmp_impact)}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">
                            Additional Testing Required</th>
                        <td class="w-80">
                            @if ($data->additionl_testing_required)
                                {{ Ucfirst($data->additionl_testing_required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                        <th class="w-20">
                            If Yes, Then Mention  
                        </th>
                        <td class="w-80">
                            @if ($data->any_similar_incident_in_past)
                                {{ $data->any_similar_incident_in_past }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">
                            Any Similar Incident in Past</th>
                        <td class="w-30">
                            @if ($data->capa_require)
                                {{ $data->capa_require }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                            Classification by QA</th>
                        <td class="w-30">
                            @if ($data->classification_by_qa)
                                {{ $data->classification_by_qa }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">
                            QA Initial Review Remarks</th>
                        <td class="w-80">
                            @if ($data->QAInitialRemark)
                                {{ $data->QAInitialRemark }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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
                    @if ($data->Initial_attachment)
                        @foreach (json_decode($data->Initial_attachment) as $key => $file)
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
                    QA Head/Designee Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Head/Designee Approval Comment</th>
                        <td class="w-80">
                            @if ($data->qa_head_deginee_comment)
                                {{ $data->qa_head_deginee_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>


            <div class="border-table">
                <div class="block-head">
                    QA Head/Designee Approval Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_head_deginee_attachments)
                        @foreach (json_decode($data->qa_head_deginee_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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

            <div class="block">
                <div class="block-head">
                    Initiator Update
                </div>
                <table>
                    <tr>
                        <th class="w-20">
                            CAPA Implementation</th>
                        <td class="w-30">
                            @if ($data->capa_implementation)
                                {{Ucfirst($data->capa_implementation) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                        All check points compiled with (Documentary evidence shall be attached or referred to)</th>
                        <td class="w-30">
                            @if ($data->check_points)
                                {{ Ucfirst($data->check_points) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">
                            Based upon the assessment of the corrective actions planned, whether unplanned deviation
                            is
                            required</th>
                        <td class="w-30">
                            @if ($data->corrective_actions)
                                {{ Ucfirst($data->corrective_actions) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                            Batch release satisfactory</th>
                        <td class="w-30">
                            @if ($data->batch_release)
                                {{ Ucfirst($data->batch_release) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">
                            Affected documents closed</th>
                        <td class="w-80">
                            @if ($data->affected_documents)
                                {{ Ucfirst($data->affected_documents) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">
                            Initiator Update Comments</th>
                        <td class="w-80">
                            @if ($data->QA_Feedbacks)
                                {{ $data->QA_Feedbacks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                    Initiator Update Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->QA_attachments)
                        @foreach (json_decode($data->QA_attachments) as $key => $file)
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
                    HOD Final Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">
                            HOD Final Review Comments</th>
                        <td class="w-80">
                            @if ($data->qa_head_Remarks)
                                {{ $data->qa_head_Remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_head_attachments)
                        @foreach (json_decode($data->qa_head_attachments) as $key => $file)
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

            {{--<div class="border-table">--}}
                <div class="block-head">
                    QA Final Review
                </div>

                <table>
                    <tr>
                        <th class="w-20">
                            QA Final Review Comments</th>
                        <td class="w-80">
                            @if ($data->qa_final_review)
                                {{ $data->qa_final_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            {{--</div>--}}

            <div class="border-table">
                <div class="block-head">
                    QA Final Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_ra_attachments)
                        @foreach (json_decode($data->qa_final_ra_attachments) as $key => $file)
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


{{--@php
    dd($data->Disposition_Batch);
@endphp--}}

            {{--<div class="border-table">--}}
                <div class="block-head">
                    QAH/Designee Closure Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">
                            Closure Comments</th>
                        <td class="w-80">
                            @if ($data->Closure_Comments)
                                {{ $data->Closure_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">
                            Disposition of Batch</th>
                        <td class="w-80">
                            @if ($data->Disposition_Batch)
                                {{ $data->Disposition_Batch }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            {{--</div>--}}

            <div class="border-table">
                <div class="block-head">
                    Closure Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->closure_attachment)
                        @foreach (json_decode($data->closure_attachment) as $key => $file)
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
                <div class="block-head">Activity Log</div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">
                            @if ($data->submit_by)
                                {{ $data->submit_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">
                            @if ($data->submit_on)
                                {{ $data->submit_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>    
                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">
                            @if ($data->submit_comment)
                                {{ $data->submit_comment }}
                            @else
                               Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">HOD Initial Review Complete By</th>
                        <td class="w-30">
                            @if ($data->HOD_Initial_Review_Complete_By)
                                {{ $data->HOD_Initial_Review_Complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">HOD Initial Review Complete On</th>
                        <td class="w-30">
                            @if ($data->HOD_Initial_Review_Complete_On)
                                {{ $data->HOD_Initial_Review_Complete_On }}
                            @else
                                 Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                        <th class="w-20">HOD Initial Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->HOD_Initial_Review_Comments)
                                {{ $data->HOD_Initial_Review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">QA Initial Review Complete By</th>
                        <td class="w-30">
                            @if ($data->QA_Initial_Review_Complete_By)
                                {{ $data->QA_Initial_Review_Complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">
                            @if ($data->QA_Initial_Review_Complete_On)
                                {{ $data->QA_Initial_Review_Complete_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                        <th class="w-20">QA Initial Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->QA_Initial_Review_Comments)
                                {{ $data->QA_Initial_Review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">QAH/Designee Approval Complete By</th>
                        <td class="w-30">
                            @if ($data->QAH_Designee_Approval_Complete_By)
                                {{ $data->QAH_Designee_Approval_Complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QAH/Designee Approval Complete On</th>
                        <td class="w-30">
                            @if ($data->QAH_Designee_Approval_Complete_On)
                                {{ $data->QAH_Designee_Approval_Complete_On }}
                            @else
                                Not Applicable
                            @endif
                            </td>
                    </tr>
                </table>
                <table>    
                    <tr>        
                        <th class="w-20">QAH/Designee Approval Complete Comment</th>
                        <td class="w-80">
                            @if ($data->QAH_Designee_Approval_Complete_Comments)
                                {{ $data->QAH_Designee_Approval_Complete_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">Pending Initiator Update Complete By</th>
                        <td class="w-30">
                            @if ($data->Pending_Review_Complete_By)
                                {{ $data->Pending_Review_Complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Pending Initiator Update Complete On</th>
                        <td class="w-30">
                            @if ($data->Pending_Review_Complete_On)
                                {{ $data->Pending_Review_Complete_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                        <th class="w-20">Pending Initiator Update Complete Comment</th>
                        <td class="w-80">
                            @if ($data->Pending_Review_Comments)
                                {{ $data->Pending_Review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">HOD Final Review Complete By</th>
                        <td class="w-30">
                            @if ($data->Hod_Final_Review_Complete_By)
                                {{ $data->Hod_Final_Review_Complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">HOD Final Review Complete On</th>
                        <td class="w-30">
                            @if ($data->Hod_Final_Review_Complete_On)
                                {{ $data->Hod_Final_Review_Complete_On }}
                            @else
                                Not Applicable
                            @endif
                            </td>
                    </tr>
                </table> 
                <table>   
                    <tr>        
                        <th class="w-20">HOD Final Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->Hod_Final_Review_Comments)
                                {{ $data->Hod_Final_Review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">QA Final Review Complete By</th>
                        <td class="w-30">
                            @if ($data->QA_Final_Review_Complete_By)
                                {{ $data->QA_Final_Review_Complete_By }}
                            @else
                                 Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Final Review Complete On</th>
                        <td class="w-30">
                            @if ($data->QA_Final_Review_Complete_On)
                                {{ $data->QA_Final_Review_Complete_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>    
                        <th class="w-20">QA Final Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->QA_Final_Review_Comments)
                                {{ $data->QA_Final_Review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">
                            @if ($data->QA_head_approved_by)
                                {{ $data->QA_head_approved_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">
                            @if ($data->QA_head_approved_on)
                                {{ $data->QA_head_approved_on }}
                            @else
                                 Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>    
                        <th class="w-20">Approved Comment</th>
                        <td class="w-80">
                            @if ($data->QA_head_approved_comment)
                                {{ $data->QA_head_approved_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">
                            @if ($data->Cancelled_by)
                                {{ $data->Cancelled_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">
                            @if ($data->Cancelled_on)
                                {{ $data->Cancelled_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>            
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-80">
                            @if ($data->Cancelled_cmt)
                                {{ $data->Cancelled_cmt }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

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
        
             @if ($rootCauseAnalysis->isNotEmpty())
    @foreach ($rootCauseAnalysis as $data)
            <center>
                <h3>Root Cause Analysis Report</h3>
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




        {{-- <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Methodology </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_methodology)
                            {{ $data->root_cause_methodology }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Description</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_description)
                            {{ $data->root_cause_description }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Investigation Summary</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->investigation_summary)
                            {{ $data->investigation_summary }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
        <!-- <tr>
                            <th class="w-20">Attachments</th>
                            <td class="w-80">
            @if ($data->attachments)
            <a href="{{ asset('upload/document/', $data->attachments) }}">{{ $data->attachments }}
            @else
            Not Applicable
            @endif
            </td>
            </tr> -->
        {{-- <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                        </tr>
                      --}}
        </table>
        {{-- <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Root Cause
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Sr.No.</th>
                            <th class="w-30">Root Cause Category</th>
                            <th class="w-30">Root Cause Sub-Category</th>
                            <th class="w-30">Probability</th>
                            <th class="w-30">Remarks</th>
                        </tr>
                        {{-- @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
        {{-- @if (!empty($data->Root_Cause_Category))
                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                    </td>
                                    <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div> --}}


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

                {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if ($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if ($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if ($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}


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
                    {{-- <th class="w-20">QA Review Complete Comment</th>
                                            <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                </tr>
                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if ($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if ($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if ($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                </tr> --}}

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
                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if ($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if ($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if ($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                </tr> --}}


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

                {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if ($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if ($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if ($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
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

                {{-- <tr>
                                            <th class="w-20">More Info Required By
                                            </th>
                                            <td class="w-30"> @if ($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if ($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if ($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
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
                {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
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
    </div>

    <div class="inner-block">
            @if ($actionitem->isNotEmpty())
    @foreach ($actionitem as $data)
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


</body>

</html>
