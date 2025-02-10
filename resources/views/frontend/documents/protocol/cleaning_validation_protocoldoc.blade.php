<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DMS Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> --}}

    <style>
        * {
            font-family: "Open Sans", "Roboto", "Noto Sans KR", "Poppins", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        .symbol-support {
            font-family: "DeJaVu Sans Mono", monospace !important;
        }

        html {
            text-align: justify;
            text-justify: inter-word;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        td,
        th {
            text-align: center;
            padding: 8px;
        }

        .w-5 {
            width: 5%;
        }

        .w-10 {
            width: 10%;
        }

        .w-15 {
            width: 15%;
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

        .w-33 {
            width: 33%;
        }

        .w-35 {
            width: 35%;
        }

        .w-40 {
            width: 40%;
        }

        .w-45 {
            width: 45%;
        }

        .w-50 {
            width: 50%;
        }

        .w-55 {
            width: 55%;

        }

        .w-60 {
            width: 60%;
        }

        .w-65 {
            width: 65%;
        }

        .w-70 {
            width: 70%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-90 {
            width: 90%;
        }

        .w-95 {
            width: 95%;
        }

        .w-100 {
            width: 100%;
        }

        .border {
            border: 1px solid black;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .border-left {
            border-left: 1px solid black;
        }

        .border-right {
            border-right: 1px solid black;
        }

        .border-top-none {
            border-top: 0px solid black;
        }

        .border-bottom-none {
            border-bottom: 0px solid black;
        }

        .border-left-none {
            border-left: 0px solid black;
        }

        .border-right-none {
            border-right: 0px solid black;
        }

        .p-20 {
            padding: 20px;
        }

        .p-10 {
            padding: 10px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }

        .mb-40 {
            margin-bottom: 40px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .text-left {
            text-align: left;
            word-wrap: break-word;
        }

        .text-right {
            text-align: right;

        }

        .text-justify {
            text-align: justify;

        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .vertical-baseline {
            vertical-align: baseline;
        }

        table.table-bordered {
            border-collapse: collapse;
            border: 1px solid grey;

        }

        table.table-bordered td,
        table.table-bordered th {
            border: 1px solid grey;
            padding: 5px 10px;

        }

        table.small-content td,
        table.small-content th {
            font-size: 0.85rem;

        }

        td.title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        td.logo img {
            width: 100%;
            max-width: 100px;
            aspect-ratio: 1/0.35;

        }

        td.doc-num {
            font-size: 1rem;
            font-weight: bold;

        }

        .doc-control .head {
            max-width: 600px;
            margin: 0 auto 30px;

        }

        .doc-control .head div:nth-child(1) {
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;

        }

        .doc-control .body .block-head {
            border-bottom: 2px solid black;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* @page {
            size: A4;
            margin-top: 220px;
            margin-bottom: 60px;
        } */

        /* header {
            width: 100%;
            position: fixed;
            top: -215px;
            right: 0;
            left: 0;
            display: block;

        } */

        /* .footer {
            position: fixed;
            bottom: -45px;
            left: 0;
            right: 0;
            width: 100%;
            display: block;
            border-top: 1px solid #ddd;
        } */

        @page {
            size: A4;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        body {
            margin-top: 190px;
            margin-bottom: 100px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            margin-top: 20px;
        }



        .other-container {
            margin: 0 0 0 0;

        }

        .other-container>table {
            margin: 0px 0 0;

        }

        .scope-block,
        .procedure-block {
            margin: 0px 0 15px;
            word-wrap: break-word;
        }

        .annexure-block {
            margin: 40px 0 0;
        }

        .empty-page {
            page-break-after: always;
        }

        #pdf-page {
            /* page-break-inside: avoid; */
        }

        .page-break-before {
            page-break-before: always;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
            box-sizing: border-box;

        }

        .MsoNormalTable tr {
            border: 1px solid rgb(156, 156, 156);
        }

        .MsoNormalTable td {
            text-align: left !important;
        }
        .MsoNormalTable td, .table td {
            word-wrap: break-word;
            padding: 10px;
        }

        .MsoNormalTable tbody {
            border: 1px solid rgb(156, 156, 156);
        }

        img {
            width: 100%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            page-break-after: auto;
            page-break-inside: auto;
            page-break-before: auto;
        }

        .MsoNormalTable,
        .table {
            table-layout: fixed;
            width: 100% !important;
            box-sizing: border-box;
        }

        /* CSS to allow page breaks after and inside common HTML elements */
        p,
        b,
        div,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        ol,
        ul,
        li,
        span {
            page-break-after: auto;
            /* Allows automatic page breaks after these elements */
            page-break-inside: auto;
            /* Allows page breaks inside these elements */
        }

        /* Additional styles to ensure list items are handled correctly */
        ol,
        ul {
            page-break-before: auto;
            /* Allows page breaks before lists */
            page-break-inside: auto;
            /* Prefer avoiding breaks inside lists */
        }

        li {
            page-break-after: auto;
            /* Allows automatic page breaks after list items */
            page-break-inside: auto;
            /* Prefer avoiding breaks inside list items */
        }

        /* Handling headings to maintain section integrity */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            page-break-after: auto;
            /* Avoids breaking immediately after headings */
            page-break-inside: auto;
            /* Avoids breaking inside headings */
            page-break-before: auto;
            /* Allows automatic page breaks before headings */
        }

        .main-section {
            text-align: left;
        }
        
    </style>

    <style>

            /*Main Table Styling */
            #isPasted {
                width: 650px !important;
                border-collapse: collapse;
                table-layout: auto; /* Adjusts column width dynamically */
            }

            /* First column adjusts to its content */
            #isPasted td:first-child,
            #isPasted th:first-child {
                white-space: nowrap; /* Prevent wrapping */
                width: 1%; /* Shrink to fit content */
                vertical-align: top;
            }

            /* Second column takes remaining space */
            #isPasted td:last-child,
            #isPasted th:last-child {
                width: auto; /* Take remaining space */
                vertical-align: top;
                
            }

            /* Common Table Cell Styling */
            #isPasted th,
            #isPasted td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
                max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            }

            /* Paragraph Styling Inside Table Cells */
            #isPasted td > p {
                text-align: justify;
                text-justify: inter-word;
                margin: 0;
                max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            }

            #isPasted img {
                max-width: 500px !important; /* Ensure image doesn't overflow the cell */
                height: 100%; /* Maintain image aspect ratio */
                display: block; /* Remove extra space below the image */
                margin: 5px auto; /* Add spacing and center align */
            }

            /* If you want larger images */
            #isPasted td img {
                max-width: 400px !important; /* Adjust this to your preferred maximum width */
                height: 300px;
                margin: 5px auto;
            }
    </style>

