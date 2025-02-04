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
            margin-top: 120px;
            margin-bottom: 160px;
            /* padding-top: 60px; */
            /* padding-bottom: 50px; */
        }

        footer {
            position: fixed;
            bottom: 50px;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* height: 170px; */
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
        .table_bg {
            background: #4274da57;
        }
    </style>
    <style>
        /* Main Table Styling */
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
                    <td class="logo w-10">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                            style="max-height: 55px; max-width: 40px;">
                    </td>
                    <td class="title w-90"
                        style="padding: 0; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                        <p style="margin: 0; text-align: center; font-weight: bold;">{{ config('site.pdf_title') }}</p>
                        <p style="margin: 0; text-align: center;">A-38, Nandjyot Industrial Estate, Kurla Andheri Road, Sakinaka, Mumbai-400072</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin: 0; text-align: center; font-weight: bold;">ANNEXURE - II</div>
        <div style="margin: 0; text-align: center; font-weight: bold;">INITIAL RISK ASSESSMENT</div>

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
                            ->where('stage', 'Review-Submit')
                            ->where('deleted_at', null)
                            ->get();
                    @endphp
                    <td style="padding: 20px; border: 1px solid #ddd; font-weight: bold;">Approved By: Head CQA</td>
                    <th style="padding: 20px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}<br> (Sign/Date)</th>
                    <td style="padding: 20px; border: 1px solid #ddd;">  </td>
                </tr>
            </tbody>
        </table>
        <div style="margin: 5px; text-align: left;"><span class="bold">Format No.:</span> CQA/011/F2-00</div>

    </footer>

    <div >
        <section class="main-section" id="pdf-page">
            <section style="page-break-after: never;">
                <div class="other-container">
                    <table class="border " style="width: 100%;">
                        <tbody>
                            <tr>
                                <td class="logo w-20">
                                    <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                                        style="max-height: 55px; max-width: 40px;">
                                </td>
                                <td class="title w-80"
                                    style="padding: 10px; border-left: 1px solid #686868; border-right: 1px solid #686868;">
                                    <p style="margin: 0; text-align: left; font-weight: bold;">{{ config('site.pdf_title') }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="border border-top-none" style="width: 100%;">
                        <tbody>
                            <tr>

                                <td class="w-20 doc-num" style="padding: 5px; text-align: left; font-weight: bold;">Document Title:
                                </td>
                                <td class="w-80"
                                    style="padding: 5px; border-left: 1px solid; text-align: left;">{{ $data->document_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="border border-top-none" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td class="w-20 doc-num" style="padding: 5px; text-align: left; font-weight: bold;" >Document No. :
                                </td>
                                <td class="w-30"
                                    style="padding: 5px; border-left: 1px solid; text-align: left;">

                                    @if($document->revised == 'Yes')
                                        @php
                                            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
                                        @endphp

                                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                                {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                                            @else
                                                {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
                                            @endif
                                    @else
                                            @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                                {{ $document->department_id }}/{{ $document->sop_type_short }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                                            @else
                                                {{ $document->sop_type_short }}/{{ $document->department_id }}/{{ str_pad($currentId, 3, '0', STR_PAD_LEFT) }}-00
                                            @endif
                                    @endif

                                </td>
                                <td class="w-20"
                                    style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">
                                    Page No.:
                                </td>
                                <td class="w-30"
                                    style="padding: 5px; border-left: 1px solid; text-align: left; font-weight: bold;">

                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <table style="margin-top: 70px;">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div style="margin: 0; text-align: center; font-weight: bold;">INITIAL RISK ASSESSMENT</div>
                                    <div style="margin: 0; text-align: center; font-weight: bold;">FOR</div>
                                    <div style="margin: 0; text-align: center; font-weight: bold;">{{ config('site.pdf_title') }}</div>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <table class="border" style="margin-top: 100px; margin-left:150px; width: 50%;">
                        <tbody>
                            <tr>

                                <td class="w-40 doc-num" style="padding: 5px; text-align: left; font-weight: bold;">Supersedes Dated
                                </td>
                                <td class="w-10" style="padding: 5px; border-left: 1px solid; text-align: center; font-weight: bold;">:
                                </td>
                                <td class="w-50"
                                    style="padding: 5px; border-left: 1px solid; text-align: left;">

                                </td>
                            </tr>
                            <tr>

                                <td class="w-40 doc-num" style="padding: 5px; border: 1px solid; text-align: left; font-weight: bold;">Effective Date
                                </td>
                                <td class="w-10" style="padding: 5px; border: 1px solid; text-align: center; font-weight: bold;">:
                                </td>
                                <td class="w-50"
                                    style="padding: 5px; border: 1px solid; text-align: left;">

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

                    <p style="margin-top: 100px; margin-bottom:50px; text-align: center;">[Note: This template is intended to guide anyone involved with system qualification. The document that is created from this template can be modified as necessary. Sections may be added or deleted to fit the specific requirements of the system.]</p>
                    <br>
                </div>
            </section>
        </section>
    </div>

    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th class="text-center">
                    <div class="bold">Table of Contents</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="margin: 5px; margin-bottom: 320px; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Section</th>
                <th style="border: 1px solid black; width: 80%; font-weight: bold;">Description</th>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Page</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; text-align: center;">1.0</td>
                <td style="border: 1px solid black; text-align: left;">Introduction</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">2.0</td>
                <td style="border: 1px solid black; text-align: left;">Scope</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">3.0</td>
                <td style="border: 1px solid black; text-align: left;">Responsibility</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">4.0</td>
                <td style="border: 1px solid black; text-align: left;">Risk assessment</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">5.0</td>
                <td style="border: 1px solid black; text-align: left;">Stakeholder list</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">6.0</td>
                <td style="border: 1px solid black; text-align: left;">References and related documents</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">7.0</td>
                <td style="border: 1px solid black; text-align: left;">Glossary of terms</td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
        </tbody>
    </table>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">1.0</th> --}}
                    <th class="text-left">
                        <div class="bold">1.0 INTRODUCTION</div>
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
                                {!! strip_tags($data->document_content->Introduction_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">2.0</th> --}}
                    <th class="text-left">
                        <div class="bold">2.0 SCOPE</div>
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
                                {!! strip_tags($data->document_content->Scope_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">3.0</th> --}}
                    <th class="text-left">
                        <div class="bold">3.0 RESPONSIBILITY</div>
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
                                {!! strip_tags($data->document_content->Responsibility_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">4.0</th> --}}
                    <th class="text-left">
                        <div class="bold">4.0 RISK ASSESSMENT</div>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    @php
        $serialNumber = 1;
        $decodedRiskAssessment = [];
        if (isset($RiskAssessment) && isset($RiskAssessment->data)) {
            $decodedRiskAssessment = is_string($RiskAssessment->data)
                ? json_decode($RiskAssessment->data, true)
                : (is_array($RiskAssessment->data) ? $RiskAssessment->data : []);
        }
    @endphp

    <div>
        <table class="table table-bordered">
            <thead class="table_bg">
                <tr>
                    <th class="w-10">Sr.No</th>
                    <th class="w-30">Risk Type</th>
                    <th class="w-30">Risk Event</th>
                    <th class="w-30">Consequence</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $serialNumber = 1;
                @endphp
                @if(!empty($decodedRiskAssessment))
                    @foreach($decodedRiskAssessment as $key => $Risk)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $Risk['Risk_Type'] ?? '' }}</td>
                            <td>{{ $Risk['Risk_Event'] ?? '' }}</td>
                            <td>{{ $Risk['Consequence'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <table class="table table-bordered">
            <thead class="table_bg">
                <tr>
                    <th rowspan="2" class="w-10">Sr.No</th>
                    <th colspan="4" class="w-90">Risk Assessment Stage</th>
                </tr>
                <tr>
                    <th>Severity of impact (1-5)</th>
                    <th>Likelihood of Occurrence (1-5)</th>
                    <th>Probability of detection (5-1)</th>
                    <th>Risk Priority Number (RPN)</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $serialNumber = 1;
                @endphp
                @if(!empty($decodedRiskAssessment))
                    @foreach($decodedRiskAssessment as $key => $Risk)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $Risk['Risk_Assessment_Severity'] ?? '' }}</td>
                            <td>{{ $Risk['Risk_Assessment_Occurence'] ?? '' }}</td>
                            <td>{{ $Risk['Risk_Assessment_Detection'] ?? '' }}</td>
                            <td>{{ $Risk['Risk_Assessment_RPN'] ?? ''}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <table class="table table-bordered">
            <thead class="table_bg">
                <tr>
                    <th class="w-10">Sr.No</th>
                    <th class="w-45">Mitigation Action (i.e. specify specific steps needed to mitigate the risk).</th>
                    <th class="w-45">Reference (if the mitigation control is already in place)</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $serialNumber = 1;
                @endphp
                @if(!empty($decodedRiskAssessment))
                    @foreach($decodedRiskAssessment as $key => $Risk)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $Risk['Mitigation_Action'] ?? '' }}</td>
                            <td>{{ $Risk['Reference'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <table class="table table-bordered">
            <thead class="table_bg">
                <tr>
                    <th rowspan="2" class="w-10">Sr.No</th>
                    <th colspan="4" class="w-60">After Mitigation</th>
                    <th rowspan="2" class="w-30">Where Documented</th>
                </tr>
                <tr>
                    <th>Severity of impact (1-5)</th>
                    <th>Likelihood of Occurrence (1-5)</th>
                    <th>Probability of detection (5-1)</th>
                    <th>Risk Priority Number (RPN)</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $serialNumber = 1;
                @endphp
                @if(!empty($decodedRiskAssessment))
                    @foreach($decodedRiskAssessment as $key => $Risk)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $Risk['After_Mitigation_Severity'] ?? '' }}</td>
                            <td>{{ $Risk['After_Mitigation_Occurence'] ?? '' }}</td>
                            <td>{{ $Risk['After_Mitigation_Detection'] ?? '' }}</td>
                            <td>{{ $Risk['After_Mitigation_RPN'] ?? '' }}</td>
                            <td>{{ $Risk['Where_Documented'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">5.0</th> --}}
                    <th class="text-left">
                        <div class="bold">5.0 STAKEHOLDER LIST</div>
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
                                {!! strip_tags($data->document_content->Stakeholder_List_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">6.0</th> --}}
                    <th class="text-left">
                        <div class="bold">6.0 REFERENCES AND RELATED DOCUMENTS</div>
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
                                {!! strip_tags($data->document_content->References_and_related_documents_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other-container ">
        <table>
            <thead>
                <tr>
                    {{-- <th class="w-5">7.0</th> --}}
                    <th class="text-left">
                        <div class="bold">7.0 GLOSSARY OF TERMS</div>
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
                                {!! strip_tags($data->document_content->Glossary_Of_Terms_Initial_Risk,
                                '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th class="text-center">
                    <div>APPROVAL PAGE</div>
                </th>
            </tr>
        </thead>
    </table>

    <p style="margin: 0; text-align: left;">Prepared by:</p>

    <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Name</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Designation</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Signature</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #ddd;">

                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">{{ Helpers::getInitiatorName($data->originator_id) }}</th>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                    {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                </td>
            </tr>
        </tbody>
    </table>

    <p style="margin: 0; text-align: left;">Reviewed by:</p>

    <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Name</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Designation</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Signature</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #ddd;">

                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">{{ Helpers::getInitiatorName($data->originator_id) }}</th>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                    {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                </td>
            </tr>
        </tbody>
    </table>

    <p style="margin: 0; text-align: left;">Approved by:</p>

    <table class="border p-10" style="width: 100%; border-collapse: collapse; margin-bottom: 350px; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Name</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Designation</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Signature</th>
                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #ddd;">

                <th style="padding: 5px; border: 1px solid #ddd; font-size: 14px; font-weight: bold;">{{ Helpers::getInitiatorName($data->originator_id) }}</th>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd;"></td>
                <td style="padding: 5px; border: 1px solid #ddd; text-align: center;">
                    {{ $formattedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}
                </td>
            </tr>
        </tbody>
    </table>


    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 728;
                $x = 445;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>
