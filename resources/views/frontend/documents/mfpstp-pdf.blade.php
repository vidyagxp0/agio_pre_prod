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
            height: 60px; /* Set a specific height for the header */

        }

        body {
            margin-top: 250px;
            margin-bottom: 160px;
            padding-top: 60px;
            padding-bottom: 50px; 
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 170px; /* Set a specific height for the footer */
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
        <div style="margin: 0; text-align: center; font-weight: bold;">Annexure - II</div>
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">
                       MASTER FINISHED PRODUCT STANDARD TESTING PROCEDURE 
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                      {Name of Product / Material}
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">STP No.:  
                    </td>
                    <td class="w-50"
                        style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">
                        Effective Date:
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Supersedes No.:
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
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Specification No.:
                    </td>
                </tr>
            </tbody>
        </table>
    </header>


    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
            <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                        <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Prepared By</th>
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
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 5px; border: 1px solid #ddd; font-size: 16px; font-weight: bold;">Date</td>
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

            <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
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
                    <td style="padding: 5px; border: 1px solid #ddd;">Approved By: Head QA</td>
                    <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px;">Sign/Date :{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}</th>
                    <td style="padding: 10px; border: 1px solid #ddd;">  </td>        
                </tr>
            </tbody>
        </table>
    </footer>
    


    <table style="margin: 5px; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No</th>
                <th style="border: 1px solid black; width: 90%; font-weight: bold;">Tests</th>

            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; text-align: center;">1</td>
                <td style="border: 1px solid black; text-align: center;"></td>

            <tr>
                <td style="border: 1px solid black; text-align: center;">2</td>
                <td style="border: 1px solid black; text-align: center;"></td>

            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">3</td>
                <td style="border: 1px solid black; text-align: center;"></td>

            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">4</td>
                <td style="border: 1px solid black; text-align: center;"></td>

        </tbody>
    </table>
    

    <table style="margin-top : 30px" class="border">
        <thead>
            <tr>
                <th class="text-center">
                    <div class="bold">REVISION HISTORY</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Revision No.</th>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Effective Date</th>
                <th style="border: 1px solid black; width: 50%; font-weight: bold;">Details of revision</th>
                <th style="border: 1px solid black; width: 15%; font-weight: bold;">Reviewed On</th>
                <th style="border: 1px solid black; width: 15%; font-weight: bold;">Reviewed By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; text-align: center;">1</td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">2</td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">3</td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">4</td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
        </tbody>
    </table>



    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 775;
                $x = 485;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>