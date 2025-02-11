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
                    ANNEXURE-IV
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
                    Packing Validation Report Of
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
                    APL/PKR/XX/XXXX/XX
                </td>
            </tr>
        </tbody>
    </table>

</header>

<div>
    <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">Product Name</h3>
</div>
<div>
    <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">Report No.:</h3>
</div>
<div>
    <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">Batch No</h3>
</div>






<footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">

    <span>Format No.: QA/025/F4-01</span>
</footer>







<div>
    <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">PRODUCT DETAILS</h3>
</div>

<table border="1">
    <tbody>
        <tr>
            <td class="custom-style">Generic Name</td>
            <td style="width:10%">:</td>
            <td>{{ $data->generic_PacValRep }}</td>
        </tr>
        <tr>
            <td class="custom-style">Product Code</td>
            <td>:</td>
            <td>{{ $data->PacValRep_product_code }}</td>
        </tr>
        <tr>
            <td class="custom-style">Std.Batch size</td>
            <td>:</td>
            <td>{{ $data->PacValRep_std_batch }}</td>
        </tr>
        <tr>
            <td class="custom-style">Category</td>
            <td>:</td>
            <td>{{ $data->PacValRep_category }}</td>
        </tr>
        <tr>
            <td class="custom-style">Label Claim</td>
            <td>:</td>
            <td>{{ $data->PacValRep_label_claim }}</td>
        </tr>
        <tr>
            <td class="custom-style">Market</td>
            <td>:</td>
            <td>{{ $data->PacValRep_market }}</td>
        </tr>
        <tr>
            <td class="custom-style">Shelf Life</td>
            <td>:</td>
            <td>{{ $data->PacValRep_shelf_life }}</td>
        </tr>
        <tr>
            <td class="custom-style">BMR No.</td>
            <td>:</td>
            <td>{{ $data->PacValRep_bmr_no }}</td>
        </tr>
        <tr>
            <td class="custom-style">MFR No.</td>
            <td>:</td>
            <td>{{ $data->PacValRep_mpr_no }}</td>
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
                    <div style="font-weight: bold;">Purpose</div>
                </th>
            </tr>
        </thead>
    </table>
    <div class="scope-block">
        <div class="w-100">
            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                <div class="w-100">
                    <div class="w-100">
                        <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                            @php
                                $i = 1;
                            @endphp
                            @if (
                                $data->document_content &&
                                    !empty($data->document_content->Purpose_PaVaReKp) &&
                                    is_array(unserialize($data->document_content->Purpose_PaVaReKp)))
                                @foreach (unserialize($data->document_content->Purpose_PaVaReKp) as $key => $res)
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
                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                        @php
                            $i = 1;
                        @endphp
                        @if (
                            $data->document_content &&
                                !empty($data->document_content->Scope_PaVaReKp) &&
                                is_array(unserialize($data->document_content->Scope_PaVaReKp)))
                            @foreach (unserialize($data->document_content->Scope_PaVaReKp) as $key => $res)
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

<div class="other-container">
    <table>
        <thead>
            <tr>
                <th class="w-5">3.</th>
                <th class="text-left">
                    <div style="font-weight: bold;">Batch details</div>
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
                                !empty($data->document_content->BatchDetails_PaVaReKp) &&
                                is_array(unserialize($data->document_content->BatchDetails_PaVaReKp)))
                            @foreach (unserialize($data->document_content->BatchDetails_PaVaReKp) as $key => $res)
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
                <th class="w-5">4.</th>
                <th class="text-left">
                    <div style="font-weight: bold;">Reference Document</div>
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
                                !empty($data->document_content->ReferenceDocument_PaVaReKp) &&
                                is_array(unserialize($data->document_content->ReferenceDocument_PaVaReKp)))
                            @foreach (unserialize($data->document_content->ReferenceDocument_PaVaReKp) as $key => $res)
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
</div>


<div class="other-container">
    <table>
        <thead>
            <tr>
                <th class="w-5">5.</th>
                <th class="text-left">
                    <div style="font-weight: bold;">Packing material approved vendor details</div>
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
                                !empty($data->document_content->PackingMaterialApprovalVendDeat_PaVaReKp) &&
                                is_array(unserialize($data->document_content->PackingMaterialApprovalVendDeat_PaVaReKp)))
                            @foreach (unserialize($data->document_content->PackingMaterialApprovalVendDeat_PaVaReKp) as $key => $res)
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
</div>

