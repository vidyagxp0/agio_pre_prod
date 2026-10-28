<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Annexure</title>
    <style>
        @page { size: A4; margin: 130px 34px 120px 34px; }
        * { font-family: Arial, Helvetica, sans-serif; font-style: normal; }
        html { text-align: left; }
        body { margin: 0; padding: 0; font-size: 11px; line-height: 1.4; }

        table { width: 100%; table-layout: fixed; border-collapse: collapse; }
        td, th { padding: 4px; text-align: left; vertical-align: top; }

        header { position: fixed; top: -96px; left: 0; width: 100%; background: #fff; }
        footer { position: fixed; bottom: -86px; left: 0; width: 100%; background: #fff; }

        .hdr { border: 1px solid #000; }
        .hdr td { border: 1px solid #686868; text-align: center; vertical-align: middle; font-size: 12px; padding: 4px; }
        .foot td { border: 1px solid #ddd; padding: 5px 8px; font-size: 11px; }

        .master-copy {
            position: fixed;
            top: -128px;
            right: 10px;
            border: 2px solid #00bcd4;
            color: #00bcd4;
            font-size: 14px;
            font-weight: bold;
            padding: 4px 12px;
            background: #fff;
            text-transform: uppercase;
        }

        .rich-pdf-content { width: 100%; font-size: 11px; line-height: 1.4; text-align: left; word-wrap: break-word; }
        .rich-pdf-content p { margin: 0 0 5px 0; font-size: 11px; }
        .rich-pdf-content ul, .rich-pdf-content ol { padding-left: 22px; margin: 2px 0 5px 0; }
        .rich-pdf-content li { font-size: 11px; }
        .rich-pdf-content table { width: 100%; table-layout: fixed; border-collapse: collapse; margin: 5px 0 8px 0; }
        .rich-pdf-content table, .rich-pdf-content th, .rich-pdf-content td { border: 1px solid #000; }
        .rich-pdf-content th, .rich-pdf-content td { font-size: 11px; line-height: 1.35; padding: 3px 5px; vertical-align: top; text-align: left; word-wrap: break-word; }
        .rich-pdf-content th { font-weight: bold; text-align: center; }
        .rich-pdf-content td p, .rich-pdf-content th p, .rich-pdf-content td div, .rich-pdf-content th div, .rich-pdf-content td span { margin: 0; font-size: 11px; }
        .rich-pdf-content table.pdf-borderless, .rich-pdf-content table.pdf-borderless th, .rich-pdf-content table.pdf-borderless td { border: none; }
        .rich-pdf-content .pdf-cont-first { border-bottom: none; }
        .rich-pdf-content .pdf-cont-mid { border-top: none; border-bottom: none; }
        .rich-pdf-content .pdf-cont-last { border-top: none; }
        .rich-pdf-content thead { display: table-header-group; }
        .rich-pdf-content img { display: block; width: auto; max-width: 100%; height: auto; margin: 4px 0; page-break-inside: avoid; }
    </style>
</head>

<body>
@php
    $approvals = DB::table('stage_manages')
        ->join('users', 'stage_manages.user_id', '=', 'users.id')
        ->select('stage_manages.*', 'users.name as user_name')
        ->where('document_id', $document->id)->where('stage', 'Approval-Submit')->where('deleted_at', null)->get();
@endphp

@if ($document->status == 'Effective' || $document->status == 'Obsolete')
    <div class="master-copy">MASTER COPY</div>
@endif


<header>
    <table class="hdr">
        <tr>
            <td class="logo w-20" style="text-align: center; vertical-align: middle;">
                @if (!empty($logoSrc))
                    <img src="{{ $logoSrc }}" style="width: 40px; height: auto;">
                @endif
            </td>
            <td style="width:80%;">
                <p style="margin:0; font-weight:bold; font-size:14px;">{{ config('site.pdf_title') }}</p>
                <p style="margin:0;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
            </td>
        </tr>
    </table>
</header>

<footer>
    <table class="foot">
        <tr>
            <td style="width:34%; font-weight:bold;">Approved By: Head QA/CQA</td>
            <td style="width:40%; text-align:center;">
                @forelse ($approvals as $t)
                    <div>{{ $t->user_name ?: 'Yet Not Performed' }}</div>
                    <div>{{ $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                @empty
                    <div>Yet Not Performed</div>
                @endforelse
            </td>
            <td style="width:26%;">Page No. :</td>
        </tr>
    </table>
    <div style="margin-top:2px; font-size:11px;">Format No.: {{ $annexureDocumentNumber }}</div>
</footer>

<main>
    @if (!empty($noDataFound) && $noDataFound)
        <div style="text-align:center; margin-top:250px; font-size:22px; font-weight:bold;">NO DATA FOUND</div>
    @else
        <h3 style="text-align:center; margin:0 0 12px 0; font-size:13px;">ANNEXURE {{ $annexureNo }}</h3>
        <div class="rich-pdf-content">{!! $annexure !!}</div>
    @endif
</main>
</body>
</html>