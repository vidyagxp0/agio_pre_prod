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
                    Lab Incident Single Report
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
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">{{$data->division?$data->division:'-'}}</td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@isset($data->assign_to) {{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endisset</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if(!empty($data->Initiator_Group)){{ $data->Initiator_Group }} @else Not Applicable  @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Severity Level</th>
                        <td class="w-30">@if(!empty($data->severity_level2)){{ $data->severity_level2 }} @else Not Applicable @endif</td>
                        <th class="w-20">Incident Details</th>
                        <td class="w-30">@if($data->incident_involved_others_gi){{ $data->incident_involved_others_gi }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30" colspan="3">
                            @if($data->short_desc){{ $data->short_desc }}@else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Stage</th>
                        <td class="w-30">@if($data->stage_stage_gi){{ $data->stage_stage_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Stability Condition</th>
                        <td class="w-30">@if($data->incident_stability_cond_gi){{ $data->incident_stability_cond_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Interval</th>
                        <td class="w-30">@if($data->incident_interval_others_gi){{ $data->incident_interval_others_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Test</th>
                        <td class="w-30">@if($data->test_gi){{ $data->test_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Date Of Analysis</th>
                        <td class="w-30">@if($data->incident_date_analysis_gi){{ $data->incident_date_analysis_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Specification Number</th>
                        <td class="w-30">@if($data->incident_specification_no_gi){{ $data->incident_specification_no_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">STP Number</th>
                        <td class="w-30">@if($data->incident_stp_no_gi){{ $data->incident_stp_no_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Name Of Analysis</th>
                        <td class="w-30">@if($data->Incident_name_analyst_no_gi){{ $data->Incident_name_analyst_no_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Date Of Incidence</th>
                        <td class="w-30">@if($data->incident_date_incidence_gi){{ $data->incident_date_incidence_gi }}@else Not Applicable @endif</td>
                        <th class="w-20">Description Of Incidence</th>
                        <td class="w-30">@if($data->description_incidence_gi){{ $data->description_incidence_gi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">@if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                        <th class="w-20">Section Date</th>
                         <td class="w-30">@isset($data->section_sign_date_gi) {{ Helpers::getInitiatorName($data->section_sign_date_gi) }} @else Not Applicable @endisset</td>

                    </tr>
                    <tr>
                        <th class="w-20">Invocation Type</th>
                        <td class="w-30">@if($data->Invocation_Type){{ $data->Invocation_Type }}@else Not Applicable @endif</td>
                        <th class="w-20">Analyst Date</th>
                        <td class="w-30">@isset($data->analyst_sign_date_gi) {{ Helpers::getInitiatorName($data->analyst_sign_date_gi) }} @else Not Applicable @endisset</td>
                        
                        </tr>
                    <tr>
                        <th class="w-20">Other Ref.Doc.No</th>
                        <td class="w-30">@if($data->Other_Ref){{ $data->Other_Ref }}@else Not Applicable @endif</td>
                        <th class="w-20">Incident Category</th>
                        <td class="w-30">@if($data->Incident_Category){{ $data->Incident_Category }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->Incident_Category_others){{ $data->Incident_Category_others }}@else Not Applicable @endif</td>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">@if($data->attachments_gi)<a href="{{ asset('upload/document/',$data->attachments_gi) }}">{{ $data->attachments_gi }}</a>@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Immediate Action
                </div>
                <table>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-30">@if($data->immediate_action_ia){{ $data->immediate_action_ia }}@else Not Applicable @endif</td>
                        <th class="w-20">Analyst Date</th>
                        <td class="w-30">@if($data->immediate_date_ia){{ $data->immediate_date_ia }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Section Date</th>
                        <td class="w-30">@if($data->section_date_ia){{ $data->section_date_ia }}@else Not Applicable @endif</td>
                        <th class="w-20">Detail Investigation</th>
                        <td class="w-30">{{ $data->details_investigation_ia }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed Corrective Action</th>
                        <td class="w-30">{{ $data->proposed_correctivei_ia }}</td>
                        <th class="w-20">Repeat Analysis Plan</th>
                        <td class="w-30">@if($data->repeat_analysis_plan_ia){{ $data->repeat_analysis_plan_ia }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Investigator</th>
                        <td class="w-30">@isset($data->investigator_qc) {{ Helpers::getInitiatorName($data->investigator_qc) }} @else Not Applicable @endisset</td>
                         <th class="w-20">QC Review</th>
                       {{-- <td class="w-30">@if($data->qc_review_to){{ $data->qc_review_to }}@else Not Applicable @endif</td> --}}
                       <td class="w-30">@isset($data->qc_review_to) {{ Helpers::getInitiatorName($data->qc_review_to) }} @else Not Applicable @endisset</td>

                    </tr>
                    <tr>
                        <th class="w-20">Result Of Repeat Analysis</th>
                        <td class="w-30">@if($data->result_of_repeat_analysis_ia){{ $data->result_of_repeat_analysis_ia }}@else Not Applicable @endif</td>
                        <th class="w-20">Corrective and Preventive Action</th>
                        <td class="w-30">@if($data->corrective_and_preventive_action_ia){{ $data->corrective_and_preventive_action_ia }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Number</th>
                        <td class="w-30">@if($data->capa_number_im){{ $data->capa_number_im }}@else Not Applicable @endif</td>
                        <th class="w-20">Investigation Summary</th>
                        <td class="w-30">@if($data->investigation_summary_ia){{ $data->investigation_summary_ia }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Type Of Incidence</th>
                        <td class="w-30">@if($data->type_incidence_ia){{ $data->type_incidence_ia }}@else Not Applicable @endif</td>
                        <th class="w-20">Attachments</th>
                        <td class="w-30">@if($data->attachments_ia)<a href="{{ asset('upload/document/',$data->attachments_ia) }}">{{ $data->attachments_ia }}</a>@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>


            @foreach ($labtab as $singlereport)
            <div class="block">
                <div class="block-head">
                    System Suitability Failure Incidence
                </div>
                <table>
                    <tr>
                        <th class="w-20">Instrument Involved</th>
                        <td class="w-30">@if($singlereport->involved_ssfi){{ $singlereport->involved_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">Stage</th>
                        <td class="w-30">{{ $singlereport->stage_stage_ssfi }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Stability Condition</th>
                        <td class="w-30">@if($singlereport->Incident_stability_cond_ssfi){{ $singlereport->Incident_stability_cond_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">Interval</th>
                        <td class="w-30">@if($singlereport->Incident_interval_ssfi){{ $singlereport->Incident_interval_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Test</th>
                        <td class="w-30">@if($singlereport->test_ssfi){{ $singlereport->test_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">Date Of Analysis</th>
                        <td class="w-30">@if($singlereport->Incident_date_analysis_ssfi){{ $singlereport->Incident_date_analysis_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Specification Number</th>
                        <td class="w-30">@if($singlereport->Incident_specification_ssfi){{ $singlereport->Incident_specification_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">STP Number</th>
                        <td class="w-30">@if($singlereport->Incident_stp_ssfi){{ $singlereport->Incident_stp_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Date Of Incidence</th>
                        <td class="w-30">@if($singlereport->Incident_date_incidence_ssfi){{ $singlereport->Incident_date_incidence_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">Description Of Incidence</th>
                        <td class="w-30">@if($singlereport->Description_incidence_ssfi){{ $singlereport->Description_incidence_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">QC Reviewer</th>
                        <td class="w-30">@isset($data->suit_qc_review_to) {{ Helpers::getInitiatorName($data->suit_qc_review_to) }} @else Not Applicable @endisset</td>
                        
                        <th class="w-20">Detail Investigation</th>
                        <td class="w-30">@if($singlereport->Detail_investigation_ssfi){{ $singlereport->Detail_investigation_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed Corrective Action</th>
                        <td class="w-30">@if($singlereport->proposed_corrective_ssfi){{ $singlereport->proposed_corrective_ssfi }}@else Not Applicable @endif</td>
                        <th class="w-20">Root Cause</th>
                        <td class="w-30">@if($singlereport->root_cause_ssfi){{ $singlereport->root_cause_ssfi }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Incident Summary</th>
                        <td class="w-30">@if($singlereport->incident_summary_ssfi){{ $singlereport->incident_summary_ssfi }}@else Not Applicable @endif</td>
                        
                         
                    </tr>
                    <tr>
                        <th class="w-20">System Suitability Attachment</th>
                        <td class="w-30">@if($singlereport->system_suitable_attachments)<a href="{{ asset('upload/document/',$singlereport->system_suitable_attachments) }}">{{ $singlereport->system_suitable_attachments }}</a>@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>

            <div class="block-head">
                Closure
            </div>
            <table>
                <tr>
                    <th class="w-20">Closure Of Incident</th>
                    <td class="w-30">@if($singlereport->closure_incident_c){{ $singlereport->closure_incident_c }}@else Not Applicable @endif</td>
                    <th class="w-20">QC Head Remark</th>
                    <td class="w-30">@if($singlereport->qc_hear_remark_c){{ $singlereport->qc_hear_remark_c }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">QC Head Closure</th>
                    {{-- <td class="w-30">@if($data->assign_to){{ $data->assign_to }}@else Not Applicable @endif</td> --}}
                    <td class="w-30">@isset($data->qc_head_closure) {{ Helpers::getInitiatorName($data->qc_head_closure) }} @else Not Applicable @endisset</td>

                    <th class="w-20">QA Head Remark</th>
                    <td class="w-30">@if($singlereport->qa_hear_remark_c){{ $singlereport->qa_hear_remark_c }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">System Suitability Attachment</th>
                    <td class="w-30">@if($singlereport->closure_attachment_c)<a href="{{ asset('upload/document/',$singlereport->closure_attachment_c) }}">{{ $singlereport->closure_attachment_c }}</a>@else Not Applicable @endif</td>
                    <th class="w-20">Conclusion QA Head/Designee</th>
                    <td class="w-30" colspan="3">@if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif</td>
                </tr>
               
                
            </table>
            @endforeach

            <div class="block">
                <div class="block-head">
                    Attachments
                </div>
                <table>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">@if($data->Initial_Attachment)<a href="{{ asset('upload/document/',$data->Initial_Attachment) }}">{{ $data->Initial_Attachment }}</a>@else Not Applicable @endif</td>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">@if($data->Attachments)<a href="{{ asset('upload/document/',$data->Attachments) }}">{{ $data->Attachments }}</a>@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th class="w-20">Inv Attachment</th>
                        <td class="w-80">@if($data->Inv_Attachment)<a href="{{ asset('upload/document/',$data->Inv_Attachment) }}">{{ $data->Inv_Attachment }}</a>@else Not Applicable @endif</td>
                        <th class="w-20">CAPA Attachment</th>
                        <td class="w-80">@if($data->CAPA_Attachment)<a href="{{ asset('upload/document/',$data->CAPA_Attachment) }}">{{ $data->CAPA_Attachment }}</a>@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By</th>
                        <td class="w-30">{{ $data->submitted_by }}</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30">{{ $data->submitted_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Incident Review Completed By</th>
                        <td class="w-30">{{ $data->incident_review_completed_by }}</td>
                        <th class="w-20">Incident Review Completed On</th>
                        <td class="w-30">{{ $data->incident_review_completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Investigation Completed By</th>
                        <td class="w-30">{{ $data->investigation_completed_by }}</td>
                        <th class="w-20">Investigation Completed On</th>
                        <td class="w-30">{{ $data->investigation_completed_on}}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Review Completed By</th>
                        <td class="w-30">{{ $data->qA_review_completed_by }}</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">{{ $data->qA_review_completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Head Approval Completed By</th>
                        <td class="w-30">{{ $data->qA_head_approval_completed_by }}</td>
                        <th class="w-20">QA Head Approval Completed On</th>
                        <td class="w-30">{{ $data->qA_head_approval_completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">All Activities Completed By</th>
                        <td class="w-30">{{ $data->all_activities_completed_by }}</td>
                        <th class="w-20">All Activities Completed On</th>
                        <td class="w-30">{{ $data->all_activities_completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ $data->cancelled_on }}</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Incident Investigation Report
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-25">Sr. No.</th>
                            <th class="w-25">Name of Product</th>
                            <th class="w-25">B No./A.R. No.</th>
                            <th class="w-25">Remarks</th>
                        </tr>
                        @php $investreport = 1; @endphp
                        @foreach ($labgrid->data as $item)
                        <tr>
                            <td class="w-15">{{ $investreport++ }}</td>
                            <td class="w-15">{{ $item['name_of_product'] }}</td>
                            <td class="w-15">{{ $item['batch_no'] }}</td>
                            <td class="w-15">{{ $item['remarks'] }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="block">
                <div class="block-head">
                    System Suitability Failure Report
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-25">Sr. No.</th>
                            <th class="w-25">Name of Product</th>
                            <th class="w-25">B No./A.R. No.</th>
                            <th class="w-25">Remarks</th>
                        </tr>
                        @php $singlereport = 1; @endphp
                        @foreach ($labtab_grid->data as $itm)
                        <tr>
                            <td class="w-15">{{ $singlereport++ }}</td>
                            <td class="w-15">{{ $itm['name_of_product_ssfi'] }}</td>
                            <td class="w-15">{{ $itm['batch_no_ssfi'] }}</td>
                            <td class="w-15">{{ $item['remarks']}}</td>

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="block">
               <div class="block-head">
                    Incident Details
                </div>
                <table>
                <tr>
                    
                            <th class="w-20">Incident Details</th>
                            <td class="w-30">@if($data->Incident_Details){{ $data->Incident_Details }}@else Not Applicable @endif</td>
                            <th class="w-20">Analyst Date</th>
                            <td class="w-30">@if($data->Document_Details){{ $data->Document_Details }}@else Not Applicable @endif</td>

                        
        
        
        
                    
                 </tr>
                 <tr>
                    

                    <th class="w-20">Instrument Details</th>
                    <td class="w-30">@if($data->Instrument_Details){{ $data->Instrument_Details }}@else Not Applicable @endif</td>
                    <th class="w-20">Involved Personnel</th>
                    <td class="w-30">@if($data->Involved_Personnel){{ $data->Involved_Personnel }}@else Not Applicable @endif</td>
                         
         </tr>
         <tr>
                    

            <th class="w-20">Product Details,If Any</th>
            <td class="w-30">@if($data->Product_Details){{ $data->Product_Details }}@else Not Applicable @endif</td>
            <th class="w-20">Supervisor Review Comments</th>
            <td class="w-30">@if($data->Supervisor_Review_Comments){{ $data->Supervisor_Review_Comments }}@else Not Applicable @endif</td>
                 
 </tr>
 <tr>
                        <th>Incident Details Attachment</th>
                        <td class="w-80">@if($data->ccf_attachments)<a href="{{ asset('upload/document/',$data->ccf_attachments) }}">{{ $data->ccf_attachments }}</a>@else Not Applicable @endif</td>

 </tr>
                </table>

                <div class="block">

                    <div class="block-head">
                        Investigation Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Investigation Details</th>
                            <td class="w-30">@if($data->Investigation_Details){{ $data->Investigation_Details }}@else Not Applicable @endif</td>
                            <th class="w-20">Action Taken</th>
                             <td class="w-30">@if($data->Action_Taken){{ $data->Action_Taken }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Root Cause</th>
                            <td class="w-30">@if($data->Root_Cause){{ $data->Root_Cause }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>

                <div class="block">

                    <div class="block-head">
                        Capa
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Capa</th>
                            <td class="w-30">@if($data->capa_capa){{ $data->capa_capa }}@else Not Applicable @endif</td>
                            <th class="w-20">Currective Action</th>
                             <td class="w-30">@if($data->Currective_Action){{ $data->Currective_Action }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Preventive Action</th>
                            <td class="w-30">@if($data->Preventive_Action){{ $data->Preventive_Action }}@else Not Applicable @endif</td>

                            <th class="w-20">Corrective & Preventive Action</th>
                            <td class="w-30">@if($data->Corrective_Preventive_Action){{ $data->Corrective_Preventive_Action }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>

                <div class="block">

                    <div class="block-head">
                        QA Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Review Comments</th>
                            <td class="w-30">@if($data->QA_Review_Comments){{ $data->QA_Review_Comments }}@else Not Applicable @endif</td>
                            <th class="w-20">QA Review Attachment</th>
                        <td class="w-80">@if($data->QA_Head_Attachment)<a href="{{ asset('upload/document/',$data->QA_Head_Attachment) }}">{{ $data->QA_Head_Attachment }}</a>@else Not Applicable @endif</td>

                             </tr>
                        
                    </table>
                </div>

                <div class="block">

                    <div class="block-head">
                        QA Head/Designee Approval
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Head/Designee Comments</th>
                            <td class="w-30">@if($data->QA_Head){{ $data->QA_Head }}@else Not Applicable @endif</td>
                            <th class="w-20">Incident Type</th>
                            <td class="w-30">@if($data->Incident_Type)<a href="{{ asset('upload/document/',$data->Incident_Type) }}">{{ $data->Incident_Type }}</a>@else Not Applicable @endif</td>
                            <th class="w-20">Conclusion</th>
                            <td class="w-30">@if($data->Conclusion){{ $data->Conclusion }}@else Not Applicable @endif</td>
                             </tr>
                             
                        
                    </table>
                </div>


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
