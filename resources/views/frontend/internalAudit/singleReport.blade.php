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
                   Internal Audit Single Report
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
                    <strong>Internal Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/IA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                        <td class="w-30">@if($data->record){{ Helpers::divisionNameForQMS($data->division_id) }}/IA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->Initiator_Group){{ $data->Initiator_Group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                        </td>
                        <th class="w-20">Severity Level </th>
                        <td class="w-30">
                            @if($data->severity_level_form){{ $data->severity_level_form }}@else Not Applicable @endif
                        </td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit type</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }}@else Not Applicable @endif</td>
                        <th class="w-20">If Other</th>
                        <td class="w-30">@if($data->if_other){{ $data->if_other }}@else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_if_other){{ $data->initiated_if_other }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">@if($data->initial_comments){{ $data->initial_comments }}@else Not Applicable @endif</td>
                        <th class="w-20">Type of Audit</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }}@else Not Applicable @endif</td>
                        <th class="w-20">Audit start date</th>
                        <td class="w-30">@if($data->audit_start_date){{ $data->audit_start_date }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">External Agencies</th>
                        <td class="w-30">@if($data->external_agencies){{ $data->external_agencies }}@else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->Others){{ $data->Others }}@else Not Applicable @endif</td>
                        

                    </tr>

                </table>
           


            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Audit Planning
                    </div>
                    <table>
                        <tr>
                            <th class="w-30">Audit Schedule Start Date</th>
                            <td class="w-20">@if($data->audit_schedule_start_date){{ $data->audit_schedule_start_date }}@else Not Applicable @endif</td>
                            <th class="w-30">Audit Schedule End Date</th>
                            <td class="w-20">@if($data->audit_schedule_end_date){{ $data->audit_schedule_end_date }}@else Not Applicable @endif</td>
                        </tr>   
                        <tr>
                            <th class="w-20">Comments(If Any)</th>
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
                        <th class="w-20">External Auditing Agencys</th>
                        <td class="w-30">@if($data->External_Auditing_Agency){{ $data->External_Auditing_Agency }}@else Not Applicable @endif</td>
                        <th class="w-20">Relevant Guidelines /Industry Standards</th>
                        <td class="w-30">@if($data->Relevant_Guideline){{ $data->Relevant_Guideline }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Comments</th>
                        <td class="w-30">@if($data->QA_Comments){{ $data->QA_Comments }}@else Not Applicable @endif</td>
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
                        <th class="w-20">Audit Category</th>
                        <td class="w-30">@if($data->Audit_Category){{ Helpers::getInitiatorName( $data->Audit_Category)}}@else Not Applicable @endif</td>
                    </tr>   
                   <tr>
                        <th class="w-20">Supplier/Vendor/Manufacturer Site</th>
                        <td class="w-30">@if($data->Supplier_Site){{ $data->Supplier_Site }}@else Not Applicable @endif</td>
                        <th class="w-20">Supplier/Vendor/Manufacturer Details</th>
                        <td class="w-30">@if($data->Supplier_Details){{ $data->Supplier_Details}}@else Not Applicable @endif</td>
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
                Guideline  Attachment
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
                            <th class="w-20">Audit Comments</th>
                            <td class="w-80"> @if($data->Audit_Comments2){{ $data->Audit_Comments2 }}@else Not Applicable @endif</td>
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
                            <th class="w-60">Batch No</th>
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



                <div class="block">
                    <div class="block-head">
                        Audit Response & Closure
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Remarks
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->Remarks){{ $data->Remarks }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Reference Record</th>
                            <td class="w-30">
                                    <div>
                                        @if($data->refrence_record){{ Helpers::getDivisionName( $data->refrence_record )}}/IA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Audit Comments
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->Audit_Comments2){{ $data->Audit_Comments2 }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Due Date Extension Justification</th>
                            <td class="w-30">
                                    <div>
                                        @if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>
                   </table>
            </div>
        </div>
    </div>
    
                
                <div class="border-table">
                    <div class="block-head">
                        Report  Attachment
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

                        @php
                            $questions_packing = [
                                "Is access to the facility restricted?",
                                "Is the dispensing area cleaned as per SOP?",
                                "Check the status label of area and equipment.",
                                "Are all raw materials carry proper label?",
                                "Standard operating procedure for dispensing of raw material is displayed?",
                                "All the person involve in dispensing having proper gowning?",
                                "Where you keep the materials after dispensing?",
                                "Is there any log book for keeping the record of dispensing?",
                                "Have you any standard practice to cross check the approved status of raw materials before dispensing?",
                                "Are all balances calibrated which are to be use for dispensing?",
                                "Is the pressure differential of RLAF is within acceptance limit? What is the limit? _______",
                                "Is the pressure differential of the area is within acceptance limit? Check the pressure differential__________",
                                "Is there any record for room temperature & relative humidity? Check the temperature _____°C & RH _____%"
                            ];

                            $questions_documentation = [
                                "Is status labels displayed on all equipments?",
                                "Is the dispensing area cleaned as per SOP?",
                                "Check the status label of area and equipment.",
                                "Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?",
                                "Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?",
                                "Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?",
                                "Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance",
                                "Are there written instructions describing how to use in-process data to control the process?",
                                "Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book",
                                "Is equipment inspected immediately prior to use?",
                                "Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?",
                                "Has a written schedule been established and is it followed for cleaning of equipment?",
                                "Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?",
                                "Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments.",
                                "Is equipment cleaned promptly after use?",
                                "Is there proper storage of cleaned equipment so as to prevent contamination?",
                                "Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?",
                                "Is sewage, trash and other reuse disposed off in a safe and sanitary manner ( and with sufficient frequency)",
                                "Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.",
                                "Are all weighing and measuring performed by one qualified person and checked by a second person Check the weighing balance record.",
                                "Are the sieves & screen kept in proper place with proper label?",
                                "Is the pressure differential of every particular area are within limit?",
                                "All the person working in granulation area having proper gowning?",
                                "Is Inventory record of sieve, screen, rubber sleeve, FBD bag, etc. maintained?",
                                "Check the FBD bags for three products, and their utilization records.",
                                "Have you any SOP regarding Hold time of material during staging?",
                                "Is there a written procedure specifying the frequency of inspection and replacement for air filters?",
                                "Are written operating procedures available for each equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.",
                                "Does each equipment have written instructions for maintenance that includes a schedule for maintenance?",
                                "Does the process control address all issues to ensure identity, strength, quality and purity of product?",
                                "Check the calibration labels for instrument calibration status.",
                                "Temperature & RH record log book is available for each staging area.",
                                "Check for area activity record.",
                                "Check for equipment usage record.",
                                "Check for general equipment details and accessory details.",
                                "Check for man & material movement in the area.",
                                "Air handling system qualification , cleaning details and PAO test reports.",
                                "Check for purified water hose pipe status and water hold up.",
                                "Check for the status labeling in the area and material randomly.",
                                "Check the in-process equipments cleaning status & records.",
                                "Are any unplanned process changes (process excursions) documented in the batch record?",
                                "If the product is blended, are there blending parameters and/or homogeneity specifications?",
                                "Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?",
                                "Is there is an preventive maintenance program for all equipment and status of it."
                                ];

                                $questions_documentation_table = [
                                "Do records have doer & checker signatures? Check the timings, date and yield etc. in the batch manufacturing record.",
                                "Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports.",
                                "Is the batch record is on line up to the current stage of a process?",
                                "In process carried out as per the written instruction describe in batch record?",
                                "Is there any area cleaning record available?",
                                "Current version of SOP’s is available in respective areas?",
                                ];
                        @endphp

                                                
                                <div class="inner-block">
                                    <div class="content-table">
                                        <!-- <div class="border-table"> -->
                                            <div class="block-head">
                                                Checklist - Tablet Dispensing & Granulation
                                            </div>
                                            <div>
                                                @php
                                                    $checklists = [
                                                        [
                                                            'title' => 'Checklist for Tablet Dispensing',
                                                            'questions' => $questions_packing,
                                                            'prefix' => 1
                                                        ],
                                                        [
                                                            'title' => 'Checklist for INJECTION MANUFACTURING / FILTERATION / FILLING /VISUAL INSPECTION',
                                                            'questions' => $questions_documentation,
                                                            'prefix' => 2
                                                        ],
                                                        [
                                                            'title' => 'Checklist for Documentation Table',
                                                            'questions' => $questions_documentation_table,
                                                            'prefix' => 3
                                                        ]
                                                    ];
                                                @endphp

                                                @foreach ($checklists as $checklist)
                                                    <div class="block" style="color: #4274da; display: inline-block; border-bottom: 1px solid #4274da;">
                                                        {{ $checklist['title'] }}
                                                    </div>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%;">Sr. No.</th>
                                                                <th style="width: 40%;">Question</th>
                                                                <th style="width: 20%;">Response</th>
                                                                <th>Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($checklist['questions'] as $index => $question)
                                                                @php
                                                                    $response = $data->{"response_" . ($index + 1)};
                                                                    $remark = $data->{"remark_" . ($index + 1)};
                                                                @endphp

                                                                <!-- Check if either response or remark is not empty -->
                                                                @if($response || $remark)
                                                                    <tr>
                                                                        <td class="flex text-center">{{ $checklist['prefix'] . '.' . ($index + 1) }}</td>
                                                                        <td>{{ $question }}</td>
                                                                        <td>
                                                                            <div style="display: flex; justify-content: center; align-items: center; margin: 5%; gap: 5px;">
                                                                                {{ $response }}
                                                                            </div>
                                                                        </td>
                                                                        <td style="vertical-align: middle;">
                                                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                                                {{ $remark }}
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                           



            
            <div class="inner-block">
            <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Schedule Audit By</th>
                        <td class="w-30">{{ $data->audit_schedule_by }}</td>
                        <th class="w-20">Schedule Audit On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_schedule_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->sheduled_audit_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_1_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_1_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->cancel_1_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Acknowledement by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">Acknowledement On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->acknowledge_commnet }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required by</th>
                        <td class="w-30">{{ $data->more_info_2_by }}</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->more_info_2_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->more_info_2_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_2_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_2_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->cancel_2_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Issue Report By</th>
                        <td class="w-30">{{ $data->audit_mgr_more_info_reqd_by }}</td>
                        <th class="w-20">Issue Report On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_mgr_more_info_reqd_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->issue_report_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Required By
                        </th>
                        <td class="w-30">{{ $data->more_info_3_by }}</td>
                        <th class="w-20">More Info Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->more_info_3_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->more_info_3_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->cancel_3_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Plan Proposed By</th>
                        <td class="w-30">{{ $data->audit_observation_submitted_by }}</td>
                        <th class="w-20">
                            CAPA Plan Proposed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_observation_submitted_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->capa_plan_comment }}</td>
                    
                    </tr>
                    <tr>
                        <th class="w-20">No CAPAs Required By</th>
                        <td class="w-30">{{ $data->no_capa_plan_by }}</td>
                        <th class="w-20">
                            No CAPAs Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->no_capa_plan_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->no_capa_plan_required_comment }}</td>
                    
                    </tr>
                    <tr>
                        <th class="w-20">Response Reviewed By</th>
                        <td class="w-30">{{ $data->response_feedback_verified_by }}</td>
                        <th class="w-20">
                            Response Reviewed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->response_feedback_verified_on) }}</td>
                        <th class="w-20">Comment</th>
                        <td class="w-30">{{ $data->response_reviewd_comment }}</td>
                    
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
