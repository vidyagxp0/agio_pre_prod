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

</head>

<body>


    <header class="">

        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">
                        AREA QUALIFICATION PROTOCOL
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
                        <p style="margin: 0; text-align: center; font-weight:bold">{{ config('site.pdf_title') }}</p>
                        {{-- <hr style="border: 0; border-top: 1px solid #686868; margin: 0;"> --}}
                        <p style="margin: 0; text-align: center;">T - 81,82, M.I.D.C., BHOSARI, PUNE - 411026</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="doc-num">
                        REQUALIFICATION PROTOCOL
                    </td>
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
        </table> --}}
        <table class="border border-top-none" border="1"
            style="border-collapse: collapse; width: 100%; text-align: left;">
            <tbody>
                <tr>
                    <td style="width: 35%; padding: 5px; text-align: left" class="doc-num">Document Name</td>
                    <td style="width: 65%; padding: 5px; text-align: left">
                        {{ Helpers::getFullDepartmentName($data->department_id) }}
                    </td>

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

                    <!-- <td style="width: 30%; padding: 5px; text-align: left">
                     @if($document->revised == 'Yes')
                        @php
                            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
                        @endphp

                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @else
                                {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                            @endif
                        {{-- {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }} --}}
                        @else
                        @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                            {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                        @else
                            {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                        @endif
                     @endif
                    </td> -->
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
                        {{-- {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }} --}}
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
        </table>
    </header>



    <div  class="text-center" >
        <h2  style="font-weight: bold;">AREA QUALIFICATION OF</h2>
        <h2  style="font-weight: bold;"> NAME OF DEPARTMENT </h2>
    </div>


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



            <table class="table table-bordered" style="width: 100%;">
                <tbody>
                    <tr>
                        <td class="w-50 border-end text-start" style="text-align: left !important; padding-left: 10px;">
                            Report:
                        </td>
                        <td class="w-50 text-start" style="text-align: left !important; padding-left: 10px;">
                            Page No.:
                        </td>
                    </tr>

                </tbody>
            </table>

            <table class="table table-bordered" border="1" style="width:100%;">
                <tbody>
                    <tr>
                        <td class="logo w-15 text-start" style="text-align: left !important; padding-left: 10px;">
                            Format No.: QA/060/F1-01
                        </td>
                    </tr>
                </tbody>
            </table>
    </footer>
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