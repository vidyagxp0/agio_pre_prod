<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
            text-align: justify;
            text-justify: inter-word;
        }

        @page {
            margin: 24mm 15mm 24mm 15mm; /* Adjust sizes accordingly */
        }
        header {
            position: fixed;
            top: -24mm; /* Adjust based on your header size */
            left: 0;
            width: 100%;
            height: 170px; /* Adjust based on your content */
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        footer {
            position: fixed;
            bottom: -24mm; /* Adjust based on your footer size */
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            color: black;
            text-align: center;
            padding: 10px;
            height: 24mm;
        }
        body {
            font-family: 'Helvetica', sans-serif;
        }
        .content {
            margin-top: 175px;
            margin-bottom: 24mm;
        }
        table.header-footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.header-footer-table td {
            text-align: center;
            vertical-align: middle;
        }
        table.header-footer-table td.logo {
            width: 20%;
        }
        table.header-footer-table td.title {
            width: 60%;
            font-size: 16px;
            line-height: 1.4;
        }
        table.footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.footer-table td {
            border: 1px solid black;
            width: 33.33%;
            text-align: center;
        }

        /* FOR SUMMERNOTE */
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
        }
        
        .MsoNormalTable, .table {
            table-layout: fixed;
            width: 650px!important;
        }

        /* ALLOW PAGE BREAKS */
        p, b, div, h1, h2, h3, h4, h5, h6, ol, ul, li, span {
            page-break-after: auto;  /* Allows automatic page breaks after these elements */
            page-break-inside: auto; /* Allows page breaks inside these elements */
        }

        /* Additional styles to ensure list items are handled correctly */
        ol, ul {
            page-break-before: auto; /* Allows page breaks before lists */
            page-break-inside: avoid; /* Prefer avoiding breaks inside lists */
        }

        li {
            page-break-after: auto; /* Allows automatic page breaks after list items */
            page-break-inside: avoid; /* Prefer avoiding breaks inside list items */
        }

        /* Handling headings to maintain section integrity */
        h1, h2, h3, h4, h5, h6 {
            page-break-after: avoid; /* Avoids breaking immediately after headings */
            page-break-inside: avoid; /* Avoids breaking inside headings */
            page-break-before: auto; /* Allows automatic page breaks before headings */
        }

    </style>
