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
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Root Cause Analysis Report
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
                    <strong>Root Cause Analysis No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-80">
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
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>

                    
                    {{-- <tr>

                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-80">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> --}}
                    <tr>

                       

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->initiator_Group) }}
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
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30" colspan="3">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                      


                    </tr>

                    {{-- <tr><th class="w-20">Additional Investigators</th> <td class="w-30">@if ($data->investigators){{ $data->investigators }}@else Not Applicable @endif</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-30">
                            @if ($data->severity_level)
                                {{ $data->severity_level }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-80">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> --}}
                    <tr>{{-- <th class="w-20">Additional Investigators</th> <td class="w-30">@if ($data->investigators){{ $data->investigators }}@else Not Applicable @endif</td> --}}
                        <th class="w-20"> Name Of Responsible Department Head</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Reviewer</th>
                        <td class="w-80">
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
                        <td class="w-80">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                       

                       

                        {{-- <div class="inner-block">
                            <label
                                class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                                Others</label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->initiated_if_other)
                                    {{ $data->initiated_if_other }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div> --}}

                    </tr>
                        <tr>

                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->initiated_if_other)
                                    {{ $data->initiated_if_other }}
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

                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-30">
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

                </table>
                <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
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

            {{-- <div class="block">
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
                        
                    
                        <th class="w-20">Background</th>
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
                    
                        
                        <th class="w-20">Investigation Team</th>
                        <td class="w-80">
                            @if ($data->investigation_team)
                                {{($investigation_teamNamesString) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if ($data->root_cause_methodology)
                                {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->root_cause_Others)
                                {{ $data->root_cause_Others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  </table>

                  <div class="border-table">
                    <div class="block-head">
                     Attachment
                
                    </div>
                    <table>
                
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
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


            </div> --}}

               <div class="block">
            <div class="block-head">
                HOD Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    HOD Review Comment</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->hod_comments)
                        {{ $data->hod_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    HOD Review Attachments

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
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
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    Initial QA/CQA Review Comments
                </label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->cft_comments_new)
                        {{ $data->cft_comments_new }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    Initial QA/CQA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
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



        <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>
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
                
            
                <th class="w-20">Background</th>
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
            
                 {{-- @php
                     dd($data->investigation_teamNamesString);
                 @endphp --}}
                <th class="w-20">Investigation Team</th>
                <td class="w-80">
                    @if ($data->investigation_team)
                        {{($investigation_teamNamesString) }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>

            <tr>
                <th class="w-20">Root Cause Methodology</th>
                <td class="w-80">
                    @if ($data->root_cause_methodology)
                        {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
                    @else
                        Not Applicable
                    @endif
                </td>

                <th class="w-20">Others</th>
                <td class="w-80">
                    @if ($data->root_cause_Others)
                        {{ $data->root_cause_Others }}
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
<div class="border-table">
    <div class="block-head">
     Attachment

    </div>
    <table>

        <tr class="table_bg">
            <th class="w-20">S.N.</th>
            <th class="w-60">Batch No</th>
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
                HOD Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    HOD Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->hod_final_comments)
                        {{ $data->hod_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
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
    <div class="inner-block">
        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
            QA/CQA Final Review Comments

</label>
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
                <th class="w-20">S.N.</th>
                <th class="w-60">Batch No</th>
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
    
    <div class="inner-block">
        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
            QAH/CQAH/Designee Final Approval Comments

</label>
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
            QAH/CQAH/Designee Final Approval Attachments

        </div>
        <table>

            <tr class="table_bg">
                <th class="w-20">S.N.</th>
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
                            <th class="w-10">Row #</th>
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
                <style>
                    .table {
                        width: 100%;
                        font-size: 7px;
                        /* font-weight: 100!important; */
                    }
            
                    .th,
                    .td {
                        border: 1px solid black;
                        padding: 1px;
                        word-wrap: break-word;
                        text-align: center;
                        
                    }
            
                    /* Rotate table by flipping headers and rows */
                    .rotated-table {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        transform: rotate(-90deg);
                        transform-origin: left top 0;
                    }
            
                    .rotated-table table {
                        transform: rotate(90deg);
                        /* Rotate inner table content back to normal */
                    }
                </style>

                <div class="border-table  tbl-bottum">
                    <div class="block-head">
                        Failure Mode and Effect Analysis
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="table_bg tr">
                                <th class="th" style="font-size: 7px" rowspan="2">Row #</th>
                                <th class="th" style="font-size: 7px" colspan="2">Risk Identification</th>
                                <th class="th"  style="font-size: 7px" colspan="1">Risk Analysis</th>
                                <th class="th" style="font-size: 7px" colspan="4">Risk Evaluation</th>
                                <th class="th"  style="font-size: 7px"colspan="1">Risk Control</th>
                                <th class="th" style="font-size: 7px" colspan="6">Risk Evaluation</th>
                                <th class="th" style="font-size: 7px"></th>
                
                            </tr>
                            <tr class="table_bg tr">
                                <th  style="font-size: 7px" class="th">Activity</th>
                                <th style="font-size: 7px" class="th">Possible Risk/Failure (Identified Risk)</th>
                                <th style="font-size: 7px" class="th">Consequences of Risk/Potential Causes</th>
                                <th style="font-size: 7px" class="rotate th">Severity (S)</th>
                                <th style="font-size: 7px" class="rotate  th">Probability (P)</th>
                                <th style="font-size: 7px" class="rotate th">Detection (D)</th>
                                <th style="font-size: 7px" class="rotate th">RPN</th>
                                <th style="font-size: 7px" class="th">Control Measures recommended/ Risk mitigation proposed</th>
                                <th style="font-size: 7px" class="rotate th">Severity (S)</th>
                                <th style="font-size: 7px" class="rotate th">Probability (P)</th>
                                <th style="font-size: 7px" class="rotate th">Detection (D)</th>
                                <th style="font-size: 7px" class="rotate th">Risk Level (RPN)</th>
                                <th style="font-size: 7px">Category of Risk Level (Low, Medium, High)</th>
                                <th style="font-size: 7px">Risk Acceptance (Y/N)</th>
                                <th style="font-size: 7px">Traceability Document</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($data->risk_factor))
                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                <tr class="tr">
                                    <td style="font-size: 7px"  class="td">{{ $key + 1 }}</td>
                                    <td style="font-size: 7px" class="td">{{ $riskFactor }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->initial_severity)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->initial_probability)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->residual_severity)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->residual_probability)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                    <td style="font-size: 7px" class="td">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                    
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
                <table>
                     <tr>
                        <th class="w-20">Measurement</th>
                        {{-- <td class="w-80">@if ($riskgrdfishbone->measurement){{ $riskgrdfishbone->measurement }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $measurement = unserialize($data->measurement);
                            @endphp

                            @if (is_array($measurement))
                                @foreach ($measurement as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($measurement))
                                {{ htmlspecialchars($measurement) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Materials</th>
                        {{-- <td class="w-80">@if ($data->materials){{ $data->materials }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $materials = unserialize($data->materials);
                            @endphp

                            @if (is_array($materials))
                                @foreach ($materials as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($materials))
                                {{ htmlspecialchars($materials) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Methods</th>
                        {{-- <td class="w-80">@if ($data->methods){{ $data->methods }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $methods = unserialize($data->methods);
                            @endphp

                            @if (is_array($methods))
                                @foreach ($methods as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($methods))
                                {{ htmlspecialchars($methods) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Mother Environment</th>
                        {{-- <td class="w-80">@if ($data->environment){{ $data->environment }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $environment = unserialize($data->environment);
                            @endphp

                            @if (is_array($environment))
                                @foreach ($environment as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($environment))
                                {{ htmlspecialchars($environment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Man</th>
                        {{-- <td class="w-80">@if ($data->manpower){{ $data->manpower }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $manpower = unserialize($data->manpower);
                            @endphp

                            @if (is_array($manpower))
                                @foreach ($manpower as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($manpower))
                                {{ htmlspecialchars($manpower) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Machine</th>
                        {{-- <td class="w-80">@if ($data->machine){{ $data->machine }}@else Not Applicable @endif</td> --}}
                        <td class="w-80">
                            @php
                                $machine = unserialize($data->machine);
                            @endphp

                            @if (is_array($machine))
                                @foreach ($machine as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($machine))
                                {{ htmlspecialchars($machine) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Problem Statement</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->problem_statement)
                            {{ $data->problem_statement }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>

                <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Inference
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Row #</th>
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

                <div class="block-head mt-1">
                    Why-Why Chart
                </div>

                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Problem Statement</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->why_problem_statement)
                            {{ $data->why_problem_statement }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>


                <table>


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
                        <td class ="w-80">
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
                        <td class="w-80" colspan="3">
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
                </table>

                <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause :</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->why_root_cause)
                            {{ $data->why_root_cause }}
                        @else
                            Not Applicable
                        @endif
                    </span>
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
                                        <td class="w-80">
                                            @if ($data->acknowledge_comment)
                                                {{ $data->acknowledge_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                    {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">{{ $data->More_Info_hrc_by }}</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">{{ $data->More_Info_hrc_on }}</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">{{ $data->More_Info_hrc_comment }}</td>
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
                                        <td class="w-80">
                                            @if ($data->QAQQ_Review_Complete_comment)
                                                {{ $data->QAQQ_Review_Complete_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->More_Info_qac_by) {{ $data->More_Info_qac_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->More_Info_qac_on) {{ Helpers::getdateFormat($data->More_Info_qac_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->More_Info_qac_comment) {{ $data->More_Info_qac_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
                                    {{-- <tr>
                                            <th class="w-20">Sumitted Comment</th>
                                            <td class="w-80"> @if ($data->submitted_comment) {{ $data->submitted_comment }} @else Not Applicable @endif</td>
                                        </tr> --}}
                                    {{-- <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->More_Info_qac_comment) {{ $data->More_Info_qac_comment }} @else Not Applicable @endif</td> --}}
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
                                    <td class="w-80">
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
                                            <td class="w-30">{{ $data->More_Info_hrc_by }}</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">{{ $data->More_Info_hrc_on }}</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">{{ $data->More_Info_hrc_comment }}</td>
                                        </tr>
                                    --}}
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
                                            <td class="w-30">{{ $data->More_Info_sub_by }}</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">{{ $data->More_Info_sub_on }}</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">{{ $data->More_Info_sub_comment }}</td>
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
                                            <td class="w-30">{{ $data->More_Info_hfr_by }}</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">{{ $data->More_Info_hfr_on }}</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">{{ $data->More_Info_hfr_comment }}</td>
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
                                        <td class="w-80">
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
                                        <td class="w-80">
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
        {{-- <div class="block">
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
                    <th class="w-20">Background</th>
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
                            {{ Helpers::getInitiatorName($data->investigation_team) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
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
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
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
                        <th class="w-20">S.N.</th>
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

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
