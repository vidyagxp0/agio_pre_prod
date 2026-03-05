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

    .tbl-bottum {
        margin-bottom: 20px
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
        padding-bottom: 7px;
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
    .why-why-chart-container {
    width: 100%;
    padding: 10px;
    background: #fff;
    border-radius: 5px;
    }

    .block-head {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .problem-statement th {
        background: #f4bb22;
        width: 150px;
    }

    .why-label {
        color: #393cd4;
        width: 150px;
    }

    .answer-label {
        color: #393cd4;
        width: 150px;
    }

    .root-cause th {
        background: #0080006b;
        width: 150px;
    }

    .text-muted {
        color: gray;
    }


    .full-width-table {
        width: 100%;
        table-layout: fixed; 
        border-collapse: collapse;
        border: 1px solid #ddd; 
    }

    .full-width-table th, 
    .full-width-table td {
        padding: 3px;
        text-align: center;
        font-size: 10px;
        border: 1px solid #ddd;
        word-wrap: break-word; 
    }

    .full-width-table thead {
        background-color: #f4f4f4; 
        font-weight: bold;
    }

    .full-width-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style> --}}

<style>
    @page {
         margin: 160px 35px 100px;
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

    .full-width-table {
        width: 100%;
        table-layout: fixed; 
        border-collapse: collapse;
        border: 1px solid #ddd; 
    }

    .full-width-table th, 
    .full-width-table td {
        padding: 3px;
        text-align: center;
        font-size: 10px;
        border: 1px solid #ddd;
        word-wrap: break-word; 
    }

    .full-width-table thead {
        background-color: #f4f4f4; 
        font-weight: bold;
    }

    .full-width-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
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
        white-space: normal !important;
        word-wrap: break-word;
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
    .w-6 { width: 7%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-40 { width: 40%; }
    .w-50 { width: 50%; }
    .w-60 { width: 60%; }
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
        font-size: 14px;
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

    .problem-statement th {
        background: #f4bb22;
        width: 150px;
    }

    .why-label {
        color: #393cd4;
        width: 150px;
    }

    .answer-label {
        color: #393cd4;
        width: 150px;
    }

    .root-cause th {
        background: #0080006b;
        width: 150px;
    }

    .text-muted {
        color: gray;
    }
    
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                     Root Cause Analysis Report
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
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30"><strong>Page No.</strong>
                </td>
            </tr>
        </table>
    </header>
     <footer>
        <table>
            <tr>
                <td class="w-50">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-50">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
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
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_code)
                                {{ $data->division_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>

                    <tr>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ( Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                {{  Helpers::getUsersDepartmentName(Auth::user()->departmentid)}}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> 
                <table>   
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Name Of Responsible Department Head</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->initiated_if_other)
                                    {!! $data->initiated_if_other !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            {{-- <th class="w-20">Type</th>
                            <td class="w-30">
                                @if ($data->Type)
                                    {{ $data->Type }}
                                @else
                                    Not Applicable
                                @endif
                            </td> --}}
                        </tr>
                    </table>
                    <table>    

                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->department)
                                    {{ $data->department }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                   
                </table>

                <div class="block-head">
                    Investigation Details
                </div>
                <table>
                    <tr>
                        <th class="w-20" >Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

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
                
                <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->root_cause_initial_attachment)
                            @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-20">Not Applicable</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>

        <div class="block">
            <div class="block-head">
              HOD Review
            </div>
            <table>
                <tr>
                    <th class="w-20" >HOD Review Comment</th>
                    <td class="w-80">
                        @if ($data->hod_comments)
                            {{ $data->hod_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_attachments)
                        @foreach (json_decode($data->hod_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>

        <div class="block">
            <div class="block-head">
              Initial QA/CQA Review 
            </div>
            <table>
                <tr>
                    <th class="w-20" >Initial QA/CQA Review Comments</th>
                    <td class="w-80">
                        @if ($data->cft_comments_new)
                            {{ $data->cft_comments_new }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            
            <div class="border-table">
                <div class="block-head">
                    Initial QA/CQA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cft_attchament_new)
                        @foreach (json_decode($data->cft_attchament_new) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>


        <style>
            .tableFMEA {
                width: 100%;
                border-collapse: collapse;
                font-size: 7px;
                table-layout: fixed; /* Ensures columns are evenly distributed */
            }

            .thFMEA,
            .tdFMEA {
                border: 1px solid black;
                padding: 5px;
                word-wrap: break-word;
                text-align: center;
                vertical-align: middle;
                font-size: 6px; /* Apply the same font size for all cells */
            }

            /* Rotating specific headers */
            .rotate {
                transform: rotate(-90deg);
                white-space: nowrap;
                width: 10px;
                height: 100px;
            }

            /* Ensure the "Traceability Document" column fits */
            .tdFMEA:last-child,
            .thFMEA:last-child {
                width: 80px; /* Allocate more space for "Traceability Document" */
            }

            /* Adjust for smaller screens to fit */
            @media (max-width: 1200px) {
                .tdFMEA:last-child,
                .thFMEA:last-child {
                    font-size: 6px;
                    width: 70px; /* Shrink width further for smaller screens */
                }
            }

        </style>


        <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>
                <!-- <div class="block-head">
                    Investigation
                </div> -->

                <table>
                    <tr>
                        <th class="w-20">Objective</th>
                        <td class="w-80">
                            @if ($data->objective)
                                {!! strip_tags($data->objective) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


               

                <table>
                    <tr>
                        <th class="w-20">Scope</th>
                        <td class="w-80">
                            @if ($data->scope)
                                {!! strip_tags($data->scope) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($data->problem_statement_rca)
                                {!! strip_tags($data->problem_statement_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Background</th>
                        <td class="w-80">
                            @if ($data->requirement)
                                {!! strip_tags($data->requirement) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">
                            @if ($data->immediate_action)
                                {!! strip_tags($data->immediate_action) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Team</th>
                        <td class="w-80">
                            @if ($data->investigation_team)
                                {{($investigation_teamNamesString) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>        
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if ($data->root_cause_methodology)
                                {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <br><br>
                <div class="border-table  tbl-bottum">
                    <div class="block-head">
                        Failure Mode and Effect Analysis
                    </div>
                    <table class="tableFMEA">
                        <thead>
                            <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                <th class="thFMEA" rowspan="2">Sr.No</th>
                                <th class="thFMEA" colspan="2">Risk Identification</th>
                                <th class="thFMEA">Risk Analysis</th>
                                <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                <th class="thFMEA">Risk Control</th>
                                <th class="thFMEA" colspan="6">Risk Evaluation</th>

                                <th class="thFMEA" rowspan="2">Traceability Document</th>
                                
                            </tr>
                            <tr class="table_bg">
                                <th class="thFMEA">Activity</th>
                                <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                <!-- <th class="thFMEA">Others</th>
                                <th class="thFMEA">Attchment</th> -->
                                
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($data->risk_factor))
                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                <tr class="tr">
                                    <td class="tdFMEA">{{ $key + 1 }}</td>
                                    <td class="tdFMEA">{{ $riskFactor }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                    
                                </tr>
                            @endforeach
                            @else
                            @endif

                        </tbody>
                    </table>

                </div>
               
                <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>

                @if (!empty($data))
                    @php
                        $measurement = !empty($data->measurement) ? unserialize($data->measurement) : [];
                        $materials = !empty($data->materials) ? unserialize($data->materials) : [];
                        $methods = !empty($data->methods) ? unserialize($data->methods) : [];

                        $environment = !empty($data->environment) ? unserialize($data->environment) : [];
                        $manpower = !empty($data->manpower) ? unserialize($data->manpower) : [];
                        $machine = !empty($data->machine) ? unserialize($data->machine) : [];

                        $problem_statement = $data->problem_statement ?? 'N/A';

                        $maxCount = max(count($measurement), count($materials), count($methods));
                        $maxCount2 = max(count($environment), count($manpower), count($machine));
                    @endphp

                    <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                        <!-- Top Table -->
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr valign="top">
                                <!-- First Table -->
                                <td style="width: 70%;">
                                    <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                        <thead>
                                            <tr style="color: #007bff;">
                                                <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $maxCount; $i++)
                                                <tr>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>        
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr >
                                <td style="width: 70%;">
                                    <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                </td>
                                <td style="width: 30%;">
                                    <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                                        <strong style="color: #007bff;">Problem Statement:</strong>
                                        <div style="margin-top: 10px;">
                                            {{ $data->problem_statement ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>       
                            </tr>
                        </table>


                        <!-- Second Table -->
                        <table style="width: 70%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="color: #007bff;">
                                    <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $maxCount2; $i++)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                @else
                    <p style="text-align: center; color: red;">No Fishbone data available.</p>
                @endif



                    <br><br><br><br>
                

                <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Inference
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-5">Sr.No.</th>
                            <th class="w-30">Type</th>
                            <th class="w-30">Remarks</th>
                        </tr>

                        @if (!empty($data->inference_type))
                            @foreach (unserialize($data->inference_type) as $key => $inference_type)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_type)[$key] ? unserialize($data->inference_type)[$key] : 'Not Applicable' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_remarks)[$key] ? unserialize($data->inference_remarks)[$key] : 'Not Applicable' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div>

                




                <div class="why-why-chart-container">
                    <div class="block-head">
                        <strong>Why-Why Chart</strong>
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="problem-statement">
                                <th>Problem Statement :</th>
                                <td>
                                    {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        @php
                            $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];
                        @endphp

                        @if (is_array($why_data) && count($why_data) > 0)
                            @foreach ($why_data as $index => $why)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="why-label">Why {{ $index + 1 }}</th>
                                            <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="answer-label">Answer {{ $index + 1 }}</th>
                                            <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <p class="text-muted">No Why-Why Data Available</p>
                        @endif
                    </div>

                    <div id="root-cause-container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="root-cause">
                                    <th>Root Cause :</th>
                                    <td>
                                        {{ $data->why_root_cause ?? 'Not Applicable' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="block-head">
                    Is/Is Not Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">What Will Be</th>
                        <td class="w-80">
                            @if ($data->what_will_be)
                                {{ $data->what_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Not Be </th>
                        <td class="w-80">
                            @if ($data->what_will_not_be)
                                {{ $data->what_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Rationale </th>
                        <td class="w-80">
                            @if ($data->what_rationable)
                                {{ $data->what_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Be</th>
                        <td class="w-80">
                            @if ($data->where_will_be)
                                {{ $data->where_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Not Be </th>
                        <td class="w-80">
                            @if ($data->where_will_not_be)
                                {{ $data->where_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Rationale </th>
                        <td class="w-80">
                            @if ($data->where_rationable)
                                {{ $data->where_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    <tr>
                        <th class="w-20">When Will Be</th>
                        <td class="w-80">
                            @if ($data->when_will_be)
                                {{ $data->when_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Not Be </th>
                        <td class="w-80">
                            @if ($data->when_will_not_be)
                                {{ $data->when_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Rationale </th>
                        <td class="w-80">
                            @if ($data->when_rationable)
                                {{ $data->when_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Be</th>
                        <td class="w-80">
                            @if ($data->coverage_will_be)
                                {{ $data->coverage_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Not Be </th>
                        <td class="w-80">
                            @if ($data->coverage_will_not_be)
                                {{ $data->coverage_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Rationale </th>
                        <td class="w-80">
                            @if ($data->coverage_rationable)
                                {{ $data->coverage_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Be</th>
                        <td class="w-80">
                            @if ($data->who_will_be)
                                {{ $data->who_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>

                        <th class="w-20">Who Will Not Be </th>
                        <td class="w-80">
                            @if ($data->who_will_not_be)
                                {{ $data->who_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Who Will Rationale </th>
                        <td class="w-80">
                            @if ($data->who_rationable)
                                {{ $data->who_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
            </div>


                <table>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->root_cause_Others)
                                {!! strip_tags($data->root_cause_Others) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="border-table">
                    <div class="block-head">
                        Other Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->investigation_attachment)
                            @foreach (json_decode($data->investigation_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-20">Not Applicable</td>
                            </tr>
                        @endif

                    </table>
                </div>  

                

                <table>
                    <tr>
                        <th class="w-20">Root Cause</th>
                        <td class="w-80">
                            @if ($data->root_cause)
                                {!! strip_tags($data->root_cause) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Impact / Risk Assessment</th>
                        <td class="w-80">
                            @if ($data->impact_risk_assessment)
                                {!! strip_tags($data->impact_risk_assessment) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                
                <table>
                    <tr>
                        <th class="w-20">CAPA</th>
                        <td class="w-80">
                            @if ($data->capa)
                                {!! strip_tags($data->capa) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Summary</th>
                        <td class="w-80">
                            @if ($data->investigation_summary_rca)
                                {!! strip_tags($data->investigation_summary_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
        
        
        <div class="border-table">
            <div class="block-head">
                Investigation Attachment

            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment</th>
                </tr>
                @if ($data->root_cause_initial_attachment_rca)
                    @foreach (json_decode($data->root_cause_initial_attachment_rca) as $key => $file)
                        <tr>
                            <td class="w-20">{{ $key + 1 }}</td>
                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                    target="_blank"><b>{{ $file }}</b></a> </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="w-20">1</td>
                        <td class="w-20">Not Applicable</td>
                    </tr>
                @endif

            </table>
        </div>                
    </div><br>





                

        <div class="block">
            <div class="block-head">
                HOD Final Review
            </div>

            <table>
                <tr>
                    <th class="w-20"> HOD Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->hod_final_comments)
                            {!! strip_tags($data->hod_final_comments) !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_final_attachments)
                        @foreach (json_decode($data->hod_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>

        </div>

        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->qa_final_comments)
                            {{ strip_tags($data->qa_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>

        </div>


            
        <div class="block">
            <div class="block-head">
                QAH/CQAH/Designee Final Approval
            </div>
            <table>
                <tr>
                    <th class="w-20">QAH/CQAH/Designee Final Approval Comments</th>
                    <td class="w-80">
                        @if ($data->qah_final_comments)
                            {{ strip_tags($data->qah_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH/Designee Final Approval Attachments

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>

        </div>
               
                {{-- <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Methodology </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_methodology)
                            {{ $data->root_cause_methodology }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Description</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_description)
                            {{ $data->root_cause_description }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Investigation Summary</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->investigation_summary)
                            {{ $data->investigation_summary }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                <!-- <tr>
                            <th class="w-20">Attachments</th>
                            <td class="w-80">
                        @if ($data->attachments)
                        <a href="{{ asset('upload/document/', $data->attachments) }}">{{ $data->attachments }}
                        @else
                        Not Applicable
                        @endif
                        </td>
                        </tr> -->
                                        {{-- <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                        </tr>
                      --}}
                </table>
                {{-- <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Root Cause
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Sr.No.</th>
                            <th class="w-30">Root Cause Category</th>
                            <th class="w-30">Root Cause Sub-Category</th>
                            <th class="w-30">Probability</th>
                            <th class="w-30">Remarks</th>
                        </tr>
                        {{-- @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
                        {{-- @if (!empty($data->Root_Cause_Category))
                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                    </td>
                                    <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div> --}} 
                
  
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
    
                                    <tr>
                                        <th class="w-20">Acknowledge By</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_by)
                                                {{ $data->acknowledge_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Acknowledge On</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_on)
                                                {{ Helpers::getdateFormat($data->acknowledge_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                
                                        <th class="w-20"> Acknowledge Comment</th>
                                        <td class="w-30">
                                            @if ($data->ack_comments)
                                                {{ $data->ack_comments }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                    {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
    
                                                                        
                                 <tr>
                                    <th class="w-20">HOD Review Complete By</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_By)
                                            {{ $data->HOD_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete On</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_On)
                                            {{ Helpers::getdateFormat($data->HOD_Review_Complete_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete Comment</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_Comment)
                                            {{ $data->HOD_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    {{-- <th class="w-20">QA Review Complete Comment</th>
                                            <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                                </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                </tr> --}}

                                <tr>
                                        <th class="w-20">QA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_By)
                                                {{ $data->QQQA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->QQQA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->QAQQ_Review_Complete_comment)
                                                {{ $data->QAQQ_Review_Complete_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                </tr> --}}
    
                           
                                    <tr>
                                        <th class="w-20">Submit By</th>
                                        <td class="w-30">
                                            @if ($data->submitted_by)
                                                {{ $data->submitted_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit On</th>
                                        <td class="w-30">
                                            @if ($data->submitted_on)
                                                {{ Helpers::getdateFormat($data->submitted_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit Comment</th>
                                        <td class="w-30">
                                            @if ($data->qa_comments_new)
                                                {{ $data->qa_comments_new }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">HOD Final Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_By)
                                            {{ $data->HOD_Final_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">HOD Final Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_On)
                                            {{ $data->HOD_Final_Review_Complete_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">
                                            HOD Final Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_Comment)
                                            {{ $data->HOD_Final_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr>
                                            <th class="w-20">More Info Required By
                                            </th>
                                            <td class="w-30"> @if($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20"> FinalQA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_By)
                                                {{ $data->Final_QA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->Final_QA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Completed Comment</th>
                                        <td class="w-30">
                                            @if ($data->evalution_Closure_comment)
                                                {{ $data->Final_QA_Review_Complete_Comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">QAH/CQAH Closure By</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_by)
                                                {{ $data->evaluation_complete_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QAH/CQAH Closure On</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_on)
                                                {{ Helpers::getdateFormat($data->evaluation_complete_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">
                                            QAH/CQAH Closure Comment</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_Comment)
                                                {{ $data->evalution_Closure_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Cancel By
                                        </th>
                                        <td class="w-30">
                                            @if ($data->cancelled_by)
                                                {{ $data->cancelled_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel On</th>
                                        <td class="w-30">
                                            @if ($data->cancelled_on)
                                                {{ $data->cancelled_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel comment</th>
                                        <td class="w-30">
                                            @if ($data->cancel_comment)
                                                {{ $data->cancel_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                    </tr>
    
                </table>
            </div>
        </div>

                {{-- <tr>
                    <th class="w-20">Investigation Tool</th>
                    <td class="w-80">
                        @if ($data->investigation_tool)
                            {{ $data->investigation_tool }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                {{-- <tr>
                    <th class="w-20">Root Cause</th>
                    <td class="w-80">
                        @if ($data->root_cause)
                            {{ $data->root_cause }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Impact / Risk Assessment</th>
                    <td class="w-80">
                        @if ($data->impact_risk_assessment)
                            {{ $data->impact_risk_assessment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA</th>
                    <td class="w-80">
                        @if ($data->capa)
                            {{ $data->capa }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Summary</th>
                    <td class="w-80">
                        @if ($data->investigation_summary_rca)
                            {{ $data->investigation_summary_rca }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>



            </table>
            
        </div>

      
       
       
        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QA/CQA Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qa_final_comments)
                        {{ $data->qa_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>

        </div>
        <div class="block">
            <div class="block-head">
                QAH/CQAH Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QAH/CQAH Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qah_final_comments)
                        {{ $data->qah_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div> 

        </div>--}}
       


        
    </div>
    </div>


</body>

</html>
