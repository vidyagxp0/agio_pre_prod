<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DMS Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{--
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{--
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"> --}}

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
            border-collapse: collapse;
        }

        td {
            padding: 8px;
            border: 1px solid black;
            text-align: left;
        }

        .title {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        .label {
            font-weight: bold;
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


        h2 {
            text-align: center;
            font-weight: bold;
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
            margin-top: 180px;
            margin-bottom: 80px;
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

        .MsoNormalTable td,
        .table td {
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

        h4 {
            font-weight: bold;
            /* Make the text bold */
        }
    </style>

    <style>
        /*Main Table Styling */
        #isPasted {
            width: 650px !important;
            border-collapse: collapse;
            table-layout: auto;
            /* Adjusts column width dynamically */
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap;
            /* Prevent wrapping */
            width: 1%;
            /* Shrink to fit content */
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            /* Take remaining space */
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
        #isPasted td>p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important;
            /* Ensure image doesn't overflow the cell */
            height: 100%;
            /* Maintain image aspect ratio */
            display: block;
            /* Remove extra space below the image */
            margin: 5px auto;
            /* Add spacing and center align */
        }

        /* If you want larger images */
        #isPasted td img {
            max-width: 400px !important;
            /* Adjust this to your preferred maximum width */
            height: 300px;
            margin: 5px auto;
        }
    </style>

</head>

<body>


 <header class="">
 <table class="table table-bordered" style="font-weight: bold;">
    <tbody>

        <tr style="border: 1px solid black;">
            <td rowspan="2" class="logo w-20">
                <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                    style="max-height: 55px; max-width: 40px;">
            </td>
            <td style="font-weight: bold; text-align: center;" colspan="2">AGIO PHARMACEUTICAL LTD. BHOSARI</td>
        </tr>
        <tr style="border: 1px solid black;">
            <td style="font-weight: bold; text-align: center;" colspan="2">QUALITY ASSURANCE DEPARTMENT</td>
        </tr>
    </tbody>
 </table>

        <table class="border border-top-none border=1" style="border-collapse: collapse; width: 100%; text-align: left;">
            <tr style="border: 1px solid black;">
                <td style="font-weight: bold;">Dosage Form :</td>
                <td style="font-weight: bold;">Page 1 of 2</td>
            </tr>
        </table>

        <table class="border border-top-none border=1" style="border-collapse: collapse; width: 100%; text-align: left;">
            <tr style="border: 1px solid black;">
                <td style="font-weight: bold; text-align: center;" colspan="3">EQUIPMENT HOLD TIME STUDY PROTOCOL FOR XX  </td>
            </tr>
        </table>
</header>

    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
        <!-- <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
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
        </table> -->
        <span>Format No.: QA/083/F1-01</span>
    </footer>

    <div>
        <style>
            h1 {
                font-size: 50px;
                text-align: center;
                /* Center align the text */
                font-weight: bold;
                /* Make the text bold */
            }
        </style>

        <h2 style="font-size: 30px;">XX EQUIPMENT HOLD TIME STUDY REPORT</h2>
        <h2>Report No. : XX</h2>

        <h2>Batch No.: XX</h2>

        <h2>PROTOCOL APPROVAL </h2>

        <h4>PRODUCT DETAILS:</h4>




        <div class="table-responsive retrieve-table">
            <table>
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
                        <td style="font-weight: bold; text-align:left">Approval </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">2.0</td>
                        <td style="font-weight: bold; text-align:left">Objective</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">3.0</td>
                        <td style="font-weight: bold; text-align:left">Scope</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">4.0</td>
                        <td style="font-weight: bold; text-align:left">Responsibility</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">5.0</td>
                        <td style="font-weight: bold; text-align:left">Equipment & Product details</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">6.0</td>
                        <td style="font-weight: bold; text-align:left">Sampling plan</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">7.0</td>
                        <td style="font-weight: bold; text-align:left">Sampling and analysis procedure </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">8.0</td>
                        <td style="font-weight: bold; text-align:left">Acceptance criteria</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">9.0</td>
                        <td style="font-weight: bold; text-align:left">Environmental Conditions</td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">10</td>
                        <td style="font-weight: bold; text-align:left">Deviation (if any)  </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">11</td>
                        <td style="font-weight: bold; text-align:left">Change Control (If any)  </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">12</td>
                        <td style="font-weight: bold; text-align:left">Summary   </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">13</td>
                        <td style="font-weight: bold; text-align:left">Conclusion   </td>
                        <td style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;">14</td>
                        <td style="font-weight: bold; text-align:left"> Training </td>
                        <td style="font-weight: bold;"></td>
                    </tr>





                </tbody>
            </table>
        </div>




        <section class="main-section" id="pdf-page">
            <section style="page-break-after: never;">
                {{-- <div class="other-container" style="">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-right">
                                    <div> <span class="bold">Legacy Document Number:</span>
                                        {{ !empty($document->legacy_number) ? $document->legacy_number : 'NA' }}</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div> --}}


                <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">1.</th>
                                <th class="text-left">
                                    <div class="bold">Approval </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                <div class="w-100">
                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                        {!! $data->document_content ? nl2br($data->document_content->eqp_approval) : '' !!}
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
                                    <div class="bold">Objective</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div class="text-justify"
                                        style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        {!! $data->document_content ? nl2br($data->document_content->eqp_objective) : '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="other-container">
                    <table>
                        <tbody>
                            <tr>

                                <th class="w-5 vertical-baseline">3.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Scope </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div class="text-justify"
                                        style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        {!! $data->document_content ? nl2br($data->document_content->eqp_scope) : '' !!}
                                    </div>
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
                                <div class="bold">Responsibility</div>
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
                                            !empty($data->document_content->eqpresponsibility) &&
                                            is_array(unserialize($data->document_content->eqpresponsibility))
)
            @foreach (unserialize($data->document_content->eqpresponsibility) as $key => $res)
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
                                <div class="bold">Equipment & Product details</div>
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
                                            !empty($data->document_content->eqpdetails) &&
                                            is_array(unserialize($data->document_content->eqpdetails))
                                        )
        @foreach (unserialize($data->document_content->eqpdetails) as $key => $res)
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
                                <div class="bold">Sampling plan</div>
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
                                            !empty($data->document_content->eqpsampling) &&
                                            is_array(unserialize($data->document_content->eqpsampling))
                                        )
        @foreach (unserialize($data->document_content->eqpsampling) as $key => $res)
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
                                <div class="bold">Sampling and analysis procedure </div>
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
                                        $definitions = $data->document_content
                                            ? unserialize($data->document_content->Samplingprocedure)
                                            : [];
                                    @endphp
                                    @if ($data->document_content && !empty($data->document_content->defination) && is_array($definitions))
                                                                    @foreach ($definitions as $key => $definition)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span
                                                        style="position: absolute; left: -2.5rem; top: 0;">7.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                    {!! nl2br($definition) !!} <br>
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
                                <div class="bold">Acceptance criteria</div>
                            </th>
                        </tr>
                        <tr>
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
                                    @if ($data->document_content && is_array(unserialize($data->document_content->AcceptenceCriteria)))
                                                                    @foreach (unserialize($data->document_content->AcceptenceCriteria) as $key => $res)
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

                {{-- PROCEDURE START --}}
                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">9.</th>
                                <th class="text-left">
                                    <div class="bold">Environmental Conditions</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                     <div class="procedure-block">
                          <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php $i = 1; @endphp
                                        @if (
                                                $data->document_content &&
                                                !empty($data->document_content->EnvironmentalConditions) &&
                                                is_array(unserialize($data->document_content->EnvironmentalConditions))
                                            )
                                        @foreach (unserialize($data->document_content->EnvironmentalConditions) as $key => $res)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span
                                                        style="position: absolute; left: -3rem; top: 0;">9.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
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
                {{-- PROCEDURE END --}}

                <style>
                    .body {
                        text-align: center;
                        /* Center align the content inside the body */
                    }

                    .block-head {
                        text-align: center;
                        /* Center align the "REPORT APPROVAL" */
                        font-weight: bold;
                        /* Optional: To make the text bold */
                        border: none;
                        /* Remove the underline or black border */
                    }

                    .block {
                        margin-bottom: 40px;
                        border: none;
                        /* Remove black border from the block */
                    }

                    .block-content {
                        /* Optional: Add styling to block-content if needed */
                    }






                    .custom-procedure-block {
                        width: 100%;
                    }

                    .custom-container {
                        width: 100%;
                        display: inline-block;
                    }

                    .custom-table-wrapper {
                        margin-right: 40px;
                    }

                    .custom-procedure-content {
                        width: 100%;
                        overflow-x: auto;
                    }

                    .custom-content-wrapper {
                        height: auto;
                        overflow-x: auto;
                        width: 500px;
                        margin-left: 0.8rem;
                        margin-right: 0.8rem;

                    }

                    .custom-table-wrapper table {
                        width: 100%;
                        border-collapse: collapse;
                        overflow: auto;
                    }

                    .custom-table-wrapper table td,
                    .custom-table-wrapper table th {
                        word-wrap: break-word;
                        text-align: center;
                        padding: 5px;
                    }

                    .custom-table-wrapper table img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
                <br>
                {{-- REPORTING START --}}
                <table class="mb-15 ">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">10.</th>
                            <th class="w-95 text-left">
                                <div class="bold">Deviation (if any) </div>
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
                                            !empty($data->document_content->eqpdetailsdeviation) &&
                                            is_array(unserialize($data->document_content->eqpdetailsdeviation))
                                        )
                 @foreach (unserialize($data->document_content->eqpdetailsdeviation) as $key => $res)
                                        @php
                                            $isSub = str_contains($key, 'sub');
                                        @endphp
                                        @if (!empty($res))
                                            <div style="position: relative;">
                                                <span
                                                    style="position: absolute; left: -3rem; top: 0;">10.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
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
                            <th class="w-5 vertical-baseline">11.</th>
                            <th class="w-95 text-left">
                                <div class="bold">Change Control (If any) </div>
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
                                        $definitions = $data->document_content
                                            ? unserialize($data->document_content->eqpdetailschangecontrol)
                                            : [];
                                    @endphp
                                    @if ($data->document_content && !empty($data->document_content->defination) && is_array($definitions))
                                                                    @foreach ($definitions as $key => $definition)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span
                                                        style="position: absolute; left: -2.5rem; top: 0;">11.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                    {!! nl2br($definition) !!} <br>
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
                            <th class="w-5 vertical-baseline">12.</th>
                            <th class="w-95 text-left">
                                <div class="bold">Summary  </div>
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
                                        $definitions = $data->document_content
                                            ? unserialize($data->document_content->eqpdetailssummary)
                                            : [];
                                    @endphp
                                    @if ($data->document_content && !empty($data->document_content->defination) && is_array($definitions))
                                                                    @foreach ($definitions as $key => $definition)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span
                                                        style="position: absolute; left: -2.5rem; top: 0;">12.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                    {!! nl2br($definition) !!} <br>
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
                            <th class="w-5 vertical-baseline">13.</th>
                            <th class="w-95 text-left">
                                <div class="bold">Conclusion </div>
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
                                            !empty($data->document_content->eqpdetailsconclusion) &&
                                            is_array(unserialize($data->document_content->eqpdetailsconclusion))
)
            @foreach (unserialize($data->document_content->eqpdetailsconclusion) as $key => $res)
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




                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">14.</th>
                            <th class="w-95 text-left">
                                <div class="bold">Training </div>
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
                                            !empty($data->document_content->eqpdetailstraining) &&
                                            is_array(unserialize($data->document_content->eqpdetailstraining))
)
            @foreach (unserialize($data->document_content->eqpdetailstraining) as $key => $res)
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

   
     
     
                {{-- REPORTING END --}}



                {{-- ANNEXSURE START --}}
                <!-- <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">11.</th>
                            <th class="w-95 text-left">
                                <div class="bold">ANNEXURE</div>
                            </th>
                        </tr>
                    </tbody>
                </table> -->


                {{-- ANNEXSURE END --}}

                @php
                    $i = 1;
                @endphp
                {{-- @if ($data->document_content && !empty($data->document_content->annexuredata))
                @foreach (unserialize($data->document_content->annexuredata) as $res)
                @if (!empty($res))
                <div class="annexure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; ">
                                    {!! strip_tags($res, '<br>
                                    <table>
                                        <th>
                                        <td>
                                            <tbody>
                                                <tr>
                                                    <p><img><a><img><span>
                                                                <h1>
                                                                    <h2>
                                                                        <h3>
                                                                            <h4>
                                                                                <h5>
                                                                                    <h6>
                                                                                        <div><b>
                                                                                                <ol>
                                                                                                    <li>') !!}
                                                                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endif --}}



                <!-- <div class="input-fields">
                    <div class="group-input">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">12.</th>
                                    <th class="text-left">
                                        <div class="bold">DISTRIBUTION LIST</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="table-responsive retrieve-table">
                            <table class="table table-bordered" id="distribution-list">
                                <thead>
                                    <tr>
                                        <th style="font-size: 16px; font-weight: bold;">Row</th>
                                        <th style="font-size: 16px; font-weight: bold;">Copy</th>
                                        <th style="font-size: 16px; font-weight: bold;">No. of Copies</th>
                                        <th style="font-size: 16px; font-weight: bold;">User Department</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: bold;">1</td>
                                        <td style="font-weight: bold;">Master Copy</td>
                                        <td>{{ $data->master_copy_number}}</td>
                                        <td>{{ $data->master_user_department}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: bold;">2</td>
                                        <td style="font-weight: bold;">Controlled Copy</td>
                                        <td>{{ $data->controlled_copy_number}}</td>
                                         <td>
                                            {{ $data->controlled_user_department}}
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: bold;">3</td>
                                        <td style="font-weight: bold;">Display Copy</td>
                                        <td>{{ $data->display_copy_number}}</td>
                                        <td>
                                            {{ $data->display_user_department}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">13.</th>
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
                                        <th style="font-size: 16px; font-weight: bold;">Rev. No.</th>
                                        <th style="font-size: 16px; font-weight: bold;">Change Control No.</th>
                                        <th style="font-size: 16px; font-weight: bold;">Effective Date</th>
                                        <th style="font-size: 16px; font-weight: bold;">Details of revision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: bold;">1</td>
                                        <td style="font-weight: bold;"></td>
                                        <td>{{ $data->effective_date}}</td>
                                        <td>
                                        
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td style="font-size: 16px; font-weight: bold;">2</td>
                                        <td style="font-weight: bold;"></td>
                                        <td>{{ $data->effective_date}}</td>
                                         <td>
                                         {!! $data->revision_summary ? nl2br($data->revision_summary) : '' !!}
                                        </td>
                                       
                                        </tr>
                                        <tr>
                                        <td style="font-size: 16px; font-weight: bold;">3</td>
                                        <td style="font-weight: bold;"></td>
                                        <td>{{ $data->effective_date}}</td>
                                        <td>
                                        {!! $data->revision_summary ? nl2br($data->revision_summary) : '' !!}
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    {{-- <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                <div class="w-100">
                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                        {!! $data->revision_summary ? nl2br($data->revision_summary) : '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div> -->
            </section>

            {{-- <br><br>
            <div class="procedure-block">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block;" id=table1>
                        <div class="w-100">
                            <div class="anne">
                                @if (!empty($annexures))
                                <h3 style="text-align: left; margin-bottom: 1rem; font-weight:bold">Annexures</h3>
                                @foreach ($annexures as $index => $annexure)
                                @if (!empty($annexure))
                                <div style="margin-bottom: 1rem;">
                                    <h4>Annexure {{ $index + 1 }}</h4>
                                    <!-- Wrapping table with scrollable container -->
                                    <div style="overflow-x: auto; width: 100%; box-sizing: border-box;">
                                        <div style="max-width: 100%; overflow-x: auto;">
                                            {!! strip_tags($annexure, '<br>
                                            <table>
                                                <th>
                                                <td>
                                                    <tbody>
                                                        <tr>
                                                            <p><img><a><span>
                                                                        <h1>
                                                                            <h2>
                                                                                <h3>
                                                                                    <h4>
                                                                                        <h5>
                                                                                            <h6>
                                                                                                <div><b>
                                                                                                        <ol>
                                                                                                            <li>') !!}
                                                                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .anne {
                        width: 500px;
                        overflow-x: hidden;
                    }

                    #table1 {
                        margin-right: 25px;
                        /* padding:30px */
                    }
                </style> --}}


                <section class="doc-control" style="page-break-after: never;">
                    <div class="head">

                    </div>
                    <div class="body">
                        <div class="block mb-40">
                          
                            <div class="block-content">
                                <!-- Content goes here -->
                            </div>
                        </div>
                    </div>

                    </thead>

            </div>
    </div>

    </div>

    </div>
    </div>
    </section>

    </section>
    </div>


    {{--
    <script type="text/php">
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