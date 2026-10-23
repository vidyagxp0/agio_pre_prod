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

        @page {
            size: A4;
            margin: 235px 34px 170px 34px;  /* top | right | bottom | left */
        }

        header {
            position: fixed;
            top: -201px;          /* 235 - 34 */
            left: 0;
            width: 100%;
            z-index: 1000;
            background: #fff;     /* height hata di, header apni natural height lega */
        }

     footer {
    position: fixed;
    bottom: -136px;       /* 170 - 34 */
    left: 0;
    width: 100%;
    height: 130px;
    z-index: 1000;
    background: #fff;
}

/* PAGE 1 ONLY: 3 columns, fixed footer ke upar baithta hai */
.footer-first {
    position: absolute;
    bottom: -136px;
    left: 0;
    width: 100%;
    height: 130px;
    z-index: 2000;
    background: #fff;
}

.sign-footer table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    border: 1px solid #000;
}
.sign-footer th,
.sign-footer td {
    border: 1px solid #000;
    padding: 5px 4px;
    font-size: 14px;
    text-align: center;
}
.sign-footer th {
    font-weight: bold;
    background-color: #f4f4f4;
}
.sign-footer td div { font-size: 14px; }

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
        .quill-pdf-content {
            width: 100%;
            font-size: 14px;
            line-height: 1.5;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            box-sizing: border-box;
        }
        .quill-pdf-content p { margin: 0 0 6px 0; font-size: 14px; line-height: 1.5; }
        .quill-pdf-content h1, .quill-pdf-content h2, .quill-pdf-content h3,
        .quill-pdf-content h4, .quill-pdf-content h5, .quill-pdf-content h6 {
            font-size: 14px; font-weight: bold; margin: 10px 0 6px 0;
        }
        .quill-pdf-content ul, .quill-pdf-content ol { padding-left: 22px; margin: 2px 0 6px 0; }
        .quill-pdf-content li { font-size: 14px; line-height: 1.5; margin-bottom: 2px; }

        .quill-pdf-content table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 6px 0 10px 0;
        }
        .quill-pdf-content table.pdf-chunk { margin: 0; }
        .quill-pdf-content table,
        .quill-pdf-content th { font-weight: bold; text-align: center; },
        .quill-pdf-content td { border: 1px solid #000; }

        .quill-pdf-content th,
        .quill-pdf-content td {
            font-size: 14px;
            line-height: 1.35;
            padding: 3px 5px;
            vertical-align: top;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .quill-pdf-content th { font-weight: bold; text-align: center; }
        .quill-pdf-content td p, .quill-pdf-content th p,
        .quill-pdf-content td div, .quill-pdf-content th div {
            margin: 0; padding: 0; font-size: 12px; line-height: 1.35;
        }
        .quill-pdf-content td span, .quill-pdf-content th span,
        .quill-pdf-content td li, .quill-pdf-content th li { font-size: 12px; }

        .quill-pdf-content table.pdf-borderless,
        .quill-pdf-content table.pdf-borderless th,
        .quill-pdf-content table.pdf-borderless td { border: none; }

        .quill-pdf-content td.pdf-cont-first { border-bottom: none; }
        .quill-pdf-content td.pdf-cont-mid   { border-top: none; border-bottom: none; }
        .quill-pdf-content td.pdf-cont-last  { border-top: none; }

        .quill-pdf-content thead { display: table-header-group; }
        .quill-pdf-content img { display: block; max-width: 100%; height: auto; margin: 6px auto; page-break-inside: avoid; }        
        .header-wrapper{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .quill-pdf-content strong,
        .quill-pdf-content b,
        .quill-pdf-content th,
        .quill-pdf-content th *,
        .quill-pdf-content td strong,
        .quill-pdf-content td b {
            font-weight: bold !important;
        }

        .master-copy{
            position: absolute;
            top: -35px;
            right: 10px;

            border: 2px solid #00bcd4;
            color: #00bcd4;

            font-size: 14px;
            font-weight: bold;

            padding: 4px 12px;

            transform: rotate(-4deg);

            text-transform: uppercase;
            letter-spacing: 1px;

            background: #fff;
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

        <table class="border border-top-none"
            style="width: 100%; border-collapse: collapse; table-layout: fixed;">
            <tbody>
                <tr>
                    <td style="
                        width: 70%;
                        padding: 6px 8px;
                        text-align: left;
                        vertical-align: top;
                        border: 1px solid black;
                    ">

                        <!-- Material Name -->
                        <div style="
                            display: table;
                            width: 100%;
                            table-layout: fixed;
                            margin-bottom: 4px;
                        ">
                            <div style="
                                display: table-cell;
                                width: 42%;
                                text-align: left;
                                vertical-align: top;
                                font-weight: bold;
                                padding: 0;
                            ">
                                MATERIAL NAME
                            </div>

                            <div style="
                                display: table-cell;
                                width: 58%;
                                text-align: left;
                                vertical-align: top;
                                padding: 0;
                            ">
                                : {{ $data->product_material_name }}
                            </div>
                        </div>

                        <!-- Reference Standard / GTP No. -->
                        <div style="
                            display: table;
                            width: 100%;
                            table-layout: fixed;
                        ">
                            <div style="
                                display: table-cell;
                                width: 42%;
                                text-align: left;
                                vertical-align: top;
                                font-weight: bold;
                                padding: 0;
                            ">
                                Reference Standard
                            </div>

                            <div style="display: table-cell; width: 58%; text-align: left; vertical-align: top; padding: 0;">
                                : {{ $data->Reference_Standard }}
                            </div>
                        </div>

                    </td>

                    <!-- TDS No. -->
                    <td style="width: 30%; padding: 6px 8px; text-align: left; vertical-align: top; border: 1px solid black; font-weight: bold;">
                        TDS No. :
                        <span style="font-weight: normal;">
                            {{ $document->tds_no ?? 'NA' }}
                          
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>



                @php
                $inreviews = DB::table('stage_manages')
                    ->join('users', 'stage_manages.user_id', '=', 'users.id')
                    ->select('stage_manages.*', 'users.name as user_name')
                    ->where('document_id', $document->id)
                    ->where('stage', 'Review-Submit')
                    ->where('deleted_at', null)
                    ->get();

                $inreview = DB::table('stage_manages')
                    ->join('users', 'stage_manages.user_id', '=', 'users.id')
                    ->select('stage_manages.*', 'users.name as user_name')
                    ->where('document_id', $document->id)
                    ->where('stage', 'Approval-Submit')
                    ->where('deleted_at', null)
                    ->get();

                $preparedName = Helpers::getInitiatorName($data->originator_id);
                $preparedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y');
            @endphp

            {{-- PAGE 2+ : Prepared + Checked (poori width) --}}
            <footer class="sign-footer">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;"></th>
                            <th style="width: 44%;">Prepared By</th>
                            <th style="width: 44%;">Checked By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Sign</th>
                            <td>{{ $preparedName }}</td>
                            <td>
                                @if ($inreviews->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreviews as $row)
                                        <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $preparedDate }}</td>
                            <td>
                                @if ($inreviews->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreviews as $row)
                                        <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="margin-top: 2px; font-size: 14px;">
                    <span>Format No. QA/097/F9-00</span>
                    <span style="margin-left: 330px;">Page No. :-</span>
                </div>
            </footer>

            {{-- PAGE 1 ONLY : Prepared + Checked + Approved --}}
            <div class="sign-footer footer-first">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;"></th>
                            <th style="width: 29.33%;">Prepared By</th>
                            <th style="width: 29.33%;">Checked By</th>
                            <th style="width: 29.33%;">Approved By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Sign</th>
                            <td>{{ $preparedName }}</td>
                            <td>
                                @if ($inreviews->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreviews as $row)
                                        <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($inreview->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreview as $row)
                                        <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $preparedDate }}</td>
                            <td>
                                @if ($inreviews->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreviews as $row)
                                        <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($inreview->isEmpty())
                                    <div>Yet Not Performed</div>
                                @else
                                    @foreach ($inreview as $row)
                                        <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="margin-top: 2px; font-size: 14px;">
                    <span>Format No. QA/097/F9-00</span>
                    <span style="margin-left: 330px;">Page No. :-</span>
                </div>
            </div>

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
                <!-- <tr>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" class="doc-num" colspan="2">Specification No :-</td>
                    <td style="width: 25%; padding: 5px; text-align: left; border: 1px solid black;" colspan="2">{{$data->specification_no}}</td>
                </tr> -->
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
                    @php
                        $tds_result = \App\Helpers\ProcedureHtml::clean(
                            Helpers::renderQuillPdf($data->document_content->tds_result ?? '')
                        );
                    @endphp
                    <div class="quill-pdf-content">
                        {!! $tds_result !!}
                    </div>
                </div>
                {{-- PROCEDURE END --}}
                
                <br>
                {{-- Test wise data Start --}}
                <div class="other-container page-break-before">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">B) Test wise data and calculation:-</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                        @php
                            $tds_test_wise = \App\Helpers\ProcedureHtml::clean(
                                Helpers::renderQuillPdf($data->document_content->tds_test_wise ?? '')
                            );
                        @endphp
                        <div class="quill-pdf-content">
                            {!! $tds_test_wise !!}
                        </div>
     
                </div>
                {{-- Test wise data End --}}
                    
                  
                   {{-- <div style="margin-top: 20px;">
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
                    --}}
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
                                <th style="border:1px solid black; width:8%;">Sr. No.</th>
                                <th style="border:1px solid black; width:32%;">Test Name</th>
                                <th style="border:1px solid black; width:20%;">Quantity Required for test as per STP</th>
                                <th style="border:1px solid black; width:20%;">Quantity Used for test</th>
                                <th style="border:1px solid black; width:20%;">Used by (Sign/Date)</th>
                            </tr>
                        </thead>
                            <tbody>
                            @if (!empty($sampleReconcilationDataGrid))
                                @php $count = 1; @endphp
                                @foreach ($sampleReconcilationDataGrid as $item)
                                    <tr>
                                        <td style="border: 1px solid black; text-align: center;">{{ $count }}</td>
                                        <td style="border: 1px solid black; text-align: left;">{{ $item['test_name'] ?? '' }}</td>
                                        <td style="border: 1px solid black; text-align: center;">{{ $item['quantity_test_stp'] ?? '' }}</td>
                                        <td style="border: 1px solid black; text-align: center;">{{ $item['quantity_userd_test'] ?? '' }}</td>
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
                            @php
                                $IR_Test = \App\Helpers\ProcedureHtml::clean(
                                    Helpers::renderQuillPdf($data->IR_Test ?? '')
                                );
                            @endphp
                            <div class="quill-pdf-content">
                                {!! $IR_Test !!}
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
                                    <th style="font-size: 16px; font-weight: bold; width:10%">Revision No.</th>
                                    <th style="font-size: 16px; font-weight: bold; width:20%">Change Control No.</th>
                                    <th style="font-size: 16px; font-weight: bold; width:20%">Effective Date</th>
                                    <th style="font-size: 16px; font-weight: bold; width:50%">Reason of revision</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @if (!empty($SummaryDataGrid))
                                    @foreach ($SummaryDataGrid as $key => $item)
                                        <tr>
                                            <td>{{ $item['revision_no_tds'] ?? '' }}</td>
                                            <td>{{ $item['changContNo_tds'] ?? '' }}</td>
                                            <td>                                                    
                                                @if ($data->training_required == 'yes' && $data->stage >= 11)
                                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                                @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                                @else
                                                    {{ !empty($item['effectiveDate_tds']) ? \Carbon\Carbon::parse($item['effectiveDate_tds'])->format('d-M-Y') : '' }}
                                                @endif
                                            </td>
                                            {{-- <td>{{ $item['effectiveDate_tds'] ?? '' }}</td> --}}
                                            <td>{{ $item['reasonRevi_tds'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center; font-weight: bold;">No Data Available</td>
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
                    $y = 795;
                    $x = 485;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>

</body>

</html>
