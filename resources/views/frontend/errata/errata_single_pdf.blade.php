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

    .Summer {
        font-weight: bold;
        font-size: 14px;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    ERRATA Report
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
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
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/ERRATA/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-40">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-60">
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
                        <td class="w-80">
                            @if ($data->id)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/ERRATA/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-80">
                            @if (Helpers::getDivisionName($data->division_id))
                                {{ Helpers::getDivisionName($data->division_id) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-80">{{ $data->originator }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>


                        {{-- <th class="w-20">Department</th> --}}
                        {{-- @php
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
                                'FD' => 'Formulation Development',
                                'AL' => 'Analytical Research and Development Laboratory',
                                'PD' => 'Packaging Development',
                                'PU' => 'Purchase Department',
                                'DC' => 'Document Cell',
                                'RA' => 'Regulatory Affairs',
                                'PV' => 'Pharmacovigilance',
                            ];
                        @endphp --}}
                        {{-- <td class="w-80">
                            @if ($data->Department)
                                {{ $data->Department }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}

                        <th class="w-20">Department</th>
                        <td class="w-30">
                        @if ($data->Department)
                                {{ $data->Department }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Department Code</th>
                        <td class="w-30">
                            @if ($data->department_code)
                                {{ $data->department_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                        <th class="w-20">Document Type</th>
                        <td class="w-80">
                            @if ($data->document_type)
                                {{ $data->document_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                          <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->document_type_others)
                                {{ $data->document_type_others }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        {{-- <th class="w-20 ">Reference Documents</th>
                        <td style="break-word:break-all; word-wrap: break-word; width: 50px;">
                            @if ($data->reference_document)
                                {{ str_replace(',', ', ', $data->reference_document) }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}


                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20 ">Parent Record Number</th>
                        <td class="w-80">
                            @if ($data->reference)
                                {{ str_replace(',', ', ', $data->reference) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                </table> --}}
                <style>
                    .head-number {
                        font-weight: bold;
                        font-size: 13px;
                        padding-left: 8px;
                    }

                    .div-data {
                        font-size: 13px;
                        padding-left: 8px;
                    }
                </style>

                


                {{-- <label for="">Reference Documents</label>
                            <div style="display: block ; overflow:auto; width:200px; height:500px;"> @if ($data->reference_document)
                                {{ $data->reference_document }}
                            @else
                                Not Applicable
                            @endif</div> --}}
                <table>
                    <tr>

                    <th class="w-20">Parent Record Number</th>
                <td class="w-30">
                    @if ($data->reference)
                        {{ str_replace(',', ', ', $data->reference) }}
                    @else
                        Not Applicable
                    @endif
                </td>
                 
                        <th class="w-20">Error Observed on Page No.</th>
                        <td class="w-80">
                            @if ($data->Observation_on_Page_No)
                                {{ $data->Observation_on_Page_No }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Brief Description of error</th>
                        <td class="w-80">
                            @if ($data->brief_description)
                                {{ $data->brief_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    
                            <th class="w-20">Document title</th>
                            <td class="w-80">
                                @if ($data->document_title)
                                    {{ $data->document_title }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                   
                    </tr>

                </table>

                {{-- <label class="Summer" for="">Error Observed on Page No.</label>
                <div>
                    @if ($data->Observation_on_Page_No)
                        {!! $data->Observation_on_Page_No !!}
                    @else
                        Not Applicable
                    @endif
                </div> --}}
                {{-- <tr>
                        <th class="w-20">Error Observed on Page No.</th>
                        <td class="w-80" >
                            @if ($data->Observation_on_Page_No)
                                {!! $data->Observation_on_Page_No !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> --}}
                {{-- <label class="Summer" for="">Brief Description</label>
                <div>
                    @if ($data->brief_description)
                        {!! $data->brief_description !!}
                    @else
                        Not Applicable
                    @endif
                </div> --}}
                {{-- <tr>
                        <th class="w-20">Brief Description</th>
                        <td class="w-80">
                            @if ($data->brief_description)
                                {!! $data->brief_description !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> --}}

                <table>
                   
                    <tr>
                        <th class="w-20">Type Of Error</th>
                        <td class="w-80">
                            @if ($data->type_of_error)
                                {{ $data->type_of_error }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Other</th>
                        <td class="w-80">
                            @if ($data->otherFieldsUser)
                                {{ $data->otherFieldsUser }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Correction Of Error required</th>
                        <td class="w-80">
                            @if ($data->Correction_Of_Error)
                                {{ $data->Correction_Of_Error }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Department Head</th>
                        <td class="w-80">
                            @if ($data->department_head_to)
                                {{ Helpers::getInitiatorName($data->department_head_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">QA reviewer</th>
                        <td class="w-80">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    {{-- <tr> --}}
                    {{-- <th class="w-20">Details</th>
                        <td class="w-80">@if ($data->details){{ $data->details }}@else Not Applicable @endif</td> --}}
                    {{-- </tr> --}}
                </table>

                {{-- <div class="block"> --}}
                {{-- <div class="block-head"> --}}
                {{-- <div style="font-weight: 200">Details</div> --}}
                {{-- </div> --}}
                {{-- <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-20">List Of Impacting Document</th>
                            <!-- <th class="w-20">Prepared By</th>
                            <th class="w-20">Checked By</th>
                            <th class="w-20">Approved By</th> -->
                        </tr>
                        @if ($grid_Data && is_array($grid_Data->data))
                            @foreach ($grid_Data->data as $grid_Data)
                                <tr>
                                    <td class="w-20">{{ $loop->index + 1 }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data['ListOfImpactingDocument']) ? $grid_Data['ListOfImpactingDocument'] : '' }}
                                    </td>
                                    <!-- <td class="w-20">
                                        {{ isset($grid_Data['PreparedBy']) ? $grid_Data['PreparedBy'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data['CheckedBy']) ? $grid_Data['CheckedBy'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data['ApprovedBy']) ? $grid_Data['ApprovedBy'] : '' }}</td> -->
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <!-- <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td> -->
                            </tr>
                        @endif
                    </table>
                </div> --}}
                {{-- </div> --}}

                <div class="block">
                    <div class="block-head">
                        Details
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr. No.</th>
                                <th class="w-20">List Of Impacting Document (If Any)</th>
                                <!-- <th class="w-20">Prepared By</th>
                                <th class="w-20">Checked By</th>
                                <th class="w-20">Approved By</th> -->
                            </tr>
                                @if($grid_Data->ListOfImpactingDocument)
                                @foreach (unserialize($grid_Data->ListOfImpactingDocument) as $key => $dataDemo)
                                <tr>
                                    <td class="w-15">{{ $dataDemo ? $key +1  : "Not Applicable" }}</td>

                                    <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <!-- <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td> -->
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="block-head">
                    HOD Initial Review
                </div>


                {{-- <label class="Summer" for="">HOD Remarks</label>
                <div>
                    @if ($data->HOD_Remarks)
                        {!! $data->HOD_Remarks !!}
                    @else
                        Not Applicable
                    @endif
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">HOD Initial Comment</th>
                        <td class="w-80">
                            @if ($data->HOD_Remarks)
                                {{ $data->HOD_Remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>



                {{-- <table>
                    <tr>
                        <th class="w-20">HOD Remarks</th>
                        <td class="w-80">
                            @if ($data->HOD_Remarks)
                                {!! $data->HOD_Remarks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> --}}

                <div class="border-table">
                    <div class="block-head">
                        HOD Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->HOD_Attachments)
                            @foreach (json_decode($data->HOD_Attachments) as $key => $file)
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
                    QA/CQA Initial Review
                </div>

                {{-- <label class="Summer" for="">QA Feedbacks</label>
                <div>
                    @if ($data->QA_Feedbacks)
                        {!! $data->QA_Feedbacks !!}
                    @else
                        Not Applicable
                    @endif
                </div> --}}


                <table>
                    <tr>
                        <th class="w-20">QA/CQA Initial Comment</th>
                        <td class="w-80">
                            @if ($data->QA_Feedbacks)
                                {!! $data->QA_Feedbacks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20">QA Attachments
                        </th>
                        <td class="w-80">
                            @if ($data->QA_Attachments)
                                {{ str_replace(',', ', ', $data->QA_Attachments) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table> --}}
                <div class="border-table">
                    <div class="block-head">
                        QA/CQA Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->QA_Attachments)
                            @foreach (json_decode($data->QA_Attachments) as $key => $file)
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
                    QA/CQA Head Designee Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">Approval Comment</th>
                        <td class="w-80">
                            @if ($data->Approval_Comment)
                                {{ $data->Approval_Comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        Approval Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Approval_Attachments)
                            @foreach (json_decode($data->Approval_Attachments) as $key => $file)
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
                    Initiator Update
                </div>
                <table>
                    <tr>
                        <th class="w-20">Date Of Correction of document</th>
                        <td class="w-80">
                            @if ($data->Date_and_time_of_correction)
                                {{ $data->Date_and_time_of_correction }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">All Impacting Documents Corrected</th>
                        <td class="w-80">
                            @if ($data->All_Impacting_Documents_Corrected)
                                {{ $data->All_Impacting_Documents_Corrected }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th class="w-20">Remarks</th>
                        <td class="w-80">
                            @if ($data->Remarks)
                                {{ $data->Remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>


                <div class="border-table">
                    <div class="block-head">
                        Initiator Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Initiator_Attachments)
                            @foreach (json_decode($data->Initiator_Attachments) as $key => $file)
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
                    HOD final Review
                </div>

                <table>
                    <tr>
                        <th class="w-20">HOD final Review Comment</th>
                        <td class="w-80">
                            @if ($data->HOD_Comment1)
                                {{ $data->HOD_Comment1 }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        HOD final Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->HOD_Attachments1)
                            @foreach (json_decode($data->HOD_Attachments1) as $key => $file)
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
                <div class="block-head">
                    QA Review
                </div>

                <table>
                    <tr>
                        <th class="w-20">QA Comment</th>
                        <td class="w-80">
                            @if ($data->QA_Comment1)
                                {!! $data->QA_Comment1 !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        QA Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->QA_Attachments1)
                            @foreach (json_decode($data->QA_Attachments1) as $key => $file)
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
            </div> --}}

            <div class="block">
                <div class="block-head">
                    QA/CQA Head Designee Closure Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">Closure Comments</th>
                        <td class="w-80">
                            @if ($data->Closure_Comments)
                                {{ $data->Closure_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        Closure Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr. No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Closure_Attachments)
                            @foreach (json_decode($data->Closure_Attachments) as $key => $file)
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
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">
                            @if ($data->submitted_by)
                                {{ $data->submitted_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Submit On</th>
                        <td class="w-30">
                            @if ($data->submitted_on)
                                {{ $data->submitted_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">
                            @if ($data->comment)
                                {!! $data->comment !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">
                            @if ($data->cancel_by)
                                {{ $data->cancel_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Cancel On</th>
                        <td class="w-30">
                            @if ($data->cancel_on)
                                {{ $data->cancel_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-80">
                            @if ($data->cancel_comment)
                                {{ $data->cancel_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">HOD Initial Review Complete By</th>
                        <td class="w-30">
                            @if ($data->review_completed_by)
                                {{ $data->review_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">HOD Initial Review Complete On</th>
                        <td class="w-30">
                            @if ($data->review_completed_on)
                                {{ $data->review_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Initial Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->review_completed_comment)
                                {{ $data->review_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Complete By</th>
                        <td class="w-30">
                            @if ($data->Reviewed_by)
                                {{ $data->Reviewed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Review Complete On</th>
                        <td class="w-30">
                            @if ($data->Reviewed_on)
                                {{ $data->Reviewed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Complete Comment</th>
                        <td class="w-80">
                            @if ($data->Reviewed_commemt)
                                {{ $data->Reviewed_commemt }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Approval Complete By</th>
                        <td class="w-30">
                            @if ($data->approved_by)
                                {{ $data->approved_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Approval Complete On</th>
                        <td class="w-30">
                            @if ($data->approved_on)
                                {{ $data->approved_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Approval Complete Comment</th>
                        <td class="w-80">
                            @if ($data->approved_comment)
                                {{ $data->approved_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Correction Completed By</th>
                        <td class="w-30">
                            @if ($data->correction_completed_by)
                                {{ $data->correction_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Correction Completed On</th>
                        <td class="w-30">
                            @if ($data->correction_completed_on)
                                {{ $data->correction_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Correction Completed Comment</th>
                        <td class="w-80">
                            @if ($data->correction_completed_comment)
                                {{ $data->correction_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">HOD Review Completed By</th>
                        <td class="w-30">
                            @if ($data->hod_review_complete_by)
                                {{ $data->hod_review_complete_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">HOD Review Completed By On</th>
                        <td class="w-30">
                            @if ($data->hod_review_complete_on)
                                {{ $data->hod_review_complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review Completed Comment</th>
                        <td class="w-80">
                            @if ($data->hod_review_complete_comment)
                                {{ $data->hod_review_complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">QA/CQA Head Approval Completed By</th>
                        <td class="w-30">
                            @if ($data->qa_head_approval_completed_by)
                                {{ $data->qa_head_approval_completed_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">QA/CQA Head Approval Completed On</th>
                        <td class="w-30">
                            @if ($data->qa_head_approval_completed_on)
                                {{ $data->qa_head_approval_completed_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">QA/CQA Head Approval Completed Comment</th>
                        <td class="w-80">
                            @if ($data->qa_head_approval_completed_comment)
                                {{ $data->qa_head_approval_completed_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Sent To Opened State By</th>
                        <td class="w-30">
                            @if ($data->sent_to_open_state_by)
                                {{ $data->sent_to_open_state_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Sent To Opened State On</th>
                        <td class="w-30">
                            @if ($data->sent_to_open_state_on)
                                {{ $data->sent_to_open_state_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Sent To Opened State Comment</th>
                        <td class="w-80">
                            @if ($data->sent_to_open_state_comment)
                                {{ $data->sent_to_open_state_comment }}
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
