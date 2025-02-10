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
            margin-top: 280px;
            margin-bottom: 70px;
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
            border: 1px solid #000 !important;
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

    <style>
        .other-container th {
            font-weight: bold;
        }
    </style>

    <style>
        .custom-style {
            font-weight: bold;
            text-align: left !important;
            padding-left: 10px;
        }
    </style>



</head>

<body>

    <header class="">

        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">

                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="logo w-15">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 55px; max-width: 40px;">
                    </td>
                    <td class="title w-60"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center; font-weight:bold">AGIO PHARMACEUTICALS LTD.BHOSARI</p>
                        {{-- <hr style="border: 0; border-top: 1px solid #686868; margin: 0;"> --}}
                        <p style="margin: 0; text-align: center;  font-weight:bold;border-top: 1px solid #686868; padding-top: 10px;">QUALITY ASSURANCE DEPARTMENT</p>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">
                         Helpers::SOPtype($data->sop_type) ? Helpers::SOPtype($data->sop_type) 
                        STANDARD OPERATING PROCEDURE
                    </td>
                </tr>
            </tbody>
        </table> --}}

        <table class="border border-top-none">
            <tbody>
                <tr>
                    <td style="width: 20%; padding: 5px;" class="doc-num">Dosage Form</td>
                    <td style="width: 35%; padding: 5px;">
                        : ________________
                        {{-- {{ Helpers::getFullDepartmentName($data->department_id) }}--}}
                    </td>
                    <td style="width: 22%; padding: 5px; text-align: left" class="doc-num">Page No.:</td>
                    <td style="width: 23%; padding: 5px; text-align: left"></td>
                </tr>
            </tbody>
        </table>


        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num" style="width: 50%; padding: 5px; text-align: left">
                        Process Validation Protocol for
                    </td>
                    <td>
                        _______________________________
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">
                        APL/PVP/XX/XXXX/XX
                    </td>
                </tr>
            </tbody>
        </table>

    </header>

    <div>
        <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">PRODUCT NAME</h3>
    </div>
    <div>
        <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">Protocol No.:</h3>
    </div>
    <div>
        <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">Batch No</h3>
    </div>
    <div>
        <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">PROTOCOL APPROVAL</h3>
    </div>

    <table border="1">
        <thead>
            <th>RESPONSIBILITY</th>
            <th>DEPARTMENT</th>
            <th>DESIGNATION</th>
            <th>NAME</th>
            <th>SIGN & DATE</th>
        </thead>
        <tbody>
            <tr>
                <td>PREPARED BY</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="2">CHECKED BY</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>APROVED BY</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>


        </tbody>
    </table>



    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">

        <span>Format No.: QA/025/F1-01</span>
    </footer>







    <div>
        <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">PROTOCOL DETAILS</h3>
    </div>

    <table border="1">
        <tbody>
            <tr>
                <td class="custom-style">Generic Name</td>
                <td style="width:10%">:</td>
                <td>{{$data->document_content->generic_prvp}}</td>
            </tr>
            <tr>
                <td class="custom-style">Product Code</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_product_code}}</td>
            </tr>
            <tr>
                <td class="custom-style">Std.Batch size</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_std_batch}}</td>
            </tr>
            <tr>
                <td class="custom-style">Category</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_category}}</td>
            </tr>
            <tr>
                <td class="custom-style">Label Claim</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_label_claim}}</td>
            </tr>
            <tr>
                <td class="custom-style">Market</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_market}}</td>
            </tr>
            <tr>
                <td class="custom-style">Shelf Life</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_shelf_life}}</td>
            </tr>
            <tr>
                <td class="custom-style">BMR No.</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_bmr_no}}</td>
            </tr>
            <tr>
                <td class="custom-style">MFR No.</td>
                <td>:</td>
                <td>{{$data->document_content->prvp_mfr_no}}</td>
            </tr>
        </tbody>
    </table>


    <div>

    </div>






    <div class="other-container">
        <table>
            <thead>
                <tr>
                    <th class="w-5">1.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;" >Purpose</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style=" overflow-x:hidden; width:650px; ">
                            {!! $data->document_content ? nl2br($data->document_content->prvp_purpose) : '' !!}
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
                        <div style="font-weight: bold;">Scope</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100" style="font-weight: bold;">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style=" overflow-x:hidden; width:650px; ">
                            {!! $data->document_content ? nl2br($data->document_content->prvp_scope) : '' !!}
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
                    <th class="w-5">3.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Reason for validation</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                            {!! $data->document_content ? nl2br($data->document_content->reason_validation) : '' !!}
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
                    <th class="w-5">4.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Responsibility</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">


                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($data->document_content &&
                                            !empty($data->document_content->responsibilityprvp) &&
                                            is_array(unserialize($data->document_content->responsibilityprvp)))
                                        @foreach (unserialize($data->document_content->responsibilityprvp) as $key => $res)
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
    </div>


    <div class="other-container">
        <table>
            <thead>
                <tr>
                    <th class="w-5">5.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Validation Policy</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                            {!! $data->document_content ? nl2br($data->document_content->validation_po_prvp) : '' !!}

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
                    <th class="w-5">6.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Description of SOP</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                            {!! $data->document_content ? nl2br($data->document_content->description_sop_prvp) : '' !!}
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
                    <th class="w-5">7.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Active raw material approved vendor details </div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="scope-block">
            <div class="w-100">
                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                    <div class="w-100">
                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                            @php
                                $i = 1;
                            @endphp
                            @if ($data->document_content &&
                                    !empty($data->document_content->prvp_rawmaterial) &&
                                    is_array(unserialize($data->document_content->prvp_rawmaterial)))
                                @foreach (unserialize($data->document_content->prvp_rawmaterial) as $key => $res)
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
    </div>






    <div>

        <div class="other-container">
            <table>
                <thead>
                    <tr>
                        <th class="w-5">8.</th>
                        <th class="text-left">
                            <div style="font-weight: bold;">Primary packing material approved vendor details</div>
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="scope-block">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                        <div class="w-100">
                            <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($data->document_content &&
                                            !empty($data->document_content->pripackmaterial) &&
                                            is_array(unserialize($data->document_content->pripackmaterial)))
                                        @foreach (unserialize($data->document_content->pripackmaterial) as $key => $res)
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
        </div>






        <div>


            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">9.</th>
                            <th class="text-left">
                                <div style="font-weight: bold;">Equipment Calibration & Qualification Status </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                            <div class="w-100">
                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($data->document_content &&
                                            !empty($data->document_content->equipCaliQuali) &&
                                            is_array(unserialize($data->document_content->equipCaliQuali)))
                                        @foreach (unserialize($data->document_content->equipCaliQuali) as $key => $res)
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
            </div>






            <div>

                <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">10.</th>
                                <th class="text-left">
                                    <div style="font-weight: bold;">Rationale for selection of critical steps </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                <div class="w-100">
                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($data->document_content &&
                                            !empty($data->document_content->rationale_critical) &&
                                            is_array(unserialize($data->document_content->rationale_critical)))
                                        @foreach (unserialize($data->document_content->rationale_critical) as $key => $res)
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
                </div>






                <div>


                    <div class="other-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">11.</th>
                                    <th class="text-left">
                                        <div style="font-weight: bold;"> Manufacturing Process Flow Chart </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="scope-block">
                            <div class="w-100">
                                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                    <div class="w-100">
                                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                        @php
                                                $i = 1;
                                            @endphp
                                            @if ($data->document_content &&
                                                    !empty($data->document_content->general_instrument) &&
                                                    is_array(unserialize($data->document_content->general_instrument)))
                                                @foreach (unserialize($data->document_content->general_instrument) as $key => $res)
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
                    </div>






                    <div>

                        <div class="other-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="w-5">12.</th>
                                        <th class="text-left">
                                            <div style="font-weight: bold;">Process Flow Chart </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="scope-block">
                                <div class="w-100">
                                    <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                        <div class="w-100">
                                            <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @if ($data->document_content &&
                                                        !empty($data->document_content->process_flow) &&
                                                        is_array(unserialize($data->document_content->process_flow)))
                                                    @foreach (unserialize($data->document_content->process_flow) as $key => $res)
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
                        </div>






                        <div>

                            <div class="other-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-5">13.</th>
                                            <th class="text-left">
                                                <div style="font-weight: bold;"> Sampling Plan, Procedure and rationale </div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="custom-procedure-block">
                                    <div class="custom-container">
                                        <div class="custom-table-wrapper" id="custom-table2">
                                            <div class="custom-procedure-content">
                                                <div class="custom-content-wrapper">
                                                    @if ($data->document_content)
                                                        {!! strip_tags($data->document_content->prvp_procedure, 
                                                        '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>


                                <div class="other-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-5">14.</th>
                                                <th class="text-left">
                                                    <div style="font-weight: bold;">Diagrammatic representation of Sampling points</div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="scope-block">
                                        <div class="w-100">
                                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                <div class="w-100">
                                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                    @php
                                                    $i = 1;
                                                        @endphp
                                                        @if ($data->document_content &&
                                                                !empty($data->document_content->diagrammatic) &&
                                                                is_array(unserialize($data->document_content->diagrammatic)))
                                                            @foreach (unserialize($data->document_content->diagrammatic) as $key => $res)
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
                                </div>

                                <div>



                                    <div class="other-container">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5">15.</th>
                                                    <th class="text-left">
                                                        <div style="font-weight: bold;">Critical Process Parameters & Critical Process Attributes </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="scope-block">
                                            <div class="w-100">
                                                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                    <div class="w-100">
                                                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                        @php
                                                          $i = 1;
                                                        @endphp
                                                        @if ($data->document_content &&
                                                                !empty($data->document_content->critical_process) &&
                                                                is_array(unserialize($data->document_content->critical_process)))
                                                            @foreach (unserialize($data->document_content->critical_process) as $key => $res)
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
                                    </div>
                                    <div>


                                        <div class="other-container">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="w-5">16.</th>
                                                        <th class="text-left">
                                                            <div style="font-weight: bold;">Product Acceptance Criteria</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="scope-block">
                                                <div class="w-100">
                                                    <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                        <div class="w-100">
                                                            <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                            @php
                                                                $i = 1;
                                                                @endphp
                                                                @if ($data->document_content &&
                                                                        !empty($data->document_content->product_acceptance) &&
                                                                        is_array(unserialize($data->document_content->product_acceptance)))
                                                                    @foreach (unserialize($data->document_content->product_acceptance) as $key => $res)
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
                                        </div>
                                        <div>


                                            <div class="other-container">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="w-5">17.</th>
                                                            <th class="text-left">
                                                                <div style="font-weight: bold;">Hold time study</div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <div class="scope-block">
                                                    <div class="w-100">
                                                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                            <div class="w-100">
                                                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                                @php
                                                                $i = 1;
                                                                @endphp
                                                                    @if ($data->document_content &&
                                                                            !empty($data->document_content->holdtime_study) &&
                                                                            is_array(unserialize($data->document_content->holdtime_study)))
                                                                        @foreach (unserialize($data->document_content->holdtime_study) as $key => $res)
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
                                            </div>
                                            <div>


                                                <div class="other-container">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="w-5">18.</th>
                                                                <th class="text-left">
                                                                    <div style="font-weight: bold;">Cleaning validation </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <div class="scope-block">
                                                        <div class="w-100">
                                                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                <div class="w-100">
                                                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                                        {!! $data->document_content ? nl2br($data->document_content->cleaning_validation) : '' !!}

                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>

                                                    <div class="other-container">
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-5">19.</th>
                                                                    <th class="text-left">
                                                                        <div style="font-weight: bold;">Stability study </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                        <div class="scope-block">
                                                            <div class="w-100">
                                                                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                    <div class="w-100">
                                                                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                                            {!! $data->document_content ? nl2br($data->document_content->purpose) : '' !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>


                                                        <div class="other-container">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="w-5">20.</th>
                                                                        <th class="text-left">
                                                                            <div style="font-weight: bold;">Deviation </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                            <div class="scope-block">
                                                                <div class="w-100">
                                                                    <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                        <div class="w-100">
                                                                            <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                                @if ($data->document_content &&
                                                                                        !empty($data->document_content->deviation) &&
                                                                                        is_array(unserialize($data->document_content->deviation)))
                                                                                    @foreach (unserialize($data->document_content->deviation) as $key => $res)
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
                                                        </div>
                                                        <div>


                                                            <div class="other-container">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="w-5">21.</th>
                                                                            <th class="text-left">
                                                                                <div style="font-weight: bold;">Change control</div>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                                <div class="scope-block">
                                                                    <div class="w-100">
                                                                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                            <div class="w-100">
                                                                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                                                                                    @php
                                                                                        $i = 1;
                                                                                    @endphp
                                                                                    @if ($data->document_content &&
                                                                                            !empty($data->document_content->change_control) &&
                                                                                            is_array(unserialize($data->document_content->change_control)))
                                                                                        @foreach (unserialize($data->document_content->change_control) as $key => $res)
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
                                                            </div>
                                                            <div>

                                                                <div class="other-container">
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="w-5">22.</th>
                                                                                <th class="text-left">
                                                                                    <div style="font-weight: bold;">Summary </div>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                    <div class="scope-block">
                                                                        <div class="w-100">
                                                                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                                <div class="w-100">
                                                                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                                                                                        @php
                                                                                            $i = 1;
                                                                                        @endphp
                                                                                        @if ($data->document_content &&
                                                                                                !empty($data->document_content->summary_prvp) &&
                                                                                                is_array(unserialize($data->document_content->summary_prvp)))
                                                                                            @foreach (unserialize($data->document_content->summary_prvp) as $key => $res)
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
                                                                </div>
                                                                <div>

                                                                    <div class="other-container">
                                                                        <table>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="w-5">23.</th>
                                                                                    <th class="text-left">
                                                                                        <div style="font-weight: bold;"> Conclusion</div>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                        <div class="scope-block">
                                                                            <div class="w-100">
                                                                                <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                                    <div class="w-100">
                                                                                        <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                                                                                            @php
                                                                                                $i = 1;
                                                                                            @endphp
                                                                                            @if ($data->document_content &&
                                                                                                    !empty($data->document_content->conclusion_prvp) &&
                                                                                                    is_array(unserialize($data->document_content->conclusion_prvp)))
                                                                                                @foreach (unserialize($data->document_content->conclusion_prvp) as $key => $res)
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
                                                                    </div>
                                                                    <div>


                                                                        <div class="other-container">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="w-5">24.</th>
                                                                                        <th class="text-left">
                                                                                            <div style="font-weight: bold;">Revision History </div>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                            <div class="scope-block">
                                                                                <div class="w-100">
                                                                                    <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                                        <div class="w-100">
                                                                                            <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">

                                                                                                @php
                                                                                                    $i = 1;
                                                                                                @endphp
                                                                                                @if ($data->document_content &&
                                                                                                        !empty($data->document_content->training_prvp) &&
                                                                                                        is_array(unserialize($data->document_content->training_prvp)))
                                                                                                    @foreach (unserialize($data->document_content->training_prvp) as $key => $res)
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
                                                                        </div>
                                                                        <div>

                                                                            <div class="other-container">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="w-5">25.</th>
                                                                                            <th class="text-left">
                                                                                                <div style="font-weight: bold;">Training</div>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                                <div class="scope-block">
                                                                                    <div class="w-100">
                                                                                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                                                                            <div class="w-100">
                                                                                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                                                                                    {!! $data->document_content ? nl2br($data->document_content->purpose) : '' !!}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div>
                                                                                <div><span class="bold">Note:</span>Content of protocol not limited as per above table it may vary.</div>
                                                                            </div>





                                                                            <script type="text/php">
                                                                                if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText =  $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 102;
                    $x = 490;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>
</body>

</html>