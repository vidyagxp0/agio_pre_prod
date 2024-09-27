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
                        <th class="w-20">Initiator Department </th>
                        <td class="w-30">@if($data->Initiator_Group){{ $data->Initiator_Group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Department  Code</th>
                        <td class="w-30">@if($data->initiator_group_code){{ $data->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Auditee Department Head</th>
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

                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_if_other){{ $data->initiated_if_other }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Scheduled audit date</th>
                        <td class="w-30"> @if($data->sch_audit_start_date){{Helpers::getdateFormat ($data->sch_audit_start_date) }} @else Not Applicable @endif</td>
                        <th class="w-20">Auditee department Name</th>
                        <td class="w-30">@if($data->assign_to){{ $data->assign_to }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit type</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }}@else Not Applicable @endif</td>
                        <th class="w-20">If Other</th>
                        <td class="w-30">@if($data->if_other){{ $data->if_other }}@else Not Applicable @endif</td>
                        
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">@if($data->initial_comments){{ $data->initial_comments }}@else Not Applicable @endif</td>
                        {{-- <th class="w-20">Type of Audit</th>
                        <td class="w-30">@if($data->audit_type){{ $data->audit_type }}@else Not Applicable @endif</td>
                        <th class="w-20">Audit start date</th> --}}
                        {{-- <td class="w-30">@if($data->audit_start_date){{ $data->audit_start_date }}@else Not Applicable @endif</td> --}}

                    </tr>
                    {{-- <tr>
                        <th class="w-20">External Agencies</th>
                        <td class="w-30">@if($data->external_agencies){{ $data->external_agencies }}@else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->Others){{ $data->Others }}@else Not Applicable @endif</td>
                        

                    </tr> --}}

                </table>
                <div class="border-table">
                    <div class="block-head">
                        GI Attachment
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
        </div> 
                <div class="block">
                    <div class="head">
                        <div class="block-head">
                            Acknowledgment          
                        </div>
                        <table>
                            <tr>
                                <th class="w-30">Auditee Comment</th>
                                <td class="w-20">@if($data->Auditee_comment){{ $data->Auditee_comment }}@else Not Applicable @endif</td>
                                <th class="w-30">Auditor Comment</th>
                                <td class="w-20">@if($data->Auditor_comment){{ $data->Auditor_comment }}@else Not Applicable @endif</td>
                            </tr>   
                        </table>
                        <div class="border-table">
                            <div class="block-head">
                                Acknowledgment Attachment
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
                    </div>
                </div>
           


            {{-- <div class="block">
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
            </div> --}}
            {{-- <div class="block">
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
            </div> --}}
          
           
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Audit Preparation and Execution</div>
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
                            <th class="w-20">Comments</th>
                            <td class="w-30">@if($data->Comments){{ $data->Comments }}@else Not Applicable @endif</td>
                        </tr>
                   </table>
                </div>
                 <div class="border-table">
                <div class="block-head">
                    Audit Preparation and Execution Attachment</div>
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
                {{-- <div class="border-table">
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
                </div>--}}



                <div class="block">
                    <div class="block-head">
                        Pending Response
                    </div>
                    <table>
                        <tr>
                            
                            <th class="w-20">Reference Record</th>
                            <td class="w-30">
                                    <div>
                                        @if($data->refrence_record){{ Helpers::getDivisionName( $data->refrence_record )}}/IA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif
                            </td>
                            <th class="w-20">Audit Comments
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->Audit_Comments2){{ $data->Audit_Comments2 }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <th class="w-20">Due Date Extension Justification</th>
                            <td class="w-30">
                                    <div>
                                        @if($data->due_date_extension){{ $data->due_date_extension }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>
                   </table>
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
            <div class="block">
                <div class="block-head">
                    Response Verification
                    </div>
        
                    <table>
                        <tr>
                            <th>
                            Response Verification Comment
                            </th>
                            <td>
                                {{ $data->res_ver }}
                            </td>
                            <th>
                            Response verification Attachments
                            </th>
                            <td>
                                {{ $data->attach_file_rv }}
                            </td>
                        </tr>
                    </table>
        
            </div>
        </div>
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
                                         
                                @php
                                    $questions_packing = [
                                        'Check for area activity record.',
                                        'Check for equipment usage record.',
                                        'Check for general equipment details and accessory details.',
                                        'Check for man & material movement in the area.',
                                        'Air handling system qualification, cleaning details and PAO test reports.',
                                        'Check for purified water hose pipe status and water hold up.',
                                        'Check for the status labeling in the area and, material randomly.',
                                        'Check the in-process equipments cleaning status & records.',
                                        'Are any unplanned process changes (process excursions) documented in the batch record?',
                                        'Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?',
                                        'Is there a preventive maintenance program for all equipment and status of it?',
                                        'Status label of area & equipment available?',
                                        'Have you any proper storage area for primary and secondary packing material?',
                                        'Do you have proper segregation system for keeping product/batch separately?',
                                        'Is there proper covering of printed foil roll with poly bag?',
                                        'Stereo impression record available? Check the record for any 2 batches.',
                                        'Where you keep the rejected strips / blisters / containers / cartons?',
                                        'Is there any standard practice for destruction of printed aluminum foil & printed cartons?',
                                        'Is there a written procedure for cleaning the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials?',
                                        'Have you any standard procedure for removal of scrap?',
                                    ];

                                    $questions_documentation = [
                                        'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch packing record.',
                                        'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports.',
                                        'Is the batch record is on line up to the current stage of a process?',
                                        'In process carried out as per the written instruction describe in batch record?',
                                        'Is there any area cleaning record available for all individual areas?',
                                        "Current version of SOP's is available in respective areas?",
                                    ];
                                            @endphp   
                                            @if(!empty($data->checklist3))
                
                                                    <div class="inner-block">
                                                        <div class="content-table">
                                                            <!-- <div class="border-table"> -->
                                                                <div class="block-head">
                                                                    Checklist - Tablet/Capsule Packing
                                                                </div>
                                                                <div>
                                                                    @php
                                                                        $checklists = [
                                                                            [
                                                                                'title' => 'Checklist for Packing',
                                                                                'questions' => $questions_packing,
                                                                                'prefix' => 1
                                                                            ],
                                                                            [
                                                                                'title' => 'Checklist for Documentation',
                                                                                'questions' => $questions_documentation,
                                                                                'prefix' => 2
                                                                            ],

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
                                                                                        $response = $checklist3->{"tablet_capsule_packing_" . ($index + 1)};
                                                                                        $remark = $checklist3->{"tablet_capsule_packing_remark_" . ($index + 1)};
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
                                        @endif
                                            
                                            @php
                                            $questions = [
                                                'Is status labels displayed on all equipments / machines?',
                                                '1.2Equipment cleanliness, check few equipments.',
                                                'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product?',
                                                'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                                'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                                'Are there written instructions describing how to use in-process data to control the process?',
                                                'Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                                'Is equipment inspected immediately prior to use?',
                                                'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                                'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments',
                                                'Is equipment cleaned promptly after use?',
                                                'Is there proper storage of cleaned equipment so as to prevent contamination?	',
                                                'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)',
                                                'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                'Are all weighing and measuring performed by one qualified person and checked by a second person',
                                                'All the person working in manufacturing area having proper gowning?',
                                                'Have you any SOP regarding Hold time of material during staging?',
                                                'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                'Check for area activity record',
                                                'Check for equipment usage record',
                                                'Check for general equipment details and accessory details.',
                                                'Check for man & material movement in the area',
                                                'Air handling system qualification, cleaning details and PAO test reports',
                                                'Check for the status labeling in the area and, material randomly',
                                                'Check the in-process equipments cleaning status & records.',
                                                'Are any unplanned process changes (process excursions) documented in the batch record?',
                                                'Status label of area & equipment available?',
                                                'Have you any proper storage area for primary and secondary packing material?',
                                                'Do you have proper segregation system for keeping product/batch separately?',
                                                'Stereo impression record available? Check the record for any 2 batches.',
                                                'Where you keep the rejected ampoule / cartons?',
                                                'Is there any standard practice for destruction of printed ampoule label & printed cartons?',
                                                'Is there a written procedure for clearing the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials?',
                                                'Is there any procedure for operation and cleaning of ampoule label machine, verify the record',
                                                'Is there any procedure for operation and cleaning of ampoule blister machine, verify the record.',
                                                'Have you any standard procedure for removal of scrap?',
                                                'Is there any procedure to cross verify the dispensed packaging material before starting the packaging.',
                                            ];

                                            $questions_documentation = [
                                                'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                                'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports',
                                                'Is the batch record is on line up to the current stage of a process?',
                                                'In process carried out as per the written instruction describe in batch record?',
                                                'Is there any punch inventory and punch utilization record?	',
                                                'Is there any area cleaning record available for all individual areas?',
                                                'Current version of SOP’s is available in respective areas?',
                                            ];
                                        @endphp
                                   @if(!empty($data->checklist3))

                                        <div class="inner-block">
                                            <div class="content-table">
                                                <!-- <div class="border-table"> -->
                                                    <div class="block-head">
                                                        Checklist -Tablet Compression
                                                    </div>
                                                    <div>
                                                        @php
                                                            $checklists = [
                                                                [
                                                                    'title' => 'Checklist for Tablet Compression',
                                                                    'questions' => $questions,
                                                                    'prefix' => 1
                                                                ],
                                                                [
                                                                    'title' => 'Checklist for Documentation',
                                                                    'questions' => $questions_documentation,
                                                                    'prefix' => 2
                                                                ],

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
                                                                            $response = $checklist1->{"tablet_compress_response_" . ($index + 1)};
                                                                            $remark = $checklist1->{"tablet_compress_remark_" . ($index + 1)};
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
                                        
                                    @endif

                                        @php
                                            $liquidOintmentPackingQuestions = [
                                                'Is status labels displayed on all equipments?',
                                                'Equipment cleanliness, check few equipments.',
                                                'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product?',
                                                'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? Are these procedures been validated?',
                                                'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                                'Are there written instructions describing how to use in-process data to control the process?',
                                                'Are all pieces of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                                'Is equipment inspected immediately prior to use?',
                                            'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                                "Is clean equipment clearly identified as 'cleaned' with a cleaning date shown on the equipment tag? Check for few equipments",
                                                'Is equipment cleaned promptly after use?',
                                                'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                                'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                                'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)?',
                                                'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                'Are all weighing and measuring performed by one qualified person and checked by a second person? Check the weighing balance record.',
                                                'All the person working in manufacturing area having proper gowning?',
                                                'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                        'Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                                        'Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                                        'Does the process control address all issues to ensure identity, strength, quality and purity of product?',
                                                        'Check the calibration labels for instrument calibration status.',
                                                        'Temperature & RH record log book is available for each staging area.',
                                                        'Material/Product in out register is available for each staging area.',
                                                        'Check for area activity record.',
                                                        'Check for equipment usage record.',
                                                        'Check for general equipment details and accessory details.',
                                                        'Check for man & material movement in the area.',
                                                        'Air handling system qualification, cleaning details and PAO test reports.',
                                                        'Check for purified water hose pipe status and water hold up.',
                                                        'Check for the status labeling in the area and, material randomly.',
                                                        'Check the in-process equipments cleaning status & records.',
                                                        'Are any unplanned process changes (process excursions) documented in the batch record?',
                                                        'Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?',
                                                        'Is there a preventive maintenance program for all equipment and status of it?',
                                                        'Do you have any sop for operation of autocoator?',
                                                        'Have u any usage log book for autocoator.',
                                                        

                                            
                                            ];

                                            $documentationQuestions = [
                                                'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                                'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports.',
                                                'Is the batch record is on line up to the current stage of a process?',
                                                'In process carried out as per the written instruction describe in batch record?',
                                                'Is there any area cleaning record available for all individual areas?',
                                                'Current version of SOP’s is available in respective areas?',
                                            ];
                                    @endphp
                               @if(!empty($data->checklist2))
                               <div class="inner-block">
                                <div class="content-table">
                                    <!-- <div class="border-table"> -->
                                        <div class="block-head">
                                            Checklist -Tablet Coating
                                        </div>
                                        <div>
                                            @php
                                                $checklists = [
                                                    [
                                                        'title' => 'Checklist for Tablet Coating',
                                                        'questions' => $questions,
                                                        'prefix' => 1
                                                    ],
                                                    [
                                                        'title' => 'Checklist for Documentation',
                                                        'questions' => $questions_documentation,
                                                        'prefix' => 2
                                                    ],

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
                                                                $response = $checklist2->{"tablet_coating_response_" . ($index + 1)};
                                                                $remark = $checklist2->{"tablet_coating_remark_" . ($index + 1)};
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
                               @endif

                                    

                                            @php
                                            $CapsulePackingQuestions=[
                                                    'equipment status labels displayed on all equipments?',
                                                    'Equipment cleanliness, check few equipments.',
                                                    'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non-additive so as not to affect the product?',
                                                    'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                                    'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                    'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                    'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment, and material? Check for procedure compliance.',
                                                    'Are there written instructions describing how to use in-process data to control the process?',
                                                    'Are all pieces of equipment clearly identified with easily visible markings? Check the equipment numbers correspond to an entry in a log book.',
                                                    'Is equipment inspected immediately prior to use?',
                                                    'Do cleaning instructions include disassembly and drainage procedures, if required, to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                    'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                    'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid the growth of microorganisms?',
                                                    'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for a few equipments.',
                                                    'Is equipment cleaned promptly after use?',
                                                    'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                                    'Is there an adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                                    'Is sewage, trash, and other refuse disposed of in a safe and sanitary manner (and with sufficient frequency)?',
                                                    'Are written records maintained on equipment cleaning, sanitizing, and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                    'Are all weighing and measuring performed by one qualified person and checked by a second person? Check the weighing balance record.',
                                                    'Is the pressure differential of every particular area within limit?',
                                                    'Are all persons working in the manufacturing area having proper gowning?',
                                                    'Do you have any SOP regarding the hold time of material during staging?',
                                                    'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                    'Are written operating procedures available for each piece of equipment used in manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                                    'Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                                    'Does the process control address all issues to ensure identity, strength, quality, and purity of the product?',
                                                    'Check the calibration labels for instrument calibration status.',
                                                    'Temperature & RH record log book is available for each staging area.',
                                                    'Check for area activity record.',
                                                    'Check for equipment usage record.',
                                                    'Check for general equipment details and accessory details.',
                                                    'Check for man & material movement in the area.',
                                                    'Air handling system qualification, cleaning details and PAO test reports.',
                                                    'Check for purified water hose pipe status and water hold up.',
                                                    'Check for the status labeling in the area and material randomly.',
                                                    'Check the in-process equipment cleaning status & records.',
                                                    'Are any unplanned process changes (process excursions) documented in the batch record?',
                                                    'Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?',
                                                    'Is there a preventive maintenance program for all equipment and the status of it?',
                                                    'Is there a written procedure for clearing the packaging area after one packaging operation and cleaning before the next operation, especially if the area is used for packaging different materials?',
                                                    'Do you have any standard procedure for the removal of scrap?',
                                                    'Is this plant free from infestation by rodents, birds, insects, and vermin?',
                                                    'Do you have written procedures for the safe use of suitable rodenticides, insecticides, fungicides, and fumigating agents? Check the corresponding records.',
                                                
                                                ];
                                                $documentationQuestions =[
                                                    'Do records have doer & checker signatures? Check the timings, date, and yield, etc. in the batch production record.',
                                                    'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In-process analytical reports.',
                                                    'Is the batch record online up to the current stage of the process?',
                                                    'Is the process carried out as per the written instructions described in the batch record?',
                                                    'Is there any area cleaning record available for all individual areas?',
                                                    'Current version  of SOPs available in respective areas?'];
                                            @endphp
                                    @if(!empty($data->checklist4))
                                    <div class="inner-block">
                                        <div class="content-table">
                                            <!-- <div class="border-table"> -->
                                                <div class="block-head">
                                                    Checklist -Capsule
                                                </div>
                                                <div>
                                                    @php
                                                        $checklists = [
                                                            [
                                                                'title' => 'Checklist for Capsule',
                                                                'questions' => $CapsulePackingQuestions,
                                                                'prefix' => 1
                                                            ],
                                                            [
                                                                'title' => 'Checklist for Documentation',
                                                                'questions' => $documentationQuestions,
                                                                'prefix' => 2
                                                            ],

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
                                                                        $response = $checklist4->{"capsule_response_" . ($index + 1)};
                                                                        $remark = $checklist4->{"capsule_remark_" . ($index + 1)};
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
                                    @endif
                                    @php
                                    $liquidOintmentPacking = [
                                        'Is status labels displayed on all equipments?',
                                        'Equipment cleanliness, check few equipments.',
                                        'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product?',
                                        'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? Are these procedures been validated?',
                                        'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                        
                                        'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                        'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                        'Are there written instructions describing how to use in-process data to control the process?',
                                        'Are all pieces of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                        'Is equipment inspected immediately prior to use?',
                                        
                                        'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                        'Has a written schedule been established and is it followed for cleaning of equipment?',
                                        'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                        "Is clean equipment clearly identified as 'cleaned' with a cleaning date shown on the equipment tag? Check for few equipments",
                                        'Is equipment cleaned promptly after use?',
                                    
                                        'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                        'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                        'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)?',
                                        'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                    
                                        'Are all weighing and measuring performed by one qualified person and checked by a second person? Check the weighing balance record.',
                                        'All the person working in packing area having proper gowning?',
                                        'Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                        'Does each equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                        'Does the process control address all issues to ensure identity, strength, quality and purity of product?',
                                        'Check the calibration labels for instrument calibration status.',
                                        'Temperature & RH record log book is available for each staging area.',
                                        'Check for area activity record.',
                                        'Check for equipment usage record.',
                                        'Check for general equipment details and accessory details.',
                                        'Check for man & material movement in the area.',
                                        'Air handling system qualification, cleaning details and PAO test reports.',
                                        'Check for the status labeling in the area and, material randomly.',
                                        'Check the in-process equipments cleaning status & records.',
                                        'Are any unplanned process changes (process excursions) documented in the batch record?',
                                        'Status label of area & equipment available?',
                                        'Have you any proper storage area for primary and secondary packing material?',
                                        'Do you have proper segregation system for keeping product/batch separately?',
                                        'Stereo impression record available? Check the record for any 2 batches.',
                                        'Where you keep the rejected tube / bottle/ cartons?',
                                        'Is there any standard practice for destruction of printed bottle label & printed cartons?',
                                        'Is there a written procedure for clearing the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials?',
                                        'Have you any standard procedure for removal of scrap?',
                                        'Is there any procedure to cross verify the dispensed packaging material before starting the packaging.',
                                        'Is there Lux Level of all working table is within acceptance limit?',
                                    ];

                                    $liquidOintmentQuestions = [
                                        'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                        'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports.',
                                        'Is the batch record is on line up to the current stage of a process?',
                                        'In process carried out as per the written instruction describe in batch record?',
                                        'Is there any area cleaning record available for all individual areas?',
                                        'Current version of SOP’s is available in respective areas?',
                                    ];
                                @endphp
                                    @if(!empty($data->checklist5))
                                    <div class="inner-block">
                                        <div class="content-table">
                                            <!-- <div class="border-table"> -->
                                                <div class="block-head">
                                                    Checklist - Liquid/Ointment Packing                                </div>
                                                <div>
                                                    @php
                                                        $checklists = [
                                                            [
                                                                'title' => 'Checklist for Liquid/Ointment Packing',
                                                                'questions' => $liquidOintmentPacking,
                                                                'prefix' => 1
                                                            ],
                                                            [
                                                                'title' => 'Checklist for Documentation',
                                                                'questions' => $liquidOintmentQuestions,
                                                                'prefix' => 2
                                                            ],

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
                                                                        $response = $checklist5->{"liquid_ointments_response_" . ($index + 1)};
                                                                        $remark = $checklist5->{"liquid_ointments_remark_" . ($index + 1)};
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
                                    @endif

                               @php
                                $dispensingAndManufacturingQuestions = [
                                    'Is access to the facility restricted?',
                                    'Is the dispensing area cleaned as per SOP?',
                                    'Check the status label of area and equipment.',
                                    'Are all raw materials carry proper label?',
                                    'Standard operating procedure for dispensing of raw material is displayed?',
                                    'All the person involved in dispensing having proper gowning?',
                                    'Where you keep the materials after dispensing?',
                                    'Is there any log book for keeping the record of dispensing?',
                                    'Have you any standard practice to cross check the approved status of raw materials before dispensing?',
                                    'Are all balances calibrated which are to be used for dispensing?',
                                    'Is the pressure differential of RLAF is within acceptance limit? What is the limit? _______',
                                    'Is the pressure differential of the area is within acceptance limit? Check the pressure differential__________',
                                    'Is there any record for room temperature & relative humidity? Check the temperature _____°C & RH _____%',
                                    'Is status labels displayed on all equipments?',
                                    'Equipment cleanliness, check few equipments.',
                                    'Are machine surfaces that contact materials or finished goods, non-reactive, non-absorptive and non-additive so as not to affect the product?',
                                    'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                    'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                    'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                    'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance.',
                                    'Are there written instructions describing how to use in-process data to control the process?',
                                    'Are all pieces of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                    'Is equipment inspected immediately prior to use?',
                                    'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                    'Has a written schedule been established and is it followed for cleaning of equipment?',
                                    'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                    'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments.',
                                    'Is equipment cleaned promptly after use?',
                                    'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                    'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                    'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)?',
                                    'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                    'Are all weighing and measuring performed by one qualified person and checked by a second person? Check the weighing balance record.',
                                    'All the person working in manufacturing area having proper gowning?',
                                    'Is there any procedure for cleaning of PLM?',
                                    'Is there any procedure for cleaning of wax melting vessel?',
                                    'Is the pressure differential of every particular area are within limit?',
                                    'Is there any procedure for cleaning of transfer pump?',
                                    'Is there any procedure for cleaning of liquid Mfg tank?',
                                    'Is there any procedure for cleaning of transfer line?',
                                    'Check the calibration status of temperature indicator of wax melting vessel.',
                                    'Have you any SOP regarding Hold time of material during staging?',
                                    'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                    'Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                    'Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                    'Does the process control address all issues to ensure identity, strength, quality and purity of product?',
                                    'Check the calibration labels for instrument calibration status.',
                                    'Temperature & RH record log book is available for each staging area.',
                                    'Is there any procedure for operation of tube filling and sealing machine?',
                                    'Is there any procedure for bottle washing, filling, and sealing machine?',
                                    'Check for area activity record.',
                                    'Check for equipment usage record.',
                                    'Check for general equipment details and accessory details.',
                                    'Check for man & material movement in the area.',
                                    'Air handling system qualification, cleaning details and PAO test reports.',
                                    'Check purified water hose pipe status and water hold up.',
                                    'Check for the status labeling in the area and material randomly.',
                                    "Check the in-process equipment's cleaning status & records.",
                                    'Are any unplanned process changes (process excursions) documented in the batch record?',
                                ];

                                $documentationQuestions = [
                                    'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                    'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports.',
                                    'Is the batch record on line up to the current stage of a process?',
                                    'In process carried out as per the written instruction describe in batch record?',
                                    'Is there any area cleaning record available for all individual areas?',
                                    "Current version of SOP's is available in respective areas?",
                                ];
                            @endphp
                             @if(!empty($data->checklist6))
                             <div class="inner-block">
                                <div class="content-table">
                                    <!-- <div class="border-table"> -->
                                        <div class="block-head">
                                            Checklist - Liquid/Ointment Packing                                </div>
                                        <div>
                                            @php
                                                $checklists = [
                                                    [
                                                        'title' => 'Checklist for Liquid/Ointment Packing',
                                                        'questions' => $dispensingAndManufacturingQuestions,
                                                        'prefix' => 1
                                                    ],
                                                    [
                                                        'title' => 'Checklist for Documentation',
                                                        'questions' => $documentationQuestions,
                                                        'prefix' => 2
                                                    ],
        
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
                                                                $response = $checklist6->{"dispensing_and_manufacturing_" . ($index + 1)};
                                                                $remark = $checklist6->{"dispensing_and_manufacturing_remark_" . ($index + 1)};
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
                             @endif 

                           @php
                                $qualityAssuranceQuestions = [
                                    'Does the QA unit have a person specifically charged with the responsibility of designing, revising and obtaining approval for production and testing procedures, forms and records?',
                                    'Is the production batch record and release test results reviewed for accuracy and completeness before a batch of finished product is released?',
                                    'Does a formal auditing function exist in the QA department?',
                                    'Does a written SOP specify who shall conduct audit and qualifications (education, training and experience) for those who conduct audits?',
                                    'Does a written SOP specify the scope and frequency of audits and how such audits are to be documented?',
                                    'Are vendors periodically inspected according to a written procedure?',
                                    'Is the procedure for confirming vendor test results written and followed?',
                                    'Does a written procedure or SOP to identify the steps required for product recall? Check the record.',
                                    'Are complaints, whether received in oral or written form, documented in writing retained in a designated file? (Customer complaint register and its related documents)',
                                    'Are complaints reviewed on a timely basis by the quality assurance unit?',
                                    'Is the action taken in response to each complaint documented?',
                                    'Are complaint investigations documented and do they include investigation steps, findings and follow up steps, if required? Are dates included for each entry?',
                                    'Check for Document control system',
                                    'Check for annual product quality review. (SOP)',
                                    'Check for trend on finished product quality attributes',
                                    'Check for validation documents – Cleaning and process validation',
                                    'Check for batch release system',
                                    'Check for Change control proposal system',
                                    'Check for vendor samples evaluation',
                                    'Check for Batch Production Record review system and record',
                                    'Do you have written procedures for approval / rejections of raw materials, intermediates, finished products, packing and packaging materials?',
                                    'Is each batch assigned a distinctive code, so material can be traced through analysis?',
                                    'Does inspection start with visual examination for appropriate labeling, signs of damage or contamination?',
                                    'Is the sampling technique written and followed for each type of material?',
                                    'Is the quantity of samples collected sufficient for analysis and reserve in case re testing or verification is required?',
                                    'Is containers are cleaned before taken samples',
                                    'Are stratified samples composited for analysis?',
                                    'Containers from which samples have been taken are so marked indicating date and approximate amount taken',
                                    'Are quality assurance review and approval required for reprocessing of materials, if any? (SOP)',
                                    'Has the each product been tested for stability on a written protocol?',
                                    'Does quality control & Quality Assurance review such reprocessed returned goods and test such materials for conformance to specifications before releasing such material for release?',
                                    'Check for the compliance of standard operating procedure',
                                    'Check for department organization chart and job responsibility',
                                    'Do you have written procedure for calibration of IPQC instruments? Check for its record and corresponding labels',
                                    'Is OOS investigation carried out for analytical failures? Check for compliance of OOS system against the system',
                                    'Check the 4-5 deviations record randomly? Are they confirming to SOP. ?',
                                    'Check whether the equipments qualification / requalification completed as per schedule',
                                    'Responsibilities and Authority - Are the QA/QC organization’s authority and responsibilities clearly defined in writing?',
                                    'Does QA assure that manufacturing and testing records are reviewed before batches are released for sale?',
                                    'Is there an adequate program for handling complaints, including investigation to determine the causes, corrective actions, verification of the effectiveness of corrective actions, a target time frame for responding; trend analysis, and notification of appropriate parties including management?',
                                    'Is a log maintained for changes to documents and facility?',
                                ];

                                $documentationQuestions = [
                                    'Does QA have authority to review and approve or reject?',
                                    'Is there an adequate system, described in an SOP, for controlling changes within the production process, including review and approval of changes to processes, documents, and equipment?',
                                    'Based on the audit findings and recommendations, are steps taken to correct any areas of noncompliance? Are corrective actions documented? Is their effectiveness verified in subsequent audits?',
                                    'If any contractors (e.g., laboratories, packagers) are used, are they periodically audited and is their performance monitored?',
                                    'Audit programs - Is there an internal quality audit program that covers all areas of the operation to verify that SOPs and other procedures and policies are being followed, and to determine effectiveness of the quality systems?',
                                    'Is there an SOP for investigation of manufacturing deviations and batch failures to determine the cause and institute corrective actions to prevent the situation from recurring?',
                                ];
                            @endphp
                                 @if(!empty($data->checklist7))
                                 <div class="inner-block">
                                    <div class="content-table">
                                        <!-- <div class="border-table"> -->
                                            <div class="block-head">
                                                Checklist - Quality Assurance
                                            </div>
                                            <div>
                                                @php
                                                    $checklists = [
                                                        [
                                                            'title' => 'Checklist for Quality Assurance',
                                                            'questions' => $qualityAssuranceQuestions,
                                                            'prefix' => 1
                                                        ],
                                                        [
                                                            'title' => 'Checklist for Documentation',
                                                            'questions' => $documentationQuestions,
                                                            'prefix' => 2
                                                        ],
            
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
                                                                    $response = $checklist7->{"ointment_packing_" . ($index + 1)};
                                                                    $remark = $checklist7->{"ointment_packing_remark_" . ($index + 1)};
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
                                 @endif


                                {{-- Engineering --}}
                                @php
                                $checklistEngineering = [
                                    'Is there a master list of all equipment that specifies those requiring maintenance and/or calibration?',
                                    'Are written procedures available for set-up of equipment?',
                                    'Are written procedures available for maintenance of equipment?',
                                    'Are written procedures available for cleaning of equipment?',
                                    'Are written procedures available for calibration of manufacturing equipment?',
                                    'Are written procedures available for calibration of control instruments?',
                                    'Are records kept for the sequence of products manufactured on particular equipment?',
                                    'Are records kept for maintenance and cleaning logs?',
                                    'Are records kept for calibration of manufacturing equipment?',
                                    'Are records kept for calibration of control instruments?',
                                    'Is equipment designed to prevent adulteration of product with lubricants, coolants, fuel, metal fragments, or other extraneous materials?',
                                    'Are holding, conveying and manufacturing systems designed and constructed so as to allow them to be maintained in a sanitary condition?',
                                    'Are there SOPs for inspection (monitoring the condition) and maintenance of equipment and of measuring and testing instruments?',
                                    'Do SOPs assign responsibilities; include schedules; describe methods, equipment, and materials to be used; and require maintenance of records?',
                                    'If water is purified for use in the process, is the purification system periodically sanitized and appropriately maintained?',
                                    'Does a SOP specify that equipment cannot be used if it is beyond the calibration due date, and describe actions to be taken if equipment is used that is found to have been beyond the due date or is found to be out of calibration time?',
                                    'Are there SOPs for calibration of critical equipment, and measuring and testing instruments?',
                                    'Do SOPs assign responsibilities; include schedules; describe methods; equipment, and materials to be used, including calibration over actual range of use and standards traceable to national standards; and include specifications and tolerances?',
                                    'Is calibrated equipment labeled with date of calibration and date of next calibration is due?',
                                    'Is equipment in use observed to be within calibration dating?',
                                    'Are periodic verifications performed on critical production scales (e.g., for raw material dispensing or portable scales) to assure that they remain within calibration in the time between full calibrations?',
                                    'Are records maintained for maintenance and calibration operations?',
                                    'Is there any standard procedure for maintenance and calibration operations?',
                                    'Check the filter drying room. Is there procedure for the filter drying? Check 2- 3 filter randomly.',
                                    'Do you maintain the filter cleaning record?',
                                ];

                                $checklistBuilding = [
                                    'Check the all piping properly painted with colour code.',
                                    'Check all piping to check for air / water / steam leakages if any.',
                                    'Check the hot and cold lines / surfaces properly insulated.',
                                    'Check any cracks in wall and updating wall painting.',
                                    'All doors and its door closer to function properly.',
                                    'Check all the toilets, bathrooms valves and flush.',
                                ];

                                $checklistHVAC = [
                                    'Check pressure gradient and cleaning of Area.',
                                    'Check area cleanness and HEPA grills.',
                                ];
                                @endphp

                                @if(!empty($data->checklist9))
                                <div class="inner-block">
                                    <div class="content-table">
                                        <!-- <div class="border-table"> -->
                                            <div class="block-head">
                                                Checklist - Engineering
                                            </div>
                                            <div>
                                                @php
                                                    $checklists = [
                                                        [
                                                            'title' => 'Checklist for Engineering',
                                                            'questions' => $checklistEngineering,
                                                            'prefix' => 1
                                                        ],
                                                        [
                                                            'title' => 'Checklist for Building Facility',
                                                            'questions' => $checklistBuilding,
                                                            'prefix' => 2
                                                        ],
                                                        [
                                                            'title' => 'Checklist for HVAC/HEPA',
                                                            'questions' => $checklistHVAC,
                                                            'prefix' => 3
                                                        ],

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
                                                                    $response = $checklist9->{"engineering_response_" . ($index + 1)};
                                                                    $remark = $checklist9->{"engineering_remark_" . ($index + 1)};
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
                               @endif
                                
                                @php
                                $checklistqualitycontrol = [
                                    'Are the complete index and a complete set of applicable SOPs available in the department?',
                                    'Are the index & annexure current?',
                                    'Are training records of the employees working in the department up-to-date?',
                                    'Is Job Description of the employees working in the department up-to-date?',
                                    // "Have the employees undergone training in the following areas?",
                                    'cGLP (Related: SOP for Good Laboratory Practices)',
                                    'SOPs',
                                    'Analytical Techniques',
                                    'EU_GMP',
                                    'Is Training Calendar of the employees working in the department up-to-date?',
                                    'Is an up-to-date organizational chart of the Quality Control Department available?',
                                    'Are all employees following the garments SOP, including where necessary masks & gloves?',
                                    'Is the laboratory neat and orderly with sufficient space for equipment and operations?',
                                    'Is the good housekeeping followed?',
                                    'Are the laboratory instruments/equipment qualified?',
                                    // "Are all reagents and solutions",
                                    'Clearly labeled with their proper name?',
                                    'Labeled with the date of receipt and/or expiration date?',
                                    // "Are prepared solutions labeled with the",
                                    'Name of the person who prepared them?',
                                    'Date of preparation?',
                                    'Expiration date?',
                                    'Is there any written procedure available for status labeling?',
                                    'Is the area qualified? Have any modification in the facility in the last 6 months?',
                                    'Are the entire area log books updated?',
                                    'Is there an approved preventive maintenance program for all equipment/instruments used in the laboratory?',
                                    'Is there an SOP for corrective action if an instrument is found to be out of calibration?',
                                    'Where standards are used to calibrate an instrument, is there a written procedure for their preparation?',
                                    'Is a specific person responsible for the receipt of samples for testing?',
                                    'Is there a written SOP describing sample receipt and recording (logging in)?',
                                    'Where are samples stored before and after testing?',
                                    'Are samples retained after completion of testing and reporting? If not, What happens to samples after testing and reporting are complete?',
                                    'Is there a time limit on how long a sample may remain in the laboratory prior to testing?',
                                    'Is the approved vendor list for all raw materials and packing materials available?',
                                    'Is there any data backup policy available?',
                                    'Is there any written procedure for the Audit trail?',
                                    'Is there any written procedure for the management of software & creation of user ID?',
                                    'Are there approved test procedures available for all tests performed in the laboratory?',
                                    'Is there a written procedure for ensuring that all pharmacopoeial procedures are updated when a supplemental monograph is issued?',
                                    'Has the test method been validated for precision and reliability?',
                                    'Examine the work currently being performed on the HPLCs.',
                                    'Has the analyst recorded all the relevant details of the product being tested, including the attachment of printouts or record of weighing?',
                                    'Is there documented evidence that system suitability was determined prior to the use of the chromatography in the analysis?',
                                    'Is there a reference to the test method used in the analyst’s Test Data Sheet (TDS)?',
                                    'Are laboratory records indicating the date of receipt of the sample and expiry date?',
                                    'Are appropriate reference standards used and are they stored in a proper manner to ensure stability? Are their expiration dates adequately monitored so they are not used beyond the expiration dates?',
                                    'Is reference standard kept under proper storage condition?',
                                    'Are working standards prepared as per the protocol? Check for its storage condition',
                                    'Is there a record of the preparation of volumetric solutions?',
                                    'Are volumetric solutions freshly prepared? If stored, what expiration date is given?',
                                    'Are raw data reviewed prior to release from the laboratory by a person other than the analyst who performed the test?',
                                    'Check method validation for any product which is done in between two self-inspections with respect to SOP.',
                                    'Is a stability study schedule available?',
                                    'Are protocols for all stability study samples available?',
                                    'Does the procedure for keeping stability samples available?',
                                    'Are stability samples kept as per the storage requirement?',
                                    'Is the stability summary available?',
                                    'Are records maintained of nonconforming materials, related investigations and corrective actions?',
                                    'For active ingredients, is there an SOP for investigation of out-of-specification (OOS) test results to assure that a uniform procedure is followed to determine why the OOS result occurred and that corrective actions are implemented?',
                                    'Raw Material control - Is a list of acceptable suppliers (i.e. approved vendor list) maintained and are incoming raw materials checked against it?',
                                    'Are statistical sampling plans used to assure that the samples are representative of the lot?',
                                    'Are sampled containers labeled with sampler’s name and date of sampling?',
                                    'Are there complete written instructions for testing and approving raw materials, including methods, equipment, operating parameters, acceptance specifications?',
                                    'Are raw materials approved before being used in production?',
                                    'Are appropriate controls exercised to assure that they are not used in a batch prior to release by Quality Control?',
                                    'If raw materials are accepted on certificates of analysis, have suppliers been appropriately certified or qualified, have results on the COA been verified by in-house testing?',
                                    'Is raw materials identification test performed on every batch and receipt?',
                                    'Is there an effective system for monitoring and retesting or re-evaluating stored raw materials to assure that they are not used beyond their recommended use date?',
                                    'In-process testing - Are there complete written instructions for testing and approving in-process materials, including methods, equipment, operating parameters, acceptance specifications?',
                                    'If operators perform in-process testing, have they been trained and was the training documented? Does QC periodically verify their results?',
                                    'Final product control - Is every batch sampled according to a plan that assures that the sample is representative of the batch?',
                                    'When and where is the finished product sampled for release?',
                                    'Is every product batch tested and approved before shipment?',
                                    'Are there complete written instructions for testing and releasing final product, including methods, equipment, operating parameters, and acceptance specifications?',
                                    'If skip lot testing is done, does the COA clearly indicate which tests are performed on every lot and which are critical via skip lot testing?',
                                    'Have non-compendial methods been validated, including accuracy, linearity, specificity, ruggedness, and comparison with compendial methods, OR have compendial methods been verified to function properly in the company’s laboratory?',
                                    'Is the stability protocol available?',
                                    'Are these stability chambers available to carryout stability of the product at',
                                    'Do you keep both hard copy and electronic copy of temperature/Rh monitoring?',
                                    'Are the stability results reviewed by a qualified, experienced person?',
                                    'Is stability study in primary pack done for different products?',
                                    'Do laboratories have adequate space and are they clean and orderly, with appropriate equipment for required tests?',
                                    'Are calibrated instruments labeled with date calibrated and date next calibration is due?',
                                    'Are daily or weekly calibration verifications performed on analytical balances using a range of weights (high, middle, low) based on the operating range of the balance?',
                                    'Are in-process materials tested at appropriate phases for identity, strength, quality, and purity and are they approved or rejected by Quality control?',
                                    'Are there laboratory controls including sampling and testing procedures to assure conformance of containers, closures in process materials and finished product specifications?',
                                    'Are written sampling and testing procedures and acceptance criteria available for each product?',
                                    'Are specific tests for foreign particles done?',
                                    'Are Packing materials approved before being used in production?',
                                    'Check for compliance of stability data and its summary',
                                    'Check for Analytical Data Sheet',
                                    'Are reagents and microbiological media adequately controlled and monitored to assure that they are periodically replaced and that old reagents are not used?',
                                    'Are all containers of materials or solutions adequately labeled to determine identity and dates of preparation and expiration (if applicable)?',
                                    'Are data recorded in notebooks or on pre-numbered sheets, including appropriate cross-reference to the location of relevant spectra and chromatograms? Are equipment ID numbers recorded for each analysis?',
                                    'Are data and calculations checked by a second person and countersigned?',
                                    'Are Material safety data sheet (MSDS) of chemical which are used is available?',
                                    'Microbiological Laboratories',
                                    'Are positive and negative controls used for testing? Are their results recorded?',
                                    'Is growth support testing with low levels of organisms performed on all incoming media lots and is it documented?',
                                    'Is an expiration date assigned to prepared media and are prepared media stored at manufacturers’ recommended storage temperatures?',
                                    'Are isolates from microbiological testing identified if appropriate?',
                                    'Is each lot of microbial ID systems checked with positive and negative controls?',
                                ];
                                @endphp

                                    @if(!empty($data->checklist10))
                                    <div class="inner-block">
                                        <div class="content-table">
                                          <!-- <div class="border-table"> -->
                                              <div class="block-head">
                                                  Checklist - Quality Control
                                              </div>
                                              <div>
                                                  @php
                                                      $checklists = [
                                                          [
                                                              'title' => 'Checklist for Quality Assurance',
                                                              'questions' => $checklistqualitycontrol,
                                                              'prefix' => 1
                                                          ],
                                                      
  
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
                                                                      $response = $checklist10->{"quality_control_response_" . ($index + 1)};
                                                                      $remark = $checklist10->{"quality_control_remark__" . ($index + 1)};
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
                                    @endif
                                                    @php
                                                        $questions_stores = [
                                                            'Is there a potential for contamination or cross-contamination from any sources? If so, how it is controlled / prevented?',
                                                            'Are there complete written master manufacturing instructions that specify formula, names and codes of raw materials, equipment, manufacturing flow, operating parameters, in-process sampling, packaging materials, labeling, and documentation of each significant step?',
                                                            'Are critical environmental parameters monitored and recorded?',
                                                            'Is there an SOP for receiving, handling, storing and accountability of pre-printed labels?',
                                                            'If filled unlabeled containers are set aside for future labeling, is there sufficient identification to determine name, strength, quantity, lot number and other information needed for traceability?',
                                                            'Is a list of acceptable suppliers maintained and are incoming raw materials checked against it?',
                                                            'Are statistical sampling plans used to assure that the samples are representative of the lot?',
                                                            'Are sampled containers labeled with sampler’s name and date of sampling?',
                                                            'Are there complete written instructions for testing and approving raw materials, including methods, equipment, operating parameters, acceptance specifications?',
                                                            'If raw materials are accepted on certificates of analysis, have suppliers been appropriately certified or qualified, have results on the COA been verified by in-house testing, and is periodic monitoring performed?',
                                                            'Are raw materials approved before being used in production?',
                                                            'If raw materials are accepted on certificates of analysis, is at least an identification test performed (where safe) on every batch and receipt?',
                                                            'Is there an effective system for monitoring and retesting or re-evaluating stored raw materials to assure that they are not used beyond their recommended use date?',
                                                            'Is there any material in reject area? Check the record of the same.',
                                                            'If fresh and recovered solvents are commingled, are the recovered solvents sampled and assayed and found to be satisfactory prior to commingling, and is the quality of commingled solvents monitored on an established schedule?',
                                                            'Is cleaning record maintained for store?',
                                                            'Is printed packing material storage separately and the same is recorded?',
                                                            'Is sampling of raw material, primary packing label, Aluminum foil & PVC / PVDC done in the LAF?',
                                                            'Checking of approved vendor list on receipt of material in the store.',
                                                            'Check the Dispensing and sampling area records.',
                                                            'Check if any stains on dispensed color/flavor poly bag which cover material.',
                                                            'Is there any product dedicated scoop for different active raw materials?',
                                                            'Check the Scoops / Spatula usage log sheet.',
                                                            'Is there clean the area of Finished Goods store? Check the record for last 3 months.',
                                                            'Check the Temperature and RH data of the Finished goods store. Check last 3 month records.',
                                                            'Do you have any record of the temperature of freeze?',
                                                            'Is there any separate location / separate method to identify the stage of raw materials?',
                                                            'Do you have any details record of dispatch for all finished goods?',
                                                            'Have you any standard practice for dispatch of finished goods?',
                                                        ];
                                                    @endphp
                                                        
                                                        @if(!empty($data->checklist11))
                                                        <div class="inner-block">
                                                            <div class="content-table">
                                                            <!-- <div class="border-table"> -->
                                                                <div class="block-head">
                                                                    Checklist - Stores
                                                                </div>
                                                                <div>
                                                                    @php
                                                                        $checklists = [
                                                                            [
                                                                                'title' => 'Checklist for Stores',
                                                                                'questions' => $questions_stores,
                                                                                'prefix' => 1
                                                                            ],
                                                                            

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
                                                                                        $response = $checklist11->{"checklist_stores_response_" . ($index + 1)};
                                                                                        $remark = $checklist11->{"checklist_stores_remark_" . ($index + 1)};
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
                                                       @endif
                                                        @php
                                                                $questions_hr = [
                                                                    'Do you have written procedure for material movement inside the factory premises?',
                                                                    'Do the material taken out from the gate require valid gate pass at the security?',
                                                                    'Do you have written procedure for visitor movement?',
                                                                    'Do you have pest and rodent control procedure?',
                                                                    'Whether the contract is updated?',
                                                                    'Check the data for the pest & rodent control for the last 3 months, is it ok?',
                                                                    'Whether the areas are marked for rodent trap & rodent gum pad? Check 4-5 points randomly.',
                                                                    'Whether the rodent trap, checked for trapped rodent on daily basis & record of the same is maintained by HR, check last 3 months data.',
                                                                    'Check whether any rodent is trapped in last 3 months and disposed properly?',
                                                                    'Drains / Main holes are sprayed with pesticides. Check the record for the last 3 months.',
                                                                    'Check the cleaning record for the road, dustbin, drain, toilet, floors, fans and tubes, canteen, tables, chairs, premises of last 3 months.',
                                                                    'Do you have a written procedure for linen washing?',
                                                                    'Is the linen for washing is collected from respective area in polybags?',
                                                                    'Do you have written training procedure, check one training record from each department',
                                                                    'Check the annual training schedule cum card for new joinee.',
                                                                    'Check the operator training and record',
                                                                    'Check the induction training record for one new recruit in the production, store, QA, QC.',
                                                                    'Is annual medical checkup being done by a competent medical doctor?',
                                                                    'Do annual medical checkup program covers tests like Hematology, urine, blood sugar, ECG, X-ray and VDRL test?',
                                                                    'Is there any procedure for reporting illness such as cuts, wounds, rashes, any skin aliment, cold, cough, or any communicable diseases / infections?',
                                                                    'Is there a procedure for issue, storage, washing and collection of used garments?',
                                                                    'Is there any color code for garments and foot wear followed?',
                                                                    'Check the linen cleaning record for last three months.',
                                                                    'Whether the garments handling properly before issued.',
                                                                    'Check the training record for the SOP related changes for two person for production, QA and QC',
                                                                    'Do you have a laid down procedure for operation of washing machine and tumbler dryer?',
                                                                    'Do you have a laid down procedure for fire prevention & control in factory premises.',
                                                                    'Is there any emergency evacuation system in factory premises?',
                                                                    'Check the first aid services at security gate are available or not.',
                                                                    'Check the use of personnel protective equipment during critical manufacturing operation.',
                                                                    'Check the canteen area is neat & clean.',
                                                                    'Check the scrap record for last 2 months.',
                                                                    'Checks the surrounding areas of factory are neat & clean.',
                                                                    'Are you ensuring that at no stage linen of two different colors or from two different sections shall be mixed for washing?',
                                                                ];
                                                            @endphp
                                                            
                                                            @if(!empty($data->checklist12))
                                                            <div class="inner-block">
                                                                <div class="content-table">
                                                                <!-- <div class="border-table"> -->
                                                                    <div class="block-head">
                                                                        Checklist - Stores
                                                                    </div>
                                                                    <div>
                                                                        @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Human Resource',
                                                                                    'questions' => $questions_hr,
                                                                                    'prefix' => 1
                                                                                ],
                                                                                
                                                            
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
                                                                                            $response = $checklist12->{"checklist_hr_response_" . ($index + 1)};
                                                                                            $remark = $checklist12->{"checklist_hr_response__" . ($index + 1)};
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
                                                            @endif

                                                            @php
                                                                $questions_dispensing = [
                                                                    'Is access to the facility restricted?',
                                                                    'Is the dispensing area cleaned as per SOP?',
                                                                    'Check the status label of area and equipment.',
                                                                    'Are all raw materials carry proper label?',
                                                                    'Standard operating procedure for dispensing of raw material is displayed?',
                                                                    'All the person involve in dispensing having proper gowning?',
                                                                    'Where you keep the materials after dispensing?',
                                                                    'Is there any log book for keeping the record of dispensing?',
                                                                    'Have you any standard practice to cross check the approved status of raw materials before dispensing?',
                                                                    'Are all balances calibrated which are to be use for dispensing?',
                                                                    'Is the pressure differential of RLAF is within acceptance limit? What is the limit? _______',
                                                                    'Is the pressure differential of the area is within acceptance limit? Check the pressure differential__________',
                                                                    'Is there any record for room temperature & relative humidity? Check the temperature _____°C & RH _____%',
                                                                ];

                                                                $questions_visual_inspection = [
                                                                    'Is status labels displayed on all equipments?',
                                                                    'Equipment cleanliness, check few equipments.',
                                                                    'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product?',
                                                                    'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                                                    'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                                    'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                                    'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                                                    'Are there written instructions describing how to use in-process data to control the process?',
                                                                    'Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                                                    'Is equipment inspected immediately prior to use?',
                                                                    'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                                    'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                                    'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                                                    'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments.',
                                                                    'Is equipment cleaned promptly after use?',
                                                                    'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                                                    'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                                                    'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)',
                                                                    'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                                    'Are all weighing and measuring performed by one qualified person and checked by a second person Check the weighing balance record',
                                                                    'All the person working in manufacturing area having proper gowning?',
                                                                    'Is the Mfg tank calibrated?',
                                                                    'Check the CIP-SIP system in place and verify the records.',
                                                                    'Is the pressure differential of every particular area are within limit?',
                                                                    'Is there a define procedure for filtration and verify the records.',
                                                                    'Is there any procedure to carryout integrity test of the filter used in process?',
                                                                    'Is there any procedure for cleaning of filling machine?',
                                                                    'Is there any procedure to expose the settle plate during complete filling activity?',
                                                                    'Have you any SOP regarding Hold time of material during staging?',
                                                                    'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                                    'Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                                                    'Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                                                    'Does the process control address all issues to ensure identity, strength, quality and purity of product?',
                                                                    'Check the calibration labels for instrument calibration status',
                                                                    'Temperature & RH record log book is available for each staging area.',
                                                                    'Is there any procedure for operation and cleaning of tunnel, verify the records',
                                                                    'Check is there any sop for operations & cleaning of autoclave verify the records.',
                                                                    'Is there any procedure for operation and cleaning of washing machine, verify the records.',
                                                                    'Is there any procedure for operation and cleaning of leak test apparatus, verify the records.',
                                                                    'Is there any procedure for operation and cleaning of ampoule visual inspection machine, verify the records.',
                                                                    'Check for area activity record',
                                                                    'Check for equipment usage record',
                                                                    'Check for general equipment details and accessory details.',
                                                                    'Check for man & material movement in the area',
                                                                    'Air handling system qualification, cleaning details and PAO test reports',
                                                                    'Check for WFI hose pipe status and water hold up.',
                                                                    'Check for the status labeling in the area and, material randomly',
                                                                    'Check the in-process equipments cleaning status & records.',
                                                                    'Have you any SOP regarding Hold time of material during staging?',
                                                                ];

                                                                $questions_documentation = [
                                                                    'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                                                    'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports',
                                                                    'Is the batch record is on line up to the current stage of a process?',
                                                                    'In process carried out as per the written instruction describe in batch record?',
                                                                    'Is there any area cleaning record available for all individual areas?',
                                                                    'Current version of SOP’s is available in respective areas?',
                                                                ];
                                                            @endphp       
                                                        @if(!empty($data->checklist13))
                                                        <div class="inner-block">
                                                            <div class="content-table">
                                                            <!-- <div class="border-table"> -->
                                                                <div class="block-head">
                                                                    Checklist - Production (Injection Dispensing & Manufacturing)
                                                                </div>
                                                                <div>
                                                                    @php
                                                                        $checklists = [
                                                                            [
                                                                                'title' => 'Checklist for Human Resource',
                                                                                'questions' => $questions_dispensing,
                                                                                'prefix' => 1
                                                                            ],
                                                                            [
                                                                                    'title' => 'Checklist for Building Facility',
                                                                                    'questions' => $questions_visual_inspection,
                                                                                    'prefix' => 2
                                                                            ],
                                                                            [
                                                                                    'title' => 'Checklist for HVAC/HEPA',
                                                                                    'questions' => $questions_documentation,
                                                                                    'prefix' => 3
                                                                            ],


                                                                            
                                                        
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
                                                                                        $response = $checklist13->{"response_dispensing_" . ($index + 1)};
                                                                                        $remark = $checklist13->{"remark_dispensing_" . ($index + 1)};
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
                                                        @endif
                                                        @php
                                                                $questions_injection_packing = [
                                                                    'Is status labels displayed on all equipments/machines?',
                                                                    'Equipment cleanliness, check few equipments.',
                                                                    'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non – additive so as not to affect the product?',
                                                                    'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                                                    
                                                                    'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                                    'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                                    'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                                                    'Are there written instructions describing how to use in-process data to control the process?',
                                                                    'Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                                                    
                                                                    'Is equipment inspected immediately prior to use?',
                                                                    'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                                    'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                                    'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                                                    'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments',
                                                                
                                                                    'Is equipment cleaned promptly after use?',
                                                                    'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                                                    'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)',
                                                                    
                                                                    'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                                
                                                                    'Are all weighing and measuring performed by one qualified person and checked by a second person',
                                                                    
                                                                    
                                                                    'All the person working in manufacturing area having proper gowning?',
                                                                    'Have you any SOP regarding Hold time of material during staging?',
                                                                    'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                                    'Check for area activity record',
                                                                    'Check for equipment usage record',
                                                                    'Check for general equipment details and accessory details.',
                                                                    'Check for man & material movement in the area',
                                                                    'Air handling system qualification, cleaning details and PAO test reports',
                                                                    'Check for the status labeling in the area and, material randomly',
                                                                    'Check the in-process equipments cleaning status & records.',
                                                                    'Are any unplanned process changes (process excursions) documented in the batch record?',
                                                                    'Status label of area & equipment available?',
                                                                    'Have you any proper storage area for primary and secondary packing material?',
                                                                    'Do you have proper segregation system for keeping product/batch separately?',
                                                                    'Stereo impression record available? Check the record for any 2 batches.',
                                                                    'Where you keep the rejected ampoule / cartons?',
                                                                    'Is there any standard practice for destruction of printed ampoule label & printed cartons?',
                                                                    'Is there a written procedure for clearing the packaging area after one packaging operation, and cleaning before the next operation, especially if the area is used for packaging different materials?',
                                                                    'Is there any procedure for operation and cleaning of ampoule label machine, verify the record',
                                                                    'Is there any procedure for operation and cleaning of ampoule blister machine, verify the record.',
                                                                    'Have you any standard procedure for removal of scrap?',
                                                                    'Is there any procedure to cross verify the dispensed packaging material before starting the packaging.',
                                                                ];

                                                                $questions_documentation = [
                                                                    'Do records have doer & checker signatures? Check the timings, date and yield etc in the batch production record.',
                                                                    'Is each batch assigned a distinctive code, so that material can be traced through manufacturing and distribution? Check for In process analytical reports',
                                                                    'Is the batch record is on line up to the current stage of a process?',
                                                                    'In process carried out as per the written instruction describe in batch record?',
                                                                    'Is there any area cleaning record available for all individual areas?',
                                                                    'Current version of SOP’s is available in respective areas?',
                                                                ];
                                                            @endphp  
                                                            
                                                            @if(!empty($data->checklist14))
                                                            <div class="inner-block">
                                                                <div class="content-table">
                                                                <!-- <div class="border-table"> -->
                                                                    <div class="block-head">
                                                                        Checklist -Production (Injection Packing)

                                                                    </div>
                                                                    <div>
                                                                        @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Injection Packing',
                                                                                    'questions' => $questions_injection_packing,
                                                                                    'prefix' => 1
                                                                                ],
                                                                                [
                                                                                        'title' => 'Checklist for Building Facility',
                                                                                        'questions' => $questions_documentation,
                                                                                        'prefix' => 2
                                                                                ],
                                                                                
                                    
                                                                                
                                                            
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
                                                                                            $response = $checklist14->{"response_injection_packing_" . ($index + 1)};
                                                                                            $remark = $checklist14->{"remark_injection_packing_" . ($index + 1)};
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
                                                            @endif

                                                            @php
                                                                $questions_powder_manufacturing_filling = [
                                                                    'Is status labels displayed on all equipments?',
                                                                    'Equipment cleanliness, check few equipments.',
                                                                    'Are machine surfaces that contact materials or finished goods, non–reactive, non-absorptive and non–additive so as not to affect the product?',
                                                                    'Are there data to show that cleaning procedures for non-dedicated equipment are adequate to remove the previous materials? For active ingredients, have these procedures been validated?',
                                                                    'Do you have written procedures for the safe and correct use of cleaning and sanitizing agents? What are the sanitizing agents used in this plant?',
                                                                    'Are there data to show that the residues left by the cleaning and/or sanitizing agent are within acceptable limits when cleaning is performed in accordance with the approved method?',
                                                                    'Do you have written procedures that describe the sufficient details of the cleaning schedule, methods, equipment and material? Check for procedure compliance',
                                                                    'Are there written instructions describing how to use in-process data to control the process?',
                                                                    'Are all piece of equipment clearly identified with easily visible markings? Check the equipment nos. corresponds to an entry in a log book.',
                                                                    'Is equipment inspected immediately prior to use?',
                                                                    'Do cleaning instructions include disassembly and drainage procedure, if required to ensure that no cleaning solutions or rinse remains in the equipment?',
                                                                    'Has a written schedule been established and is it followed for cleaning of equipment?',
                                                                    'Are seams on product-contact surfaces smooth and properly maintained to minimize accumulation of product, dirt, and organic matter and to avoid growth of microorganisms?',
                                                                    'Is clean equipment clearly identified as “cleaned” with a cleaning date shown on the equipment tag? Check for few equipments',
                                                                    'Is equipment cleaned promptly after use?',
                                                                    'Is there proper storage of cleaned equipment so as to prevent contamination?',
                                                                    'Is there adequate system to assure that unclean equipment and utensils are not used (e.g., labeling with clean status)?',
                                                                    'Is sewage, trash and other reuse disposed off in a safe and sanitary manner (and with sufficient frequency)?',
                                                                    'Are written records maintained on equipment cleaning, sanitizing and maintenance on or near each piece of equipment? Check 2 equipment records.',
                                                                    'Are all weighing and measuring performed by one qualified person and checked by a second person? Check the weighing balance record',
                                                                    'Are the sieves & screen kept in proper place with proper label?',
                                                                    'Is the pressure differential of every particular area within limit?',
                                                                    'All the person working in manufacturing area having proper gowning?',
                                                                    'Have you any SOP regarding Hold time of material during staging?',
                                                                    'Is there a written procedure specifying the frequency of inspection and replacement for air filters?',
                                                                    'Are written operating procedures available for each piece of equipment used in the manufacturing, processing? Check for SOP compliance. Check the list of equipment and equipment details.',
                                                                    'Does each piece of equipment have written instructions for maintenance that includes a schedule for maintenance?',
                                                                    'Does the process control address all issues to ensure identity, strength, quality and purity of product?',
                                                                    'Check the calibration labels for instrument calibration status',
                                                                    'Temperature & RH record log book is available for each staging area.',
                                                                    'Check for area activity record.',
                                                                    'Check for equipment usage record',
                                                                    'Check for general equipment details and accessory details.',
                                                                    'Check for man & material movement in the area',
                                                                    'Air handling system qualification, cleaning details and PAO test reports',
                                                                    'Check for purified water hose pipe status and water hold up.',
                                                                    'Check for the status labeling in the area and, material randomly',
                                                                    'Check the in-process equipments cleaning status & records.',
                                                                    'Are any unplanned process changes (process excursions) documented in the batch record?',
                                                                    'If the product is blended, are there blending parameters and/or homogeneity specifications?',
                                                                    'Are materials and equipment clearly labeled as to identity and, if appropriate, stage of manufacture?',
                                                                    'Is there a preventive maintenance program for all equipment and status of it?',
                                                                    'Do you have any SOP for operation of pouch filling and sealing machine?',
                                                                    'Have you any usage logbook for powder filling and sealing machine.',
                                                                ];

                                                                $questions_packing_manufacturing = [
                                                                    'Status label of area & equipment available?',
                                                                    'Have you any proper storage area for primary and secondary packing material?',
                                                                ];
                                                            @endphp
                                                            {{-- <div class="inner-block">
                                                                <div class="content-table">
                                                                <!-- <div class="border-table"> -->
                                                                    <div class="block-head">
                                                                        Checklist - Production (Powder Manufacturing and Packing)   

                                                                    </div>
                                                                    <div>
                                                                        @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Powder Manufacturing & Filling',
                                                                                    'questions' => $questions_powder_manufacturing_filling,
                                                                                    'prefix' => 1
                                                                                ],
                                                                                [
                                                                                        'title' => 'Checklist for Packing',
                                                                                        'questions' => $questions_packing_manufacturing,
                                                                                        'prefix' => 2
                                                                                ],
                                                                                
                                    
                                                                                
                                                            
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
                                                                                            $response = $checklist15->{"response_powder_manufacturing_filling_" . ($index + 1)};
                                                                                                $remark = $checklist15->{"remark_powder_manufacturing_filling_" . ($index + 1)};
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
                                                            </div> --}}
                                                            @if(!empty($data->checklist15))
                                                            <div class="inner-block">
                                                                <div class="content-table">
                                                                <!-- <div class="border-table"> -->
                                                                    <div class="block-head">
                                                                        Checklist - Production (Powder Manufacturing and Packing)   
                                                                    
                                                                    </div>
                                                                    <div>
                                                                        @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Powder Manufacturing & Filling',
                                                                                    'questions' => $questions_powder_manufacturing_filling,
                                                                                    'prefix' => 1
                                                                                ],
                                                                                [
                                                                                        'title' => 'Checklist for Packing',
                                                                                        'questions' => $questions_packing_manufacturing,
                                                                                        'prefix' => 2
                                                                                ],
                                    
                                                                                
                                                            
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
                                                                                                $response = $checklist15->{"response_powder_manufacturing_filling_" . ($index + 1)};
                                                                                                $remark = $checklist15->{"remark_powder_manufacturing_filling_" . ($index + 1)};                 
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
                                                            @endif
                                                            
                                                            @php
                                                            $questions_analytical_research_development = [
                                                                'Is there an adequate system SOP for reviewing and implementing analytical development?',
                                                                'Is Lic. Copy available?',
                                                                'Do you refer current pharmacopeias / literature search/ reference books etc. at the time of analytical development?',
                                                                'Regarding in house raw materials, do you receive method of analysis from manufacturer?',
                                                                'Do you receive working standards along with COA from manufacturer?',
                                                                'Can market / Generic sample study to be done?',
                                                                'Do you document method development analytical reports?',
                                                                'Can separate file to be prepared for each product?',
                                                                'Can comparative study be carried out with market sample?',
                                                                'Have non-compendial methods been validated, including accuracy, linearity, ruggedness and comparison with compendial methods or have compendial methods (Official) been verified to function properly in the company’s laboratories with proper documentation / SOP of same available?',
                                                                'Are FPS/STP available for finished product?',
                                                                'Are technology transfer SOP/documents available?',
                                                                // "Are stability study carried out for the product at",
                                                                '25°C / 60% RH',
                                                                '30°C / 70% RH',
                                                                '40°C / 75% RH',
                                                                'Are the stability results reviewed by a qualified, experienced person?',
                                                                'Is stability study in primary pack done for different products?',
                                                                'Laboratories – Do laboratories have adequate space and are they clean and orderly, with appropriate equipment for required tests?',
                                                                'Are instruments calibrated & labeled with date calibrated and date next calibration is due?',
                                                                'Are daily or monthly calibration verifications performed on analytical balances using a range of weights (high, middle, low) based on the operating range of the balance?',
                                                                'Check for compliance of stability data and its summary',
                                                                'Check for analytical reports?',
                                                                'Are data and calculations checked by a second person & countersigned?',
                                                                'Is there any checklist for the dossier requirement?',
                                                                'Current versions of SOPs are available in respective areas?',
                                                            ];
                                                        @endphp
                                                        
                                                        @if(!empty($data->checklist16))
                                                        <div class="inner-block">
                                                            <div class="content-table">
                                                             <!-- <div class="border-table"> -->
                                                                <div class="block-head">
                                                                    Checklist - Analytical Research and Development   
                                                                
                                                                </div>
                                                                <div>
                                                                        @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Analytical Research and Development',
                                                                                    'questions' => $questions_analytical_research_development,
                                                                                    'prefix' => 1
                                                                                ],
                                    
                                                                                
                                                            
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
                                                                                            $response = $checklist16->{"response_analytical_research_development_" . ($index + 1)};
                                                                                            $remark = $checklist16->{"remark_analytical_research_development_" . ($index + 1)};
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
                                                       </div>
                                            </div>

                                                        @endif
                                                

                                                        @php
                                                            $questions_formulation_research_development = [
                                                                'Is there an adequate system for reviewing and implementing development?',
                                                                'Is any product development checklist?',
                                                                'Is Lic Copy available?',
                                                                'Are refer current pharmacopoeia at the time of development?',
                                                                'Can Market sample/Generic Sample Study to be done?',
                                                                'Can tooling and change part availability to be checked before initiating development?',
                                                                'Can validation be performed for IH products?',
                                                                'Is MFR-RM BOM available?',
                                                                'Is PDR available (Product development Report)?',
                                                                'Is FD involved in the change control process?',
                                                                'Is Technology transfer SOP available?',
                                                                'Can separate file be prepared for each product?',
                                                                'Can comparative study be carried out with market sample?',
                                                                'If raw materials are accepted on certificates of analysis, have suppliers been appropriately certified or qualified, have results on the COA been verified by in-house testing?',
                                                                'Are these stability chambers available to carry out stability of the product at -',
                                                                '25°C / 60% Rh',
                                                                '30°C / 65% Rh',
                                                                '40°C / 75% Rh',
                                                                'Do you keep both hard copy and electronic copy of temperature/RH monitoring?',
                                                                'Are the stability results reviewed by a qualified, experienced person?',
                                                                'Is stability study in primary pack done for different products?',
                                                                'Is any checklist for the dossier requirement?',
                                                                'Current version of SOP’s is available in respective areas?',
                                                            ];
                                                    @endphp

                                            @if(!empty($data->checklist17))
                                            <div class="inner-block">
                                                <div class="content-table">
                                                    <div class="block-head">
                                                        Checklist - Formulation Research and Development    
                                                    </div> 
                                                                @php
                                                                            $checklists = [
                                                                                [
                                                                                    'title' => 'Checklist for Formulation Research and Development',
                                                                                    'questions' => $questions_formulation_research_development,
                                                                                    'prefix' => 1
                                                                                ],
                                                                                
                                                                        
            
                                                                        
            
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
                                                                                        $response = $checklist17->{"response_formulation_research_development_" . ($index + 1)};
                                                                                        $remark = $checklist17->{"remark_formulation_research_development_" . ($index + 1)};
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
                                            @endif
                                            
                                                    
                                        
                                     
            
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
