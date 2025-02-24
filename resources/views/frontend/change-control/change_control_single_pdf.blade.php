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

    .allow-wb {
        word-break: break-all;
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Change Control Report
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
                    <strong>Change Control No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
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

                <tr>
                        <!-- <th class="w-20">Record Number</th>
                        <td class="w-30">@if($data->record){{  str_pad($data->record, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td> -->
                       
                       
                    <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/CC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{  Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                    </tr>




                    <tr> On {{ Helpers::getDateFormat($data->created_at) }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getDateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ $data->due_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiation Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->Initiator_Group) }}

                                
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Initiation Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Risk Assessment Required</th>
                        <td class="w-30">
                            @if ($data->risk_assessment_required)
                                {{ ucfirst($data->risk_assessment_required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>

                     <th class="w-20">Justification</th>
                    <td class="w-30">
                        @if ($data->risk_identification)
                            {{ $data->risk_identification }}
                        @else
                            Not Applicable
                        @endif
                    </td> 
                    </tr> -->
                    <tr>
                    <th class="w-20">Change Related To</th>
                    <td class="w-30">
                        @if ($data->severity)
                            {{ucfirst($data->severity) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

              <tr>
                <th class="w-20">Please specify</th>
                <td class="w-30">
                    @if ($data->Occurance)
                        {{ $data->Occurance }}
                    @else
                        Not Applicable
                    @endif
                </td>
            </tr>
                    <tr>
                        <th class="w-20">HOD Person</th>
                        <td class="w-30">
                            @if ($data->hod_person)
                                {{ Helpers::getInitiatorName($data->hod_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30" colspan="3">
                            @if ($data->initiated_through)
                                {{ucfirst($data->initiated_through) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">
                            @if ($data->initiated_through_req)
                                {{ $data->initiated_through_req }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{-- <th class="w-20">Repeat</th>
                        <td class="w-30" colspan="3">
                            @if ($data->repeat)
                                {{ucfirst($data->repeat) }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}
                    </tr>
                    <tr>
                        {{-- <th class="w-20">Repeat Nature</th>
                        <td class="w-30">
                            @if ($data->repeat_nature)
                                {{ $data->repeat_nature }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}

                        <!-- <th class="w-20">Division Code</th>
                       <td class="w-80">
                            @if (Helpers::getDivisionName(session()->get('division')))
                                {{ Helpers::getDivisionName($data->division_id) }}
                            @else
                                Not Applicable
                            @endif
                        </td> -->
                    </tr>

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
                    <tr>
                        <th class="w-20">Nature of Change</th>
                        <td class="w-30">
                            @if ($data->doc_change)
                                {{ $data->doc_change }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>    
                    <tr>
                        <th class="w-20">If Others</th>
                        <td class="w-30" colspan="3">
                            @if ($data->If_Others)
                                {{ $data->If_Others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Description of Change</th>
                        <td class="w-30" colspan="3">
                            @if ($data->bd_domestic)
                                {{ $data->bd_domestic }}
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
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->in_attachment)
                            @foreach (json_decode($data->in_attachment) as $key => $file)
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
                    Risk Assessment
                </div>
                <table>
                    <tr>
                        <th class="w-20">Related Records</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->risk_assessment_related_record }}
                                
                                
                            </div>
                        </td>
                    </tr>



                    <!-- <tr>
    <th class="w-20">Related Records</th>
    <td class="w-80" colspan="3">
        <div>
            @if(!empty($data->risk_assessment_related_record))
                @php
                    // Convert the comma-separated string to an array for easy comparison
                    $relatedRecordIds = explode(',', $data->risk_assessment_related_record);
                @endphp
                @foreach ($preRiskAssessment as $prix)
                    @if(in_array($prix->id, $relatedRecordIds))
                        <div>
                            {{ Helpers::getDivisionName($prix->division_id) }}/Risk-Assessment/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                        </div>
                    @endif
                @endforeach
            @else
                <p>No related records found.</p>
            @endif
        </div>
    </td>
</tr> -->
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->migration_action }}
                            </div>
                        </td>
                    </tr>

                    
                      {{--  <tr>
                        <th class="w-20">Severity</th>
                        <td class="w-30"> {{ $data->severity }}</td>

                        <th class="w-20">Occurance</th>
                        <td class="w-30"> {{ $data->Occurance }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Detection</th>
                        <td class="w-30"> {{ $data->Detection }}</td>

                        <th class="w-20">RPN</th>
                        <td class="w-30"> {{ $data->RPN }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Risk Evaluation</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->risk_evaluation }}
                            </div>
                        </td>
                    </tr>  
                    <tr>
                        <th class="w-20">Mitigation Action</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->migration_action }}
                            </div>
                        </td>
                    </tr>  --}}
                </table>
                <div class="border-table">
                    <div class="block-head">
                        Risk Assessment Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->risk_assessment_atch)
                            @foreach (json_decode($data->risk_assessment_atch) as $key => $file)
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
                    Change Details
                </div>
                <!-- <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-25">S.N.</th>
                            <th class="w-25">Current Document No.</th>
                            <th class="w-25">Current Version No.</th>
                            <th class="w-25">New Document No.</th>
                            <th class="w-25">New Version No.</th>
                        </tr>
                        @php
                            $serialNumber = 1;
                        @endphp
                       
                    </table>
                </div> -->
                <table>
                    <tr>
                        <th class="w-20">Current Practice</th>
                        <td>
                            <div>
                                @if ($docdetail->current_practice)
                                    {{ $docdetail->current_practice }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed Change</th>
                        <td>
                            <div>
                                @if ($docdetail->proposed_change)
                                    {{ $docdetail->proposed_change }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Reason For Change</th>
                        <td>
                            <div>
                                @if ($docdetail->reason_change)
                                    {{ $docdetail->reason_change }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Supervisor Comments</th>
                        <td>
                            <div>
                                @if ($docdetail->supervisor_comment)
{{ $docdetail->supervisor_comment }}
@else
Not Applicable
@endif
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <th class="w-20">Any Other Comments</th>
                        <td>
                            <div>
                                @if ($docdetail->other_comment)
                                    {{ $docdetail->other_comment }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Change control Attachment -->

                <div class="border-table">
                    <div class="block-head">
                    Change control Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->change_details_attachments)
                            @foreach (json_decode($data->change_details_attachments) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                       Initial HOD Review
                    </div>
                    <table>
                        {{--  <tr>
                            <th class="w-20">HOD Remark</th>
                            <td class="w-80">{{ $data->HOD_Remarks }}</td>
                        </tr>  --}}


                         <tr>
                            <th class="w-20">HOD Assessment Comments</th>
                            <td class="w-80">{{$cc_cfts->hod_assessment_comments}}</td>
                        </tr>  
                    </table>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Assessment Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->hod_assessment_attachment)
                                @foreach (json_decode($cc_cfts->hod_assessment_attachment) as $key => $file)
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
            </div>



            <div class="block">
                <div class="head">
                    <div class="block-head">
                        QA/CQA Review
                    </div>
                    <table>
                        {{--  <tr>
                            <th class="w-20">Due Days</th>
                            <td class="w-30">{{ $data->due_days }}</td>


                            <th class="w-20">Severity Level</th>
                            <td class="w-30">{{ $data->severity_level1 }}</td>
                        </tr>  --}}
                        <tr>
                            <!-- <th class="w-20">CFT Reviewer Person</th>
                      
                            <td class="w-80">@if($data->reviewer_person_value){{  $cft_teamNamesString }}@else Not Applicable @endif</td> -->

                            <th class="w-20">Classification of Change</th>
                            <td class="w-30">{{ ucfirst($data->severity_level1) }}</td>
                        </tr>

                       
                        <tr>
                            <th class="w-20">QA/CQA Initial Review Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $review->qa_comments }}
                                </div>
                            </td>
                        </tr>

                </table>
                  <table>
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

                <label class="head-number" for="Related Records">Related Records</label>
                <div class="div-data">
                    @if ($data->related_records)
                        {{ str_replace(',', ', ', $data->related_records) }}
                    @else
                        Not Applicable
                    @endif
                </div>


                        
                        <!-- <tr>
                            <th class="w-20">Related Records</th>
                            <td class="w-80">
                                {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($review->related_records, 4, '0', STR_PAD_LEFT) }}
                            </td>
                        </tr> -->
                    </table>

                       <br>
                    <div class="border-table">
                        <div class="block-head">
                        QA/CQA Initial Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->qa_head)
                                @foreach (json_decode($data->qa_head) as $key => $file)
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
            </div>











            <div class="block">
                <div class="head">
                    <div class="block-head">
                        CFT
                    </div>


                    <div class="head">
                       {{-- <div class="block-head">
                            RA Review
                        </div>
                        <table>
                              <tr>
                                <th class="w-20">RA Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RA_Review)
                                            {{ $cftData->RA_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">RA Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RA_person)
                                            {{ $cftData->RA_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By RA)</th>
                                <td class="w-80">
                                    <div>
                                        @if ($cftData->RA_assessment)
                                            {{ $cftData->RA_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <!-- <th class="w-20">RA Feedback</th>
                                <td class="w-80">
                                    <div>
                                        @if ($cftData->RA_feedback)
                                            {{ $cftData->RA_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td> -->
                            </tr>
                            <tr>
                                <th class="w-20">RA Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RA_by)
                                            {{ $cftData->RA_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">RA Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RA_on)
                                            {{ $cftData->RA_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>  
                        </table>
                    </div>--}}
                    {{--  <div class="border-table">
                         <div class="block-head">
                            RA Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->RA_attachment)
                                @foreach (json_decode($cftData->RA_attachment) as $key => $file)
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
                    </div>  --}}
                    <div class="head">
                        <div class="block-head">
                            Quality Assurance
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Quality Assurance Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Quality_Assurance_Review)
                                            {{ ucfirst($cftData->Quality_Assurance_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_person)
                                            {{ $cftData->QualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Quality Assurance)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->QualityAssurance_assessment)
                                            {{ $cftData->QualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Quality Assurance Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->QualityAssurance_feedback)
                                            {{ $cftData->QualityAssurance_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Quality Assurance Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_by)
                                            {{ $cftData->QualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_on)
                                            {{Helpers::getDateFormat( $cftData->QualityAssurance_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    
                    <div class="border-table">
                        <div class="block-head">
                            Quality Assurance Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Quality_Assurance_attachment)
                                @foreach (json_decode($cftData->Quality_Assurance_attachment) as $key => $file)
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
                    <div class="head">
                        <div class="block-head">
                            Production (Tablet/Capsule/Powder)
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Production Tablet/Capsule/Powder Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Review)
                                            {{ucfirst($cftData->Production_Table_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet/Capsule/Powder Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Person)
                                            {{ $cftData->Production_Table_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment(By Production (Tablet/Capsule/Powder))</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Assessment)
                                            {{ $cftData->Production_Table_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Production Tablet/Capsule/Powder Feedbacdk </th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Production_Table_Feedback)
                                            {{ $cftData->Production_Table_Feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Production Tablet/Capsule/Powder Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_By)
                                            {{ $cftData->Production_Table_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet/Capsule/Powder Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_On)
                                            {{Helpers::getDateFormat( $cftData->Production_Table_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                        Production Tablet/Capsule/Powder Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Production_Table_Attachment)
                                @foreach (json_decode($cftData->Production_Table_Attachment) as $key => $file)
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
                    <br>
                    <div class="head">
                        <div class="block-head">
                            Production (Liquid/Ointment)
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Production Liquid/Ointment Review Required?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_Review)
                                            {{ ucfirst($cftData->ProductionLiquid_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/Ointment Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_person)
                                            {{ $cftData->ProductionLiquid_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment(By Production Liquid/Ointment)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ProductionLiquid_assessment)
                                            {{ $cftData->ProductionLiquid_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Production Liquid/Ointment Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ProductionLiquid_feedback)
                                            {{ $cftData->ProductionLiquid_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Production Liquid/Ointment Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_by)
                                            {{ $cftData->ProductionLiquid_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/Ointment Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_on)
                                            {{ Helpers::getDateFormat( $cftData->ProductionLiquid_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                        Production Liquid/Ointment Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ProductionLiquid_attachment)
                                @foreach (json_decode($cftData->ProductionLiquid_attachment) as $key => $file)
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
                    <div class="head">
                        <div class="block-head">
                            Production Injection
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Production Injection Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_Review)
                                            {{ ucfirst($cftData->Production_Injection_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_Person)
                                            {{ $cftData->Production_Injection_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Production Injection)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Production_Injection_Assessment)
                                            {{ $cftData->Production_Injection_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Production Injection Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Production_Injection_Feedback)
                                            {{ $cftData->Production_Injection_Feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Production Injection Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_By)
                                            {{ $cftData->Production_Injection_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_On)
                                            {{Helpers::getDateFormat( $cftData->Production_Injection_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Production Injection Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Production_Injection_Attachment)
                                @foreach (json_decode($cftData->Production_Injection_Attachment) as $key => $file)
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
                    <br>
                    <div class="head">
                        <div class="block-head">
                            Stores
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Stores Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_Review)
                                            {{ucfirst($cftData->Store_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Store Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_person)
                                            {{ $cftData->Store_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Store)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Store_assessment)
                                            {{ $cftData->Store_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Stores Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Store_feedback)
                                            {{ $cftData->Store_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Store Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_by)
                                            {{ $cftData->Store_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Store Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_on)
                                            {{Helpers::getDateFormat( $cftData->Store_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Store Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Store_attachment)
                                @foreach (json_decode($cftData->Store_attachment) as $key => $file)
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
                    <br>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Quality Control
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Quality Control Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_review)
                                                {{ucfirst($cftData->Quality_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_Person)
                                                {{ $cftData->Quality_Control_Person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Quality Control)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Quality_Control_assessment)
                                                {{ $cftData->Quality_Control_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Quality Control Feedback</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Quality_Control_feedback)
                                                {{ $cftData->Quality_Control_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Quality Control Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->QualityAssurance__by)
                                                {{ $cftData->QualityAssurance__by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_on)
                                                {{Helpers::getDateFormat( $cftData->Quality_Control_on )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Quality Control Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Quality_Control_attachment)
                                    @foreach (json_decode($cftData->Quality_Control_attachment) as $key => $file)
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

                    <div class="head">
                        <div class="block-head">
                            Research & Development
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Research & Development Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_Review)
                                            {{ ucfirst($cftData->ResearchDevelopment_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research & Development Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_person)
                                            {{ $cftData->ResearchDevelopment_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Research & Development)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_assessment)
                                            {{ $cftData->ResearchDevelopment_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Research & Development Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_feedback)
                                            {{ $cftData->ResearchDevelopment_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Research & Development Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_by)
                                            {{ $cftData->ResearchDevelopment_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research & Development Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ResearchDevelopment_on)
                                            {{ Helpers::getDateFormat($cftData->ResearchDevelopment_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Research & Development Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ResearchDevelopment_attachment)
                                @foreach (json_decode($cftData->ResearchDevelopment_attachment) as $key => $file)
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
                    <br>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Engineering
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Engineering Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_review)
                                                {{ ucfirst($cftData->Engineering_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Engineering Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_person)
                                                {{ $cftData->Engineering_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Engineering)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Engineering_assessment)
                                                {{ $cftData->Engineering_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Engineering Feedback</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Engineering_feedback)
                                                {{ $cftData->Engineering_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Engineering Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_by)
                                                {{ $cftData->Engineering_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Engineering Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_on)
                                                {{ Helpers::getDateFormat($cftData->Engineering_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Engineering Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Engineering_attachment)
                                    @foreach (json_decode($cftData->Engineering_attachment) as $key => $file)
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
                        <div class="head">
                            <div class="block-head">
                                Human Resource
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Human Resource Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_review)
                                                {{ ucfirst($cftData->Human_Resource_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Human Resource Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_person)
                                                {{ $cftData->Human_Resource_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Human Resource)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Human_Resource_assessment)
                                                {{ $cftData->Human_Resource_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Human Resource Feedback</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Human_Resource_feedback)
                                                {{ $cftData->Human_Resource_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Human Resource Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_by)
                                                {{ $cftData->production_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Human Resource Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->production_on)
                                                {{Helpers::getDateFormat( $cftData->production_on )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Human Resource Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Initial_attachment)
                                    @foreach (json_decode($cftData->Initial_attachment) as $key => $file)
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


                    <div class="head">
                        <div class="block-head">
                            Microbiology
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Microbiology Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_Review)
                                            {{ ucfirst($cftData->Microbiology_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_person)
                                            {{ $cftData->Microbiology_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Microbiology)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Microbiology_assessment)
                                            {{ $cftData->Microbiology_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Microbiology Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->Microbiology_feedback)
                                            {{ $cftData->Microbiology_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Microbiology Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_by)
                                            {{ $cftData->Microbiology_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_on)
                                            {{Helpers::getDateFormat( $cftData->Microbiology_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Microbiology Attachment
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Microbiology_attachment)
                                @foreach (json_decode($cftData->Microbiology_attachment) as $key => $file)
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
                    <br>
                    <div class="head">
                        <div class="block-head">
                            Regulatory Affair
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Regulatory Affair Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_Review)
                                            {{ ucfirst($cftData->RegulatoryAffair_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affair Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_person)
                                            {{ $cftData->RegulatoryAffair_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Regulatory Affair)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_assessment)
                                            {{ $cftData->RegulatoryAffair_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Regulatory Affairs Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_feedback)
                                            {{ $cftData->RegulatoryAffair_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Regulatory Affair Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_by)
                                            {{ $cftData->RegulatoryAffair_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affair Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_on)
                                            {{ Helpers::getDateFormat($cftData->RegulatoryAffair_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Regulatory Affair Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->RegulatoryAffair_attachment)
                                @foreach (json_decode($cftData->RegulatoryAffair_attachment) as $key => $file)
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
                    <br>
                    <div class="head">
                        <div class="block-head">
                            Corporate Quality Assurance
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Corporate Quality Assurance Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_Review)
                                            {{ ucfirst($cftData->CorporateQualityAssurance_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_person)
                                            {{ $cftData->CorporateQualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Corporate Quality Assurance)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_assessment)
                                            {{ $cftData->CorporateQualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Corporate Quality Assurance Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_feedback)
                                            {{ $cftData->CorporateQualityAssurance_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Corporate Quality Assurance Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_by)
                                            {{ $cftData->CorporateQualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_on)
                                            {{Helpers::getDateFormat( $cftData->CorporateQualityAssurance_on )}}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Corporate Quality Assurance Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($cftData->CorporateQualityAssurance_attachment) as $key => $file)
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
                      <br>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Safety
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Safety Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Environment_Health_review)
                                                {{ucfirst($cftData->Environment_Health_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Safety Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Environment_Health_Safety_person)
                                                {{ $cftData->Environment_Health_Safety_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Safety)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Health_Safety_assessment)
                                                {{ $cftData->Health_Safety_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Safety Feedback</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Health_Safety_feedback)
                                                {{ $cftData->Health_Safety_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Safety Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->production_by)
                                                {{ $cftData->Human_Resource_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Safety Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_on)
                                                {{Helpers::getDateFormat( $cftData->Human_Resource_on )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Safety Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Human_Resource_attachment)
                                    @foreach (json_decode($cftData->Human_Resource_attachment) as $key => $file)
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
                        <div class="head">
                            <div class="block-head">
                                Information Technology

                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Information Technology Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_review)
                                                {{ ucfirst($cftData->Information_Technology_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Information Technology Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_person)
                                                {{ $cftData->Information_Technology_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Information Technology)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Information_Technology_assessment)
                                                {{ $cftData->Information_Technology_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Information Technology Feedback</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Information_Technology_feedback)
                                                {{ $cftData->Information_Technology_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Information Technology Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_by)
                                                {{ $cftData->Information_Technology_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Information Technology Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_on)
                                                {{Helpers::getDateFormat( $cftData->Information_Technology_on )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Information Technology Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Information_Technology_attachment)
                                    @foreach (json_decode($cftData->Information_Technology_attachment) as $key => $file)
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


                    <div class="head">
                        <div class="block-head">
                            Contract Giver
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Contract Giver Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_Review)
                                            {{ ucfirst($cftData->ContractGiver_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Contract Giver Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_person)
                                            {{ $cftData->ContractGiver_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Impact Assessment (By Contract Giver)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ContractGiver_assessment)
                                            {{ $cftData->ContractGiver_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>
                                <!-- <tr> 
                                <th class="w-20">Contract Giver Feedback</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($cftData->ContractGiver_feedback)
                                            {{ $cftData->ContractGiver_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <th class="w-20">Contract Giver Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_by)
                                            {{ $cftData->ContractGiver_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Contract Giver Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_on)
                                            {{  Helpers::getDateFormat($cftData->ContractGiver_on) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Contract Giver Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ContractGiver_attachment)
                                @foreach (json_decode($cftData->ContractGiver_attachment) as $key => $file)
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

                    <br>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 1 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 1 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_review)
                                                {{ ucfirst($cftData->Other1_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_person)
                                                {{ $cftData->Other1_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_Department_person)
                                                {{Helpers::getFullDepartmentName($cftData->Other1_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other1_assessment)
                                                {{ $cftData->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr>    
                                    <th class="w-20">Other's 1 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other1_feedback)
                                                {{ $cftData->Other1_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 1 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_by)
                                                {{ $cftData->Other1_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 1 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_on)
                                                {{Helpers::getDateFormat($cftData->Other1_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 1 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other1_attachment)
                                    @foreach (json_decode($cftData->Other1_attachment) as $key => $file)
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
                        <div class="head">
                            <div class="block-head">
                                Other's 2 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 2 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_review)
                                                {{ ucfirst($cftData->Other2_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_person)
                                                {{ $cftData->Other2_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_Department_person)
                                                {{ Helpers::getFullDepartmentName($cftData->Other2_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other2_Assessment)
                                                {{ $cftData->Other2_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Other's 2 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other2_feedback)
                                                {{ $cftData->Other2_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 2 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_by)
                                                {{ $cftData->Other2_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 2 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_on)
                                                {{Helpers::getDateFormat( $cftData->Other2_on )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 2 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other2_attachment)
                                    @foreach (json_decode($cftData->Other2_attachment) as $key => $file)
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
                        <div class="head">
                            <div class="block-head">
                                Other's 3 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 3 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_review)
                                                {{ ucfirst($cftData->Other3_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_person)
                                                {{ $cftData->Other3_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_Department_person)
                                                {{Helpers::getFullDepartmentName($cftData->Other3_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other3_Assessment)
                                                {{ $cftData->Other3_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    </tr>
                                    <!-- <tr> 

                                    <th class="w-20">Other's 3 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other3_feedback)
                                                {{ $cftData->Other3_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 3 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_by)
                                                {{ $cftData->Other3_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 3 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_on)
                                                {{Helpers::getDateFormat( $cftData->Other3_on ) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 3 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other3_attachment)
                                    @foreach (json_decode($cftData->Other3_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">4</td>
                                        <td class="w-20">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 4 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 4 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_review)
                                                {{ ucfirst($cftData->Other4_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_person)
                                                {{ $cftData->Other4_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_Department_person)
                                                {{Helpers::getFullDepartmentName( $cftData->Other4_Department_person )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 4)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other4_Assessment)
                                                {{ $cftData->Other4_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Other's 4 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other4_feedback)
                                                {{ $cftData->Other4_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 4 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_by)
                                                {{ $cftData->Other4_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 4 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_on)
                                                {{Helpers::getDateFormat( $cftData->Other4_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 4 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other4_attachment)
                                    @foreach (json_decode($cftData->Other4_attachment) as $key => $file)
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
                        <div class="head">
                            <div class="block-head">
                                Other's 5 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 5 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_review)
                                                {{ ucfirst($cftData->Other5_review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_person)
                                                {{ $cftData->Other5_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_Department_person)
                                                {{Helpers::getFullDepartmentName( $cftData->Other5_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other5_Assessment)
                                                {{ $cftData->Other5_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr> 
                                    <th class="w-20">Other's 5 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($cftData->Other5_feedback)
                                                {{ $cftData->Other5_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 5 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_by)
                                                {{ $cftData->Other5_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 5 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_on)
                                                {{ Helpers::getDateFormat($cftData->Other5_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 5 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other5_attachment)
                                    @foreach (json_decode($cftData->Other5_attachment) as $key => $file)
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
                </div>
            </div>


              <div class="block">
                <div class="head">
                    <div class="block-head">
                      QA/CQA Final Review
                    </div>
                      <table>
                              <tr>
                               
                                <th class="w-20">RA Approval required</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cc_cfts->RA_data_person)
                                            {{ $cc_cfts->RA_data_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                                 <th class="w-20">QA/CQA Head Approval Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cc_cfts->QA_CQA_person)
                                            {{ $cc_cfts->QA_CQA_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">QA/CQA Final Review Comments</th>
                                <td class="w-80">
                                    <div>
                                        @if ($cftData->qa_final_comments)
                                            {{ $cftData->qa_final_comments }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                
                            </tr>
                           
                        </table>
                    </div>


                   <div class="border-table">
                         <div class="block-head">
                           QA/CQA Final Review Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->qa_final_attach)
                                @foreach (json_decode($cftData->qa_final_attach) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                      RA
                    </div>
                      <table>
                              <tr>
                               
                                <th class="w-20">RA Approval Comment</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cc_cfts->ra_tab_comments)
                                            {{ $cc_cfts->ra_tab_comments }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                                
                            </tr>
                           
                           
                        </table>
                    </div>


                   <div class="border-table">
                         <div class="block-head">
                          RA Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->RA_attachment_second)
                                @foreach (json_decode($cc_cfts->RA_attachment_second) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                    QA/CQA Head / Designee Approval
                    </div>
                      <table>
                              <tr>
                               
                                <th class="w-20">QA/CQA Head / Designee Approval Comments</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cc_cfts->qa_cqa_comments)
                                            {{ $cc_cfts->qa_cqa_comments }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                                
                            </tr>
                           
                           
                        </table>
                    


                   <div class="border-table">
                         <div class="block-head">
                        QA/CQA Head / Designee Approval Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->qa_cqa_attach)
                                @foreach (json_decode($cc_cfts->qa_cqa_attach) as $key => $file)
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
             </div>


            

        <!-- <div class="block">
                <div class="head">
                    <div class="block-head">
                        Evaluation Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Evaluation Comments</th>
                            <td>
                                <div>
                                    {{ $evaluation->qa_eval_comments ?? 'Not Applicable' }}
                                </div>
                            </td>
                        </tr>
                       
                    </table>


                        <div class="border-table">
                         <div class="block-head">
                        QA Evaluation Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">QA Evaluation Attachments</th>
                            </tr>
                            @if ($evaluation->qa_eval_attach)
                                @foreach (json_decode($evaluation->qa_eval_attach) as $key => $file)
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
            </div> -->

            

             <!-- <div class="border-table"> -->
                
                            <div class="block-head">
                                Initiator Update
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Initiator Update Comments</th>
                                    <td>
                                        <div>
                                            {{ $cc_cfts->intial_update_comments ?? 'Not Applicable'}}
                                        </div>
                                    </td>
                                </tr>
                                

                            
                            </table>
                        

                <div class="border-table">
                    <div class="block-head">
                        Initiator Update Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Initiator Update Attachments</th>
                            </tr>
                            @if ($cc_cfts->intial_update_attach)
                                @foreach (json_decode($cc_cfts->intial_update_attach) as $key => $file)
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
        <!-- </div> -->





        <div class="block">
                <div class="head">
                            <div class="block-head">
                              HOD Final Review
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">HOD Final Review Comments</th>
                                    <td>
                                        <div>
                                            {{ $cc_cfts->hod_final_review_comment ?? 'Not Applicable'}}
                                        </div>
                                    </td>
                                </tr>
                                

                            
                            </table>
                        

                    <div class="border-table">
                    <div class="block-head">
                          HOD Final Review Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">HOD Final Review Attachments</th>
                            </tr>
                            @if ($cc_cfts->hod_final_review_attach)
                                @foreach (json_decode($cc_cfts->hod_final_review_attach) as $key => $file)
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
        </div>






        
        <div class="block">
                <div class="head">
                            <div class="block-head">
                             Implementation Verification by QA/CQA
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Implementation Verification by QA/CQA Comments</th>
                                    <td>
                                        <div>
                                            {{ $cc_cfts->implementation_verification_comments ?? 'Not Applicable'}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Training Feedback</th>
                                    <td>
                                        <div>
                                            {{$approcomments->feedback ?? 'Not Applicable'}}
                                        </div>
                                    </td>
                                </tr>
                                

                            
                            </table>
                        

                    <div class="border-table">
                        <div class="block-head">
                        Implementation Verification Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Implementation Verification Attachments</th>
                            </tr>
                            @if ($QaApprovalComments->tran_attach)
                                @foreach (json_decode($QaApprovalComments->tran_attach) as $key => $file)
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
        </div>




 
        <div class="block">
                <div class="head">
                            <div class="block-head">
                             Change Closure
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">QA/CQA Closure Comments</th>
                                    <td>
                                        <div>
                                            {{$closure->qa_closure_comments ?? 'Not Applicable'}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Effectiveness check required</th>
                                    <td>
                                        <div>
                                            {{  $cc_cfts->effect_check ?? 'Not Applicable' }}
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- <tr>
                                    <th class="w-20">Due Date Extension Justification</th>
                                    <td>
                                        <div>
                                            {{  $data->due_date_extension ?? 'Not Applicable' }}
                                        </div>
                                    </td>
                                </tr> -->
                                
                            
                            </table>
                        

                    <div class="border-table">
                         <div class="block-head">
                         List Of Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">List Of Attachments</th>
                            </tr>
                            @if ($closure->attach_list)
                                @foreach (json_decode($closure->attach_list) as $key => $file)
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
        </div>


            <!-- <div class="block">
                <div class="head">
                    <div class="block-head">
                      Comments
                    </div>
                    <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-30">{{ $info->cft_comments ?? 'Not Applicable' }}</td>
                        <th class="w-20">Attachment </th>
                        <td class="w-30">{{ $info->cft_attachment ?? 'Not Applicable'}}</td>
                    </tr>
                        <tr>
                            <th class="w-20">QA Comments</th>
                            <td class="w-80">
                                <div> @if ($comments->qa_comments)
                                {{ $comments->qa_comments }}
                                @else
                                Not Applicable
                                @endif </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Head Designee Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->designee_comments ?? 'Not Applicable' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Warehouse Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Warehouse_comments ?? 'Not Applicable'}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Engineering Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Engineering_comments ?? 'Not Applicable' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Instrumentation Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Instrumentation_comments ?? 'Not Applicable' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Validation Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Validation_comments ?? 'Not Applicable'}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Others Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Others_comments ?? 'Not Applicable' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Group_comments ?? 'Not Applicable'}}
                                </div>
                            </td>
                        </tr>


                    </table>
                    <div class="border-table">
                        <div class="block-head">
                           Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($comments->group_attachments)
                                @foreach (json_decode($comments->group_attachments) as $key => $file)
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
            </div> -->


{{--  
            <div class="block">
                <div class="block-head">
                    QA Approval Comments
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Approval Comments</th>
                        <td class="w-80">
                            <div>
                                {{ $approcomments->risk_identification }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Training Feedback</th>
                        <td class="w-80">
                            <div>
                                {{ $approcomments->feedback }}
                            </div>
                        </td>
                    </tr>

                </table>
                <div class="border-table">
                    <div class="block-head">
                    Implementation Verification Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($approcomments->tran_attach)
                            @foreach (json_decode($approcomments->tran_attach) as $key => $file)
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
                    Change Closure
                </div>

                <div class="border-table" style="margin-bottom: 15px;">
                    <div class="block-" style="margin-bottom:5px; font-weight:bold;">
                        Affected Documents
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Affected Documents</th>
                            <th class="w-60">Document Name</th>
                            <th class="w-60">Document No.</th>
                            <th class="w-60">Version No.</th>
                            <th class="w-60">Implementation Date</th>
                            <th class="w-60">New Document No.</th>
                            <th class="w-60">New Version No.</th>

                        </tr>
                        <tbody>
                            @if (isset($affectedDoc) && is_array($affectedDoc))
                            @php
                                $serialNumber = 1;
                            @endphp
                            @foreach ($affectedDoc as $testing)
                                @if(is_array($testing))
                                    <tr>
                                        <td class="w-20">{{ $serialNumber++ }}</td>
                                        <td class="w-20">{{ $testing['afftectedDoc'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['documentName'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['documentNumber'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['versionNumber'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['implimentationDate'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['newDocumentNumber'] ?? '' }}</td>
                                        <td class="w-20">{{ $testing['newVersionNumber'] ?? '' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="w-20" colspan="8"></td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                                <td class="w-20">Not Applicable</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>

                <table>
                    <tr>
                        <th class="w-20">QA Closure Comments</th>
                        <td class="w-30"> {{ $assessment->qa_closure_comments }}</td>

                        <th class="w-20">List Of Attachments</th>
                        <td class="w-30"> {{ $assessment->list_of_attachment }}</td>
                    </tr>
                </table>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($approcomments->tran_attach)
                        @foreach (json_decode($approcomments->tran_attach) as $key => $file)
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
        </div>  --}}



        <div class="block">
            <div class="block-head">
                Activity Log
            </div>
            <table>
                <tr>
                    <th class="w-20">Submit By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->submit_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">Submit On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->submit_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">Submit Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->submit_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>

                <tr>
                    <th class="w-20">HOD Assessment Complete By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->hod_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">HOD Assessment Complete On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->hod_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">HOD Assessment Complete Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->hod_review_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>


                <tr>
                    <th class="w-20">Cancel By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->cancelled_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">Cancel On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->cancelled_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">Cancel Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->cancelled_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>




                <tr>
                    <th class="w-20">QA/CQA Initial Assessment Complete By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_initial_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">QA/CQA Initial Assessment Complete On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_initial_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">QA/CQA Initial Assessment Complete Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_initial_review_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>

                <tr>
                    <th class="w-20">CFT Assessment Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->pending_RA_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">CFT Assessment Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->pending_RA_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">CFT Assessment Complete Comment </th>
                    <td class="w-30">
                        <div class="static">{{ $data->pending_RA_review_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>


                <tr>
                    <th class="w-20">RA Approval Required By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_required_by  ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">RA Approval Required On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_required_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">RA Approval Required Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_required_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>

                

                <tr>
                    <th class="w-20">RA Approval Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_completed_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">RA Approval Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_completed_on ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20"> RA Approval Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_completed_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>

                <tr>
                    <th class="w-20"> QA/CQA Final Review Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_final_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20"> QA/CQA Final Review Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_final_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">QA/CQA Final Review Complete Comment </th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_final_review_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>

               

                <tr>
                    <th class="w-20">Approved  By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->approved_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Approved  On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->approved_on ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Approved Comment </th>
                    <td class="w-30">
                        <div class="static">{{ $data->approved_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>



                <tr>
                    <th class="w-20">Rejected   By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->Training_complete_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Rejected   On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->Training_complete_on ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Rejected  Comment </th>
                    <td class="w-30">
                        <div class="static">{{ $data->Training_complete_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>




                <tr>
    <th class="w-20">Initiator Updated Completed By</th>
    <td class="w-30">
        <div class="static">
            {{ isset($commnetData) ? $commnetData->initiator_update_complete_by : 'Not Applicable' }}
        </div>
    </td>

    <th class="w-20">Initiator Updated Completed On</th>
    <td class="w-30">
        <div class="static">
            {{ isset($commnetData) ? $commnetData->initiator_update_complete_on : 'Not Applicable' }}
        </div>
    </td>

    <th class="w-20">Initiator Updated Completed Comment </th>
    <td class="w-30">
        <div class="static">
            {{ isset($commnetData) ? $commnetData->initiator_update_complete_comment : 'Not Applicable' }}
        </div>
    </td>
</tr>



                 <tr>
                    <th class="w-20">HOD Final Review Complete  By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_by  ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20"> HOD Final Review Complete  On  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_on ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">HOD Final Review Complete Comment </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>

                <tr>
                    <th class="w-20">Send For Final QA/CQA Head Approval By</th>
                    <td class="w-30">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval ?? 'Not Applicable' }}</div>
                    </td>

                    <th class="w-20">Send For Final QA/CQA Head Approval On</th>
                    <td class="w-30">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval_on ?? 'Not Applicable' }}</div>
                    </td>

                    <th class="w-20">Send For Final QA/CQA Head Approval Comment</th>
                    <td class="w-30">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>

                    <tr>
                    <th class="w-20">Closure Approved By : </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Closure Approved On : </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_on ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Closure Approved Comment :</th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_comment ?? 'Not Applicable' }}</div>
                    </td>
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

            </tr>
        </table>
    </footer>

</body>

</html>
