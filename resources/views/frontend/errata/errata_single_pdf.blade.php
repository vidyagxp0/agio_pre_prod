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
                    ERRATA Single Report
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
                    <strong>Errata No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number->record_number, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

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
                            @if ($data->id)
                                {{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if (Helpers::getDivisionName(session()->get('division')))
                                {{ Helpers::getDivisionName(session()->get('division')) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_by)
                                {{ $data->initiated_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Department</th>
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
                        <td class="w-80">{{ $departments[$data->Department] ?? 'Unknown Department' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Department Code</th>
                        <td class="w-80">{{ $data->department_code }}</td>

                        <th class="w-20">Document Type</th>
                        <td class="w-80">{{ $data->document_type }}</td>

                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Reference Documents</th>
                        <td class="w-80">{{ $data->reference_document }}</td>


                    </tr>
                    <tr>
                        <th class="w-20">Error Observed on Page No.</th>
                        <td class="w-30">
                            @if ($data->Observation_on_Page_No)
                                {!! $data->Observation_on_Page_No !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Brief Description</th>
                        <td class="w-80">
                            @if ($data->brief_description)
                                {!! $data->brief_description !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                    <tr>
                        <th class="w-20">Type Of Error</th>
                        <td class="w-80">
                            @if ($data->type_of_error)
                                {{ $data->type_of_error }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Date And Time of Correction</th>
                        <td class="w-80">
                            @if ($data->Date_and_time_of_correction)
                                {{ $data->Date_and_time_of_correction }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    <tr>
                        {{-- <th class="w-20">Details</th>
                        <td class="w-80">@if ($data->details){{ $data->details }}@else Not Applicable @endif</td> --}}
                    </tr>
                </table>

                {{-- <div class="block"> --}}
                {{-- <div class="block-head"> --}}
                <div style="font-weight: 200">Details</div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">SR no.</th>
                            <th class="w-20">ListOfImpactingDocument</th>
                            <th class="w-20">Prepared By</th>
                            <th class="w-20">Checked By</th>
                            <th class="w-20">Approved By</th>
                        </tr>
                        @if ($grid_Data && is_array($grid_Data->data))
                            @foreach ($grid_Data->data as $grid_Data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ isset($grid_Data['ListOfImpactingDocument']) ? $grid_Data['ListOfImpactingDocument'] : '' }}
                                    </td>
                                    <td>{{ isset($grid_Data['PreparedBy']) ? $grid_Data['PreparedBy'] : '' }}</td>
                                    <td>{{ isset($grid_Data['CheckedBy']) ? $grid_Data['CheckedBy'] : '' }}</td>
                                    <td>{{ isset($grid_Data['ApprovedBy']) ? $grid_Data['ApprovedBy'] : '' }}</td>
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
                {{-- </div> --}}
            </div>


            <div class="block">
                <div class="block-head">
                    HOD Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">HOD Remarks</th>
                        <td class="w-80">
                            @if ($data->HOD_Remarks)
                                {!! $data->HOD_Remarks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Attachments
                        </th>
                        <td class="w-80">
                            @if ($data->HOD_Attachments)
                                {!! $data->HOD_Attachments !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    QA Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Fedbacks</th>
                        <td class="w-80">
                            @if ($data->QA_Feedbacks)
                                {!! $data->QA_Feedbacks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Attachments
                        </th>
                        <td class="w-80">
                            @if ($data->QA_Attachments)
                                {{ $data->QA_Attachments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    QA Head Designee Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">Closure Comments</th>
                        <td class="w-80">
                            @if ($data->Closure_Comments)
                                {!! $data->Closure_Comments !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">All Impacting Documents Corrected</th>
                        <td class="w-80">
                            @if ($data->All_Impacting_Documents_Corrected)
                                {{ $data->All_Impacting_Documents_Corrected }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Remarks (If Any) </th>
                        <td class="w-80">
                            @if ($data->Remarks)
                                {!! $data->Remarks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Closure Attachments</th>
                        <td class="w-80">
                            @if ($data->Closure_Attachments)
                                {{ $data->Closure_Attachments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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
                        <td class="w-80">
                            @if ($data->submitted_by)
                                {{ $data->submitted_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Submitted On</th>
                        <td class="w-80">
                            @if ($data->submitted_on)
                                {{ $data->submitted_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->comment)
                                {!! $data->comment !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Completed By</th>
                        <td class="w-80">
                            @if ($data->review_completed_by)
                                {{ $data->review_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Review Completed On</th>
                        <td class="w-80">
                            @if ($data->review_completed_on)
                                {{ $data->review_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->review_completed_comment)
                                {{ $data->review_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Correction Completed By</th>
                        <td class="w-80">
                            @if ($data->correction_completed_by)
                                {{ $data->correction_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Correction Completed On</th>
                        <td class="w-80">
                            @if ($data->correction_completed_on)
                                {{ $data->correction_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->correction_completed_comment)
                                {{ $data->correction_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">HOD Review Complete By</th>
                        <td class="w-80">
                            @if ($data->hod_review_complete_by)
                                {{ $data->hod_review_complete_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">HOD Review Complete By On</th>
                        <td class="w-80">
                            @if ($data->hod_review_complete_on)
                                {{ $data->hod_review_complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->hod_review_complete_comment)
                                {{ $data->hod_review_complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">QA Head Aproval Completed By</th>
                        <td class="w-80">
                            @if ($data->qa_head_approval_completed_by)
                                {{ $data->qa_head_approval_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">QA Head Aproval Completed On</th>
                        <td class="w-80">
                            @if ($data->qa_head_approval_completed_on)
                                {{ $data->qa_head_approval_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->qa_head_approval_completed_comment)
                                {{ $data->qa_head_approval_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Sent to Opened State By</th>
                        <td class="w-80">
                            @if ($data->sent_to_open_state_by)
                                {{ $data->sent_to_open_state_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Sent to Opened State On</th>
                        <td class="w-80">
                            @if ($data->sent_to_open_state_on)
                                {{ $data->sent_to_open_state_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->sent_to_open_state_comment)
                                {{ $data->sent_to_open_state_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Reject By</th>
                        <td class="w-80">
                            @if ($data->reject_by)
                                {{ $data->reject_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Reject On</th>
                        <td class="w-80">
                            @if ($data->reject_on)
                                {{ $data->reject_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->reject_comment)
                                {{ $data->reject_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-80">
                            @if ($data->cancel_by)
                                {{ $data->cancel_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Cancel On</th>
                        <td class="w-80">
                            @if ($data->cancel_on)
                                {{ $data->cancel_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Comment</th>
                        <td class="w-80">
                            @if ($data->cancel_comment)
                                {{ $data->cancel_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                </table>
            </div>


        </div>
    </div>

</body>

</html>
