<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

{{-- <style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
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

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td,
    .border-table table,
    .border-table th,
    .border-table td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    footer .head,
    header .head {
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        width: 100%;
        position: fixed;
        display: block;
        bottom: -40px;
        left: 0;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block tr {
        font-size: 0.8rem;
    }

    .inner-block .block {
        margin-bottom: 30px;
    }

    .inner-block .block-head {
        font-weight: bold;
        font-size: 1.1rem;
        padding-bottom: 5px;
        border-bottom: 2px solid #4274da;
        margin-bottom: 10px;
        color: #4274da;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }

    .table_bg {
        background: #4274da57;
    }

    .summernote-scroll-wrapper {
    overflow-x: auto;
    max-width: 100%;
        }

        .summernote-content table {
            min-width: 100%;
            border-collapse: collapse !important;
            table-layout: auto !important;
        }

        .summernote-content table td,
        .summernote-content table th {
            border: 1px solid #ccc !important;
            padding: 8px !important;
            vertical-align: top !important;
            text-align: left !important;
            word-wrap: break-word;
        }

        .summernote-content table th {
            background-color: #f9f9f9 !important;
            font-weight: bold;
        }

    
</style>

<style>
    
        #isPasted {
            width: 690px !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; 
            width: 1%;
            vertical-align: top;
        }

        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;

        }

        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 700px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important;
            height: 100%;
            display: block;
            margin: 5px auto;
        }

        #isPasted td img {
            max-width: 400px !important;
            height: 300px;
            margin: 5px auto;
        }

        .table-containers {
            width: 690px;
            overflow-x: fixed;
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
        
</style> --}}
<style>
    @page {
         margin: 160px 35px 100px; /* top header, side margin, bottom footer */
     }
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
        margin-top: 10px;
        margin-bottom: -60px; 
    }

    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        /* padding: 20px 35px; */
        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: 0;
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }
    /* To remove borders from content part only */
    .content-area table {
        border: none !important;
    }

    .inner-block {
        /* padding: 20px 35px;  */
        box-sizing: border-box;
    }
    
    .block {
        margin-bottom: 25px;
    }

    .block-head {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 2px solid #387478;
        color: #387478;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .table_bg {
        background-color: #387478;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    th, td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-50 { width: 50%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }
    table th, table td {
        word-wrap: break-word;
    }
</style>

<body>
    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Observation Report
                    </div>
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Observation No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::getDivisionName($data->division_code) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

<div class="inner-block">
 <div class="content-table">
    <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                            {{ Helpers::getDivisionName($data->division_code) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{-- <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if (Helpers::getDivisionName(session()->get('division')))
                                {{ Helpers::getDivisionName(session()->get('division')) }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}
                         <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if (Helpers::getDivisionName($data->division_code))
                                {{ Helpers::getDivisionName($data->division_code) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>

                        <th class="w-20">Date Of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                    </tr>

                    <tr>
                        @php
                            $users = DB::table('users')->select('id', 'name')->get();
                            $matched = false;
                        @endphp
                        <th class="w-20">Auditee Department Head</th>
                        @foreach ($users as $value)
                            @if ($data->assign_to == $value->id)
                                <td class="w-30">{{ $value->name }}</td>
                                @php $matched = true; @endphp
                            @break
                        @endif
                        @endforeach

                        @if (!$matched)
                            <td>Not Applicable</td>
                        @endif

                        <th class="w-20">Auditee Department Name</th>
                        <td class="w-30">
                            @if ($data->auditee_department)
                                {{ $data->auditee_department }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>    
                    <tr>
                        <th class="w-20">Observation Report Due Date</th>
                        <td class="w-80">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>   
                </table>
                <table>     
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            <div class="block-head">
                Attached files
             </div>
               <div class="border-table">
                 <table>
                     <tr class="table_bg">
                         <th class="w-20">Sr.No</th>
                         <th class="w-60">Attachment </th>
                     </tr>
                         @if($data->attach_files_gi)
                         @foreach(json_decode($data->attach_files_gi) as $key => $file)
                             <tr>
                                 <td class="w-20">{{ $key + 1 }}</td>
                                 <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                             </tr>
                         @endforeach
                         @else
                         <tr>
                             <td class="w-20">1</td>
                             <td class="w-60">Not Applicable</td>
                         </tr>
                     @endif

                 </table>
               </div>
            </div>

            <table>
                <tr>
                    <th class="w-20">Response Due Date</th>
                    <td class="w-80">
                        @if ($data->recomendation_capa_date_due)
                            {{ $data->recomendation_capa_date_due }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
                <style>
                    .head-number {
                        font-weight: bold;
                        font-size: 13px;
                        padding-left: 8px;
                    }

                    .div-data {
                        font-size: 13px;
                        padding-left: 8px;
                    }
                </style>

                <div class="block">
                    <div class="block-head">
                    Observation
                    </div>
                    <div class="border-table">
                    <table class="table table-bordered" id="Details-table">
                        <thead>
                            <tr class="table_bg">
                                <th style="width: 8%">Sr.No</th>
                                <th style="width: 80%">Observation</th>
                                <th style="width: 80%">Category</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if ($grid_Data && is_array($grid_Data->data))
                        @foreach ($grid_Data->data as $datas)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ isset($datas['non_compliance']) ? $datas['non_compliance'] : '' }}</td>
                                <td>{{ isset($datas['category']) ? $datas['category'] : '' }}</td>

                            </tr>
                        @endforeach
                        @endif
                        </tbody>

                    </table>
                    </div>
                </div>

           <div class="block">
            <div class="block-head">
                Response and CAPA Plan Details
            </div>
                <div class="block">
                    <div class="block-head">
                    Response Details
                    </div>
                    <div class="border-table">
                        <table class="table table-bordered" id="Details-table">
                            <thead>
                                <tr class="table_bg">
                                    <th style="width: 8%">Sr.No</th>
                                    <th style="width: 80%">Response Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($grid_Data2 && is_array($grid_Data2->data))
                                    @foreach ($grid_Data2->data as $datas)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ isset($datas['response_detail']) ? $datas['response_detail'] : '' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">
                    Corrective Actions
                    </div>
                    <div class="border-table">
                    <table class="table table-bordered" id="Details-table">
                        <thead>
                            <tr class="table_bg">
                                <th style="width: 8%">Sr.No</th>
                                <th style="width: 80%">Corrective Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($grid_Data3 && is_array($grid_Data3->data))
                        @foreach ($grid_Data3->data as $datas)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ isset($datas['corrective_action']) ? $datas['corrective_action'] : '' }}</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-head">
                    Preventive Action
                    </div>
                    <div class="border-table">
                    <table class="table table-bordered" id="Details-table">
                        <thead>
                            <tr class="table_bg">
                                <th style="width: 8%">Sr.No</th>
                                <th style="width: 80%">Preventive Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($grid_Data4 && is_array($grid_Data4->data))
                        @foreach ($grid_Data4->data as $datas)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ isset($datas['preventive_action']) ? $datas['preventive_action'] : '' }}</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>

            <div class="block">
                <div class="block-head">
                    Action Plan
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20" style="width: 25px;">Sr.No</th>
                            <th class="w-20">Action</th>
                            <th class="w-20">Responsible</th>
                            <th class="w-20">Target Completion Date</th>
                            <th class="w-20">Action Status</th>
                        </tr>
                        @foreach (unserialize($griddata->action) as $key => $temps)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ unserialize($griddata->action)[$key] ? unserialize($griddata->action)[$key] : '' }}</td>
                                <td>
                                @foreach ($users as $value)
                                    @if ($griddata && unserialize($griddata->responsible)[$key] == $value->id)
                                            {{ $value->name }}
                                    @endif

                                @endforeach
                                </td>
                                <td>{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}</td>
                                <td>{{ unserialize($griddata->item_status)[$key] ? unserialize($griddata->item_status)[$key] : '' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            {{-- <label class="head-number" for="Comments">Comments</label>
                <div class="div-data">
                    @if ($data->comments)
                        {{ $data->comments }}
                    @else
                        Not Applicable
                    @endif
                </div> --}}

            <table>
                <tr>
                    <th class="w-20">Comments</th>
                    <td class="w-80">
                        @if ($data->comments)
                            {{ $data->comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="block-head">
                Response And CAPA Attachments
            </div>
               <div class="border-table">
                 <table>
                     <tr class="table_bg">
                         <th class="w-20">Sr.No</th>
                         <th class="w-60">Attachment </th>
                     </tr>
                         @if($data->response_capa_attach)
                         @foreach(json_decode($data->response_capa_attach) as $key => $file)
                             <tr>
                                 <td class="w-20">{{ $key + 1 }}</td>
                                 <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                             </tr>
                         @endforeach
                         @else
                         <tr>
                             <td class="w-20">1</td>
                             <td class="w-60">Not Applicable</td>
                         </tr>
                     @endif

                 </table>
               </div>
           </div>
        </div>
            <div class="block-head">
                Summary
            </div>
            <div class="block-head">
                Action Summary
            </div>
            <table>
                 <tr>
                    <th class="w-20">Actual Action Start Date</th>
                    <td class="w-30">
                        @if ($data->actual_start_date)
                            {{ Helpers::getdateFormat($data->actual_start_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Actual Action End Date</th>
                    <td class="w-30">
                        @if ($data->actual_end_date)
                            {{ Helpers::getdateFormat($data->actual_end_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <th class="w-20 align-top">Action Taken</th>
                    <td class="w-80" colspan="3">
                        @if ($data->action_taken)
                            <div class="summernote-scroll-wrapper" style="overflow-x: auto; max-width: 100%;">
                                <div class="summernote-content">
                                    {!! $data->action_taken !!}
                                </div>
                            </div>
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <!-- <label class="head-number" for="Observation (+)">Action Taken</label>
                <div class="div-data">
                    @if ($data->action_taken)
                        {{ $data->action_taken }}
                    @else
                        Not Applicable
                    @endif
                </div> -->

                <!-- <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">Action Taken</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="custom-procedure-block">
                        <div class="custom-container">
                            <div class="custom-table-wrapper" id="custom-table2">
                                <div class="custom-procedure-content">
                                    <div class="custom-content-wrapper">
                                        <div class="table-containers">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="block-head">
                    Response Summary
                </div>
                <!-- <div class="other-container ">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="bold">Response Summary</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="custom-procedure-block">
                        <div class="custom-container">
                            <div class="custom-table-wrapper" id="custom-table2">
                                <div class="custom-procedure-content">
                                    <div class="custom-content-wrapper">
                                        <div class="table-containers">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <table>
                    <tr>
                        <th class="w-20 align-top">Response Summary</th>
                        <td class="w-80" colspan="3">
                            @if ($data->response_summary)
                                <div class="summernote-scroll-wrapper" style="overflow-x: auto; max-width: 100%;">
                                    <div class="summernote-content">
                                        {!! $data->response_summary !!}
                                    </div>
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                    Response and Summary Attachment
                </div>

                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                            @if($data->impact_analysis)
                            @foreach(json_decode($data->impact_analysis) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="block-head">
                    Response Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">Response Verification Comment</th>
                        <td class="w-80">
                            @if ($data->impact)
                                {{ $data->impact }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                  Response Verification Attachments
                </div>

                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                            @if($data->attach_files2)
                            @foreach(json_decode($data->attach_files2) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif

                    </table>
                </div>

                <div class="block-head">
                    Activity Log
                </div>
                
                <div class="block-head">
                    Report Issued
                </div>
                <table>
                    <tr>
                        <th class="w-20">Report Issued By</th>
                        <td class="w-30">
                            @if ($data->report_issued_by)
                                {{ $data->report_issued_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Report Issued On</th>
                        <td class="w-30">
                            @if ($data->report_issued_on)
                                {{ $data->report_issued_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Report Issued Comment</th>
                        <td class="w-30">
                            @if ($data->report_issued_comment)
                                {!! $data->report_issued_comment !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                    Cancel
                </div>
                <table>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">
                            @if ($data->cancel_by)
                                {{ $data->cancel_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">
                            @if ($data->cancel_on)
                                {{ $data->cancel_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">
                            @if ($data->cancel_comment)
                                {{ $data->cancel_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                    More Info Required
                </div>
                <table>
                    <tr>
                        <th class="w-20">More Info Required By</th>
                        <td class="w-30">
                            @if ($data->more_info_required_by)
                                {{ $data->more_info_required_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">
                            @if ($data->more_info_required_on)
                                {{ $data->more_info_required_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">More Info Required Comment</th>
                        <td class="w-30">
                            @if ($data->more_info_required_comment)
                                {{ $data->more_info_required_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                    CAPA Plan Proposed
                </div>
                <table>
                    <tr>
                        <th class="w-20">CAPA Plan Proposed By</th>
                        <td class="w-30">
                            @if ($data->complete_By)
                                {{ $data->complete_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">CAPA Plan Proposed On</th>
                        <td class="w-30">
                            @if ($data->complete_on)
                                {{ $data->complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">CAPA Plan Proposed Comment</th>
                        <td class="w-30">
                            @if ($data->complete_comment)
                                {{ $data->complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                <div class="block-head">
                    No CAPAs Required
                </div>
                <table>
                    <tr>
                        <th class="w-20">No CAPAs Required By</th>
                        <td class="w-30">
                            @if ($data->qa_approval_without_capa_by)
                                {{ $data->qa_approval_without_capa_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">No CAPAs Required On</th>
                        <td class="w-30">
                            @if ($data->qa_approval_without_capa_on)
                                {{ $data->qa_approval_without_capa_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">No CAPAs Required Comment</th>
                        <td class="w-30">
                            @if ($data->qa_approval_without_capa_comment)
                                {{ $data->qa_approval_without_capa_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block-head">
                    Response Reviewed
                </div>
                <table>
                    <tr>
                        <th class="w-20">Response Reviewed By</th>
                        <td class="w-30">
                            @if ($data->Final_Approval_by)
                                {{ $data->Final_Approval_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Response Reviewed On</th>
                        <td class="w-30">
                            @if ($data->Final_Approval_on)
                                {{ $data->Final_Approval_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Response Reviewed Comment</th>
                        <td class="w-30">
                            @if ($data->Final_Approval_comment)
                                {{ $data->Final_Approval_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            </div>


 </div>
</div>
</body>

</html>
