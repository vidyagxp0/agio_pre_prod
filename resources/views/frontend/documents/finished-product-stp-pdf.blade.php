<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finished Product STP</title>
    <style>
        @page { size: A4; margin: 235px 34px 165px 34px; }

        * { font-family: Arial, Helvetica, sans-serif; font-style: normal; }
        html { text-align: left; }
        body { margin: 0; padding: 0; font-size: 12px; line-height: 1.4; }

        table { width: 100%; table-layout: fixed; border-collapse: collapse; }
        td, th { padding: 4px; text-align: left; vertical-align: top; }

        .border { border: 1px solid #000; }
        .border-top-none { border-top: 0px solid #000; }
        .bold { font-weight: bold; }
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

        footer.footer {
            position: fixed; bottom: -140px; left: 0; width: 100%; z-index: 1000; background: #fff;
        }
        .footer-first {
            position: absolute; bottom: -140px; left: 0; width: 100%; z-index: 2000; background: #fff;
        }

        .footer table, .footer-first table { width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #000; }
        .footer th, .footer td, .footer-first th, .footer-first td { border: 1px solid #000; padding: 4px; font-size: 12px; text-align: center; vertical-align: middle; }
        .footer th, .footer-first th { font-weight: bold; background-color: #f4f4f4; }
        .format-no { display: block; text-align: left; font-size: 11px; margin-top: 3px; }

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
        .quill-pdf-content thead { display: table-header-group; }
        .quill-pdf-content img { display: block; width: 100% !important; max-width: 620px !important; height: auto !important; margin: 8px auto; page-break-inside: avoid; }
        .quill-pdf-content table.pdf-borderless { border: none; }
        .quill-pdf-content table.pdf-borderless td, .quill-pdf-content table.pdf-borderless th { border: none; }

        .section-head { font-weight: bold; font-size: 13px; margin: 10px 0 6px 0; text-align: center; }
        .general-table { width: 100%; border-collapse: collapse; border: 1px solid #000; font-size: 12px; }
        .general-table th, .general-table td { border: 1px solid #000; padding: 4px; }
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
                        <td style="width: 15%; text-align: center; vertical-align: middle;">
                            <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" style="max-height: 55px; max-width: 40px; width: auto;">
                        </td>
                        <td style="width: 85%; padding: 4px; border-left: 1px solid #686868; text-align: center;">
                            <p style="margin: 0; font-weight: bold; font-size: 14px;">{{ config('site.pdf_title') }}</p>
                            <p style="margin: 0; font-size: 12px;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="font-weight: bold; text-align: center; font-size: 12px;">FINISHED PRODUCT STANDARD TESTING PROCEDURE</td>
                    </tr>
                </tbody>
            </table>
            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 12px;">{{ !empty($data->document_content->product_name_fpstp) ? $data->document_content->product_name_fpstp : '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="border border-top-none" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 50%; padding: 4px; font-weight: bold;">STP No.: <span>{{ $document->document_number ?? 'NA' }}</span></td>
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

        $preparedDate = \Carbon\Carbon::parse($document->created_at)->format('d-M-Y');
    @endphp

    {{-- PAGE 2+ FOOTER --}}
    <footer class="footer">
        <table>
            <thead>
                <tr>
                    <th style="width: 16%;"></th>
                    <th style="width: 42%;">Prepared By</th>
                    <th style="width: 42%;">Checked By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Sign</th>
                    <td>{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td>
                        @forelse ($inreviews as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $preparedDate }}</td>
                    <td>
                        @forelse ($inreviews as $temp)
                            <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
            </tbody>
        </table>
        <span class="format-no">Format No.: QA/097/F4-00</span>
    </footer>

    {{-- PAGE 1 FOOTER --}}
    <div class="footer-first">
        <table>
            <thead>
                <tr>
                    <th style="width: 16%;"></th>
                    <th style="width: 28%;">Prepared By</th>
                    <th style="width: 28%;">Checked By</th>
                    <th style="width: 28%;">Approved By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Sign</th>
                    <td>{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                    <td>
                        @forelse ($inreviews as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                    <td>
                        @forelse ($inreview as $temp)
                            <div>{{ $temp->user_name ?: 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $preparedDate }}</td>
                    <td>
                        @forelse ($inreviews as $temp)
                            <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                    <td>
                        @forelse ($inreview as $temp)
                            <div>{{ $temp->created_at ? \Carbon\Carbon::parse($temp->created_at)->format('d-M-Y') : 'Yet Not Performed' }}</div>
                        @empty
                            <div>Yet Not Performed</div>
                        @endforelse
                    </td>
                </tr>
            </tbody>
        </table>
        <span class="format-no">Format No.: QA/097/F4-00</span>
    </div>

    <main>
        <div class="section-head">Standard Testing Procedure</div>
        @php
            $fpstp_testfield = \App\Helpers\ProcedureHtml::clean(
                Helpers::renderQuillPdf($data->document_content->fpstp_testfield ?? '')
            );
        @endphp
        <div class="quill-pdf-content">{!! $fpstp_testfield !!}</div>

        <div class="section-head" style="margin-top: 14px;">REVISION HISTORY</div>
        <table class="general-table" style="text-align: center;">
            <thead>
                <tr style="background:#f4f4f4;">
                    <th style="width: 15%; font-weight: bold; text-align: center;">Revision No.</th>
                    <th style="width: 25%; font-weight: bold; text-align: center;">Effective Date</th>
                    <th style="width: 60%; font-weight: bold; text-align: center;">Details of Revision</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($RevisionGridfpstpData))
                    @foreach ($RevisionGridfpstpData as $item)
                        <tr>
                            <td style="text-align: center;">{{ $item['rev_fpstp_no'] ?? '' }}</td>
                            <td style="text-align: center;">                                                    
                                @if ($data->training_required == 'yes' && $data->stage >= 11)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @elseif ($data->training_required != 'yes' && $data->stage > 10)
                                    {{ $data->effective_date ? \Carbon\Carbon::parse($data->effective_date)->format('d-M-Y') : '-' }}
                                @else
                                    {{ !empty($item['eff_date_fpstp']) ? \Carbon\Carbon::parse($item['eff_date_fpstp'])->format('d-M-Y') : '' }}
                                @endif
                            </td>
                            <td style="text-align: left;">{{ $item['rev_reason_fpstp'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="3" style="text-align: center; font-weight: bold;">No Data Available</td></tr>
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