<div class="other-container">
    <table>
        <thead>
            <tr>
                <th class="w-5">6.</th>
                <th class="text-left">
                    <div style="font-weight: bold;">Used Equipment Calibration and  Qualification status</div>
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
                                !empty($data->document_content->UsedEquipmentCalibrationQualiSta_PaVaReKp) &&
                                is_array(unserialize($data->document_content->UsedEquipmentCalibrationQualiSta_PaVaReKp)))
                            @foreach (unserialize($data->document_content->UsedEquipmentCalibrationQualiSta_PaVaReKp) as $key => $res)
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
</div>

<div class="other-container">
    <table>
        <thead>
            <tr>
                <th class="w-5">7.</th>
                <th class="text-left">
                    <div style="font-weight: bold;">Results Of Packing (Finished product) </div>
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
                                !empty($data->document_content->ResultOfPacking_PaVaReKp) &&
                                is_array(unserialize($data->document_content->ResultOfPacking_PaVaReKp)))
                            @foreach (unserialize($data->document_content->ResultOfPacking_PaVaReKp) as $key => $res)
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
</div>






<div>

    <div class="other-container">
        <table>
            <thead>
                <tr>
                    <th class="w-5">8.</th>
                    <th class="text-left">
                        <div style="font-weight: bold;">Critical process parameters & Critical quality attributes</div>
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
                                    !empty($data->document_content->CriticalProcessParameters_PaVaReKp) &&
                                    is_array(unserialize($data->document_content->CriticalProcessParameters_PaVaReKp)))
                                @foreach (unserialize($data->document_content->CriticalProcessParameters_PaVaReKp) as $key => $res)
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
    </div>






    <div>


        <div class="other-container">
            <table>
                <thead>
                    <tr>
                        <th class="w-5">9.</th>
                        <th class="text-left">
                            <div style="font-weight: bold;">% Yield</div>
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
                                        !empty($data->document_content->yield_PaVaReKp) &&
                                        is_array(unserialize($data->document_content->yield_PaVaReKp)))
                                    @foreach (unserialize($data->document_content->yield_PaVaReKp) as $key => $res)
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
        </div>






        <div>

            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">10.</th>
                            <th class="text-left">
                                <div style="font-weight: bold;">Hold time study </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                            <div class="w-100">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (
                                            $data->document_content &&
                                                !empty($data->document_content->HoldTimeStudy_PaVaReKp) &&
                                                is_array(unserialize($data->document_content->HoldTimeStudy_PaVaReKp)))
                                            @foreach (unserialize($data->document_content->HoldTimeStudy_PaVaReKp) as $key => $res)
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
                </div>
            </div>






            <div>


                <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">11.</th>
                                <th class="text-left">
                                    <div style="font-weight: bold;">Cleaning validation</div>
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
                                                !empty($data->document_content->CleaningValidation_PaVaReKp) &&
                                                is_array(unserialize($data->document_content->CleaningValidation_PaVaReKp)))
                                            @foreach (unserialize($data->document_content->CleaningValidation_PaVaReKp) as $key => $res)
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
                </div>






                <div>

                    <div class="other-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">12.</th>
                                    <th class="text-left">
                                        <div style="font-weight: bold;">Stability study  </div>
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
                                                    !empty($data->document_content->StabilityStudy_PaVaReKp) &&
                                                    is_array(unserialize($data->document_content->StabilityStudy_PaVaReKp)))
                                                @foreach (unserialize($data->document_content->StabilityStudy_PaVaReKp) as $key => $res)
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
                    </div>






                    <div>

                        <div class="other-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="w-5">13.</th>
                                        <th class="text-left">
                                            <div style="font-weight: bold;">Deviation (If any) </div>
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
                                                        !empty($data->document_content->DeviationIfAny_PaVaReKp) &&
                                                        is_array(unserialize($data->document_content->DeviationIfAny_PaVaReKp)))
                                                    @foreach (unserialize($data->document_content->DeviationIfAny_PaVaReKp) as $key => $res)
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
                        </div>

                        <div>


                            <div class="other-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-5">14.</th>
                                            <th class="text-left">
                                                <div style="font-weight: bold;">Change Control ( If any)</div>
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
                                                            !empty($data->document_content->ChangeControlifany_PaVaReKp) &&
                                                            is_array(unserialize($data->document_content->ChangeControlifany_PaVaReKp)))
                                                        @foreach (unserialize($data->document_content->ChangeControlifany_PaVaReKp) as $key => $res)
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
                            </div>

                            <div>



                                <div class="other-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-5">15.</th>
                                                <th class="text-left">
                                                    <div style="font-weight: bold;">Summary</div>
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
                                                                !empty($data->document_content->Summary_PaVaReKp) &&
                                                                is_array(unserialize($data->document_content->Summary_PaVaReKp)))
                                                            @foreach (unserialize($data->document_content->Summary_PaVaReKp) as $key => $res)
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
                                </div>
                                <div>


                                    <div class="other-container">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5">16.</th>
                                                    <th class="text-left">
                                                        <div style="font-weight: bold;">Conclusion</div>
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
                                                                    !empty($data->document_content->Conclusion_PaVaReKp) &&
                                                                    is_array(unserialize($data->document_content->Conclusion_PaVaReKp)))
                                                                @foreach (unserialize($data->document_content->Conclusion_PaVaReKp) as $key => $res)
                                                                    @php
                                                                        $isSub = str_contains($key, 'sub');
                                                                    @endphp
                                                                    @if (!empty($res))
                                                                        <div style="position: relative;">
                                                                            <span
                                                                                style="position: absolute; left: -2.5rem; top: 0;">16.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
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
                                                            <div style="font-weight: bold;">Proposed parameters for upcoming batches</div>
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
                                                                        !empty($data->document_content->ProposedParameters_PaVaReKp) &&
                                                                        is_array(unserialize($data->document_content->ProposedParameters_PaVaReKp)))
                                                                    @foreach (unserialize($data->document_content->ProposedParameters_PaVaReKp) as $key => $res)
                                                                        @php
                                                                            $isSub = str_contains($key, 'sub');
                                                                        @endphp
                                                                        @if (!empty($res))
                                                                            <div style="position: relative;">
                                                                                <span
                                                                                    style="position: absolute; left: -2.5rem; top: 0;">17.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
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
                                                                <div style="font-weight: bold;">Report Approval</div>
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
                                                                            !empty($data->document_content->ReportApproval_PaVaReKp) &&
                                                                            is_array(unserialize($data->document_content->ReportApproval_PaVaReKp)))
                                                                        @foreach (unserialize($data->document_content->ReportApproval_PaVaReKp) as $key => $res)
                                                                            @php
                                                                                $isSub = str_contains($key, 'sub');
                                                                            @endphp
                                                                            @if (!empty($res))
                                                                                <div style="position: relative;">
                                                                                    <span
                                                                                        style="position: absolute; left: -2.5rem; top: 0;">18.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
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
                                                                <div><span class="bold">Note:</span>Content of report not limited as per above table it may vary.</div>
                                                            </div>



                                                            <div>
                                                                <h3 class="text-center" style=" font-weight: bold; margin-bottom: 50px;">REPORT APPROVAL</h3>
                                                            </div>

                                                            <table class="table" border="1">
                                                                <thead>
                                                                    <th style="font-weight: bold;">RESPONSIBILITY</th>
                                                                    <th style="font-weight: bold;">DEPARTMENT</th>
                                                                    <th style="font-weight: bold;">DESIGNATION</th>
                                                                    <th style="font-weight: bold;">NAME</th>
                                                                    <th style="font-weight: bold;">SIGN & DATE</th>
                                                                </thead>

                                                                <tbody style="height: 100PX;">
                                                                    <th style="font-weight: bold;">PREPARED BY</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tbody>
                                                            </table>

                                                            <table class="table table-bordered" style="width: 100%;" border="1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td rowspan="4" style="font-weight: bold;">CHECKED BY</td>
                                                                        <td class=""></td>
                                                                        <td class=""></td>
                                                                        <td class=""></td>
                                                                        <td class=""></td>
                                                                    </tr>
                                                                    <tr class="py-5" style="height: 80px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="py-5" style="height: 50px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="py-5" style="height: 50px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="font-weight: bold;">APPROVED BY</td>
                                                                        <td class="py-5"></td>
                                                                        <td class="py-5"></td>
                                                                        <td class="py-5"></td>
                                                                        <td class="py-5"></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>





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
