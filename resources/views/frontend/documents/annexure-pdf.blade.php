<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: "Open Sans", "Roboto", "Noto Sans KR", "Poppins", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }

        .symbol-support {
            font-family: "DeJaVu Sans Mono", monospace !important;
        }

        html {
            text-align: justify;
            text-justify: inter-word;
        }

        /* table {
            width: 100%;
            table-layout: fixed;
        } */

        td,
        th {
            text-align: center;
        }

        .w-5 { width: 5%; }
        .w-10 { width: 10%; }
        .w-15 { width: 15%; }
        .w-20 { width: 20%; }
        .w-25 { width: 25%; }
        .w-30 { width: 30%; }
        .w-33 { width: 33%; }
        .w-35 { width: 35%; }
        .w-40 { width: 40%; }
        .w-45 { width: 45%; }
        .w-50 { width: 50%; }
        .w-55 { width: 55%; }
        .w-60 { width: 60%; }
        .w-65 { width: 65%; }
        .w-70 { width: 70%; }
        .w-75 { width: 75%; }
        .w-80 { width: 80%; }
        .w-85 { width: 85%; }
        .w-90 { width: 90%; }
        .w-95 { width: 95%; }
        .w-100 { width: 100%; }

        .border {
            border: 1px solid black;
        }

        .border-top { border-top: 1px solid black; }
        .border-bottom { border-bottom: 1px solid black; }
        .border-left { border-left: 1px solid black; }
        .border-right { border-right: 1px solid black; }

        .border-top-none { border-top: 0px solid black; }
        .border-bottom-none { border-bottom: 0px solid black; }
        .border-left-none { border-left: 0px solid black; }
        .border-right-none { border-right: 0px solid black; }

        .p-20 { padding: 20px; }
        .p-10 { padding: 10px; }

        .text-left { text-align: left; word-wrap: break-word; }
        .text-right { text-align: right; }
        .text-justify { text-align: justify; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }

        .vertical-baseline { vertical-align: baseline; }

        .table-bordered { border-collapse: collapse; border: 1px solid grey; }
        .table-bordered td, .table-bordered th {
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
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        body {
            margin-top: 120px;
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

        header .doc-num{
            /* font-weight: bold; */
        }


        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        .MsoNormalTable tr {
            border: 1px solid rgb(156, 156, 156);
        }

        .MsoNormalTable td {
            text-align: left !important;
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

        /* .MsoNormalTable, .table {
            table-layout: fixed;
            width: 650px !important;
        } */

        p, b, div, h1, h2, h3, h4, h5, h6, ol, ul, li, span {
            page-break-after: auto;
            page-break-inside: auto;
        }

        ol, ul {
            page-break-before: auto;
            page-break-inside: auto;
        }

        li {
            page-break-after: auto;
            page-break-inside: auto;
        }

        h1, h2, h3, h4, h5, h6 {
            page-break-after: auto;
            page-break-inside: auto;
            page-break-before: auto;
        }

        .main-section {
            text-align: left;
        }

        .empty-page {
            page-break-after: always;
        }

        .other-container {
            margin: 0 0 0 0;
        }

        .other-container > table {
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

        .page-break-before {
            page-break-before: always;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        td, th {
            text-align: center;
            padding: 8px;
        }

        .MsoNormalTable, .table {
            table-layout: fixed;
            width: 100% !important;
            box-sizing: border-box;
        }

        .MsoNormalTable td, .table td {
            word-wrap: break-word;
            padding: 10px;
        }
    </style>
    

    <style>
        
        /* =====================================================
        ANNEXURE CONTENT
        Supports text, headings, lists, tables and images
        ===================================================== */

        .annexure-wrapper {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .annexure-main-title {
            font-size: 14px !important;
            line-height: 1.4 !important;
            text-align: center !important;
            font-weight: bold !important;
            text-transform: uppercase;
            margin: 0 0 15px 0 !important;
            padding: 0 !important;
        }

        .annexure-item {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        .annexure-title {
            font-size: 13px !important;
            line-height: 1.4 !important;
            font-weight: bold !important;
            text-align: left !important;
            margin: 0 0 10px 0 !important;
            padding: 0 !important;
        }

        .annexure-quill-content {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            font-size: 12px !important;
            line-height: 1.5 !important;
            text-align: justify;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* Normal paragraphs */
        .annexure-quill-content p {
            font-size: 12px !important;
            line-height: 1.5 !important;
            font-weight: normal;
            margin: 3px 0 6px 0 !important;
            padding: 0 !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Quill headings */
        .annexure-quill-content h1,
        .annexure-quill-content h2,
        .annexure-quill-content h3,
        .annexure-quill-content h4,
        .annexure-quill-content h5,
        .annexure-quill-content h6 {
            font-size: 12px !important;
            line-height: 1.5 !important;
            font-weight: bold !important;
            margin: 8px 0 4px 0 !important;
            padding: 0 !important;
            page-break-after: avoid;
        }

        /* Inline content */
        .annexure-quill-content span,
        .annexure-quill-content div,
        .annexure-quill-content label {
            font-size: 12px;
            line-height: 1.5;
            max-width: 100%;
            box-sizing: border-box;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Bold and italic */
        .annexure-quill-content strong,
        .annexure-quill-content b {
            font-weight: bold !important;
        }

        .annexure-quill-content em,
        .annexure-quill-content i {
            font-style: italic !important;
        }

        .annexure-quill-content u {
            text-decoration: underline !important;
        }

        /* Lists */
        .annexure-quill-content ul,
        .annexure-quill-content ol {
            font-size: 12px !important;
            line-height: 1.5 !important;
            margin: 4px 0 8px 0 !important;
            padding-left: 25px !important;
        }

        .annexure-quill-content li {
            font-size: 12px !important;
            line-height: 1.5 !important;
            margin: 2px 0 !important;
            padding: 0 !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* =====================================================
        TABLE HANDLING
        ===================================================== */

        .annexure-quill-content table,
        .annexure-quill-content .table,
        .annexure-quill-content .MsoNormalTable {
            width: 100% !important;
            max-width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            box-sizing: border-box;
            margin: 6px 0 10px 0 !important;
            page-break-inside: auto;
        }

        .annexure-quill-content thead {
            display: table-header-group;
        }

        .annexure-quill-content tfoot {
            display: table-footer-group;
        }

        .annexure-quill-content tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .annexure-quill-content table,
        .annexure-quill-content th,
        .annexure-quill-content td {
            border: 1px solid #000 !important;
        }

        .annexure-quill-content th,
        .annexure-quill-content td {
            font-size: 10px !important;
            line-height: 1.35 !important;
            padding: 5px !important;
            text-align: left;
            vertical-align: top !important;
            word-break: break-word;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal !important;
            box-sizing: border-box;
        }

        .annexure-quill-content th {
            font-weight: bold !important;
            text-align: center;
        }

        /* Remove unwanted pasted Word dimensions */
        .annexure-quill-content table[width],
        .annexure-quill-content td[width],
        .annexure-quill-content th[width] {
            width: auto !important;
        }

        /* Paragraphs inside table cells */
        .annexure-quill-content td p,
        .annexure-quill-content th p {
            font-size: 10px !important;
            line-height: 1.35 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* =====================================================
        IMAGE HANDLING
        ===================================================== */

        .annexure-quill-content img {
            display: block;
            width: auto !important;
            max-width: 100% !important;
            height: auto !important;
            max-height: 600px;
            object-fit: contain;
            margin: 6px auto !important;
            page-break-inside: avoid;
        }

        /* Images inside table cells */
        .annexure-quill-content td img,
        .annexure-quill-content th img {
            display: block;
            width: auto !important;
            max-width: 100% !important;
            height: auto !important;
            max-height: 300px;
            object-fit: contain;
            margin: 4px auto !important;
        }

        /* =====================================================
        QUILL ALIGNMENT CLASSES
        ===================================================== */

        .annexure-quill-content .ql-align-center {
            text-align: center !important;
        }

        .annexure-quill-content .ql-align-right {
            text-align: right !important;
        }

        .annexure-quill-content .ql-align-justify {
            text-align: justify !important;
        }

        .annexure-quill-content .ql-align-left {
            text-align: left !important;
        }

        /* Quill indentation */
        .annexure-quill-content .ql-indent-1 {
            margin-left: 20px !important;
        }

        .annexure-quill-content .ql-indent-2 {
            margin-left: 40px !important;
        }

        .annexure-quill-content .ql-indent-3 {
            margin-left: 60px !important;
        }

        .annexure-quill-content .ql-indent-4 {
            margin-left: 80px !important;
        }

        /* Links */
        .annexure-quill-content a {
            color: #000 !important;
            text-decoration: underline;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Blockquote */
        .annexure-quill-content blockquote {
            font-size: 12px !important;
            line-height: 1.5 !important;
            margin: 8px 0 8px 15px !important;
            padding-left: 10px !important;
            border-left: 3px solid #777;
        }

        /* Code blocks */
        .annexure-quill-content pre,
        .annexure-quill-content code {
            font-family: "DejaVu Sans Mono", monospace !important;
            font-size: 10px !important;
            white-space: pre-wrap !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Prevent pasted content from overflowing */
        .annexure-quill-content * {
            max-width: 100%;
            box-sizing: border-box;
        }
        
    </style>
    

</head>
<body>
    <header class="">
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td class="logo w-20">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 55px; max-width: 40px;">
                    </td>
                    <td class="title w-60"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center;">{{ config('site.pdf_title') }}</p>
                        <p style="margin: 0; text-align: center;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>


    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
            <table class="border" style="width: 100%; border-collapse: collapse; text-align: left;">

            <tbody>
                <tr style="border-bottom: 1px solid #ddd;">
                    @php
                        $inreviews = DB::table('stage_manages')
                            ->join('users', 'stage_manages.user_id', '=', 'users.id')
                            ->select('stage_manages.*', 'users.name as user_name')
                            ->where('document_id', $document->id)
                            ->where('stage', 'Approval-Submit')
                            ->where('deleted_at', null)
                            ->get();
                          
                    @endphp
                    <td style="padding: 10px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Approved By:Head QA/CQA
                        <!-- @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                                <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif  -->
                    </td>
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 16px;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                            
                                <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                                  <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif
                    </th>
                   <td style="padding: 20px; border: 1px solid #ddd;">
                        Page No.
                    </td>
                             
                </tr>
               
            </tbody>

          
        </table>
          <span>Format No.:  {{ $annexureDocumentNumber }}</span>
    </footer>
    
  <div class="content">
    <section>
        <div class="procedure-block">
            <div class="w-100">
                <div class="w-100" id="table1">

                    <h3 style="text-align:center;margin-bottom:20px;">
                        ANNEXURE {{ $annexureNo }}
                    </h3>

                    <div class="annexure-quill-content">
                        {!! $annexure !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
