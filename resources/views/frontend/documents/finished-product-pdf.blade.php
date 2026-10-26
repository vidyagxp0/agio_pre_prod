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
        @page { size: A4; margin: 250px 34px 175px 34px; }

        header {
            position: fixed;
            top: -216px;          /* 250 - 34 */
            left: 0;
            width: 100%;
            z-index: 1000;
            background: #fff;
        }

        footer {
    position: fixed;
    bottom: -141px;       /* 175 - 34 */
    left: 0;
    width: 100%;
    height: 135px;
    z-index: 1000;
    background: #fff;
}

/* PAGE 1 ONLY: 3 columns, fixed footer ke upar baithta hai */
.footer-first {
    position: absolute;
    bottom: -141px;
    left: 0;
    width: 100%;
    height: 135px;
    z-index: 2000;
    background: #fff;
}

.sign-footer table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    border: 1px solid #000;
}
.sign-footer th,
.sign-footer td {
    border: 1px solid #000;
    padding: 5px 4px;
    font-size: 14px;
    text-align: center;
}
.sign-footer th {
    font-weight: bold;
    background-color: #f4f4f4;
}
.sign-footer td div { font-size: 14px; }
.sign-footer .format-no {
    display: block;
    text-align: left;
    font-size: 14px;
    margin-top: 4px;
}

        body { margin: 0; padding: 0; }

        .header-wrapper { position: absolute; top: 0; left: 0; right: 0; }
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

    $preparedName = Helpers::getInitiatorName($data->originator_id);
    $preparedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y');
@endphp

{{-- PAGE 2+ : Prepared + Checked (poori width) --}}
<footer class="sign-footer">
    <table>
        <thead>
            <tr>
                <th style="width: 12%;"></th>
                <th style="width: 44%;">Prepared By</th>
                <th style="width: 44%;">Checked By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Sign</th>
                <td>{{ $preparedName }}</td>
                <td>
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $preparedDate }}</td>
                <td>
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <span class="format-no">Format No.: QA/097/F2-01</span>
</footer>

{{-- PAGE 1 ONLY : Prepared + Checked + Approved --}}
<div class="sign-footer footer-first">
    <table>
        <thead>
            <tr>
                <th style="width: 12%;"></th>
                <th style="width: 29.33%;">Prepared By</th>
                <th style="width: 29.33%;">Checked By</th>
                <th style="width: 29.33%;">Approved By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Sign</th>
                <td>{{ $preparedName }}</td>
                <td>
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($inreview->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreview as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $preparedDate }}</td>
                <td>
                    @if ($inreviews->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreviews as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($inreview->isEmpty())
                        <div>Yet Not Performed</div>
                    @else
                        @foreach ($inreview as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <span class="format-no">Format No.: QA/097/F2-01</span>
</div>

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
                           style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 14px;">
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

                        @php
                            $label_claim = \App\Helpers\ProcedureHtml::clean(
                                Helpers::renderQuillPdf($data->label_claim ?? '')
                            );
                        @endphp
                        <div class="quill-pdf-content">
                            {!! $label_claim !!}
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

                        @php
                            $sample_quantity = \App\Helpers\ProcedureHtml::clean(
                                Helpers::renderQuillPdf($data->sample_quantity ?? '')
                            );
                        @endphp
                        <div class="quill-pdf-content">
                            {!! $sample_quantity !!}
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
                <tr><th class="text-center"><div class="bold">Specification</div></th></tr>
            </thead>
        </table>
        @php
            $fps_specificationGrid = \App\Helpers\ProcedureHtml::clean(
                Helpers::renderQuillPdf($data->fps_specificationGrid ?? '')
            );
        @endphp
        <div class="quill-pdf-content">
            {!! $fps_specificationGrid !!}
        </div>
    </div>
    <br>

    <table>
        <thead>
            <tr>
                <th class="text-left">
                    <div class="bold">REVISION HISTORY:</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width:100%; border-collapse:collapse; border:1px solid black; margin:0;">
        <thead>
            <tr>
                <th style="border:1px solid black; width:12%;">Revision No.</th>
                <!-- <th style="border:1px solid black; width:22%;">Change Control No.</th> -->
                <th style="border:1px solid black; width:18%;">Effective Date</th>
                <th style="border:1px solid black; width:48%;">Details of Revision</th>
            </tr>
        </thead>
        <tbody>

            @if (!empty($RevisionProductSpecificationData))
                @foreach ($RevisionProductSpecificationData as $key => $item)
                    <tr>
                        <td style="border: 1px solid black; width: 20%;">{{ $item['rev_no'] ?? '' }}</td>
                        <!-- <td style="border: 1px solid black; width: 20%;">{{ $item['change_ctrl_no'] ?? '' }}</td> -->
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
                $y = 168;
                $x = 365;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>