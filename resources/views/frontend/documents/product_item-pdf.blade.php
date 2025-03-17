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
           

        }

        body {
            margin-top: 250px;
            margin-bottom: 160px;
            padding-top: 60px;
            padding-bottom: 50px; 
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            
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
    </style>

    <style>     
        /*Main Table Styling */
        #isPasted {
            width: 690px !important;
        border-collapse: collapse;
        table-layout: fixed;
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; 
            width: 1%;
            vertical-align: top;
        }

        /* Second column takes remaining space */
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

        .table-containers {
            width: 650px;
            overflow-x: fixed; /* Enable horsizontal scrolling */
        }

    
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
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
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
                        PRODUCT / ITEM INFORMATION - ADDENDUM FOR SPECIFICATION  
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none" style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        @if(!empty( $document->pia_name ))
                          {{ $document->pia_name }}
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
                       {{ $document->select_specification }}
                    </span>
                    
                    
                    </td>
                </tr>
            </tbody>
        </table>
    
    </header>


    <footer class="footer" style=" font-family: Arial, sans-serif; font-size: 14px; ">
        <table class="border p-10" style="width: 100%; border-collapse: collapse; text-align: left;">
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
                    <td style="padding: 10px; border: 1px solid #ddd;">Approved By: Head QA</td>
                    <th style="padding: 10px; border: 1px solid #ddd; font-size: 14px;">Sign/Date :{{ \Carbon\Carbon::parse($document->created_at)->format('d-M-Y') }}</th>
                    <td style="padding: 10px; border: 1px solid #ddd;">  </td>        
                </tr>
            </tbody>
        </table>
        <span>
           Format No.: QA/097/F3-01                               
        </span>
    </footer>

   
    @if($document->pia_name_code === 'RW')    

    <table style="margin-top: 15px;">
        <thead>
            <tr>
                <th class="text-left">
                    <div class="bold">Raw Material specification</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Item Code</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Vendor Name</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Grade</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Sample quantity</th>
            </tr>
        </thead>
        <tbody>
        @if (!empty($MaterialSpecificationData))
            @foreach ($MaterialSpecificationData as $key => $item)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['item_code'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['vendor_name'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['grade'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['sample_quantity'] ?? '' }}</td>
                 
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" style="border: 1px solid black; text-align: center; font-weight: bold;">No Data Available</td>
            </tr>
        @endif
        </tbody>
    </table>

    <table style="margin-top: 20px; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Storage condition</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Prepared by Quality Person (Sign/Date)</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Checked by QC (Sign/Date)</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Approved by QA (Sign/Date)</th>
            </tr>
        </thead>
        <tbody>
        @if (!empty($MaterialSpecificationData))
            @foreach ($MaterialSpecificationData as $key => $item)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['storage_condition'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['prepared_quality_person_sign_date'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['check_by_qc_hod_designee_sign'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['approved_by_qa_hod_desinee_sign'] ?? '' }}</td>
                 
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" style="border: 1px solid black; text-align: center; font-weight: bold;">No Data Available</td>
            </tr>
        @endif
        </tbody>
    </table>

    @else

    <table style="margin-top: 15px;">
        <thead>
            <tr>
                <th class="text-left">
                    <div class="bold">Product Specification</div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Product Code</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">FG Code</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Country</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Brand Name / Grade</th>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Pack Size</th>
            </tr>
        </thead>
        <tbody>
        @if (!empty($ProductSpecificationData))
            @foreach ($ProductSpecificationData as $key => $item)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['product_code'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['fg_code'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['country'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['brand_name_grade'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['pack_size'] ?? '' }}</td>
 
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" style="border: 1px solid black; text-align: center; font-weight: bold;">No Data Available</td>
            </tr>
        @endif
        </tbody>
    </table>

    <table style="margin-top: 20px; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black; width: 10%; font-weight: bold;">Sr. No</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Shelf Life</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Sample Quantity</th>
                <th style="border: 1px solid black; width: 20%; font-weight: bold;">Storage Condition</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Prepared by Quality Person (Sign/Date)</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Checked by QC (Sign/Date)</th>
                <th style="border: 1px solid black; width: 30%; font-weight: bold;">Approved by QA (Sign/Date)</th>
            </tr>
        </thead>
        <tbody>
        @if (!empty($ProductSpecificationData))
            @foreach ($ProductSpecificationData as $key => $item)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid black; text-align: left;">{{ $item['shelf_life'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['sample_quantity'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['storage_condition'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['prepared_by_quality_person'] ?? '' }}</td>
                 
                    <td style="border: 1px solid black; text-align: left;">{{ $item['checked_by_qc_hod_designee'] ?? '' }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item['approved_by_qa_hod_designee'] ?? '' }}</td>
 
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="border: 1px solid black; text-align: center; font-weight: bold;">No Data Available</td>
            </tr>
        @endif
        </tbody>
    </table>

    @endif






   










    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 12;
                $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                $y = 760;
                $x = 480;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>