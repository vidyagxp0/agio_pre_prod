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
            margin-top: 190px;
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

        /*Main Table Styling */
        #isPasted {
            width: 650px !important;
            border-collapse: collapse;
            table-layout: auto; /* Adjusts column width dynamically */
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; /* Prevent wrapping */
            width: 1%; /* Shrink to fit content */
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto; /* Take remaining space */
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
        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 500px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important; /* Ensure image doesn't overflow the cell */
            height: 100%; /* Maintain image aspect ratio */
            display: block; /* Remove extra space below the image */
            margin: 5px auto; /* Add spacing and center align */
        }

        /* If you want larger images */
        #isPasted td img {
            max-width: 400px !important; /* Adjust this to your preferred maximum width */
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
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">
                    STUDY REPORT
                    </td>
                </tr>
            </tbody>
        </table>
    </header>


    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
            {{-- <table class="border; padding: 5px;" style="width: 100%; border-collapse: collapse; text-align: left;">
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
            </table> --}}

            {{-- <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
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
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">Approved By: Head QA</td>
                        <th style="padding:7px 0 7px 0; border: 1px solid #ddd; font-size: 16px;">Sign/Date :{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}</th>
                        <td style="padding:7px 0 7px 0; border: 1px solid #ddd;">  </td>        
                    </tr>
                </tbody>
            </table> --}}
        <span style="text-align:center">Format No. QA/004/F22-00</span>                            
    </footer>
    
    <div class="content">

        <div style="font-size: 16px; font-weight: bold; text-align:center">Title Of Study : ______________ </div>
        <br>
        <div style="font-size: 16px; font-weight: bold; text-align:center">REPORT NUMBER : ______________</div>
        
        <section>
            <div style="margin-top:2 rem">
                <table border="1">
                    <thead>
                        <tr>
                        <th style="font-size: 16px; font-weight: bold;" colspan="5">Report approval</th>
                        </tr>
                        <tr>
                        <th></th>
                        <th style="font-size: 16px; font-weight: bold;">Department</th>
                        <th style="font-size: 16px; font-weight: bold;">Name</th>
                        <th style="font-size: 16px; font-weight: bold;">Designation</th>
                        <th style="font-size: 16px; font-weight: bold;">Sign and date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="font-size: 16px; font-weight: bold;">Prepared By</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td style="font-size: 16px; font-weight: bold;">Reviewed By</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td style="font-size: 16px; font-weight: bold;">Approved By</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
          <h4 style="font-size: 16px; font-weight: bold; text-align:center"></h4>
            <div class="table-responsive retrieve-table">
                <table class="table table-bordered" id="distribution-list">
                    <thead style="width:20%">
                        <tr>
                            <th style="font-size: 16px; font-weight: bold; width:10%">SR. NO.</th>
                            <th style="font-size: 16px; font-weight: bold; width:78%">TABLE OF CONTENTS</th>
                            <th style="font-size: 16px; font-weight: bold; width:12%">PAGE NUMBER</th>
                        </tr>
                    </thead>
                    <tbody style="">
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">1</td>
                            <td style="font-weight: bold; text-align:left">OBJECTIVE</td>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">2</td>
                            <td style="font-weight: bold; text-align:left">SCOPE</td>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">3</td>
                            <td style="font-weight: bold; text-align:left">RESPONSIBILITIES</td>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">4</td>
                            <td style="font-weight: bold; text-align:left">REFRENCES (IF ANY)</td>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">5</td>
                            <td style="font-weight: bold; text-align:left">ASSESSMENT & EVALUATION</td>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">6</td>
                            <td style="font-weight: bold; text-align:left">STRATEGY OF EVALUATION</td>
                            <td style="font-weight: bold;"></td>
                        </tr>                        
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">7</td>
                            <td style="font-weight: bold; text-align:left">SUMMARY AND FINDINGS</td>
                            <td style="font-weight: bold;"></td>
                        </tr>                        
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">8</td>
                            <td style="font-weight: bold; text-align:left">CONCLUSION & RECOMMANDATION</td>
                            <td style="font-weight: bold;"></td>
                        </tr>                        
                        <tr>
                            <td style="font-size: 16px; font-weight: bold;">9</td>
                            <td style="font-weight: bold; text-align:left">ATTACHEMENT</td>
                            <td style="font-weight: bold;"></td>
                        </tr>                       
                    </tbody>
                </table>
            </div>

                
            <div class="other-container" style="margin-top:1.5rem">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">1.</th>
                                <th class="text-left">
                                    <div class="bold">OBJECTIVE :</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                                <div class="w-100">
                                    <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                        {!! $data->document_content ? nl2br($data->document_content->study_purpose) : '' !!}
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
                                    <div class="bold">SCOPE :</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="scope-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div class="text-justify"
                                        style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        {!! $data->document_content ? nl2br($data->document_content->study_scope) : '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="mb-15">
                    <tbody>
                        <tr>
       
                        <th class="w-5 vertical-baseline">3.</th>
                            <th class="w-95 text-left">
                                <div class="bold">RESPONSIBILITIES :</div>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (
                                        $data->document_content &&
                                            !empty($data->document_content->responsibilities) &&
                                            is_array(unserialize($data->document_content->responsibilities)))
                                        @foreach (unserialize($data->document_content->responsibilities) as $key => $res)
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

                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">4.</th>
                            <th class="w-95 text-left">
                                <div class="bold">REFRENCES (IF ANY) :</div>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (
                                        $data->document_content &&
                                            !empty($data->document_content->referencesss) &&
                                            is_array(unserialize($data->document_content->referencesss)))
                                        @foreach (unserialize($data->document_content->referencesss) as $key => $res)
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

                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">5.</th>
                            <th class="w-95 text-left">
                                <div class="bold">ASSESSMENT & EVALUATION :</div>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php $i = 1; @endphp
                                    @if (
                                        $data->document_content &&
                                            !empty($data->document_content->assessment) &&
                                            is_array(unserialize($data->document_content->assessment)))
                                        @foreach (unserialize($data->document_content->assessment) as $key => $res)
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

                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">6.</th>
                            <th class="w-95 text-left">
                                <div class="bold">STRATEGY OF EVALUATION :</div>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (
                                        $data->document_content &&
                                            !empty($data->document_content->strategy) &&
                                            is_array(unserialize($data->document_content->strategy)))
                                        @foreach (unserialize($data->document_content->strategy) as $key => $res)
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

                
                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">7.</th>
                            <th class="w-95 text-left">
                                <div class="bold">SUMMARY AND FINDINGS :</div>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php
                                        $i = 1;
                                        $definitions = $data->document_content
                                            ? unserialize($data->document_content->summary_and_findings)
                                            : [];
                                    @endphp
                                    @if ($data->document_content && !empty($data->document_content->summary_and_findings) && is_array($definitions))
                                        @foreach ($definitions as $key => $definition)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span
                                                        style="position: absolute; left: -2.5rem; top: 0;">7.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span>
                                                    {!! nl2br($definition) !!} <br>
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
                

                
                <table class="mb-15">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">8.</th>
                            <th class="w-95 text-left">
                                <div class="bold">CONCLUSION & RECOMMANDATION :</div>
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
                                    @if ($data->document_content && is_array(unserialize($data->document_content->conclusion_and_recommendations)))
                                        @foreach (unserialize($data->document_content->conclusion_and_recommendations) as $key => $res)
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

                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">9.</th>
                                <th class="text-left">
                                    <div class="bold">ATTACHEMENT :</div>
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
                                            {!! strip_tags($data->document_content->study_attachments, 
                                            '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </section>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 760;
                $x = 485;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>
