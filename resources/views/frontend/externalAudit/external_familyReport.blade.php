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
      

    @page {
         margin: 160px 35px 100px; /* top header, side margin, bottom footer */
     }
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
        margin-top: 10px;
        margin-bottom: -60px; 
    }

    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        /* padding: 20px 35px; */
        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: 0;
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }
    /* To remove borders from content part only */
    .content-area table {
        border: none !important;
    }

    .inner-block {
        /* padding: 20px 35px;  */
        box-sizing: border-box;
    }
    
    .block {
        margin-bottom: 25px;
    }

    .block-head {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 2px solid #387478;
        color: #387478;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .table_bg {
        background-color: #387478;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    th, td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-50 { width: 50%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }
    table th, table td {
        word-wrap: break-word;
    }


        .head-number {
            font-weight: bold;
            font-size: 13px;
            padding-left: 10px;
        }

        .div-data {
            font-size: 13px;
            padding-left: 10px;
            margin-bottom: 10px;
        }



                .why-why-chart-container {
                width: 100%;
                padding: 10px;
                background: #fff;
                border-radius: 5px;
            }

            .block-head {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th, .table td {
                padding: 10px;
                border: 1px solid #ddd;
            }

            .problem-statement th {
                background: #f4bb22;
                width: 150px;
            }

            .why-label {
                color: #393cd4;
                width: 150px;
            }

            .answer-label {
                color: #393cd4;
                width: 150px;
            }

            .root-cause th {
                background: #0080006b;
                width: 150px;
            }

            .text-muted {
                color: gray;
            }
    </style>



<body>

    <header>

    <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                     External Audit Family Report
                    </div>
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
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>

                <td class="w-30">
                    <strong>Page No.</strong>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-50">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-50">
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

                <table style="width: 100%; border-collapse: collapse;" border="1">
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

                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getDateFormat($data->intiation_date) }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ $data->Initiator_Group }}
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
                        <td class="w-30">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">If Other</th>
                        <td class="w-30">
                            @if ($data->if_other)
                                {{ $data->if_other }}
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
                </table>



                <div class="block">
                    <div class="block-head">
                        Auditors
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-20">Auditor Name</th>
                                <th class="w-20">External Agency Name</th>
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
            <table>
                <tr>
                    <th class="w-20">Start Date of Audit</th>
                    <td class="w-30">
                        @if ($data->start_date_gi)
                            {{  Helpers::getdateFormat($data->start_date_gi) }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">End Date of Audit</th>
                    <td class="w-30" colspan="3">
                        @if ($data->end_date_gi)
                            {{ Helpers::getdateFormat($data->end_date_gi) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    GI Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->inv_attachment)
                        @foreach (json_decode($data->inv_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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



            

            <div class="border-table">
                <div class="block-head">
                    Summary Response
                </div>
                <table>
                        <thead>
                            <tr class="table_bg" >
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 15%;">Observation</th>
                                <th style="width: 15%;">Category</th>
                                <th style="width: 15%;">Response</th>
                                <th style="width: 20%;">CAPA / Child Action Reference If Any</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 20%;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($grid_Data_2 && is_array($grid_Data_2->data))
                                @foreach ($grid_Data_2->data as $grid_Data_2)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{ isset($grid_Data_2['observation']) ? $grid_Data_2['observation'] : '' }}
                                        </td>
                                        
                                        <td>
                                            {{ isset($grid_Data_2['category']) ? $grid_Data_2['category'] : '' }}</td>
                                    
                                        <td>
                                            {{ isset($grid_Data_2['response']) ? $grid_Data_2['response'] : '' }}</td>
                                        <td>
                                            {{ isset($grid_Data_2['reference_id']) ? $grid_Data_2['reference_id'] : '' }}
                                        </td>

                                        <td>
                                            {{ isset($grid_Data_2['status']) ? $grid_Data_2['status'] : '' }}</td>
                                        
                                        <td>
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
                                    <td>Not Applicable</td>
                                </tr>
                            @endif
                        </tbody>
                </table>
            </div>

        <div class="border-table">
            <div class="block-head">
                Summary And Response Attachment
            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment</th>
                </tr>
                @if ($data->myfile)
                    @foreach (json_decode($data->myfile) as $key => $file)
                        <tr>
                            <td class="w-20">{{ $key + 1 }}</td>
                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                    target="_blank"><b>{{ $file }}</b></a> </td>
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






        <br>
        <div class="block">
            <div class="head">
                <div class="block-head">
                    CFT Review
                </div>
                <div class="head">
                    <div class="block-head">
                        Production (Tablet/Capsule/Powder)
                    </div>
                    <table>

                        <tr>

                            <th class="w-20">Production Tablet/Capsule / Powder Review Comment Required ?   
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
                            <th class="w-20">Production Tablet/Capsule / Powder Person</th>
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

                            <th class="w-20">Review comment (By Production Tablet/Capsule / Powder)
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

                            <th class="w-20">Production Tablet/Capsule /  Powder Review Completed By</th>
                            <td class="w-30">
                                <div>
                                    @if ($data1->Production_Table_By)
                                        {{ $data1->Production_Table_By }}
                                    @else
                                        Not Applicable
                                    @endif
                                </div>
                            </td>
                            <th class="w-20">Production Tablet/Capsule / Powder Review Completed On</th>
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
                        Production Tablet/Capsule / Powder Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Production_Table_Attachment)
                                @foreach (json_decode($data1->Production_Table_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Production_Injection_Attachment)
                                @foreach (json_decode($data1->Production_Injection_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                </div>
                <div class="block">
                    <div class="head">
                        <div class="block-head">
                            Research & Development
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Research & Development Review  Comment  Required ?
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

                                <th class="w-20">Review Comment (By Research & Development)</th>
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
                        Research & Development Attachment
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->ResearchDevelopment_attachment)
                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Human_Resource_attachment)
                                @foreach (json_decode($data1->Human_Resource_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <td class="w-30" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Store_attachment)
                                @foreach (json_decode($data1->Store_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Engineering_attachment)
                                @foreach (json_decode($data1->Engineering_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->RegulatoryAffair_attachment)
                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Quality_Assurance_attachment)
                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->ProductionLiquid_attachment)
                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Quality_Control_attachment)
                                @foreach (json_decode($data1->Quality_Control_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Microbiology_attachment)
                                @foreach (json_decode($data1->Microbiology_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Environment_Health_Safety_attachment)
                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->ContractGiver_attachment)
                                    @foreach (json_decode($data1->ContractGiver_attachment) as $key => $file)
<tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
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
                    </div> -->


                <div class="block">
                    <div class="head">
                        <div class="block-head">
                            Other's 1 ( Additional Person Review From Departments If Required)
                        </div>
                      <table>
                        <tr>
                            <th class="w-20">Other's 1 Review Comment Required?</th>
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
                        </tr>

                        <tr>
                            <th class="w-20">Other's 1 Department</th>
                            <td class="w-80" colspan="3">
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
                            <th class="w-20">Review Comment (By Other's 1)</th>
                            <td class="w-80" colspan="3">
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

                            <th class="w-20">Other's 1 Review Completed On</th>
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Other1_attachment)
                                @foreach (json_decode($data1->Other1_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                
                            </tr>

                            <tr>
                             <th class="w-20">Other's 2 Department</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Other2_Department_person)
                                            {{ $data1->Other2_Department_person ?? '' }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                            <th class="w-20">Review comment (By Other's 2)</th>
                               <td class="w-80" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Other2_attachment)
                                @foreach (json_decode($data1->Other2_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                
                            </tr>

                            <tr>
                             <th class="w-20">Other's 3 Department</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Other3_Department_person)
                                            {{ $data1->Other3_Department_person ?? '' }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 3)</th>
                                 <td class="w-80" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Other3_attachment)
                                @foreach (json_decode($data1->Other3_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                                
                            </tr>

                            <tr>
                              <th class="w-20">Other's 4 Department</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Other4_Department_person)
                                            {{ $data1->Other4_Department_person ?? '' }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th class="w-20">Review comment (By Other's 4)</th>
                                <td class="w-80" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Other4_attachment)
                                @foreach (json_decode($data1->Other4_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                               
                            </tr>

                            <tr>
                             <th class="w-20">Other's 5 Department</th>
                                <td class="w-80" colspan="3">
                                    <div>
                                        @if ($data1->Other5_Department_person)
                                            {{ $data1->Other5_Department_person ?? '' }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th class="w-20">Review comment (By Other's 5)</th>
                                <td class="w-80" colspan="3">
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data1->Other5_attachment)
                                @foreach (json_decode($data1->Other5_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->qa_cqa_attach)
                            @foreach (json_decode($data->qa_cqa_attach) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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









            <br>
            <br>


                <div class="block">
                    <div class="block-head">
                        Activity Log
                    </div>
                  <table>
                    <tr>
                        <th class="w-20">Audit Details Summary By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->audit_details_summary_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">Audit Details Summary On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->audit_details_summary_on) ? Helpers::getdateFormat($data->audit_details_summary_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Audit Details Summary Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->audit_details_summary_on_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Cancel By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->cancelled_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">Cancel On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->cancelled_on) ? Helpers::getdateFormat($data->cancelled_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Cancel Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->cancelled_on_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Summary and Response Complete By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->summary_and_response_com_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">Summary and Response Complete On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->summary_and_response_com_on) ? Helpers::getdateFormat($data->summary_and_response_com_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Summary and Response Complete Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->summary_and_response_com_on_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">CFT Review Not Required By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->cft_review_not_req_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">CFT Review Not Required On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->cft_review_not_req_on) ? Helpers::getdateFormat($data->cft_review_not_req_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Not Required Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->cft_review_not_req_on_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">CFT Review Complete By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->cft_review_complete_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">CFT Review Complete On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->cft_review_complete_on) ? Helpers::getdateFormat($data->cft_review_complete_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Complete Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->cft_review_complete_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Send to Opened By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->send_to_opened_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">Send to Opened On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->send_to_opened_on) ? Helpers::getdateFormat($data->send_to_opened_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Send to Opened Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->send_to_opened_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Approval Complete By :</th>
                        <td class="w-30">
                            <div class="static">{{ $data->approval_complete_by ?? 'Not Applicable' }}</div>
                        </td>
                        <th class="w-20">Approval Complete On :</th>
                        <td class="w-30">
                            <div class="static">{{ !empty($data->approval_complete_on) ? Helpers::getdateFormat($data->approval_complete_on) : 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Approval Complete Comment :</th>
                        <td class="w-80">
                            <div class="static">{{ $data->approval_complete_on_comment ?? 'Not Applicable' }}</div>
                        </td>
                    </tr>
                </table>

                </div>
            </div>
        </div>


    @if (count($Obs_Data) > 0)
        @foreach ($Obs_Data as $data)

            <center>
                <h3>Observation Child Report</h3>
            </center>

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
                                        {{ Helpers::getDivisionName($data->division_code) }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    {{-- <th class="w-20">Site/Location Code</th>
                                    <td class="w-30">
                                        @if (Helpers::getDivisionName(session()->get('division')))
                                            {{ Helpers::getDivisionName(session()->get('division')) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td> --}}
                                    <th class="w-20">Site/Location Code</th>
                                    <td class="w-30">
                                        @if (Helpers::getDivisionName($data->division_code))
                                            {{ Helpers::getDivisionName($data->division_code) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                                <tr> {{ $data->created_at }} added by {{ $data->originator }}
                                    <th class="w-20">Initiator</th>
                                    <td class="w-30">{{ $data->originator }}</td>

                                    <th class="w-20">Date Of Initiation</th>
                                    <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                                </tr>

                                <tr>
                                    @php
                                        $users = DB::table('users')->select('id', 'name')->get();
                                        $matched = false;
                                    @endphp
                                    <th class="w-20">Auditee Department Head</th>
                                    @foreach ($users as $value)
                                        @if ($data->assign_to == $value->id)
                                            <td class="w-30">{{ $value->name }}</td>
                                            @php $matched = true; @endphp
                                        @break
                                    @endif
                                    @endforeach

                                    @if (!$matched)
                                        <td>Not Applicable</td>
                                    @endif

                                    <th class="w-20">Auditee Department Name</th>
                                    <td class="w-30">
                                        @if ($data->auditee_department)
                                            {{ $data->auditee_department }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <table>    
                                <tr>
                                    <th class="w-20">Observation Report Due Date</th>
                                    <td class="w-80">
                                        @if ($data->due_date)
                                            {{ Helpers::getdateFormat($data->due_date) }}
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
                                </tr>
                            </table>

                        <div class="block-head">
                            Attached files
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->attach_files_gi)
                                    @foreach(json_decode($data->attach_files_gi) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                        </div>

                        <table>
                            <tr>
                                <th class="w-20">Response Due Date</th>
                                <td class="w-80">
                                    @if ($data->recomendation_capa_date_due)
                                        {{ $data->recomendation_capa_date_due }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
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

                            <div class="block">
                                <div class="block-head">
                                Observation
                                </div>
                                <div class="border-table">
                                <table class="table table-bordered" id="Details-table">
                                    <thead>
                                        <tr class="table_bg">
                                            <th style="width: 8%">Sr.No</th>
                                            <th style="width: 80%">Observation</th>
                                            <th style="width: 80%">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @if ($grid_Data_obs && is_array($grid_Data_obs->data))
                                    @foreach ($grid_Data_obs->data as $datas)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ isset($datas['non_compliance']) ? $datas['non_compliance'] : '' }}</td>
                                            <td>{{ isset($datas['category']) ? $datas['category'] : '' }}</td>

                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>

                                </table>
                                </div>
                            </div>

                    <div class="block">
                        <div class="block-head">
                            Response and CAPA Plan Details
                        </div>
                            <div class="block">
                                <div class="block-head">
                                Response Details
                                </div>
                                <div class="border-table">
                                    <table class="table table-bordered" id="Details-table">
                                        <thead>
                                            <tr class="table_bg">
                                                <th style="width: 8%">Sr.No</th>
                                                <th style="width: 80%">Response Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($grid_Data2_obs && is_array($grid_Data2_obs->data))
                                                @foreach ($grid_Data2_obs->data as $datas)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ isset($datas['response_detail']) ? $datas['response_detail'] : '' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="block">
                                <div class="block-head">
                                Corrective Actions
                                </div>
                                <div class="border-table">
                                <table class="table table-bordered" id="Details-table">
                                    <thead>
                                        <tr class="table_bg">
                                            <th style="width: 8%">Sr.No</th>
                                            <th style="width: 80%">Corrective Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($grid_Data3_obs && is_array($grid_Data3_obs->data))
                                    @foreach ($grid_Data3_obs->data as $datas)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ isset($datas['corrective_action']) ? $datas['corrective_action'] : '' }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div class="block">
                                <div class="block-head">
                                Preventive Action
                                </div>
                                <div class="border-table">
                                <table class="table table-bordered" id="Details-table">
                                    <thead>
                                        <tr class="table_bg">
                                            <th style="width: 8%">Sr.No</th>
                                            <th style="width: 80%">Preventive Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($grid_Data4_obs && is_array($grid_Data4_obs->data))
                                    @foreach ($grid_Data4_obs->data as $datas)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ isset($datas['preventive_action']) ? $datas['preventive_action'] : '' }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>

                        <div class="block">
                            <div class="block-head">
                                Action Plan
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20" style="width: 25px;">Sr.No</th>
                                        <th class="w-20">Action</th>
                                        <th class="w-20">Responsible</th>
                                        <th class="w-20">Target Completion Date</th>
                                        <th class="w-20">Action Status</th>
                                    </tr>
                                    @foreach (unserialize($griddata_obs->action) as $key => $temps)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ unserialize($griddata_obs->action)[$key] ? unserialize($griddata_obs->action)[$key] : '' }}</td>
                                            <td>
                                            @foreach ($users as $value)
                                                @if ($griddata_obs && unserialize($griddata_obs->responsible)[$key] == $value->id)
                                                        {{ $value->name }}
                                                @endif

                                            @endforeach
                                            </td>
                                            <td>{{ Helpers::getdateFormat(unserialize($griddata_obs->deadline)[$key]) }}</td>
                                            <td>{{ unserialize($griddata_obs->item_status)[$key] ? unserialize($griddata_obs->item_status)[$key] : '' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        {{-- <label class="head-number" for="Comments">Comments</label>
                            <div class="div-data">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </div> --}}

                        <table>
                            <tr>
                                <th class="w-20">Comments</th>
                                <td class="w-80">
                                    @if ($data->comments)
                                        {{ $data->comments }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="block-head">
                            Response And CAPA Attachments
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->response_capa_attach)
                                    @foreach(json_decode($data->response_capa_attach) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                    </div>
                    </div>
                        <div class="block-head">
                            Summary
                        </div>
                        <div class="block-head">
                            Action Summary
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Actual Action Start Date</th>
                                <td class="w-30">
                                    @if ($data->actual_start_date)
                                        {{ Helpers::getdateFormat($data->actual_start_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                <th class="w-20">Actual Action End Date</th>
                                <td class="w-30">
                                    @if ($data->actual_end_date)
                                        {{ Helpers::getdateFormat($data->actual_end_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20 align-top">Action Taken</th>
                                <td class="w-80" colspan="3">
                                    @if ($data->action_taken)
                                        <div class="summernote-scroll-wrapper" style="overflow-x: auto; max-width: 100%;">
                                            <div class="summernote-content">
                                                {!! $data->action_taken !!}
                                            </div>
                                        </div>
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- <label class="head-number" for="Observation (+)">Action Taken</label>
                            <div class="div-data">
                                @if ($data->action_taken)
                                    {{ $data->action_taken }}
                                @else
                                    Not Applicable
                                @endif
                            </div> -->

                            <!-- <div class="other-container ">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                <div class="bold">Action Taken</div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="custom-procedure-block">
                                    <div class="custom-container">
                                        <div class="custom-table-wrapper" id="custom-table2">
                                            <div class="custom-procedure-content">
                                                <div class="custom-content-wrapper">
                                                    <div class="table-containers">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="block-head">
                                Response Summary
                            </div>
                            <!-- <div class="other-container ">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                <div class="bold">Response Summary</div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="custom-procedure-block">
                                    <div class="custom-container">
                                        <div class="custom-table-wrapper" id="custom-table2">
                                            <div class="custom-procedure-content">
                                                <div class="custom-content-wrapper">
                                                    <div class="table-containers">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <table>
                                <tr>
                                    <th class="w-20 align-top">Response Summary</th>
                                    <td class="w-80" colspan="3">
                                        @if ($data->response_summary)
                                            <div class="summernote-scroll-wrapper" style="overflow-x: auto; max-width: 100%;">
                                                <div class="summernote-content">
                                                    {!! $data->response_summary !!}
                                                </div>
                                            </div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <div class="block-head">
                                Response and Summary Attachment
                            </div>

                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->impact_analysis)
                                        @foreach(json_decode($data->impact_analysis) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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

                            <div class="block-head">
                                Response Verification
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Response Verification Comment</th>
                                    <td class="w-80">
                                        @if ($data->impact)
                                            {{ $data->impact }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <div class="block-head">
                            Response Verification Attachments
                            </div>

                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->attach_files2)
                                        @foreach(json_decode($data->attach_files2) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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

                            <div class="block-head">
                                Activity Log
                            </div>
                            
                            <div class="block-head">
                                Report Issued
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Report Issued By</th>
                                    <td class="w-30">
                                        @if ($data->report_issued_by)
                                            {{ $data->report_issued_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Report Issued On</th>
                                    <td class="w-30">
                                        @if ($data->report_issued_on)
                                            {{ $data->report_issued_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Report Issued Comment</th>
                                    <td class="w-30">
                                        @if ($data->report_issued_comment)
                                            {!! $data->report_issued_comment !!}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <div class="block-head">
                                Cancel
                            </div>
                            <table>
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

                                    <th class="w-20">Cancel Comment</th>
                                    <td class="w-30">
                                        @if ($data->cancel_comment)
                                            {{ $data->cancel_comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            {{-- <div class="block-head">
                                More Info Required
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">More Info Required By</th>
                                    <td class="w-30">
                                        @if ($data->more_info_required_by)
                                            {{ $data->more_info_required_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">More Info Required On</th>
                                    <td class="w-30">
                                        @if ($data->more_info_required_on)
                                            {{ $data->more_info_required_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">More Info Required Comment</th>
                                    <td class="w-30">
                                        @if ($data->more_info_required_comment)
                                            {{ $data->more_info_required_comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table> --}}

                            <div class="block-head">
                                CAPA Plan Proposed
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">CAPA Plan Proposed By</th>
                                    <td class="w-30">
                                        @if ($data->complete_By)
                                            {{ $data->complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">CAPA Plan Proposed On</th>
                                    <td class="w-30">
                                        @if ($data->complete_on)
                                            {{ $data->complete_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">CAPA Plan Proposed Comment</th>
                                    <td class="w-30">
                                        @if ($data->complete_comment)
                                            {{ $data->complete_comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>

                            </table>

                            <div class="block-head">
                                No CAPAs Required
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">No CAPAs Required By</th>
                                    <td class="w-30">
                                        @if ($data->qa_approval_without_capa_by)
                                            {{ $data->qa_approval_without_capa_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">No CAPAs Required On</th>
                                    <td class="w-30">
                                        @if ($data->qa_approval_without_capa_on)
                                            {{ $data->qa_approval_without_capa_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">No CAPAs Required Comment</th>
                                    <td class="w-30">
                                        @if ($data->qa_approval_without_capa_comment)
                                            {{ $data->qa_approval_without_capa_comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <div class="block-head">
                                Response Reviewed
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Response Reviewed By</th>
                                    <td class="w-30">
                                        @if ($data->Final_Approval_by)
                                            {{ $data->Final_Approval_by }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Response Reviewed On</th>
                                    <td class="w-30">
                                        @if ($data->Final_Approval_on)
                                            {{ $data->Final_Approval_on }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                    <th class="w-20">Response Reviewed Comment</th>
                                    <td class="w-30">
                                        @if ($data->Final_Approval_comment)
                                            {{ $data->Final_Approval_comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>


            </div>
        </div>

        @endforeach
    @endif

    @if (count($ActionItem) > 0)
        @foreach ($ActionItem as $data)

        <center>
            <h3>Action Item Child Report</h3>
        </center>

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
                                    {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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

                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                        </tr>

                        <tr>
                            <th class="w-20">Parent Record Number</th>
                            <td class="w-30">
                                @if ($data->parent_record_number)
                                    {{ $data->parent_record_number }}
                                @elseif($data->parent_record_number_edit)
                                    {{ $data->parent_record_number_edit }}
                                    @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Assigned To</th>
                            <td class="w-30">
                                @if ($data->assign_to)
                                    {{ Helpers::getInitiatorName($data->assign_to) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-80">
                                @if ($data->due_date)
                                    {{ Helpers::getdateFormat($data->due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="block">
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
                            </tr>
                        </table>
                    </div>



                    <div class="block">
                        <table>
                            <tr>
                                <th class="w-20">Action Item Related Records</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                            {{-- <tr>
                                <th class="w-20">HOD Persons</th>
                                <td class="w-80">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr> --}}

                                <th class="w-20">HOD Persons</th>
                                <td class="w-30">
                                    @if ($data->hod_preson)
                                        {{ $data->hod_preson }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- <div class="other-container ">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            <div class="bold">Description</div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="custom-procedure-block" style="margin-left: 12px">
                                <div class="custom-container">
                                    <div class="custom-table-wrapper" id="custom-table2">
                                        <div class="custom-procedure-content">
                                            <div class="custom-content-wrapper">
                                                <div class="table-containers">
                                                    {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="other-container">
                            <table style="width:100%; border-collapse: collapse;">
                                    <tr>
                                        <th class="w-20">
                                            <strong>Description</strong>
                                        </th>
                                        <td class="w-80">
                                            {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">Responsible Department</th>
                                <td class="w-80">
                                    @if ($data->departments)
                                        {{ $data->departments }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="block-head">
                        File Attachment
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20"> Sr.No.</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                            @if ($data->file_attach)
                                @php $files = json_decode($data->file_attach); @endphp
                                @if (count($files) > 0)
                                    @foreach ($files as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>



                <div class="block-head">
                    Acknowledge
                </div>
                <table>
                    <tr>
                        <th class="w-20">Acknowledge Comment</th>
                        <td class="w-80">
                            @if ($data->acknowledge_comments)
                                {{ $data->acknowledge_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                    Acknowledge Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->acknowledge_attach)
                            @php $files = json_decode($data->acknowledge_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                    Post Completion
                </div>
                <table>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-80">
                            @if ($data->action_taken)
                                {{ $data->action_taken }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Actual Start Date</th>
                        <td class="w-30">
                            @if ($data->start_date)
                                {{ Helpers::getdateFormat($data->start_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Actual End Date</th>
                        <td class="w-30">
                            @if ($data->end_date)
                                {{ Helpers::getdateFormat($data->end_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="block-head">
                    Completion Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->Support_doc)
                            @php $files = json_decode($data->Support_doc); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>


                <div class="block-head">
                QA/CQA Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Verification Comments</th>
                        <td class="w-80">
                            @if ($data->qa_comments)
                                {{ $data->qa_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="block-head">
                        QA/CQA Verification Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->final_attach)
                            @php $files = json_decode($data->final_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="block" style="margin-top: 15px;">
                    <div class="block-head">
                        Activity Log
                    </div>
                    <table>
                        <tr>
                            <th class="w-10">Submit By</th>
                            <td class="w-20">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit On</th>
                            <td class="w-20">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Submit Comment</th>
                            <td class="w-30">@if($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</td>
                        </tr>


                        

                        <!-- </table>
                        <div class="block-head">
                            Cancel
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Cancel By</th>
                            <td class="w-20">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel On</th>
                            <td class="w-20">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Cancel Comment</th>
                            <td class="w-30">@if($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</td>
                        </tr>

                        <!-- </table>
                        <div class="block-head">
                            Acknowledge Complete
                        </div>
                        <table> -->

                        <tr>
                            <th class="w-10">Acknowledge Complete By</th>
                            <td class="w-20">@if($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete On</th>
                            <td class="w-20">@if($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Acknowledge Complete Comment</th>
                            <td class="w-30">@if($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                            Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Complete By</th>
                            <td class="w-20">@if($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete On</th>
                            <td class="w-20">@if($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Complete Comment</th>
                            <td class="w-30">@if($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</td>
                        </tr>
                        <!-- </table>
                        <div class="block-head">
                        Verification Complete
                        </div>
                        <table> -->
                        <tr>
                            <th class="w-10">Verification Complete By</th>
                            <td class="w-20">@if($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete On</th>
                            <td class="w-20">@if($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</td>
                            <th class="w-10">Verification Complete Comment</th>
                            <td class="w-30">@if($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @endforeach
    @endif

    @if (count($Extension) > 0)
        @foreach ($Extension as $data)

            <center>
                <h3>Extension Child Report</h3>
            </center>

            <div class="inner-block">
                <div class="content-table">
                    <div class="block">
                        <div class="block-head">General Information</div>
                        <table>
                            <tr>
                                <th class="w-20">Record Number</th>
                                <td class="w-30">
                                    @if ($data->record_number)
                                        {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Site/Location Code</th>
                                <td class="w-30">
                                    @if ($data->site_location_code)
                                        {{ Helpers::getDivisionName($data->site_location_code) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator</th>
                                <td class="w-30">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                                <th class="w-20">Date of Initiation</th>
                                <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
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
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Extension Number</th>
                                <td class="w-30">
                                    @if ($data->count)
                                        {{ $data->count }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            
                                <th class="w-20">HOD Review</th>
                                <td class="w-30">
                                    @if ($data->reviewers)
                                        {{ Helpers::getInitiatorName($data->reviewers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Parent Record Number</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                <th class="w-20">QA/CQA Approval</th>
                                <td class="w-30">
                                    @if ($data->approvers)
                                        {{ Helpers::getInitiatorName($data->approvers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Current Due Date (Parent)</th>
                                <td class="w-30">
                                    @if ($data->current_due_date)
                                        {{ Helpers::getdateFormat($data->current_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Proposed Due Date</th>
                                <td class="w-30">
                                    @if ($data->proposed_due_date)
                                        {{ Helpers::getdateFormat($data->proposed_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20"> Description</th>
                                <td class="w-80">
                                    @if ($data->description)
                                        {{ $data->description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>    
                                <th class="w-20">Justification / Reason</th>
                                <td class="w-80">
                                    @if ($data->justification_reason)
                                        {{ $data->justification_reason }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">Attachment Extension</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_extension)
                                    @foreach (json_decode($data->file_attachment_extension) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-head">HOD Review</div>

                        <table>
                            <tr>
                                <th class="w-20">HOD Remarks</th>
                                <td class="w-80">
                                    @if ($data->reviewer_remarks)
                                        {{ $data->reviewer_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">HOD Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_reviewer)
                                    @foreach (json_decode($data->file_attachment_reviewer) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @if ($data->count != 3)  
                    <div class="block">
                        <div class="block-head">QA/CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">QA/CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->approver_remarks)
                                        {{ $data->approver_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">QA/CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_approver)
                                    @foreach (json_decode($data->file_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                @endif
                @if ($data->count == 3)  
                    <div class="block">
                        <div class="block-head">CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->QAapprover_remarks)
                                        {{ $data->QAapprover_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>                

                    </div>
                    <div class="block">
                        <div class="block-head">CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-80">File</th>
                                </tr>
                                @if ($data->QAfile_attachment_approver)
                                    @foreach (json_decode($data->QAfile_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @endif

                    <div class="block">
                        <div class="block-head">Activity Log</div>
                        <table>
                            <tr>
                                <th class="w-20">Submit By</th>
                                <td class="w-30">@if ($data->submit_by) {{ $data->submit_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit On</th>
                                <td class="w-30">@if ($data->submit_on) {{ $data->submit_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit Comment</th>
                                <td class="w-30">@if ($data->submit_comment) {{ $data->submit_comment }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Cancel By</th>
                                <td class="w-30">@if ($data->reject_by) {{ $data->reject_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel On</th>
                                <td class="w-30">@if ($data->reject_on) {{ $data->reject_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel Comment</th>
                                <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_review_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_review_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_review_comment }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Review By</th>
                                <td class="w-30">@if ($data->submit_by_review) {{ $data->submit_by_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review On</th>
                                <td class="w-30">@if ($data->submit_on_review) {{ $data->submit_on_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review Comment</th>
                                <td class="w-30">@if ($data->submit_comment_review) {{ $data->submit_comment_review }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">System By</th>
                                <td class="w-80">{{ $data->submit_by_review }}</td>
                                <th class="w-20">System On</th>
                                <td class="w-80">{{ $data->submit_on_review }}</td>
                                <th class="w-20">System Comment</th>
                                <td class="w-80">{{ $data->submit_comment_review }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Reject By</th>
                                <td class="w-30">@if ($data->submit_by_inapproved) {{ $data->submit_by_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject On</th>
                                <td class="w-30">@if ($data->submit_on_inapproved) {{ $data->submit_on_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject Comment</th>
                                <td class="w-30">@if ($data->submit_commen_inapproved) {{ $data->submit_commen_inapproved }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                            </tr> --}}
                            <!-- @if($data->count == 3)
                                <tr>
                                    <th class="w-20">Send for CQA By</th>
                                    <td class="w-80">@if ($data->send_cqa_by) {{ $data->send_cqa_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA On</th>
                                    <td class="w-80">@if ($data->send_cqa_on) {{ $data->send_cqa_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA Comment</th>
                                    <td class="w-80">@if ($data->send_cqa_comment) {{ $data->send_cqa_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif -->
                            @if($data->count != 3)
                                <tr>
                                    <th class="w-20">Approved By</th>
                                    <td class="w-30">@if ($data->submit_by_approved) {{ $data->submit_by_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved On</th>
                                    <td class="w-30">@if ($data->submit_on_approved) {{ $data->submit_on_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved Comment</th>
                                    <td class="w-30">@if ($data->submit_comment_approved) {{ $data->submit_comment_approved }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                            @if($data->count == 3)
                                <tr>
                                    <th class="w-20">CQA Approval Complete By</th>
                                    <td class="w-30">@if ($data->cqa_approval_by) {{ $data->cqa_approval_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete On</th>
                                    <td class="w-30">@if ($data->cqa_approval_on) {{ $data->cqa_approval_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete Comment</th>
                                    <td class="w-30">@if ($data->cqa_approval_comment) {{ $data->cqa_approval_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

        @endforeach
    @endif


</body>

</html>
