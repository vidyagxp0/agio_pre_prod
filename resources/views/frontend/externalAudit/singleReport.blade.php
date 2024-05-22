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
                   External Audit Single Report
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
                    <strong>External Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">  @if($data->Initiator_Group){{ \Helpers::getInitiatorGroupFullName($data->Initiator_Group) }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                        <th class="w-20"> Severity Level</th>
                        <td class="w-30">@if($data->severity_level){{ $data->severity_level }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_if_other){{ $data->initiated_if_other }} @else Not Applicable @endif</td>
                        <th class="w-20">External Agencies </th>
                        <td class="w-30">@if($data->external_agencies){{ $data->external_agencies }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">@if($data->initial_comments){{ $data->initial_comments }} @else Not Applicable @endif</td>
                        <th class="w-20">If Others</th>
                        <td class="w-30">@if($data->if_other){{ $data->if_other }}@else Not Applicable @endif</td>                       
                    </tr>
                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30"> @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit type</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }}@else Not Applicable @endif</td>
                    </tr>
        

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
                            @if($data->inv_attachment)
                            @foreach(json_decode($data->inv_attachment) as $key => $file)
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
                <div class="head">
                    <div class="block-head">
                        Audit Planning
                    </div>
                    <table>
                        <tr>
                            <th class="w-30">Audit Schedule Start Date</th>
                            <td class="w-20">@if($data->start_date){{ $data->start_date }}@else Not Applicable @endif</td>
                            <th class="w-30">Audit Schedule End Date</th>
                            <td class="w-20">@if($data->end_date){{ $data->end_date }}@else Not Applicable @endif</td>

                        </tr>
                        <tr>
                            <th class="w-20">Comments (If Any)</th>
                            <td class="w-30">
                                @if($data->if_comments)
                                    @foreach (explode(',', $data->if_comments) as $Key => $value)

                                    <li>{{ $value }}</li>
                                    @endforeach
                                @else
                                  Not Applicable
                                @endif</td>
                                <th class="w-20">Product/Material Name</th>
                                <td class="w-80">
                                    @if($data->material_name)
                                        @foreach (explode(',', $data->material_name) as $Key => $value)
                                        <li>{{ $value }}</li>
                                        @endforeach
                                    @else
                                      Not Applicable
                                    @endif</td>


                        </tr>

                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                  Audit Preparation
                </div>
                <table>
                   
                    <tr>
                        <th class="w-20">Lead Auditor</th>
                        <td class="w-30">@if($data->lead_auditor){{ Helpers::getInitiatorName($data->lead_auditor) }}@else Not Applicable @endif</td>
                        <th class="w-20">External Auditor Details</th>
                        <td class="w-30">@if($data->Auditor_Details){{ $data->Auditor_Details }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">External Auditing Agency</th>
                        <td class="w-30">@if($data->External_Auditing_Agency){{ $data->External_Auditing_Agency }}@else Not Applicable @endif</td>
                        <th class="w-20">Relevant Guidelines / Industry Standards</th>
                        <td class="w-30">@if($data->Relevant_Guidelines){{ $data->Relevant_Guidelines }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Comments</th>
                        <td class="w-30">@if($data->QA_Comments){{$data->QA_Comments}}@else Not Applicable @endif</td>
                        <th class="w-20">Guideline Attachment</th>
                        <td class="w-30">@if($data->file_attachment_guideline){{ $data->file_attachment_guideline }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Category</th>
                        <td class="w-30">@if($data->Audit_Category){{ Helpers::getInitiatorName($data->Audit_Category) }}@else Not Applicable @endif</td>
                        
                    </tr>
                    <tr>
                        <th class="w-20">Supplier/Vendor/Manufacturer Site</th>
                        <td class="w-30">@if($data->Supplier_Site){{$data->Supplier_Site }}@else Not Applicable @endif</td>
                        <th class="w-20">Supplier/Vendor/Manufacturer Details</th>
                        <td class="w-30">@if($data->Supplier_Details){{ $data->Supplier_Details }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Audit team</th>
                        <td class="w-30">
                            @if($data->Audit_team)
                            @foreach (explode(',', $data->Audit_team) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                            @else Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Auditee</th>
                        <td class="w-30">
                            @if($data->Auditee)
                            @foreach (explode(',', $data->Auditee) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                            @else Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-30">@if($data->Comments){{ $data->Comments }}@else Not Applicable @endif</td>
                        <th class="w-20">Audit Comments</th>
                        <td class="w-30">@if($data->Audit_Comments1){{ $data->Audit_Comments1 }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
            <div class="border-table">
                <div class="block-head">
                   File Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->file_attachment)
                        @foreach(json_decode($data->file_attachment) as $key => $file)
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
            <div class="border-table">
                <div class="block-head">
                   Guideline Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($data->file_attachment)
                        @foreach(json_decode($data->file_attachment_guideline) as $key => $file)
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
            <div class="block">
                <div class="head">
                    <div class="block-head">
                       Audit Execution
                    </div>
                    <table>

                        <tr>
                       
                            <th class="w-20">Audit Start Date</th>
                            <td class="w-30">
                                <div>
                                    @if($data->audit_start_date){{ $data->audit_start_date }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Audit End Date</th>
                            <td class="w-30">
                                <div>
                                    @if($data->audit_end_date){{ $data->audit_end_date }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Audit Comments
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->Audit_Comments1){{ $data->Audit_Comments1 }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <div class="border-table">
                    <div class="block-head">
                        Audit Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->myfile)
                            @foreach(json_decode($data->myfile) as $key => $file)
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
                
            <div class="block">
                <div class="block-head">
                Audit Response & Closure
                </div>
                <table>

                        <tr>
                        <th class="w-20">Reference Record</th>
                        <td class="w-30">@if($data->refrence_record){{ $data->refrence_record }}@else Not Applicable @endif</td>
                        <th class="w-20">Due Date Extension Justification</th>
                        <td class="w-30">@if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                    <th class="w-20">Remarks</th>
                        <td class="w-80" colspan="3">@if($data->Remarks){{ $data->Remarks }}@else Not Applicable @endif</td>
                      </tr>
                      <tr>
                            <th class="w-20">Audit Comments
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->Audit_Comments2){{ $data->Audit_Comments2 }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>


                    </table>
                </div>
                <div class="border-table">
                    <div class="block-head">
                        Audit Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">File </th>
                        </tr>
                            @if($data->Audit_file)
                            @foreach(json_decode($data->Audit_file) as $key => $file)
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
                <div class="border-table">
                    <div class="block-head">
                        Report Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->report_file)
                            @foreach(json_decode($data->report_file) as $key => $file)
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
                

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Audit Schedule By</th>
                        <td class="w-30">{{ $data->audit_schedule_by }}</td>
                        <th class="w-20">Audit Schedule On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_by}}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->audit_mgr_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_mgr_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Observation Submitted By</th>
                        <td class="w-30">{{ $data->audit_observation_submitted_by }}</td>
                        <th class="w-20">Supervisor Reviewed On(QA)</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_observation_submitted_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Lead More Info Reqd By
                        </th>
                        <td class="w-30">{{ $data->audit_lead_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Req. On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_lead_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Response Completed By</th>
                        <td class="w-30">{{ $data->audit_response_completed_by }}</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_response_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Response Feedback Verified By</th>
                        <td class="w-30">{{ $data->response_feedback_verified_by }}</td>
                        <th class="w-20">Response Feedback Verified On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->response_feedback_verified_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Rejected By</th>
                        <td class="w-30">{{ $data->rejected_by }}</td>
                        <th class="w-20">Rejected On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->rejected_on) }}</td>
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
