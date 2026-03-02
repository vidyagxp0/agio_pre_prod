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
</style>
<body>

    <header>

          
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Out Of Calibration Family Report
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
                    {{ Helpers::getDivisionName($ooc->division_id) }}/OOC/{{ Helpers::year($ooc->created_at) }}/{{ $ooc->record }}
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
                <table>

                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::getDivisionName($ooc->division_id) }}/OOC/{{ Helpers::year($ooc->created_at) }}/{{ $ooc->record }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if (Helpers::getDivisionName($ooc->division_id))
                                {{ Helpers::getDivisionName($ooc->division_id) }}
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
                        @php
                            use Carbon\Carbon;
                        @endphp

                        <th class="w-20">Due date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Carbon::parse($data->due_date)->format('d-M-Y') }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <!-- @php
                            $department = [
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
                                'IT' => 'Electronic ooc Processing',
                                'FD' => 'Formulation Development',
                                'AL' => 'Analytical research and Development Laboratory',
                                'PD' => 'Packaging Development',
                                'PU' => 'Purchase Department',
                                'DC' => 'Document Cell',
                                'RA' => 'Regulatory Affairs',
                                'PV' => 'Pharmacovigilance',
                            ];

                            $currentInitiatorGroupFullForm = isset($department[$data->Initiator_Group])
                                ? $department[$data->Initiator_Group]
                                : $data->Initiator_Group;
                        @endphp -->

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

                        <th class="w-20">Last Calibration Date</th>
                        <td class="w-30">
                            @if ($data->last_calibration_date)
                                {{ Carbon::parse($data->last_calibration_date)->format('d-M-Y') }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30" colspan="3">
                            @if ($data->description_ooc)
                                {{ $data->description_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20 align-top">Details of OOC</th>
                        <td class="w-30" colspan="3">
                            @if ($data->details_of_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->details_of_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30" colspan="3">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    

                    <tr>
                        <th class="w-20 align-top">If Other</th>
                        <td class="w-30" colspan="3">
                            @if ($data->initiated_if_other)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_if_other !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                   
                    <tr>
                        <th class="w-20">Is Repeat</th>
                        <td class="w-80" colspan="3">
                            @if ($data->is_repeat_ooc)
                                {{ $data->is_repeat_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Repeat Nature</th>
                        <td class="w-30" colspan="3">
                            @if ($data->Repeat_Nature)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->Repeat_Nature !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                   

                    <!-- <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initial_attachment_ooc)
                                {{-- {{ $data->initial_attachment_ooc }} --}}
                                {{ str_replace(',', ', ', $data->initial_attachment_ooc) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> -->
                    </table>
                    <table>
                    <div class="border-table">
                        <div class="block-head">
                        Initial Attachment
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_ooc)
                                @foreach (json_decode($data->initial_attachment_ooc) as $key => $file)
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

                    </table>
                    <table>

                    <tr>
                        <th class="w-20">HOD Person</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">QA Person</th>
                        <td class="w-30">
                            @if ($data->qa_assign_person)
                                {{ Helpers::getInitiatorName($data->qa_assign_person) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">OOC Logged by</th>
                        <td class="w-30">
                            @if ($data->ooc_logged_by)
                                {{ Helpers::getInitiatorName($data->ooc_logged_by) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">OOC Logged On</th>
                        <td class="w-30">
                            @if ($data->ooc_due_date)
                                {{ Carbon::parse($data->ooc_due_date)->format('d-M-Y') }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="block">
                    <div class="block-head">
                        Instrument Details
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20" style="width: 20px;">Sr.No.</th>
                                <th class="w-20">Instrument Name</th>
                                <th class="w-20">Instrument ID</th>
                                <th class="w-20">Remarks</th>
                                <th class="w-20">Calibration Parameter</th>
                                <th class="w-20">Acceptance Criteria</th>
                                <th class="w-20">Results</th>
                            </tr>
                            @if ($oocgrid && is_array($oocgrid->data))
                                @foreach ($oocgrid->data as $oogrid)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ isset($oogrid['instrument_name']) ? $oogrid['instrument_name'] : '' }}
                                        </td>
                                        <td>{{ isset($oogrid['instrument_id']) ? $oogrid['instrument_id'] : '' }}</td>
                                        <td>{{ isset($oogrid['remarks']) ? $oogrid['remarks'] : '' }}</td>
                                        <td>{{ isset($oogrid['calibration']) ? $oogrid['calibration'] : '' }}</td>
                                        <td>{{ isset($oogrid['instrument_id']) ? $oogrid['acceptancecriteria'] : '' }}
                                        </td>
                                        <td>{{ isset($oogrid['remarks']) ? $oogrid['results'] : '' }}</td>
                                    </tr>
                                @endforeach
                                {{-- @else --}}
                                {{-- <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr> --}}
                                {{-- @endforeach --}}
                            @else
                                <p>No data available</p>
                            @endif

                        </table>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Delay Justification for Reporting
                </div>

                <table>
                   


                    <tr>
                        <th class="w-20 align-top">Delay Justification for Reporting</th>
                        <td class="w-80" colspan="3">
                            @if ($data->Delay_Justification_for_Reporting)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->Delay_Justification_for_Reporting !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20 align-top">Immediate Action</th>
                        <td class="w-30" colspan="3">
                            @if ($data->Immediate_Action_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->Immediate_Action_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                  
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    HOD Primary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">HOD Primary Review Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->HOD_Remarks)
                                {!! $data->HOD_Remarks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   
                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        HOD Primary Review Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_hod_ooc)
                                @foreach (json_decode($data->attachments_hod_ooc) as $key => $file)
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
                        </table>
                    </div>

                    </table>
                    <table>
                    
                    {{-- <tr>
                            <th class="w-20">Immediate Action</th>
                            <td class="w-80">
                                @if ($data->Immediate_Action_ooc)
                                    {!! $data->Immediate_Action_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Preliminary Investigation</th>
                            <td class="w-80">
                                @if ($data->Preliminary_Investigation_ooc)
                                    {!! $data->Preliminary_Investigation_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr> --}}

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    QA Head Primary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Head Primary Review Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qaheadremarks)
                                {!! $data->qaheadremarks !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   


                     
                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        QA Head Primary Review Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_capa_ooc)
                                @foreach (json_decode($data->initial_attachment_capa_ooc) as $key => $file)
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
                        </table>
                    </div>

                    </table>
                    <table>
                    {{-- <tr>
                            <th class="w-20">Immediate Action</th>
                            <td class="w-80">
                                @if ($data->Immediate_Action_ooc)
                                    {!! $data->Immediate_Action_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">Preliminary Investigation</th>
                            <td class="w-80">
                                @if ($data->Preliminary_Investigation_ooc)
                                    {!! $data->Preliminary_Investigation_ooc !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr> --}}

                </table>
            </div>

            <div class="block-head">
            Phase IA Investigation
            </div>

            <div class="block">

             
                <div class="block-head">
                    Phase IA Investigation Checklist
                </div>


                @php
                    $oocevaluations = [
                        'Status of calibration for other instrument(s) used for performing calibration of the referred instrument',
                        'Verification of calibration standards used Primary Standard: Physical appearance, validity, certificate. Secondary standard: Physical appearance, validity',
                        'Verification of dilution, calculation, weighing, Titer values and readings',
                        'Verification of glassware used',
                        'Verification of chromatograms/spectrums/other instrument',
                        'Adequacy of system suitability checks',
                        'Instrument Malfunction',
                        'Check for adherence to the calibration method',
                        'Previous History of instrument',
                        'Others',
                    ];
                @endphp

                {{-- <div style="font-weight: 200">Checklist</div> --}}
                {{-- <div class="border-table">
                    <table>
                        <thead>
                            <tr class="table_bg">
                                <th  style="width: 2px;">Sr.No.</th>
                                <th  style="width: 50px;">Parameter</th>
                                <th  style="width: 50px;">Observation</th>
                                <th  style="width: 50px;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oocevaluations as $index => $item)
                                @if (isset($oocevolution->data[$index]))
                                     <tr>
                        <td style="text-align: center; vertical-align: middle; padding: 5px 10px;">{{ $index + 1 }}</td>
                        <td style="text-align: left; vertical-align: middle; padding: 5px 10px;">{{ $item }}</td>
                        <td style="text-align: left; vertical-align: middle; padding: 5px 10px;">{{ $oocevolution->data[$index]['response'] }}</td>
                        <td style="text-align: left; vertical-align: middle; padding: 5px 10px;">{{ $oocevolution->data[$index]['remarks'] }}</td>
                    </tr>
                                @else
                                    <tr>
                                        <td colspan="4">No data available</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br> --}}
                <div style="width:100%; overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif; font-size:12px; border:1px solid #ccc;">
                        <thead>
                            <tr style="background-color:#f0f0f0;">
                                <th style="width:5%; border:1px solid   #4274da; padding:5px;  background: #4274da57; text-align:center; vertical-align:middle;">Sr.No.</th>
                                <th style="width:35%; border:1px solid  #4274da; padding:5px;  background: #4274da57; text-align:left; vertical-align:middle;">Parameter</th>
                                <th style="width:30%; border:1px solid  #4274da; padding:5px; background: #4274da57; text-align:left; vertical-align:middle;">Observation</th>
                                <th style="width:30%; border:1px solid  #4274da; padding:5px; background: #4274da57; text-align:left; vertical-align:middle;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oocevaluations as $index => $item)
                                @if (isset($oocevolution->data[$index]))
                                    <tr>
                                        <td style="border:1px solid #ccc; padding:5px; text-align:center; vertical-align:middle;">{{ $index + 1 }}</td>
                                        <td style="border:1px solid #ccc; padding:5px; text-align:left; vertical-align:middle;">{{ $item }}</td>
                                        <td style="border:1px solid #ccc; padding:5px; text-align:left; vertical-align:middle;">{{ $oocevolution->data[$index]['response'] }}</td>
                                        <td style="border:1px solid #ccc; padding:5px; text-align:left; vertical-align:middle;">{{ $oocevolution->data[$index]['remarks'] }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="4" style="border:1px solid #ccc; padding:5px; text-align:center; vertical-align:middle;">No data available</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <table>
                    
                    <tr>
                        <th class="w-20 align-top">Analyst Interview</th>
                        <td class="w-30" colspan="3">
                            @if ($data->analysis_remarks_stage_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->analysis_remarks_stage_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Evaluation Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qa_comments_ooc)
                                {!! $data->qa_comments_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Description of Cause for OOC Results (If Identified)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qa_comments_description_ooc)
                                {{ $data->qa_comments_description_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Root Cause identified</th>
                        <td class="w-80">
                            @if ($data->is_repeat_assingable_ooc)
                                {!! $data->is_repeat_assingable_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Phase IA Investigation Comment</th>
                        <td class="w-80" colspan="3">
                            @if ($data->rootcausenewfield)
                                {!! $data->rootcausenewfield !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Hypothesis Study
                </div>
                <table>
                   

                    
                    <tr>
                        <th class="w-20 align-top">Protocol Based Study/Hypothesis Study</th>
                        <td class="w-30" colspan="3">
                            @if ($data->protocol_based_study_hypthesis_study_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->protocol_based_study_hypthesis_study_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20 align-top">Justification for Protocol study/ Hypothesis Study</th>
                        <td class="w-30" colspan="3">
                            @if ($data->justification_for_protocol_study_hypothesis_study_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->justification_for_protocol_study_hypothesis_study_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20 align-top">Plan of Protocol Study/ Hypothesis Study</th>
                        <td class="w-30" colspan="3">
                            @if ($data->plan_of_protocol_study_hypothesis_study)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->plan_of_protocol_study_hypothesis_study !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                   
                   
                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Hypothesis Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_hypothesis_ooc)
                                @foreach (json_decode($data->attachments_hypothesis_ooc) as $key => $file)
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
                        </table>
                    </div>

                    </table>
                    <table>
                    

                    <tr>
                        <th class="w-20 align-top">Conclusion of Protocol based Study/Hypothesis Study</th>
                        <td class="w-30" colspan="3">
                            @if ($data->conclusion_of_protocol_based_study_hypothesis_study_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->conclusion_of_protocol_based_study_hypothesis_study_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20 align-top">Calibration Results</th>
                        <td class="w-30" colspan="3">
                            @if ($data->calibration_results_stage_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->calibration_results_stage_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20 align-top">Review of Calibration Results of Analyst</th>
                        <td class="w-30" colspan="3">
                            @if ($data->review_of_calibration_results_of_analyst_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_calibration_results_of_analyst_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                   
                    


                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IA Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_stage_ooc)
                                @foreach (json_decode($data->attachments_stage_ooc) as $key => $file)
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
                        </table>
                    </div>

                    </table>
                    <table>
                    

                    <tr>
                        <th class="w-20 align-top">Result Criteria</th>
                        <td class="w-30" colspan="3">
                            @if ($data->results_criteria_stage_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->results_criteria_stage_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Result</th>
                        <td class="w-80" colspan="3">
                            @if ($data->is_repeat_stae_ooc)
                                {!! $data->is_repeat_stae_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Additional Remarks (if any)</th>
                        <td class="w-30" colspan="3">
                            @if ($data->additional_remarks_stage_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->additional_remarks_stage_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   
                    <tr>
                        <th class="w-20 align-top">Corrective Action</th>
                        <td class="w-30" colspan="3">
                            @if ($data->initiated_through_capas_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_capas_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Preventive Action</th>
                        <td class="w-30" colspan="3">
                            @if ($data->initiated_through_capa_prevent_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_capa_prevent_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Corrective and Preventive Action</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_capa_corrective_ooc)
                                {!! $data->initiated_through_capa_corrective_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> -->
                    

                    <tr>
                        <th class="w-20 align-top">Phase IA Summary</th>
                        <td class="w-30" colspan="3">
                            @if ($data->phase_ia_investigation_summary)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->phase_ia_investigation_summary !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Phase IA HOD Primary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Phase IA HOD Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->phase_IA_HODREMARKS)
                                {{ $data->phase_IA_HODREMARKS }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IA HOD Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_hodIAHODPRIMARYREVIEW_ooc)
                                @foreach (json_decode($data->attachments_hodIAHODPRIMARYREVIEW_ooc) as $key => $file)
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
                        </table>
                    </div>

                   
                    
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Phase IA QA Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Phase IA QA Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qaremarksnewfield)
                                {!! $data->qaremarksnewfield !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  

                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IA QA Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_capa_post_ooc)
                                @foreach (json_decode($data->initial_attachment_capa_post_ooc) as $key => $file)
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
                        </table>
                    </div>

                   
                    
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    P-IA QAH Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Assignable cause identified </th>
                        <td class="w-80">
                            @if ($data->assignable_cause_identified)
                                {!! $data->assignable_cause_identified !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">P-IA QAH Remarks </th>
                        <td class="w-80" colspan="3">
                            @if ($data->qaHremarksnewfield)
                                {!! $data->qaHremarksnewfield !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  


                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        P-IA QAH Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_qah_post_ooc)
                                @foreach (json_decode($data->initial_attachment_qah_post_ooc) as $key => $file)
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
                        </table>
                    </div>

                   
                </table>
            </div>



            <div class="block">
                <div class="block-head">
                    Phase IB Investigation
                </div>
                <table>
                    <tr>
                        <th class="w-20">Rectification by Service Engineer required</th>
                        <td class="w-80">
                            @if ($data->is_repeat_stageii_ooc)
                                {!! $data->is_repeat_stageii_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">
                            Instrument is Out of Order</th>
                        <td class="w-80">
                            @if ($data->is_repeat_stage_instrument_ooc)
                                {{ $data->is_repeat_stage_instrument_ooc }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">
                            Details of instrument out of order</th>
                        <td class="w-80" colspan="3">
                            @if ($data->details_of_instrument_out_of_order)
                                {{ $data->details_of_instrument_out_of_order }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed By</th>
                        <td class="w-80" colspan="3">
                            @if ($data->is_repeat_compiled_stageii_ooc)
                                {{Helpers::getInitiatorName($data->is_repeat_compiled_stageii_ooc) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>

                        <th class="w-20">Details of Equipment Rectification Attachment</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initial_attachment_stageii_ooc)
                                {{-- {{ $data->initial_attachment_stageii_ooc }} --}}
                                {{ str_replace(',', ', ', $data->initial_attachment_stageii_ooc) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> -->


                    </table>
                  
                    <div class="border-table">
                        <div class="block-head">
                        Details of Equipment Rectification Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_stageii_ooc)
                                @foreach (json_decode($data->initial_attachment_stageii_ooc) as $key => $file)
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
                        </table>
                   
                    </div>


                    <table>
                    <tr>
                        <th class="w-20"> Complied By</th>
                        <td class="w-80" colspan="3">
                            @if ($data->compiled_by)
                                {{Helpers::getInitiatorName($data->compiled_by) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Impact Assessment</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_throug_stageii_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_throug_stageii_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                   

                    <tr>
                        <th class="w-20 align-top">Details of Impact Evaluation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_stageii_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_stageii_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="w-20 align-top">Justification for Recalibration</th>
                        <td class="w-80" colspan="3">
                            @if ($data->justification_for_recalibration)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->justification_for_recalibration !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   


                    <tr>
                        <th class="w-20 align-top">Result of Recalibration</th>
                        <td class="w-80" colspan="3">
                            @if ($data->is_repeat_reanalysis_stageii_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->is_repeat_reanalysis_stageii_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    


                    <tr>
                        <th class="w-20 align-top">Cause for failure</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_stageii_cause_failure_ooc)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_stageii_cause_failure_ooc !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    
                  

                    <tr>
                        <th class="w-20 align-top">Corrective action IB Investigation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_capas_ooc_IB)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_capas_ooc_IB !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Preventive action IB Investigation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_capa_prevent_ooc_IB)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->initiated_through_capa_prevent_ooc_IB !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Corrective and preventive action IB Inv.</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiated_through_capa_corrective_ooc_IB)
                                {!! $data->initiated_through_capa_corrective_ooc_IB !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr> -->
                   


                    <tr>
                        <th class="w-20 align-top">Phase IB Summary</th>
                        <td class="w-80" colspan="3">
                            @if ($data->phase_ib_investigation_summary)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->phase_ib_investigation_summary !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IB Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_reanalysisi_ooc)
                                @foreach (json_decode($data->initial_attachment_reanalysisi_ooc) as $key => $file)
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
                        </table>
                    </div>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    Phase IB HOD Primary Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Phase IB HOD Primary Remarks </th>
                        <td class="w-80" colspan="3">
                            @if (!empty($data->phase_IB_HODREMARKS))
                                {!! $data->phase_IB_HODREMARKS !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  



                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IB HOD Primary Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_hodIBBBHODPRIMARYREVIEW_ooc)
                                @foreach (json_decode($data->attachments_hodIBBBHODPRIMARYREVIEW_ooc) as $key => $file)
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
                        </table>
                    </div>
                    {{-- <tr>
                    <th class="w-20">Preventive Action</th>
                    <td class="w-80">
                        @if (!empty($data->initiated_through_capa_prevent_ooc))
                            {!! $data->initiated_through_capa_prevent_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Corrective & Preventive Action</th>
                    <td class="w-80">
                        @if (!empty($data->initiated_through_capa_corrective_ooc))
                            {!! $data->initiated_through_capa_corrective_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Details of Equipment Rectification Attachment</th>
                    <td class="w-80">
                        @if (!empty($data->initial_attachment_capa_ooc))
                            {!! $data->initial_attachment_capa_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA Post Implementation Comments</th>
                    <td class="w-80">
                        @if (!empty($data->initiated_through_capa_ooc))
                            {!! $data->initiated_through_capa_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA Post Implementation Attachment</th>
                    <td class="w-80">
                        @if (!empty($data->initial_attachment_capa_post_ooc))
                            {!! $data->initial_attachment_capa_post_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                </table>
            </div>


            <div class="block">
                <div class="block-head">
                    Phase IB QA Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Phase IB QA Remarks</th>
                        <td class="w-80" colspan="3">
                            @if (!empty($data->phase_IB_qareviewREMARKS))
                                {!! $data->phase_IB_qareviewREMARKS !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    


                    
                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        Phase IB QA Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->attachments_QAIBBBREVIEW_ooc)
                                @foreach (json_decode($data->attachments_QAIBBBREVIEW_ooc) as $key => $file)
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
                        </table>
                    </div>
                    {{-- <tr>
                    <th class="w-20">Document Code</th>
                    <td class="w-80">
                        @if (!empty($data->document_code_closure_ooc))
                            {!! $data->document_code_closure_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Remarks</th>
                    <td class="w-80">
                        @if (!empty($data->remarks_closure_ooc))
                            {{ $data->remarks_closure_ooc }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Immediate Corrective Action</th>
                    <td class="w-80">
                        @if (!empty($data->initiated_through_closure_ooc))
                            {!! $data->initiated_through_closure_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                </table>
            </div>

            <div class="block">
                <div class="block-head">
                    P-IB QAH Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">Release of Instrument for usage</th>
                        <td class="w-80" colspan="3">
                            @if ($data->is_repeat_realease_stageii_ooc)
                                {!! $data->is_repeat_realease_stageii_ooc !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">P-IB QAH Remarks</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qPIBaHremarksnewfield)
                                {{ $data->qPIBaHremarksnewfield }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    </table>
                   <table>
                    <div class="border-table">
                        <div class="block-head">
                        P-IB QAH Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->Pib_attachements)
                                @foreach (json_decode($data->Pib_attachements) as $key => $file)
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
                        </table>
                    </div>

                    {{-- <th class="w-20">Impact Assessment</th>
                    <td class="w-80">
                        @if ($data->initiated_through_impact_closure_ooc)
                            {!! $data->initiated_through_impact_closure_ooc !!}
                        @else
                            Not Applicable
                        @endif
                    </td> --}}
                </table>
            </div>


        <div class="inner-block">
                <div class="block-head">
                    Activity Log
                </div>

                <!-- Submit -->
                <table>
                    <tr>
                        <th class="w-20">Submit By:</th>
                        <td class="w-30">{!! $data->submitted_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Submit On:</th>
                        <td class="w-30">{{ $data->submitted_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Submit Comment:</th>
                        <td colspan="3">{!! $data->comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- HOD Primary Review -->
                <table>
                    <tr>
                        <th class="w-20">HOD Primary Review Complete By:</th>
                        <td class="w-30">{!! $data->initial_phase_i_investigation_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">HOD Primary Review Complete On:</th>
                        <td class="w-30">{{ $data->initial_phase_i_investigation_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>HOD Primary Review Complete Comment:</th>
                        <td colspan="3">{!! $data->initial_phase_i_investigation_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

              

                <!-- QA Head Primary Review -->
                <table>
                    <tr>
                        <th class="w-20">QA Head Primary Review Complete By:</th>
                        <td class="w-30">{!! $data->assignable_cause_f_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">QA Head Primary Review Complete On:</th>
                        <td class="w-30">{{ $data->assignable_cause_f_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>QA Head Primary Review Complete Comment:</th>
                        <td colspan="3">{!! $data->assignable_cause_f_completed_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IA Investigation -->
                <table>
                    <tr>
                        <th class="w-20">Phase IA Investigation By:</th>
                        <td class="w-30">{!! $data->cause_f_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IA Investigation On:</th>
                        <td class="w-30">{{ $data->cause_f_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IA Investigation Comment:</th>
                        <td colspan="3">{!! $data->cause_f_completed_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IA HOD Review -->
                <table>
                    <tr>
                        <th class="w-20">Phase IA HOD Review Complete By:</th>
                        <td class="w-30">{!! $data->obvious_r_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IA HOD Review Complete On:</th>
                        <td class="w-30">{{ $data->obvious_r_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IA HOD Review Complete Comment:</th>
                        <td colspan="3">{!! $data->cause_i_ncompleted_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IA QA Review -->
                <table>
                    <tr>
                        <th class="w-20">Phase IA QA Review Complete By:</th>
                        <td class="w-30">{!! $data->cause_i_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IA QA Review Complete On:</th>
                        <td class="w-30">{{ $data->cause_i_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IA QA Review Complete Comment:</th>
                        <td colspan="3">{!! $data->correction_ooc_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Assignable Cause Found -->
                <table>
                    <tr>
                        <th class="w-20">Assignable Cause Found By:</th>
                        <td class="w-30">{!! $data->approved_ooc_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Assignable Cause Found On:</th>
                        <td class="w-30">{{ $data->approved_ooc_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Assignable Cause Found Comment:</th>
                        <td colspan="3">{!! $data->approved_ooc_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Assignable Cause Not Found -->
                <table>
                    <tr>
                        <th class="w-20">Assignable Cause Not Found By:</th>
                        <td class="w-30">{!! $data->correction_r_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Assignable Cause Not Found On:</th>
                        <td class="w-30">{{ $data->correction_r_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Assignable Cause Not Found Comment:</th>
                        <td colspan="3">{!! $data->correction_r_ncompleted_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IB Investigation -->
                <table>
                    <tr>
                        <th class="w-20">Phase IB Investigation By:</th>
                        <td class="w-30">{!! $data->correction_ooc_completed_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IB Investigation On:</th>
                        <td class="w-30">{{ $data->correction_ooc_completed_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IB Investigation Comment:</th>
                        <td colspan="3">{!! $data->correction_ooc_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IB HOD Review -->
                <table>
                    <tr>
                        <th class="w-20">Phase IB HOD Review Complete By:</th>
                        <td class="w-30">{!! $data->Phase_IB_HOD_Review_Completed_BY ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IB HOD Review Complete On:</th>
                        <td class="w-30">{{ $data->Phase_IB_HOD_Review_Completed_ON ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IB HOD Review Complete Comment:</th>
                        <td colspan="3">{!! $data->Phase_IB_HOD_Review_Completed_Comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Phase IB QA Review -->
                <table>
                    <tr>
                        <th class="w-20">Phase IB QA Review Complete By:</th>
                        <td class="w-30">{!! $data->Phase_IB_QA_Review_Complete_12_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Phase IB QA Review Complete On:</th>
                        <td class="w-30">{{ $data->Phase_IB_QA_Review_Complete_12_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Phase IB QA Review Complete Comment:</th>
                        <td colspan="3">{!! $data->Phase_IB_QA_Review_Complete_12_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Approved -->
                <table>
                    <tr>
                        <th class="w-20">Approved By:</th>
                        <td class="w-30">{!! $data->P_IB_Assignable_Cause_Found_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Approved On:</th>
                        <td class="w-30">{{ $data->P_IB_Assignable_Cause_Found_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Approved Comment:</th>
                        <td colspan="3">{!! $data->P_IB_Assignable_Cause_Found_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>

                <!-- Cancel -->
                <table>
                    <tr>
                        <th class="w-20">Cancel By:</th>
                        <td class="w-30">{!! $data->cancelled_by ?? 'Not Applicable' !!}</td>

                        <th class="w-20">Cancel On:</th>
                        <td class="w-30">{{ $data->cancelled_on ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th>Cancel Comment:</th>
                        <td colspan="3">{!! $data->cancell_comment ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>


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

    @if (count($capa_Data) > 0)
        @foreach ($capa_Data as $data)

        <center>
            <h3>Capa Child Report</h3>
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
                            <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ $data->originator }}</td>
                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                        </tr>

                        <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ $data->assign_to }} @else Not Applicable @endif</td>
                        <th class="w-20">Due Date</th>
                            <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Initiator Department</th>

                            <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                            {{-- <td class="w-30">{{ Helpers::getFullDepartmentName($data->initiator_Group) }}</td> --}}

                            <th class="w-20">Initiator Department Code</th>
                            <td class="w-30">{{ $data->initiator_group_code }}</td>

                        </tr>


                        </table>
                        <table>

                        <tr>
                                <th class="w-20">Short Description</th>

                                <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                        </tr>

                        <tr>

                        <th class="w-20">Initiated Through</th>
                            <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                        </tr>

                        </table>

                        <table>


                            <tr>

                    <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat ){{ $data->repeat }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>


                    </table>

                    <table>
                        <tr>
                            <th class="w-20">Problem Description</th>
                            <td class="w-80" colspan="5">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">CAPA Team</th>
                            <td class="w-80" colspan="5">@if($data->capa_team){{  $capa_teamNamesString }}@else Not Applicable @endif</td>

                        </tr>
                    </table>
                    <table>

                    <table>
                        <tr>
                                <th class="w-20">Reference Records</th>
                                <td class="w-80" colspan="5">
                                    @if($data->parent_record_number_edit){{ $data->parent_record_number_edit}}@else Not Applicable @endif
                                    {{--@if($data->capa_related_record){{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif--}}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20"> Initial Observation</th>
                                <td class="w-80" colspan="5">
                                @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <th class="w-20">Interim Containment</th>

                        <td class="w-80">
                                @if($data->interim_containnment)
                                    {{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->interim_containnment))) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>   
                        </tr>
                        <tr>
                            <th class="w-20"> Containment Comments </th>
                            <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                        </tr>
                    </table>
                   

                    <div class="block-head">
                        CAPA Attachments
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->capa_attachment)
                                    @foreach(json_decode($data->capa_attachment) as $key => $file)
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
                    </table>
                </div>

                <div class="block">
                        <div class="block-head">
                            Other Type Details

                            </div>
                            <table>
                                <tr>
                                <th class="w-20">Investigation Summary</th>
                                <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                <th class="w-20">Root Cause</th>
                                <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Product / Material Details
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-10">Sr.No.</th>
                                    <th class="w-20">Product / Material Name</th>
                                    <th class="w-20">Product /Material Batch No./Lot No./AR No.</th>
                                    <th class="w-20">Product / Material Manufacturing Date</th>
                                    <th class="w-20">Product / Material Date of Expiry</th>
                                    <th class="w-20">Product Batch Disposition Decision</th>
                                    <th class="w-20">Product Remark</th>
                                    <th class="w-20">Product Batch Status</th>
                                </tr>
                                    {{-- @if($data->root_cause_initial_attachment)
                                    @foreach(json_decode($data->root_cause_initial_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else --}}
                                    @if($data->Material_Details->material_name)
                                    @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo)
                                    <tr>
                                        <td class="w-15">{{ $dataDemo ? $key + 1  : "NA" }}</td>
                                        <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "NA"}}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "NA" }}</td>
                                        <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "NA" }}</td>
                                        <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "NA" }}</td>
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
                        <br>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">
                                Equipment/Instruments Details
                            </div>
                            <div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-25">Sr.No.</th>
                                        <th class="w-25">Equipment/Instruments Name</th>
                                        <th class="w-25">Equipment/Instrument ID</th>
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

                        <div class="block-head">
                            Other Type CAPA Details
                            </div>
                            <table>
                            <tr>
                                <th class="w-20">Details</th>
                                <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>

                            </tr>
                            </table>

                        <div class="block">
                            <div class="block-head">
                                CAPA Details
                                </div>
                                <table>
                                <tr>

                                    <th class="w-20">CAPA Type</th>
                                    <td class="w-80" colspan="3"> @if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                                </tr>

                                
                                @if($data->corrective_action) 
                                <tr>

                                    <th class="w-20">Corrective Action</th>
                                    <td class="w-80" colspan="3"> @if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif

                                @if($data->preventive_action) 
                                <tr>

                                    <th class="w-20">Preventive Action</th>
                                    <td class="w-80" colspan="3"> @if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                                </tr>
                                @endif
                                </table>

                        <div class="block-head">
                            File Attachment
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->capafileattachement)
                                        @foreach(json_decode($data->capafileattachement) as $key => $file)
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
                        </table>
                        </div>
                        <br>
                <div class="block">
                    <div class="block-head">
                    HOD Review
                    </div>
                    <div>
                    <table>
                        <tr>
                            <th class="w-20">HOD Remark</th>
                            <td class="w-80">@if($data->hod_remarks){{ $data->hod_remarks }}@else Not Applicable @endif</td>

                        </tr>
                        </table>

                        <div class="block-head">
                            HOD Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->hod_attachment)
                                    @foreach(json_decode($data->hod_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                    <div class="block-head">
                        QA/CQA Review
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th class="w-20"> QA/CQA Review Comment </th>
                                <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                            </tr>
                        </table>

                        <div class="block-head">
                            QA/CQA Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_attachment)
                                    @foreach(json_decode($data->qa_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                        QA/CQA Approval
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Approval Comment</th>
                                            <td class="w-80">@if($data->qah_cq_comments){{ $data->qah_cq_comments }}@else Not Applicable @endif</td>

                                        </tr>
                        </table> <div class="block-head">
                            QA/CQA Approval Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qah_cq_attachment)
                                    @foreach(json_decode($data->qah_cq_attachment) as $key => $file)
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
                    </table>
                    </div>


                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    Initiator CAPA update
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">Initiator CAPA Update Comment</th>
                                            <td class="w-80">@if($data->initiator_comment){{ $data->initiator_comment}}@else Not Applicable @endif</td>

                                            </tr>
                        </table>

                        <div class="block-head">
                            Initiator CAPA update Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->initiator_capa_attachment)
                                    @foreach(json_decode($data->initiator_capa_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>
                        <div class="block">
                                    <div class="block-head">
                                    HOD Final Review
                                    </div>
                                    <div>
                                        <table>
                                            <tr>
                                                <th class="w-20">HOD Final Review Comments</th>
                                                <td class="w-80">@if($data->hod_final_review ){{ $data->hod_final_review }}@else Not Applicable @endif</td>

                                            </tr>
                                        </table>
                        <div class="block-head">
                            HOD Final Attachment
                        </div>
                        <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->hod_final_attachment)
                                        @foreach(json_decode($data->hod_final_attachment) as $key => $file)
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
                    </table>
                    </div>
                        <br>

                        <div class="block">
                                    <div class="block-head">
                                    QA/CQA Closure Review
                                    </div>
                                    <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">QA/CQA Closure Review Comment</th>
                                            <td class="w-80">@if($data->qa_cqa_qa_comments){{ $data->qa_cqa_qa_comments }}@else Not Applicable @endif</td>

                                                </tr>
                        </table>
                        <div class="block-head">
                            QA/CQA Closure Review Attachment
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->qa_closure_attachment)
                                    @foreach(json_decode($data->qa_closure_attachment) as $key => $file)
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
                    </table>
                    </div>




                        <div class="block">
                        <div class="block-head">
                        CAPA Closure
                        </div>
                        <table>
                        <tr>

                        <th class="w-20">
                        Effectiveness check required
                            </th>
                        <td class="w-80">
                            @if($data->effectivness_check){{ $data->effectivness_check }}@else Not Applicable @endif
                            </td>
                        </tr>
                        <tr>
                        <th class="w-20">QA/CQA Head Closure Review Comment</th>
                        <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                        </tr>
                        </table>
                        </div>

                    </table>
                </div>



                                <div class="block-head">
                                    QA/CQA Head Closure Review Attachment
                                </div>
                                <div class="border-table">
                                    <table>
                                        <tr class="table_bg">
                                            <th class="w-20">Sr.No</th>
                                            <th class="w-60">Attachment </th>
                                        </tr>
                                            @if($data->closure_attachment)
                                            @foreach(json_decode($data->closure_attachment) as $key => $file)
                                                <tr>
                                                    <td class="w-20">{{ $key + 1 }}</td>
                                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                                {{-- <div class="block-head">
                                    Extension Justification
                                </div>

                                <table>
                                    <tr>
                                        <th class="w-20">Due Date Extension Justification</th>
                                            <td class="w-80">
                                                {{ $data->due_date_extension }}</td>
                                    </tr>
                                </table> --}}

                            <div class="block">
                                <div class="block-head">
                                    Activity Log
                                </div>
                                <table>
                                    {{-- Propose Plan --}}
                                    <tr>
                                        <th class="w-20">Propose Plan By</th>
                                        <td class="w-30">@if($data->plan_proposed_by){{ $data->plan_proposed_by }}@else Not Applicable @endif</td>
                                        <th class="w-20">Propose Plan On</th>
                                        <td class="w-30">@if($data->plan_proposed_on){{ $data->plan_proposed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Propose Plan Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Cancel --}}
                                    <tr>
                                        <th>Cancel By</th>
                                        <td>@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                                        <th>Cancel On</th>
                                        <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Cancel Comment</th>
                                        <td colspan="3">@if($data->cancelled_on_comment){{ $data->cancelled_on_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Review --}}
                                    <tr>
                                        <th>HOD Review Complete By</th>
                                        <td>@if($data->hod_review_completed_by){{ $data->hod_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Review Complete On</th>
                                        <td>@if($data->hod_review_completed_on){{ $data->hod_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Review Complete Comment</th>
                                        <td colspan="3">@if($data->hod_comment){{ $data->hod_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Review --}}
                                    <tr>
                                        <th>QA/CQA Review Complete By</th>
                                        <td>@if($data->qa_review_completed_by){{ $data->qa_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Review Complete On</th>
                                        <td>@if($data->qa_review_completed_on){{ $data->qa_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_comment){{ $data->qa_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Approved --}}
                                    <tr>
                                        <th>Approved By</th>
                                        <td>@if($data->approved_by){{ $data->approved_by }}@else Not Applicable @endif</td>
                                        <th>Approved On</th>
                                        <td>@if($data->approved_on){{ $data->approved_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Approved Comment</th>
                                        <td colspan="3">@if($data->approved_comment){{ $data->approved_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- Completed --}}
                                    <tr>
                                        <th>Completed By</th>
                                        <td>@if($data->completed_by){{ $data->completed_by }}@else Not Applicable @endif</td>
                                        <th>Completed On</th>
                                        <td>@if($data->completed_on){{ $data->completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Complete Comment</th>
                                        <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- HOD Final Review --}}
                                    <tr>
                                        <th>HOD Final Review Complete By</th>
                                        <td>@if($data->hod_final_review_completed_by){{ $data->hod_final_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>HOD Final Review Complete On</th>
                                        <td>@if($data->hod_final_review_completed_on){{ $data->hod_final_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>HOD Final Review Complete Comment</th>
                                        <td colspan="3">@if($data->final_comment){{ $data->final_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QA/CQA Closure Review --}}
                                    <tr>
                                        <th>QA/CQA Closure Review Complete By</th>
                                        <td>@if($data->qa_closure_review_completed_by){{ $data->qa_closure_review_completed_by }}@else Not Applicable @endif</td>
                                        <th>QA/CQA Closure Review Complete On</th>
                                        <td>@if($data->qa_closure_review_completed_on){{ $data->qa_closure_review_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QA/CQA Closure Review Complete Comment</th>
                                        <td colspan="3">@if($data->qa_closure_comment){{ $data->qa_closure_comment }}@else Not Applicable @endif</td>
                                    </tr>

                                    {{-- QAH/CQA Head Approval --}}
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete By</th>
                                        <td>@if($data->qah_approval_completed_by){{ $data->qah_approval_completed_by }}@else Not Applicable @endif</td>
                                        <th>QAH/CQA Head Approval Complete On</th>
                                        <td>@if($data->qah_approval_completed_on){{ $data->qah_approval_completed_on }}@else Not Applicable @endif</td>
                                    </tr>
                                    <tr>
                                        <th>QAH/CQA Head Approval Complete Comment</th>
                                        <td colspan="3">@if($data->qah_comment){{ $data->qah_comment }}@else Not Applicable @endif</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
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

    @if ($RootCause->isNotEmpty())
        @foreach ($RootCause as $data)

        <center>
            <h3>Root Cause Analysis Child Report</h3>
        </center>

        <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_code)
                                {{ $data->division_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>

                    <tr>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ( Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                {{  Helpers::getUsersDepartmentName(Auth::user()->departmentid)}}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> 
                <table>   
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
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Name Of Responsible Department Head</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
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

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->initiated_if_other)
                                    {!! $data->initiated_if_other !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            {{-- <th class="w-20">Type</th>
                            <td class="w-30">
                                @if ($data->Type)
                                    {{ $data->Type }}
                                @else
                                    Not Applicable
                                @endif
                            </td> --}}
                        </tr>
                    </table>
                    <table>    

                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->department)
                                    {{ $data->department }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                   
                </table>

                <div class="block-head">
                    Investigation Details
                </div>
                <table>
                    <tr>
                        <th class="w-20" >Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

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
                
                <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->root_cause_initial_attachment)
                            @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
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
              HOD Review
            </div>
            <table>
                <tr>
                    <th class="w-20" >HOD Review Comment</th>
                    <td class="w-80">
                        @if ($data->hod_comments)
                            {{ $data->hod_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_attachments)
                        @foreach (json_decode($data->hod_attachments) as $key => $file)
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
              Initial QA/CQA Review 
            </div>
            <table>
                <tr>
                    <th class="w-20" >Initial QA/CQA Review Comments</th>
                    <td class="w-80">
                        @if ($data->cft_comments_new)
                            {{ $data->cft_comments_new }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            
            <div class="border-table">
                <div class="block-head">
                    Initial QA/CQA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cft_attchament_new)
                        @foreach (json_decode($data->cft_attchament_new) as $key => $file)
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


        <style>
            .tableFMEA {
                width: 100%;
                border-collapse: collapse;
                font-size: 7px;
                table-layout: fixed; /* Ensures columns are evenly distributed */
            }

            .thFMEA,
            .tdFMEA {
                border: 1px solid black;
                padding: 5px;
                word-wrap: break-word;
                text-align: center;
                vertical-align: middle;
                font-size: 6px; /* Apply the same font size for all cells */
            }

            /* Rotating specific headers */
            .rotate {
                transform: rotate(-90deg);
                white-space: nowrap;
                width: 10px;
                height: 100px;
            }

            /* Ensure the "Traceability Document" column fits */
            .tdFMEA:last-child,
            .thFMEA:last-child {
                width: 80px; /* Allocate more space for "Traceability Document" */
            }

            /* Adjust for smaller screens to fit */
            @media (max-width: 1200px) {
                .tdFMEA:last-child,
                .thFMEA:last-child {
                    font-size: 6px;
                    width: 70px; /* Shrink width further for smaller screens */
                }
            }

        </style>


        <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>
                <!-- <div class="block-head">
                    Investigation
                </div> -->

                <table>
                    <tr>
                        <th class="w-20">Objective</th>
                        <td class="w-80">
                            @if ($data->objective)
                                {!! strip_tags($data->objective) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


               

                <table>
                    <tr>
                        <th class="w-20">Scope</th>
                        <td class="w-80">
                            @if ($data->scope)
                                {!! strip_tags($data->scope) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($data->problem_statement_rca)
                                {!! strip_tags($data->problem_statement_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Background</th>
                        <td class="w-80">
                            @if ($data->requirement)
                                {!! strip_tags($data->requirement) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">
                            @if ($data->immediate_action)
                                {!! strip_tags($data->immediate_action) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Team</th>
                        <td class="w-80">
                            @if ($data->investigation_team)
                                {{($investigation_teamNamesString) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>        
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if (!empty($data->selectedMethodologies))
                                {{ implode(', ', $data->selectedMethodologies) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <br><br>
                <div class="border-table  tbl-bottum">
                    <div class="block-head">
                        Failure Mode and Effect Analysis
                    </div>
                    <table class="tableFMEA">
                        <thead>
                            <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                <th class="thFMEA" rowspan="2">Sr.No</th>
                                <th class="thFMEA" colspan="2">Risk Identification</th>
                                <th class="thFMEA">Risk Analysis</th>
                                <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                <th class="thFMEA">Risk Control</th>
                                <th class="thFMEA" colspan="6">Risk Evaluation</th>

                                <th class="thFMEA" rowspan="2">Traceability Document</th>
                                
                            </tr>
                            <tr class="table_bg">
                                <th class="thFMEA">Activity</th>
                                <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                <!-- <th class="thFMEA">Others</th>
                                <th class="thFMEA">Attchment</th> -->
                                
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($data->risk_factor))
                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                <tr class="tr">
                                    <td class="tdFMEA">{{ $key + 1 }}</td>
                                    <td class="tdFMEA">{{ $riskFactor }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                    
                                </tr>
                            @endforeach
                            @else
                            @endif

                        </tbody>
                    </table>

                </div>
               
                <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>

                @if (!empty($data))
                    @php
                        $measurement = !empty($data->measurement) ? unserialize($data->measurement) : [];
                        $materials = !empty($data->materials) ? unserialize($data->materials) : [];
                        $methods = !empty($data->methods) ? unserialize($data->methods) : [];

                        $environment = !empty($data->environment) ? unserialize($data->environment) : [];
                        $manpower = !empty($data->manpower) ? unserialize($data->manpower) : [];
                        $machine = !empty($data->machine) ? unserialize($data->machine) : [];

                        $problem_statement = $data->problem_statement ?? 'N/A';

                        $maxCount = max(count($measurement), count($materials), count($methods));
                        $maxCount2 = max(count($environment), count($manpower), count($machine));
                    @endphp

                    <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                        <!-- Top Table -->
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr valign="top">
                                <!-- First Table -->
                                <td style="width: 70%;">
                                    <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                        <thead>
                                            <tr style="color: #007bff;">
                                                <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $maxCount; $i++)
                                                <tr>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>        
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr >
                                <td style="width: 70%;">
                                    <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                </td>
                                <td style="width: 30%;">
                                    <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                                        <strong style="color: #007bff;">Problem Statement:</strong>
                                        <div style="margin-top: 10px;">
                                            {{ $data->problem_statement ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>       
                            </tr>
                        </table>


                        <!-- Second Table -->
                        <table style="width: 70%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="color: #007bff;">
                                    <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $maxCount2; $i++)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                @else
                    <p style="text-align: center; color: red;">No Fishbone data available.</p>
                @endif



                    <br><br><br><br>
                

                <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Inference
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-5">Sr.No.</th>
                            <th class="w-30">Type</th>
                            <th class="w-30">Remarks</th>
                        </tr>

                        @if (!empty($data->inference_type))
                            @foreach (unserialize($data->inference_type) as $key => $inference_type)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_type)[$key] ? unserialize($data->inference_type)[$key] : 'Not Applicable' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_remarks)[$key] ? unserialize($data->inference_remarks)[$key] : 'Not Applicable' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div>

                




                <div class="why-why-chart-container">
                    <div class="block-head">
                        <strong>Why-Why Chart</strong>
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="problem-statement">
                                <th>Problem Statement :</th>
                                <td>
                                    {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        @php
                            $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];
                        @endphp

                        @if (is_array($why_data) && count($why_data) > 0)
                            @foreach ($why_data as $index => $why)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="why-label">Why {{ $index + 1 }}</th>
                                            <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="answer-label">Answer {{ $index + 1 }}</th>
                                            <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <p class="text-muted">No Why-Why Data Available</p>
                        @endif
                    </div>

                    <div id="root-cause-container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="root-cause">
                                    <th>Root Cause :</th>
                                    <td>
                                        {{ $data->why_root_cause ?? 'Not Applicable' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="block-head">
                    Is/Is Not Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">What Will Be</th>
                        <td class="w-80">
                            @if ($data->what_will_be)
                                {{ $data->what_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Not Be </th>
                        <td class="w-80">
                            @if ($data->what_will_not_be)
                                {{ $data->what_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Rationale </th>
                        <td class="w-80">
                            @if ($data->what_rationable)
                                {{ $data->what_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Be</th>
                        <td class="w-80">
                            @if ($data->where_will_be)
                                {{ $data->where_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Not Be </th>
                        <td class="w-80">
                            @if ($data->where_will_not_be)
                                {{ $data->where_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Rationale </th>
                        <td class="w-80">
                            @if ($data->where_rationable)
                                {{ $data->where_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    <tr>
                        <th class="w-20">When Will Be</th>
                        <td class="w-80">
                            @if ($data->when_will_be)
                                {{ $data->when_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Not Be </th>
                        <td class="w-80">
                            @if ($data->when_will_not_be)
                                {{ $data->when_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Rationale </th>
                        <td class="w-80">
                            @if ($data->when_rationable)
                                {{ $data->when_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Be</th>
                        <td class="w-80">
                            @if ($data->coverage_will_be)
                                {{ $data->coverage_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Not Be </th>
                        <td class="w-80">
                            @if ($data->coverage_will_not_be)
                                {{ $data->coverage_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Rationale </th>
                        <td class="w-80">
                            @if ($data->coverage_rationable)
                                {{ $data->coverage_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Be</th>
                        <td class="w-80">
                            @if ($data->who_will_be)
                                {{ $data->who_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>

                        <th class="w-20">Who Will Not Be </th>
                        <td class="w-80">
                            @if ($data->who_will_not_be)
                                {{ $data->who_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Who Will Rationale </th>
                        <td class="w-80">
                            @if ($data->who_rationable)
                                {{ $data->who_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
            </div>


                <table>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->root_cause_Others)
                                {!! strip_tags($data->root_cause_Others) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="border-table">
                    <div class="block-head">
                        Other Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->investigation_attachment)
                            @foreach (json_decode($data->investigation_attachment) as $key => $file)
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

                

                <table>
                    <tr>
                        <th class="w-20">Root Cause</th>
                        <td class="w-80">
                            @if ($data->root_cause)
                                {!! strip_tags($data->root_cause) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Impact / Risk Assessment</th>
                        <td class="w-80">
                            @if ($data->impact_risk_assessment)
                                {!! strip_tags($data->impact_risk_assessment) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                
                <table>
                    <tr>
                        <th class="w-20">CAPA</th>
                        <td class="w-80">
                            @if ($data->capa)
                                {!! strip_tags($data->capa) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Summary</th>
                        <td class="w-80">
                            @if ($data->investigation_summary_rca)
                                {!! strip_tags($data->investigation_summary_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
        
        
        <div class="border-table">
            <div class="block-head">
                Investigation Attachment

            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment</th>
                </tr>
                @if ($data->root_cause_initial_attachment_rca)
                    @foreach (json_decode($data->root_cause_initial_attachment_rca) as $key => $file)
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
    
        </div><br>





                

        <div class="block">
            <div class="block-head">
                HOD Final Review
            </div>

            <table>
                <tr>
                    <th class="w-20"> HOD Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->hod_final_comments)
                            {!! strip_tags($data->hod_final_comments) !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_final_attachments)
                        @foreach (json_decode($data->hod_final_attachments) as $key => $file)
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
                QA/CQA Final Review
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->qa_final_comments)
                            {{ strip_tags($data->qa_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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
                QAH/CQAH/Designee Final Approval
            </div>
            <table>
                <tr>
                    <th class="w-20">QAH/CQAH/Designee Final Approval Comments</th>
                    <td class="w-80">
                        @if ($data->qah_final_comments)
                            {{ strip_tags($data->qah_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH/Designee Final Approval Attachments

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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
               

                {{-- <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                        </tr>
                      --}}
                </table>
                {{-- <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Root Cause
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Sr.No.</th>
                            <th class="w-30">Root Cause Category</th>
                            <th class="w-30">Root Cause Sub-Category</th>
                            <th class="w-30">Probability</th>
                            <th class="w-30">Remarks</th>
                        </tr>
                        {{-- @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
                        {{-- @if (!empty($data->Root_Cause_Category))
                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                    </td>
                                    <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div> --}} 
                
  
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
    
                                    <tr>
                                        <th class="w-20">Acknowledge By</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_by)
                                                {{ $data->acknowledge_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Acknowledge On</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_on)
                                                {{ Helpers::getdateFormat($data->acknowledge_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                
                                        <th class="w-20"> Acknowledge Comment</th>
                                        <td class="w-30">
                                            @if ($data->ack_comments)
                                                {{ $data->ack_comments }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                    {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
    
                                                                        
                                 <tr>
                                    <th class="w-20">HOD Review Complete By</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_By)
                                            {{ $data->HOD_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete On</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_On)
                                            {{ Helpers::getdateFormat($data->HOD_Review_Complete_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete Comment</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_Comment)
                                            {{ $data->HOD_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    {{-- <th class="w-20">QA Review Complete Comment</th>
                                            <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                                </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                </tr> --}}

                                <tr>
                                        <th class="w-20">QA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_By)
                                                {{ $data->QQQA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->QQQA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->QAQQ_Review_Complete_comment)
                                                {{ $data->QAQQ_Review_Complete_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                </tr> --}}
    
                           
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
                                                {{ Helpers::getdateFormat($data->submitted_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit Comment</th>
                                        <td class="w-30">
                                            @if ($data->qa_comments_new)
                                                {{ $data->qa_comments_new }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">HOD Final Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_By)
                                            {{ $data->HOD_Final_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">HOD Final Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_On)
                                            {{ $data->HOD_Final_Review_Complete_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">
                                            HOD Final Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_Comment)
                                            {{ $data->HOD_Final_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr>
                                            <th class="w-20">More Info Required By
                                            </th>
                                            <td class="w-30"> @if($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20"> FinalQA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_By)
                                                {{ $data->Final_QA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->Final_QA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Completed Comment</th>
                                        <td class="w-30">
                                            @if ($data->evalution_Closure_comment)
                                                {{ $data->Final_QA_Review_Complete_Comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">QAH/CQAH Closure By</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_by)
                                                {{ $data->evaluation_complete_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QAH/CQAH Closure On</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_on)
                                                {{ Helpers::getdateFormat($data->evaluation_complete_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">
                                            QAH/CQAH Closure Comment</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_Comment)
                                                {{ $data->evalution_Closure_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Cancel By
                                        </th>
                                        <td class="w-30">
                                            @if ($data->cancelled_by)
                                                {{ $data->cancelled_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel On</th>
                                        <td class="w-30">
                                            @if ($data->cancelled_on)
                                                {{ $data->cancelled_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel comment</th>
                                        <td class="w-30">
                                            @if ($data->cancel_comment)
                                                {{ $data->cancel_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                    </tr>
    
                </table>
            </div>
        </div>

                {{-- <tr>
                    <th class="w-20">Investigation Tool</th>
                    <td class="w-80">
                        @if ($data->investigation_tool)
                            {{ $data->investigation_tool }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                {{-- <tr>
                    <th class="w-20">Root Cause</th>
                    <td class="w-80">
                        @if ($data->root_cause)
                            {{ $data->root_cause }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Impact / Risk Assessment</th>
                    <td class="w-80">
                        @if ($data->impact_risk_assessment)
                            {{ $data->impact_risk_assessment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA</th>
                    <td class="w-80">
                        @if ($data->capa)
                            {{ $data->capa }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Summary</th>
                    <td class="w-80">
                        @if ($data->investigation_summary_rca)
                            {{ $data->investigation_summary_rca }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>



            </table>
            
        </div>

      
       
       
        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QA/CQA Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qa_final_comments)
                        {{ $data->qa_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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
                QAH/CQAH Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QAH/CQAH Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qah_final_comments)
                        {{ $data->qah_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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

        </div>--}}
       


        
        </div>
        </div>
        @endforeach
    @endif



</body>

</html>
