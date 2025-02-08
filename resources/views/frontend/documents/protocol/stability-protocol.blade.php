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
            margin-top: 150px;
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
        .custom-style {

            text-align: left !important;
            padding-left: 10px;
            text-align: left !important;
            padding-left: 10px;
            font-weight: bold;

        }
    </style>

</head>

<body>

    <header class="">
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="logo w-15">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 55px; max-width: 40px;">
                    </td>
                    <td class="title w-60"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center; font-weight:bold">{{ config('site.pdf_title') }}</p>
                        {{-- <hr style="border: 0; border-top: 1px solid #686868; margin: 0;"> --}}
                        <p style="margin: 0; text-align: center;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                    </td>
                </tr>
            </tbody>
        </table>

    </header>


    <div>
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">
                        STABILITY STUDY PROTOCOL
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table class="border " style="width: 100%;">
        <tbody>
            <tr>
                <td class="doc-num custom-style">
                    PRODUCT NAME :
                </td>
            </tr>
        </tbody>
    </table>

    <table class="border " style="width: 100%;" border="1">
        <tbody>
            <tr>
                <td class="doc-num custom-style">
                Protocol No.:
                </td>
                <td class="doc-num custom-style"> Effective Date:</td>
            </tr>
        </tbody>
    </table>

    <table class="border " style="width: 100%;">
        <tbody>
            <tr>
                <td class="doc-num custom-style">
                    Supersedes No.:
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table border="1">
        <thead>
            <th  style="width: 30%;" class="custom-style">Responsibility</th>
            <th  style="width: 18%"; class="custom-style">Name</th>
            <th   style="width: 18%"; class="custom-style">Designation</th>
            <th   style="width: 18%"; class="custom-style">Department</th>
            <th   style="width: 18%"; class="custom-style">Signature </th>
            <th  style="width: 18%"; class="custom-style"> Date</th>
        </thead>
        <tbody>
            <tr>
                <td>Prepared by</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="4">Checked by</td>
                <td></td>
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
                <td></td>
            </tr>
            <tr>
                <td></td>
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
                <td></td>
            </tr>
            <tr>
                <td>Approved by</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>


        </tbody>
    </table>









    <br>


    <div>
        <h3 class="custom-style" style=" font-weight: bold; margin-bottom: 50px;">PROTOCOL DETAILS:</h3>
    </div>

    <table border="1">
        <tbody>
            <tr>
                <td class="custom-style">Brand Name</td>
                <td style="width:10%">:</td>
                <td style="width:70%"></td>
            </tr>
            <tr>
                <td class="custom-style">Generic Name</td>
                <td style="width:10%">:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style" style="height: 20%;">Label Claim</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">FG Code</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">Pack Size </td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">Shelf Life</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">Market</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">Shelf Life</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="custom-style">Storage condition.</td>
                <td>:</td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <br>
    <div>
        <h3 class="custom-style">PURPOSE:</h3>
        <span class="custom-style">Stability Studies for:</span>
    </div>


    <div>
        <h3 class="custom-style">SCOPE:</h3>
        <span class="custom-style">Stability Protocol for:</span>
    </div>

    <div>
        <h3 class="custom-style">DOCUMENT REFERENCES:</h3>
    </div>

    <table class="border" border="1">
        <tr>
            <td>
                a)
            </td>
            <td class="custom-style" style="width: 90%;">
                Testing Specification Number: ____________________
            </td>
        </tr>

        <tr>
            <td>
                b)
            </td>
            <td class="custom-style" style="width: 90%;">
                Standard Test Procedure: ____________________
            </td>
        </tr>

        <tr>
            <td>
                c)
            </td>
            <td class="custom-style" style="width: 90%;">
                QMS reference No. (if any): ____________________
            </td>
        </tr>

        <tr>
            <td>
                d)
            </td>
            <td class="custom-style" style="width: 90%;">
                Active Pharmaceutical Ingredients details:
                <table class="border" border="1">
                    <thead>
                        <tr>
                            <th>Item code</th>
                            <th>Name of API</th>
                            <th> Pharma.Grade</th>
                            <th>Vendor details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                e)
            </td>
            <td class="custom-style" style="width: 90%;">
                Primary Packaging material details:

                <table class="border" border="1">
                    <thead>
                        <th>Item code</th>
                        <th>Material Name </th>
                        <th>Vendor details</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>


        <tr>
            <td>
                f)
            </td>
            <td class="custom-style" style="width: 90%;">
                Others (if any): _______________________________________________
            </td>
        </tr>





    </table>


    <br>
    <div>
        <h3 class="custom-style">BATCH DETAILS:</h3>
    </div>


    <table class="border" border="1">
        <thead>
            <tr>
                <th class="custom-style">Batch Number</th>
                <th class="custom-style">Batch Size</th>
                <th class="custom-style">Manufacturing Date</th>
                <th class="custom-style">Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>


    <br>

    <div>

        <span class="custom-style">Stability Conditions and stations required </span>
    </div>


    <br>


    <table border="1">
        <tr>
            <th style="width: 15%;" rowspan="2">Storage Conditions</th>
            <th style="width: 15%;" rowspan="2">Orientation</th>
            <th style="width: 15%;" colspan="12">Interval (Month)</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>6</th>
            <th>9</th>
            <th>12</th>
            <th>18</th>
            <th>24</th>
            <th>36</th>
            <th>48</th>
            <th>60</th>
            <th>72</th>
        </tr>
        <tr>
            <td>Accelerated (40°C ± 2°C and 75% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>

        <tr>
            <td>Long Term (25°C ± 2°C and 60% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Long Term (30°C ± 2°C and 65% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Long Term (30°C ± 2°C and 75% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <div>
        <span>Note:</span>
        In case of vial / bottle, write the inverted/upright condition in respective ‘Orientation’ column.
    </div>

    <br>


    <div>
        <span class="custom-style">Quantity Required </span>
        (Write quantity in the appropriate column)
    </div>


    
   
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th style="width: 15%;" rowspan="2">Storage Conditions</th>
            <th colspan="12">Interval (Month)</th>
            <th rowspan="2">Add. Qty.</th>
            <th rowspan="2">Total Qty.</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>6</th>
            <th>9</th>
            <th>12</th>
            <th>18</th>
            <th>24</th>
            <th>36</th>
            <th>48</th>
            <th>60</th>
            <th>72</th>
        </tr>
        <tr>
            <td>Accelerated (40°C ± 2°C and 75% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Long Term (25°C ± 2°C and 60% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Long Term (30°C ± 2°C and 65% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Long Term (30°C ± 2°C and 75% ± 5% RH)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Total</td>
            <td colspan="12"></td>
            <td></td>
            <td></td>
        </tr>
    </table>


    <br>

    <table class="border" border="1">
        <thead>
            <tr style="height: 40%;">
                <th >Sr. No.</th>
                <th>Stability station</th>
                <th>Required tests</th>
            </tr>
        </thead>

        <tbody>
            <tr style="height: 40%;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 40%;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 40%;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div>
        <p class="custom-style">Remark (if any):</p>
    </div>

    <br>
    <div>
        <p class="custom-style">STABILITY DATA COMPILATION:</p>
    </div>

    <br>

    <div>
        <p class="custom-style">GENERAL INSTRUCTIONS:</p>
    </div>

    <br>


    <div>
        <p class="custom-style">PROTOCOL CERTIFICATION:</p>
    </div>

    <br>


    <table class="border" border="1">
        <tbody>
            <tr>
                <td class="custom-style">Stability Protocol For: </td>
            </tr>

            <tr>
                <td class="custom-style">Protocol No.:</td>
            </tr>
            <tr>
                <td class="custom-style">Product:  </td>
            </tr>
            <tr>
                <td class="custom-style">Batch Number:</td>
            </tr>
            <tr>
                <td class="custom-style">
                 Conclusion:
                 <br><span>
                    
                The stability study has been executed as per Protocol No.:_______________________________ and completed ___________ Month interval  and for the Storage  condition _________________________ study as per protocol. The results are compiled, reviewed and found to be satisfactory / Not satisfactory.</span>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>


    <table class="border" border="1" style="height: 20%;">

    <thead>
        <tr style="height: 20%;">
            <th>Functional Area</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Signature</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td></td>
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
            <td></td>
        </tr>
        <tr>
            <td></td>
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
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
    </table>









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
            <span>Format No. CQA/013/F2-02</span>
    </footer>






    {{-- MATERIALS AND EQUIPMENTS END --}}

    {{-- MATERIALS AND EQUIPMENTS START --}}
    <table class="mb-15">
        <!-- <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">13.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">REFERENCE DOCUMENT NUMBER (IF ANY) :</div>
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
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- MATERIALS AND EQUIPMENTS START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">14.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Observation and result</div>
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
                    {{-- MATERIALS AND EQUIPMENTS END --}}

                    {{-- Abbreviations START --}}
                        <table class="mb-15">
                            <tbody>
                                <tr>
                                    <th class="w-5 vertical-baseline">15.</th>
                                    <th class="w-95 text-left">
                                        <div class="bold">Abbreviations</div>
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
                    {{-- Abbreviations END --}}

                    {{-- Deviation if any --}}
                    <div class="other-container ">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-5">16.</th>
                                    <th class="text-left">
                                        <div class="bold">Deviation if any
                                        </div>
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
                                                {!! strip_tags($data->document_content->procedure, 
                                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                            @endif
                                        </div>
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
                                <th class="w-5 vertical-baseline">17.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Change control </div>
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
                    {{-- Change control END --}}

                    {{-- Summary START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">18.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Summary</div>
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
                    {{-- Summary END --}}

                    {{-- Conclusion START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">19.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Conclusion</div>
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
                    {{-- Conclusion END --}}

                    {{-- Attachment list START --}}
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">20.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Attachment list</div>
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
                    <table class="mb-15">
                        <tbody>
                            <tr>
                                <th class="w-5 vertical-baseline">21.</th>
                                <th class="w-95 text-left">
                                    <div class="bold">Post approval</div>
                                </th>
                            </tr>
                            <tr>
                        </tbody> -->
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