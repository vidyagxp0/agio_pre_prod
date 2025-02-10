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

       


      
    </header>
    
    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
      
        <span> Format No. : QA/002/F5-02 </span>
    </footer>

    <h1 style="text-align: center; font-size: 50px; font-weight: bold; word-wrap: break-word;">
    CLEANING VALIDATION REPORT
</h1>
<h3 style="text-align: center; font-weight: bold; margin-bottom: 0px; line-height: 0;">Product Name : XXXXX</h3>

<h3 style="text-align: center; font-weight: bold; margin-bottom: 0px; line-height: 0;">Batch No : AAAAA</h3>

<h3 style="text-align: center; font-weight: bold; margin-bottom: 0px; line-height: 0;">Next Product Name : XXXXX</h3>

<h3 style="text-align: center; font-weight: bold;  line-height: 0;">Batch No : AAAAA</h3>



            <section>
           

               

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
                                <td style="text-align:left">Analysis Methodology</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">6.0</td>
                                <td style="text-align:left">Recovery Study Report</td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">7.0</td>
                                <td style="text-align:left">Acceptance Criteria </td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">8.0</td>
                                <td style="text-align:left">Analytical  Report</td>
                                <td style="font-weight: bold;"></td>
                            </tr>                        
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">9.0</td>
                                <td style="text-align:left">Physical check & procedure conformance check</td>
                                <td style="font-weight: bold;"></td>
                            </tr> 
                            <tr>
                                <td style="font-size: 16px; font-weight: bold;">10</td>
                                <td style="text-align:left">Conclusion</td>
                                <td style="font-weight: bold;"></td>
                            </tr>
                         
                        </tbody>
                    </table>
                </div>

                    
                <div class="other-container" style="margin-top:1.5rem">
                       
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <td class="w-5 vertical-baseline" style="vertical-align: top; white-space: nowrap;"> 
                                    <span>1.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Objective:</span>
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
                                            !empty($data->document_content->objective_cvrd) && 
                                            is_array(unserialize($data->document_content->objective_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->objective_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            1.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>2.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Scope:</span>
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
                                            !empty($data->document_content->scope_cvrd) && 
                                            is_array(unserialize($data->document_content->scope_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->scope_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            2.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>3.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Purpose:</span>
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
                                            !empty($data->document_content->purpose_cvrd) && 
                                            is_array(unserialize($data->document_content->purpose_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->purpose_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            3.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>4.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Responsibilities:</span>
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
                                            !empty($data->document_content->responsibilities_cvrd) && 
                                            is_array(unserialize($data->document_content->responsibilities_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->responsibilities_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            4.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>5.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold">Analysis Methodology:</span>
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
                                            !empty($data->document_content->analysis_methodology_cvrd) && 
                                            is_array(unserialize($data->document_content->analysis_methodology_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->analysis_methodology_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            5.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>6.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Recovery Study Report:</span>
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
                                            !empty($data->document_content->recovery_study_report_cvrd) && 
                                            is_array(unserialize($data->document_content->recovery_study_report_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->recovery_study_report_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            6.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>7.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Acceptance Criteria:</span>
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
                                            !empty($data->document_content->acceptance_critria_cvrd) && 
                                            is_array(unserialize($data->document_content->acceptance_critria_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->acceptance_critria_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            7.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>8.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Analytical  Report:</span>
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
                                            !empty($data->document_content->analytical_report_cvrd) && 
                                            is_array(unserialize($data->document_content->analytical_report_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->analytical_report_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            8.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>9.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Physical check & procedure conformance check:</span>
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
                                            !empty($data->document_content->physical_procedure_conformance_check_cvrd) && 
                                            is_array(unserialize($data->document_content->physical_procedure_conformance_check_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->physical_procedure_conformance_check_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            9.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                                    <span>10.</span> 
                                </td>
                                <td class="w-95 text-left">
                                    <span class="bold"> Conclusion:</span>
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
                                            !empty($data->document_content->conclusion_cvrd) && 
                                            is_array(unserialize($data->document_content->conclusion_cvrd)))
                                            
                                            @foreach (unserialize($data->document_content->conclusion_cvrd) as $key => $res)
                                                @php
                                                    $isSub = str_contains($key, 'sub');
                                                @endphp

                                                @if (!empty($res))
                                                    <div style="position: relative; padding-left: 2.5rem; margin-bottom: 5px;">
                                                        <span style="position: absolute; left: -2rem; top: 0;">
                                                            10.{{ $isSub ? ($i - 1) . '.' . $sub_index : $i }}
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
                   
                   
                 
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                  
                  
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}



                    <h2  style="text-align: center;">Content of Protocol not limited as per above table it may vary </h2>

                    <h4 style="text-align: center; font-weight: 400; font-size: 25px;">REPORT APPROVAL</h4>

                
                   <table class="border" border="1"> 
                    <thead>
                        <th  style="height: 40px; font-weight: bold;">RESPONSIBILITY</th>
                        <th style="height: 40px; font-weight: bold;">DEPARTMENT</th>
                        <th style="height: 40px; font-weight: bold;">NAME</th>
                        <th style="height: 40px; font-weight: bold;">DESIGNATION</th>
                        <th style="height: 40px; font-weight: bold;">SIGN & DATE</th>
                    </thead>


                    <tbody>
                        <tr>
                            <td style="height: 25px; font-weight: bold;">PREPARED BY</td>
                            <td style="height: 25px; ">Quality Assurance</td>
                            <td style="height: 25px; "></td>
                            <td style="height: 25px;  "></td>
                            <td style="height: 25px; "></td>
                           
                        </tr>
                        <tr>
                            <td rowspan="4" style="height: 40px; font-weight: bold;">CHECKED BY</td>
                            <td style="height: 25px;">Quality Control</td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                            <td style="height: 25px;">Production</td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                            <td style="height: 25px;">Engineering </td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                            <td style="height: 25px;">F& D </td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                            <td style="height: 25px; font-weight: bold;">AUTHORIZED BY</td>
                            <td style="height: 25px;">Quality Assurance</td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                            <td style="height: 25px;"></td>
                        </tr>
                    </tbody>

                   </table>


                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 3rem;">
                                        @php
                                            $i = 1;
                                            $sub_index = 1;
                                        @endphp
                                        @if ($data->document_content && is_array(unserialize($data->document_content->materials_and_equipments)))
                                            @foreach (unserialize($data->document_content->materials_and_equipments) as $key => $res)
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
  
</body>

</html>
