<style>
    .quill-pdf-content { width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.4; text-align: left; word-wrap: break-word; overflow-wrap: break-word; }
    .quill-pdf-content p { margin: 0 0 5px 0; font-size: 12px; line-height: 1.4; }
    .quill-pdf-content h1, .quill-pdf-content h2, .quill-pdf-content h3,
    .quill-pdf-content h4, .quill-pdf-content h5, .quill-pdf-content h6 { font-size: 12px; font-weight: bold; margin: 8px 0 4px 0; }
    .quill-pdf-content ul, .quill-pdf-content ol { padding-left: 22px; margin: 2px 0 5px 0; }
    .quill-pdf-content li { font-size: 12px; line-height: 1.4; margin-bottom: 2px; }
    .quill-pdf-content sub { vertical-align: sub; font-size: 9px; line-height: 0; }
    .quill-pdf-content sup { vertical-align: super; font-size: 9px; line-height: 0; }

    /* TABLES: columns ka % cleaner colgroup se aata hai, class pdf-fixed par fixed layout */
    .quill-pdf-content table { width: 100%; border-collapse: collapse; border-spacing: 0; margin: 5px 0 8px 0; }
    .quill-pdf-content table.pdf-fixed { table-layout: fixed; }
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
    .quill-pdf-content thead { display: table-header-group; }
    .quill-pdf-content tr { page-break-inside: avoid; }

    /* Bade cell ke tukde: beech ki lines na dikhein, bahar ka box ek jaisa dikhe */
    .quill-pdf-content .pdf-cont-first { border-bottom: none; }
    .quill-pdf-content .pdf-cont-mid   { border-top: none; border-bottom: none; }
    .quill-pdf-content .pdf-cont-last  { border-top: none; }
    .quill-pdf-content .rs-first { border-bottom: none; }
    .quill-pdf-content .rs-mid   { border-top: none; border-bottom: none; }
    .quill-pdf-content .rs-last  { border-top: none; }

    /* Bina border wali (Word layout) table: sirf apne direct cells ka border hatao */
    .quill-pdf-content table.pdf-borderless { border: none; }
    .quill-pdf-content table.pdf-borderless > tbody > tr > td,
    .quill-pdf-content table.pdf-borderless > tbody > tr > th,
    .quill-pdf-content table.pdf-borderless > tr > td,
    .quill-pdf-content table.pdf-borderless > tr > th { border: none; }

    /* Cell ke andar ki table: gap nahi, bordered hi rahe */
    .quill-pdf-content td > table { margin: 3px 0; }

    /* Images: asli size, page se bahar nahi */
    .quill-pdf-content img { max-width: 100%; height: auto; page-break-inside: avoid; }

    /* ----- Flow layout (number | bada text) ----- */
    .quill-pdf-content .pdf-flow { margin: 5px 0 8px 0; }
    .quill-pdf-content .pdf-flow-boxed { border-bottom: 1px solid #000; }
    .quill-pdf-content .pdf-fbox { border: 1px solid #000; border-bottom: none; }

    .quill-pdf-content .pdf-flow table.lt { margin: 0; table-layout: fixed; }
    .quill-pdf-content .pdf-flow table.lt > tbody > tr > td { padding: 3px 5px; text-align: left; vertical-align: top; }
    .quill-pdf-content .pdf-flow table.lt > tbody > tr > td.pdf-numc { width: 9%; white-space: normal; }
    .quill-pdf-content .pdf-flow table.lt > tbody > tr > td.pdf-txtc { width: 91%; }
    .quill-pdf-content .pdf-fbox > table.lt > tbody > tr > td.pdf-numc { border-right: 1px solid #000; }

    .quill-pdf-content .pdf-fcont { margin-left: 9%; padding: 1px 5px; text-align: left; }
    .quill-pdf-content .pdf-fcb { border-left: 1px solid #000; }
    .quill-pdf-content .pdf-fhead td { font-weight: bold; text-align: center; }
</style>