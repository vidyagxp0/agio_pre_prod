<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>


<style>
    @page {
        margin: 160px 35px 100px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        margin-top: 10px;
        margin-bottom: -60px;
        padding: 0;

        font-family: 'Roboto', sans-serif;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
    }

    header,
    footer {
        position: fixed;
        left: 0;
        right: 0;

        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }

    .inner-block {
        width: 100%;
        box-sizing: border-box;
    }

    .content-table {
        width: 100%;
        box-sizing: border-box;
    }

    .block {
        width: 100%;
        margin-bottom: 25px;
        page-break-inside: auto;
    }

    .block-head {
        margin-bottom: 10px;
        padding-bottom: 5px;

        border-bottom: 2px solid #387478;

        color: #387478;
        font-size: 13px;
        font-weight: bold;

        page-break-after: avoid;
    }

    .table_bg {
        background-color: #f2f2f2;
        color: #111;
    }

    /*
    |--------------------------------------------------------------------------
    | Normal report tables
    |--------------------------------------------------------------------------
    */

    table {
        width: 100%;
        max-width: 100%;

        margin: 0 0 12px 0;

        border-collapse: collapse;
        border-spacing: 0;

        /*
         * Normal form tables ke liye fixed layout.
         * Quill tables ko Style 2 me auto override kiya gaya hai.
         */
        table-layout: fixed;
    }

    th,
    td {
        padding: 6px 10px;

        border: 1px solid #ccc;

        font-size: 10.5px;
        line-height: 1.35;

        text-align: left;
        vertical-align: top;

        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: normal;

        box-sizing: border-box;
    }

    th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    /*
     * Normal short rows ko split hone se rok sakte hain.
     * Long Quill content outer table row me nahi hona chahiye.
     */
    table:not(.quill-inner-table) > tbody > tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border {
        border: none !important;
    }

    .no-border th,
    .no-border td {
        border: none !important;
    }

    .content-area > table.no-border,
    .content-area > table.no-border > tbody > tr > th,
    .content-area > table.no-border > tbody > tr > td {
        border: none !important;
    }

    /*
    |--------------------------------------------------------------------------
    | Width utilities
    |--------------------------------------------------------------------------
    */

    .w-5 {
        width: 6%;
    }

    .w-8 {
        width: 8%;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
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

    .w-100 {
        width: 100%;
    }

    .text-center {
        text-align: center;
    }

    .border-table {
        display: block;
        width: 100%;
        max-width: 100%;

        overflow: visible;

        page-break-inside: auto;
        box-sizing: border-box;
    }

    /*
    |--------------------------------------------------------------------------
    | General images
    |--------------------------------------------------------------------------
    */

    img {
        max-width: 100%;
        height: auto;
    }
</style>

<style>
    .long-content-field {
        display: block;

        width: 100%;
        max-width: 100%;

        margin: 0 0 12px 0;
        padding: 0;

        page-break-inside: auto;

        box-sizing: border-box;
    }

    .long-content-label {
        display: block;

        width: 100%;
        max-width: 100%;

        margin: 0;
        padding: 7px 10px;

        border: 1px solid #ccc;
        background-color: #f2f2f2;

        color: #000;
        font-size: 10.5px;
        line-height: 1.4;
        font-weight: bold;

        text-align: left;

        page-break-after: avoid;

        box-sizing: border-box;
    }

    .long-content-value {
        display: block;

        width: 100%;
        max-width: 100%;

        margin: 0;
        padding: 8px;

        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;

        page-break-inside: auto;

        box-sizing: border-box;
    }

    /*
    |--------------------------------------------------------------------------
    | Main Quill content
    |--------------------------------------------------------------------------
    */

    .quill-pdf-content {
        display: block;

        width: 100% !important;
        max-width: 100% !important;

        margin: 0 !important;
        padding: 0 !important;

        color: #000;

        font-size: 10px;
        line-height: 1.4;

        text-align: left;

        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: normal;

        page-break-inside: auto !important;

        box-sizing: border-box;
    }

    .quill-pdf-content p {
        width: auto !important;
        max-width: 100% !important;

        margin: 0 0 7px 0 !important;
        padding: 0 !important;

        font-size: 10px !important;
        line-height: 1.4 !important;
        font-weight: normal;

        text-align: left !important;

        page-break-inside: auto;
    }

    .quill-pdf-content .proc-heading,
    .quill-pdf-content h1,
    .quill-pdf-content h2,
    .quill-pdf-content h3,
    .quill-pdf-content h4,
    .quill-pdf-content h5,
    .quill-pdf-content h6 {
        margin: 10px 0 5px 0 !important;
        padding: 0 !important;

        font-size: 10px !important;
        line-height: 1.4 !important;
        font-weight: bold !important;

        text-align: left !important;

        page-break-after: avoid;
    }

    .quill-pdf-content span,
    .quill-pdf-content div {
        max-width: 100% !important;

        font-size: inherit;
        line-height: inherit;

        box-sizing: border-box;
    }

    /*
    |--------------------------------------------------------------------------
    | Quill nested tables
    |--------------------------------------------------------------------------
    */

    .quill-pdf-content table {
        display: table !important;

        width: 100% !important;
        max-width: 100% !important;

        margin: 6px 0 10px 0 !important;

        border-collapse: collapse !important;
        border-spacing: 0 !important;

        /*
         * Important:
         * Word/Quill tables ke liye fixed nahi, auto rakho.
         */
        table-layout: auto !important;

        page-break-inside: auto !important;

        box-sizing: border-box !important;
    }

    .quill-pdf-content table thead {
        display: table-header-group;
    }

    .quill-pdf-content table tbody {
        display: table-row-group;
        width: 100% !important;
    }

    .quill-pdf-content table tfoot {
        display: table-footer-group;
    }

    .quill-pdf-content table tr {
        page-break-inside: auto !important;
        page-break-after: auto !important;
    }

    .quill-pdf-content table,
    .quill-pdf-content table th,
    .quill-pdf-content table td {
        border: 1px solid #000 !important;
    }

    .quill-pdf-content table th,
    .quill-pdf-content table td {
        min-width: 0 !important;
        max-width: none !important;

        padding: 4px !important;

        border: 1px solid #000 !important;

        font-size: 8px !important;
        line-height: 1.25 !important;

        text-align: left !important;
        vertical-align: top !important;

        white-space: normal !important;

        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        word-break: normal !important;

        height: auto !important;

        page-break-inside: auto !important;

        box-sizing: border-box !important;
    }

    .quill-pdf-content table th {
        background-color: #f2f2f2 !important;
        font-weight: bold !important;
    }

    .quill-pdf-content table tr:first-child th,
    .quill-pdf-content table tr:first-child td {
        font-weight: bold !important;
    }

    .quill-pdf-content table td p,
    .quill-pdf-content table th p,
    .quill-pdf-content table td div,
    .quill-pdf-content table th div,
    .quill-pdf-content table td span,
    .quill-pdf-content table th span {
        max-width: 100% !important;

        margin: 0 !important;
        padding: 0 !important;

        font-size: 8px !important;
        line-height: 1.25 !important;

        text-align: inherit !important;

        white-space: normal !important;

        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        word-break: normal !important;

        box-sizing: border-box !important;
    }

    .quill-pdf-content table[width] {
        width: 100% !important;
        max-width: 100% !important;
    }

    .quill-pdf-content td[width],
    .quill-pdf-content th[width] {
        width: auto !important;
    }

    /*
    |--------------------------------------------------------------------------
    | Quill lists
    |--------------------------------------------------------------------------
    */

    .quill-pdf-content ul,
    .quill-pdf-content ol {
        margin: 4px 0 8px 0 !important;
        padding-left: 20px !important;

        page-break-inside: auto;
    }

    .quill-pdf-content li {
        margin: 0 0 3px 0 !important;
        padding: 0 !important;

        font-size: 10px !important;
        line-height: 1.4 !important;

        page-break-inside: auto;
    }

    /*
    |--------------------------------------------------------------------------
    | Quill images
    |--------------------------------------------------------------------------
    */

    .quill-pdf-content img {
        display: block !important;

        width: auto !important;
        max-width: 100% !important;
        height: auto !important;

        margin: 6px auto !important;

        page-break-inside: avoid !important;
    }

    /*
    |--------------------------------------------------------------------------
    | Links
    |--------------------------------------------------------------------------
    */

    .quill-pdf-content a {
        color: #000;
        text-decoration: underline;

        word-wrap: break-word;
        overflow-wrap: break-word;
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- @endif --}}

                <div class="long-content-field">

                    <div class="long-content-label">
                        Description of Incident
                    </div>

                    <div class="long-content-value">

                        <div class="quill-pdf-content">
                            {!! Helpers::renderQuillPdf($data->Description_incident) !!}
                        </div>

                    </div>

                </div>

                <div class="long-content-field">

                    <div class="long-content-label">
                        Investigation
                    </div>

                    <div class="long-content-value">

                        <div class="quill-pdf-content">
                            {!! Helpers::renderQuillPdf($data->investigation) !!}
                        </div>

                    </div>

                </div>

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
</body>

</html>
