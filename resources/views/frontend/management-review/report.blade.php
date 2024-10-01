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
@php
    use Carbon\Carbon;
@endphp


<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Management Review Report
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
                    <strong>Management Audit No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($managementReview->division_id) }}/MR/{{ Helpers::year($managementReview->created_at) }}/{{ str_pad($managementReview->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($managementReview->record, 4, '0', STR_PAD_LEFT) }}
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
                    <tr> {{ $managementReview->created_at }} added by {{ $managementReview->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($managementReview->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($managementReview->record)
                                {{ Helpers::divisionNameForQMS($managementReview->division_id) }}/MR/{{ Helpers::year($managementReview->created_at) }}/{{ str_pad($managementReview->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($managementReview->division_id)
                                {{ Helpers::getDivisionName($managementReview->division_id) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator department</th>
                        {{-- <!-- <td class="w-30"> --}}
                        @php
                            $departments = [
                                'CQA' => 'Corporate Quality Assurance',
                                'QA' => 'Quality Assurance',
                                'QC' => 'Quality Control',
                                'QM' => 'Quality Control (Microbiology department)',
                                'PG' => 'Production General',
                                'PL' => 'Production Liquid Orals',
                                'PT' => 'Production Tablet and Powder',
                                'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
                                'PC' => 'Production Capsules',
                                'PI' => 'Production Injectable',
                                'EN' => 'Engineering',
                                'HR' => 'Human Resource',
                                'ST' => 'Store',
                                'IT' => 'Electronic Data Processing',
                                'FD' => 'Formulation  Development',
                                'AL' => 'Analytical research and Development Laboratory',
                                'PD' => 'Packaging Development',
                                'PU' => 'Purchase Department',
                                'DC' => 'Document Cell',
                                'RA' => 'Regulatory Affairs',
                                'PV' => 'Pharmacovigilance',
                            ];
                        @endphp
                        <td class="w-30">
                            {{ $departments[$managementReview->initiator_Group] ?? 'Unknown Department' }}</td>
                        {{-- @if ($managementReview->initiator_Group)
                {{ $managementReview->initiator_Group }}
                        @else
                            Not Applicable
                            @endif --}}
                        {{-- </td>  --}}
                        {{-- <td class="w-30">{{ Helpers::getInitiatorName($managementReview->initiator_Group) }}</td> --}}
                        <th class="w-20">Initiator department Code</th>
                        <td class="w-30">
                            @if ($managementReview->initiator_group_code)
                                {{ $managementReview->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($managementReview->assign_to)
                                {{ Helpers::getInitiatorName($managementReview->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                    </tr> --}}
                </table>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Short
                        Description </label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">
                        @if ($managementReview->short_description)
                            {{ $managementReview->short_description }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>


                <table>

                    <tr>
                        {{-- <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($managementReview->due_date)
                                {{ $managementReview->due_date }}
                            @else
                                Not Applicable
                            @endif
                            {{ Helpers::getdateFormat($managementReview->due_date) ?? 'Not Applicable' }}
                        </td> --}}
                        {{-- <th class="w-20">Priority Level</th>
                        <td class="w-30">
                            @if ($managementReview->priority_level)
                                {{ $managementReview->priority_level }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}
                        <th class="w-20">Type</th>
                        <td class="w-30">
                            @if ($managementReview->summary_recommendation)
                                {{ $managementReview->summary_recommendation }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Proposed Schedule Start Date</th>
                        <td class="w-30">
                            {{-- @if ($managementReview->start_date)
                                {{ $managementReview->start_date }}
                            @else
                                Not Applicable
                            @endif --}}
                            {{ Helpers::getdateFormat($managementReview->start_date) ?? 'Not Applicable' }}
                        </td>

                    </tr>


                    <tr>


                        {{-- <th class="w-30"> Schedule End Date</th> --}}
                        {{-- <td class="w-20">
                            {{-- @if ($managementReview->end_date)
                                {{ $managementReview->end_date }}
                            @else
                                Not Applicable
                            @endif
                            {{ Helpers::getdateFormat($managementReview->end_date) ?? 'Not Applicable' }}

                        </td> --}}


                        <th class="w-20">Review Period</th>
                        <td class="w-30">
                            @if ($managementReview->review_period_monthly)
                                {{ $managementReview->review_period_monthly }}
                            @elseif ($managementReview->review_period_six_monthly)
                                {{ $managementReview->review_period_six_monthly }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Invite Person Notify</th>
                        <td class="w-30">
                            @if ($managementReview->assign_to)
                                {{ Helpers::getInitiatorName($managementReview->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>




                </table>
                {{-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Attendess</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->attendees)
                            {{ $managementReview->attendees }}
                        @else
                            Not Applicable
                        @endif

                </div> --}}
                <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline;">Description</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->description)
                            {{ $managementReview->description }}
                        @else
                            Not Applicable
                        @endif

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
                        @if ($managementReview->inv_attachment)
                            @foreach (json_decode($managementReview->inv_attachment) as $key => $file)
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


            {{-- <div class="block">
                {{-- <div class="head">
                    <div class="block-head">

                    </div>
                    <table>
                        <tr>
                            <

                        </tr>

                        <tr>
                            <th class="w-20">Operations </th>
                            <td class="w-80"> @if ($managementReview->Operations){{ $managementReview->Operations }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Comments(If Any)</th>
                            <td class="w-30">
                                @if ($managementReview->if_comments)
                                    @foreach (explode(',', $managementReview->if_comments) as $Key => $value)

                                    <li>{{ $value }}</li>
                                    @endforeach
                                @else
                                  Not Applicable
                                @endif</td>
                                <th class="w-20">Product/Material Name</th>
                                <td class="w-80">
                                    @if ($managementReview->material_name)
                                        @foreach (explode(',', $managementReview->material_name) as $Key => $value)
                                        <li>{{ $value }}</li>
                                        @endforeach
                                    @else
                                      Not Applicable
                                    @endif</td>


                        </tr>

                    </table>
                </div> --}}
            {{-- </div>  --}}
            <div class="block">
                <div class="block-head">
                    QA Head review
                </div>


                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">QA review comment
                    </label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->Operations)
                            {{ $managementReview->Operations }}
                        @else
                            Not Applicable
                        @endif

                </div>

                {{-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Requirements for
                        Products and Services</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->requirement_products_services)
                            {{ $managementReview->requirement_products_services }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Design and
                        Development of Products and Services</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->design_development_product_services)
                            {{ $managementReview->design_development_product_services }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Control of
                        Externally Provided Processes, Products and Services</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->control_externally_provide_services)
                            {{ $managementReview->control_externally_provide_services }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Production and
                        Service Provision</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->production_service_provision)
                            {{ $managementReview->production_service_provision }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Release of
                        Products and Services</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->release_product_services)
                            {{ $managementReview->release_product_services }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Control of
                        Non-conforming Outputs</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->control_nonconforming_outputs)
                            {{ $managementReview->control_nonconforming_outputs }}
                        @else
                            Not Applicable
                        @endif

                </div> --}}
                {{-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Audit
                        team</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->Audit_team)
                            @foreach (explode(',', $managementReview->Audit_team) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                        @else
                            Not Applicable
                        @endif

                </div> --}}


                {{-- <div class="border-table">
                    <div class="block-head">
                        QA Head review Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                        @if ($managementReview->file_attachment)
                            @foreach (json_decode($managementReview->file_attachment) as $key => $file)
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
            <div class="border-table">
                <div class="block-head">
                    File Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($managementReview->file_attachment)
                        @foreach (json_decode($managementReview->file_attachment) as $key => $file)
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
                    @endif --}}

                <div class="border-table">
                    <div class="block-head">
                        QA Head review Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                        @if ($managementReview->file_attchment_if_any)
                            @foreach (json_decode($managementReview->file_attchment_if_any) as $key => $file)
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

            </table>
        </div>
        <div class="block">
            <div class="head">
                <div class="block-head">
                    Meetings and summary
                </div>

                <table>
                    <tr>

                        <th class="w-30">Meeting Start Date</th>
                        <td class="w-20">
                            {{-- @if ($managementReview->start_date)
                                {{ $managementReview->start_date }}
                            @else
                                Not Applicable
                            @endif --}}
                            {{ Helpers::getdateFormat($managementReview->external_supplier_performance) ?? 'Not Applicable' }}
                        </td>
                        <th class="w-30"> Meeting End Date</th>
                        <td class="w-20">
                            {{-- @if ($managementReview->end_date)
                                    {{ $managementReview->end_date }}
                                @else
                                    Not Applicable
                                @endif --}}
                            {{ Helpers::getdateFormat($managementReview->customer_satisfaction_level) ?? 'Not Applicable' }}

                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Meeting Start Time</th>
                        <td class="w-30">
                            @if ($managementReview->budget_estimates)
                                {{ $managementReview->budget_estimates }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Meeting End Time</th>
                        <td class="w-30">
                            @if ($managementReview->completion_of_previous_tasks)
                                {{ $managementReview->completion_of_previous_tasks }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                </table>







            </div>
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

                            <th class="w-20">Production Tablet/Capsule/Powder Review Required ?
                            </th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_Review)
                                        {{ $data1->Production_Table_Review }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Production Tablet/Capsule/Powder Person</th>
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
                            <th class="w-20">HOD Production Tablet/Capsule/Powder Person</th>
                            <td class="w-30">
                                <div>
                                    @if ($data5->hod_Production_Table_Person)
                                        {{ $data5->hod_Production_Table_Person }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>


                        </tr>
                        <tr>

                            <th class="w-20">Description of Action Item (By Production Tablet/Capsule Powder)</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_Assessment)
                                        {{ $data1->Production_Table_Assessment }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Production Tablet/Capsule Powder Status of Action Item</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_By)
                                        {{ $data1->Production_Table_By }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
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
                            <th class="w-20">Production Tablet/Capsule Powder Review Completed On</th>
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

                                <th class="w-20">Production Injection Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_Review)
                                            {{ $data1->Production_Injection_Review }}
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
                                <th class="w-20">HOD Production Injection Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Production_Injection_Person)
                                            {{ $data5->hod_Production_Injection_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th class="w-20">Description of Action Item (By Production Injection)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_Assessment)
                                            {{ $data1->Production_Injection_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Injection Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Injection_Feedback)
                                            {{ $data1->Production_Injection_Feedback }}
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
                            Production Injection Attachments 2
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

                                <th class="w-20">Research & Development Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_Review)
                                            {{ $data1->ResearchDevelopment_Review }}
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


                                <th class="w-20">HOD Research & Development Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_ResearchDevelopment_person)
                                            {{ $data5->hod_ResearchDevelopment_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Research & Development)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_assessment)
                                            {{ $data1->ResearchDevelopment_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research & Development Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ResearchDevelopment_feedback)
                                            {{ $data1->ResearchDevelopment_feedback }}
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
                                        @if ($data1->ResearchDevelopment_by)
                                            {{ $data1->ResearchDevelopment_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Research & Development Review Completed On</th>
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
                            Research & Development Attachments
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

                                <th class="w-20">Human Resource Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_review)
                                            {{ $data1->Human_Resource_review }}
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

                                <th class="w-20">HOD Human Resource Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Human_Resource_person)
                                            {{ $data5->hod_Human_Resource_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Human Resource)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_assessment)
                                            {{ $data1->Human_Resource_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Human Resource Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Human_Resource_feedback)
                                            {{ $data1->Human_Resource_feedback }}
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

                                <th class="w-20">Corporate Quality Assurance Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_Review)
                                            {{ $data1->CorporateQualityAssurance_Review }}
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
                                <th class="w-20">HOD Corporate Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_CorporateQualityAssurance_person)
                                            {{ $data5->hod_CorporateQualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Corporate Quality Assurance)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_assessment)
                                            {{ $data1->CorporateQualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Corporate Quality Assurance Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->CorporateQualityAssurance_feedback)
                                            {{ $data1->CorporateQualityAssurance_feedback }}
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
                            Stores
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Stores Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_Review)
                                            {{ $data1->Store_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores Person</th>
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

                                <th class="w-20">HOD Stores Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Store_person)
                                            {{ $data5->hod_Store_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Stores)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_assessment)
                                            {{ $data1->Store_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores feedback Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_feedback)
                                            {{ $data1->Store_feedback }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th class="w-20">Stores Review Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Store_by)
                                            {{ $data1->Store_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Stores Review Completed On</th>
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
                            Stores Attachments
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

                                <th class="w-20">Engineering Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_review)
                                            {{ $data1->Engineering_review }}
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

                                <th class="w-20">HOD Engineering Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Engineering_person)
                                            {{ $data5->hod_Engineering_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Engineering)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_assessment)
                                            {{ $data1->Engineering_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Engineering Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Engineering_feedback)
                                            {{ $data1->Engineering_feedback }}
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

                                <th class="w-20">Regulatory Affair Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_Review)
                                            {{ $data1->RegulatoryAffair_Review }}
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

                                <th class="w-20">HOD Regulatory Affair Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_RegulatoryAffair_person)
                                            {{ $data5->hod_RegulatoryAffair_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Regulatory Affair)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_assessment)
                                            {{ $data1->RegulatoryAffair_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Regulatory Affair Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->RegulatoryAffair_feedback)
                                            {{ $data1->RegulatoryAffair_feedback }}
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

                                <th class="w-20">Quality Assurance Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Assurance_Review)
                                            {{ $data1->Quality_Assurance_Review }}
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

                                <th class="w-20">HOD Quality Assurance Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_QualityAssurance_person)
                                            {{ $data5->hod_QualityAssurance_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Quality Assurance)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->QualityAssurance_assessment)
                                            {{ $data1->QualityAssurance_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Assurance Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Assurance_feedback)
                                            {{ $data1->Quality_Assurance_feedback }}
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

                                <th class="w-20">Production Liquid/Ointment Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_Review)
                                            {{ $data1->ProductionLiquid_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/Ointment Person</th>
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


                                <th class="w-20">HOD Production Liquid/Ointment Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_ProductionLiquid_person)
                                            {{ $data5->hod_ProductionLiquid_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Production Liquid/Ointment)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_assessment)
                                            {{ $data1->ProductionLiquid_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/Ointment Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ProductionLiquid_feedback)
                                            {{ $data1->ProductionLiquid_feedback }}
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
                                        @if ($data1->ProductionLiquid_by)
                                            {{ $data1->ProductionLiquid_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Liquid/Ointment Review Completed On</th>
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
                            Production Liquid/Ointment Attachments
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

                                <th class="w-20">Quality Control Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_review)
                                            {{ $data1->Quality_review }}
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

                                <th class="w-20">HOD Quality Control Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Quality_Control_Person)
                                            {{ $data5->hod_Quality_Control_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Quality Control)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Control_assessment)
                                            {{ $data1->Quality_Control_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Quality Control Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Quality_Control_feedback)
                                            {{ $data1->Quality_Control_feedback }}
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

                                <th class="w-20">Microbiology Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_Review)
                                            {{ $data1->Microbiology_Review }}
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

                                <th class="w-20">HOD Microbiology Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Microbiology_person)
                                            {{ $data5->hod_Microbiology_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Microbiology)
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_assessment)
                                            {{ $data1->Microbiology_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Microbiology Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Microbiology_feedback)
                                            {{ $data1->Microbiology_feedback }}
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

                                <th class="w-20">Safety Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Environment_Health_review)
                                            {{ $data1->Environment_Health_review }}
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

                                <th class="w-20">HOD Safety Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Environment_Health_Safety_person)
                                            {{ $data5->hod_Environment_Health_Safety_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Safety)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Health_Safety_assessment)
                                            {{ $data1->Health_Safety_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Safety Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Health_Safety_feedback)
                                            {{ $data1->Health_Safety_feedback }}
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

                <div class="block">
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

                                <th class="w-20">HOD Contract Giver Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_ContractGiver_person)
                                            {{ $data5->hod_ContractGiver_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Contract Giver)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ContractGiver_assessment)
                                            {{ $data1->ContractGiver_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Contract Giver Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->ContractGiver_feedback)
                                            {{ $data1->ContractGiver_feedback }}
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
                    </div>
                    <div class="border-table">
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
                                        @if ($data1->Other1_review)
                                            {{ $data1->Other1_review }}
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

                            </tr>
                            <tr>

                                <th class="w-20">HOD Other's 1 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Other1_person)
                                            {{ $data5->hod_Other1_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_Department_person)
                                            {{ $data1->Other1_Department_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>


                            <tr>

                                <th class="w-20">Description of Action Item (By Other's 1)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_assessment)
                                            {{ $data1->Other1_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 1 Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other1_feedback)
                                            {{ $data1->Other1_feedback }}
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

                                <th class="w-20">Other's 2 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_review)
                                            {{ $data1->Other2_review }}
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

                            </tr>
                            <tr>

                                <th class="w-20">HOD Other's 2 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Other2_person)
                                            {{ $data5->hod_Other2_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_Department_person)
                                            {{ $data1->Other2_Department_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Other's 2)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_assessment)
                                            {{ $data1->Other2_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 2 Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other2_feedback)
                                            {{ $data1->Other2_feedback }}
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

                                <th class="w-20">Other's 3 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_review)
                                            {{ $data1->Other3_review }}
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

                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Other's 3)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_assessment)
                                            {{ $data1->Other3_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 3 Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other3_feedback)
                                            {{ $data1->Other3_feedback }}
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

                                <th class="w-20">Other's 4 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_review)
                                            {{ $data1->Other4_review }}
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

                            </tr>
                            <tr>


                                <th class="w-20">HOD Other's 4 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Other4_person)
                                            {{ $data5->hod_Other4_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_Department_person)
                                            {{ $data1->Other4_Department_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Description of Action Item (By Other's 4)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_assessment)
                                            {{ $data1->Other4_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 4 Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other4_feedback)
                                            {{ $data1->Other4_feedback }}
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

                                <th class="w-20">Other's 5 Review Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_review)
                                            {{ $data1->Other5_review }}
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

                            </tr>

                            <tr>

                                <th class="w-20">HOD Other's 5 Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data5->hod_Other5_person)
                                            {{ $data5->hod_Other5_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Department</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_Department_person)
                                            {{ $data1->Other5_Department_person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th class="w-20">Description of Action Item (By Other's 5)</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_assessment)
                                            {{ $data1->Other5_assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Other's 5 Status of Action Item</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Other5_feedback)
                                            {{ $data1->Other5_feedback }}
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
                    <div class="head">
                        <div class="block-head">
                            CFT HOD Review
                        </div>
                        <div class="head">
                            <div class="block-head">
                                Production (Tablet/Capsule/Powder)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">HOD Production Tablet Comments</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data5->hod_Production_Table_Feedback)
                                                {{ $data5->hod_Production_Table_Feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <th class="w-20">HOD Production Tablet/Capsule Powder Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data5->hod_Production_Table_By)
                                                {{ $data5->hod_Production_Table_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">HOD Production Tablet/Capsule Powder Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data5->hod_Production_Table_On)
                                                {{ \Carbon\Carbon::parse($data5->hod_Production_Table_On)->format('d-M-Y') }}
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
                                    HOD Production Tablet/Capsule Powder Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Production_Table_Attachment)
                                        @foreach (json_decode($data5->hod_Production_Table_Attachment) as $key => $file)
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

                                        <th class="w-20">HOD Production Injection Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Production_Injection_Feedback)
                                                    {{ $data5->hod_Production_Injection_Feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Production Injection Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Production_Injection_By)
                                                    {{ $data5->hod_Production_Injection_By }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Production Injection Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Production_Injection_On)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Production_Injection_On)->format('d-M-Y') }}
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
                                    HOD Production Injection Attachments 2
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Production_Injection_Attachment)
                                        @foreach (json_decode($data5->hod_Production_Injection_Attachment) as $key => $file)
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

                                        <th class="w-20">HOD Research & Development Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ResearchDevelopment_feedback)
                                                    {{ $data5->hod_ResearchDevelopment_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Research & Development Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ResearchDevelopment_by)
                                                    {{ $data5->hod_ResearchDevelopment_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Research & Development Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ResearchDevelopment_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_ResearchDevelopment_on)->format('d-M-Y') }}
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
                                    HOD Research & Development Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_ResearchDevelopment_attachment)
                                        @foreach (json_decode($data5->hod_ResearchDevelopment_attachment) as $key => $file)
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

                                        <th class="w-20">Human Resource Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Human_Resource_feedback)
                                                    {{ $data5->hod_Human_Resource_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Human Resource Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Human_Resource_by)
                                                    {{ $data5->hod_Human_Resource_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Human Resource Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Human_Resource_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Human_Resource_on)->format('d-M-Y') }}
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
                                    HOD Human Resource Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Human_Resource_attachment)
                                        @foreach (json_decode($data5->hod_Human_Resource_attachment) as $key => $file)
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


                                        <th class="w-20">Corporate Quality Assurance Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_CorporateQualityAssurance_feedback)
                                                    {{ $data5->hod_CorporateQualityAssurance_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Corporate Quality Assurance Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_CorporateQualityAssurance_by)
                                                    {{ $data5->hod_CorporateQualityAssurance_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Corporate Quality Assurance Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_CorporateQualityAssurance_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_CorporateQualityAssurance_on)->format('d-M-Y') }}
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
                                    HOD Corporate Quality Assurance Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_CorporateQualityAssurance_attachment)
                                        @foreach (json_decode($data5->hod_CorporateQualityAssurance_attachment) as $key => $file)
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
                                    Stores
                                </div>
                                <table>


                                    <tr>


                                        <th class="w-20">Stores feedback Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Store_feedback)
                                                    {{ $data5->hod_Store_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Stores Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Store_by)
                                                    {{ $data5->hod_Store_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Stores Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Store_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Store_on)->format('d-M-Y') }}
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
                                    HOD Stores Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Store_attachment)
                                        @foreach (json_decode($data5->hod_Store_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Engineering Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Engineering_feedback)
                                                    {{ $data5->hod_Engineering_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Engineering Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Engineering_by)
                                                    {{ $data5->hod_Engineering_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Engineering Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Engineering_on)
                                                    {{ $data5->hod_Engineering_on }}
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
                                    HOD Engineering Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Engineering_attachment)
                                        @foreach (json_decode($data5->hod_Engineering_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Regulatory Affair Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_RegulatoryAffair_feedback)
                                                    {{ $data5->hod_RegulatoryAffair_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Regulatory Affair Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_RegulatoryAffair_by)
                                                    {{ $data5->hod_RegulatoryAffair_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Regulatory Affair Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_RegulatoryAffair_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_RegulatoryAffair_on)->format('d-M-Y') }}
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
                                    HOD Regulatory Affair Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_RegulatoryAffair_attachment)
                                        @foreach (json_decode($data5->hod_RegulatoryAffair_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Quality Assurance Status of action item</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Quality_Assurance_feedback)
                                                    {{ $data5->hod_Quality_Assurance_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Quality Assurance Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_QualityAssurance_by)
                                                    {{ $data5->hod_QualityAssurance_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Quality Assurance Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_QualityAssurance_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_QualityAssurance_on)->format('d-M-Y') }}
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
                                    HOD Quality Assurance Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Quality_Assurance_attachment)
                                        @foreach (json_decode($data5->hod_Quality_Assurance_attachment) as $key => $file)
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


                                    <th class="w-20">HOD Production (Liquid/Ointment) Comments</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data5->hod_ProductionLiquid_feedback)
                                                {{ $data5->hod_ProductionLiquid_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Production (Liquid/Ointment) Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ProductionLiquid_by)
                                                    {{ $data5->hod_ProductionLiquid_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Production (Liquid/Ointment) Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ProductionLiquid_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_ProductionLiquid_on)->format('d-M-Y') }}
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
                                    HOD Production (Liquid/Ointment) Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_ProductionLiquid_attachment)
                                        @foreach (json_decode($data5->hod_ProductionLiquid_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Quality Control Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Quality_Control_feedback)
                                                    {{ $data5->hod_Quality_Control_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Quality Control Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Quality_Control_on)
                                                    {{ $data5->hod_Quality_Control_on }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Quality Control Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Quality_Control_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Quality_Control_on)->format('d-M-Y') }}
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
                                    HOD Quality Control Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Quality_Control_attachment)
                                        @foreach (json_decode($data5->hod_Quality_Control_attachment) as $key => $file)
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


                                        <th class="w-20">HOD Microbiology Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Microbiology_feedback)
                                                    {{ $data5->hod_Microbiology_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Microbiology Review Completed By
                                        </th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Microbiology_by)
                                                    {{ $data5->hod_Microbiology_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Microbiology Review Completed On
                                        </th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Microbiology_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Microbiology_on)->format('d-M-Y') }}
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
                                    HOD Microbiology Attachment
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Microbiology_attachment)
                                        @foreach (json_decode($data5->hod_Microbiology_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Safety Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Health_Safety_feedback)
                                                    {{ $data5->hod_Health_Safety_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Safety Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Environment_Health_Safety_by)
                                                    {{ $data5->hod_Environment_Health_Safety_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Safety Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Environment_Health_Safety_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Environment_Health_Safety_on)->format('d-M-Y') }}
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
                                    HOD Safety Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Environment_Health_Safety_attachment)
                                        @foreach (json_decode($data5->hod_Environment_Health_Safety_attachment) as $key => $file)
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
                                    Contract Giver

                                </div>
                                <table>

                                    <tr>


                                        <th class="w-20">HOD Contract Giver Status of action item</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ContractGiver_feedback)
                                                    {{ $data5->hod_ContractGiver_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Contract Giver Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ContractGiver_by)
                                                    {{ $data5->hod_ContractGiver_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Contract Giver Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_ContractGiver_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_ContractGiver_on)->format('d-M-Y') }}
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
                                    HOD Contract Giver Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_ContractGiver_attachment)
                                        @foreach (json_decode($data5->hod_ContractGiver_attachment) as $key => $file)
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
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <table>





                                    <tr>


                                        <th class="w-20">HOD Other's 1 Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other1_feedback)
                                                    {{ $data5->hod_Other1_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Other's 1 Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other1_by)
                                                    {{ $data5->hod_Other1_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Other's 1 Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other1_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Other1_on)->format('d-M-Y') }}
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
                                    HOD Other's 1 Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Other1_attachment)
                                        @foreach (json_decode($data5->hod_Other1_attachment) as $key => $file)
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


                                        <th class="w-20">HOD Other's 2 Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other2_feedback)
                                                    {{ $data5->hod_Other2_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Other's 2 Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other2_by)
                                                    {{ $data5->hod_Other2_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Other's 2 Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other2_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Other2_on)->format('d-M-Y') }}
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
                                    HOD Other's 2 Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Other2_attachment)
                                        @foreach (json_decode($data5->hod_Other2_attachment) as $key => $file)
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

                                        <th class="w-20">HOD Other's 3 Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other3_feedback)
                                                    {{ $data5->hod_Other3_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Other's 3 Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other3_by)
                                                    {{ $data5->hod_Other3_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Other's 3 Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other3_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Other3_on)->format('d-M-Y') }}
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
                                    HOD Other's 3 Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Other3_attachment)
                                        @foreach (json_decode($data5->hod_Other3_attachment) as $key => $file)
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
                                        <th class="w-20">HOD Other's 4 Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->Other4_feedback)
                                                    {{ $data5->Other4_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Other's 4 Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other4_by)
                                                    {{ $data5->hod_Other4_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20"> HOD Other's 4 Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other4_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Other4_on)->format('d-M-Y') }}
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
                                    HOD Other's 4 Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Other4_attachment)
                                        @foreach (json_decode($data5->hod_Other4_attachment) as $key => $file)
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


                                        <th class="w-20">HOD Other's 5 Comments</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other5_feedback)
                                                    {{ $data5->hod_Other5_feedback }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <th class="w-20">HOD Other's 5 Review Completed By</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other5_by)
                                                    {{ $data5->hod_Other5_by }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">HOD Other's 5 Review Completed On</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($data5->hod_Other5_on)
                                                    {{ \Carbon\Carbon::parse($data5->hod_Other5_on)->format('d-M-Y') }}
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
                                    HOD Other's 5 Attachments
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data5->hod_Other5_attachment)
                                        @foreach (json_decode($data5->hod_Other5_attachment) as $key => $file)
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


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                QA verification
                            </div>






                            <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                    QA verification Comment </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($managementReview->additional_suport_required)
                                        {{ $managementReview->additional_suport_required }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div>







                        </div>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Action Item Status Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if ($managementReview->qa_verification_file)
                                @foreach (json_decode($managementReview->qa_verification_file) as $key => $file)
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
                                Closure
                            </div>

                            {{-- <table>
                                <tr>

                                    <th class="w-30">Next Management Review Date</th>
                                    <td class="w-20">

                                        {{ Helpers::getdateFormat($managementReview->next_managment_review_date) ?? 'Not Applicable' }}
                                    </td>


                                </tr>



                            </table> --}}
                            <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                    QA Head Comment </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($managementReview->conclusion_new)
                                        {{ $managementReview->conclusion_new }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div>







                        </div>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Closure Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if ($managementReview->closure_attachments)
                                @foreach (json_decode($managementReview->closure_attachments) as $key => $file)
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
                                Activity log
                            </div>
                            <table>

                                <tr>
                                    <th class="w-20">Submit By</th>
                                    <td class="w-30">{{ $managementReview->Submited_by }}</td>
                                    <th class="w-20">Submit On</th>
                                    <td class="w-30">{{ Helpers::getdateFormat($managementReview->Submited_on) }}
                                    </td>
                                    <th class="w-20">Submit Comment</th>
                                    <td class="w-30">{{ $managementReview->Submited_Comment }}</td>



                                </tr>

                                {{-- <tr>
                                    <th class="w-20">Completed By</th>
                                    <td class="w-30">{{ $managementReview->completed_by }}</td>
                                    <th class="w-20">Completed On</th>
                                    <td class="w-30">{{ Helpers::getdateFormat($managementReview->completed_on) }}
                                    </td>
                                    <th class="w-20">Comment</th>
                                    <td class="w-30">{{ $managementReview->Completed_Comment }}</td>
                                </tr> --}}
                                <tr>
                                    <th class="w-20">QA Head Review Complete By</th>
                                    <td class="w-30">{{ $managementReview->qaHeadReviewComplete_By }}</td>
                                    <th class="w-20">QA Head Review Complete On</th>
                                    <td class="w-30">{{ $managementReview->qaHeadReviewComplete_On }}</td>
                                    <th class="w-20">QA Head Review Complete Comment</th>
                                    <td class="w-30">{{ $managementReview->qaHeadReviewComplete_Comment }}</td>



                                </tr>
                                <tr>
                                    <th class="w-20">Meeting and Summary Complete By</th>
                                    <td class="w-30">{{ $managementReview->meeting_summary_by }}</td>
                                    <th class="w-20">Meeting and Summary Complete On</th>
                                    <td class="w-30">{{ $managementReview->meeting_summary_on }}</td>
                                    <th class="w-20">Meeting and Summary Complete Comment</th>
                                    <td class="w-30">{{ $managementReview->meeting_summary_comment }}</td>



                                </tr>
                                <tr>
                                    <th class="w-20">CFT Action Complete By</th>
                                    <td class="w-30">{{ $managementReview->ALLAICompleteby_by }}</td>
                                    <th class="w-20">CFT Action Complete On</th>
                                    <td class="w-30">{{ $managementReview->ALLAICompleteby_on }}</td>
                                    <th class="w-20">CFT Action Complete Comment</th>
                                    <td class="w-30">{{ $managementReview->ALLAICompleteby_comment }}</td>



                                </tr>

                                <tr>
                                    <th class="w-20">CFT HOD Review Complete By</th>
                                    <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_by }}</td>
                                    <th class="w-20">CFT HOD Review Complete On</th>
                                    <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_on }}</td>
                                    <th class="w-20">CFT HOD Review Complete Comment</th>
                                    <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_comment }}</td>



                                </tr>

                                <tr>
                                    <th class="w-20">QA Verification Complete By</th>
                                    <td class="w-30">{{ $managementReview->QAVerificationComplete_by }}</td>
                                    <th class="w-20">QA Verification Complete On</th>
                                    <td class="w-30">{{ $managementReview->QAVerificationComplete_On }}</td>
                                    <th class="w-20">QA Verification Complete Comment</th>
                                    <td class="w-30">{{ $managementReview->QAVerificationComplete_Comment }}</td>



                                </tr>

                                <tr>
                                    <th class="w-20">Approved By</th>
                                    <td class="w-30">{{ $managementReview->Approved_by }}</td>
                                    <th class="w-20">Approved On</th>
                                    <td class="w-30">{{ $managementReview->Approved_on }}</td>
                                    <th class="w-20">Approved Comment</th>
                                    <td class="w-30">{{ $managementReview->Approved_comment }}</td>



                                </tr>


                            </table>
                        </div>
                    </div>
                    {{--
        <div class="block">
            <div class="block-head">

                Agenda
            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th>Row #</th>
                            <th>Date</th>
                            <th>Topic</th>
                            <th>Responsible</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Comment</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (unserialize($agenda->topic) as $key => $temps)
                            <tr>
                                <td>
                                    {{ $key + 1 }}</td>


                                <td>
                                    @php
                                        $date = unserialize($agenda->date)[$key] ?? null;
                                    @endphp
                                    {{ $date ? Carbon::parse($date)->format('d-M-Y') : 'N/A' }}
                                </td>
                                <td>
                                    {{ unserialize($agenda->topic)[$key] ?? 'N/A' }}
                                </td>
                                <td>

                                    {{ unserialize($agenda->responsible)[$key] ? unserialize($agenda->responsible)[$key] : 'N/A' }}
                                </td>
                                <td>

                                    {{ unserialize($agenda->start_time)[$key] ? unserialize($agenda->start_time)[$key] : 'N/A' }}
                                </td>
                                <td>
                                    {{ unserialize($agenda->end_time)[$key] ? unserialize($agenda->end_time)[$key] : 'N/A' }}
                                </td>
                                <td>

                                    {{ unserialize($agenda->comment)[$key] ? unserialize($agenda->comment)[$key] : 'N/A' }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        --}}
                    <div class="block">
                        <div class="block-head">
                            Management Review Participants Part-1
                        </div>
                        <div class="border-table">
                            <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                                <thead>
                                    <tr class="table_bg">
                                        <th style="width: 6%">Row #</th>
                                        <th>Invited Person</th>
                                        <th>Designee</th>
                                        <th>Department</th>
                                        <th>Meeting Attended</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (unserialize($management_review_participants->invited_Person) as $key => $temps)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ unserialize($management_review_participants->invited_Person)[$key] ?? 'N/A' }}
                                            </td>
                                            <td>{{ unserialize($management_review_participants->designee)[$key] ?? 'N/A' }}
                                            </td>
                                            <td>{{ unserialize($management_review_participants->department)[$key] ?? 'N/A' }}
                                            </td>
                                            <td>{{ unserialize($management_review_participants->meeting_Attended)[$key] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-head">
                            Management Review Participants Part-2
                        </div>
                        <div class="border-table">
                            <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                                <thead>
                                    <tr class="table_bg">
                                        <th style="width: 6%">Row #</th>

                                        <th>Designee Name</th>
                                        <th>Designee Department/Designation</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (unserialize($management_review_participants->invited_Person) as $key => $temps)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ unserialize($management_review_participants->designee_Name)[$key] ?? 'N/A' }}
                                            </td>
                                            <td>{{ unserialize($management_review_participants->designee_Department)[$key] ?? 'N/A' }}
                                            </td>
                                            <td>{{ unserialize($management_review_participants->remarks)[$key] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="block">
            <div class="block-head">
                Performance Evaluation

            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th style="width: 6%">Row #</th>
                            <th>Monitoring</th>
                            <th>Measurement</th>
                            <th>Analysis</th>
                            <th>Evalutaion</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach (unserialize($performance_evaluation->monitoring) as $key => $temps)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ unserialize($performance_evaluation->monitoring)[$key] ? unserialize($performance_evaluation->monitoring)[$key] : 'N/A' }}
                                </td>
                                <td>{{ unserialize($performance_evaluation->measurement)[$key] ? unserialize($performance_evaluation->measurement)[$key] : 'N/A' }}
                                </td>
                                <td>{{ unserialize($performance_evaluation->analysis)[$key] ? unserialize($performance_evaluation->analysis)[$key] : 'N/A' }}
                                </td>
                                <td>{{ unserialize($performance_evaluation->evaluation)[$key] ? unserialize($performance_evaluation->evaluation)[$key] : 'N/A' }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="block">
            <div class="block-head">
                Action Item Details - Part 1
            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th style="width: 6%">Row #</th>
                            <th>Short Description</th>
                            <th>Due Date</th>
                            <th style="width: 10%">Site / Division</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (unserialize($action_item_details->date_due) as $key => $due_date)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ unserialize($action_item_details->short_desc)[$key] ?? '' }}</td>
                                <td>{{ Helpers::getdateFormat($due_date) }}</td>
                                <td>{{ unserialize($action_item_details->site)[$key] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
                    {{-- <div class="block">
            <div class="block-head">
                Action Item Details - Part 2
            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th style="width: 6%">Row #</th>
                            <th>Person Responsible</th>
                            <th>Current Status</th>
                            <th>Date Closed</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (unserialize($action_item_details->date_due) as $key => $due_date)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @php
                                        $responsiblePersonId =
                                            unserialize($action_item_details->responsible_person)[$key] ?? null;
                                        $responsiblePerson = $users->firstWhere('id', $responsiblePersonId);
                                    @endphp
                                    {{ $responsiblePerson->name ?? '' }}
                                </td>
                                <td>{{ unserialize($action_item_details->current_status)[$key] ?? '' }}</td>
                                <td>{{ Helpers::getdateFormat(unserialize($action_item_details->date_closed)[$key] ?? null) }}
                                </td>
                                <td>{{ unserialize($action_item_details->remark)[$key] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div> --}}


                    {{-- <div class="block">
            <div class="block-head">
                CAPA Details - Part 2
            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th style="width: 6%">Row #</th>

                            <th>Current Status</th>
                            <th>Date Closed</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($capa_detail_details->date_closed2))
                            @foreach (unserialize($capa_detail_details->date_closed2) as $key => $temps)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}</td>

                                    <td>{{ unserialize($capa_detail_details->current_status2)[$key] ?? '' }}</td>
                                    <td>
                                        @php
                                            $date = unserialize($capa_detail_details->date_closed2)[$key] ?? null;
                                        @endphp
                                        {{ $date ? Carbon::parse($date)->format('d-M-Y') : 'N/A' }}
                                    </td>
                                    <td>{{ unserialize($capa_detail_details->remark2)[$key] ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div> --}}

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
