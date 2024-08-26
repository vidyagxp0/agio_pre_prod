<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
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
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                   CAPA Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt=""
                            class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>CAPA No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/CAPA/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}            
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <div style="max-width: 700px!important; overflow: hidden;">
                    <table>
                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                            <th class="w-20">Date Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->division_code)
                                    {{ $data->division_code }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Severity Level</th>
                            <td class="w-30">
                                @if ($data->severity_level)
                                    {{ $data->severity_level }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                        <tr>



                        </tr>
                       
                        <tr>
                            
                            <th class="w-20">Initiator Department</th>
                            <td class="w-30">@if($data->initiator_Group){{ Helpers::getInitiatorGroupFullName($data->initiator_Group) }} @else Not Applicable @endif</td>
                            <th class="w-20">Initiator Department Code</th>
                            <td class="w-30">
                                @if ($data->initiator_Group)
                                    {{ $data->initiator_Group }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                           
                        </tr>
                         <tr>
                            <th class="w-20">Short Description</th>
                            <td class="w-30" >
                                @if ($data->short_description)
                                    {{ $data->short_description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Assigned To</th>
                            <td class="w-30">
                                @if ($data->assign_to)
                                    {{ Helpers::getInitiatorName($data->assign_to) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                         </tr>

                        <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-30" >
                                @if ($data->due_date)
                                    {{ \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Others</th>
                            <td class="w-30">
                                @if ($data->initiated_if_other)
                                    {{ $data->initiated_if_other }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                        
                        <tr>
                            <th class="w-20">Priority Level</th>
                            <td class="w-30">
                                @if ($data->priority_level)
                                    {{ $data->priority_level }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Department(s)</th>
                            <td class="w-30">
                                @if ($data->department)
                                    {{ $data->department }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                                           
                              <tr>
                            <th class="w-20">Description</th>
                            <td class="w-30">
                                @if ($data->description)
                                    {{ $data->description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Comments</th>
                            <td class="w-30">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        
                        <tr>
                            <th class="w-20">Initiated Through
                            </th>
                            <td class="w-30">
                                @if ($data->initiated_through)
                                    {{ $data->initiated_through }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Related URL</th>
                            <td class="w-30">
                                @if ($data->related_url)
                                    {{ $data->related_url }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            
                        </tr>

                    </table>
                </div>

                <div class="border-table">
                    <div class="block-head">
                        File Attachment, if any
                    </div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">File </th>
                            </tr>
                                @if($data->capa_attachment)
                                @foreach(json_decode($data->capa_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                </table>
            </div>

          
            {{-- <div class="block">
                <div class="block-head">
                   Product Material Details
                </div>
                <table>
                    <tr>
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if ($data->root_cause_methodology)
                                {{ $data->root_cause_methodology }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Root Cause Description</th>
                        <td class="w-80">
                            @if ($data->root_cause_description_rca)
                                {{ $data->root_cause_description_rca }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Investigation Summary</th>
                        <td class="w-80">
                            @if ($data->investigation_summary)
                                {{ $data->investigation_summary }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                </table>
                <div class="block-head">
                    Equipment/Instruments Details
                </div>
                <div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-25">SR no.</th>
                            <th class="w-25">Equipment/Instruments Name</th>
                            <th class="w-25">Equipment/Instruments ID</th>
                            <th class="w-25">Equipment/Instruments Comments</th>
                        </tr>
                        @if($data->Instruments_Details->equipment)
                        @foreach (unserialize($data->Instruments_Details->equipment) as $key => $dataDemo)
                        <tr>
                            <td class="w-15">{{ $dataDemo ? $key +1  : "Not Applicable" }}</td>

                            <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                            <td class="w-15">{{unserialize($data->Instruments_Details->equipment_instruments)[$key] ?  unserialize($data->Instruments_Details->equipment_instruments)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Instruments_Details->equipment_comments)[$key] ?  unserialize($data->Instruments_Details->equipment_comments)[$key] : "Not Applicable" }}</td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>

                        @endif
                    </table>
                </div>
            </div> --}}
                    
            <div class="block">
                <div class="block-head">
                   HOD Review
                </div>
                <div>
                   <table>
                    <tr>  
                        <th class="w-20">HOD Remark</th>
                        <td class="w-80">@if($data->hod_remarks){{ $data->hod_remarks }}@else Not Applicable @endif</td>
                    </tr>
                </table>

                <div class="block-head">
                    Why-Why Chart
                </div>
                <table>
                    - <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($data->why_problem_statement)
                                {{ $data->why_problem_statement }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Why 1 </th>
                        {{-- <td class="w-80">@if ($data->why_1){{ $data->why_1 }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $why_1 = unserialize($data->why_1);
                            @endphp

                            @if (is_array($why_1))
                                @foreach ($why_1 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_1))
                                {{ htmlspecialchars($why_1) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why 2</th>
                        {{-- <td class="w-80">@if ($data->why_2){{ $data->why_2 }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $why_2 = unserialize($data->why_2);
                            @endphp

                            @if (is_array($why_2))
                                @foreach ($why_2 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_2))
                                {{ htmlspecialchars($why_2) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Why 3</th>
                        {{-- <td class="w-80">@if ($data->why_3){{ $data->why_3 }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $why_3 = unserialize($data->why_3);
                            @endphp

                            @if (is_array($why_3))
                                @foreach ($why_3 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_3))
                                {{ htmlspecialchars($why_3) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why 4</th>
                        {{-- <td class="w-80">@if ($data->why_4){{ $data->why_4 }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $why_4 = unserialize($data->why_4);
                            @endphp

                            @if (is_array($why_4))
                                @foreach ($why_4 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_4))
                                {{ htmlspecialchars($why_4) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Why5</th>
                        {{-- <td class="w-80">@if ($data->why_4){{ $data->why_4 }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $why_5 = unserialize($data->why_5);
                            @endphp

                            @if (is_array($why_5))
                                @foreach ($why_5 as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($why_5))
                                {{ htmlspecialchars($why_5) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Root Cause : </th>
                        <td class="w-80">
                            @if ($data->why_root_cause)
                                {{ $data->why_root_cause }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <div class="block-head">
                    Is/Is Not Analysis
                </div>
                <div style="max-width: 700px!important; overflow: hidden;">
                    <table>
                        <tr>
                            <th class="20">What Will Be</th>
                            <td class="80">
                                @if ($data->what_will_be)
                                    {{ $data->what_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="20">What Will Not Be </th>
                            <td class="80">
                                @if ($data->what_will_not_be)
                                    {{ $data->what_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="20">What Will Rationale </th>
                            <td class="80">
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
                        </tr>
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
                            <th class="w-20">Coverage Will Be</th>
                            <td class="w-80">
                                @if ($data->coverage_will_be)
                                    {{ $data->coverage_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>

                            <th class="w-20">Coverage Will Not Be </th>
                            <td class="w-80">
                                @if ($data->coverage_will_not_be)
                                    {{ $data->coverage_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Coverage Will Rationale </th>
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
                <div class="block">
                    <div class="block-head">
                        Investigation
                    </div>

                    <table>


                        <tr>
                            <th class="w-20">Objective</th>
                            <td class="w-80">
                                @if ($data->objective)
                                    {{ $data->objective }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Scope</th>
                            <td class="w-80">
                                @if ($data->scope)
                                    {{ $data->scope }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Problem Statement</th>
                            <td class="w-80">
                                @if ($data->problem_statement_rca)
                                    {{ $data->problem_statement_rca }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Requirement</th>
                            <td class="w-80">
                                @if ($data->requirement)
                                    {{ $data->requirement }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Immediate Action</th>
                            <td class="w-80">
                                @if ($data->immediate_action)
                                    {{ $data->immediate_action }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Investigation Team</th>
                            <td class="w-80">
                                @if ($data->investigation_team)
                                    {{ $data->investigation_team }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Investigation Tool</th>
                            <td class="w-80">
                                @if ($data->investigation_tool)
                                    {{ $data->investigation_tool }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
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
                            <th class="w-20">CAPA</th>
                            <td class="w-80">
                                @if ($data->investigation_summary_rca)
                                    {{ $data->investigation_summary_rca }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                </div>
                <div class="block">
                    <div class="block-head">
                       CAPA Closure
                    </div>
                  <tr>
                      
                    <th class="w-20">
                        QA Review & Closure
                       </th>
                     <td class="w-80">
                        @if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif      </td>     
                  </tr>
                    
               
                   <tr>
                    <th class="w-20">Due Date Extension Justification</th>
                    <td class="w-80">@if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif</td>
                   </tr>
                </table>
            </div>
           
                    
                    {{-- <tr>
                        <th class="w-20">Closure Attachment</th>
                        <td class="w-80">@if($data->closure_attachment)<a href="{{asset('upload/document/',$data->closure_attachment)}}">{{ $data->closure_attachment }}</a>@else Not Applicable @endif</td>

                    </tr> --}}

                <div class="block-head">
                    Closure Attachment
                 </div>
                   <div class="border-table">
                     <table>
                         <tr class="table_bg">
                             <th class="w-20">S.N.</th>
                             <th class="w-60">File </th>
                         </tr>
                             @if($data->closure_attachment)
                             @foreach(json_decode($data->closure_attachment) as $key => $file)
                                 <tr>
                                     <td class="w-20">{{ $key + 1 }}</td>
                                     <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
        
                    </div>
                    </div>


            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-30">Plan Proposed By
                        </th>
                        <td class="w-40">{{ $data->plan_proposed_by }}</td>
                        <th class="w-20">
                            Plan Proposed On</th>
                        <td class="w-30">{{ $data->plan_proposed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review Completed By
                        </th>
                        <td class="w-30">{{ $data->hod_review_completed_by }}</td>
                        <th class="w-20">
                            HOD Review Completed On</th>
                        <td class="w-30">{{ $data->hod_review_completed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->hod_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20"> More Info Required By
                        </th>
                        <td class="w-30">{{ $data->more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->hod_comment1 }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By
                        </th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">
                            Cancelled On</th>
                        <td class="w-30">{{ $data->cancelled_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->cancel_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20"> QA Review Completed By
                        </th>
                        <td class="w-30">{{ $data->qa_review_completed_by }}</td>
                        <th class="w-20">
                            QA Review Completed On</th>
                        <td class="w-30">{{ $data->qa_review_completed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->qa_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->qa_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->qa_more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->qa_commenta }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->approved_by }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ $data->approved_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->approved_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->app_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->app_more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->app_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Completed By</th>
                        <td class="w-30">{{ $data->completed_by }}</td>
                        <th class="w-20">Completed On</th>
                        <td class="w-30">{{ $data->completed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->com_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->com_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->com_more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->com_comment1 }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Final Review Completed By</th>
                        <td class="w-30">{{ $data->hod_final_review_completed_by }}</td>
                        <th class="w-20">HOD Final Review Completed On</th>
                        <td class="w-30">{{ $data->hod_final_review_completed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->final_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->hod_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->hod_more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->hod_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Closure Review Completed By</th>
                        <td class="w-30">{{ $data->qa_closure_review_completed_by }}</td>
                        <th class="w-20">QA Closure Review Completed On</th>
                        <td class="w-30">{{ $data->qa_closure_review_completed_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->qa_closure_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->closure_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->closure_more_info_required_on }}</td>
                        <th class="w-20">
                            closurement</th>
                        <td class="w-30">{{ $data->closure_qa_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QAH Approval Completed By</th>
                        <td class="w-30">{{ $data->qah_approval_completed_by }}</td>
                        <th class="w-20">QAH Approval Completed On</th>
                        <td class="w-30">{{ $data->qah_comment }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->final_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->qah_more_info_required_by }}</td>
                        <th class="w-20">
                             More Info Required On</th>
                        <td class="w-30">{{ $data->qah_more_info_required_on }}</td>
                        <th class="w-20">
                            Comment</th>
                        <td class="w-30">{{ $data->qah_comment1 }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

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

</body>

</html>
