<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DMS Document</title>
    <style>
        @page { size: A4; margin: 350px 34px 185px 34px; }

        * { font-family: Arial, Helvetica, sans-serif; font-style: normal; }
        html { text-align: left; }
        body { margin: 0; padding: 0; font-size: 11px; line-height: 1.4; }

        table { width: 100%; table-layout: fixed; border-collapse: collapse; }
        td, th { padding: 4px; text-align: left; vertical-align: top; }

        .w-5 { width: 5%; } .w-25 { width: 25%; } .w-30 { width: 30%; } .w-70 { width: 70%; }
        .bold { font-weight: bold; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }

        /* ---------- HEADER / FOOTER ---------- */
        header { position: fixed; top: -316px; left: 0; width: 100%; z-index: 1000; background: #fff; }
        footer { position: fixed; bottom: -151px; left: 0; width: 100%; z-index: 1000; background: #fff; }
        .header-wrapper { position: fixed; top: 0; left: 0; right: 0; z-index: 2000; }

        .hdr-cell { border: 1px solid #000; padding: 3px 5px; font-size: 12px; line-height: 1.25; text-align: left; vertical-align: middle; }
        .hdr-label { font-weight: bold; white-space: nowrap; }

        .master-copy {
            position: absolute; top: -335px; right: 10px;
            border: 2px solid #00bcd4; color: #00bcd4;
            font-size: 12px; font-weight: bold; padding: 3px 10px;
            text-transform: uppercase; letter-spacing: 1px; background: #fff; z-index: 2001;
        }

        .foot-cell { padding: 4px 6px; border: 1px solid #ddd; font-size: 11px; text-align: center; }
        .foot-cell.head { font-weight: bold; }

        /* ---------- SECTIONS ---------- */
        .sec  { position: relative; padding-left: 46px; margin-top: 10px; font-size: 12px; font-weight: bold; text-align: left; }
        .item { position: relative; padding-left: 46px; font-size: 11px; text-align: justify; page-break-inside: avoid; }
        .sec .n, .item .n { position: absolute; left: 0; top: 0; text-align: left; }
        .item .n { font-weight: normal; }
        .para { padding-left: 46px; text-align: justify; font-size: 11px; }

        /* ---------- PASTED CONTENT (Word / Excel / Froala) ---------- */
        .quill-pdf-content { width: 100%; font-size: 11px; line-height: 1.4; text-align: left; word-wrap: break-word; overflow-wrap: break-word; }
        .quill-pdf-content p { margin: 0 0 5px 0; font-size: 11px; line-height: 1.4; }
        .quill-pdf-content h1, .quill-pdf-content h2, .quill-pdf-content h3,
        .quill-pdf-content h4, .quill-pdf-content h5, .quill-pdf-content h6 { font-size: 11px; font-weight: bold; margin: 8px 0 4px 0; }
        .quill-pdf-content ul, .quill-pdf-content ol { padding-left: 22px; margin: 2px 0 5px 0; }
        .quill-pdf-content li { font-size: 11px; line-height: 1.4; margin-bottom: 2px; }

        .quill-pdf-content table { width: 100%; table-layout: fixed; border-collapse: collapse; border-spacing: 0; margin: 5px 0 8px 0; }
        .quill-pdf-content table.pdf-chunk { margin: 0; }
        .quill-pdf-content table, .quill-pdf-content th, .quill-pdf-content td { border: 1px solid #000; }
        .quill-pdf-content th, .quill-pdf-content td {
            font-size: 11px; line-height: 1.35; padding: 3px 5px; vertical-align: top; text-align: left;
            word-wrap: break-word; overflow-wrap: break-word; white-space: normal;
        }
        .quill-pdf-content th { font-weight: bold; text-align: center; }
        .quill-pdf-content td p, .quill-pdf-content th p,
        .quill-pdf-content td div, .quill-pdf-content th div { margin: 0; padding: 0; font-size: 11px; line-height: 1.35; }
        .quill-pdf-content td span, .quill-pdf-content th span,
        .quill-pdf-content td li, .quill-pdf-content th li { font-size: 11px; }

        .quill-pdf-content, .quill-pdf-content div, .quill-pdf-content p,
        .quill-pdf-content .lrow, .quill-pdf-content .lnum { text-align: left; }
        .quill-pdf-content td, .quill-pdf-content th { text-align: left; }

        .quill-pdf-content table.pdf-borderless,
        .quill-pdf-content table.pdf-borderless th,
        .quill-pdf-content table.pdf-borderless td { border: none; }
        .quill-pdf-content .pdf-cont-first { border-bottom: none; }
        .quill-pdf-content .pdf-cont-mid   { border-top: none; border-bottom: none; }
        .quill-pdf-content .pdf-cont-last  { border-top: none; }
        .quill-pdf-content thead { display: table-header-group; }
        .quill-pdf-content img { display: block; max-width: 100%; height: auto; margin: 6px auto; page-break-inside: avoid; }

        /* ---------- LISTS / TABLES ---------- */
        table.table-bordered { border: 1px solid #777; }
        table.table-bordered th, table.table-bordered td { border: 1px solid #777; padding: 4px 6px; font-size: 11px; text-align: center; vertical-align: middle; }
        table.table-bordered th { font-weight: bold; }
        table.table-bordered tr { page-break-inside: avoid; }
        table.table-bordered thead { display: table-header-group; }

        /* ---------- DOCUMENT CONTROL ---------- */
        .doc-control .head { margin: 0 auto 12px; text-align: center; font-size: 16px; font-weight: bold; }
        .doc-control .block { margin-bottom: 16px; }
        .doc-control .block-head { border-bottom: 2px solid #000; font-size: 13px; font-weight: bold; margin-bottom: 8px; }
        .doc-control th, .doc-control td { font-size: 11px; }
        .doc-control table.table-bordered td, .doc-control table.table-bordered th { text-align: left; }
        .doc-control table.table-bordered tr { page-break-inside: auto; }

        .quill-pdf-content .lrow { position: relative; padding-left: 48px; page-break-inside: auto; }
        .quill-pdf-content .lnum { position: absolute; left: 0; top: 0; width: 44px; text-align: left; }
    </style>
</head>

<body>
@php
    $dc = $data->document_content;
    
    $heading = function ($no, $title) {
        return '<div class="sec"><span class="n">' . $no . '.</span>' . $title . '</div>';
    };
    // serialize array ko safe array banao
    $items = function ($raw) {
        $a = @unserialize($raw);
        return is_array($a) ? $a : [];
    };

    // 3.1, 3.2 / 3.2.1 jaisa numbering (original logic wahi hai)
    $numbered = function ($raw, $prefix) use ($items) {
        $out = '';
        $i = 1; $sub = 1;
        foreach ($items($raw) as $key => $res) {
            $isSub = str_contains((string) $key, 'sub');
            if (!empty($res)) {
                $label = $prefix . '.' . ($isSub ? ($i - 1) . '.' . $sub : $i);
                $out .= '<div class="item"><span class="n">' . $label . '</span>' . nl2br($res) . '</div>';
            }
            if (!$isSub) { $i++; $sub = 1; } else { $sub++; }
        }
        return $out;
    };

    $sections = [
        ['3',  'RESPONSIBILITY',       $dc->responsibility ?? null],
        ['4',  'ACCOUNTABILITY',       $dc->accountability ?? null],
        ['5',  'REFERENCES',           $dc->references ?? null],
        ['6',  'ABBREVIATION',         $dc->abbreviation ?? null],
        ['7',  'DEFINITIONS',          $dc->defination ?? null],
        ['8',  'GENERAL INSTRUCTIONS', $dc->materials_and_equipments ?? null],
    ];
    $sections2 = [
        ['10', 'CROSS REFERENCES', $dc->reporting ?? null],
        ['11', 'ANNEXURE',         $dc->ann ?? null],
    ];

    $effectiveVisible = ($data->training_required == 'yes') ? ($data->stage >= 11) : ($data->stage > 10);

    $inreviews = DB::table('stage_manages')
        ->join('users', 'stage_manages.user_id', '=', 'users.id')
        ->select('stage_manages.*', 'users.name as user_name')
        ->where('document_id', $document->id)->where('stage', 'Review-Submit')->where('deleted_at', null)->get();

    $inreview = DB::table('stage_manages')
        ->join('users', 'stage_manages.user_id', '=', 'users.id')
        ->select('stage_manages.*', 'users.name as user_name')
        ->where('document_id', $document->id)->where('stage', 'Approval-Submit')->where('deleted_at', null)->get();
@endphp

<div class="header-wrapper">
    @if ($document->status == 'Effective' || $document->status == 'Obsolete')
        <div class="master-copy">MASTER COPY</div>
    @endif

    <header>
        <table>
            <colgroup>
                <col style="width:14%"><col style="width:46%"><col style="width:18%"><col style="width:22%">
            </colgroup>

            <tr>
                <td class="hdr-cell" style="text-align:center; vertical-align:middle;">
                    <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" style="max-height:55px; max-width:60px; width:auto;">
                </td>
                <td class="hdr-cell" colspan="3" style="text-align:center;">
                    <p style="margin:0; font-weight:bold; font-size:15px;">{{ config('site.pdf_title') }}</p>
                    <p style="margin:0; font-size:12px;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                </td>
            </tr>

            <tr>
                <td class="hdr-cell" colspan="4" style="text-align:center; font-weight:bold;">STANDARD OPERATING PROCEDURE</td>
            </tr>

            <tr>
                <td class="hdr-cell hdr-label">Department:</td>
                <td class="hdr-cell">{{ Helpers::getFullDepartmentName($data->department_id) }}</td>
                <td class="hdr-cell hdr-label">Page No.</td>
                <td class="hdr-cell"></td>
            </tr>

            <tr>
                <td class="hdr-cell hdr-label" rowspan="2">Title:</td>
                <td class="hdr-cell" rowspan="2">{{ $data->document_name }}</td>
                <td class="hdr-cell hdr-label">SOP No.:</td>
                <td class="hdr-cell">{{ $data->document_number }}</td>
            </tr>
            <tr>
                <td class="hdr-cell hdr-label">Effective Date:</td>
                <td class="hdr-cell">
                    @if ($effectiveVisible)
                        {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                    @endif
                </td>
            </tr>

            <tr>
                <td class="hdr-cell hdr-label" rowspan="2">Area:</td>
                <td class="hdr-cell" rowspan="2">{{ Helpers::getFullDepartmentName($data->department_id) }}</td>
                <td class="hdr-cell hdr-label">Next Review Date:</td>
                <td class="hdr-cell">
                    @if ($data->stage >= 11)
                        {{ $data->next_review_date ? \Carbon\Carbon::parse($data->next_review_date)->format('d-M-Y') : '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="hdr-cell hdr-label">Supersedes No.:</td>
                <td class="hdr-cell">
                    @if ($document->revised == 'Yes' && $document->revised_doc)
                        {{ $document->supersedes_no ?? 'Nil' }}
                    @else
                        Nil
                    @endif
                </td>
            </tr>
        </table>
    </header>
</div>

<footer>
    <table style="border:1px solid #ddd;">
        <thead>
            <tr style="background:#f4f4f4;">
                <th class="foot-cell head"></th>
                <th class="foot-cell head">Prepared By</th>
                <th class="foot-cell head">Checked By</th>
                <th class="foot-cell head">Approved By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="foot-cell head">Sign</th>
                <td class="foot-cell">{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                <td class="foot-cell">
                    @forelse ($inreviews as $t)
                        <div>{{ $t->user_name ?: 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
                <td class="foot-cell">
                    @forelse ($inreview as $t)
                        <div>{{ $t->user_name ?: 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
            <tr>
                <td class="foot-cell head">Date</td>
                <td class="foot-cell">{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}</td>
                <td class="foot-cell">
                    @forelse ($inreviews as $t)
                        <div>{{ $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
                <td class="foot-cell">
                    @forelse ($inreview as $t)
                        <div>{{ $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                    @empty
                        <div>Yet Not Performed</div>
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top:2px; font-size:11px;">Format No.: CQA/001/F2-00</div>
</footer>

<main>
    {{-- 1. OBJECTIVE --}}
    {!! $heading('1', 'OBJECTIVE') !!}
    <div class="para">{!! $dc ? nl2br($dc->purpose) : '' !!}</div>

    {{-- 2. SCOPE --}}
    {!! $heading('2', 'SCOPE') !!}
    <div class="para">{!! $dc ? nl2br($dc->scope) : '' !!}</div>

    {{-- 3 - 8 --}}
    @foreach ($sections as [$no, $title, $raw])
        {!! $heading($no, $title) !!}
        @php $rows = $dc ? $numbered($raw, $no) : ''; @endphp
        @if ($rows)
            {!! $rows !!}
        @endif
    @endforeach

    {{-- 9. PROCEDURE --}}
    {!! $heading('9', 'PROCEDURE') !!}
    @php
        $rawProc = $dc->procedure ?? '';
        $src = (strpos($rawProc, 'ql-') !== false) ? Helpers::renderQuillPdf($rawProc) : $rawProc;
        $procedure = \App\Helpers\ProcedureHtml::clean($src);
    @endphp
    <div class="quill-pdf-content">{!! $procedure !!}</div>

    {{-- 10, 11 --}}
    @foreach ($sections2 as [$no, $title, $raw])
        {!! $heading($no, $title) !!}
        @php $rows = $dc ? $numbered($raw, $no) : ''; @endphp
        @if ($rows)
            {!! $rows !!}
        @endif
    @endforeach

    {{-- 12. DISTRIBUTION LIST --}}
    {!! $heading('12', 'DISTRIBUTION LIST') !!}
    <table class="table-bordered">
        <thead> 
            <tr>
                <th style="width:25%;">Copy</th>
                <th style="width:20%;">No. of Copies</th>
                <th style="width:55%;">User Department</th>
            </tr>
        </thead>
        <tbody>
            <tr><td style="font-weight:bold;">Master Copy</td><td>{{ $data->master_copy_number }}</td><td>{{ $data->master_user_department }}</td></tr>
            <tr><td style="font-weight:bold;">Controlled Copy</td><td>{{ $data->controlled_copy_number }}</td><td>{{ $data->controlled_user_department }}</td></tr>
            <tr><td style="font-weight:bold;">Display Copy</td><td>{{ $data->display_copy_number }}</td><td>{{ $data->display_user_department }}</td></tr>
        </tbody>
    </table>

    {{-- 13. REVISION HISTORY --}}
    {!! $heading('13', 'REVISION HISTORY') !!}
    <table class="table-bordered" id="revision-table">
        <thead>
            <tr>
                <th style="width:12%;">Revision No.</th>
                <th style="width:20%;">Change Control No.</th>
                <th style="width:16%;">Effective Date</th>
                <th style="width:52%;">Details of Revision</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($RevisionGridData))
                @foreach ($RevisionGridData as $item)
                    @php $effectiveDate = $item['revised_effective_date'] ?? $item['effectiveDate_gtp'] ?? null; @endphp
                    <tr>
                        <td>{{ $item['revision_number'] ?? '' }}</td>
                        <td>{{ $item['cc_no'] ?? '' }}</td>
                        <td>{{ !empty($effectiveDate) ? \Carbon\Carbon::parse($effectiveDate)->format('d-M-Y') : '-' }}</td>
                        <td style="text-align:left;">{{ $item['reason_of_revision'] ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="4" style="font-weight:bold;">No Data Available</td></tr>
            @endif
        </tbody>
    </table>

    {{-- ================= DOCUMENT CONTROL ================= --}}
    @php
        $last = DB::table('document_histories')->where('document_id', $data->id)->latest()->first();

        $sigOriginator = DB::table('stage_manages')->where('document_id', $data->id)
            ->where(function ($q) { $q->where('stage', '4')->orWhere('stage', 'In-HOD Review')->orWhere('stage', 'In-Approval'); })
            ->latest()->first();

        $stageRow = function ($uid, $stage, $soft) use ($data) {
            return DB::table('stage_manages')->where('document_id', $data->id)->where('user_id', $uid)->where('stage', $stage)
                ->when($soft, fn ($q) => $q->where('deleted_at', null))->latest()->first();
        };

        $groupUsers = function ($csv) {
            $ids = [];
            foreach (array_filter(explode(',', (string) $csv)) as $g) {
                $u = DB::table('group_permissions')->where('id', $g)->value('user_ids');
                foreach (array_filter(explode(',', (string) $u)) as $x) { $ids[] = $x; }
            }
            return $ids;
        };

        // $cfg: [doneStage, rejectStage, doneLabel, rejectLabel, pendingLabel, showComment]
        $personRow = function ($uid, $cfg) use ($stageRow) {
            $u = DB::table('users')->where('id', $uid)->first();
            if (!$u) { return ''; }
            $dept = DB::table('departments')->where('id', $u->departmentid)->value('name');
            $done = $stageRow($uid, $cfg[0], true);
            $rej  = $stageRow($uid, $cfg[1], true);
            $status = $done ? $cfg[2] : ($rej ? $cfg[3] : $cfg[4]);
            $comment = ($cfg[5] && $done) ? e($done->comment) : '';
            return '<tr><td>' . e($u->name) . '</td><td>' . e($dept) . '</td><td>' . e($status) . '</td><td>' . e($u->email) . '</td><td>' . $comment . '</td></tr>';
        };

        $peopleTable = function ($title, $firstCol, $rows) {
            return '<div class="block"><div class="block-head">' . $title . '</div>'
                . '<table class="table-bordered"><thead><tr>'
                . '<th style="width:20%">' . $firstCol . '</th><th style="width:20%">Department</th><th style="width:20%">Status</th><th style="width:22%">E-Signature</th><th style="width:18%">Comments</th>'
                . '</tr></thead><tbody>' . $rows . '</tbody></table></div>';
        };

        $hodRows = '';
        foreach (array_filter(explode(',', (string) $data->hods)) as $id) {
            $hodRows .= $personRow($id, ['HOD Review Complete', 'Cancel-by-HOD', 'HOD Review Complete', 'HOD Rejected', 'HOD Review Pending', true]);
        }
        foreach ($groupUsers($data->approver_group) as $id) {
            $hodRows .= $personRow($id, ['Approval-Submit', 'Cancel-by-Approver', 'Approval Completed', 'Approval Rejected', 'Approval Pending', false]);
        }

        $chkRows = '';
        foreach (array_filter(explode(',', (string) $data->reviewers)) as $id) {
            $chkRows .= $personRow($id, ['Reviewed', 'Cancel-by-Reviewer', 'Checked', 'Draft', 'Under Checking', true]);
        }
        foreach ($groupUsers($data->reviewers_group) as $id) {
            $chkRows .= $personRow($id, ['Review-Submit', 'Cancel-by-Reviewer', 'Checked', 'Draft', 'Under Checking', false]);
        }

        $appRows = '';
        foreach (array_filter(explode(',', (string) $data->approvers)) as $id) {
            $appRows .= $personRow($id, ['Approved', 'Cancel-by-Approver', 'Approval Completed', 'Draft', 'Approval Pending', true]);
        }
        foreach ($groupUsers($data->approver_group) as $id) {
            $appRows .= $personRow($id, ['Approval-Submit', 'Cancel-by-Approver', 'Approval Completed', 'Draft', 'Approval Pending', false]);
        }
    @endphp

    <br>
    <section class="doc-control" style="">
        <div class="head">Document Control Information</div>

        <div class="block">
            <div class="block-head">General Information</div>
            <table>
                <tr><th style="width:30%">Document Number</th><td style="width:70%">{{ $document->document_number }}</td></tr>
                <tr><th>Title</th><td>{{ $data->document_name }}</td></tr>
                <tr><th>Short Description</th><td>{{ $data->short_description }}</td></tr>
                <tr><th>Last Changed</th><td>{{ \Carbon\Carbon::parse($last ? $last->created_at : $data->created_at)->format('d-M-Y') }}</td></tr>
                <tr><th>Changed By</th><td>{{ $last ? $last->user_name : $data->originator }}</td></tr>
            </table>
        </div>

        <div class="block">
            <div class="block-head">Prepared By</div>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th style="width:20%">Originator</th><th style="width:20%">Department</th><th style="width:20%">Status</th><th style="width:22%">E-Signature</th><th style="width:18%">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->originator }}</td>
                        <td>{{ $document->originator && $document->originator->department ? $document->originator->department->name : '' }}</td>
                        <td>Initiation Completed</td>
                        <td>{{ $data->originator_email }}</td>
                        <td>{{ $sigOriginator && $sigOriginator->comment != null ? $sigOriginator->comment : ' ' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($data->document_type_id != 'SOP')
            {!! $peopleTable('HOD', 'HOD', $hodRows) !!}
        @endif
        {!! $peopleTable('Checked By', 'Reviewer', $chkRows) !!}
        {!! $peopleTable('Approved By', 'Approver', $appRows) !!}
    </section>
</main>

<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            if ($PAGE_COUNT > 1) {
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 10;
                $pageText = str_pad($PAGE_NUM, 2, "0", STR_PAD_LEFT) . " of " . str_pad($PAGE_COUNT, 2, "0", STR_PAD_LEFT);
                $pdf->text(460, 100, $pageText, $font, $size);
            }
        ');
    }
</script>
</body>
</html>