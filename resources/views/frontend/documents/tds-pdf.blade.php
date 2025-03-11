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
            margin-top: 220px;
            margin-bottom: 170px;
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
            width: 690px !important;
        border-collapse: collapse;
        table-layout: fixed;
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; 
            width: 1%;
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;

        }

        /* Common Table Cell Styling */
        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
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

        .table-containers {
            width: 550px;
            overflow-x: fixed; /* Enable horsizontal scrolling */
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

</head>
<body>

    <header class="">
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="logo w-10">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 55px; max-width: 40px;">
                    </td>
                    <td class="title w-40"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center;">{{ config('site.pdf_title') }}</p>
                        {{-- <hr style="border: 0; border-top: 1px solid #686868; margin: 0;"> --}}
                        <p style="margin: 0; text-align: center;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                    </td>
                    <td class="w-20" style="text-align: left;">
                        Issued by: <span></span>
                        <br>
                        Date: <span></span>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="border border-top-none" style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="padding: 5px; line-height: 1;">
                        TEST DATA SHEET
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="border border-top-none" border="1" style="border-collapse: collapse; width: 100%; text-align: left;">
            <tbody>
              <tr>
                <td style="width: 42%; padding: 5px; text-align: left" class="doc-num">
                    PRODUCT/MATERIAL NAME  :   <span>{{$data->product_material_name}}</span><br><br>
                    Reference Standard/GTP No. :  <span>{{$data->Reference_Standard}}</span>
                </td>
                <td style="width: 18%; padding: 5px; text-align: left" class="doc-num">TDS No.: 
                    <span>
                    @if($document->revised == 'Yes')
                        @php
                            $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
                        @endphp

                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                {{$document->tds_name_code}}TDS/{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @else
                                {{$document->tds_name_code}}TDS/{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @endif
                    @else
                        
                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                {{$document->tds_name_code}}TDS/{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}-00
                            @else
                                {{$document->tds_name_code}}TDS/{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}-00
                            @endif
                    @endif
                    </span>
                </td>
             </tr>

            </tbody>
        </table>
    </header>

    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
        <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;"></th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;">Prepared By</th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;">Checked By</th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;">Approved By</th>
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
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;">Sign</th>
                    <td style="padding: 5px; border: 1px solid #ddd;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td style="padding: 5px; border: 1px solid #ddd;">  
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
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">  
                    @if ($inreview->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreview as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif                    
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold;">Date</td>
                    <td style="padding: 5px; border: 1px solid #ddd;">
                    {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                    </td>
                    <td style="padding: 5px; border: 1px solid #ddd;">
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $temp)
                        <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif 
                    </td>

                    <td style="padding: 5px; border: 1px solid #ddd;">
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
        </table>
        <div></div>
            <span style="text-align:center">Format No. QA/097/F9-00</span> 
            <span style="text-align:right; margin-left:350px">Page No. :-</span>  
        </div>                             
    </footer>

        <table class="border" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <tbody>
                <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Batch No</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"> </td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">A.R. No.</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                </tr>
                <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Mfg. Date</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Exp. Date</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                </tr>
                <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Analysis start date</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Analysis completion date </td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                </tr>
                <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num" colspan="2">Specification No :-</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" colspan="2">{{$data->specification_no}}</td>
                </tr>
                <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num" colspan="2">Total no. of pages in the report (Including COA):</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" colspan="2"></td>
                </tr>
            </tbody>
        </table>
        <br>
    <div>
        <section class="main-section" id="pdf-page">
            <section style="page-break-after: never;">


                {{-- PROCEDURE START --}}
                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">A) Summary of Results</div>
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
                                            {!! strip_tags($data->document_content->tds_result, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- PROCEDURE END --}}
                
                <br>
                {{-- Test wise data Start --}}
                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">B) Test wise data and calculation:-</div>
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
                                            {!! strip_tags($data->document_content->tds_test_wise, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     
                </div>
                {{-- Test wise data End --}}
                    
                    {{-- <p> Remark:The above product complies/does not comply as per specification: {{}}</p> --}}

                    <div style="margin-top: 20px;">
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td style="width: 50%; text-align: left;">
                                    <p><strong>Analyzed by:</strong> _____________________________</p>
                                    <p><strong>Date:</strong> ____________________________</p>
                                </td>
                                <td style="width: 50%; text-align: right;">
                                    <p><strong>Reviewed by:</strong> _____________________________</p>
                                    <p><strong>Date:</strong> _____________________________</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div>
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center align-middle">
                                    <div class="bold">SAMPLE RECONCILATION (if applicable)</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table class="border" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Name of Material/Sample:</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Batch No.</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;"></td>

                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">A.R.No.</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;">{{$data->sample_reconcilation_arNo}}</td>

                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num">Total Quantity Received :</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;">{{$data->sample_quatity_received}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div style="margin-top: 20px;">
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No.</th>
                                <th style="border: 1px solid black; width: 60%; font-weight: bold;">Test Name</th>
                                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Quantity Required for test as per STP</th>
                                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Quantity Used for test</th>
                                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Used by (Sign/Date)</th>
                            </tr>
                        </thead>
                            <tbody>
                            @if (!empty($sampleReconcilationDataGrid))
                                @php $count = 1; @endphp
                                @foreach ($sampleReconcilationDataGrid as $item)
                                    <tr>
                                        <td style="border: 1px solid black; text-align: center;">{{ $count }}</td>
                                        <td style="border: 1px solid black; text-align: left;">{{ $item['test_name'] ?? '' }}</td>
                                        <td style="border: 1px solid black; text-align: center;">{{ $item['quantity_test_stp'] ?? 'N/A' }}</td>
                                        <td style="border: 1px solid black; text-align: center;">{{ $item['quantity_userd_test'] ?? 'N/A' }}</td>
                                        <td style="border: 1px solid black; text-align: center;"></td>
                                    </tr>
                                    @php $count++; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" style="border: 1px solid black; text-align: center; font-weight: bold;">No Data Available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 15px;">
                    <table class="border" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;">Total Quantity Consumed</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;">Balance Quantity</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;"></td>

                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;">Balance Quantity Destructed</td>
                                <td style="width: 50%; padding: 5px; text-align: left; border: 1px solid black;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="width: 50%; text-align: left;">
                                <p><strong>Destructed By:</strong></p>
                                <p><strong>(Sign/Date)</strong></p>
                            
                            </td>
                            <td style="width: 50%; text-align: right;">
                                <p><strong>Verified By:</strong></p>
                                <p><strong>(Sign/Date)</strong></p>
                            </td>
                        </tr>
                    </table>
                </div>

                    @if($data->tds_name_code === 'RW' )
                        <div class="other-container ">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            <div class="bold">Individual Identification Test By IR:</div>
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
                                                    {!! strip_tags($data->IR_Test, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    @endif



                <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                
                                <th class="text-left">
                                    <div class="bold">REVISION HISTORY</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-responsive retrieve-table">
                        <table class="table table-bordered" id="distribution-list">
                            <thead>
                                <tr>
                                    <th style="font-size: 16px; font-weight: bold; width:20%">Revision No.</th>
                                    {{-- <th style="font-size: 16px; font-weight: bold; width:30%">Change Control No./ DCRF No</th> --}}
                                    <th style="font-size: 16px; font-weight: bold; width:30%">Effective Date</th>
                                    <th style="font-size: 16px; font-weight: bold; width:20%">Reason of revision</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @if (!empty($SummaryDataGrid))
                                    @foreach ($SummaryDataGrid as $key => $item)
                                        <tr>
                                            <td>{{ $item['revision_no_tds'] ?? '' }}</td>
                                            {{-- <td>{{ $item['changContNo_tds'] ?? '' }}</td> --}}
                                            <td>{{ $item['effectiveDate_tds'] ?? '' }}</td>
                                            <td>{{ $item['reasonRevi_tds'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" style="text-align: center; font-weight: bold;">No Data Available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText =  $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 790;
                    $x = 485;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>

</body>

</html>
