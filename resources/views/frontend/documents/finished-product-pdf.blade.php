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
            font-weight: 400;
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

        .border { border: 1px solid black; }

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

        /* ===========================================================
           MAIN FIX: page margins.
           dompdf me body margin-top sirf 1st page par lagta hai.
           Isliye header ki jagah @page margin se reserve karte hain,
           jo HAR page par apply hota hai.

           margin-top    = header ki total height + chhota gap
           margin-bottom = footer ki total height + chhota gap
           Agar header/content ke beech gap kam/zyada lage to sirf
           margin-top (aur header/wrapper ka top) adjust karo.
           =========================================================== */
        @page {
            size: A4;
            margin: 215pt 35pt 150pt 35pt;
        }

        /* Fixed header: top negative hota hai taaki wo page ke margin
           area (upar) me baithe, content area me nahi.
           195pt (margin) - 35pt (page ke top se header ki jagah) = 160pt */
        .header-wrapper {
            position: fixed;
            top: -180pt;
            left: 0;
            right: 0;
        }

        header {
            position: static;   /* wrapper ke andar normal flow me */
            width: 100%;
        }

        /* Fixed footer: 150pt (margin) - 34pt (page ke bottom se gap) = 116pt */
        footer {
            position: fixed;
            bottom: -116pt;
            left: 0;
            right: 0;
            width: 100%;
            height: 120pt;
        }

        body {
            margin: 0;
            padding: 0;
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

        .keep-together {
            page-break-inside: avoid;
        }
    </style>

    <style>
        .quill-pdf-content {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            font-size: 14px;
            line-height: 1.5;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* Paragraph */
        .quill-pdf-content p {
            font-size: 14px !important;
            line-height: 1.5 !important;
            margin: 4px 0 7px 0 !important;
            padding: 0 !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Div / Span */
        .quill-pdf-content div,
        .quill-pdf-content span {
            max-width: 100%;
            box-sizing: border-box;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Headings */
        .quill-pdf-content h1,
        .quill-pdf-content h2,
        .quill-pdf-content h3,
        .quill-pdf-content h4,
        .quill-pdf-content h5,
        .quill-pdf-content h6 {
            line-height: 1.4 !important;
            font-weight: bold !important;
            margin: 8px 0 !important;
            padding: 0 !important;
            page-break-after: avoid;
        }

        /* Bold */
        .quill-pdf-content strong,
        .quill-pdf-content b {
            font-weight: bold !important;
        }

        /* Italic */
        .quill-pdf-content em,
        .quill-pdf-content i {
            font-style: italic !important;
        }

        /* Underline */
        .quill-pdf-content u {
            text-decoration: underline !important;
        }

        /* =====================================================
        LISTS
        ===================================================== */

        .quill-pdf-content ul,
        .quill-pdf-content ol {
            margin: 5px 0 8px 0 !important;
            padding-left: 25px !important;
        }

        .quill-pdf-content li {
            margin: 2px 0 !important;
            line-height: 1.5 !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* =====================================================
        TABLE
        ===================================================== */

        .quill-pdf-content table {
            width: 100% !important;
            max-width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 8px 0 12px 0 !important;
            box-sizing: border-box;
        }

        .quill-pdf-content table,
        .quill-pdf-content th,
        .quill-pdf-content td {
            border: 1px solid #000 !important;
        }

        .quill-pdf-content th,
        .quill-pdf-content td {
            font-size: 13px !important;
            line-height: 1.35 !important;
            padding: 5px !important;
            text-align: left !important;
            vertical-align: top !important;
            word-break: break-word !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
            box-sizing: border-box;
        }

        /* Table paragraph */
        .quill-pdf-content td p,
        .quill-pdf-content th p {
            font-size: 13px !important;
            line-height: 1.35 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Table row */
        .quill-pdf-content tr {
            page-break-inside: avoid;
        }

        /* Table header */
        .quill-pdf-content th {
            font-weight: bold !important;
            text-align: center !important;
        }

        /* =====================================================
        IMAGES
        ===================================================== */

        .quill-pdf-content img {
            display: block;
            width: auto !important;
            max-width: 100% !important;
            height: auto !important;
            margin: 6px auto !important;
            page-break-inside: avoid;
        }

        .quill-pdf-content td img,
        .quill-pdf-content th img {
            display: block;
            width: auto !important;
            max-width: 100% !important;
            height: auto !important;
            margin: 4px auto !important;
        }

        /* =====================================================
        QUILL ALIGNMENT
        ===================================================== */

        .quill-pdf-content .ql-align-left {
            text-align: left !important;
        }

        .quill-pdf-content .ql-align-center {
            text-align: center !important;
        }

        .quill-pdf-content .ql-align-right {
            text-align: right !important;
        }

        .quill-pdf-content .ql-align-justify {
            text-align: justify !important;
        }

        /* Inline alignment */
        .quill-pdf-content [style*="text-align: center"],
        .quill-pdf-content [style*="text-align:center"] {
            text-align: center !important;
        }

        .quill-pdf-content [style*="text-align: right"],
        .quill-pdf-content [style*="text-align:right"] {
            text-align: right !important;
        }

        .quill-pdf-content [style*="text-align: left"],
        .quill-pdf-content [style*="text-align:left"] {
            text-align: left !important;
        }

        .quill-pdf-content [style*="text-align: justify"],
        .quill-pdf-content [style*="text-align:justify"] {
            text-align: justify !important;
        }

        /* =====================================================
        LINKS
        ===================================================== */

        .quill-pdf-content a {
            color: #000 !important;
            text-decoration: underline;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* =====================================================
        BLOCKQUOTE
        ===================================================== */

        .quill-pdf-content blockquote {
            margin: 8px 0 8px 15px !important;
            padding-left: 10px !important;
            border-left: 3px solid #777 !important;
        }

        /* =====================================================
        PRE / CODE
        ===================================================== */

        .quill-pdf-content pre,
        .quill-pdf-content code {
            font-family: "DejaVu Sans Mono", monospace !important;
            font-size: 13px !important;
            white-space: pre-wrap !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
        }

        /* =====================================================
        GENERAL
        ===================================================== */

        .quill-pdf-content * {
            max-width: 100%;
            box-sizing: border-box;
        }

        .quill-pdf-content table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        .quill-pdf-content td,
        .quill-pdf-content th {
            padding: 5px !important;
        }

        .quill-pdf-content table td,
        .quill-pdf-content table th {
            border: 1px solid #000 !important;
            padding: 5px !important;
            vertical-align: top !important;
        }
        .header-wrapper{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        .master-copy {
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

    <style>
        .first-page-stp {
            width: 100%;
            margin: -20pt 0 10px 0;   /* sirf yahin negative margin */
            padding: 0;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .first-page-stp table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin: 0;
        }

        .first-page-stp td {
            padding: 5px;
            border: 1px solid #000;
            text-align: left;
            font-weight: bold;
            /* font-size hata diya: header ke Supersedes No. wala default size lega */
        }

        .first-page-content {
            width: 100%;
            margin-top: 0;            /* -20pt hata diya */
        }
    </style>
</head>
<body>
    <div class="header-wrapper">

        @if ($document->status == 'Effective' || $document->status == 'Obsolete')
            {{-- Existing normal SOP master-copy logic --}}
            <div class="master-copy">
                MASTER COPY
            </div>
        @endif

        <header>
            <table class="border" style="width: 100%;">
                <tbody>
                    <tr>
                        <td class="logo w-15">
                            <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                                style="max-height: 55px; max-width: 40px;">
                        </td>
                        <td class="title w-50"
                            style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                            <p style="margin: 0; text-align: center; font-weight: bold;">{{ config('site.pdf_title') }}</p>
                            <p style="margin: 0; text-align: center;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="font-weight: bold;">
                            FINISHED PRODUCT SPECIFICATION
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>
                            @if(!empty($data->fsproduct_name))
                              {{ $data->fsproduct_name }}
                            @else
                              -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Specification No.:

                            <span>
                                @php
                                    $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
                                @endphp

                              {{$document->document_number ?? 'NA'}}
                            </span>
                        </td>
                        <td class="w-50"
                            style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">
                            Effective Date:
                            <span>@if ($data->training_required == 'yes')
                                @if ($data->stage >= 11)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @endif
                            @else
                                @if ($data->stage > 10)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @endif
                            @endif
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Supersedes No.:
                        <span>

                       @php
                           $temp = DB::table('document_types')
                               ->where('name', $document->document_type_name)
                               ->value('typecode');
                       @endphp

                        @if($document->revised == 'Yes' && $document->revised_doc)
                            {{ $document->supersedes_no ?? 'Nil' }}
                        @else
                            Nil
                        @endif

                       </span>

                        </td>
                        <td class="w-50"
                            style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">
                            Page No.:
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>
    </div>


    <footer class="footer" style="font-family: Arial, sans-serif; font-size: 14px;">
        <table class="border" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;"></th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Prepared By</th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Checked By</th>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Approved By</th>
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
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Sign</th>
                    <td style="padding: 5px; border: 1px solid #ddd;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td style="padding: 5px; border: 1px solid #ddd;">
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                    </td>
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
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</td>
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
        <span>
            Format No.: QA/097/F2-01
        </span>
    </footer>

    <div class="first-page-content">
        <section class="main-section" id="pdf-page">

            {{-- ==========================================
                 STP NO. - FIRST PAGE ONLY
                 (content ke start me hai, isliye page 2+ par repeat nahi hoga)
                 ========================================== --}}
            <div class="first-page-stp">
                <table>
                    <tbody>
                        <tr>
                            <td class="doc-num">
                                STP No.:
                                <span>FPSTP/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            {{-- ==========================================
                 FIRST PAGE CONTENT
                 ========================================== --}}
            <section class="first-page-section">

                <div class="other-container">

                    {{-- GENERAL INFORMATION --}}
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div style="font-weight: bold;">
                                        GENERAL INFORMATION
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <br>


                    {{-- GENERIC NAME / BRAND NAME --}}
                    <table class="keep-together"
                           style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 12px;">
                        <tbody>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Generic Name
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->generic_name }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Brand Name
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->brand_name }}
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    {{-- LABEL CLAIM --}}
                    <div class="other-container">

                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        
                                        <div class="bold">
                                            Label Claim
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>

                        <div class="custom-procedure-block">
                            <div class="custom-container">
                                <div class="custom-table-wrapper">
                                    <div class="custom-procedure-content">
                                        <div class="custom-content-wrapper">
                                            @php
                                                $label_claim = \App\Helpers\ProcedureHtml::clean(
                                                    Helpers::renderQuillPdf($data->label_claim ?? '')
                                                );
                                            @endphp
                                            <div class="quill-pdf-content">
                                                {!! $label_claim !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- PRODUCT CODE / STORAGE CONDITION --}}
                    <table class="keep-together">
                        <tbody>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Product Code
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->product_code }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Storage Condition
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->fsstorage_condition }}
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    {{-- SAMPLE QUANTITY FOR ANALYSIS --}}
                    <div class="other-container">

                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        <div class="bold">
                                            Sample Quantity for Analysis
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>

                        <div class="custom-procedure-block">
                            <div class="custom-container">
                                <div class="custom-table-wrapper">
                                    <div class="custom-procedure-content">
                                        <div class="custom-content-wrapper">
                                            @php
                                                $sample_quantity = \App\Helpers\ProcedureHtml::clean(
                                                    Helpers::renderQuillPdf($data->sample_quantity ?? '')
                                                );
                                            @endphp
                                            <div class="quill-pdf-content">
                                                {!! $sample_quantity !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- SAMPLE DETAILS --}}
                    <table class="keep-together">
                        <tbody>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Reserve Sample Quantity
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->reserve_sample }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Custom Sample
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->custom_sample }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Reference
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->reference }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black; font-weight: bold;">
                                    Sampling Instructions Warning and Precautions
                                </td>

                                <td style="width: 50%; padding: 3px; text-align: left;
                                           border: 1px solid black;">
                                    {{ $data->sampling_instructions }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </section>

        </section>
    </div>

    <div class="other-container">
        <table>
            <thead>
                <tr>
                    <th class="text-center">
                        <div class="bold">SPECIFICATION</div>
                    </th>
                </tr>
            </thead>
        </table>
        <div class="custom-procedure-block">
            <div class="custom-container">
                <div class="custom-table-wrapper" id="custom-table2">
                    <div class="custom-procedure-content">
                        <div class="custom-content-wrapper">
                            @php
                                $fps_specificationGrid = \App\Helpers\ProcedureHtml::clean(
                                    Helpers::renderQuillPdf($data->fps_specificationGrid ?? '')
                                );
                            @endphp
                            <div class="quill-pdf-content">
                                {!! $fps_specificationGrid !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-left">
                    <div class="bold">REVISION HISTORY:</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="margin: 5px; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 18%; font-weight: bold;">Revision No.</th>
                <th style="border: 1px solid black; font-weight: bold; width:30%">Change Control No.</th>
                <th style="border: 1px solid black; width: 18%; font-weight: bold;">Effective Date</th>
                <th style="border: 1px solid black; width: 60%; font-weight: bold;">Reason of revision</th>
            </tr>
        </thead>
        <tbody>

            @if (!empty($RevisionProductSpecificationData))
                @foreach ($RevisionProductSpecificationData as $key => $item)
                    <tr>
                        <td style="border: 1px solid black; width: 20%;">{{ $item['rev_no'] ?? '' }}</td>
                        <td style="border: 1px solid black; width: 20%;">{{ $item['change_ctrl_no'] ?? '' }}</td>
                        <td style="border: 1px solid black; width: 20%;">
                            @if ($data->training_required == 'yes' && $data->stage >= 11)
                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                            @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                            @else
                                {{ !empty($item['eff_date']) ? \Carbon\Carbon::parse($item['eff_date'])->format('d-M-Y') : '' }}
                            @endif
                        </td>
                        <td style="border: 1px solid black; width: 60%;">{{ $item['rev_reason'] ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold;">No Data Available</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 175;
                $x = 365;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>