</head>
<body>
    <header>
        <table class="header-footer-table">
            <tr>
                <td class="logo"><img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="Logo 1" height="50"></td>
                <td class="title"><b>Environmental Laboratory</b><br>{{ $data->document_name }}</td>
                <td class="logo"><img src="https://environmentallab.doculife.co.in/public/user/images/logo1.png" alt="Logo 2" height="125"></td>
            </tr>
        </table>
    </header>

    <footer>
        <table class="footer-table">
            <tr>
                <td>
                    @php
                        $temp = DB::table('document_types')
                            ->where('name', $data->document_type_name)
                            ->value('typecode');
                    @endphp
                    @if($data->revised === 'Yes')  
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->revised_doc }}/R{{$data->major}}.{{$data->minor}}

                        @else
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->id }}/R{{$data->major}}.{{$data->minor}}                           
                    @endif
                </td>
                <td>Printed On : {{ $time }}</td>
                <td>

                </td>
            </tr>
        </table>
    </footer>
    
    <div class="content">
        <section>
            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">1.</th>
                            <th class="text-left">Purpose</th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block; margin-left: 2.5rem;">
                            <div class="w-100">
                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; ">
                                    {!! $data->document_content ? nl2br($data->document_content->purpose) : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">2.</th>
                            <th class="text-left">Scope</th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    {!! $data->document_content ? nl2br($data->document_content->scope) : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">3.</th>
                        <th class="w-95 text-left">
                            <div class="mb-10">Responsibility</div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <div class="procedure-block">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block;">
                        <div class="w-100">
                            <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                @php
                                    $i = 1;
                                @endphp
                                @if ($data->document_content && !empty($data->document_content->responsibility))
                                    @foreach (unserialize($data->document_content->responsibility) as $key => $res)
                                        @php
                                            $isSub = str_contains($key, 'sub');
                                        @endphp
                                        @if (!empty($res))
                                            <div style="position: relative;">
                                                <span style="position: absolute; left: -2.5rem; top: 0;">3.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                            </div>
                                        @endif
                                        @php
                                            if (!$isSub) {
                                                $i++;  
                                                $sub_index = 1; 
                                            } else {
                                                $sub_index++;
                                            } 
                                        @endphp
                                    @endforeach
                                @endif    

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">4.</th>
                        <th class="w-95 text-left">
                            <div class="mb-10">Abbreviation</div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <div class="procedure-block">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block;">
                        <div class="w-100">
                            <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                @php
                                    $i = 1;
                                @endphp
                                @if ($data->document_content && !empty($data->document_content->abbreviation))
                                    @foreach (unserialize($data->document_content->abbreviation) as $key => $res)
                                        @php
                                            $isSub = str_contains($key, 'sub');
                                        @endphp
                                        @if (!empty($res))
                                            <div style="position: relative;">
                                                <span style="position: absolute; left: -2.5rem; top: 0;">4.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                            </div>
                                        @endif
                                        @php
                                            if (!$isSub) {
                                                $i++;  
                                                $sub_index = 1; 
                                            } else {
                                                $sub_index++;
                                            } 
                                        @endphp
                                    @endforeach
                                @endif    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DEFINITIONS START --}}
                <table class="mb-20">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">5.</th>
                            <th class="w-95 text-left">
                                <div class="bold mb-10">Definitions</div>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php
                                        $i = 1;
                                        $definitions = $data->document_content ? unserialize($data->document_content->defination) : [];
                                    @endphp
                                    @if ($data->document_content && !empty($data->document_content->defination))
                                        @foreach ($definitions as $key => $definition)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span style="position: absolute; left: -2.5rem; top: 0;">5.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                                </div>
                                            @endif
                                            @php
                                                if (!$isSub) {
                                                    $i++;  
                                                    $sub_index = 1; 
                                                } else {
                                                    $sub_index++;
                                                } 
                                            @endphp
                                        @endforeach
                                    @endif  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- DEFINITIONS END --}}

            {{-- MATERIALS AND EQUIPMENTS START --}}
                <table class="mb-20">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">6.</th>
                            <th class="w-95 text-left">
                                <div class="bold mb-10">Materials & Equipments</div>
                            </th>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 3rem;">
                                    @php $i = 1; $sub_index = 1; @endphp
                                    @if ($data->document_content)
                                        @foreach (unserialize($data->document_content->materials_and_equipments) as $key => $res)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span style="position: absolute; left: -2.5rem; top: 0;">6.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                                </div>
                                            @endif
                                            @php
                                                if (!$isSub) {
                                                    $i++;  
                                                    $sub_index = 1; 
                                                } else {
                                                    $sub_index++;
                                                } 
                                            @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- MATERIALS AND EQUIPMENTS END --}}

            {{-- SAFETY START --}}
            <div class="other-container ">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">7.</th>
                            <th class="text-left">Safety & Precautions</th>
                        </tr>
                    </thead>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @if ($data->document_content)
                                        {!! strip_tags($data->document_content->safety_precautions, '<br><table><th><td><tbody><tr><p><img><a><img><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- SAFETY END --}}

            {{-- PROCEDURE START --}}
                <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5">8.</th>
                                <th class="text-left">Procedure</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="procedure-block">
                        <div class="w-100">
                            <div class="w-100" style="display:inline-block;">
                                <div class="w-100">
                                    <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                        @if ($data->document_content)
                                            {!! strip_tags($data->document_content->procedure, '<br><table><th><td><tbody><tr><p><img><a><img><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- PROCEDURE END --}}

            {{-- REPORTING START --}}
                <table class="mb-20 ">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">9.</th>
                            <th class="w-95 text-left">
                                <div class="bold mb-10">Reporting</div>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php $i = 1; @endphp
                                    @if ($data->document_content && !empty($data->document_content->reporting))
                                        @foreach (unserialize($data->document_content->reporting) as $key => $res)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span style="position: absolute; left: -2.5rem; top: 0;">9.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                                </div>
                                            @endif
                                            @php
                                                if (!$isSub) {
                                                    $i++;  
                                                    $sub_index = 1; 
                                                } else {
                                                    $sub_index++;
                                                } 
                                            @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- REPORTING END --}}

            {{-- REFERENCES START --}}
                <table class="mb-20">
                    <tbody>
                        <tr>
                            <th class="w-5 vertical-baseline">10.</th>
                            <th class="w-95 text-left">
                                <div class="bold mb-10"> References</div>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                    @php $i = 1; @endphp
                                    @if ($data->document_content && !empty($data->document_content->references))
                                        @foreach (unserialize($data->document_content->references) as $key => $res)
                                            @php
                                                $isSub = str_contains($key, 'sub');
                                            @endphp
                                            @if (!empty($res))
                                                <div style="position: relative;">
                                                    <span style="position: absolute; left: -2.5rem; top: 0;">10.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                                </div>
                                            @endif
                                            @php
                                                if (!$isSub) {
                                                    $i++;  
                                                    $sub_index = 1; 
                                                } else {
                                                    $sub_index++;
                                                } 
                                            @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- REFERENCES END --}}
            
            {{-- ANNEXSURE START --}}
            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">11.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10">Annexure</div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <div class="procedure-block">
                <div class="w-100">
                    <div class="w-100" style="display:inline-block;">
                        <div class="w-100">
                            <div style="height:auto; overflow-x:hidden; width:650px; margin-left: 2.5rem;">
                                @php $i = 1; @endphp
                                @if ($data->document_content && !empty($data->document_content->ann))
                                    @foreach (unserialize($data->document_content->ann) as $key => $res)
                                        @php
                                            $isSub = str_contains($key, 'sub');
                                        @endphp
                                        @if (!empty($res))
                                            <div style="position: relative;">
                                                <span style="position: absolute; left: -2.5rem; top: 0;">11.{{ $isSub ? $i - 1 . '.' . $sub_index : $i }}</span> {!! nl2br($res) !!} <br>
                                            </div>
                                        @endif
                                        @php
                                            if (!$isSub) {
                                                $i++;  
                                                $sub_index = 1; 
                                            } else {
                                                $sub_index++;
                                            } 
                                        @endphp
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ANNEXSURE END --}}

            @php
                $i = 1;
            @endphp
                {{-- @if ($data->document_content && !empty($data->document_content->annexuredata))
                    @foreach (unserialize($data->document_content->annexuredata) as $res)
                        @if (!empty($res))
                            <div class="annexure-block">
                                <div class="w-100">
                                    <div class="w-100" style="display:inline-block;">
                                        <div class="w-100">
                                            <div style="height:auto; overflow-x:hidden; width:650px; ">
                                                {!! strip_tags($res, '<br><table><th><td><tbody><tr><p><img><a><img><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif --}}
            </section>
            
            <section class="doc-control" style="page-break-after: never;">
                <div class="head">
                    <div>
                        Document Control Information
                    </div>
                </div>
            <div class="body">
                <div class="block mb-40">
                    <div class="block-head">
                        General Information
                    </div>
                    <div class="block-content">
                        <table>
                            <tbody>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Document Number</th>
                                    <td class="w-70 text-left">
                                        @php
                                        $temp = DB::table('document_types')
                                            ->where('name', $data->document_type_name)
                                            ->value('typecode');
                                       @endphp
                                        @if($data->revised === 'Yes') 
                                           
                                        {{ Helpers::getDivisionName($data->division_id) }}
                                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                                        /000{{ $data->revised_doc }}/R{{$data->major}}.{{$data->minor}}

                                        @else
                                        {{ Helpers::getDivisionName($data->division_id) }}
                                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                                        /000{{ $data->id }}/R{{$data->major}}.{{$data->minor}}
                                        
                                    @endif
                                </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Title</th>
                                    <td class="w-70 text-left">{{ $data->document_name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">
                                        Short Description
                                    </th>
                                    <td class="w-70 text-left">
                                        {{ $data->short_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Description</th>
                                    <td class="w-70 text-left">
                                        {{ $data->description }}
                                    </td>
                                </tr>
                                @php
                                    $last = DB::table('document_histories')
                                        ->where('document_id', $data->id)
                                        ->latest()
                                        ->first();
                                @endphp

                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Last Changed</th>
                                    <td class="w-70 text-left">
                                        @if ($last)
                                            {{ $last->created_at }}
                                        @else
                                            {{ $data->created_at }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Changed By</th>
                                    <td class="w-70 text-left">
                                        @if ($last)
                                            {{ $last->user_name }}
                                        @else
                                            {{ $data->originator }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @php
                $signatureOriginatorData = DB::table('stage_manages')
                                                    ->where('document_id', $data->id)
                                                    ->where(function ($query) {
                                                        $query->where('stage', 'In-Review')
                                                            ->orWhere('stage', 'In-Approval');
                                                    })
                                                    ->latest()
                                                    ->first();

                                                    $signatureReviewerData = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('stage', 'Reviewed')
                                                ->get();
// dd($signatureReviewerData);
                                                    $signatureApprovalData = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('stage', 'Approved')
                                                ->latest()
                                                ->first();
                @endphp
                <div class="block mb-40">
                    <div class="block-head">
                        Originator
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Originator</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left w-25">{{ $data->originator }}</td>
                                    <td class="text-left w-25">{{ $document->originator && $document->originator->department ? $document->originator->department->name : '' }}</td>
                                    <td class="text-left w-25">Initiation Completed</td>
                                    <td class="text-left w-25">{{ $data->originator_email }}</td>
                                    <td class="text-left w-25">{{ !$signatureOriginatorData || $signatureOriginatorData->comment == null ? " " : $signatureOriginatorData->comment }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block mb-40">
                    <div class="block-head">
                        Reviews
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Reviewer</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->reviewers)
                                    @php
                                        $reviewer = explode(',', $data->reviewers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($reviewer); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $reviewer[$i])
                                                ->first();
                                            $dept = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                            $date = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Reviewed')
                                                ->latest()
                                                ->first();
                                            
                                                $comment = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->latest()
                                                ->first();


                                            $reject = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Cancel-by-Reviewer')
                                                ->latest()
                                                ->first();

                                        @endphp
                                        <tr>
                                            <td class="text-left w-25">{{ $user->name }}</td>
                                            <td class="text-left w-25">{{ $dept }}</td>
                                            @if ($date)
                                                <td class="text-left w-25">Review Completed</td>
                                            @elseif(!empty($reject))
                                                <td class="text-left w-25">Review Rejected </td>
                                            @else
                                                <td class="text-left w-25">Review Pending</td>
                                            @endif                                                

                                            <td class="text-left w-25">{{ $user->email }}</td>
                                            <td class="text-left w-25"> 
                                            @if($comment)
                                                {{ $comment->comment }}
                                            @endif</td>
                                            {{-- <td class="text-left w-25">{{ !$comment || $signatureReviewerData->comment == null ? " " : $signatureReviewerData->comment }}</td> --}}

                                        </tr>
                                    @endfor
                                @endif
                                @if ($data->reviewers_group)
                                    @php
                                        $group = explode(',', $data->reviewers_group);
                                        $i = 0;

                                    @endphp
                                    @for ($i = 0; $i < count($group); $i++)
                                        @php

                                            $users_id = DB::table('group_permissions')
                                                ->where('id', $group[$i])
                                                ->value('user_ids');
                                            $reviewer = explode(',', $users_id);
                                            $i = 0;
                                        @endphp
                                        @if ($users_id)
                                            @for ($i = 0; $i < count($reviewer); $i++)
                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $reviewer[$i])
                                                        ->first();
                                                    $dept = DB::table('departments')
                                                        ->where('id', $user->departmentid)
                                                        ->value('name');
                                                    $date = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Review-Submit')
                                                        ->latest()
                                                        ->first();
                                                        
                                                    $reject = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Cancel-by-Reviewer')
                                                        ->latest()
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td class="text-left w-25">{{ $user->name }}</td>
                                                    <td class="text-left w-25">{{ $dept }}</td>
                                                    @if ($date)
                                                        <td class="text-left w-25">Review Completed</td>
                                                    @elseif(!empty($reject))
                                                        <td class="text-left w-25">Review Rejected </td>
                                                    @else
                                                        <td class="text-left w-25">Review Pending</td>
                                                    @endif

                                                    <td class="text-left w-25">{{ $user->email }}</td>
                                                </tr>
                                            @endfor
                                        @endif
                                    @endfor


                                @endif

                            </tbody>
                            {{-- <tbody>
                                    <tr>
                                        <td class="text-left w-25">Vivek</td>
                                        <td class="text-left w-25">Quality Control</td>
                                        <td class="text-left w-25">12-12-2023 11:12PM</td>
                                        <td class="text-left w-25">vivek@gmail.com</td>
                                    </tr>
                                </tbody> --}}
                        </table>
                    </div>
                </div>
                <div class="block mb-40">
                    <div class="block-head">
                        Approvals
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Approver</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->approvers)
                                    @php
                                        $reviewer = explode(',', $data->approvers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($reviewer); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $reviewer[$i])
                                                ->first();
                                            $dept = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                            $date = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Approved')
                                                ->latest()
                                                ->first();
                                                $comment = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->latest()
                                                ->first();
                                            $reject = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Cancel-by-Approver')
                                                ->latest()
                                                ->first();
                                                
                                        @endphp
                                        <tr>
                                            <td class="text-left w-25">{{ $user->name }}</td>
                                            <td class="text-left w-25">{{ $dept }}</td>
                                            @if ($date)
                                                <td class="text-left w-25">Approval Completed</td>
                                            @elseif(!empty($reject))
                                                <td>Approval Rejected</td>
                                            @else
                                                <td class="text-left w-25">Approval Pending</td>
                                            @endif

                                            <td class="text-left w-25">{{ $user->email }}</td>
                                            <td class="text-left w-25">
                                                @if($comment)
                                                {{ $comment->comment }}
                                            @endif
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                                @if ($data->approver_group)
                                    @php
                                        $group = explode(',', $data->approver_group);
                                        $i = 0;

                                    @endphp
                                    @for ($i = 0; $i < count($group); $i++)
                                        @php

                                            $users_id = DB::table('group_permissions')
                                                ->where('id', $group[$i])
                                                ->value('user_ids');
                                            $reviewer = explode(',', $users_id);
                                            $i = 0;
                                        @endphp
                                        @if ($users_id)
                                            @for ($i = 0; $i < count($reviewer); $i++)
                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $reviewer[$i])
                                                        ->first();
                                                    $dept = DB::table('departments')
                                                        ->where('id', $user->departmentid)
                                                        ->value('name');
                                                    $date = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Approval-Submit')
                                                        ->latest()
                                                        ->first();
                                                    $reject = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Cancel-by-Approver')
                                                        ->latest()
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td class="text-left w-25">{{ $user->name }}</td>
                                                    <td class="text-left w-25">{{ $dept }}</td>
                                                    @if ($date)
                                                        <td class="text-left w-25">Approval Completed</td>
                                                    @elseif(!empty($reject))
                                                        <td class="text-left w-25">Approval Rejected </td>
                                                    @else
                                                        <td class="text-left w-25">Approval Pending</td>
                                                    @endif

                                                    <td class="text-left w-25">{{ $user->email }}</td>                                  
                                                </tr>
                                            @endfor
                                        @endif
                                    @endfor


                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 811;
                    $x = 445;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>
</body>
</html>
