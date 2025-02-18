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
                    Lab Incident Report
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
                    <strong>Lab Incident No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                <div class="block-head" style="margin: 2%">
                    General Information
                </div>
                <table >
                <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">{{$data->division?$data->division:'-'}}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>

                        <!-- <th class="w-20">Assigned To</th>
                        <td class="w-30">@isset($data->assign_to) {{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endisset</td> -->
                        <th class="w-20">Due Date</th>
                        <td class="w-30">@if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>
                        <th class="w-20">Name of Analyst</th>
                        <td class="w-30">
                            @if($data->name_of_analyst){{ $data->name_of_analyst }}@else Not Applicable @endif
                        </td>
                    </tr>

                    <tr>

                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if($data->short_desc){{ $data->short_desc }}@else Not Applicable @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
                    <div class="block-head">
                        Incident Investigation Report
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-10">Sr. No.</th>
                                <th class="w-30">Name of Product</th>
                                <th class="w-30">B No./A.R. No.</th>
                                <th class="w-30">Remarks</th>
                            </tr>
                            @php $investreport = 1; @endphp

                        @if (!empty($labgrid->data) && is_iterable($labgrid->data))
                            @foreach ($labgrid->data as $item)
                                <tr>
                                    <td class="w-15">{{ $investreport++ }}</td>
                                    <td class="w-15">{{ $item['name_of_product'] }}</td>
                                    <td class="w-15">{{ $item['batch_no'] }}</td>
                                    <td class="w-15">{{ $item['remarks'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr>
                        @endif

                        </table>
                    </div>
                </div>

                <table>
                    <!-- <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if(!empty($data->Initiator_Group)){{ $data->Initiator_Group }} @else Not Applicable  @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr> -->
                    <tr>
                        <!-- <th class="w-20">Severity Level</th>
                        <td class="w-30">@if(!empty($data->severity_level2)){{ $data->severity_level2 }} @else Not Applicable @endif</td> -->
                        <th class="w-20">Instrument Involved</th>
                        <td class="w-30">@if($data->incident_involved_others_gi){{ $data->incident_involved_others_gi }} @else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Stage</th>
                        <td class="w-30">@if($data->stage_stage_gi){{ $data->stage_stage_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Stability Condition (If Applicable)</th>
                        <td class="w-30">@if($data->incident_stability_cond_gi){{ $data->incident_stability_cond_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Interval (If Applicable)</th>
                        <td class="w-30">@if($data->incident_interval_others_gi){{ $data->incident_interval_others_gi }}@else Not Applicable @endif</td>

                        <th class="w-20">Test</th>
                        <td class="w-30">@if($data->test_gi){{ $data->test_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Date Of Analysis</th>
                        <td class="w-30">@if($data->incident_date_analysis_gi){{ Helpers::getdateFormat($data->incident_date_analysis_gi) }}@else Not Applicable @endif</td>

                        <th class="w-20">Specification Number</th>
                        <td class="w-30">@if($data->incident_specification_no_gi){{ $data->incident_specification_no_gi }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">STP Number</th>
                        <td class="w-30">@if($data->incident_stp_no_gi){{ $data->incident_stp_no_gi }}@else Not Applicable @endif</td>

                        <th class="w-20">Date Of Incidence</th>
                        <td class="w-30">@if($data->incident_date_incidence_gi){{ Helpers::getdateFormat($data->incident_date_incidence_gi) }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Description Of Incidence</th>
                        <td class="w-30" colspan="3">@if($data->description_incidence_gi){{ $data->description_incidence_gi }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Reported By</th>
                        <td class="w-30">@isset($data->analyst_sign_date_gi) {{ $data->analyst_sign_date_gi }} @else Not Applicable @endisset</td>
                    </tr>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->Incident_Category_others){{ $data->Incident_Category_others }}@else Not Applicable @endif</td>

                       </tr>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-30">@if($data->immediate_action_ia){{ $data->immediate_action_ia }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->attachments_gi)
                            @foreach (json_decode($data->attachments_gi) as $key => $file)
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
                        <th class="w-20">QC Head/HOD Person</th>
                        <td class="w-30">@isset($data->investigator_qc) {{ Helpers::getInitiatorName($data->investigator_qc) }} @else Not Applicable @endisset</td>

                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">@if($data->qc_review_to){{ Helpers::getInitiatorName($data->qc_review_to) }}@else Not Applicable @endif</td>
                    </tr>
                </table>


            <div class="block">
                <div class="block-head">
                QC Head Review
                </div>
                <table>
                    <tr>
                        <th>QC Head Review Comments</th>
                        <td class="w-30">@if($data->QA_Review_Comments){{ $data->QA_Review_Comments }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QC Head Review Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->QA_Head_Attachment)
                            @foreach (json_decode($data->QA_Head_Attachment) as $key => $file)
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
                <div class="block-head">
                QA Initial Review
                </div>
                <table>
                    <tr>
                        <th>QA Initial Review Comments</th>
                        <td class="w-30">@if($data->QA_initial_Comments){{ $data->QA_initial_Comments }}@else Not Applicable @endif</td>

                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QA Initial Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->QA_Initial_Attachment)
                            @foreach (json_decode($data->QA_Initial_Attachment) as $key => $file)
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
                <div class="block-head">
                Investigation Details
                </div>
                <table>
                    <tr>
                        <th>Investigation Details</th>
                        <td>@if($data->Investigation_Details){{ $data->Investigation_Details }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th>Action Taken</th>
                        <td>@if($data->Action_Taken){{ $data->Action_Taken }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th>Root Cause</th>
                        <td class="w-30">@if($data->Root_Cause){{ $data->Root_Cause }}@else Not Applicable @endif</td>
                    </tr>

                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    Inv Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->Inv_Attachment)
                            @foreach (json_decode($data->Inv_Attachment) as $key => $file)
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

            <div>
                <table>
                <tr>
                    <th>Detail Investigation / Probable Root Cause</th>
                    <td>@if($data->details_investigation_ia){{ $data->details_investigation_ia }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>Proposed Corrective Action/Corrective Action Taken</th>
                    <td>@if($data->proposed_correctivei_ia){{ $data->proposed_correctivei_ia }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>Repeat Analysis Plan</th>
                    <td>@if($data->repeat_analysis_plan_ia){{ $data->repeat_analysis_plan_ia }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>Result Of Repeat Analysis</th>
                    <td>@if($data->result_of_repeat_analysis_ia){{ $data->result_of_repeat_analysis_ia }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>Corrective and Preventive Action</th>
                    <td>@if($data->corrective_and_preventive_action_ia){{ $data->corrective_and_preventive_action_ia }}@else Not Applicable @endif</td>
                </tr>

                    <tr>
                    <th>Investigation Summary</th>
                    <td>@if($data->investigation_summary_ia){{ $data->investigation_summary_ia }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th>CAPA Number</th>
                        <td>@if($data->capa_number_im){{ $data->capa_number_im }}@else Not Applicable @endif</td>
                        <th>Type of Incidence</th>
                        <td>@if($data->type_incidence_ia){{ $data->type_incidence_ia }}@else Not Applicable @endif</td>
                    </tr>

                <tr>
                    <th>Other Incidence</th>
                    <td>@if($data->other_incidence){{ $data->other_incidence }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>QC Investigator</th>
                    <td>@if($data->investigator_data){{ $data->investigator_data }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                    <th>QC Review</th>
                    <td class="w-30">@if($data->qc_review_data){{ Helpers::getInitiatorName($data->qc_review_data) }}@else Not Applicable @endif</td>
                </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    immediate Action Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->attachments_ia)
                            @foreach (json_decode($data->attachments_ia) as $key => $file)
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
                <div class="block-head">
                    QC Head/HOD Secondary Review
                </div>
                <table>
                <tr>
                    <th>Incident Category</th>
                    <td>@if($data->Incident_Category){{ $data->Incident_Category }}@else Not Applicable @endif</td>
                    <th>Other Incident Category</th>
                    <td>@if($data->other_incidence_data){{ $data->other_incidence_data }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th>QC Head/HOD Secondary Review Comments</th>
                    <td>@if($data->QC_head_hod_secondry_Comments){{ $data->QC_head_hod_secondry_Comments }}@else Not Applicable @endif</td>
                </tr>
                </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                    QC Head/HOD Secondary Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->QC_headhod_secondery_Attachment)
                            @foreach (json_decode($data->QC_headhod_secondery_Attachment) as $key => $file)
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
                <div class="block-head">
                QA Secondary Review
                </div>
                <table>
                <tr>
                    <th>QA Secondary Review Comments</th>
                    <td>@if($data->QA_secondry_Comments){{ $data->QA_secondry_Comments }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                    <div class="block-head">
                    QA Secondary Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($data->QA_secondery_Attachment)
                            @foreach (json_decode($data->QA_secondery_Attachment) as $key => $file)
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
                <div class="block-head">
                Closure
                </div>
                    <table>
                        <tr>
                            <th>Closure of Incident</th>
                            <td>@if($labtab->closure_incident_c){{ $labtab->closure_incident_c }}@else Not Applicable @endif</td>
                            <th>QA Head Comment</th>
                            <td>@if($labtab->qa_hear_remark_c){{ $labtab->qa_hear_remark_c }}@else Not Applicable @endif</td>
                    </tr>
                    </table>
            </div>
            <div class="border-table">
                    <div class="block-head">
                    Closure Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File</th>
                        </tr>
                        @if ($labtab->closure_attachment_c)
                            @foreach (json_decode($labtab->closure_attachment_c) as $key => $file)
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
                <div class="block-head">
                    Activity Log
                </div>
                <div class="block-head">
                    Submit
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-30">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>
                    <div class="block-head">
                    QC Head/HOD Initial Review Complete
                </div>
                <table>
                    <tr>
                        <th class="w-20">QC Head/HOD Initial Review Complete By</th>
                        <td class="w-30">@if($data->review_completed_by){{ $data->review_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Initial Review Complete On</th>
                        <td class="w-30">@if($data->review_completed_on){{ $data->review_completed_on }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Initial Review Complete Comment</th>
                        <td class="w-30">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    QA Initial Review Complete
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Initial Review Complete By</th>
                        <td class="w-30">@if($data->preliminary_completed_by){{ $data->preliminary_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">@if($data->preliminary_completed_on){{ $data->preliminary_completed_on }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Initial Review Complete Comment</th>
                        <td class="w-30">@if($data->preliminary_completed_comment){{ $data->preliminary_completed_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    Pending Initiator Update Complete
                </div>
                <table>
                    <tr>
                        <th class="w-20">Pending Initiator Update Complete By</th>
                        <td class="w-30">@if($data->all_activities_completed_by){{ $data->all_activities_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Pending Initiator Update Complete On</th>
                        <td class="w-30">@if($data->all_activities_completed_on){{ $data->all_activities_completed_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Pending Initiator Update Complete Comment</th>
                        <td class="w-30">@if($data->all_activities_completed_comment){{ $data->all_activities_completed_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    QC Head/HOD Secondary Review Complete
                </div>
                <table>
                    <tr>
                        <th class="w-20">QC Head/HOD Secondary Review Complete By</th>
                        <td class="w-30">@if($data->review_completed_by){{ $data->review_completed_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Secondary Review Complete On</th>
                        <td class="w-30">@if($data->review_completed_on){{ $data->review_completed_on }}@else Not Applicable @endif</td>
                        <th class="w-20">QC Head/HOD Secondary Review Complete Comment</th>
                        <td class="w-30">@if($data->solution_validation_comment){{ $data->solution_validation_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    QA Secondary Review Complete
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Secondary Review Complete By</th>
                        <td class="w-30">@if($data->extended_inv_complete_by){{ $data->extended_inv_complete_by }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Secondary Review Complete On</th>
                        <td class="w-30">@if($data->extended_inv_complete_on){{ $data->extended_inv_complete_on }}@else Not Applicable @endif</td>
                        <th class="w-20">QA Secondary Review Complete Comment</th>
                        <td class="w-30">@if($data->extended_inv_comment){{ $data->extended_inv_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    Approved
                </div>
                <table>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">@if($data->no_assignable_cause_by){{ $data->no_assignable_cause_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">@if($data->no_assignable_cause_on){{ $data->no_assignable_cause_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Approved Comment</th>
                        <td class="w-30">@if($data->no_assignable_cause_comment){{ $data->no_assignable_cause_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>

                    <div class="block-head">
                    Cancel
                </div>
                <table>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">@if($data->cancell_comment){{ $data->cancell_comment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>
            </div>


        </div>
    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30"><strong>Printed On :</strong> {{ date('d-M-Y') }}</td>
                <td class="w-40"><strong>Printed By :</strong> {{ Auth::user()->name }}</td>
                {{-- <td class="w-30"><strong>Page :</strong> 1 of 1</td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>
