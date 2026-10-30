<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raw Material Specification</title>
    <style>
        @page { size: A4; margin: 265px 34px 140px 34px; }

        * { font-family: Arial, Helvetica, sans-serif; font-style: normal; }
        html { text-align: left; }
        body { margin: 0; padding: 0; font-size: 12px; line-height: 1.4; }

        table { width: 100%; table-layout: fixed; border-collapse: collapse; }
        td, th { padding: 4px; text-align: left; vertical-align: top; }
        .bold { font-weight: bold; }
        .pb { page-break-before: always; }

        /* ---------- HEADER ---------- */
        header { position: fixed; top: -231px; left: 0; width: 100%; z-index: 1000; background: #fff; }
        .hc { border: 1px solid #000; padding: 3px 5px; font-size: 12px; line-height: 1.25; text-align: left; vertical-align: middle; }
        .hl { font-weight: bold; white-space: nowrap; }

        .master-copy {
            position: fixed; top: -257px; right: 10px;
            border: 2px solid #00bcd4; color: #00bcd4;
            font-size: 12px; font-weight: bold; padding: 2px 10px;
            text-transform: uppercase; letter-spacing: 1px; background: #fff; z-index: 2001;
        }

        /* ---------- FOOTER ---------- */
        .sf { height: 100px; background: #fff; font-size: 11px; }
        .sf table.sg { border: 1px solid #888; }
        .sf table.sg th, .sf table.sg td { border: 1px solid #888; padding: 3px 4px; font-size: 11px; text-align: center; vertical-align: middle; }
        .sf table.sg th { font-weight: bold; background: #f4f4f4; }
        .sf table.fmt td { border: none; padding: 2px 0; font-size: 11px; text-align: left; }
        .footer-rest  { position: fixed;    bottom: -106px; left: 0; width: 100%; z-index: 1000; }
        .footer-first { position: absolute; bottom: -106px; left: 0; width: 100%; z-index: 2000; }

        /* ---------- HEADINGS / KEY-VALUE ---------- */
        .sec-c { text-align: center; font-weight: bold; font-size: 13px; margin: 10px 0 4px 0; page-break-after: avoid; }

        table.kv { margin: 0 0 8px 0; }
        table.kv td { border: 1px solid #000; padding: 3px 5px; text-align: left; vertical-align: top; word-wrap: break-word; }
        table.kv td.k { font-weight: bold; }
        table.kv tr { page-break-inside: avoid; }

        table.rev { margin: 0 0 8px 0; }
        table.rev th, table.rev td { border: 1px solid #777; padding: 4px 6px; font-size: 12px; text-align: center; vertical-align: middle; }
        table.rev th { font-weight: bold; background: #f4f4f4; }
        table.rev td.l { text-align: left; }
        table.rev tr { page-break-inside: avoid; }
        table.rev thead { display: table-header-group; }

        /* ---------- PASTED CONTENT (Word / Excel / Froala) ---------- */
        .quill-pdf-content { width: 100%; font-size: 12px; line-height: 1.4; text-align: left; word-wrap: break-word; overflow-wrap: break-word; }
        .quill-pdf-content p { margin: 0 0 5px 0; font-size: 12px; line-height: 1.4; }
        
        /* Heading ke sath table break na ho (orphan heading fix) */
        .quill-pdf-content h1, .quill-pdf-content h2, .quill-pdf-content h3,
        .quill-pdf-content h4, .quill-pdf-content h5, .quill-pdf-content h6,
        .quill-pdf-content .sec-head,
        .quill-pdf-content table.sec {
            font-size: 12px; font-weight: bold; margin: 8px 0 4px 0;
            page-break-after: avoid !important;
            break-after: avoid !important;
        }

        .quill-pdf-content ul, .quill-pdf-content ol { padding-left: 22px; margin: 2px 0 5px 0; }
        .quill-pdf-content li { font-size: 12px; line-height: 1.4; margin-bottom: 2px; }
        .quill-pdf-content sub { vertical-align: sub; font-size: 9px; line-height: 0; }
        .quill-pdf-content sup { vertical-align: super; font-size: 9px; line-height: 0; }

        /* 💥 TABLE CONTINUOUS BREAK: Table rows page break par naturally break ho sakengi */
        .quill-pdf-content table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 5px 0 8px 0;
            page-break-inside: auto !important;
        }
        .quill-pdf-content table.pdf-chunk { margin: 0; }
        .quill-pdf-content table, .quill-pdf-content th, .quill-pdf-content td { border: 1px solid #000; }
        .quill-pdf-content tbody { page-break-inside: auto !important; }
        .quill-pdf-content tr {
            page-break-inside: auto !important;
            page-break-after: auto !important;
        }
        .quill-pdf-content th, .quill-pdf-content td {
            font-size: 11px;
            line-height: 1.3;
            padding: 3px 4px;
            vertical-align: top;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .quill-pdf-content th { font-weight: bold; text-align: center; background: #f4f4f4; }
        .quill-pdf-content td p, .quill-pdf-content th p,
        .quill-pdf-content td div, .quill-pdf-content th div { margin: 0; padding: 0; font-size: 11px; line-height: 1.3; }
        .quill-pdf-content td span, .quill-pdf-content th span,
        .quill-pdf-content td li, .quill-pdf-content th li { font-size: 11px; }

        .quill-pdf-content .pdf-cont-first { border-bottom: none; }
        .quill-pdf-content .pdf-cont-mid   { border-top: none; border-bottom: none; }
        .quill-pdf-content .pdf-cont-last  { border-top: none; }
        .quill-pdf-content thead { display: table-header-group; }

        /* 💥 CRITICAL FIX: Image height 175px limit ki taaki neeche Table ke liye jagah bache */
        .quill-pdf-content img {
            display: block;
            width: auto !important;
            max-width: 90% !important;
            max-height: 175px !important;
            height: auto !important;
            margin: 4px auto;
            page-break-inside: avoid;
        }

        .quill-pdf-content table.pdf-borderless { border: none; }
        .quill-pdf-content table.pdf-borderless > tbody > tr > td,
        .quill-pdf-content table.pdf-borderless > tbody > tr > th,
        .quill-pdf-content table.pdf-borderless > tr > td,
        .quill-pdf-content table.pdf-borderless > tr > th { border: none; }

        .quill-pdf-content table.lt { table-layout: auto; margin: 0; }
        .quill-pdf-content table.lt > tbody > tr > td { padding: 1px 2px; text-align: left; }
        .quill-pdf-content table.lt > tbody > tr > td:first-child { width: 7%; white-space: nowrap; }
        .quill-pdf-content table.lt > tbody > tr > td:last-child { width: 93%; }
        .quill-pdf-content table.lt table { table-layout: fixed; width: 100%; }
        .quill-pdf-content table.lt table,
        .quill-pdf-content table.lt table th,
        .quill-pdf-content table.lt table td { border: 1px solid #000; white-space: normal; }
    </style>
</head>
<body>

@php
    $__eff = ($data->training_required == 'yes') ? ($data->stage >= 11) : ($data->stage > 10);

    $inreviews = DB::table('stage_manages')
        ->join('users', 'stage_manages.user_id', '=', 'users.id')
        ->select('stage_manages.*', 'users.name as user_name')
        ->where('document_id', $document->id)->where('stage', 'Review-Submit')->where('deleted_at', null)->get();

    $inreview = DB::table('stage_manages')
        ->join('users', 'stage_manages.user_id', '=', 'users.id')
        ->select('stage_manages.*', 'users.name as user_name')
        ->where('document_id', $document->id)->where('stage', 'Approval-Submit')->where('deleted_at', null)->get();

    $preparedName = Helpers::getInitiatorName($data->originator_id);
    $preparedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y');

    // Clean STP Number
    $revisionNum = ($document->revised == 'Yes' && $document->revised_doc) ? str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT) : '00';
    $docSeq = explode('/', $data->document_number)[1] ?? '0001';
    $stpNumber = 'RMSTP/' . str_pad($docSeq, 4, '0', STR_PAD_LEFT) . '-' . $revisionNum;

    // Unicode subscript/superscript
    $subMap = ['₀'=>'0','₁'=>'1','₂'=>'2','₃'=>'3','₄'=>'4','₅'=>'5','₆'=>'6','₇'=>'7','₈'=>'8','₉'=>'9'];
    $supMap = ['⁰'=>'0','¹'=>'1','²'=>'2','³'=>'3','⁴'=>'4','⁵'=>'5','⁶'=>'6','⁷'=>'7','⁸'=>'8','⁹'=>'9','⁺'=>'+','⁻'=>'-'];

    $fixSubSup = function ($html) use ($subMap, $supMap) {
        $html = (string) $html;
        $html = preg_replace_callback('/[\x{2080}-\x{2089}]+/u', fn($m) => '<sub>' . strtr($m[0], $subMap) . '</sub>', $html);
        $html = preg_replace_callback('/[\x{2070}\x{00B9}\x{00B2}\x{00B3}\x{2074}-\x{207B}]+/u', fn($m) => '<sup>' . strtr($m[0], $supMap) . '</sup>', $html);
        return $html;
    };

    $cleanSub = function ($raw) use ($fixSubSup) {
        $src = (strpos((string) $raw, 'ql-') !== false) ? Helpers::renderQuillPdf($raw) : $raw;
        try { $out = \App\Helpers\ProcedureHtml::clean($src); } catch (\Throwable $e) { $out = $src; }
        return $fixSubSup($out);
    };

    $richClean = function ($raw, $flatten = false) {
        $src = (strpos((string) $raw, 'ql-') !== false) ? Helpers::renderQuillPdf($raw) : (string) $raw;
        try { $out = \App\Helpers\ProcedureHtml::clean($src); } catch (\Throwable $e) { $out = $src; }
        if ((stripos($src, '<table') !== false && stripos($out, '<table') === false)
            || (stripos($src, '<img') !== false && stripos($out, '<img') === false)) {
            $out = $src;
        }
        return $flatten ? \App\Helpers\ProcedureHtml::flattenRowspans($out) : $out;
    };

    $si = $data->sampling_instructions_row_material ?? '';
    if (!empty(trim(strip_tags($si))) && stripos($si, '<li') === false) {
        $plain = trim(strip_tags($si));
        $parts = preg_split('/(?:^|\s)\d+\.\s+(?=\S)/u', $plain, -1, PREG_SPLIT_NO_EMPTY);
        $parts = array_map('trim', $parts);
    } else {
        $parts = null;
    }
@endphp

@if ($document->status == 'Effective' || $document->status == 'Obsolete')
    <div class="master-copy">MASTER COPY</div>
@endif

<header>
    <table>
        <colgroup><col style="width:22%"><col style="width:28%"><col style="width:20%"><col style="width:30%"></colgroup>
        <tr>
            <td class="hc" style="text-align:center; vertical-align:middle;">
                <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" style="max-height:55px; max-width:60px; width:auto;">
            </td>
            <td class="hc" colspan="3" style="text-align:center;">
                <p style="margin:0; font-weight:bold; font-size:15px;">{{ config('site.pdf_title') }}</p>
                <p style="margin:0; font-size:12px;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
            </td>
        </tr>
        <tr>
            <td class="hc" colspan="4" style="text-align:center; font-weight:bold;">RAW MATERIAL SPECIFICATION</td>
        </tr>
        <tr>
            <td class="hc" colspan="4" style="text-align:center; font-weight:bold;">{{ !empty($document->material_name) ? $document->material_name : '-' }}</td>
        </tr>
        <tr>
            <td class="hc hl">Specification No.:</td>
            <td class="hc">{{ $document->document_number ?? 'NA' }}</td>
            <td class="hc hl">Effective Date:</td>
            <td class="hc">
                @if ($__eff)
                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="hc hl">Supersedes No.:</td>
            <td class="hc">
                @if ($document->revised == 'Yes' && $document->revised_doc)
                    {{ $document->supersedes_no ?? 'Nil' }}
                @else
                    Nil
                @endif
            </td>
            <td class="hc hl">Page No.:</td>
            <td class="hc"></td>
        </tr>
        {{-- Row 6: Pure blank cell in HTML. Koi text nahi hai taaki 0% overlap/smudge ho --}}
        <tr>
            <td class="hc hl" style="height: 18px; padding: 2px 4px;">&nbsp;</td>
            <td class="hc" colspan="3" style="height: 18px; padding: 2px 4px;">&nbsp;</td>
        </tr>
    </table>
</header>

{{-- FOOTER : PAGE 2+ (Prepared + Checked) --}}
<footer class="sf footer-rest">
    <table class="sg">
        <colgroup><col style="width:12%"><col style="width:44%"><col style="width:44%"></colgroup>
        <thead><tr><th></th><th>Prepared By</th><th>Checked By</th></tr></thead>
        <tbody>
            <tr>
                <th>Sign</th>
                <td>{{ $preparedName }}</td>
                <td>
                    @forelse ($inreviews as $r)
                        <div>{{ $r->user_name ?: 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $preparedDate }}</td>
                <td>
                    @forelse ($inreviews as $r)
                        <div>{{ $r->created_at ? \Carbon\Carbon::parse($r->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
    <table class="fmt"><tr><td>Format No.: QA/097/F5-01</td></tr></table>
</footer>

{{-- FOOTER : PAGE 1 ONLY (Prepared + Checked + Approved) --}}
<div class="sf footer-first">
    <table class="sg">
        <colgroup><col style="width:12%"><col style="width:29%"><col style="width:29%"><col style="width:30%"></colgroup>
        <thead><tr><th></th><th>Prepared By</th><th>Checked By</th><th>Approved By</th></tr></thead>
        <tbody>
            <tr>
                <th>Sign</th>
                <td>{{ $preparedName }}</td>
                <td>
                    @forelse ($inreviews as $r)
                        <div>{{ $r->user_name ?: 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
                <td>
                    @forelse ($inreview as $r)
                        <div>{{ $r->user_name ?: 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $preparedDate }}</td>
                <td>
                    @forelse ($inreviews as $r)
                        <div>{{ $r->created_at ? \Carbon\Carbon::parse($r->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
                <td>
                    @forelse ($inreview as $r)
                        <div>{{ $r->created_at ? \Carbon\Carbon::parse($r->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
    <table class="fmt"><tr><td>Format No.: QA/097/F5-01</td></tr></table>
</div>

<main>
    <div class="sec-c" style="margin-top: 0;">GENERAL INFORMATION</div>
    <table class="kv">
        <tr><td class="k" style="width:50%;">CAS No.</td><td style="width:50%;">{{ $data->cas_no_row_material }}</td></tr>
        <tr>
            <td class="k">Molecular Formula</td>
            <td><div class="quill-pdf-content">{!! $cleanSub($data->molecular_formula_row_material ?? '') !!}</div></td>
        </tr>
        <tr>
            <td class="k">Molecular Weight</td>
            <td><div class="quill-pdf-content">{!! $cleanSub($data->molecular_weight_row_material ?? '') !!}</div></td>
        </tr>
        <tr><td class="k">Storage Condition</td><td>{{ $data->storage_condition_row_material }}</td></tr>
        <tr><td class="k">Retest Period</td><td>{{ $data->retest_period_row_material }}</td></tr>
        <tr>
            <td class="k">Sampling procedure</td>
            <td><div class="quill-pdf-content">{!! $cleanSub($data->sampling_procedure_row_material ?? '') !!}</div></td>
        </tr>
        <tr><td class="k">Item Code</td><td>{{ $data->item_code_row_material }}</td></tr>
        <tr>
            <td class="k">Sample Quantity for analysis</td>
            <td><div class="quill-pdf-content">{!! $cleanSub($data->sample_quantity_row_material ?? '') !!}</div></td>
        </tr>
        <tr><td class="k">Reserve Sample Quantity</td><td>{{ $data->reserve_sample_quantity_row_material }}</td></tr>
        <tr><td class="k">Sample Quantity for Retest</td><td>{{ $data->retest_sample_quantity_row_material }}</td></tr>
    </table>

    <div class="pb">
        <div class="sec-c" style="margin-top:0;">Sampling instructions, warning and precautions</div>
        @if (is_array($parts) && count($parts) > 0)
            <ol style="margin:0; padding-left:22px;">
                @foreach ($parts as $p)
                    <li style="margin-bottom:3px;">{{ $p }}</li>
                @endforeach
            </ol>
        @else
            <div class="quill-pdf-content">{!! $si !!}</div>
        @endif
    </div>

    <div class="pb">
        <div class="sec-c" style="margin-top:0;">Specification</div>
        <div class="quill-pdf-content">{!! $richClean($document->rawmaterials_specifications ?? '', true) !!}</div>
    </div>

    <div class="pb">
        <div class="sec-c" style="margin-top:0;">REVISION HISTORY</div>
        <table class="rev">
            <thead>
                <tr>
                    <th style="width:15%;">Revision No.</th>
                    <th style="width:25%;">Effective Date</th>
                    <th style="width:60%;">Details of Revision</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($RevisionGridrawmsData))
                    @foreach ($RevisionGridrawmsData as $item)
                        <tr>
                            <td>{{ $item['rev_rawms_no'] ?? '' }}</td>
                            <td>
                                @if ($__eff)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @else
                                    {{ !empty($item['eff_date_rawms']) ? \Carbon\Carbon::parse($item['eff_date_rawms'])->format('d-M-Y') : '' }}
                                @endif
                            </td>
                            <td class="l">{{ $item['rev_reason_rawms'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="3" class="bold">No Data Available</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</main>

<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $fontBold = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "bold");

            // Page Number
            $pageText = str_pad($PAGE_NUM, 2, "0", STR_PAD_LEFT) . " of " . str_pad($PAGE_COUNT, 2, "0", STR_PAD_LEFT);
            $pdf->text(437, 125, $pageText, $font, 9);

            // Watermark se font faint na ho isliye solid opacity
            $pdf->set_opacity(1.0, "Normal");

            // EXACT VERTICAL CENTER: Y = 148 (Row 6 ke bilkul center me)
            if ($PAGE_NUM == 1) {
                // PAGE 1: Sirf Reference No. print hoga
                $pdf->text(33, 144, "Reference:", $fontBold, 9);
                $refVal = "{{ addslashes($document->refrence_rms ?? 'N/A') }}";
                $pdf->text(165, 144, $refVal, $font, 9);
            } else {
                // PAGE 2+: Sirf STP No. print hoga
                $pdf->text(33, 144, "STP No.:", $fontBold, 9);
                $stpVal = "{{ $stpNumber }}";
                $pdf->text(165, 144, $stpVal, $font, 9);
            }
        ');
    }
</script>
</body>
</html>