<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finished Product Specification</title>
    <style>
        /* Reference SOP layout: Header height ~170px + 30px gap */
        @page { size: A4; margin: 235px 34px 165px 34px; }

        * { font-family: Arial, Helvetica, sans-serif; font-style: normal; }
        html { text-align: left; }
        body { margin: 0; padding: 0; font-size: 12px; line-height: 1.4; }

        table { width: 100%; table-layout: fixed; border-collapse: collapse; }
        td, th { padding: 4px; text-align: left; vertical-align: top; }

        .w-5 { width: 5%; } .w-10 { width: 10%; } .w-15 { width: 15%; } .w-20 { width: 20%; }
        .w-25 { width: 25%; } .w-30 { width: 30%; } .w-50 { width: 50%; } .w-100 { width: 100%; }

        .border { border: 1px solid #000; }
        .border-top-none { border-top: 0px solid #000; }
        .bold { font-weight: bold; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }

        /* ---------- HEADER / FOOTER ---------- */
        header { position: fixed; top: -205px; left: 0; width: 100%; z-index: 1000; background: #fff; }
        .header-wrapper { position: fixed; top: 0; left: 0; right: 0; z-index: 2000; }

        .master-copy {
            position: absolute; top: -228px; right: 10px;
            border: 2px solid #00bcd4; color: #00bcd4;
            font-size: 12px; font-weight: bold; padding: 3px 10px;
            text-transform: uppercase; letter-spacing: 1px; background: #fff; z-index: 2001;
        }

        /* Fixed Footer (Page 2+) */
        footer.sign-footer {
            position: fixed; bottom: -140px; left: 0; width: 100%; z-index: 1000; background: #fff;
        }

        /* Page 1 Only Footer */
        .footer-first {
            position: absolute; bottom: -140px; left: 0; width: 100%; z-index: 2000; background: #fff;
        }

        .sign-footer table { width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #000; }
        .sign-footer th, .sign-footer td { border: 1px solid #000; padding: 4px; font-size: 12px; text-align: center; vertical-align: middle; }
        .sign-footer th { font-weight: bold; background-color: #f4f4f4; }
        .sign-footer .format-no { display: block; text-align: left; font-size: 11px; margin-top: 3px; }

        /* ---------- FIRST PAGE TOP STP ROW ---------- */
        .first-page-stp { width: 100%; margin: 0 0 6px 0; padding: 0; }
        .first-page-stp table { width: 100%; border-collapse: collapse; table-layout: fixed; margin: 0; }
        .first-page-stp td { padding: 4px; border: 1px solid #000; text-align: left; font-weight: bold; font-size: 12px; }

        /* ---------- PASTED CONTENT (Word / Excel / Froala) ---------- */
        .quill-pdf-content { width: 100%; font-size: 12px; line-height: 1.4; text-align: left; word-wrap: break-word; overflow-wrap: break-word; }
        .quill-pdf-content p { margin: 0 0 5px 0; font-size: 12px; line-height: 1.4; }
        .quill-pdf-content h1, .quill-pdf-content h2, .quill-pdf-content h3,
        .quill-pdf-content h4, .quill-pdf-content h5, .quill-pdf-content h6 { font-size: 12px; font-weight: bold; margin: 8px 0 4px 0; }
        .quill-pdf-content ul, .quill-pdf-content ol { padding-left: 22px; margin: 2px 0 5px 0; }
        .quill-pdf-content li { font-size: 12px; line-height: 1.4; margin-bottom: 2px; }

        .quill-pdf-content table { width: 100%; table-layout: fixed; border-collapse: collapse; border-spacing: 0; margin: 5px 0 8px 0; }
        .quill-pdf-content table.pdf-chunk { margin: 0; }
        .quill-pdf-content table, .quill-pdf-content th, .quill-pdf-content td { border: 1px solid #000; }
        .quill-pdf-content th, .quill-pdf-content td {
            font-size: 12px; line-height: 1.35; padding: 3px 5px; vertical-align: top; text-align: left;
            word-wrap: break-word; overflow-wrap: break-word; white-space: normal;
        }
        .quill-pdf-content th { font-weight: bold; text-align: center; }
        .quill-pdf-content td p, .quill-pdf-content th p,
        .quill-pdf-content td div, .quill-pdf-content th div { margin: 0; padding: 0; font-size: 12px; line-height: 1.35; }
        .quill-pdf-content td span, .quill-pdf-content th span,
        .quill-pdf-content td li, .quill-pdf-content th li { font-size: 12px; }

        .quill-pdf-content td, .quill-pdf-content th { text-align: left; }
        .quill-pdf-content thead { display: table-header-group; }
        .quill-pdf-content img { display: block; width: 100% !important; max-width: 620px !important; height: auto !important; margin: 8px auto; page-break-inside: avoid; }

        .quill-pdf-content table.pdf-borderless { border: none; }
        .quill-pdf-content table.pdf-borderless > tbody > tr > td,
        .quill-pdf-content table.pdf-borderless > tbody > tr > th,
        .quill-pdf-content table.pdf-borderless > tr > td,
        .quill-pdf-content table.pdf-borderless > tr > th { border: none; }

        /* General Tables */
        .general-table { width: 100%; border-collapse: collapse; border: 1px solid #000; font-size: 12px; margin-bottom: 6px; }
        .general-table td { padding: 4px; border: 1px solid #000; text-align: left; }
        .general-table td.lbl { width: 50%; font-weight: bold; }
        .general-table td.val { width: 50%; }

        .section-head { font-weight: bold; font-size: 13px; margin: 8px 0 4px 0; text-align: center; }
        .section-subhead { font-weight: bold; font-size: 12px; margin: 6px 0 3px 0; text-align: left; }

        .keep-together { page-break-inside: avoid; }
    </style>
</head>
<body>
    <div class="header-wrapper">
        @if ($document->status == 'Effective' || $document->status == 'Obsolete')
            <div class="master-copy">MASTER COPY</div>
        @endif

        <header>
            <table class="border" style="width: 100%;">
                <tbody>
                    <tr>
                        <td class="logo" style="width: 15%; text-align: center; vertical-align: middle;">
                            <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" style="max-height: 55px; max-width: 40px; width: auto;">
                        </td>
                        <td class="title" style="width: 85%; padding: 4px; border-left: 1px solid #686868; text-align: center;">
                            <p style="margin: 0; font-weight: bold; font-size: 14px;">{{ config('site.pdf_title') }}</p>
                            <p style="margin: 0; font-size: 12px;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="font-weight: bold; text-align: center; font-size: 12px;">FINISHED PRODUCT SPECIFICATION</td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 12px;">{{ !empty($data->fsproduct_name) ? $data->fsproduct_name : '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%; padding: 4px; font-weight: bold;">Specification No.: <span>{{ $document->document_number ?? 'NA' }}</span></td>
                        <td style="width: 50%; padding: 4px; border-left: 1px solid #000; font-weight: bold;">Effective Date: 
                            <span>
                                @if ($data->training_required == 'yes')
                                    {{ $data->stage >= 11 && $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @else
                                    {{ $data->stage > 10 && $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @endif
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%; padding: 4px; font-weight: bold;">Supersedes No.: 
                            <span>{{ ($document->revised == 'Yes' && $document->revised_doc) ? ($document->supersedes_no ?? 'Nil') : 'Nil' }}</span>
                        </td>
                        <td style="width: 50%; padding: 4px; border-left: 1px solid #000; font-weight: bold;">Page No.:</td>
                    </tr>
                </tbody>
            </table>
        </header>
    </div>

    @php
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
    @endphp

    {{-- PAGE 2+ FOOTER --}}
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
                        @forelse ($inreviews as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $preparedDate }}</td>
                    <td>
                        @forelse ($inreviews as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
            </tbody>
        </table>
        <span class="format-no">Format No.: QA/097/F2-01</span>
    </footer>

    {{-- PAGE 1 ONLY FOOTER --}}
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
                        @forelse ($inreviews as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                    <td>
                        @forelse ($inreview as $row)
                            <div>{{ $row->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $preparedDate }}</td>
                    <td>
                        @forelse ($inreviews as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                    <td>
                        @forelse ($inreview as $row)
                            <div>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
            </tbody>
        </table>
        <span class="format-no">Format No.: QA/097/F2-01</span>
    </div>

    <main>
        {{-- STP NO (PAGE 1 ONLY) --}}
        <div class="first-page-stp">
            <table>
                <tr>
                    <td>STP No.: <span>FPSTP/{{ str_pad(explode('/', $data->document_number)[1] ?? '', 4, STR_PAD_LEFT) }}</span></td>
                </tr>
            </table>
        </div>

        <div class="section-head">GENERAL INFORMATION</div>

        <table class="general-table keep-together">
            <tr><td class="lbl">Generic Name</td><td class="val">{{ $data->generic_name }}</td></tr>
            <tr><td class="lbl">Brand Name</td><td class="val">{{ $data->brand_name }}</td></tr>
        </table>

        {{-- LABEL CLAIM --}}
        <div class="section-subhead">Label Claim</div>
        @php
            $label_claim = \App\Helpers\ProcedureHtml::clean(Helpers::renderQuillPdf($data->label_claim ?? ''));
        @endphp
        <div class="quill-pdf-content">{!! $label_claim !!}</div>

        <table class="general-table keep-together" style="margin-top: 6px;">
            <tr><td class="lbl">Product Code</td><td class="val">{{ $data->product_code }}</td></tr>
            <tr><td class="lbl">Storage Condition</td><td class="val">{{ $data->fsstorage_condition }}</td></tr>
        </table>

        {{-- SAMPLE QUANTITY --}}
        <div class="section-subhead">Sample Quantity for Analysis</div>
        @php
            $sample_quantity = \App\Helpers\ProcedureHtml::clean(Helpers::renderQuillPdf($data->sample_quantity ?? ''));
        @endphp
        <div class="quill-pdf-content">{!! $sample_quantity !!}</div>

        <table class="general-table keep-together" style="margin-top: 6px;">
            <tr><td class="lbl">Reserve Sample Quantity</td><td class="val">{{ $data->reserve_sample }}</td></tr>
            <tr><td class="lbl">Custom Sample</td><td class="val">{{ $data->custom_sample }}</td></tr>
            <tr><td class="lbl">Reference</td><td class="val">{{ $data->reference }}</td></tr>
            <tr><td class="lbl">Sampling Instructions Warning and Precautions</td><td class="val">{{ $data->sampling_instructions }}</td></tr>
        </table>

        {{-- SPECIFICATION --}}
        <div class="section-head" style="margin-top: 12px;">SPECIFICATION</div>
        @php
            $fps_specificationGrid = \App\Helpers\ProcedureHtml::clean(Helpers::renderQuillPdf($data->fps_specificationGrid ?? ''));
        @endphp
        <div class="quill-pdf-content">{!! $fps_specificationGrid !!}</div>

        {{-- REVISION HISTORY --}}
        <div class="section-head" style="text-align: left; margin-top: 14px;">REVISION HISTORY:</div>
        <table class="general-table" style="text-align: center;">
            <thead>
                <tr style="background:#f4f4f4;">
                    <th style="border:1px solid #000; width:15%; font-weight:bold; text-align:center;">Revision No.</th>
                    <th style="border:1px solid #000; width:25%; font-weight:bold; text-align:center;">Effective Date</th>
                    <th style="border:1px solid #000; width:60%; font-weight:bold; text-align:center;">Details of Revision</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($RevisionProductSpecificationData))
                    @foreach ($RevisionProductSpecificationData as $item)
                        <tr>
                            <td style="border:1px solid #000; text-align:center;">{{ $item['rev_no'] ?? '' }}</td>
                            <td style="border:1px solid #000; text-align:center;">
                                @if ($data->training_required == 'yes' && $data->stage >= 11)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @else
                                    {{ !empty($item['eff_date']) ? \Carbon\Carbon::parse($item['eff_date'])->format('d-M-Y') : '' }}
                                @endif
                            </td>
                            <td style="border:1px solid #000; text-align:left;">{{ $item['rev_reason'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="3" style="text-align:center; font-weight:bold;">No Data Available</td></tr>
                @endif
            </tbody>
        </table>
    </main>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 10;
                $pageText = $PAGE_NUM . " of " . $PAGE_COUNT;
                $pdf->text(460, 100, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>