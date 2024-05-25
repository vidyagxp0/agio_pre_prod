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
                   Capa Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo1.png" alt="" class="w-30">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Capa No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) : '' }}
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

                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">@if($data->record_number){{  str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-80">{{ $data->initiator_group_code }}</td>

                     </tr>
                     <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-80">{{ $data->severity_level_form }}</td>


                    </tr>
                    <tr>
                    <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-80"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>

                    </tr>


                    <tr>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-80">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>

                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Problem Description</th>
                        <td class="w-80">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>

                    </tr>
                     <tr>
                        <th class="w-20">CAPA Team</th>
                        <td class="w-80">@if($data->capa_team){{  Helpers::getInitiatorName($data->capa_team) }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                            <th class="w-20">Reference Records</th>
                            <td class="w-80">@if($data->capa_related_record){{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif</td>

                        </tr>
                    <tr>
                        <th class="w-20">Initial Observation</th>
                        <td class="w-80">@if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif</td>
                        <th class="w-20">Interim Containnment</th>
                        <td class="w-80">@if($data->interim_containnment){{ $data->interim_containnment }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Containment Comments</th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">CAPA QA Comments</th>
                        <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                    </tr>
                <div class="block-head">
                       Capa Attachement
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

            <!-- <div class="block">
                <div class="head">

                    <table>
                        <tr>
                            <th class="w-20">CAPA Related Records</th>
                            <td class="w-80">@if($data->capa_related_record){{ $data->capa_related_record }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Reference Records</th>
                            <td class="w-80">@if($data->reference_record){{ $data->reference_record }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Initial Observation
                            </th>
                            <td class="w-80">@if($data->initial_observation){{ $data->initial_observation }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Assigned To
                            </th>
                            <td class="w-80">@if($data->assign_id){{ $data->assign_id }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Interim Containnment
                            </th>
                            <td class="w-80">@if($data->interim_containnment){{ $data->interim_containnment }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Containment Comments
                            </th>
                            <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">CAPA QA Comments
                            </th>
                            <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                        </tr>
                        <div class="block-head">
                       Capa Attachement
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
            </div> -->
            <!-- <div class="block">
                <div class="block-head">
                    Product Information
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-15">Product Name</th>
                            <th class="w-5">Batch No</th>
                            <th class="w-15">Manufacturing stage</th>
                            <th class="w-15">Stage Batch No</th>
                            {{-- <th class="w-15">Date Of Manufacturing</th>
                            <th class="w-15">Date Of Expiry</th>
                            <th class="w-15">Market</th> --}}
                        </tr>
                        @if($data->Product_Details->product_name)
                        @foreach (unserialize($data->Product_Details->product_name) as $key => $dataDemo)
                        <tr>
                            <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                            <td class="w-15">{{unserialize($data->Product_Details->batch_no)[$key] ?  unserialize($data->Product_Details->batch_no)[$key] : "Not Applicable" }}</td>
                            <td class="w-5">{{unserialize($data->Product_Details->mfg_date)[$key] ?  unserialize($data->Product_Details->mfg_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Product_Details->batch_desposition)[$key] ?  unserialize($data->Product_Details->batch_desposition)[$key] : "Not Applicable" }}</td>
                            {{-- <td class="w-15">{{unserialize($data->Product_Details->batch_status)[$key] ?  unserialize($data->Product_Details->batch_status)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Product_Details->expiry_date)[$key] ?  unserialize($data->Product_Details->expiry_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Product_Details->remark)[$key] ?  unserialize($data->Product_Details->remark)[$key] : "Not Applicable" }}</td> --}}
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
                        </tr>
                        @endif

                    </table>
                </div>

            </div> -->
            <div class="block">
                <div class="block-head">
                    Material Details
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                        <th class="w-20">SR no.</th>
                            <th class="w-20">Material Name</th>
                            <th class="w-20">Batch Number</th>
                            <th class="w-20">Date Of Manufacturing</th>
                            <th class="w-20">Date Of Expiry</th>
                            <th class="w-20">Batch Disposition</th>
                            <th class="w-20">Remark</th>
                            <th class="w-20">Batch Status</th>
                        </tr>
                        @if($data->Material_Details->material_name)
                        @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo)
                        <tr>
                            <td class="w-15">{{ $dataDemo ? $key + 1  : "Not Applicable" }}</td>
                            <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "Not Applicable"}}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "Not Applicable" }}</td>
                            <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "Not Applicable" }}</td>
                            <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "Not Applicable" }}</td>
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
            </div>
            <div class="block">
                <div class="block-head">
                    Equipment/Instruments Details
                </div>
                <div class="border-table">
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
            </div>


            <!-- <div class="block">
                <div class="head">
                    <div class="block-head">
                        Other type CAPA Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Details</th>
                            <td class="w-80">@if($data->details){{ $data->details }}@else Not Applicable @endif</td>
                        </tr>

                         <tr>
                            <th class="w-20">Project Datails Application</th>
                            <td class="w-80"> {{ $data->project_details_application }}</td>
                        </tr> -->
                        <!--s<tr>
                            <th class="w-20">Initiator Group</th>
                            <td class="w-80"> {{ $data->project_initiator_group }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Site Number</th>
                            <td class="w-80">@if($data->site_number){{ $data->site_number }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Subject Number</th>
                            <td class="w-80">@if($data->subject_number){{ $data->subject_number }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Subject Initials</th>
                            <td class="w-80">@if($data->subject_initials){{ $data->subject_initials }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Sponsor</th>
                            <td class="w-80">@if($data->sponsor){{ $data->sponsor }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">General Deviation</th>
                            <td class="w-80">@if($data->general_deviation){{ $data->general_deviation }}@else Not Applicable @endif</td>
                        </tr> -->
                    </table>
                </div>

            <br>
            <div class="block">
                <div class="block-head">
                  Other type CAPA Details
                </div>
                <table>
                       <tr>
                            <th class="w-20">Details</th>
                            <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>
                        </tr>
                       <tr>
                            <th class="w-20">CAPA QA Comments
                            </th>
                            <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                        </tr>
                <tr>
                        <th class="w-20">CAPA Type</th>
                        <td class="w-80">@if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective Action</th>
                        <td class="w-80">@if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-80">@if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Supervisor Review Comments
                        </th>
                        <td class="w-80">@if($data->supervisor_review_comments){{ $data->supervisor_review_comments }}@else Not Applicable @endif</td>
                    </tr>

                    <div class="block-head">
                       CAPA Closure
                    </div>
                    <table>
                     <tr>
                        <th class="w-20">QA Review & Closure</th>
                        <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                        <th class="w-20">Due Date Extension Justification</th>
                        <td class="w-80">@if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif</td>
                   </tr>
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
                    </table>
                    </div>
                    </div>


            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Plan Proposed By
                        </th>
                        <td class="w-30">{{ $data->plan_proposed_by }}</td>
                        <th class="w-20">
                            Plan Proposed On</th>
                        <td class="w-30">{{ $data->plan_proposed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Plan Approved By
                        </th>
                        <td class="w-30">{{ $data->plan_approved_by }}</td>
                        <th class="w-20">
                            Plan Approved On</th>
                        <td class="w-30">{{ $data->Plan_approved_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA More Info Required By
                        </th>
                        <td class="w-30">{{ $data->qa_more_info_required_by }}</td>
                        <th class="w-20">
                            QA More Info Required On</th>
                        <td class="w-30">{{ $data->qa_more_info_required_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By
                        </th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">
                            Cancelled On</th>
                        <td class="w-30">{{ $data->cancelled_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Completed By
                        </th>
                        <td class="w-30">{{ $data->completed_by }}</td>
                        <th class="w-20">
                            Completed On</th>
                        <td class="w-30">{{ $data->completed_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->approved_by }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ $data->approved_on }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Rejected By</th>
                        <td class="w-30">{{ $data->rejected_by }}</td>
                        <th class="w-20">Rejected On</th>
                        <td class="w-30">{{ $data->rejected_on }}</td>
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
