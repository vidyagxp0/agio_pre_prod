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

    .w-80 {
        width: 80%;
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
        margin-bottom: 80px;
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
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt=""
                            class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-80">
                    <strong>MarketComplaint No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/MC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-80">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-80">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-80">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head" style="margin-top: 50px;">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-80">{{ $data->originator }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        {{-- <td class="w-80">{{ $data->initiator_group ?? 'Not Applicable' }}</td> --}}
                        @php
                            $departments = [
                                'CQA' => 'Corporate Quality Assurance',
                                'QAB' => 'Quality Assurance Biopharma',
                                'CQC' => 'Central Quality Control',
                                'PSG' => 'Plasma Sourcing Group',
                                'CS' => 'Central Stores',
                                'ITG' => 'Information Technology Group',
                                'MM' => 'Molecular Medicine',
                                'CL' => 'Central Laboratory',
                                'TT' => 'Tech Team',
                                'QA' => 'Quality Assurance',
                                'QM' => 'Quality Management',
                                'IA' => 'IT Administration',
                                'ACC' => 'Accounting',
                                'LOG' => 'Logistics',
                                'SM' => 'Senior Management',
                                'BA' => 'Business Administration',
                            ];
                        @endphp
                        <td class="w-80">{{ $departments[$data->initiator_group] ?? 'Unknown Department' }}</td>

                        <th class="w-20">Initiator Group Code</th>
                        {{-- <td class="w-80">{{ $data->initiator_group ?? 'Not Applicable' }}</td> --}}
                        <td class="w-80">{{ $data->initiator_group_code_gi ?? 'Not Applicable' }}</td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">If Other</th>
                        <td class="w-80">{!! $data->if_other_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-80">{{  Helpers::getdateFormat($data->due_date_gi) ?? 'Not Applicable' }}</td>


                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{!! $data->repeat_nature_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">{{ $data->description_gi ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Severity Level</th>
                        <td class="w-80">{!! $data->severity_level2 ?? 'Not Applicable' !!}</td>
                        <th class="w-20">Incident Details</th>
                        <td class="w-80">{{ $data->Incident_Details ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Is Repeat</th>
                        <td class="w-80">{{ $data->is_repeat_gi ?? 'Not Applicable' }}</td>

                        <th class="w-20">Complaint</th>
                        <td class="w-80">{{ $data->complainant_gi ?? 'Not Applicable' }}</td>

                    </tr>
                </table>


                <table>
                    <tr>
                        <th class="w-20">Details Of Nature Market Complaint</th>
                        <td class="w-80">{!! $data->details_of_nature_market_complaint_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Complaint Reported On</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->complaint_reported_on_gi) ?? 'Not Applicable' }}</td>
                        <th class="w-20">Categorization Of Complaint</th>
                        <td class="w-80">{{ $data->categorization_of_complaint_gi ?? 'Not Applicable' }}</td>

                    </tr>
                </table>

                <table>
                    <tr>
                    <th class="w-20">Review Of Complaint Sample</th>
                        <td class="w-80">{!! $data->review_of_complaint_sample_gi ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Review Of Batch Manufacturing Record (BMR)</th>
                        <td class="w-80">{!! $data->review_of_batch_manufacturing_record_BMR_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Raw Materials Used In Batch Manufacturing</th>
                        <td class="w-80">{!! $data->review_of_raw_materials_used_in_batch_manufacturing_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Batch Packing Record (BPR)</th>
                        <td class="w-80">{!! $data->review_of_Batch_Packing_record_bpr_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Packing Materials Used In Batch Packing</th>
                        <td class="w-80">{!! $data->review_of_packing_materials_used_in_batch_packing_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Analytical Data</th>
                        <td class="w-80">{!! $data->review_of_analytical_data_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Training Record Of Concern Persons</th>
                        <td class="w-80">{!! $data->review_of_training_record_of_concern_persons_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Equipment/Instrument Qualification & Calibration Record</th>
                        <td class="w-80">{!! $data->rev_eq_inst_qual_calib_record_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Equipment Breakdown And Maintenance Record</th>
                        <td class="w-80">{!! $data->review_of_equipment_break_down_and_maintainance_record_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Past History Of Product</th>
                        <td class="w-80">{!! $data->review_of_past_history_of_product_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
                <table>

                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">
                            @if($data->initial_attachment_gi)
                                <a href="{{ asset('upload/' . $data->initial_attachment_gi) }}" target="_blank">{{ $data->initial_attachment_gi }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>



                   {{-- <tr>
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
{{--
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


                   </tr> --}}

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
                        <td class="w-80">{!! $data->conclusion_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Root Cause Analysis</th>
                        <td class="w-80">{!! $data->root_cause_analysis_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Probable Root Causes</th>
                        <td class="w-80">{!! $data->probable_root_causes_complaint_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-80">{!! $data->impact_assessment_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective Action</th>
                        <td class="w-80">{!! $data->corrective_action_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-80">{!! $data->preventive_action_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Summary and Conclusion</th>
                        <td class="w-80">{!! $data->summary_and_conclusion_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-80">{!! $data->comments_if_any_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">
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
                    CFT Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Production Table Required ?</th>
                        <td class="w-80">{!! $data->Production_Table_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Table Person</th>
                        <td class="w-80">{!! $data->Production_Table_Person ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Table Assessment (By Production)</th>
                        <td class="w-80">{!! $data->Production_Table_Assessment ?? 'Not Applicable' !!}</td>
                    </tr>


                    <tr>
                        <th class="w-20">Production Table Feedback</th>
                        <td class="w-80">{!! $data->Production_Table_Feedback ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Table Attachments</th>
                        <td class="w-80">
                            @if($data->initial_attachment_ca)
                                <a href="{{ asset('upload/' . $data->Production_Table_Attachment) }}" target="_blank">{{ $data->Production_Table_Attachment }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Review Table Completed By</th>
                        <td class="w-80">{{ $data->Production_Table_By ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Review Table Completed On</th>
                        <td class="w-80">{{ $data->Production_Table_On ?? 'Not Applicable' }}</td>
                    </tr>

                </table>


            </div>

            <div class="block">
                <div class="block-head">
                    Production Injection
                </div>
                <table>

                    <tr>
                        <th class="w-20">Production Injection Required ?</th>
                        <td class="w-80">{!! $data->Production_Injection_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-80">{!! $data->Production_Injection_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment (By Production  Injection)</th>
                        <td class="w-80">{!! $data->Production_Injection_Assessment ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-80">{!! $data->Production_Injection_Feedback ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection
                            Attachments</th>
                        <td class="w-80">
                            @if($data->Production_Injection_Attachment)
                                <a href="{{ asset('upload/' . $data->Production_Injection_Attachment) }}" target="_blank">{{ $data->Production_Injection_Attachment }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                     <tr>
                        <th class="w-20">Production Injection Completed
                            By</th>
                        <td class="w-80">{{ $data->Production_Injection_By ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Injection Completed On</th>
                        <td class="w-80">{{ $data->Production_Table_On ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Production Injection
                </div>
                <table>

                    <tr>
                        <th class="w-20">Production Injection Required ?</th>
                        <td class="w-80">{!! $data->Production_Injection_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-80">{!! $data->Production_Injection_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment (By Production  Injection)</th>
                        <td class="w-80">{!! $data->Production_Injection_Assessment ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-80">{!! $data->Production_Injection_Feedback ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection
                            Attachments</th>
                        <td class="w-80">
                            @if($data->Production_Injection_Attachment)
                                <a href="{{ asset('upload/' . $data->Production_Injection_Attachment) }}" target="_blank">{{ $data->Production_Injection_Attachment }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                     <tr>
                        <th class="w-20">Production Injection Completed
                            By</th>
                        <td class="w-80">{{ $data->Production_Injection_By ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Injection Completed On</th>
                        <td class="w-80">{{ $data->Production_Table_On ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>



            <div class="block">
                <div class="block-head">
                    Research & Development
                </div>
                <table>

                    <tr>
                        <th class="w-20">Research Development Required ?</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Research Development Person</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_person ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment (By Research Development Person)</th>
                        <td class="w-80">{!! $data->ResearchDevelopmentStore_person ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Research Development Feedback</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_feedback ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Research Development
                            Attachments</th>
                        <td class="w-80">
                            @if($data->ResearchDevelopment_attachment)
                                <a href="{{ asset('upload/' . $data->ResearchDevelopment_attachment) }}" target="_blank">{{ $data->ResearchDevelopment_attachment }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                     <tr>
                        <th class="w-20">Reaserch Development Completed
                            By</th>
                        <td class="w-80">{{ $data->ResearchDevelopment_by ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Research Development Completed On</th>
                        <td class="w-80">{{ $data->ResearchDevelopment_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Human Resource
                </div>
                <table>

                    <tr>
                        <th class="w-20">Human Resource Required ?</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_Review ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Research Development Person</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_person ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment (By Research Development Person)</th>
                        <td class="w-80">{!! $data->ResearchDevelopmentStore_person ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Research Development Feedback</th>
                        <td class="w-80">{!! $data->ResearchDevelopment_feedback ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Research Development
                            Attachments</th>
                        <td class="w-80">
                            @if($data->ResearchDevelopment_attachment)
                                <a href="{{ asset('upload/' . $data->ResearchDevelopment_attachment) }}" target="_blank">{{ $data->ResearchDevelopment_attachment }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr>

                     <tr>
                        <th class="w-20">Reaserch Development Completed
                            By</th>
                        <td class="w-80">{{ $data->ResearchDevelopment_by ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Research Development Completed On</th>
                        <td class="w-80">{{ $data->ResearchDevelopment_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Complaint Acknowledgement
                </div>
                <table>
                    <tr>
                        <th class="w-20">Manufacturer Name Address</th>
                        <td class="w-80">{!! $data->manufacturer_name_address_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complaint Sample Required</th>
                        <td class="w-80">{!! $data->complaint_sample_required_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complaint Sample Status</th>
                        <td class="w-80">{!! $data->complaint_sample_status_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Brief Description of Complaint</th>
                        <td class="w-80">{!! $data->brief_description_of_complaint_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Batch Record Review Observation</th>
                        <td class="w-80">{!! $data->batch_record_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Analytical Data Review Observation</th>
                        <td class="w-80">{!! $data->analytical_data_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Retention Sample Review Observation</th>
                        <td class="w-80">{!! $data->retention_sample_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Stability Study Data Review</th>
                        <td class="w-80">{!! $data->stability_study_data_review_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QMS Events If Any Review Observation</th>
                        <td class="w-80">{!! $data->qms_events_ifany_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeated Complaints Queries For Product</th>
                        <td class="w-80">{!! $data->repeated_complaints_queries_for_product_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Interpretation on Complaint Sample If Received</th>
                        <td class="w-80">{!! $data->interpretation_on_complaint_sample_ifrecieved_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-80">{!! $data->comments_ifany_ca ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">
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
                        <td class="w-80">{!! $data->closure_comment_c ?? 'Not Applicable' !!}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">
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
                        <td class="w-80">{{ $data->Action_Taken ?? 'Not Applicable' }}</td>
                        <th class="w-20">Root Cause</th>
                        <td class="w-80">{{ $data->Root_Cause ?? 'Not Applicable' }}</td>
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
                        <td class="w-80">{{ $data->Currective_Action ?? 'Not Applicable' }}</td>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-80">{{ $data->Preventive_Action ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective & Preventive Action</th>
                        <td class="w-80">{{ $data->Corrective_Preventive_Action ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Review Comments</th>
                        <td class="w-80">{{ $data->QA_Review_Comments ?? 'Not Applicable' }}</td>
                        <th class="w-20">QA Head/Designee Comments</th>
                        <td class="w-80">{{ $data->QA_Head ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Incident Types</th>
                        <td class="w-80">{{ $data->Incident_Type ?? 'Not Applicable' }}</td>
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
                        <td class="w-80">{{ $data->submitted_by }}</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-80">{{ $data->submitted_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complete Review By :</th>
                        <td class="w-80">{{  $data->complete_review_by }}</td>
                        <th class="w-20">Complete Review On :</th>
                        <td class="w-80">{{ $data->complete_review_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Investigation Completed By</th>
                        <td class="w-80">{{ $data->investigation_completed_by }}</td>
                        <th class="w-20">Investigation Completed On</th>
                        <td class="w-80">{{ $data->investigation_completed_on}}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Propose Plan By :</th>
                        <td class="w-80">{{ $data->propose_plan_by }}</td>
                        <th class="w-20">Propose Plan On :</th>
                        <td class="w-80">{{ $data->propose_plan_on }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">QA Head Approval Completed By</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_by }}</td>
                        <th class="w-20">QA Head Approval Completed On</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_on }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Approve Plan By</th>
                        <td class="w-80">{{ $data->approve_plan_by }}</td>
                        <th class="w-20">Approve Plan On</th>
                        <td class="w-80">{{ $data->approve_plan_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">All CAPA Closed By</th>
                        <td class="w-80">{{ $data->all_capa_closed_by }}</td>
                        <th class="w-20">All CAPA Closed On</th>
                        <td class="w-80">{{ $data->all_capa_closed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Closure Done By</th>
                        <td class="w-80">{{ $data->closed_done_by }}</td>
                        <th class="w-20">Closure Done On</th>
                        <td class="w-80">{{ $data->closed_done_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-80">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-80">{{ $data->cancelled_on }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>



