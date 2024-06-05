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
        height: 100px;
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
                    Market Complaint Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo1.png" alt="" class="w-100" width="40px" height="40px">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    {{-- <strong>Lab Incident No.</strong> --}}
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
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
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">{{ $data->initiator_group ?? 'Not Applicable' }}</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">{{ $data->initiator_group_code ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">If Other</th>
                        <td class="w-30">{{ $data->if_other_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-30">{{ $data->severity_level2 ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Incident Details</th>
                        <td class="w-30">{{ $data->Incident_Details ?? 'Not Applicable' }}</td>
                        <th class="w-20">If Other</th>
                        <td class="w-30">{{ $data->if_other_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Is Repeat</th>
                        <td class="w-30">{{ $data->is_repeat_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-30">{{ $data->repeat_nature_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">{{ $data->description_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Complaint</th>
                        <td class="w-30">{{ $data->complainant_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complaint Reported On</th>
                        <td class="w-30">{{ $data->complaint_reported_on_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Details Of Nature Market Complaint</th>
                        <td class="w-30">{{ $data->details_of_nature_market_complaint_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Categorization Of Complaint</th>
                        <td class="w-30">{{ $data->categorization_of_complaint_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Complaint Sample</th>
                        <td class="w-30">{{ $data->review_of_complaint_sample_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Batch Manufacturing Record (BMR)</th>
                        <td class="w-30">{{ $data->review_of_batch_manufacturing_record_BMR_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Raw Materials Used In Batch Manufacturing</th>
                        <td class="w-30">{{ $data->review_of_raw_materials_used_in_batch_manufacturing_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Batch Packing Record (BPR)</th>
                        <td class="w-30">{{ $data->review_of_Batch_Packing_record_bpr_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Packing Materials Used In Batch Packing</th>
                        <td class="w-30">{{ $data->review_of_packing_materials_used_in_batch_packing_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Analytical Data</th>
                        <td class="w-30">{{ $data->review_of_analytical_data_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Training Record Of Concern Persons</th>
                        <td class="w-30">{{ $data->review_of_training_record_of_concern_persons_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Equipment/Instrument Qualification & Calibration Record</th>
                        <td class="w-30">{{ $data->rev_eq_inst_qual_calib_record_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Equipment Breakdown And Maintenance Record</th>
                        <td class="w-30">{{ $data->review_of_equipment_break_down_and_maintainance_record_gi ?? 'Not Applicable' }}</td>
                        <th class="w-20">Review Of Past History Of Product</th>
                        <td class="w-30">{{ $data->review_of_past_history_of_product_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">
                            @if($data->initial_attachment_gi)
                                <a href="{{ asset('upload/' . $data->initial_attachment_gi) }}" target="_blank">{{ $data->initial_attachment_gi }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>



                   <tr>
                    <table class="table table-bordered" id="onservation-incident-table">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Row #</th>
                                <th>Product Name</th>
                                <th>Batch No.</th>
                                <th>Mfg. Date</th>
                                <th>Exp. Date</th>
                                <th>Batch Size</th>
                                <th>Pack Size</th>
                                <th>Dispatch Quantity</th>
                                <th>Remarks</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if($prductgigrid && $prductgigrid->data)
                                  @foreach ($prductgigrid->data as  $item)
                                  
                                  
                                 
                                        <tr>
                                {{-- <td style="width: 6%">{{ $item['serial'] }}</td> --}}
                               
                                  <td>{{ $item['info_product_name'] }}</td>
                                  <td>{{ $item['info_batch_no'] }}</td>
                                  <td>{{ $item['info_mfg_date'] }}</td>
                                  <td>{{ $item['info_expiry_date'] }}</td>
                                  <td>{{ $item['info_batch_size'] }}</td>
                                  <td>{{ $item['info_pack_size'] }}</td>
                                  <td> {{ $item['info_dispatch_quantity'] }}</td>
                                  <td>{{ $item['info_remarks'] }}</td>
                                 

                            </tr>
                            @endforeach
                            @else
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            @endif
                         </tbody>
                    </table>


                   </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    HOD/Suprervisor Review
                </div>
                <table>
                    {{-- <tr>
                        <th class="w-20">Invocation Type</th>
                        <td class="w-80">{{ $data->Invocation_Type ?? 'Not Applicable' }}</td>
                    </tr> --}}

                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-30">{{ $data->conclusion_hodsr ?? 'Not Applicable' }}</td>
                        <th class="w-20">Root Cause Analysis</th>
                        <td class="w-30">{{ $data->root_cause_analysis_hodsr ?? 'Not Applicable' }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Probable Root Causes</th>
                        <td class="w-30">{{ $data->probable_root_causes_complaint_hodsr ?? 'Not Applicable' }}</td>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-30">{{ $data->impact_assessment_hodsr ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective Action</th>
                        <td class="w-30">{{ $data->corrective_action_hodsr ?? 'Not Applicable' }}</td>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-30">{{ $data->preventive_action_hodsr ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Summary and Conclusion</th>
                        <td class="w-30">{{ $data->summary_and_conclusion_hodsr ?? 'Not Applicable' }}</td>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-30">{{ $data->comments_if_any_hodsr ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">
                            @if($data->initial_attachment_hodsr)
                                <a href="{{ asset('upload/' . $data->initial_attachment_hodsr) }}" target="_blank">{{ $data->initial_attachment_hodsr }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

{{-- 
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">{{ $data->Initial_Attachment ? '<a href="'.asset('upload/document/'.$data->Initial_Attachment).'">'.$data->Initial_Attachment.'</a>' : 'Not Applicable' }}</td>
                    </tr> --}}
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Complaint Acknowledgement
                </div>
                <table>




                    <tr>
                        <th class="w-20">Manufacturer Name Address</th>
                        <td class="w-30">{{ $data->manufacturer_name_address_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Complaint Sample Required</th>
                        <td class="w-30">{{ $data->complaint_sample_required_ca ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complaint Sample Status</th>
                        <td class="w-30">{{ $data->complaint_sample_status_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Brief Description of Complaint</th>
                        <td class="w-30">{{ $data->brief_description_of_complaint_ca ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Batch Record Review Observation</th>
                        <td class="w-30">{{ $data->batch_record_review_observation_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Analytical Data Review Observation</th>
                        <td class="w-30">{{ $data->analytical_data_review_observation_ca ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Retention Sample Review Observation</th>
                        <td class="w-30">{{ $data->retention_sample_review_observation_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Stability Study Data Review</th>
                        <td class="w-30">{{ $data->stability_study_data_review_ca ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QMS Events If Any Review Observation</th>
                        <td class="w-30">{{ $data->qms_events_ifany_review_observation_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Repeated Complaints Queries For Product</th>
                        <td class="w-30">{{ $data->repeated_complaints_queries_for_product_ca ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Interpretation on Complaint Sample If Received</th>
                        <td class="w-30">{{ $data->interpretation_on_complaint_sample_ifrecieved_ca ?? 'Not Applicable' }}</td>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-30">{{ $data->comments_ifany_ca ?? 'Not Applicable' }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">
                            @if($data->initial_attachment_ca)
                                <a href="{{ asset('upload/' . $data->initial_attachment_ca) }}" target="_blank">{{ $data->initial_attachment_ca }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                    {{-- <tr>
                        <th class="w-20">Incident Details</th>
                        <td class="w-80">{{ $data->Incident_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Document Details</th>
                        <td class="w-80">{{ $data->Document_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Instrument Details</th>
                        <td class="w-80">{{ $data->Instrument_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Involved Personnel</th>
                        <td class="w-80">{{ $data->Involved_Personnel ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Product Details, If Any</th>
                        <td class="w-80">{{ $data->Product_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Supervisor Review Comments</th>
                        <td class="w-80">{{ $data->Supervisor_Review_Comments ?? 'Not Applicable' }}</td>
                    </tr> --}}
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Closure
                </div>
                <table>

                    <tr>
                        <th class="w-20">Closure Comment</th>
                        <td class="w-30">{{ $data->closure_comment_c ?? 'Not Applicable' }}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">
                            @if($data->initial_attachment_c)
                                <a href="{{ asset('upload/' . $data->initial_attachment_c) }}" target="_blank">{{ $data->initial_attachment_c }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>
                    {{-- <tr>
                        <th class="w-50" colspan="2">Investigation Details</th>
                        <td class="w-50" colspan="2">{{ $data->Investigation_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-30">{{ $data->Action_Taken ?? 'Not Applicable' }}</td>
                        <th class="w-20">Root Cause</th>
                        <td class="w-30">{{ $data->Root_Cause ?? 'Not Applicable' }}</td>
                    </tr> --}}
                </table>
            </div>
            {{-- <div class="block">
                <div class="block-head">
                    CAPA
                </div>
                <table>
                    <tr>
                        <th class="w-20">Currective Action</th>
                        <td class="w-30">{{ $data->Currective_Action ?? 'Not Applicable' }}</td>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-30">{{ $data->Preventive_Action ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective & Preventive Action</th>
                        <td class="w-80">{{ $data->Corrective_Preventive_Action ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Review Comments</th>
                        <td class="w-30">{{ $data->QA_Review_Comments ?? 'Not Applicable' }}</td>
                        <th class="w-20">QA Head/Designee Comments</th>
                        <td class="w-30">{{ $data->QA_Head ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Incident Types</th>
                        <td class="w-30">{{ $data->Incident_Type ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-80" colspan="3">{{ $data->Conclusion ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-80" colspan="3">{{ $data->due_date_extension ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div> --}}
            {{-- <div class="block">
                <div class="block-head">
                    Attachments
                </div>
                <table>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">{{ $data->Initial_Attachment ? '<a href="'.asset('upload/document/'.$data->Initial_Attachment).'">'.$data->Initial_Attachment.'</a>' : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">{{ $data->Attachments ? '<a href="'.asset('upload/document/'.$data->Attachments).'">'.$data->Attachments.'</a>' : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Inv Attachment</th>
                        <td class="w-80">{{ $data->Inv_Attachment ? '<a href="'.asset('upload/document/'.$data->Inv_Attachment).'">'.$data->Inv_Attachment.'</a>' : 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Attachment</th>
                        <td class="w-80">{{ $data->CAPA_Attachment ? '<a href="'.asset('upload/document/'.$data->CAPA_Attachment).'">'.$data->CAPA_Attachment.'</a>' : 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div> --}}
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
                <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
