<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    /* First PDF Styles */
    @page:first {
        margin: 0;
    }

    /* Second PDF Styles */
    @page {
        margin: 10px;
    }

    /* Second PDF Header */
    .second-pdf-header {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    /* Second PDF Footer */
    .second-pdf-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 12px;
        border-top: 2px solid #ddd;
    }

    /* Content Styling */
    .second-pdf-content {
        margin: 100px 20px 50px 20px; /* Header/Footer ke liye space chhodein */
    }

    /* Table Borders */
    table.border {
        border-collapse: collapse;
        width: 100%;
    }

    table.border th, table.border td {
        border: 1px solid #ddd;
        padding: 10px;
    }
</style>
</head>
<body>
    


<!-- First PDF -->
<div>
    @include('frontend.documents.pdfpage')
</div>

<!-- Second PDF -->
<div style="page-break-before: always;">
    <header class="second-pdf-header">
        <table class="border">
            <tr>
                <td class="logo w-20">
                    <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" alt="Logo" style="max-height: 55px;">
                </td>
                <td class="title w-60">
                    <p style="margin: 0;">{{ config('site.pdf_title') }}</p>
                    <p style="margin: 0;">T - 81,82, M.I.D.C., Bhosari, Pune - 411 026</p>
                </td>
            </tr>
        </table>
    </header>

    <footer class="second-pdf-footer">
        <table class="border">
            <tr>
                <td>{{ Helpers::getInitiatorName($data->originator_id) }}</td>
                <th>Sign/Date: {{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}</th>
                <td></td>
            </tr>
        </table>
    </footer>

    <div class="second-pdf-content">
        <section>
            <div class="procedure-block">
                <h3 style="text-align: center; margin-bottom: 1rem; font-weight:bold">Annexures</h3>
                @if (!empty($annexures))
                    @foreach ($annexures as $index => $annexure)
                        @if (!empty($annexure))
                            <div style="margin-bottom: 1rem;">
                                <h4>Annexure {{ $index + 1 }}</h4>
                                <div style="overflow-x: auto;">
                                    {!! strip_tags($annexure, '<table><th><td><tbody><tr><p><img><a><span><h4>') !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    </div>
</div>

</body>
</html>