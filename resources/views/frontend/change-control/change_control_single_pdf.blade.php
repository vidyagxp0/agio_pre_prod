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
                    Change Control Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
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
                    <tr>  On {{ Helpers:: getDateFormat($data->created_at) }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">{{ Helpers:: getDateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>

                        <th class="w-20">Initiaton Department</th>
                        <td class="w-30">
                            @if($data->Initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->Initiator_Group) }}
                            @else 
                                Not Applicable 
                            @endif
                        </td>                        
                    </tr>

                    <tr>
                        <th class="w-20">Initiation Department Code</th>
                        <td class="w-30"> @if($data->initiator_group_code){{ $data-> initiator_group_code}} @else Not Applicable @endif</td>

                        <th class="w-20">Risk Assessment Required</th>
                        <td class="w-30">@if($data->risk_assessment_required) {{ $data->risk_assessment_required }} @else Not Applicable @endif</td>
                    </tr>
    
                    <tr>
                        <th class="w-20">HOD Person</th>
                        <td class="w-30">@if($data->hod_person){{ Helpers::getInitiatorName($data->hod_person)}} @else Not Applicable @endif</td>

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30" colspan="3"> @if($data->initiated_through){{ $data->initiated_through }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }} @else Not Applicable @endif</td>

                        <th class="w-20">Repeat</th>
                        <td class="w-30" colspan="3"> @if($data->repeat){{ $data-> repeat}} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-30">@if($data->repeat_nature){{ $data-> repeat_nature}} @else Not Applicable @endif</td>

                        <th class="w-20">Division Code</th>
                        <td class="w-30" colspan="3"> @if($data->Division_Code){{ $data->Division_Code }} @else Not Applicable @endif</td>
                    </tr>
                    
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Nature of Change</th>
                        <td class="w-30">@if($data->doc_change){{ $data->doc_change }}@else Not Applicable @endif</td>

                        <th class="w-20">If Others</th>
                        <td class="w-30">@if($data->If_Others){{ $data->If_Others }}@else Not Applicable @endif</td>
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
                        @if($data->in_attachment)
                            @foreach(json_decode($data->in_attachment) as $key => $file)
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

            <div class="block">
                <div class="block-head">
                    Risk Assessment
                </div>
                <table>
                    <tr>
                        <th class="w-20">Risk Identification</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->risk_identification }}
                            </div>
                        </td>
                    </tr>

                    <tr>
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
                    </tr>
                </table>
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
                                @if($docdetail->current_practice){{ $docdetail->current_practice }}@else Not Applicable @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed Change</th>
                        <td>
                            <div>
                                @if($docdetail->proposed_change){{ $docdetail->proposed_change }}@else Not Applicable @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Reason For Change</th>
                        <td>
                            <div>
                                @if($docdetail->reason_change){{ $docdetail->reason_change }}@else Not Applicable @endif
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Supervisor Comments</th>
                        <td>
                            <div>
                                @if($docdetail->supervisor_comment){{ $docdetail->supervisor_comment }}@else Not Applicable @endif
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <th class="w-20">Any Other Comments</th>
                        <td>
                            <div>
                                @if($docdetail->other_comment){{ $docdetail->other_comment }}@else Not Applicable @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="block">
                <div class="head">
                    <div class="block-head">
                        HOD Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">HOD Remark</th>
                            <td class="w-80">{{ $data->HOD_Remarks }}</td>
                        </tr>
                    </table>                    
                    <div class="border-table">
                        <div class="block-head">
                            HOD Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if($data->HOD_attachment)
                                @foreach(json_decode($data->HOD_attachment) as $key => $file)
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



            <div class="block">
                <div class="head">
                    <div class="block-head">
                        QA Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Due Date Days</th>
                            <td class="w-30">{{ $data->due_days }}</td>


                            <th class="w-20">Severity Level</th>
                            <td class="w-30">{{ $data->severity_level1 }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Review Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $review->qa_comments }}
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th class="w-20">Related Records</th>
                            <td class="w-80">{{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($review->related_records, 4, '0', STR_PAD_LEFT) }}</td> 
                        </tr>
                    </table>
                    <div class="border-table">
                        <div class="block-head">
                            QA Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if($review->qa_head)
                                @foreach(json_decode($review->qa_head) as $key => $file)
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











            <div class="block">
                <div class="head">
                    <div class="block-head">
                        CFT
                    </div>


                    <div class="head">
                        <div class="block-head">
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
                                <th class="w-20">RA Feedback</th>
                                <td class="w-80">
                                    <div>
                                        @if ($cftData->RA_feedback)
                                            {{ $cftData->RA_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
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
                    </div>
                    <div class="border-table">
                        <div class="block-">
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
                    </div>



                    <div class="head">
                        <div class="block-head">
                            Quality Assurance
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Quality Assurance Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Quality_Assurance_Review)
                                            {{ $cftData->Quality_Assurance_Review }}
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
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_assessment)
                                            {{ $cftData->QualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_feedback)
                                            {{ $cftData->QualityAssurance_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Quality Assurance Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_by)
                                            {{ $cftData->QualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->QualityAssurance_on)
                                            {{ $cftData->QualityAssurance_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
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
                                <th class="w-20">Production Tablet Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Review)
                                            {{ $cftData->Production_Table_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet Person</th>
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
                                <th class="w-20">Impact Assessment (By Production Tablet)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Assessment)
                                            {{ $cftData->Production_Table_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_Feedback)
                                            {{ $cftData->Production_Table_Feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Production Tablet Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_By)
                                            {{ $cftData->Production_Table_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Table_On)
                                            {{ $cftData->Production_Table_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
                            Production Tablet Attachments
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



                    <div class="head">
                        <div class="block-head">
                            Production (Liquid/Ointment)
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Production Liquid Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_Review)
                                            {{ $cftData->ProductionLiquid_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid Person</th>
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
                                <th class="w-20">Impact Assessment (By Production Liquid)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_assessment)
                                            {{ $cftData->ProductionLiquid_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_feedback)
                                            {{ $cftData->ProductionLiquid_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Production Liquid Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_by)
                                            {{ $cftData->ProductionLiquid_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ProductionLiquid_on)
                                            {{ $cftData->ProductionLiquid_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
                            Production Liquid Attachments
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
                                <th class="w-20">Production Injection Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_Review)
                                            {{ $cftData->Production_Injection_Review }}
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
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_Assessment)
                                            {{ $cftData->Production_Injection_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_Feedback)
                                            {{ $cftData->Production_Injection_Feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Production Injection Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_By)
                                            {{ $cftData->Production_Injection_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Production_Injection_On)
                                            {{ $cftData->Production_Injection_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
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


                    <div class="head">
                        <div class="block-head">
                            Stores
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Stores Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_Review)
                                            {{ $cftData->Store_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores Person</th>
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
                                <th class="w-20">Impact Assessment (By Stores)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_assessment)
                                            {{ $cftData->Store_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_feedback)
                                            {{ $cftData->Store_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Stores Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_by)
                                            {{ $cftData->Store_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Store_on)
                                            {{ $cftData->Store_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
                            Stores Attachments
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
                                                {{ $cftData->Quality_review }}
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
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_assessment)
                                                {{ $cftData->Quality_Control_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_feedback)
                                                {{ $cftData->Quality_Control_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <th class="w-20">Quality Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->QualityAssurance__by)
                                                {{ $cftData->QualityAssurance__by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_on)
                                                {{ $cftData->Quality_Control_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                            <th class="w-20">Research & Development Required ?
                            </th>
                            <td class="w-30">
                                <div>
                                    @if ($cftData->ResearchDevelopment_Review)
                                        {{ $cftData->ResearchDevelopment_Review }}
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
                            <td class="w-30">
                                <div>
                                    @if ($cftData->ResearchDevelopment_assessment)
                                        {{ $cftData->ResearchDevelopment_assessment }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Research & Development Feedback</th>
                            <td class="w-30">
                                <div>
                                    @if ($cftData->ResearchDevelopment_feedback)
                                        {{ $cftData->ResearchDevelopment_feedback }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Research & Development Completed By</th>
                            <td class="w-30">
                                <div>
                                    @if ($cftData->ResearchDevelopment_by)
                                        {{ $cftData->ResearchDevelopment_by }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Research & Development Completed On</th>
                            <td class="w-30">
                                <div>
                                    @if ($cftData->ResearchDevelopment_on)
                                        {{ $cftData->ResearchDevelopment_on }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="border-table">
                    <div class="block-">
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
                                                {{ $cftData->Engineering_review }}
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
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_assessment)
                                                {{ $cftData->Engineering_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Engineering Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Engineering_feedback)
                                                {{ $cftData->Engineering_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Engineering_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Human_Resource_review }}
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
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_assessment)
                                                {{ $cftData->Human_Resource_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Human Resource Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_feedback)
                                                {{ $cftData->Human_Resource_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->production_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
                                Human Resource Attachments
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
                                <th class="w-20">Microbiology Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_Review)
                                            {{ $cftData->Microbiology_Review }}
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
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_assessment)
                                            {{ $cftData->Microbiology_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_feedback)
                                            {{ $cftData->Microbiology_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Microbiology Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_by)
                                            {{ $cftData->Microbiology_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->Microbiology_on)
                                            {{ $cftData->Microbiology_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
                            Microbiology Attachments
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



                    <div class="head">
                        <div class="block-head">
                            Regulatory Affairs
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Regulatory Affairs Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_Review)
                                            {{ $cftData->RegulatoryAffair_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affairs Person</th>
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
                                <th class="w-20">Impact Assessment (By Regulatory Affairs)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_assessment)
                                            {{ $cftData->RegulatoryAffair_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affairs Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_feedback)
                                            {{ $cftData->RegulatoryAffair_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Regulatory Affairs Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_by)
                                            {{ $cftData->RegulatoryAffair_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affairs Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->RegulatoryAffair_on)
                                            {{ $cftData->RegulatoryAffair_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
                            Regulatory Affairs Attachments
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



                    <div class="head">
                        <div class="block-head">
                            Corporate Quality Assurance
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Corporate Quality Assurance Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_Review)
                                            {{ $cftData->CorporateQualityAssurance_Review }}
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
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_assessment)
                                            {{ $cftData->CorporateQualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_feedback)
                                            {{ $cftData->CorporateQualityAssurance_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Corporate Quality Assurance Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_by)
                                            {{ $cftData->CorporateQualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->CorporateQualityAssurance_on)
                                            {{ $cftData->CorporateQualityAssurance_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
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
                                                {{ $cftData->Environment_Health_review }}
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
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Health_Safety_assessment)
                                                {{ $cftData->Health_Safety_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Safety Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Health_Safety_feedback)
                                                {{ $cftData->Health_Safety_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Human_Resource_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Information_Technology_review }}
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
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_assessment)
                                                {{ $cftData->Information_Technology_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Information Technology Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Information_Technology_feedback)
                                                {{ $cftData->Information_Technology_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Information_Technology_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                <th class="w-20">Contract Giver Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_Review)
                                            {{ $cftData->ContractGiver_Review }}
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
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_assessment)
                                            {{ $cftData->ContractGiver_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Contract Giver Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_feedback)
                                            {{ $cftData->ContractGiver_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Contract Giver Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_by)
                                            {{ $cftData->ContractGiver_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Contract Giver Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($cftData->ContractGiver_on)
                                            {{ $cftData->ContractGiver_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-">
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
                                                {{ $cftData->Other1_review }}
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
                                                {{ $cftData->Other1_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_assessment)
                                                {{ $cftData->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other1_feedback)
                                                {{ $cftData->Other1_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Other1_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Other2_review }}
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
                                                {{ $cftData->Other2_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_assessment)
                                                {{ $cftData->Other2_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other2_feedback)
                                                {{ $cftData->Other2_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Other2_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Other3_review }}
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
                                                {{ $cftData->Other3_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_assessment)
                                                {{ $cftData->Other3_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other3_feedback)
                                                {{ $cftData->Other3_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Other3_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Other4_review }}
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
                                                {{ $cftData->Other4_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 4)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_assessment)
                                                {{ $cftData->Other4_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other4_feedback)
                                                {{ $cftData->Other4_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Other4_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                                                {{ $cftData->Other5_review }}
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
                                                {{ $cftData->Other5_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_assessment)
                                                {{ $cftData->Other5_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Other5_feedback)
                                                {{ $cftData->Other5_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $cftData->Other5_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-">
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
                        Evaluation Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Evaluation Comments</th>
                            <td>
                                <div>
                                    {{ $evaluation->qa_eval_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Evaluation Attachments </th>
                            <td>
                                <div><strong>On {{ Helpers:: getDateFormat($evaluation->qa_evaluation_attachments) }} added by {{ $data->qa_evaluation_attachments}}</strong>
                                </div>
                                <div>
                                    {{ $evaluation->qa_evaluation_attachments }}
                                </div>
                            </td>
                        </tr>
                    </table>
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
                        <td class="w-30">{{ $info->cft_comments }}</td>
                        <th class="w-20">Attachment </th>
                        <td class="w-30">{{ $info->cft_attachment }}</td>
                    </tr>
                        <tr>
                            <th class="w-20">QA Comments</th>
                            <td class="w-80">
                                <div> @if($comments->qa_comments){{ $comments->qa_comments}} @else Not Applicable @endif </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Head Designee Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->designee_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Warehouse Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Warehouse_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Engineering Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Engineering_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Instrumentation Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Instrumentation_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Validation Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Validation_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Others Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Others_comments }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                <div>
                                    {{ $comments->Group_comments }}
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
                            @if($comments->group_attachments)
                                @foreach(json_decode($comments->group_attachments) as $key => $file)
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
                        Training Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if($approcomments->tran_attach)
                            @foreach(json_decode($approcomments->tran_attach) as $key => $file)
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
                            @if ($affectedDoc && is_array($affectedDoc))
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @foreach ($affectedDoc as $affectedDoc)
                                    <tr>
                                        <td class="w-20">{{ $serialNumber++ }}</td>
                                        <td class="w-20">{{ $affectedDoc['afftectedDoc'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['documentName'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['documentNumber'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['versionNumber'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['implimentationDate'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['newDocumentNumber'] }}</td>
                                        <td class="w-20">{{ $affectedDoc['newVersionNumber'] }}</td>
                                    </tr>
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
                        @if($approcomments->tran_attach)
                            @foreach(json_decode($approcomments->tran_attach) as $key => $file)
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
            


             <div class="block">
                <div class="block-head">
                   Activity Log 
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By</th>
                        <td class="w-30"><div class="static">{{ $data->submit_by }}</div></td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30"><div class="static">{{ $data->submit_on }}</div></td>
                        <th class="w-20">Submitted Comment</th>
                        <td class="w-30"><div class="static">{{ $data->submit_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">HOD Review By</th>
                        <td class="w-30"><div class="static">{{ $data->hod_review_by }}</div></td>
                        <th class="w-20">HOD Review On</th>
                        <td class="w-30"><div class="static">{{ $data->hod_review_on }}</div></td>
                        <th class="w-20">HOD Comment</th>
                        <td class="w-30"><div class="static">{{ $data->hod_review_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Initial</th>
                        <td class="w-30"><div class="static">{{ $data->QA_initial_review_by }}</div></td>
                        <th class="w-20">QA Initial</th>
                        <td class="w-30"><div class="static">{{ $data->QA_initial_review_on }}</div></td>
                        <th class="w-20">QA Initial Comment</th>
                        <td class="w-30"><div class="static">{{ $data->QA_initial_review_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">Pending RA</th>
                        <td class="w-30"><div class="static">{{ $data->pending_RA_review_by }}</div></td>
                        <th class="w-20">Pending RA</th>
                        <td class="w-30"><div class="static">{{ $data->pending_RA_review_on }}</div></td>
                        <th class="w-20">Pending RA Comment</th>
                        <td class="w-30"><div class="static">{{ $data->pending_RA_review_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">CFT By</th>
                        <td class="w-30"><div class="static">{{ $data->cft_review_by }}</div></td>
                        <th class="w-20">CFT On</th>
                        <td class="w-30"><div class="static">{{ $data->cft_review_on }}</div></td>
                        <th class="w-20">CFT Comment</th>
                        <td class="w-30"><div class="static">{{ $data->cft_review_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Final</th>
                        <td class="w-30"><div class="static">{{ $data->QA_final_review_by }}</div></td>
                        <th class="w-20">QA Final</th>
                        <td class="w-30"><div class="static">{{ $data->QA_final_review_on }}</div></td>
                        <th class="w-20">QA Final Comment</th>
                        <td class="w-30"><div class="static">{{ $data->QA_final_review_comment }}</div></td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Head By</th>
                        <td class="w-30"><div class="static">{{ $data->QA_head_approval_by }}</div></td>
                        <th class="w-20">QA Head On</th>
                        <td class="w-30"><div class="static">{{ $data->QA_head_approval_on }}</div></td>
                        <th class="w-20">QA Head Comment</th>
                        <td class="w-30"><div class="static">{{ $data->QA_head_approval_comment }}</div></td>
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
