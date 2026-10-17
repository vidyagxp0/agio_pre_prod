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

        @page { size: A4; margin: 130px 34px 120px 34px; }

        header {
            position: fixed;
            top: -96px;           /* 130 - 34 */
            left: 0;
            width: 100%;
            background: #fff;
        }

        footer {
            position: fixed;
            bottom: -86px;        /* 120 - 34 */
            left: 0;
            width: 100%;
            background: #fff;
        }

        body { margin: 0; padding: 0; }
        
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
        .rich-pdf-content { width: 100%; font-size: 15px; line-height: 1.4; text-align: left; word-wrap: break-word; }
        .rich-pdf-content p { margin: 0 0 4px 0; }
        .rich-pdf-content ul, .rich-pdf-content ol { padding-left: 20px; margin: 2px 0 4px 0; }
        .rich-pdf-content table { width: 100%; table-layout: fixed; border-collapse: collapse; margin: 4px 0 8px 0; }
        .rich-pdf-content table, .rich-pdf-content th, .rich-pdf-content td { border: 1px solid #000; }
        .rich-pdf-content th, .rich-pdf-content td { font-size: 11px; padding: 2px 4px; vertical-align: top; text-align: left; word-wrap: break-word; }
        .rich-pdf-content th { font-weight: bold; text-align: center; }
        .rich-pdf-content td p, .rich-pdf-content th p { margin: 0; }
        .rich-pdf-content table.pdf-borderless, .rich-pdf-content table.pdf-borderless th, .rich-pdf-content table.pdf-borderless td { border: none; }
        .rich-pdf-content thead { display: table-header-group; }
        .rich-pdf-content img { max-width: 100%; height: auto; }

        .master-copy {
            position: fixed;
            top: -110px;
            right: 10px;
            border: 2px solid #00bcd4;
            color: #00bcd4;
            font-size: 14px;
            font-weight: bold;
            padding: 4px 12px;
            background: #fff;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

        @if ($document->status == 'Effective' || $document->status == 'Obsolete')

            {{-- Existing normal SOP master-copy logic --}}
            <div class="master-copy">
                MASTER COPY
            </div>

        @endif
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

                        @if(!empty($noDataFound) && $noDataFound)

                            <div style="
                                text-align: center;
                                margin-top: 300px;
                                font-size: 22px;
                                font-weight: bold;
                            ">
                                NO DATA FOUND
                            </div>

                        @else

                            <h3 style="text-align:center;margin-bottom:20px;">
                                ANNEXURE {{ $annexureNo }}
                            </h3>

                            <div class="rich-pdf-content">
                                {!! $annexure !!}
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
