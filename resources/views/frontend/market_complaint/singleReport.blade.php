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

                    {{--  <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80">{{ $data->Initial_Attachment ? '<a href="'.asset('upload/document/'.$data->Initial_Attachment).'">'.$data->Initial_Attachment.'</a>' : 'Not Applicable' }}</td>
                    </tr> --}}
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    CFT Review
                </div>
                <div class="block-head">Production (Table/Capsule/Powder)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Review Required</th>
                        <td class="w-30">@if($data1->Production_Review) {{  $data1->Production_Table_Review }}@else Not Applicable @endif</td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Person</th>
                        <td class="w-30">@if($data1->Production_Table_Person){{ $data1->Production_Table_Person}}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Assesment</th>
                        <td class="w-30">@if($data1->Production_Table_Assessment){{ strip_tags($data1->Production_Table_Assessment)  }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Feedback</th>
                        <td class="w-30">@if($data1->Production_Table_Feedback){{  strip_tags($data1->Production_Table_Feedback) }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production by</th>
                        <td class="w-30">@if($data1->Production_Table_By){{ $data1->Production_Table_By }}@else Not Applicable @endif</td>
                        <th class="w-20">Production on</th>
                        <td class="w-30">@if($data1->Production_Table_On){{ $data1->Production_Table_On}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Table Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Production_Table_Attachment)
                                @foreach(json_decode($data1->Production_Table_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Production Injection</div>
                <table>
                    <tr>
                        <th class="w-20">Production Injection Review</th>
                        <td class="w-30">@if($data1->Production_Injection_Review) {{  $data1->Production_Injection_Review }}@else Not Applicable @endif</td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-30">@if($data1->Production_Injection_Person){{ $data1->Production_Injection_Person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Assesment</th>
                        <td class="w-80">@if($data1->Production_Injection_Assessment){{ strip_tags($data1->Production_Injection_Assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-80">@if($data1->Production_Injection_Feedback){{  strip_tags($data1->Production_Injection_Feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Injection by</th>
                        <td class="w-30">@if($data1->Production_Injection_By){{ $data1->Production_Injection_By }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Injection  on</th>
                        <td class="w-30">@if($data1->Production_Injection_On){{ $data1->Production_Injection_On}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Injection Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Production_Injection_Attachment)
                                @foreach(json_decode($data1->Production_Injection_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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


                <div class="block-head">Research & Development</div>
                <table>
                    <tr>
                        <th class="w-20">Research Development Required </th>
                        <td class="w-30">@if($data1->ResearchDevelopment_Review) {{  $data1->ResearchDevelopment_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Reasearch & Developmemt Person</th>
                        <td class="w-30">@if($data1->Human_Resource_person){{ $data1->Production_Injection_Person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Research Development)</th>
                        <td class="w-80">@if($data1->ResearchDevelopment_assessment){{ strip_tags($data1->ResearchDevelopment_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Feedback</th>
                        <td class="w-80">@if($data1->ResearchDevelopment_feedback){{  strip_tags($data1->ResearchDevelopment_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Completed by</th>
                        <td class="w-30">@if($data1->ResearchDevelopment_by){{ $data1->ResearchDevelopment_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Reasearch & Development Completed  on</th>
                        <td class="w-30">@if($data1->ResearchDevelopment_on){{ $data1->ResearchDevelopment_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Reasearch & Development Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->ResearchDevelopment_attachment)
                                @foreach(json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Human Resource</div>
                <table>
                    <tr>
                        <th class="w-20">Human Resource Reveiw</th>
                        <td class="w-30">@if($data1->Human_Resource_review) {{  $data1->Human_Resource_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Humane Resource Person</th>
                        <td class="w-30">@if($data1->Human_Resource_person){{ $data1->Production_Injection_Person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Humane Resource)</th>
                        <td class="w-80">@if($data1->Human_Resource_assessment){{ strip_tags($data1->Human_Resource_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Humane Resource Feedback</th>
                        <td class="w-80">@if($data1->Human_Resource_feedback){{  strip_tags($data1->Human_Resource_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Humane Resource Completed by</th>
                        <td class="w-30">@if($data1->Human_Resource_by){{ $data1->Human_Resource_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Humane Resource Completed  on</th>
                        <td class="w-30">@if($data1->Human_Resource_on){{ $data1->Human_Resource_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                         Human Resource  Attechment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Human_Resource_attachment)
                                @foreach(json_decode($data1->Human_Resource_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Corporate Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Corporate Quality Assurance Reveiw</th>
                        <td class="w-30">@if($data1->CorporateQualityAssurance_Review) {{  $data1->CorporateQualityAssurance_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Corporate Quality Assurance Person</th>
                        <td class="w-30">@if($data1->CorporateQualityAssurance_person){{ $data1->CorporateQualityAssurance_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Corporate Quality Assurance)</th>
                        <td class="w-80">@if($data1->CorporateQualityAssurance_assessment){{ strip_tags($data1->CorporateQualityAssurance_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Feedback</th>
                        <td class="w-80">@if($data1->CorporateQualityAssurance_feedback){{  strip_tags($data1->CorporateQualityAssurance_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Completed by</th>
                        <td class="w-30">@if($data1->CorporateQualityAssurance_by){{ $data1->CorporateQualityAssurance_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Corporate Quality Assurance  on</th>
                        <td class="w-30">@if($data1->CorporateQualityAssurance_on){{ $data1->CorporateQualityAssurance_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                         Corporate Quality Assurance Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->CorporateQualityAssurance_attachment)
                                @foreach(json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Stores</div>
                <table>
                    <tr>
                        <th class="w-20">Store Reveiw</th>
                        <td class="w-30">@if($data1->Store_Review) {{  $data1->Store_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Store  Person</th>
                        <td class="w-30">@if($data1->Store_person){{ $data1->Store_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Store)</th>
                        <td class="w-80">@if($data1->Store_assessment){{ strip_tags($data1->Store_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Store Feedback</th>
                        <td class="w-80">@if($data1->Store_feedback){{  strip_tags($data1->Store_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Store Completed by</th>
                        <td class="w-30">@if($data1->Store_by){{ $data1->Store_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Store Assurance  on</th>
                        <td class="w-30">@if($data1->Store_on){{ $data1->Store_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                         Store
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->store_attachment)
                                @foreach(json_decode($data1->store_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Engineering</div>
                <table>
                    <tr>
                        <th class="w-20">Engineering Review</th>
                        <td class="w-30">@if($data1->Engineering_review) {{  $data1->Engineering_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Engineering Person</th>
                        <td class="w-30">@if($data1->Engineering_person){{ $data1->Engineering_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Engineering Assessment (By Engineering)</th>
                        <td class="w-80">@if($data1->Engineering_assessment){{ strip_tags($data1->Engineering_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Engineering Feedback</th>
                        <td class="w-80">@if($data1->Engineering_feedback){{  strip_tags($data1->Engineering_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Engineering Completed by</th>
                        <td class="w-30">@if($data1->Engineering_by){{ $data1->Engineering_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Engineering Completed  on</th>
                        <td class="w-30">@if($data1->Store_on){{ $data1->Store_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                         Engineering Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Engineering_attachment)
                                @foreach(json_decode($data1->Engineering_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Regulatory Affair</div>
                <table>
                    <tr>
                        <th class="w-20">Regulatory affair Review</th>
                        <td class="w-30">@if($data1->RegulatoryAffair_Review) {{  $data1->RegulatoryAffair_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Regularory Affair Person</th>
                        <td class="w-30">@if($data1->RegulatoryAffair_person){{ $data1->RegulatoryAffair_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Assessment</th>
                        <td class="w-80">@if($data1->RegulatoryAffair_assessment){{ strip_tags($data1->RegulatoryAffair_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Feedback</th>
                        <td class="w-80">@if($data1->RegulatoryAffair_feedback){{  strip_tags($data1->RegulatoryAffair_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Completed by</th>
                        <td class="w-30">@if($data1->RegulatoryAffair_by){{ $data1->RegulatoryAffair_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Regulatory Affair Completed  on</th>
                        <td class="w-30">@if($data1->RegulatoryAffair_on){{ $data1->RegulatoryAffair_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                         Regularory Affair Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->RegulatoryAffair_attechment)
                                @foreach(json_decode($data1->RegulatoryAffair_attechment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Assurance Review</th>
                        <td class="w-30">@if($data1->Quality_Assurance_Review) {{  $data1->Quality_Assurance_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Assurance Person</th>
                        <td class="w-30">@if($data1->QualityAssurance_person){{ $data1->QualityAssurance_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Assessment (By Quality assurance)</th>
                        <td class="w-80">@if($data1->QualityAssurance_assessment){{ strip_tags($data1->QualityAssurance_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Feedback</th>
                        <td class="w-80">@if($data1->QualityAssurance_feedback){{  strip_tags($data1->QualityAssurance_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Completed by</th>
                        <td class="w-30">@if($data1->QualityAssurance_by){{ $data1->QualityAssurance_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Assurance Completed  on</th>
                        <td class="w-30">@if($data1->QualityAssurance_on){{ $data1->QualityAssurance_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Assurance Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Quality_Assurance_attachment)
                                @foreach(json_decode($data1->Quality_Assurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Production (Liquid/Ointment)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Liquid Review</th>
                        <td class="w-30">@if($data1->ProductionLiquid_Review) {{  $data1->ProductionLiquid_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Liquid Person</th>
                        <td class="w-30">@if($data1->ProductionLiquid_person){{ $data1->ProductionLiquid_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Assessment (By Production Liquid)</th>
                        <td class="w-80">@if($data1->ProductionLiquid_assessment){{ strip_tags($data1->ProductionLiquid_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Feedback</th>
                        <td class="w-80">@if($data1->ProductionLiquid_feedback){{  strip_tags($data1->ProductionLiquid_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Completed by</th>
                        <td class="w-30">@if($data1->ProductionLiquid_by){{ $data1->ProductionLiquid_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Liquid Completed  on</th>
                        <td class="w-30">@if($data1->ProductionLiquid_on){{ $data1->ProductionLiquid_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Liquid Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->ProductionLiquid_attachment)
                                @foreach(json_decode($data1->ProductionLiquid_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Quality Control</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Control  Review</th>
                        <td class="w-30">@if($data1->Quality_review) {{  $data1->Quality_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Control Person</th>
                        <td class="w-30">@if($data1->Quality_Control_Person){{ $data1->Quality_Control_Person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Assessment (By Quality Control)</th>
                        <td class="w-80">@if($data1->Quality_Control_assessment){{ strip_tags($data1->Quality_Control_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Feedback</th>
                        <td class="w-80">@if($data1->Quality_Control_feedback){{  strip_tags($data1->Quality_Control_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Completed by</th>
                        <td class="w-30">@if($data1->Quality_Control_by){{ $data1->Quality_Control_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Production Liquid Completed  on</th>
                        <td class="w-30">@if($data1->Quality_Control_on){{ $data1->Quality_Control_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Control Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Quality_Control_attachment)
                                @foreach(json_decode($data1->Quality_Control_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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


                <div class="block-head">Microbiology</div>
                <table>
                    <tr>
                        <th class="w-20">Microbiology Review</th>
                        <td class="w-30">@if($data1->Microbiology_Review) {{  $data1->Microbiology_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Microbiology Person</th>
                        <td class="w-30">@if($data1->Microbiology_person){{ $data1->Microbiology_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Assessment (By Quality Control)</th>
                        <td class="w-80">@if($data1->Microbiology_assessment){{ strip_tags($data1->Microbiology_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Feedback</th>
                        <td class="w-80">@if($data1->Microbiology_feedback){{  strip_tags($data1->Microbiology_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Microbiology  Completed by</th>
                        <td class="w-30">@if($data1->Microbiology_by){{ $data1->Microbiology_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Microbiology Completed  on</th>
                        <td class="w-30">@if($data1->Microbiology_on){{ $data1->Microbiology_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Microbiology Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Microbiology_attachment)
                                @foreach(json_decode($data1->Microbiology_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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

                <div class="block-head">Safety</div>
                <table>
                    <tr>
                        <th class="w-20">Environment Health Review</th>
                        <td class="w-30">@if($data1->Environment_Health_review) {{  $data1->Environment_Health_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Environment Health Person</th>
                        <td class="w-30">@if($data1->Environment_Health_Safety_person){{ $data1->Environment_Health_Safety_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Envinronment Helath Assessment</th>
                        <td class="w-80">@if($data1->Health_Safety_assessment){{ strip_tags($data1->Health_Safety_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Envinronment Health Feedback</th>
                        <td class="w-80">@if($data1->Health_Safety_feedback){{  strip_tags($data1->Health_Safety_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Environment Health Completed by</th>
                        <td class="w-30">@if($data1->Environment_Health_Safety_by){{ $data1->Environment_Health_Safety_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Environment Health Completed  on</th>
                        <td class="w-30">@if($data1->Environment_Health_Safety_on){{ $data1->Environment_Health_Safety_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Environment Helath Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->Environment_Health_Safety_attachment)
                                @foreach(json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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


                <div class="block-head">Contract Giver/Other</div>
                <table>
                    <tr>
                        <th class="w-20">Contract Giver Review</th>
                        <td class="w-30">@if($data1->ContractGiver_Review) {{  $data1->ContractGiver_Review }}@else Not Applicable @endif</td>
                        <th class="w-20">Contract Giver Person</th>
                        <td class="w-30">@if($data1->ContractGiver_person){{ $data1->Environment_Health_Safety_person}}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20"> Contract Giver Assessment</th>
                        <td class="w-80">@if($data1->ContractGiver_assessment){{ strip_tags($data1->ContractGiver_assessment)  }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Contract Giver Feedback</th>
                        <td class="w-80">@if($data1->ContractGiver_feedback){{  strip_tags($data1->ContractGiver_feedback) }}@else Not Applicable @endif</td>

                    </tr>

                    <tr>
                        <th class="w-20">Contract Giver Completed by</th>
                        <td class="w-30">@if($data1->ContractGiver_by){{ $data1->ContractGiver_by }}@else Not Applicable @endif</td>
                        <th class="w-20">Contract Giver Completed  on</th>
                        <td class="w-30">@if($data1->ContractGiver_on){{ $data1->ContractGiver_on}}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Contract Giver Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if($data1->ContractGiver_attachment)
                                @foreach(json_decode($data1->ContractGiver_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
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
