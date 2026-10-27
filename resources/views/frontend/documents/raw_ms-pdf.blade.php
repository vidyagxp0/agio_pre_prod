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
        header td, header th { font-size: 14px; }
        header td.title p { font-size: 14px; }

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
            height: 60px; /* Set a specific height for the header */

        }

        body {
            margin-top: 260px;
            margin-bottom: 160px;   /* footer ke liye jagah (har page par) */
        }

        /* FIXED footer: har page par repeat hota hai (sirf Prepared By + Checked By).
           Page 1 par ye script se hide hota hai, wahan content ke baad 3-column table aata hai */
       footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 160px;
            background: #fff;
        }

        .footer-first {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 160px;
                background: #fff;
                z-index: 2000;
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

        .quill-pdf-content { text-align: left !important; }
        .quill-pdf-content table {
            width: 100%;
            table-layout: auto;
            border-collapse: collapse;
        }
        .quill-pdf-content table, .quill-pdf-content th, .quill-pdf-content td {
            border: 1px solid #000 !important;
            text-align: left !important;
            vertical-align: top;
        }
        .quill-pdf-content th { background: #f4f4f4; font-weight: bold; }
        .quill-pdf-content td.rs-first { border-bottom: none !important; }
        .quill-pdf-content td.rs-mid   { border-top: none !important; border-bottom: none !important; }
        .quill-pdf-content td.rs-last  { border-top: none !important; }
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
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after:auto;
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
        .quill-pdf-content th,
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
        .quill-pdf-content th,
        .quill-pdf-content td { font-size: 14px; line-height: 1.35; padding: 3px 5px; vertical-align: top; text-align: left; word-wrap: break-word; overflow-wrap: break-word; white-space: normal; }    
        .quill-pdf-content sub { vertical-align: sub; font-size: 10px; line-height: 0; }
        .quill-pdf-content sup { vertical-align: super; font-size: 10px; line-height: 0; }  
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

    <style>
        .first-page-stp { width: 100%; margin: 0 0 8px 0; padding: 0; }
        .first-page-stp table { width: 100%; border-collapse: collapse; table-layout: fixed; margin: 0; }
        .first-page-stp td {
            padding: 5px;
            border: 1px solid #000;
            text-align: left;
            font-weight: bold;
        }
        .first-page-content { width: 100%; margin-top: 0; }
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
                    <td style="font-weight: bold; font-size: 14px;">
                       RAW MATERIAL SPECIFICATION
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                   <td style="font-weight: bold;">
                        @if(!empty( $document->material_name ))
                           {{ $document->material_name}}
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
                        {{-- @if($document->revised == 'Yes')
                            @php
                                $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
                            @endphp

                                @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                    RMS/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                                @else
                                    RMS/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                                @endif
                        @else
                                @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                   RMS/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}-00
                                @else
                                   RMS/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}-00
                                @endif
                        @endif --}}
                        {{$document->document_number ?? 'NA'}}
                      </span>
                    </td>
                    <td class="w-50"
                        style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">
                        Effective Date:
                        <span>
                            @if ($data->training_required == 'yes')
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
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;"
                        class="doc-num">
                        Reference:
                        <span>
                            {{ $document->refrence_rms ?? 'N/A' }}
                        </span>
                    </td>
                    

                </tr>
            </tbody>
        </table>

         <table class="border border-top-none" style="width: 100%;">
            <tbody>
               <tr>
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">
                        STP No.:
                        <span>
                            RMSTP/{{ str_pad(explode('/', $data->document_number)[1] ?? '', 4, STR_PAD_LEFT) }}
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
    @endphp

    {{-- FIXED FOOTER (har page par): sirf Prepared By + Checked By.
         Page 1 par ye footer script se hide hota hai, wahan neeche wala 3-column table aata hai --}}
    <footer class="footer" style="font-family: Arial, sans-serif; font-size: 14px;">
        <table class="border" style="width: 100%; border-collapse: collapse; table-layout: fixed; text-align: left;">
            <thead>
                <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                    <th style="width: 10%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;"></th>
                    <th style="width: 45%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Prepared By</th>
                    <th style="width: 45%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Checked By</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;">
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Sign</th>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                                <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        {{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                    </td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                                <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <span>
            Format No.: QA/097/F5-01
        </span>
    </footer>

    {{-- PAGE 1 ONLY: Prepared + Checked + Approved --}}
    <div class="footer-first" style="font-size: 14px;">
        <table class="border" style="width: 100%; border-collapse: collapse; table-layout: fixed; text-align: left;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="width: 10%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;"></th>
                    <th style="width: 30%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Prepared By</th>
                    <th style="width: 30%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Checked By</th>
                    <th style="width: 30%; padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Approved By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Sign</th>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                                <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif
                    </td>
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
                <tr>
                    <td style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        {{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                    </td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                        @if ($inreviews->isEmpty())
                            <div>Yet Not Performed</div>
                        @else
                            @foreach ($inreviews as $temp)
                                <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                            @endforeach
                        @endif
                    </td>
                    <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
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
        <span>Format No.: QA/097/F5-01</span>
    </div>

    <div style="margin-top: 10px;">
        <section class="main-section" id="pdf-page">
            <section style="page-break-after: never;">
                <div class="other-container">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div style="font-weight: bold;">GENERAL INFORMATION</div>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <table class="border" style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 15px; ">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">CAS No.
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->cas_no_row_material }}</td>
                            </tr>
                  
                            {{-- <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Molecular Formula</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;" class="quill-pdf-content">
                                    {!! $data->molecular_formula_row_material !!}
                                </td>
                            </tr> --}}
                            @php
                                // Unicode subscript/superscript ko real <sub>/<sup> me convert karo
                                $subMap = ['₀'=>'0','₁'=>'1','₂'=>'2','₃'=>'3','₄'=>'4','₅'=>'5','₆'=>'6','₇'=>'7','₈'=>'8','₉'=>'9'];
                                $supMap = ['⁰'=>'0','¹'=>'1','²'=>'2','³'=>'3','⁴'=>'4','⁵'=>'5','⁶'=>'6','⁷'=>'7','⁸'=>'8','⁹'=>'9','⁺'=>'+','⁻'=>'-'];

                                $fixSubSup = function ($html) use ($subMap, $supMap) {
                                    $html = (string) $html;
                                    $html = preg_replace_callback('/[\x{2080}-\x{2089}]+/u', function ($m) use ($subMap) {
                                        return '<sub>' . strtr($m[0], $subMap) . '</sub>';
                                    }, $html);
                                    $html = preg_replace_callback('/[\x{2070}\x{00B9}\x{00B2}\x{00B3}\x{2074}-\x{207B}]+/u', function ($m) use ($supMap) {
                                        return '<sup>' . strtr($m[0], $supMap) . '</sup>';
                                    }, $html);
                                    return $html;
                                };

                                $molecular_formula = $fixSubSup(
                                    \App\Helpers\ProcedureHtml::clean(
                                        Helpers::renderQuillPdf($data->molecular_formula_row_material ?? '')
                                    )
                                );
                                $molecular_weight = $fixSubSup(
                                    \App\Helpers\ProcedureHtml::clean(
                                        Helpers::renderQuillPdf($data->molecular_weight_row_material ?? '')
                                    )
                                );
                            @endphp
                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Molecular Formula</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">
                                    <div class="quill-pdf-content">{!! $molecular_formula !!}</div>
                                </td>
                            </tr>

                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Molecular Weight</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;" class="quill-pdf-content">
                                    {!! $data->molecular_weight_row_material !!}
                                </td>
                            </tr>


                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Storage Condition
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->storage_condition_row_material }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Retest Period
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->retest_period_row_material }}</td>
                            </tr>

                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">
                                    Sampling procedure
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; max-height: 100px; overflow: hidden;" class="quill-pdf-content">
                                    {!! $data->sampling_procedure_row_material !!}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Item Code
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->item_code_row_material }}</td>
                            </tr>
                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">
                                    Sample Quantity for analysis
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; max-height: 100px; overflow: hidden;" class="quill-pdf-content">
                                    {!! $data->sample_quantity_row_material !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Reserve Sample Quantity
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->reserve_sample_quantity_row_material }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Sample Quantity for Retest
                                </td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">{{ $data->retest_sample_quantity_row_material }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

              
            </section>
        </section>
    </div>


            <div class="other-container page-break-before">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">
                                <div class="bold">
                                    Sampling instructions, warning and precautions
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>

                <div class="">
                    @php
                        $si = $data->sampling_instructions_row_material ?? '';

                        if (!empty(trim(strip_tags($si))) && stripos($si, '<li') === false) {
                            $plain = trim(strip_tags($si));

                            $parts = preg_split('/(?:^|\s)\d+\.\s+(?=\S)/u', $plain, -1, PREG_SPLIT_NO_EMPTY);

                            $parts = array_map('trim', $parts);
                        } else {
                            $parts = null;
                        }
                    @endphp

                    @if (is_array($parts) && count($parts) > 0)
                        <ol style="margin: 0; padding-left: 18px;">
                            @foreach ($parts as $p)
                                <li style="margin-bottom: 3px;">
                                    {{ $p }}
                                </li>
                            @endforeach
                        </ol>
                    @else
                        {!! $si !!}
                    @endif
                </div>
            </div>

            <div class="other-container page-break-before">
                <table>
                    <thead>
                        <tr>
                             <th class="text-center">
                                <div class="bold">Specification</div>
                            </th>
                        </tr>
                    </thead>
                </table>

                @php
                    $rawmaterials_specifications = \App\Helpers\ProcedureHtml::flattenRowspans(
                        \App\Helpers\ProcedureHtml::clean(
                            Helpers::renderQuillPdf($document->rawmaterials_specifications ?? '')
                        )
                    );
                @endphp
                
                <div class="quill-pdf-content" >
                    {!! $rawmaterials_specifications !!}
                </div>
            </div>


           {{-- REVISION HISTORY: nayi page se start --}}
            <div class="page-break-before">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">
                                <div class="bold" style="font-size: 14px;">REVISION HISTORY</div>
                            </th>
                        </tr>
                    </thead>
                </table>

                <div class="table-responsive retrieve-table">
                    <table class="table table-bordered" id="distribution-list">
                        <thead>
                            <tr>
                                <th style="font-size: 14px; font-weight: bold; width:15%">Revision No.</th>
                                {{-- <th style="font-size: 14px; font-weight: bold; width:20%">Change Control No.</th> --}}
                                <th style="font-size: 14px; font-weight: bold; width:25%">Effective Date</th>
                                <th style="font-size: 14px; font-weight: bold; width:60%">Details of Revision</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($RevisionGridrawmsData))
                                @foreach ($RevisionGridrawmsData as $key => $item)
                                    <tr>
                                        <td style="border: 1px solid black; width: 15%;">{{ $item['rev_rawms_no'] ?? '' }}</td>
                                        {{-- <td style="border: 1px solid black; width: 20%;">{{ $item['change_ctrl_rawms_no'] ?? '' }}</td> --}}
                                        <td style="border: 1px solid black; width: 25%;">
                                            @if ($data->training_required == 'yes' && $data->stage >= 11)
                                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                            @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                                {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                            @else
                                                {{ !empty($item['eff_date_rawms']) ? \Carbon\Carbon::parse($item['eff_date_rawms'])->format('d-M-Y') : '' }}
                                            @endif
                                        </td>
                                        <td style="border: 1px solid black; width: 60%;">{{ $item['rev_reason_rawms'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" style="text-align: center; font-weight: bold;">No Data Available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


            <script type="text/php">
                if (isset($pdf)) {
                    $pdf->page_script('
                        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                        $size = 10;
                        $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
                        $pdf->text(380, 166, $pageText, $font, $size);
                    ');
                }
            </script>

            <script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 10;
            $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
            $pdf->text(380, 166, $pageText, $font, $size);

            // Page 1 par STP No. row ko white box se cover karo
             if ($PAGE_NUM == 1) {
                $coverX = 28;
                $coverY = 209;   // pehle 192 tha, ab ~22pt neeche
                $coverW = 568;
                $coverH = 24;
                $pdf->filled_rectangle($coverX, $coverY, $coverW, $coverH, array(1, 1, 1));
            }
        ');
    }
</script>

</body>
</html>