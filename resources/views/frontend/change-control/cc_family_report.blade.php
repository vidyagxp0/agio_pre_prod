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


        .head-number {
            font-weight: bold;
            font-size: 13px;
            padding-left: 10px;
        }

        .div-data {
            font-size: 13px;
            padding-left: 10px;
            margin-bottom: 10px;
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
    </style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Change Control Family Report
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
                    {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Page No.</strong>
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




                    {{-- <tr> On {{ Helpers::getDateFormat($data->created_at) }} added by {{ $data->originator }} --}}
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getDateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getDateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiation Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ ($data->Initiator_Group) }}
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
                    <tr>
                        <th class="w-20">Justification</th>
                       <td class="w-80" colspan="3">
                            @if ($data->risk_identification)
                                {{ $data->risk_identification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">HOD Person</th>
                          <td class="w-80" colspan="3">
                            @if ($data->hod_person)
                                {{ Helpers::getInitiatorName($data->hod_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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
                        <th class="w-20">Change Related To</th>
                        <td class="w-30">
                            @if ($data->severity)
                                {{ucfirst($data->severity) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

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
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ucfirst($data->initiated_through) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

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
                    </tr>


                    <tr>
                        <th class="w-20">Nature of Change</th>
                          <td class="w-80" colspan="3">
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
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->in_attachment)
                            @foreach (json_decode($data->in_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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

            <div class="block">
                <div class="block-head">
                    Risk Assessment
                </div>
                <table>
                    <tr>
                        <th class="w-20">Related Records</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->risk_assessment_related_record ? $data->risk_assessment_related_record : 'Not Applicable'  }}
                                
                                
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80" colspan="3">
                            <div>
                                {{ $data->migration_action ? $data->migration_action : 'Not Applicable' }}
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
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->risk_assessment_atch)
                            @foreach (json_decode($data->risk_assessment_atch) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
            </div>

            <div class="border-table">
                        <div class="block-head">
                        Change Details Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->change_details_attachments)
                                @foreach (json_decode($cc_cfts->change_details_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->hod_assessment_attachment)
                                @foreach (json_decode($cc_cfts->hod_assessment_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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


                <tr>
                    <th class="w-20">Related Records</th>
                        <td class="w-80" colspan="3">
                            <div>
                                 @if ($data->related_records)
                                    {{ str_replace(',', ', ', $data->related_records) }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                </tr>


                        
                        <!-- <tr>
                            <th class="w-20">Related Records</th>
                            <td class="w-80">
                                {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($review->related_records, 4, '0', STR_PAD_LEFT) }}
                            </td>
                        </tr> -->
                    </table>


                    
                    <div class="border-table">
                        <div class="block-head">
                        QA/CQA Initial Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->qa_head)
                                @foreach (json_decode($data->qa_head) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->RA_attachment)
                                @foreach (json_decode($cftData->RA_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Quality_Assurance_attachment)
                                @foreach (json_decode($cftData->Quality_Assurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <td class="w-30" colspan="3">
                                    <div>
                                        @if ($cftData->Production_Table_Assessment)
                                            {{ $cftData->Production_Table_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                </tr>

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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Production_Table_Attachment)
                                @foreach (json_decode($cftData->Production_Table_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ProductionLiquid_attachment)
                                @foreach (json_decode($cftData->ProductionLiquid_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Production_Injection_Attachment)
                                @foreach (json_decode($cftData->Production_Injection_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Store_attachment)
                                @foreach (json_decode($cftData->Store_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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

                                <tr>

                                    <th class="w-20">Quality Control Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Quality_Control_by)
                                                {{ $cftData->Quality_Control_by }}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Quality_Control_attachment)
                                    @foreach (json_decode($cftData->Quality_Control_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ResearchDevelopment_attachment)
                                @foreach (json_decode($cftData->ResearchDevelopment_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Engineering_attachment)
                                    @foreach (json_decode($cftData->Engineering_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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

                                <tr>

                                    <th class="w-20">Human Resource Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_by)
                                                {{ $cftData->Human_Resource_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Human Resource Review Completed On</th>
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
                                Human Resource Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Human_Resource_attachment)
                                    @foreach (json_decode($cftData->Human_Resource_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->Microbiology_attachment)
                                @foreach (json_decode($cftData->Microbiology_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->RegulatoryAffair_attachment)
                                @foreach (json_decode($cftData->RegulatoryAffair_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($cftData->CorporateQualityAssurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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

                                <tr>

                                    <th class="w-20">Safety Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($cftData->Human_Resource_by)
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Human_Resource_attachment)
                                    @foreach (json_decode($cftData->Human_Resource_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Information_Technology_attachment)
                                    @foreach (json_decode($cftData->Information_Technology_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Contract Giver comment update by</th>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->ContractGiver_attachment)
                                @foreach (json_decode($cftData->ContractGiver_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                </tr>
                                <tr>
                                    <th class="w-20">Other's 1 Department</th>
                                   <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other1_Department_person)
                                                {{ ($cftData->Other1_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other1_assessment)
                                                {{ $cftData->Other1_assessment }}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other1_attachment)
                                    @foreach (json_decode($cftData->Other1_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                               </tr>
                                <tr>    
                                    <th class="w-20">Other's 2 Department</th>
                                  <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other2_Department_person)
                                                {{ ($cftData->Other2_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other2_Assessment)
                                                {{ $cftData->Other2_Assessment }}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other2_attachment)
                                    @foreach (json_decode($cftData->Other2_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                            </tr>
                            <tr>
                                    <th class="w-20">Other's 3 Department</th>
                                   <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other3_Department_person)
                                                {{ ($cftData->Other3_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other3_Assessment)
                                                {{ $cftData->Other3_Assessment }}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other3_attachment)
                                    @foreach (json_decode($cftData->Other3_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">4</td>
                                        <td class="w-60">Not Applicable</td>
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
                              </tr>
                                <tr>
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other4_Department_person)
                                                {{ ( $cftData->Other4_Department_person )}}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other4_attachment)
                                    @foreach (json_decode($cftData->Other4_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                </tr>
                                <tr>
                                    <th class="w-20">Other's 5 Department</th>
                                   <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other5_Department_person)
                                                {{ ( $cftData->Other5_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($cftData->Other5_Assessment)
                                                {{ $cftData->Other5_Assessment }}
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($cftData->Other5_attachment)
                                    @foreach (json_decode($cftData->Other5_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <td class="w-80" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cftData->qa_final_attach)
                                @foreach (json_decode($cftData->qa_final_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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





                   <div class="block">
                <div class="head">
                    <div class="block-head">
                      RA
                    </div>
                      <table>
                              <tr>
                               
                                <th class="w-20">RA Approval Comment</th>
                                <td class="w-80">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->RA_attachment_second)
                                @foreach (json_decode($cc_cfts->RA_attachment_second) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->qa_cqa_attach)
                                @foreach (json_decode($cc_cfts->qa_cqa_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->intial_update_attach)
                                @foreach (json_decode($cc_cfts->intial_update_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($cc_cfts->hod_final_review_attach)
                                @foreach (json_decode($cc_cfts->hod_final_review_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($QaApprovalComments->tran_attach)
                                @foreach (json_decode($QaApprovalComments->tran_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                
                                
                            
                            </table>
                        

                    <div class="border-table">
                         <div class="block-head">
                         List Of Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($closure->attach_list)
                                @foreach (json_decode($closure->attach_list) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($approcomments->tran_attach)
                            @foreach (json_decode($approcomments->tran_attach) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                            <th class="w-20">Sr.No.</th>
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
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($approcomments->tran_attach)
                        @foreach (json_decode($approcomments->tran_attach) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
                </tr>
            </table>
            <table>          
                    <th class="w-20">Submit Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->submit_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
            </table> 
            <table>   

                <tr>
                    <th class="w-20">HOD Assessment Complete By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->hod_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">HOD Assessment Complete On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->hod_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
            </table> 
             <table> 
                <tr>        
                    <th class="w-20">HOD Assessment Complete Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->hod_review_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
             </table>  
            <table>         


                <tr>
                    <th class="w-20">Cancel By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->cancelled_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">Cancel On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->cancelled_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>    
                </table> 
                <table>  
                    <tr>     
                    <th class="w-20">Cancel Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->cancelled_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>  
                <table>        




                <tr>
                    <th class="w-20">QA/CQA Initial Assessment Complete By</th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_initial_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">QA/CQA Initial Assessment Complete On</th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_initial_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>  
                    <table>  

                    <tr>
                    <th class="w-20">QA/CQA Initial Assessment Complete Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->QA_initial_review_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                 </table>  
                 <table>  

                <tr>
                    <th class="w-20">CFT Assessment Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->pending_RA_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">CFT Assessment Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->pending_RA_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>  
                     <table>         
                    <tr>
                    <th class="w-20">CFT Assessment Complete Comment </th>
                    <td class="w-80">
                        <div class="static">{{ $data->pending_RA_review_comment ?? 'Not Applicable'  }}</div>
                    </td>

                </tr>
            </table>  


             @if($data->QA_final_review_by)
              <table>  


                <tr>
                    <th class="w-20"> QA/CQA Final Review Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_final_review_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20"> QA/CQA Final Review Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->QA_final_review_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>  
                    <table>  

                    <tr>
                    <th class="w-20">QA/CQA Final Review Complete Comment </th>
                    <td class="w-80">
                        <div class="static">{{ $data->QA_final_review_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
            </table>
                       
            @else  
            <table>     
                 <tr>
                    <th class="w-20">QA/CQA Final Review Complete By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_required_by  ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">QA/CQA Final Review Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_required_on ?? 'Not Applicable'  }}</div>
                    </td>
                    </tr>
                </table>
                <table>      
                    <tr>
                    <th class="w-20">QA/CQA Final Review Complete Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->RA_review_required_comment ?? 'Not Applicable'  }}</div>
                    </td>
                   
                </tr>
            </table>                
            @endif
               

            <table>      

                <tr>
                    <th class="w-20">RA Approval Complete By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_completed_by ?? 'Not Applicable'  }}</div>
                    </td>
                    <th class="w-20">RA Approval Complete On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->RA_review_completed_on ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                </table>   
                    <table>   
                <tr>
                    <th class="w-20"> RA Approval Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $data->RA_review_completed_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
            </table>   
                    <table>   

               

               

                <tr>
                    <th class="w-20">Approved  By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->approved_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Approved  On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->approved_on ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                </table> 
                <table>     
                <tr>
                    <th class="w-20">Approved Comment </th>
                    <td class="w-80">
                        <div class="static">{{ $data->approved_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>   
                <table>   



                <tr>
                    <th class="w-20">Rejected   By  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->Training_complete_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Rejected   On </th>
                    <td class="w-30">
                        <div class="static">{{ $data->Training_complete_on ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                </table>   
                <table>


                    </tr>
                    <th class="w-20">Rejected  Comment </th>
                    <td class="w-80">
                        <div class="static">{{ $data->Training_complete_comment ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                </table>   
                <table>




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
                    

                    </tr>

                    </table>   
                                <table>
                                    <tr>
                    <th class="w-20">Initiator Updated Completed Comment </th>
                    <td class="w-80">
                        <div class="static">
                            {{ isset($commnetData) ? $commnetData->initiator_update_complete_comment : 'Not Applicable' }}
                        </div>
                    </td>
                </tr>

                </table>   
                <table>


                 <tr>
                    <th class="w-20">HOD Final Review Complete  By </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_by  ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20"> HOD Final Review Complete  On  </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_on ?? 'Not Applicable'  }}</div>
                    </td>
                </tr>
                 </table>   
                <table>
                    <th class="w-20">HOD Final Review Complete Comment </th>
                    <td class="w-80">
                        <div class="static">{{ $data->closure_approved_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>

                </table>   
                <table>
                <tr>
                    <th class="w-20">Send For Final QA/CQA Head Approval By</th>
                    <td class="w-30">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval ?? 'Not Applicable' }}</div>
                    </td>

                    <th class="w-20">Send For Final QA/CQA Head Approval On</th>
                    <td class="w-30">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval_on ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                </table>   
                <table>
                <tr>
                    <th class="w-20">Send For Final QA/CQA Head Approval Comment</th>
                    <td class="w-80">
                        <div class="static">{{ $commnetData->send_for_final_qa_head_approval_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
               </table>   
                <table>
                    <tr>
                    <th class="w-20">Closure Approved By : </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_by ?? 'Not Applicable' }}</div>
                    </td>
                    <th class="w-20">Closure Approved On : </th>
                    <td class="w-30">
                        <div class="static">{{ $data->closure_approved_on ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
                </table>   
                <table>
                    <tr>
                    <th class="w-20">Closure Approved Comment :</th>
                    <td class="w-80">
                        <div class="static">{{ $data->closure_approved_comment ?? 'Not Applicable' }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </div>


    @if (count($Extension) > 0)
        @foreach ($Extension as $data)

        <center>
            <h3>Extension Child Report</h3>
        </center>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">General Information</div>
                    <table>
                        <tr>
                            <th class="w-20">Record Number</th>
                            <td class="w-30">
                                @if ($data->record_number)
                                    {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->site_location_code)
                                    {{ Helpers::getDivisionName($data->site_location_code) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
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
                    <table>
                        <tr>
                            <th class="w-20">Extension Number</th>
                            <td class="w-30">
                                @if ($data->count)
                                    {{ $data->count }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        
                            <th class="w-20">HOD Review</th>
                            <td class="w-30">
                                @if ($data->reviewers)
                                    {{ Helpers::getInitiatorName($data->reviewers) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <th class="w-20">Parent Record Number</th>
                            <td class="w-30">
                                @if ($data->related_records)
                                    {{ str_replace(',', ', ', $data->related_records) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20">QA/CQA Approval</th>
                            <td class="w-30">
                                @if ($data->approvers)
                                    {{ Helpers::getInitiatorName($data->approvers) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Current Due Date (Parent)</th>
                            <td class="w-30">
                                @if ($data->current_due_date)
                                    {{ Helpers::getdateFormat($data->current_due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Proposed Due Date</th>
                            <td class="w-30">
                                @if ($data->proposed_due_date)
                                    {{ Helpers::getdateFormat($data->proposed_due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <th class="w-20"> Description</th>
                            <td class="w-80">
                                @if ($data->description)
                                    {{ $data->description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>    
                            <th class="w-20">Justification / Reason</th>
                            <td class="w-80">
                                @if ($data->justification_reason)
                                    {{ $data->justification_reason }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="block">
                    <div class="block-head">Attachment Extension</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80">Attachment</th>
                            </tr>
                            @if ($data->file_attachment_extension)
                                @foreach (json_decode($data->file_attachment_extension) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-80">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="block">
                    <div class="block-head">HOD Review</div>

                    <table>
                        <tr>
                            <th class="w-20">HOD Remarks</th>
                            <td class="w-80">
                                @if ($data->reviewer_remarks)
                                    {{ $data->reviewer_remarks }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="block">
                    <div class="block-head">HOD Attachments</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80">Attachment</th>
                            </tr>
                            @if ($data->file_attachment_reviewer)
                                @foreach (json_decode($data->file_attachment_reviewer) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-80">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            @if ($data->count != 3)  
                <div class="block">
                    <div class="block-head">QA/CQA Approval</div>

                    <table>
                        <tr>
                            <th class="w-20">QA/CQA Approval Comments </th>
                            <td class="w-80">
                                @if ($data->approver_remarks)
                                    {{ $data->approver_remarks }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="block">
                    <div class="block-head">QA/CQA Approval Attachments</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-80">Attachment</th>
                            </tr>
                            @if ($data->file_attachment_approver)
                                @foreach (json_decode($data->file_attachment_approver) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-80">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

            @endif
            @if ($data->count == 3)  
                <div class="block">
                    <div class="block-head">CQA Approval</div>

                    <table>
                        <tr>
                            <th class="w-20">CQA Approval Comments </th>
                            <td class="w-80">
                                @if ($data->QAapprover_remarks)
                                    {{ $data->QAapprover_remarks }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>                

                </div>
                <div class="block">
                    <div class="block-head">CQA Approval Attachments</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-80">File</th>
                            </tr>
                            @if ($data->QAfile_attachment_approver)
                                @foreach (json_decode($data->QAfile_attachment_approver) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-80">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            @endif

                <div class="block">
                    <div class="block-head">Activity Log</div>
                    <table>
                        <tr>
                            <th class="w-20">Submit By</th>
                            <td class="w-30">@if ($data->submit_by) {{ $data->submit_by }} @else Not Applicable @endif</td>
                            <th class="w-20">Submit On</th>
                            <td class="w-30">@if ($data->submit_on) {{ $data->submit_on }} @else Not Applicable @endif</td>
                            <th class="w-20">Submit Comment</th>
                            <td class="w-30">@if ($data->submit_comment) {{ $data->submit_comment }} @else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Cancel By</th>
                            <td class="w-30">@if ($data->reject_by) {{ $data->reject_by }} @else Not Applicable @endif</td>
                            <th class="w-20">Cancel On</th>
                            <td class="w-30">@if ($data->reject_on) {{ $data->reject_on }} @else Not Applicable @endif</td>
                            <th class="w-20">Cancel Comment</th>
                            <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                        </tr>
                        {{-- <tr>
                            <th class="w-20">More Information Required By</th>
                            <td class="w-80">{{ $data->more_info_review_by }}</td>
                            <th class="w-20">More Information Required On</th>
                            <td class="w-80">{{ $data->more_info_review_on }}</td>
                            <th class="w-20">More Information Required Comment</th>
                            <td class="w-80">{{ $data->more_info_review_comment }}</td>
                        </tr> --}}
                        <tr>
                            <th class="w-20">Review By</th>
                            <td class="w-30">@if ($data->submit_by_review) {{ $data->submit_by_review }} @else Not Applicable @endif</td>
                            <th class="w-20">Review On</th>
                            <td class="w-30">@if ($data->submit_on_review) {{ $data->submit_on_review }} @else Not Applicable @endif</td>
                            <th class="w-20">Review Comment</th>
                            <td class="w-30">@if ($data->submit_comment_review) {{ $data->submit_comment_review }} @else Not Applicable @endif</td>
                        </tr>
                        {{-- <tr>
                            <th class="w-20">System By</th>
                            <td class="w-80">{{ $data->submit_by_review }}</td>
                            <th class="w-20">System On</th>
                            <td class="w-80">{{ $data->submit_on_review }}</td>
                            <th class="w-20">System Comment</th>
                            <td class="w-80">{{ $data->submit_comment_review }}</td>
                        </tr> --}}
                        <tr>
                            <th class="w-20">Reject By</th>
                            <td class="w-30">@if ($data->submit_by_inapproved) {{ $data->submit_by_inapproved }} @else Not Applicable @endif</td>
                            <th class="w-20">Reject On</th>
                            <td class="w-30">@if ($data->submit_on_inapproved) {{ $data->submit_on_inapproved }} @else Not Applicable @endif</td>
                            <th class="w-20">Reject Comment</th>
                            <td class="w-30">@if ($data->submit_commen_inapproved) {{ $data->submit_commen_inapproved }} @else Not Applicable @endif</td>
                        </tr>
                        {{-- <tr>
                            <th class="w-20">More Information Required By</th>
                            <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                            <th class="w-20">More Information Required On</th>
                            <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                            <th class="w-20">More Information Required Comment</th>
                            <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                        </tr> --}}
                        <!-- @if($data->count == 3)
                            <tr>
                                <th class="w-20">Send for CQA By</th>
                                <td class="w-80">@if ($data->send_cqa_by) {{ $data->send_cqa_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Send for CQA On</th>
                                <td class="w-80">@if ($data->send_cqa_on) {{ $data->send_cqa_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Send for CQA Comment</th>
                                <td class="w-80">@if ($data->send_cqa_comment) {{ $data->send_cqa_comment }} @else Not Applicable @endif</td>
                            </tr>
                        @endif -->
                        @if($data->count != 3)
                            <tr>
                                <th class="w-20">Approved By</th>
                                <td class="w-30">@if ($data->submit_by_approved) {{ $data->submit_by_approved }} @else Not Applicable @endif</td>
                                <th class="w-20">Approved On</th>
                                <td class="w-30">@if ($data->submit_on_approved) {{ $data->submit_on_approved }} @else Not Applicable @endif</td>
                                <th class="w-20">Approved Comment</th>
                                <td class="w-30">@if ($data->submit_comment_approved) {{ $data->submit_comment_approved }} @else Not Applicable @endif</td>
                            </tr>
                        @endif

                        @if($data->count == 3)
                            <tr>
                                <th class="w-20">CQA Approval Complete By</th>
                                <td class="w-30">@if ($data->cqa_approval_by) {{ $data->cqa_approval_by }} @else Not Applicable @endif</td>
                                <th class="w-20">CQA Approval Complete On</th>
                                <td class="w-30">@if ($data->cqa_approval_on) {{ $data->cqa_approval_on }} @else Not Applicable @endif</td>
                                <th class="w-20">CQA Approval Complete Comment</th>
                                <td class="w-30">@if ($data->cqa_approval_comment) {{ $data->cqa_approval_comment }} @else Not Applicable @endif</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>

        @endforeach
    @endif

    @if ($RootCause->isNotEmpty())
        @foreach ($RootCause as $data)

        <center>
            <h3>Root Cause Analysis Child Report</h3>
        </center>

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
                            @if (!empty($data->selectedMethodologies))
                                {{ implode(', ', $data->selectedMethodologies) }}
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
        @endforeach
    @endif


    @if (count($ActionItem) > 0)
        @foreach ($ActionItem as $data)

        <center>
            <h3>Action Item Child Report</h3>
        </center>

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
                                    {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->division_id)
                                    {{ Helpers::getDivisionName($data->division_id) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        </tr>

                        <tr>
                            <th class="w-20">Parent Record Number</th>
                            <td class="w-30">
                                @if ($data->parent_record_number)
                                    {{ $data->parent_record_number }}
                                @elseif($data->parent_record_number_edit)
                                    {{ $data->parent_record_number_edit }}
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
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-80">
                                @if ($data->due_date)
                                    {{ Helpers::getdateFormat($data->due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="block">
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
                    </div>



                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Action Item Related Records</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                            {{-- <tr>
                                <th class="w-20">HOD Persons</th>
                                <td class="w-80">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr> --}}

                                <th class="w-20">HOD Persons</th>
                                <td class="w-30">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- <div class="other-container ">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            <div class="bold">Description</div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="custom-procedure-block" style="margin-left: 12px">
                                <div class="custom-container">
                                    <div class="custom-table-wrapper" id="custom-table2">
                                        <div class="custom-procedure-content">
                                            <div class="custom-content-wrapper">
                                                <div class="table-containers">
                                                    {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="other-container">
                            <table style="width:100%; border-collapse: collapse;">
                                    <tr>
                                        <th class="w-20">
                                            <strong>Description</strong>
                                        </th>
                                        <td class="w-80">
                                            {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Responsible Department</th>
                                <td class="w-80">
                                    @if ($data->departments)
                                        {{ $data->departments }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="block-head">
                        File Attachment
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20"> Sr.No.</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                            @if ($data->file_attach)
                                @php $files = json_decode($data->file_attach); @endphp
                                @if (count($files) > 0)
                                    @foreach ($files as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>



                <div class="block-head">
                    Acknowledge
                </div>
                <table>
                    <tr>
                        <th class="w-20">Acknowledge Comment</th>
                        <td class="w-80">
                            @if ($data->acknowledge_comments)
                                {{ $data->acknowledge_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                    Acknowledge Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->acknowledge_attach)
                            @php $files = json_decode($data->acknowledge_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                    Post Completion
                </div>
                <table>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-80">
                            @if ($data->action_taken)
                                {{ $data->action_taken }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Actual Start Date</th>
                        <td class="w-30">
                            @if ($data->start_date)
                                {{ Helpers::getdateFormat($data->start_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Actual End Date</th>
                        <td class="w-30">
                            @if ($data->end_date)
                                {{ Helpers::getdateFormat($data->end_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
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
                </div>

                <div class="block-head">
                    Completion Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->Support_doc)
                            @php $files = json_decode($data->Support_doc); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                QA/CQA Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Verification Comments</th>
                        <td class="w-80">
                            @if ($data->qa_comments)
                                {{ $data->qa_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                        QA/CQA Verification Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->final_attach)
                            @php $files = json_decode($data->final_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="block" style="margin-top: 15px;">
                    <div class="block-head">
                        Activity Log
                    </div>
                    <table>
                        <tr>
                            <th class="w-10">Submit By</th>
                            <td class="w-20">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit On</th>
                            <td class="w-20">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit Comment</th>
                            <td class="w-30">@if($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</td>
                        </tr>


                        

                        <!-- </table>
                        <div class="block-head">
                            Cancel
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Cancel By</th>
                            <td class="w-20">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel On</th>
                            <td class="w-20">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel Comment</th>
                            <td class="w-30">@if($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</td>
                        </tr>

                        <!-- </table>
                        <div class="block-head">
                            Acknowledge Complete
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Acknowledge Complete By</th>
                            <td class="w-20">@if($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete On</th>
                            <td class="w-20">@if($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete Comment</th>
                            <td class="w-30">@if($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                            Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Complete By</th>
                            <td class="w-20">@if($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete On</th>
                            <td class="w-20">@if($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete Comment</th>
                            <td class="w-30">@if($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                        Verification Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Verification Complete By</th>
                            <td class="w-20">@if($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete On</th>
                            <td class="w-20">@if($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete Comment</th>
                            <td class="w-30">@if($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @endforeach
    @endif

    @if (count($capa_Data) > 0)
        @foreach ($capa_Data as $data)

        <center>
            <h3>Capa Child Report</h3>
        </center>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        General Information
                    </div>
                    <table>
                    <tr>
                            <th class="w-20">Record Number</th>
                            <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ $data->originator }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                        </tr>

                        <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ $data->assign_to }} @else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                            <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Initiator Department</th>

                            <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                            {{-- <td class="w-30">{{ Helpers::getFullDepartmentName($data->initiator_Group) }}</td> --}}

                            <th class="w-20">Initiator Department Code</th>
                            <td class="w-30">{{ $data->initiator_group_code }}</td>

                        </tr>


                        </table>
                        <table>

                        <tr>
                                <th class="w-20">Short Description</th>

                                <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        </tr>

                        <tr>

                        <th class="w-20">Initiated Through</th>
                            <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                        </tr>

                        </table>

                        <table>


                            <tr>

                    <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat ){{ $data->repeat }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>


                    </table>

                    <table>
                        <tr>
                            <th class="w-20">Problem Description</th>
                            <td class="w-80" colspan="5">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">CAPA Team</th>
                            <td class="w-80" colspan="5">@if($data->capa_team){{  $capa_teamNamesString }}@else Not Applicable @endif</td>

                        </tr>
                    </table>
                    <table>

                    <table>
                        <tr>
                                <th class="w-20">Reference Records</th>
                                <td class="w-80" colspan="5">
                                    @if($data->parent_record_number_edit){{ $data->parent_record_number_edit}}@else Not Applicable @endif
                                    {{--@if($data->capa_related_record){{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif--}}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20"> Initial Observation</th>
                                <td class="w-80" colspan="5">
                                @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <th class="w-20">Interim Containment</th>

                        <td class="w-80">
                                @if($data->interim_containnment)
                                    {{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->interim_containnment))) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>   
                        </tr>
                        <tr>
                            <th class="w-20"> Containment Comments </th>
                            <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                        </tr>
                    </table>
                   

                    <div class="block-head">
                        CAPA Attachments
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->capa_attachment)
                                    @foreach(json_decode($data->capa_attachment) as $key => $file)
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
                    </table>
                </div>

                <div class="block">
                        <div class="block-head">
                            Other Type Details

                            </div>
                            <table>
                                <tr>
                                <th class="w-20">Investigation Summary</th>
                                <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                <th class="w-20">Root Cause</th>
                                <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Product / Material Details
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-10">Sr.No.</th>
                                    <th class="w-20">Product / Material Name</th>
                                    <th class="w-20">Product /Material Batch No./Lot No./AR No.</th>
                                    <th class="w-20">Product / Material Manufacturing Date</th>
                                    <th class="w-20">Product / Material Date of Expiry</th>
                                    <th class="w-20">Product Batch Disposition Decision</th>
                                    <th class="w-20">Product Remark</th>
                                    <th class="w-20">Product Batch Status</th>
                                </tr>
                                    {{-- @if($data->root_cause_initial_attachment)
                                    @foreach(json_decode($data->root_cause_initial_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else --}}
                                    @if($data->Material_Details->material_name)
                                    @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $dataDemo ? $key + 1  : "NA" }}</td>
                                        <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "NA"}}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "NA" }}</td>
                                        <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "NA" }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                    </tr>
                                    @endif

                            </table>
                        </div>
                        <br>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Equipment/Instruments Details
                            </div>
                            <div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-25">Sr.No.</th>
                                        <th class="w-25">Equipment/Instruments Name</th>
                                        <th class="w-25">Equipment/Instrument ID</th>
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
                        </div>

                        <div class="block-head">
                            Other Type CAPA Details
                            </div>
                            <table>
                            <tr>
                                <th class="w-20">Details</th>
                                <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>

                            </tr>
                            </table>

                        <div class="block">
                            <div class="block-head">
                                CAPA Details
                                </div>
                                <table>
                                <tr>

                                    <th class="w-20">CAPA Type</th>
                                    <td class="w-80" colspan="3"> @if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                                </tr>

                                
                                @if($data->corrective_action) 
                                <tr>

                                    <th class="w-20">Corrective Action</th>
                                    <td class="w-80" colspan="3"> @if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif

                                @if($data->preventive_action) 
                                <tr>

                                    <th class="w-20">Preventive Action</th>
                                    <td class="w-80" colspan="3"> @if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif
                                </table>

                        <div class="block-head">
                            File Attachment
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->capafileattachement)
                                        @foreach(json_decode($data->capafileattachement) as $key => $file)
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
                        </table>
                        </div>
                        <br>
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
                            HOD Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->hod_attachment)
                                    @foreach(json_decode($data->hod_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                    <div class="block-head">
                        QA/CQA Review
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th class="w-20"> QA/CQA Review Comment </th>
                                <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                            </tr>
                        </table>

                        <div class="block-head">
                            QA/CQA Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_attachment)
                                    @foreach(json_decode($data->qa_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                        QA/CQA Approval
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Approval Comment</th>
                                            <td class="w-80">@if($data->qah_cq_comments){{ $data->qah_cq_comments }}@else Not Applicable @endif</td>

                                        </tr>
                        </table> <div class="block-head">
                            QA/CQA Approval Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qah_cq_attachment)
                                    @foreach(json_decode($data->qah_cq_attachment) as $key => $file)
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
                    </table>
                    </div>


                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    Initiator CAPA update
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">Initiator CAPA Update Comment</th>
                                            <td class="w-80">@if($data->initiator_comment){{ $data->initiator_comment}}@else Not Applicable @endif</td>

                                            </tr>
                        </table>

                        <div class="block-head">
                            Initiator CAPA update Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->initiator_capa_attachment)
                                    @foreach(json_decode($data->initiator_capa_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    HOD Final Review
                                    </div>
                                    <div>
                                        <table>
                                            <tr>
                                                <th class="w-20">HOD Final Review Comments</th>
                                                <td class="w-80">@if($data->hod_final_review ){{ $data->hod_final_review }}@else Not Applicable @endif</td>

                                            </tr>
                                        </table>
                        <div class="block-head">
                            HOD Final Attachment
                        </div>
                        <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->hod_final_attachment)
                                        @foreach(json_decode($data->hod_final_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>

                        <div class="block">
                                    <div class="block-head">
                                    QA/CQA Closure Review
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Closure Review Comment</th>
                                            <td class="w-80">@if($data->qa_cqa_qa_comments){{ $data->qa_cqa_qa_comments }}@else Not Applicable @endif</td>

                                                </tr>
                        </table>
                        <div class="block-head">
                            QA/CQA Closure Review Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_closure_attachment)
                                    @foreach(json_decode($data->qa_closure_attachment) as $key => $file)
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
                    </table>
                    </div>




                        <div class="block">
                        <div class="block-head">
                        CAPA Closure
                        </div>
                        <table>
                        <tr>

                        <th class="w-20">
                        Effectiveness check required
                            </th>
                        <td class="w-80">
                            @if($data->effectivness_check){{ $data->effectivness_check }}@else Not Applicable @endif
                            </td>
                        </tr>
                        <tr>
                        <th class="w-20">QA/CQA Head Closure Review Comment</th>
                        <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                        </tr>
                        </table>
                        </div>

                    </table>
                </div>



                                <div class="block-head">
                                    QA/CQA Head Closure Review Attachment
                                </div>
                                <div class="border-table">
                                    <table>
                                        <tr class="table_bg">
                                            <th class="w-20">Sr.No</th>
                                            <th class="w-60">Attachment </th>
                                        </tr>
                                            @if($data->closure_attachment)
                                            @foreach(json_decode($data->closure_attachment) as $key => $file)
                                                <tr>
                                                    <td class="w-20">{{ $key + 1 }}</td>
                                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-80">Not Applicable</td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                                {{-- <div class="block-head">
                                    Extension Justification
                                </div>

                                <table>
                                    <tr>
                                        <th class="w-20">Due Date Extension Justification</th>
                                            <td class="w-80">
                                                {{ $data->due_date_extension }}</td>
                                    </tr>
                                </table> --}}

                            <div class="block">
                                <div class="block-head">
                                    Activity Log
                                </div>
                                <table>
                                    {{-- Propose Plan --}}
                                    <tr>
                                        <th class="w-20">Propose Plan By</th>
                                        <td class="w-30">@if($data->plan_proposed_by){{ $data->plan_proposed_by }}@else Not Applicable @endif</td>
                                        <th class="w-20">Propose Plan On</th>
                                        <td class="w-30">@if($data->plan_proposed_on){{ $data->plan_proposed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Propose Plan Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Cancel --}}
                                    <tr>
                                        <th>Cancel By</th>
                                        <td>@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                                        <th>Cancel On</th>
                                        <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Cancel Comment</th>
                                        <td colspan="3">@if($data->cancelled_on_comment){{ $data->cancelled_on_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Review --}}
                                    <tr>
                                        <th>HOD Review Complete By</th>
                                        <td>@if($data->hod_review_completed_by){{ $data->hod_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Review Complete On</th>
                                        <td>@if($data->hod_review_completed_on){{ $data->hod_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Review Complete Comment</th>
                                        <td colspan="3">@if($data->hod_comment){{ $data->hod_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Review --}}
                                    <tr>
                                        <th>QA/CQA Review Complete By</th>
                                        <td>@if($data->qa_review_completed_by){{ $data->qa_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Review Complete On</th>
                                        <td>@if($data->qa_review_completed_on){{ $data->qa_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_comment){{ $data->qa_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Approved --}}
                                    <tr>
                                        <th>Approved By</th>
                                        <td>@if($data->approved_by){{ $data->approved_by }}@else Not Applicable @endif</td>
                                        <th>Approved On</th>
                                        <td>@if($data->approved_on){{ $data->approved_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Approved Comment</th>
                                        <td colspan="3">@if($data->approved_comment){{ $data->approved_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Completed --}}
                                    <tr>
                                        <th>Completed By</th>
                                        <td>@if($data->completed_by){{ $data->completed_by }}@else Not Applicable @endif</td>
                                        <th>Completed On</th>
                                        <td>@if($data->completed_on){{ $data->completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Complete Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Final Review --}}
                                    <tr>
                                        <th>HOD Final Review Complete By</th>
                                        <td>@if($data->hod_final_review_completed_by){{ $data->hod_final_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Final Review Complete On</th>
                                        <td>@if($data->hod_final_review_completed_on){{ $data->hod_final_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Final Review Complete Comment</th>
                                        <td colspan="3">@if($data->final_comment){{ $data->final_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Closure Review --}}
                                    <tr>
                                        <th>QA/CQA Closure Review Complete By</th>
                                        <td>@if($data->qa_closure_review_completed_by){{ $data->qa_closure_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Closure Review Complete On</th>
                                        <td>@if($data->qa_closure_review_completed_on){{ $data->qa_closure_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Closure Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_closure_comment){{ $data->qa_closure_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QAH/CQA Head Approval --}}
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete By</th>
                                        <td>@if($data->qah_approval_completed_by){{ $data->qah_approval_completed_by }}@else Not Applicable @endif</td>
                                        <th>QAH/CQA Head Approval Complete On</th>
                                        <td>@if($data->qah_approval_completed_on){{ $data->qah_approval_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete Comment</th>
                                        <td colspan="3">@if($data->qah_comment){{ $data->qah_comment }}@else Not Applicable @endif</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        </div>
            </div>
        </div>

        @endforeach
    @endif
     

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

</body>

</html>
