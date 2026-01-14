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
                    Out Of Calibration Report
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





</body>

</html>
