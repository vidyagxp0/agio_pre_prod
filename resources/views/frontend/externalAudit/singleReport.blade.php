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
                    External Audit Report
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
                <td class="w-30">
                    <strong>External Audit No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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


                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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




                    <tr> On {{ Helpers::getDateFormat($data->created_at) }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getDateFormat($data->intiation_date) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ Helpers::getFullDepartmentName($data->Initiator_Group) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
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
                        <th class="w-20">Initiated Through</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_if_other)
                                {{ $data->initiated_if_other }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Type of Audit</th>
                        <td class="w-30" colspan="3">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>

                        <th class="w-20">If Other</th>
                        <td class="w-80" colspan="3">
                            @if ($data->if_other)
                                {{ $data->if_other }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">External Agencies</th>
                        <td class="w-30">
                            @if ($data->external_agencies)
                                {{ $data->external_agencies }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80" colspan="3">
                            @if ($data->others)
                                {{ $data->others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initial_comments)
                                {{ $data->initial_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Start Date of Audit</th>
                        <td class="w-30">
                            @if ($data->start_date_gi)
                                {{ $data->start_date_gi }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">End Date of Audith</th>
                        <td class="w-30" colspan="3">
                            @if ($data->end_date_gi)
                                {{ $data->end_date_gi }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>




                <div class="block">
                    <div class="block-head">
                        Auditors
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">SR no.</th>
                                <th class="w-20">Auditor Name</th>
                                <th class="w-20">Regulatory Agency</th>
                                <th class="w-20">Designation</th>
                                <th class="w-20">Remarks</th>

                            </tr>
                            @if ($grid_Data && is_array($grid_Data->data))
                                @foreach ($grid_Data->data as $grid_Data)
                                    <tr>
                                        <td class="w-20">{{ $loop->index + 1 }}</td>
                                        <td class="w-20">
                                            {{ isset($grid_Data['auditornew']) ? $grid_Data['auditornew'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($grid_Data['regulatoryagency']) ? $grid_Data['regulatoryagency'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($grid_Data['designation']) ? $grid_Data['designation'] : '' }}
                                        </td>

                                        <td class="w-20">
                                            {{ isset($grid_Data['remarks']) ? $grid_Data['remarks'] : '' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
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
            </div>

            <div class="border-table">
                <div class="block-head">
                    GI Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->inv_attachment)
                        @foreach (json_decode($data->inv_attachment) as $key => $file)
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
                    Summary Response
                </div>





                <!-- <table>
                    <tr>
                        <th class="w-20">CFT review selection</th>
                        <td class="w-80">
                            @if ($data->reviewer_person_value)
                                {{ $data->reviewer_person_value }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table> -->
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">SR no.</th>
                            <th>Observation</th>
                            <th>Response</th>
                            <th>CAPA / Child action Reference If Any </th>
                            <th>Status</th>
                            <th>Remarks</th>

                        </tr>
                        @if ($grid_Data_2 && is_array($grid_Data_2->data))
                            @foreach ($grid_Data_2->data as $grid_Data_2)
                                <tr>
                                    <td class="w-20">{{ $loop->index + 1 }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data_2['observation']) ? $grid_Data_2['observation'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($grid_Data_2['response']) ? $grid_Data_2['response'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data_2['reference_id']) ? $grid_Data_2['reference_id'] : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ isset($grid_Data_2['status']) ? $grid_Data_2['status'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data_2['remarks']) ? $grid_Data_2['remarks'] : '' }}</td>
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
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="border-table">
            <div class="block-head">
                Summary And Response Attachment
            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">S.N.</th>
                    <th class="w-60">Batch No</th>
                </tr>
                @if ($data->myfile)
                    @foreach (json_decode($data->myfile) as $key => $file)
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
                    CFT
                </div>
                <div class="head">
                    <div class="block-head">
                        Production (Tablet/Capsule/Powder)
                    </div>
                    <table>

                        <tr>

                            <th class="w-20">Production Tablet/Capsule Powder Review Comment Required ? 
                            </th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_Review)
                                        {{ ucfirst($data1->Production_Table_Review) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Production Tablet/Capsule Powder Person</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_Person)
                                        {{ $data1->Production_Table_Person }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>


                        <tr>

                            <th class="w-20">Review comment (By Production Tablet/Capsule Powder)  
                            </th>
                            <td class="w-80" colspan="3">
                                <div>
                                    @if ($data1->Production_Table_Assessment)
                                        {{ $data1->Production_Table_Assessment }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>

                            <!-- <th class="w-20">Production Tablet/Capsule/Powder Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_By)
{{ $data1->Production_Table_By }}
@else
Not Applicable
@endif
                                    </div>
                                </td> -->

                        </tr>
                        <tr>

                            <th class="w-20">Production Tablet/Capsule Powder Review Completed By</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_By)
                                        {{ $data1->Production_Table_By }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Production Tablet/Capsule/Powder Review Completed On</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_On)
                                        {{ \Carbon\Carbon::parse($data1->Production_Table_On)->format('d-M-Y') }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="border-table">
                    <div class="head">
                        <div class="block-head">
                        Production Tablet/Capsule Powder Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Production_Table_Attachment)
                                @foreach (json_decode($data1->Production_Table_Attachment) as $key => $file)
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
                            Production Injection
                        </div>

                        <table>

                            <tr>

                                <th class="w-20">Production Injection Review Comment Required ? 
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_Review)
                                            {{ucfirst($data1->Production_Injection_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_Person)
                                            {{ $data1->Production_Injection_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Production Injection)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Production_Injection_Assessment)
                                            {{ $data1->Production_Injection_Assessment }}
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
                                        @if ($data1->Production_Injection_By)
                                            {{ $data1->Production_Injection_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_On)
                                            {{ \Carbon\Carbon::parse($data1->Production_Injection_On)->format('d-M-Y') }}
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
                            @if ($data1->Production_Injection_Attachment)
                                @foreach (json_decode($data1->Production_Injection_Attachment) as $key => $file)
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
                            Research & Development
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Research Development Review  Comment  Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_Review)
                                            {{ ucfirst($data1->ResearchDevelopment_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research & Development Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_person)
                                            {{ $data1->ResearchDevelopment_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Research Development)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->ResearchDevelopment_assessment)
                                            {{ $data1->ResearchDevelopment_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            <tr>

                                <th class="w-20">Research  Development Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_by)
                                            {{ $data1->ResearchDevelopment_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research Development Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_on)
                                            {{ \Carbon\Carbon::parse($data1->ResearchDevelopment_on)->format('d-M-Y') }}
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
                        Research Development Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->ResearchDevelopment_attachment)
                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
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

                                <th class="w-20">Human Resource Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_review)
                                            {{ucfirst( $data1->Human_Resource_review )}}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Human Resource Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_person)
                                            {{ $data1->Human_Resource_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Human Resource)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Human_Resource_assessment)
                                            {{ $data1->Human_Resource_assessment }}
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
                                        @if ($data1->Human_Resource_by)
                                            {{ $data1->Human_Resource_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Human Resource Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_on)
                                            {{ \Carbon\Carbon::parse($data1->Human_Resource_on)->format('d-M-Y') }}
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
                            Human Resource Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Human_Resource_attachment)
                                @foreach (json_decode($data1->Human_Resource_attachment) as $key => $file)
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
                            Corporate Quality Assurance
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Corporate Quality Assurance  Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_Review)
                                            {{ ucfirst($data1->CorporateQualityAssurance_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_person)
                                            {{ $data1->CorporateQualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Corporate Quality Assurance)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_assessment)
                                            {{ $data1->CorporateQualityAssurance_assessment }}
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
                                        @if ($data1->CorporateQualityAssurance_by)
                                            {{ $data1->CorporateQualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_on)
                                            {{ \Carbon\Carbon::parse($data1->CorporateQualityAssurance_on)->format('d-M-Y') }}
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
                            @if ($data1->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
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
                            Store
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Store Review Comment  Required ? 
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_Review)
                                            {{ ucfirst($data1->Store_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Store Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_person)
                                            {{ $data1->Store_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Store)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_assessment)
                                            {{ $data1->Store_assessment }}
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
                                        @if ($data1->Store_by)
                                            {{ $data1->Store_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Store Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_on)
                                            {{ \Carbon\Carbon::parse($data1->Store_on)->format('d-M-Y') }}
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
                            @if ($data1->Store_attachment)
                                @foreach (json_decode($data1->Store_attachment) as $key => $file)
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
                            Engineering
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Engineering Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_review)
                                            {{ ucfirst($data1->Engineering_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Engineering Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_person)
                                            {{ $data1->Engineering_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Engineering)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Engineering_assessment)
                                            {{ $data1->Engineering_assessment }}
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
                                        @if ($data1->Engineering_by)
                                            {{ $data1->Engineering_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Engineering Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_on)
                                            {{ \Carbon\Carbon::parse($data1->Engineering_on)->format('d-M-Y') }}
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
                            @if ($data1->Engineering_attachment)
                                @foreach (json_decode($data1->Engineering_attachment) as $key => $file)
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
                            Regulatory Affair
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Regulatory Affair Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_Review)
                                            {{ ucfirst($data1->RegulatoryAffair_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affair Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_person)
                                            {{ $data1->RegulatoryAffair_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Regulatory Affair)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->RegulatoryAffair_assessment)
                                            {{ $data1->RegulatoryAffair_assessment }}
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
                                        @if ($data1->RegulatoryAffair_by)
                                            {{ $data1->RegulatoryAffair_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Regulatory Affair Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_on)
                                            {{ \Carbon\Carbon::parse($data1->RegulatoryAffair_on)->format('d-M-Y') }}
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
                            @if ($data1->RegulatoryAffair_attachment)
                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $key => $file)
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
                            Quality Assurance
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Quality Assurance Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Assurance_Review)
                                            {{ ucfirst($data1->Quality_Assurance_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->QualityAssurance_person)
                                            {{ $data1->QualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Quality Assurance)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->QualityAssurance_assessment)
                                            {{ $data1->QualityAssurance_assessment }}
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
                                        @if ($data1->QualityAssurance_by)
                                            {{ $data1->QualityAssurance_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->QualityAssurance_on)
                                            {{ \Carbon\Carbon::parse($data1->QualityAssurance_on)->format('d-M-Y') }}
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
                            @if ($data1->Quality_Assurance_attachment)
                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $key => $file)
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
                            Production (Liquid/Ointment)
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Production Liquid/ointment Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_Review)
                                            {{ ucfirst($data1->ProductionLiquid_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/ointment Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_person)
                                            {{ $data1->ProductionLiquid_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review Comment (By Production Liquid/ointment)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->ProductionLiquid_assessment)
                                            {{ $data1->ProductionLiquid_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            <tr>

                                <th class="w-20">Production Liquid/ointment Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_by)
                                            {{ $data1->ProductionLiquid_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/ointment Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_on)
                                            {{ \Carbon\Carbon::parse($data1->ProductionLiquid_on)->format('d-M-Y') }}
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
                            Production (Liquid/Ointment) Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->ProductionLiquid_attachment)
                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $key => $file)
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
                            Quality Control
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Quality Control Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_review)
                                            {{ ucfirst($data1->Quality_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Control Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Control_Person)
                                            {{ $data1->Quality_Control_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Quality Control)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Quality_Control_attachment)
                                            {{ $data1->Quality_Control_attachment }}
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
                                        @if ($data1->Quality_Control_by)
                                            {{ $data1->Quality_Control_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Control Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Control_on)
                                            {{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('d-M-Y') }}
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
                            @if ($data1->Quality_Control_attachment)
                                @foreach (json_decode($data1->Quality_Control_attachment) as $key => $file)
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
                            Microbiology
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Microbiology Review Comment  Required ? 
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_Review)
                                            {{ ucfirst($data1->Microbiology_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_person)
                                            {{ $data1->Microbiology_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Microbiology)
                                </th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Microbiology_assessment)
                                            {{ $data1->Microbiology_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            <tr>

                                <th class="w-20">Microbiology Review Completed By
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_by)
                                            {{ $data1->Microbiology_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Review Completed On
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_on)
                                            {{ \Carbon\Carbon::parse($data1->Microbiology_on)->format('d-M-Y') }}
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
                            @if ($data1->Microbiology_attachment)
                                @foreach (json_decode($data1->Microbiology_attachment) as $key => $file)
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
                            Safety
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Safety Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Environment_Health_review)
                                            {{ ucfirst($data1->Environment_Health_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Safety Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Environment_Health_Safety_person)
                                            {{ $data1->Environment_Health_Safety_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Safety)</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Health_Safety_assessment)
                                            {{ $data1->Health_Safety_assessment }}
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
                                        @if ($data1->Environment_Health_Safety_by)
                                            {{ $data1->Environment_Health_Safety_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Safety Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Environment_Health_Safety_on)
                                            {{ \Carbon\Carbon::parse($data1->Environment_Health_Safety_on)->format('d-M-Y') }}
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
                            @if ($data1->Environment_Health_Safety_attachment)
                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
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

                <!-- <div class="block">
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
                                            @if ($data1->ContractGiver_Review)
{{ $data1->ContractGiver_Review }}
@else
Not Applicable
@endif
                                        </div>
                                    </td>
                                    <th class="w-20">Contract Giver Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_person)
{{ $data1->ContractGiver_person }}
@else
Not Applicable
@endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Review comment (By Contract Giver)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_assessment)
{{ $data1->ContractGiver_assessment }}
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
                                            @if ($data1->ContractGiver_by)
{{ $data1->ContractGiver_by }}
@else
Not Applicable
@endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Contract Giver Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_on)
{{ \Carbon\Carbon::parse($data1->ContractGiver_on)->format('d-M-Y') }}
@else
Not Applicable
@endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div> -->
                <!-- <div class="border-table">
                            <div class="block-head">
                                Contract Giver Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->ContractGiver_attachment)
                                    @foreach (json_decode($data1->ContractGiver_attachment) as $key => $file)
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
                    </div> -->


                <div class="block">
                    <div class="head">
                        <div class="block-head">
                            Other's 1 ( Additional Person Review From Departments If Required)
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Other's 1 Review Comment Required?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_review)
                                            {{ ucfirst($data1->Other1_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_person)
                                            {{ $data1->Other1_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_Department_person)
                                            {{  Helpers::getFullDepartmentName($data1->Other1_Department_person) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 1)</th>
                                <td class="w-80" colspan="5">
                                    <div>
                                        @if ($data1->Other1_assessment)
                                            {{ $data1->Other1_assessment }}
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
                                        @if ($data1->Other1_by)
                                            {{ $data1->Other1_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 1 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_on)
                                            {{ \Carbon\Carbon::parse($data1->Other1_on)->format('d-M-Y') }}
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
                            @if ($data1->Other1_attachment)
                                @foreach (json_decode($data1->Other1_attachment) as $key => $file)
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

                                <th class="w-20">Other's 2 Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_review)
                                            {{ ucfirst($data1->Other2_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_person)
                                            {{ $data1->Other2_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_Department_person)
                                            {{ Helpers::getFullDepartmentName($data1->Other2_Department_person) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 2)</th>
                                <td class="w-80" colspan="5">
                                    <div>
                                        @if ($data1->Other2_Assessment)
                                            {{ $data1->Other2_Assessment }}
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
                                        @if ($data1->Other2_by)
                                            {{ $data1->Other2_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 2 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_on)
                                            {{ \Carbon\Carbon::parse($data1->Other2_on)->format('d-M-Y') }}
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
                            @if ($data1->Other2_attachment)
                                @foreach (json_decode($data1->Other2_attachment) as $key => $file)
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

                                <th class="w-20">Other's 3 Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_review)
                                            {{ ucfirst($data1->Other3_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_person)
                                            {{ $data1->Other3_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_Department_person)
                                            {{ Helpers::getFullDepartmentName($data1->Other3_Department_person) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 3)</th>
                                <td class="w-80" colspan="5">
                                    <div>
                                        @if ($data1->Other3_Assessment)
                                            {{ $data1->Other3_Assessment }}
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
                                        @if ($data1->Other3_by)
                                            {{ $data1->Other3_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 3 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_on)
                                            {{ \Carbon\Carbon::parse($data1->Other3_on)->format('d-M-Y') }}
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
                            @if ($data1->Other3_attachment)
                                @foreach (json_decode($data1->Other3_attachment) as $key => $file)
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

                                <th class="w-20">Other's 4 Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_review)
                                            {{ ucfirst($data1->Other4_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_person)
                                            {{ $data1->Other4_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_Department_person)
                                            {{Helpers::getFullDepartmentName($data1->Other4_Department_person) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 4)</th>
                                <td class="w-80" colspan="5">
                                    <div>
                                        @if ($data1->Other4_Assessment)
                                            {{ $data1->Other4_Assessment }}
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
                                        @if ($data1->Other4_by)
                                            {{ $data1->Other4_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 4 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_on)
                                            {{ \Carbon\Carbon::parse($data1->Other4_on)->format('d-M-Y') }}
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
                            @if ($data1->Other4_attachment)
                                @foreach (json_decode($data1->Other4_attachment) as $key => $file)
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

                                <th class="w-20">Other's 5 Review Comment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_review)
                                            {{ ucfirst($data1->Other5_review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_person)
                                            {{ $data1->Other5_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_Department_person)
                                            {{ Helpers::getFullDepartmentName($data1->Other5_Department_person) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 5)</th>
                                <td class="w-80" colspan="5">
                                    <div>
                                        @if ($data1->Other5_Assessment)
                                            {{ $data1->Other5_Assessment }}
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
                                        @if ($data1->Other5_by)
                                            {{ $data1->Other5_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20"> Other's 5 Review Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_on)
                                            {{ \Carbon\Carbon::parse($data1->Other5_on)->format('d-M-Y') }}
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
                            @if ($data1->Other5_attachment)
                                @foreach (json_decode($data1->Other5_attachment) as $key => $file)
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
                        QA/CQA Head Approval
                    </div>

                    <table>
                        <tr>
                            <th class="w-20">QA/CQA Head Approval Comment</th>
                            <td class="w-80">
                                @if ($data->qa_cqa_comment)
                                    {{ $data->qa_cqa_comment }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="border-table">
                    <div class="block-head">
                        QA/CQA Head Approval Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                        @if ($data->qa_cqa_attach)
                            @foreach (json_decode($data->qa_cqa_attach) as $key => $file)
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
                        Activity Log
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Audit Details Summary By</th>
                            <td class="w-30">{{ $data->audit_details_summary_by }}</td>
                            <th class="w-20">Audit Details Summary On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->audit_details_summary_on) }}</td>
                            <th class="w-20">Audit Details Summary Comment</th>
                            <td class="w-30">{{ $data->audit_details_summary_on_comment }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Cancel By</th>
                            <td class="w-30">{{ $data->cancelled_by }}</td>
                            <th class="w-20">Cancel On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_on) }}</td>
                            <th class="w-20">Cancel Comment</th>
                            <td class="w-30">{{ $data->cancelled_on_comment }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Summary and Response Complete by</th>
                            <td class="w-30">{{ $data->summary_and_response_com_by }}</td>
                            <th class="w-20">Summary and Response Complete On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->summary_and_response_com_on) }}</td>
                            <th class="w-20">Summary and Response Complete Comment</th>
                            <td class="w-30">{{ $data->summary_and_response_com_on_comment }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">CFT Review Not Required By</th>
                            <td class="w-30">{{ $data->cft_review_not_req_by }}</td>
                            <th class="w-20">CFT Review Not Required On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->cft_review_not_req_on) }}</td>
                            <th class="w-20">CFT Review Not Required Comment</th>
                            <td class="w-30">{{ $data->cft_review_not_req_on_comment }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">CFT Review Complete By</th>
                            <td class="w-30">{{ $data->cft_review_complete_by }}</td>
                            <th class="w-20">CFT Review Complete On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->cft_review_complete_on) }}</td>
                            <th class="w-20">CFT Review Complete Comment</th>
                            <td class="w-30">{{ $data->cft_review_complete_comment }}</td>
                        </tr>


                        <tr>
                            <th class="w-20">Send to Opened By</th>
                            <td class="w-30">{{ $data->send_to_opened_by }}</td>
                            <th class="w-20">Send to Opened On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->send_to_opened_on) }}</td>
                            <th class="w-20">Send to Opened Comment</th>
                            <td class="w-30">{{ $data->send_to_opened_comment }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Approval Complete By
                            </th>
                            <td class="w-30">{{ $data->approval_complete_by }}</td>
                            <th class="w-20">Approval Complete On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->approval_complete_on) }}</td>
                            <th class="w-20">Approval Complete Comment</th>
                            <td class="w-30">{{ $data->approval_complete_on_comment }}</td>
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
