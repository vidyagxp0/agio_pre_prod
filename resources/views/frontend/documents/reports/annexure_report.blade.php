<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annexure Report</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> --}}

    <style>
        * {
            font-family: "Open Sans", "Roboto", "Noto Sans KR", "Poppins", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        .symbol-support {
            font-family:"DeJaVu Sans Mono",monospace !important;
        }

        html{
            text-align: justify;
            text-justify: inter-word;
        }
        table {
            width: 100%;
        }
        td,
        th {
            text-align: center;
            
        }

        .w-5 {
            width: 5%;
        }

        .w-10 {
            width: 10%;
        }

        .w-15 {
            width: 15%;
        }

        .w-20 {
            width: 20%;
        }

        .w-25 {
            width: 25%;
        }

        .w-30 {
            width: 30%;
        }

        .w-33 {
            width: 33%;
        }

        .w-35 {
            width: 35%;
        }

        .w-40 {
            width: 40%;
        }

        .w-45 {
            width: 45%;
        }

        .w-50 {
            width: 50%;
        }

        .w-55 {
            width: 55%;
            
        }

        .w-60 {
            width: 60%;
        }

        .w-65 {
            width: 65%;
        }

        .w-70 {
            width: 70%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-90 {
            width: 90%;
        }

        .w-95 {
            width: 95%;
        }

        .w-100 {
            width: 100%;
        }

        .border {
            border: 1px solid black;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .border-left {
            border-left: 1px solid black;
        }

        .border-right {
            border-right: 1px solid black;
        }

        .border-top-none {
            border-top: 0px solid black;
        }

        .border-bottom-none {
            border-bottom: 0px solid black;
        }

        .border-left-none {
            border-left: 0px solid black;
        }

        .border-right-none {
            border-right: 0px solid black;
        }

        .p-20 {
            padding: 20px;
        }

        .p-10 {
            padding: 10px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }

        .mb-40 {
            margin-bottom: 40px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .text-left {
            text-align: left;
            word-wrap: break-word;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
            
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .vertical-baseline {
            vertical-align: baseline;
        }

        table.table-bordered {
            border-collapse: collapse;
            border: 1px solid grey;

        }

        table.table-bordered td,
        table.table-bordered th {
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

        td.logo img {
            width: 100%;
            max-width: 100px;
            aspect-ratio: 1/0.35;

        }

        td.doc-num {
            font-size: 1rem;
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
            margin-top: 220px;
            margin-bottom:60px;

        }

        header {
            width: 100%;
            position: fixed;
            top: -215px;
            right: 0;
            left: 0;
            display: block;

        }

       
        .footer {
            position: fixed;
            bottom: -45px;
            left: 0;
            right: 0;
            width: 100%;
            display: block;
            border-top: 1px solid #ddd; /* Optional: Add a border at the top of the footer */
        }
        .footer-info {
            position: fixed;
            bottom: 50px;
            left: 0;
            right: 0;
            width: 100%;
            display: block;
            border-top: 1px solid #ddd; /* Optional: Add a border at the top of the footer */
        }


        .other-container {
            margin: 0 0 0 0;

        }

        .other-container>table {
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

        .empty-page {
            page-break-after: always;
        }

        #pdf-page {
            /* page-break-inside: avoid; */
        }
        .page-break-before {
            page-break-before: always;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }
    
        .MsoNormalTable tr {
            border: 1px solid rgb(156, 156, 156);
        }
        
        .MsoNormalTable td {
            text-align: left!important;
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
        
        .MsoNormalTable, .table {
            table-layout: fixed;
            width: 650px!important;
        }

        /* CSS to allow page breaks after and inside common HTML elements */
        p, b, div, h1, h2, h3, h4, h5, h6, ol, ul, li, span {
            page-break-after: auto;  /* Allows automatic page breaks after these elements */
            page-break-inside: auto; /* Allows page breaks inside these elements */
        }

        /* Additional styles to ensure list items are handled correctly */
        ol, ul {
            page-break-before: auto; /* Allows page breaks before lists */
            page-break-inside: auto; /* Prefer avoiding breaks inside lists */
        }

        li {
            page-break-after: auto; /* Allows automatic page breaks after list items */
            page-break-inside: auto; /* Prefer avoiding breaks inside list items */
        }

        /* Handling headings to maintain section integrity */
        h1, h2, h3, h4, h5, h6 {
            page-break-after: auto; /* Avoids breaking immediately after headings */
            page-break-inside: auto; /* Avoids breaking inside headings */
            page-break-before: auto; /* Allows automatic page breaks before headings */
        }
        
        .main-section {
            text-align: left;
        }

    </style>

</head>

<body>

    <header class="">
        <table class="border" style="height: 147px;">
            <tbody>
                <tr>
                    <td class="logo w-20">
                        <img src="{{ asset('user/images/agio.jpg') }}" alt="..." style="margin-top: 0.5rem; margin-bottom: 1rem;"> 
                    </td>
                    <td class="title w-60" 
                    style="height: 150px; padding: 0px;  margin: 0px; border-left: 1px solid rgb(104, 104, 104); border-right: 1px solid rgb(104, 104, 104);">
                        <p 
                        style="margin-top: -0.1rem; border-bottom: 1px solid rgb(104, 104, 104);">{{ config('site.pdf_title') }}</p>
                        <br>
                        <p style="margin-top: -2rem; margin-bottom: 0px;">
                            {{ $data->document_name }}
                        </p>
                    </td>
                    <td class="logo w-20">
                        <img src="{{ asset('user/images/agio.jpg') }}" alt="..." style="margin-top: 0.5rem; margin-bottom: 1rem;"> 
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none p-10">
            <tbody>
                <tr>
                    <td class="doc-num w-100"> 
                        @php
                        $temp = DB::table('document_types')
                            ->where('name', $data->document_type_name)
                            ->value('typecode');
                       @endphp
                        @if($data->revised === 'Yes') 
                               
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}

                        @else
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}
                        A-{{ $annexure_number }}
                    @endif
                </tr>
            </tbody>
        </table>
    </header>

    <footer class="footer">
        <table class="border p-20">
            <tbody>
               
                <tr>
                    <td class="text-left w-36">
                        @php
                            $temp = DB::table('document_types')
                                ->where('name', $data->document_type_name)
                                ->value('typecode');
                        @endphp
                        @if($data->revised === 'Yes')  
                            {{ Helpers::getDivisionName($data->division_id) }}
                            /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                            /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}

                            @else
                            {{ Helpers::getDivisionName($data->division_id) }}
                            /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                            /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}                           
                        @endif
                        A-{{ $annexure_number }}
                        
                    <td class="w-36">Printed On : {{ $time }}</td>
                    <td class="text-right w-20"></td>
                </tr>
            </tbody>
        </table>
    </footer>
  
    <section  class="main-section" id="pdf-page" style="position: relative;">
        <section style="page-break-inside: auto;">
            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline"></th>
                        <th class="w-95 text-left">
                            <div class="bold" style="margin-left: -2.5rem;">Annexure - {{ $annexure_number }}</div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <div class="procedure-block" style="page-break-inside: auto;">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block;">
                        <div class="w-100">
                            <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                <div style="position: relative; page-break-inside: auto; margin-left: -2.5rem;">
                                    {!! nl2br($annexure_data) !!}
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
   


    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 788;
                    $x = 485;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>

</body>

</html>
