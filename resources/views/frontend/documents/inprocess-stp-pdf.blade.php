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
            /* margin: 20mm; */
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        body {
            margin-top: 260px;
            margin-bottom: 170px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            margin-top: 10px;
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
    <div class="header-wrapper">

        @if ($data->status == 'Effective' || $data->status == 'Obsolete')

            {{-- Existing normal SOP master-copy logic --}}
            <div class="master-copy">
                MASTER COPY
            </div>

        @endif
    <header class="">
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
                      INPROCESS STANDARD TESTING PROCEDURE
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        @if(!empty($data->document_content->product_name_ipstp))
                          {{$data->document_content->product_name_ipstp}}
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
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">STP No.:
                    
                        <span>
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
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Supersedes No:
                  
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

    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
            <table class="border" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;"></th>
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Prepared By</th>
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Checked By</th>
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Approved By</th>
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
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Sign</th>
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">  
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
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Date</td>
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">
                        {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                        </td>
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                            <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif 
                        </td>

                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">
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
            <span style="text-align:center">Format No.: QA/097/F4-00</span>                            
    </footer>
    
    <div class="content">
    <section>
          <h4 style="font-size: 16px; font-weight: bold; text-align:center">STANDARD TESTING PROCEDURE</h4>

                <div class="other-container ">
                    <div class="custom-procedure-block">
                        <div class="custom-container">
                            <div class="custom-table-wrapper" id="custom-table2">
                                <div class="custom-procedure-content">
                                    @php
                                        $ipstp_testfield = \App\Helpers\ProcedureHtml::clean(
                                            Helpers::renderQuillPdf($data->document_content->ipstp_testfield ?? '')
                                        );
                                    @endphp
                                    <div class="quill-pdf-content">
                                        @if ($data->document_content)
                                            {!! $ipstp_testfield !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section>
          <h4 style="font-size: 16px; font-weight: bold; text-align:center">REVISION HISTORY</h4>
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
                        @if (!empty($RevisionGridinpstpData))
                            @foreach ($RevisionGridinpstpData as $key => $item)
                                <tr>
                                    <td style="font-size: 16px; font-weight: bold; width:20%">{{ $item['rev_inpstp_no'] ?? '' }}</td>
                                    <td style="font-size: 16px; font-weight: bold; width:20%">{{ $item['change_ctrl_inpstp_no'] ?? '' }}</td>
                                    <td style="font-size: 16px; font-weight: bold; width:20%">                                                    
                                        @if ($data->training_required == 'yes' && $data->stage >= 11)
                                            {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                        @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                            {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                        @else
                                            {{ !empty($item['eff_date_inpstp']) ? \Carbon\Carbon::parse($item['eff_date_inpstp'])->format('d-M-Y') : '' }}
                                        @endif
                                    </td>
                                    {{-- <td style="border: 1px solid black; width: 20%;">{{ \Carbon\Carbon::parse($item['eff_date_inpstp'])->format('d-M-Y') ?? '' }}</td> --}}
                                    <td style="font-size: 16px; font-weight: bold; width:20%">{{ $item['rev_reason_inpstp'] ?? '' }}</td>
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
        </section>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 170;
                $x = 405;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>