</head>

<body>

    <header class="">
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="logo w-15" rowspan="2"  style="vertical-align: top;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 100px; max-width: 60px;">
                    </td>
                    <td class="title w-60"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center; font-weight:bold  border-bottom: 1px solid #686868;" >TITTLE</p>
                        {{-- <hr style="border: 0; border-top: 1px solid #686868; margin: 0;"> --}}
                        </td>
                        <td style="border: 1px solid black; text-align: center;">
                         PROTOCOL NO.:
                        </td>

                </tr>
               
                <tr>
                    <td style="border: 1px solid black;">CLEANING VALIDATION PROTOCOL</td>
                    <td style="border: 1px solid black;">EFFECTIVE DATE:</td>
                </tr>
                <tr>
                   <td style="border: 1px solid black;">PAGE NO.</td>
                   <td style="border: 1px solid black;">DEPARTMENT: </td>
                   <td style="border: 1px solid black;">SUPERSEDES NO:</td>

                </tr>
            </tbody>
        </table>

       


        {{-- <table class="border border-top-none" border="1"
            style="border-collapse: collapse; width: 100%; text-align: left;">
            <tbody>
                <tr>
                    <td style="width: 35%; padding: 5px; text-align: left" class="doc-num">Name of Area</td>
                    <td style="width: 65%; padding: 5px; text-align: left">
                        {{ Helpers::getFullDepartmentName($data->department_id) }}</td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" border="1"
            style="border-collapse: collapse; width: 100%; text-align: left;">
            <tbody>
                <tr>
                    <td style="width: 35%; padding: 5px; text-align: left" class="doc-num">Document Name</td>
                    <td style="width: 65%; padding: 5px; text-align: left">
                        {{ Helpers::getFullDepartmentName($data->department_id) }}</td>
               
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" border="1"
            style="border-collapse: collapse; width: 100%; text-align: left;">
            <tbody>

                <tr style="height:10px">
                    <td style="width: 35%; padding: 5px; text-align: left" class="doc-num">Document Number:</td>
                    <td style="width: 30%; padding: 5px; text-align: left" class="doc-num">Supersedes No.:</td>
                    <td style="width: 35%; padding: 5px; text-align: left" class="doc-num">Effective Date:</td>
                </tr>
                <tr>
                    <td style="width: 35%; padding: 5px; text-align: left">
                     @if($document->revised == 'Yes')
                        @php
                            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
                        @endphp

                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @else
                                {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @endif
                        @else
                        @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                            {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                        @else
                            {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                        @endif
                     @endif
                    </td>

                    <td style="width: 30%; padding: 5px; text-align: left">
                        @php
                            $temp = DB::table('document_types')
                                ->where('name', $document->document_type_name)
                                ->value('typecode');
                        @endphp
                        @if ($document->revised === 'Yes')
                        {{ $document->department_id }}/00{{ $document->revised_doc }}-0{{ $document->major }}
                        @else
                        -
                        @endif
                    </td>

                    <td style="width: 35%; padding: 5px; text-align: left">
                        @if ($data->training_required == 'yes')
                            @if ($data->stage >= 10)
                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                            @endif
                        @else
                            @if ($data->stage > 7)
                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                            @endif
                        @endif
                    </td>
                    
                </tr>
            </tbody>
        </table> --}}
    </header>
    
    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
        {{-- <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;"></th>
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Prepared By</th>
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Checked By</th>
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Approved By</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;">
                    @php
                        $inreviews = DB::table('stage_manages')
                            ->join('users', 'stage_manages.user_id', '=', 'users.id')
                            ->select('stage_manages.*', 'users.name as user_name')
                            ->where('document_id', $document->id)
                            ->where('stage', 'Review-Submit')
                            ->where('deleted_at', null)
                            ->get();
                    @endphp
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Sign</th>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">  
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif          
                    @php
                        $inreview = DB::table('stage_manages')
                            ->join('users', 'stage_manages.user_id', '=', 'users.id')
                            ->select('stage_manages.*', 'users.name as user_name')
                            ->where('document_id', $document->id)
                            ->where('stage', 'Approval-Submit')
                            ->where('deleted_at', null)
                            ->get();

                    @endphp
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">  
                    @if ($inreview->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreview as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif                    
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Date</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                     {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $temp)
                           <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif 
                    </td>

                    <td style="padding: 10px; border: 1px solid #ddd;">
                    @if ($inreview->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreview as $temp)
                           <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif                    
                    </td>
                </tr> 
            </tbody>
        </table> --}}
        <span> Format No. : QA/002/F4-02</span>
    </footer>




    
   
<!-- 
    <h4 style="text-align: center;">Annexure - IV</h4>



    <h1 style="text-align: center; font-size: 40px; font-weight: bold;">CLEANING VALIDATION PROTOCOL </h1>

    <table border="1">
        <tr>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">RESPONSIBILITY</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">DEPARTMENT</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">NAME</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">DESIGNATION</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">SIGN & DATE</td>
        </tr>
        <tr>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">PREPARED BY</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Quality Assurance</td>
            <td style="width: 20%; height: 50px; border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px; border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px; border: 1px solid black;"></td>
        </tr>
        
        <tr>
        <td rowspan="5" style="width: 20%; height: 200px; text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid black;">CHECKED BY</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Quality Assurance</td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;   border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
        </tr>
        <tr>
        <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Quality Control</td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
        </tr>
        <tr>
        <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Production</td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
        </tr>
        <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Engineering </td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>

        </tr>
        <tr>
        <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">F& D </td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
        </tr>
        <tr>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">AUTHORIZED BY</td>
            <td style="width: 20%; height: 50px; text-align: center; font-weight: bold; border: 1px solid black;">Quality Assurance</td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
            <td style="width: 20%; height: 50px;  border: 1px solid black;"></td>
        </tr>
    </table>


            <section>
            <h4 style="font-size: 16px; font-weight: bold; text-align:center">Annexure - IV</h4>

               

                <div class="table-responsive retrieve-table">
                    <table class="table table-bordered" id="distribution-list">
                        <thead style="width:20%">
                            <tr>
                                <th style="font-size: 16px; font-weight: bold; width:10%">SR. NO.</th>
                                <th style="font-size: 16px; font-weight: bold; width:78%">TABLE OF CONTENTS</th>
                                <th style="font-size: 16px; font-weight: bold; width:12%">PAGE NUMBER</th>
                            </tr>
                        </thead>
                        <tbody style="">
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">1.0</td>
                                <td style="text-align:left">Objective</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">2.0</td>
                                <td style="text-align:left">Scope</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">3.0</td>
                                <td style="text-align:left">Purpose</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">4.0</td>
                                <td style="text-align:left">Responsibilities</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">5.0</td>
                                <td style="text-align:left">Identification of most sensitive product for 
                                    contamination on the basis of maximum daily dose & minimum batch size</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">6.0</td>
                                <td style="text-align:left">Matrix Worst Case Approach Table- based on Risk analysis</td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">7.0</td>
                                <td style="text-align:left">Acceptance criteria</td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">8.0</td>
                                <td style="text-align:left">List of equipment  with internal Surface area of each equipment in sq.cm	</td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">9.0</td>
                                <td style="text-align:left">Identification of difficult to clean surfaces of equipment (Table & drawing) facility)</td>
                                <td style="font-weight: bold;"></td>
                            </tr> 
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">10</td>
                                <td style="text-align:left">The sampling methods used as per product specific requirement </td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">11</td>
                                <td style="text-align:left">Recovery studies</td>
                                <td style="font-weight: bold;"></td>
                            </tr>

                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">12</td>
                                <td style="text-align:left">Calculating carry over for swab for routine monitoring</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">13</td>
                                <td style="text-align:left">Calculating carry over for rinse analysis for routine monitoring</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">14</td>
                                <td style="text-align:left">General Procedure to perform Cleaning Validation </td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">15</td>
                                <td style="text-align:left">Analytical method validation studies protocol & report</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">16</td>
                                <td style="text-align:left">List of cleaning SOPs & identification of variables</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">17</td>
                                <td style=" text-align:left">Cleaning validation exercise</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">18</td>
                                <td style=" text-align:left">Evaluation of analytical results of the samples</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">19</td>
                                <td style=" text-align:left">Summary & conclusion</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">20</td>
                                <td style="text-align:left">Training</td>
                                <td style="font-weight: bold;"></td>
                            </tr>

                        </tbody>
                    </table>
                </div> -->

                    
                <div class="other-container" style="margin-top:1.5rem">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">1.</th>
                                    <th class="text-left">
                                        <div class="bold">Objective :</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="scope-block">
                            <div class="w-100">
                                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                    <div class="w-100">
                                        <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->objective_cvpd) &&
                                                is_array(unserialize($data->document_content->objective_cvpd)))
                                            @foreach (unserialize($data->document_content->objective_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">1.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif


                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="other-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">2.</th>
                                    <th class="text-left">
                                        <div class="bold">Scope :</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="scope-block">
                            <div class="w-100">
                                <div class="w-100" style="display:inline-block;">
                                    <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->scope_cvpd) &&
                                                is_array(unserialize($data->document_content->scope_cvpd)))
                                            @foreach (unserialize($data->document_content->scope_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">2.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif


                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">3.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Purpose :</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->purpose_cvpd) &&
                                                is_array(unserialize($data->document_content->purpose_cvpd)))
                                            @foreach (unserialize($data->document_content->purpose_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">3.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">4.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Responsibilities :</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->responsibilities_cvpd) &&
                                                is_array(unserialize($data->document_content->responsibilities_cvpd)))
                                            @foreach (unserialize($data->document_content->responsibilities_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">4.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- REFERENCES START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">5.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Identification of most sensitive product for contamination on the basis of
                                    maximum daily dose & minimum batch size :</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php $i = 1; @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->identification_sensitive_product_contamination_cvpd) &&
                                                is_array(unserialize($data->document_content->identification_sensitive_product_contamination_cvpd)))
                                            @foreach (unserialize($data->document_content->identification_sensitive_product_contamination_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">5.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- REFERENCES END --}}

                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">6.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Matrix Worst Case Approach Table- based on Risk analysis :</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->matrix_worstcase_approach_cvpd) &&
                                                is_array(unserialize($data->document_content->matrix_worstcase_approach_cvpd)))
                                            @foreach (unserialize($data->document_content->matrix_worstcase_approach_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">6.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DEFINITIONS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">7.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Acceptance criteria :</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->acceptance_criteria_cvpd) &&
                                                is_array(unserialize($data->document_content->acceptance_criteria_cvpd)))
                                            @foreach (unserialize($data->document_content->acceptance_criteria_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">7.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- DEFINITIONS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">8.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">List of equipment with internal Surface area of each equipment in sq.cm :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->list_equipment_internal_surface_cvpd) &&
                                                is_array(unserialize($data->document_content->list_equipment_internal_surface_cvpd)))
                                            @foreach (unserialize($data->document_content->list_equipment_internal_surface_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">8.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">9.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Identification of difficult to clean surfaces of equipment (Table & drawing)
                                    facility :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->identification_clean_surfaces_cvpd) &&
                                                is_array(unserialize($data->document_content->identification_clean_surfaces_cvpd)))
                                            @foreach (unserialize($data->document_content->identification_clean_surfaces_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">9.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">10</th>
                                <th class="w-95 text-left">
                                    <div class="bold">The sampling methods used as per product specific requirement :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->sampling_method_cvpd) &&
                                                is_array(unserialize($data->document_content->sampling_method_cvpd)))
                                            @foreach (unserialize($data->document_content->sampling_method_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">10.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">11.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Recovery studies :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->recovery_studies_cvpd) &&
                                                is_array(unserialize($data->document_content->recovery_studies_cvpd)))
                                            @foreach (unserialize($data->document_content->recovery_studies_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">11.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">12.</th>
                                <th class="w-95 text-left">
                                    <div class="bold"> Calculating carry over for swab for routine monitoring :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->calculating_carry_over_cvpd) &&
                                                is_array(unserialize($data->document_content->calculating_carry_over_cvpd)))
                                            @foreach (unserialize($data->document_content->calculating_carry_over_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">12.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">13.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Calculating carry over for rinse analysis for routine monitoring :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->calculating_rinse_analysis_cvpd) &&
                                                is_array(unserialize($data->document_content->calculating_rinse_analysis_cvpd)))
                                            @foreach (unserialize($data->document_content->calculating_rinse_analysis_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">13.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">14.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">General Procedure to perform Cleaning Validation :</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->general_procedure_clean_cvpd) &&
                                                is_array(unserialize($data->document_content->general_procedure_clean_cvpd)))
                                            @foreach (unserialize($data->document_content->general_procedure_clean_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">14.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- Abbreviations START --}}
                        <table class="mb-15">
                            <tbody>
                                <tr>
                                    <th class="w-5 vertical-baseline">15.</th>
                                    <th class="w-95 text-left">
                                        <div class="bold"> Analytical method validation studies protocol & report :</div>
                                    </th>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->analytical_method_validation_cvpd) &&
                                                is_array(unserialize($data->document_content->analytical_method_validation_cvpd)))
                                            @foreach (unserialize($data->document_content->analytical_method_validation_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp
                                                @if (!empty($res))
                                                    <div style="position: relative;">
                                                        <span
                                                            style="position: absolute; left: -2.5rem; top: 0;">15.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                        {!! nl2br($res) !!} <br>
                                                    </div>
                                                @endif
                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Abbreviations END --}}

                    {{-- Deviation if any --}}
                    


                        <table class="mb-15">
                            <tbody>
                                <tr>
                                    <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                        <span>16.</span> 
                                    </td>
                                    <td class="w-95 text-left">
                                        <span class="bold">List of cleaning SOPs & identification of variables:</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="procedure-block">
                        <div class="w-100">
                        <div class="w-100" style="display: flex; flex-wrap: wrap;">
                                <div class="w-100" style="width: 100%;">
                                    <div style="height: auto; overflow-x: auto; width: 650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp

                                        @if ($data->document_content && 
                                            !empty($data->document_content->list_cleaning_sop_cvpd) && 
                                            is_array(unserialize($data->document_content->list_cleaning_sop_cvpd)))
                                            
                                            @foreach (unserialize($data->document_content->list_cleaning_sop_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            16.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
                                                        </span>
                                                        {!! nl2br(e($res)) !!} <br>
                                                    </div>
                                                @endif

                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;  // Reset sub-index for new main item
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Deviation if any end--}}

                    <br>
                    {{-- Change control START --}}
                  
                    

                    
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                    <span>17.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Cleaning validation exercise:</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="procedure-block">
                        <div class="w-100">
                        <div class="w-100" style="display: flex; flex-wrap: wrap;">
                                <div class="w-100" style="width: 100%;">
                                    <div style="height: auto; overflow-x: auto; width: 650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp

                                        @if ($data->document_content && 
                                            !empty($data->document_content->clean_validation_exercise_cvpd) && 
                                            is_array(unserialize($data->document_content->clean_validation_exercise_cvpd)))
                                            
                                            @foreach (unserialize($data->document_content->clean_validation_exercise_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            17.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
                                                        </span>
                                                        {!! nl2br(e($res)) !!} <br>
                                                    </div>
                                                @endif

                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;  // Reset sub-index for new main item
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 



                   

                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                    <span>18.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Evaluation of analytical results of the samples :</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display: flex; flex-wrap: wrap;">
                                <div class="w-100" style="width: 100%;">
                                    <div style="height: auto; overflow-x: auto; width: 650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp

                                        @if ($data->document_content && 
                                            !empty($data->document_content->evaluation_analytical_result_cvpd) && 
                                            is_array(unserialize($data->document_content->evaluation_analytical_result_cvpd)))
                                            
                                            @foreach (unserialize($data->document_content->evaluation_analytical_result_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            18.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
                                                        </span>
                                                        {!! nl2br(e($res)) !!} <br>
                                                    </div>
                                                @endif

                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;  // Reset sub-index for new main item
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    



                   

                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                    <span>19.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Summary & Conclusion:</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display: flex; flex-wrap: wrap;">
                                <div class="w-100" style="width: 100%;">
                                    <div style="height: auto; overflow-x: auto; width: 650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp

                                        @if ($data->document_content && 
                                            !empty($data->document_content->summary_conclusion_cvpd) && 
                                            is_array(unserialize($data->document_content->summary_conclusion_cvpd)))
                                            
                                            @foreach (unserialize($data->document_content->summary_conclusion_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            19.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
                                                        </span>
                                                        {!! nl2br(e($res)) !!} <br>
                                                    </div>
                                                @endif

                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;  // Reset sub-index for new main item
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Conclusion END --}}

                    {{-- Attachment list START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                    <span>20.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Training:</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display: flex; flex-wrap: wrap;">
                                <div class="w-100" style="width: 100%;">
                                    <div style="height: auto; overflow-x: auto; width: 650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp

                                        @if ($data->document_content && 
                                            !empty($data->document_content->training_cvpd) && 
                                            is_array(unserialize($data->document_content->training_cvpd)))
                                            
                                            @foreach (unserialize($data->document_content->training_cvpd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            20.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
                                                        </span>
                                                        {!! nl2br(e($res)) !!} <br>
                                                    </div>
                                                @endif

                                                @php
                                                    if (!$isSub) {
                                                        $i++;
                                                        $sub_index = 1;
                                                    } else {
                                                        $sub_index++;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Attachment list END --}}

                    {{-- Post approval START --}}
                  
                    {{-- Post approval END --}}

            </section>
        </section>
    </div>


    {{-- <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText =  $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 115;
                    $x = 490;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script> --}}
    <h2  style="text-align: center;">Content of Protocol not limited as per above table it may vary </h2>
</body>

</html>
