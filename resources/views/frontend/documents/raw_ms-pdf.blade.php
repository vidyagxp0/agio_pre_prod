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
            margin-top: 260px;
            margin-bottom: 160px;
            /* padding-top: 60px; */
            /* padding-bottom: 50px; */
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 160px; /* Set a specific height for the footer */
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
        /* Main Table Styling */
        #isPasted {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 12px;
        }

        /* First column: Sr. No */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap;
            width: 40px; /* Fixed width for Sr. No. */
            vertical-align: top;
        }

        /* Second column: Main content */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;
        }

        /* Common Table Cell Styling */
        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            vertical-align: top;
            word-break: break-word;
        }

        /* Paragraph Styling Inside Table Cells */
        #isPasted td p {
            margin: 0;
            text-align: justify;
            text-justify: inter-word;
            word-break: break-word;
        }

        #isPasted td > p span {
            display: inline; /* or block */
            width: auto;
            word-wrap: break-word;
        }

        /* Remove inline-block spans causing PDF issues */
        #isPasted td span {
            display: block;
            word-break: break-word;
            white-space: normal;
        }

        /* Image Styling */
        #isPasted img,
        #isPasted td img {
            max-width: 100% !important;
            height: auto;
            display: block;
            margin: 5px auto;
        }

        .table-containers {
            width: 100%;
            overflow-x: auto;
        }

        /* Nested Table Styling (if any inside cell) */
        #isPasted table {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        #isPasted table th,
        #isPasted table td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            word-break: break-word;
        }

        #isPasted table img {
            max-width: 100% !important;
            height: auto;
            display: block;
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
        <table class="border" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">
                       RAW MATERIAL SPECIFICATION
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td>
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
                        @if($document->revised == 'Yes')
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
                        @endif
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


                            @if($document->revised == 'Yes')
                                @php
                                    $revisionNumber = str_pad($document->revised_doc - 1, 2, '0', STR_PAD_LEFT);
                                @endphp
                                RMS/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}-{{ $revisionNumber }}
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
                    <td style="width: 50%; padding: 5px; text-align: left; font-weight: bold;" class="doc-num">Reference:
                        <span>
                            @if($document->revised == 'Yes')
                                @php
                                    $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
                                @endphp

                                    @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                        RMSTP/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                    @else
                                        RMSTP/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                    @endif
                            @else
                                    @if(in_array($document->sop_type_short, ['EOP', 'IOP']))
                                    RMSTP/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                    @else
                                    RMSTP/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                    @endif
                            @endif
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>


    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
            <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
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
                Format No.: QA/097/F5-01                              
            </span>
    </footer>

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
                  
                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Molecular Formula</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">
                                    {!! strip_tags($data->molecular_formula_row_material, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                </td>
                            </tr>

                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Molecular Weight</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">
                                    {!! strip_tags($data->molecular_weight_row_material, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
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
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; max-height: 100px; overflow: hidden;">
                                    {!! strip_tags($data->sampling_procedure_row_material, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
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
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; max-height: 100px; overflow: hidden;">
                                    {!! strip_tags($data->sample_quantity_row_material, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
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

                            <tr> 
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black; font-weight: bold;">Sampling instructions,warning and precautions</td>
                                <td style="width: 50%; padding: 3px; text-align: left; border: 1px solid black;">
                                    {!! strip_tags($data->sampling_instructions_row_material, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </div>



            <div class="other-container ">
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

                                    <div class="table-containers">
                                        {!! strip_tags($document->rawmaterials_specifications, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
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
                        <th class="text-center">
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
                        @if (!empty($RevisionGridrawmsData))
                            @foreach ($RevisionGridrawmsData as $key => $item)
                                <tr>
                                    <td style="border: 1px solid black; width: 20%;">{{ $item['rev_rawms_no'] ?? '' }}</td>
                                    <td style="border: 1px solid black; width: 20%;">{{ $item['change_ctrl_rawms_no'] ?? '' }}</td>
                                    <td style="border: 1px solid black; width: 20%;">                                                    
                                        @if ($data->training_required == 'yes' && $data->stage >= 11)
                                            {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                        @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                            {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                        @else
                                            {{ !empty($item['eff_date_rawms']) ? \Carbon\Carbon::parse($item['eff_date_rawms'])->format('d-M-Y') : '' }}
                                        @endif
                                    </td>
                                    {{-- <td style="border: 1px solid black; width: 20%;">{{ !empty($item['eff_date_rawms']) ? \Carbon\Carbon::parse($item['eff_date_rawms'])->format('d-M-Y') : '' }}</td> --}}
                                    <td style="border: 1px solid black; width: 20%;">{{ $item['rev_reason_rawms'] ?? '' }}</td>
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



    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 175;
                $x = 380;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>

</body>
</html>
