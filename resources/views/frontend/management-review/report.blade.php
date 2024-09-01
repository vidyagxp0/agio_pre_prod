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
                    Management Review Single Report
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
                            @if ($managementReview->division_code)
                                {{ $managementReview->division_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        {{-- <!-- <td class="w-30"> --}}
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
                          <td class="w-30">{{ $departments[$managementReview->initiator_Group] ?? 'Unknown Department' }}</td>
                 {{-- @if ($managementReview->initiator_Group)
                {{ $managementReview->initiator_Group }}
                        @else
                            Not Applicable 
                            @endif --}}
                                                {{-- </td>  --}}
                        {{-- <td class="w-30">{{ Helpers::getInitiatorName($managementReview->initiator_Group) }}</td> --}}
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">
                            @if ($managementReview->initiator_group_code)
                                {{ $managementReview->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($managementReview->assign_to)
                                {{ Helpers::getInitiatorName($managementReview->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Priority Level</th>
                        <td class="w-30">
                            @if ($managementReview->priority_level)
                                {{ $managementReview->priority_level }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
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
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            {{-- @if ($managementReview->due_date)
                                {{ $managementReview->due_date }}
                            @else
                                Not Applicable
                            @endif --}}
                            {{  Helpers::getdateFormat($managementReview->due_date) ?? 'Not Applicable' }}
                        </td>
                        <th class="w-20">Type</th>
                        <td class="w-30">
                            @if ($managementReview->type)
                                {{ $managementReview->type }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                    <tr>

                        <th class="w-30"> Schedule Start Date</th>
                        <td class="w-20">
                            {{-- @if ($managementReview->start_date)
                                {{ $managementReview->start_date }}
                            @else
                                Not Applicable
                            @endif --}}
                            {{  Helpers::getdateFormat($managementReview->start_date) ?? 'Not Applicable' }}
                        </td>
                        <th class="w-30"> Schedule End Date</th>
                        <td class="w-20">
                            {{-- @if ($managementReview->end_date)
                                {{ $managementReview->end_date }}
                            @else
                                Not Applicable
                            @endif --}}
                            {{  Helpers::getdateFormat($managementReview->end_date) ?? 'Not Applicable' }}

                        </td>

                    </tr>


                </table>
                <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Attendess</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->attendees)
                            {{ $managementReview->attendees }}
                        @else
                            Not Applicable
                        @endif

                </div>
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
                        File Attachment
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
                    Operational planning and control
                </div>


                <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline;">Operations</label>
                    <span style="font-size: 0.8rem; margin-left: 70px;">

                        @if ($managementReview->Operations)
                            {{ $managementReview->Operations }}
                        @else
                            Not Applicable
                        @endif

                </div>
                <div class="inner-block">
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

                </div>
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



            </div>
            <div class="border-table">
                {{-- <div class="block-head">
                    File Attachment
                </div> --}}
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
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Meetings and summary
                    </div>

                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Risk &
                            Opportunities</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->risk_opportunities)
                                {{ $managementReview->risk_opportunities }}
                            @else
                                Not Applicable
                            @endif

                    </div>

                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">External
                            Supplier Performance</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->external_supplier_performance)
                                {{ $managementReview->external_supplier_performance }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Customer
                            Satisfaction Level</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->customer_satisfaction_level)
                                {{ $managementReview->customer_satisfaction_level }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Budget
                            Estimation</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->budget_estimates)
                                {{ $managementReview->budget_estimates }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Completion
                            of Previous Tasks</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->completion_of_previous_tasks)
                                {{ $managementReview->completion_of_previous_tasks }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer"
                            style="font-weight: bold; font-size: 13px; display: inline;">Production</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->production_new)
                                {{ $managementReview->production_new }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer"
                            style="font-weight: bold; font-size: 13px; display: inline;">Plans</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->plans_new)
                                {{ $managementReview->plans_new }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer"
                            style="font-weight: bold; font-size: 13px; display: inline;">Forecast</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->forecast_new)
                                {{ $managementReview->forecast_new }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Any
                            Additional Support Required</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->additional_suport_required)
                                {{ $managementReview->additional_suport_required }}
                            @else
                                Not Applicable
                            @endif

                    </div>





                </div>
                <div class="border-table">
                    <div class="block-head">
                        File Attachment, if any
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



                <div class="block">
                    <div class="block-head">
                        Closure
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Next Management Review Date
                            </th>
                            <td class="w-80">
                                <div>
                                    @if ($managementReview->next_managment_review_date)
                                        {{ $managementReview->next_managment_review_date }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Summary &
                            Recommendation</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->summary_recommendation)
                                {{ $managementReview->summary_recommendation }}
                            @else
                                Not Applicable
                            @endif

                    </div>
                    <div class="inner-block">
                        <label class="Summer"
                            style="font-weight: bold; font-size: 13px; display: inline;">Conclusion</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->conclusion_new)
                                {{ $managementReview->conclusion_new }}
                            @else
                                Not Applicable
                            @endif

                    </div>

                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline;">Due Date
                            Extension Justification</label>
                        <span style="font-size: 0.8rem; margin-left: 70px;">

                            @if ($managementReview->due_date_extension)
                                {{ $managementReview->due_date_extension }}
                            @else
                                Not Applicable
                            @endif

                    </div>


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
                    Signatures
                </div>
                <table>

                    <tr>
                        <th class="w-20">Submited By</th>
                        <td class="w-30">{{ $managementReview->Submited_by }}</td>
                        <th class="w-20">Submited On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->Submited_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->Submited_Comment }}</td>



                    </tr>

                    <tr>
                        <th class="w-20">Completed By</th>
                        <td class="w-30">{{ $managementReview->completed_by }}</td>
                        <th class="w-20">Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->completed_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->Completed_Comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Head Review Complete By</th>
                        <td class="w-30">{{ $managementReview->qaHeadReviewComplete_By }}</td>
                        <th class="w-20">QA Head Review Complete On</th>
                        <td class="w-30">{{ $managementReview->qaHeadReviewComplete_On }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->qaHeadReviewComplete_Comment }}</td>



                    </tr>
                    <tr>
                        <th class="w-20">Meeting and Summary Complete By</th>
                        <td class="w-30">{{ $managementReview->meeting_summary_by }}</td>
                        <th class="w-20">Meeting and Summary Complete On</th>
                        <td class="w-30">{{ $managementReview->meeting_summary_on }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->meeting_summary_comment }}</td>



                    </tr>
                    <tr>
                        <th class="w-20">All AI Completed by Respective Department By</th>
                        <td class="w-30">{{ $managementReview->ALLAICompleteby_by }}</td>
                        <th class="w-20">All AI Completed by Respective Department On</th>
                        <td class="w-30">{{ $managementReview->ALLAICompleteby_on }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->ALLAICompleteby_comment }}</td>



                    </tr>

                    <tr>
                        <th class="w-20">HOD Final Review Complete By</th>
                        <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_by }}</td>
                        <th class="w-20">HOD Final Review Complete On</th>
                        <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_on }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->hodFinaleReviewComplete_comment }}</td>



                    </tr>

                    <tr>
                        <th class="w-20">QA Verification Complete By</th>
                        <td class="w-30">{{ $managementReview->QAVerificationComplete_by }}</td>
                        <th class="w-20">QA Verification Complete On</th>
                        <td class="w-30">{{ $managementReview->QAVerificationComplete_On }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->QAVerificationComplete_Comment }}</td>



                    </tr>

                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $managementReview->Approved_by }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ $managementReview->Approved_on }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $managementReview->Approved_comment }}</td>



                    </tr>


                </table>
            </div>
        </div>

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
                                <td>{{ unserialize($management_review_participants->designee)[$key] ?? 'N/A' }}</td>
                                <td>{{ unserialize($management_review_participants->department)[$key] ?? 'N/A' }}</td>
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
                                <td>{{ unserialize($management_review_participants->remarks)[$key] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="block">
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
        </div>
        <div class="block">
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
        </div>
        <div class="block">
            <div class="block-head">
                CAPA Details - Part 1
            </div>
            <div class="border-table">
                <table style="margin-top: 20px; width:100%;table-layout:fixed;">
                    <thead>
                        <tr class="table_bg">
                            <th style="width: 6%">Row #</th>
                            <th>CAPA Details</th>
                            <th>CAPA Type</th>
                            <th>Site / Division</th>
                            <th>Person Responsible</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($capa_detail_details->date_closed2))
                            @foreach (unserialize($capa_detail_details->date_closed2) as $key => $temps)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ unserialize($capa_detail_details->Details)[$key] ?? '' }}</td>
                                    <td>
                                        {{ unserialize($capa_detail_details->capa_type)[$key] == 'corrective' ? 'Corrective' : '' }}
                                        {{ unserialize($capa_detail_details->capa_type)[$key] == 'preventive' ? 'Preventive' : '' }}
                                        {{ unserialize($capa_detail_details->capa_type)[$key] == 'corrective_preventive' ? 'Corrective & Preventive' : '' }}
                                    </td>
                                    <td>{{ unserialize($capa_detail_details->site2)[$key] ?? '' }}</td>
                                    <td>
                                        {{-- @foreach ($users as $undata)
                                            <option
                                                {{ unserialize($capa_detail_details->responsible_person2)[$key] == $undata->id ? 'selected' : '' }}
                                                value="{{ $undata->id }}">
                                                {{ $undata->name }}
                                            </option>
                                        @endforeach --}}
                                        @php
                                            $responsiblePersonId =
                                                unserialize($capa_detail_details->responsible_person2)[$key] ?? null;
                                            $responsiblePerson = $users->firstWhere('id', $responsiblePersonId);
                                        @endphp
                                        {{ $responsiblePerson->name ?? '' }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block">
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
